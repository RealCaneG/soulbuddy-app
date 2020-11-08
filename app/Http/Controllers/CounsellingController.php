<?php

namespace App\Http\Controllers;

use App\Category;
use App\CounsellingHelperRating;
use App\CounsellingRequest;
use App\CounsellingRequestRatingRecord;
use App\UserBalance;
use App\UserCounsellingRecord;
use Auth;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class CounsellingController extends Controller
{
    /**
     * @param Request $request
     */
    public function getPaginatedCounsellingRequest(Request $request)
    {
        return response()->json(['error' => false,
            'data' => CounsellingRequest::with('category')->with('owner')->orderBy('expiry_date')->paginate($request->numberOfItems)]);
    }

    public function getAppliedCounsellingRequestRecord()
    {
        return response()->json(['error => false',
        'data' => UserCounsellingRecord::where('applied_user_id', '=', Auth::id())->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \PHPUnit\Exception
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
        \DB::beginTransaction();
        try {
            UserCounsellingRecord::create([
                'applied_user_id' => $requestUserId,
                'counselling_request_id' => $request->requestId
            ]);
        } catch (Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
        \DB::commit();

        return \response()->json(['error' => false, 'message' => 'Request submitted']);
    }

    public function approveCasualCounsellingRequest(Request $request)
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

    public function dismissCounsellingSection(Request $request)
    {
        $userId = Auth::id();
        $data = \GuzzleHttp\json_decode($request->data, true);
        $requestId = $data['request_id'];
        $rating = $data['rating'];
        $helperUserId = $data['helper_id'];

        $helperRating = CounsellingHelperRating::whereKey($helperUserId);
        $helperRatingScore = $helperRating->score;
        $count = CounsellingRequestRatingRecord::where('helper_id', '=', $helperUserId)->count();
        $count = $count == 0 ? 1 : $count; // first time to be rated
        $newScore = ($helperRatingScore + $rating) / $count;

        \DB::beginTransaction();
        try {
            CounsellingRequestRatingRecord::create([
                'helper_id' => $helperUserId,
                'client_id' => $userId,
                'rating' => $rating
            ]);
            $helperRating->rating = $newScore;
            $helperRating->save();
        } catch (\PHPUnit\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
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
