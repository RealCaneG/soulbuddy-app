<?php

namespace App\Http\Controllers;

use App\Secret;
use App\TransactionStatus;
use App\TransactionType;
use App\UserBalance;
use App\UserTransaction;
use App\UserUnlockSecret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SecretController extends Controller
{
    public function getUserUnlockedSecrets(Request $request)
    {
        return response()->json(['error' => false, 'data' => UserUnlockSecret::whereUserId(Auth::id())->get()]);
    }

    public function getPaginatedSecrets(Request $request)
    {
        $secrets = Secret::with('author', 'category')->where('expiry_date', '>=', date('Y-m-d'))->orderBy('created_at', 'desc')->paginate($request->numOfItems);
        return response()->json(['error' => false, 'data' => $secrets]);
    }

    public function getAllSecrets()
    {
        $secrets = Secret::orderBy('created_at', 'desc')->get('id', 'title');
        return response()->json(['error' => false, 'data' => $secrets]);
    }

    public function createSecret(Request $request)
    {
        $data = \GuzzleHttp\json_decode($request->data, true);
        error_log('data = '. print_r($data, true));
        \DB::beginTransaction();
        try {
            $secret = Secret::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'body' => $data['body'],
                'category_id' => $data['category'],
                'user_id' => Auth::user()->id,
                'price' => $data['price'],
                'expiry_date' => $data['expiryDate'],
                'is_free' => $data['price'] == 0,
            ]);
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
        \DB::commit();;

        return response()->json(['error' => false, 'data' => $secret]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function unlockSecret(Request $request)
    {
        $secretId = $request->secret_id;
        $userUnlockSecret = $this->unlockSecretService(\Auth::id(), $secretId);
        if ($userUnlockSecret !== null)
            return response()->json(['error' => false, 'data' => $userUnlockSecret, 'message' => 'success']);

        return response()->json(['error' => true, 'message' => 'Secret does not exist!']);
    }

    /**
     * @param int $userId
     * @param int $secretId
     * @return array
     * @throws \Exception
     */
    private function unlockSecretService(int $userId, int $secretId)
    {
        $secret = Secret::whereId($secretId)->first();
        $secretPrice = $secret->price;
        $secretOwnedBy = $secret->author()->first();
        try {
            $buyerBalance = UserBalance::where('user_id', '=', $userId)->first();
            $sellerBalance = UserBalance::where('user_id', '=', $secretOwnedBy->id)->first();
//            error_log('buyer balance ' . $buyerBalance);
//            error_log('price ' . $secretPrice);
        } catch (\Exception $exception) {
            throw $exception;
        }
        if ($secret == null) throw new NotFoundHttpException('Unable to find secret by secret Id:' . $secretId);
        if ($secretPrice >= $buyerBalance->balance) {
            throw new BadRequestException('Not enough balance for purchase. ' . 'Your balance: ' . $buyerBalance->balance);
        }
        try {
            \DB::beginTransaction();
            $newBalance = $buyerBalance->balance - $secretPrice;
            $buyerBalance->balance = $newBalance;
            $newBalance = $sellerBalance->balance + $secretPrice;
            $sellerBalance->balance = $newBalance;
            $buyerBalance->save();
            $sellerBalance->save();
            $typeSellingSecret = TransactionType::where('type', 'Selling Secret')->first();
            $typeBuyingSecret = TransactionType::where('type', 'Purchase Secret')->first();
            $statusCompleted = TransactionStatus::where('status', 'completed')->firstOrCreate([
                'status' => 'completed'
            ]);
            $referenceId = $secret->userId . '|' . $userId . '|' . $secret->id;
            UserTransaction::create([
                'payer_id' => $userId,
                'to_user_id' => $secret->user_id,
                'amount' => -$secretPrice,
                'transaction_type' => $typeBuyingSecret->id,
                'status' => $statusCompleted->id,
                'reference_id' => $referenceId,
                'payment_method' => 'VOUCHERS'
            ]);
            UserTransaction::create([
                'payer_id' => $userId,
                'to_user_id' => $secret->user_id,
                'amount' => $secretPrice,
                'transaction_type' => $typeSellingSecret->id,
                'status' => $statusCompleted->id,
                'reference_id' => $referenceId,
                'payment_method' => 'VOUCHERS'
            ]);
            $secret = UserUnlockSecret::firstOrCreate(
                ['user_id' => $userId, 'secret_id' => $secretId,]);
            error_log('secret = ' . $secret);
            \DB::commit();
            return [$secret, $buyerBalance];
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception('Transaction is not completed, rolling back..' . $e);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Secret $secret
     * @return \Illuminate\Http\Response
     */
    public function show(Secret $secret)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Secret $secret
     * @return \Illuminate\Http\Response
     */
    public function edit(Secret $secret)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Secret $secret
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secret $secret)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Secret $secret
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secret $secret)
    {
        //
    }
}
