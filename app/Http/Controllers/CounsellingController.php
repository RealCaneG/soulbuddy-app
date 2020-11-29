<?php

namespace App\Http\Controllers;

use App\ApprovedUserChatContactRecord;
use App\Category;
use App\CounsellingHelperRating;
use App\CounsellingRequest;
use App\CounsellingRequestRatingRecord;
use App\Events\AcceptRequestEvent;
use App\Events\MessageEvent;
use App\Message;
use App\Notification;
use App\User;
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
        $category = Category::all('id', 'category');
        return response()->json(Category::all('id', 'category'));
    }

    public function acceptCasualCounsellingRequest(Request $request)
    {
        $requestUserId = Auth::id();
        $clientUserId = $request->client_id;
        $notification = null;

        \DB::beginTransaction();
        try {
            $counsellingRequestId = $request->request_id;
            $existingRecord = UserCounsellingRecord::where('applied_user_id', $requestUserId)
                ->where('counselling_request_id', $counsellingRequestId)->get();
            if ($existingRecord->isNotEmpty()) return \response()->json(['error' => true, 'message' => 'Duplicated record!']);

            UserCounsellingRecord::create([
                'applied_user_id' => $requestUserId,
                'counselling_request_id' => $counsellingRequestId
            ]);

            $notification = Notification::create([
                'title' => 'Counselling Request Accepted',
                'user_id' => $clientUserId,
                'from_user_id' => $requestUserId,
                'description' => Auth::user()->name . ' accepted your request!',
                'notification_type_id' => 1,
                'payload_id' => $counsellingRequestId
            ]);
            \DB::commit();
        } catch (Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }


        broadcast(new AcceptRequestEvent($notification->load('owner')));

        return \response()->json(['error' => false, 'message' => 'Request submitted']);
    }

    public function approveCasualCounsellingRequest(Request $request)
    {
        $isApproved = $request->is_approved;
        $counsellingRequestId = $request->request_id;
        $userIdToBeApproved = $request->user_id_to_approve;
        $userCounsellingRecord = UserCounsellingRecord::whereCounsellingRequestId($counsellingRequestId)->first();
        if ($userCounsellingRecord->doesntExist()) {
            return response()->json(['error' => true, 'message' => 'Unable to find the record with Id: ' . $counsellingRequestId]);
        }
        \DB::beginTransaction();
        try {
            if ($isApproved) {
                $userCounsellingRecord->fill(['status' => 'ACCEPTED'])->save();
                ApprovedUserChatContactRecord::firstOrCreate([
                    'user_id' => Auth::id(),
                    'contact_user_id' => $userIdToBeApproved,
                ]);

                ApprovedUserChatContactRecord::firstOrCreate([
                    'user_id' => $userIdToBeApproved,
                    'contact_user_id' => Auth::id(),
                ]);

                $notification = Notification::create([
                    'title' => 'Counselling Request Approved',
                    'user_id' => $userIdToBeApproved,
                    'from_user_id' => Auth::id(),
                    'description' => Auth::user()->name . ' approved your request!',
                    'notification_type_id' => 2
                ]);
            } else {
                $userCounsellingRecord->fill(['status' => 'REJECTED'])->save();
            }
            \DB::commit();
        }catch (\Exception $exception) {
            \DB::rollBack();
            return \response()->json(['error' => true, 'message' => $exception->getMessage()]);
        }

        broadcast(new AcceptRequestEvent($notification->load('owner')));

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
