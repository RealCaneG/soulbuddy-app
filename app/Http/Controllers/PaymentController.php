<?php

namespace App\Http\Controllers;

use App\Events\PaymentEvent;
use App\Notification;
use App\Pricing;
use App\TransactionStatus;
use App\TransactionType;
use App\UserBalance;
use App\UserTransaction;
use Auth;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Exception\PPConnectionException;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
    /**
     * @var ApiContext
     */
    private $_api_context;

    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function getAllPricings(Request $request)
    {
        return response()->json(['error' => false, 'data' => Pricing::orderBy('price')->get()]);
    }

    public function captureTransaction(Request $request)
    {
        if (strcasecmp($request->status, 'COMPLETED') == 0) {

            return response()->json(
                ['error' => true,
                    'message' => 'Transaction is not completed',
                    'status' => $request->status]);
        }

        $notification = null;
        $userId = Auth::user()->id;
        \DB::beginTransaction();
        try {
            if ($this->topUpTokens($request->amount, Auth::user()->id)) {
                $message = 'Transaction successfully captured! Top Up token successfully!';
                $transactionStatus = TransactionStatus::firstOrCreate(['status' => $request->status]);
                $transactionType = TransactionType::firstOrCreate(['type' => $request->transaction_type]);
                $userTransaction = UserTransaction::create([
                    'to_user_id' => $userId,
                    'payment_id' => $request->payment_id,
                    'payer_id' => $request->payer_id,
                    'merchant_id' => $request->merchant_id,
                    'payer_email' => $request->payer_email,
                    'payee_email' => $request->payee_email,
                    'transaction_type' => $transactionType->id,
                    'country_code' => $request->country_code,
                    'amount' => $request->amount,
                    'ccy' => $request->ccy,
                    'given_name' => $request->given_name,
                    'surname' => $request->surname,
                    'intent' => $request->intent,
                    'payment_method' => $request->payment_method,
                    'status' => $transactionStatus->id,
                    'reference_id' => $request->reference_id,
                ]);
                $notification = Notification::create([
                    'title' => 'Counselling Request Approved',
                    'user_id' => $userId,
                    'description' => $message,
                    'notification_type_id' => 2
                ]);
                \DB::commit();
                broadcast(new PaymentEvent($notification));
                return response()->json(
                    ['error' => false,
                        'message' => $message,
                        'data' => $userTransaction]);
            } else {
                $message = 'Unable to top up token, please contact our customer service.';
                $notification = Notification::create([
                    'title' => 'Counselling Request Approved',
                    'user_id' => $userId,
                    'description' => $message,
                    'notification_type_id' => 2
                ]);
                \DB::commit();
                broadcast(new PaymentEvent($notification));
                return response()->json(
                    ['error' => true, 'message' => $message]);
            }
        } catch (\Throwable $exception) {
            error_log($exception);
            \DB::rollBack();
            return response()->json(
                ['error' => true,
                    'message' => $exception->getMessage()]);
        }
    }

    private function topUpTokens(int $amount, string $userId)
    {
        $pricing = Pricing::wherePrice($amount)->first();
        $userBalance = UserBalance::whereUserId($userId)->first();

        \DB::beginTransaction();

        if ($pricing && $userBalance) {
            try {
                $balance = $userBalance->balance;
                $userBalance->balance = $balance + $pricing->token;
                $userBalance->save();
                \DB::commit();
            } catch (\Throwable $exception) {
                \DB::rollBack();
                throw $exception;
            }
            return true;
        }
        return false;
    }

    public function payWithPaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('PAYPAL');

        /**
         * items => {
         *
         *      item => {
         *          id,
         *          name,
         *          quantity,
         *          ccy,
         *          }
         *
         * total
         * numOfItems
         * ccy
         */
        $items = $request->items;
        $numOfItems = $request->numOfItem;
        $total = $request->total;
        $ccy = $request->ccy;

        $itemList = new ItemList();
        $itemIds = array_pluck($items, 'item.id');
        $pricings = Pricing::findMany($itemIds);

        if (!empty($items)) {
            foreach ($items as $item) {
                $theItem = new Item();
                $theItem->setName($item->name);
                $theItem->setCurrency($ccy);
                $theItem->setPrice($pricings->find($item->id));
                $itemList->addItem($item);
            }
        }

        $amount = new Amount();
        $amount->setCurrency($ccy)->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($total)->setItemList($itemList)->setDescription('test description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))/** Specify return URL **/
        ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paywithpaypal');
    }
}
