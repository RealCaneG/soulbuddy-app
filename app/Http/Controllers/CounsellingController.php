<?php

namespace App\Http\Controllers;

use App\Category;
use App\CounsellingRequest;
use App\UserBalance;
use Illuminate\Http\Request;
use Auth;

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
        $userBalance = UserBalance::whereUserId($user->id)->first();
        if ($this->deductVouchers($user->id)) {
            $counsellingRequest = CounsellingRequest::create([
                'category_id' => $data['category'],
                'expiry_date' => $data['date'],
                'subject' => $data['subject'],
                'description' => $data['description'],
                'maker_id' => $user->id
            ]);
            return response()->json(['error' => 'false', 'data' => $counsellingRequest]);
        } else {
            return response()->json(['error' => 'true', 'message' => 'User does not have enough voucher!']);
        }

    }

    public function getAllCategories(Request $request)
    {
        return response()->json(Category::all('id', 'category'));
    }

    private function deductVouchers(string $userId)
    {
        $userBalance = UserBalance::whereUserId($userId)->first();
        if ($userBalance->balance - 5 > 0) {
            $balance = $userBalance->balance;
            $userBalance->balance = $balance + 5;
            $userBalance->save();
            return true;
        }
        return false;
    }
}
