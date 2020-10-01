<?php

namespace App\Http\Controllers;

use App\Category;
use App\CounsellingRequest;
use App\User;
use App\UserBalance;
use App\UserCounsellingRecord;
use Auth;
use http\Env\Response;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class CounsellingController extends Controller
{
    /**
     * @param Request $request
     */
    public function getPaginatedCounsellingRequest(Request $request)
    {
        return CounsellingRequest::with('category')->with('owner')->orderBy('expiry_date')->paginate($request->numberOfItems);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCounsellingRequest(Request $request)
    {
        $user = Auth::user();
        $data = \GuzzleHttp\json_decode($request->data, true);
        error_log($data['category']);
        error_log($user);
        if ($this->deductVouchers($user->id)) {
            \DB::beginTransaction();
            try {
                $counsellingRequest = CounsellingRequest::create([
                    'category_id' => $data['category'],
                    'expiry_date' => $data['date'],
                    'subject' => $data['subject'],
                    'description' => $data['description'],
                    'maker_id' => $user->id
                ]);
            } catch (\Exception $exception) {
                \DB::rollBack();
                throw $exception;
            }
            \DB::commit();;
            return response()->json(['error' => 'false', 'data' => $counsellingRequest]);
        } else {
            return response()->json(['error' => 'true', 'message' => 'User does not have enough voucher!']);
        }

    }

    public function getAllCategories(Request $request)
    {
        return response()->json(Category::all('id', 'category'));
    }

    public function acceptCasualCounsellingRequest(Request $request)
    {
        $requestUserId = Auth::id();
        $counsellingRequestId = $request->requestId;
        $userCounsellingRecord = new UserCounsellingRecord();
        $userCounsellingRecord->appliedUserId = $requestUserId;
        $userCounsellingRecord->counsellingRequestId = $counsellingRequestId;
        \DB::beginTransaction();
        $userCounsellingRecord->save();
        \DB::commit();

        return \response()->json(['error'=> false, 'message' => 'Request submitted']);
    }

    public function amendCasualCounsellingRequest(Request $request)
    {
        $action = $request->action;
        $counsellingRequestId = $request->counsellingRequestId;
        $userCounsellingRecord = UserCounsellingRecord::whereKey($counsellingRequestId)->first();
        if ($userCounsellingRecord === null) {
            return response()->json(['error' => true, 'message' => 'Unable to find the record with Id: ' . $counsellingRequestId]);
        }
        $action . equalToIgnoringCase('ACCEPT') ?
            $userCounsellingRecord->status = 'ACCEPTED' : $userCounsellingRecord->status = 'REJECTED';
        \DB::beginTransaction();
        $userCounsellingRecord->save();
        \DB::commit();

        return \response()->json(['error' => false, 'message' => 'The request has been successfully amended']);
    }

    private function deductVouchers(string $userId)
    {
        $userBalance = UserBalance::whereUserId($userId)->first();
        if ($userBalance->balance - 5 < 0) return false;

        \DB::beginTransaction();
        try {
            $balance = $userBalance->balance;
            $userBalance->balance = $balance + 5;
            $userBalance->save();
        } catch (\PHPUnit\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
        \DB::commit();
        return true;

    }
}
