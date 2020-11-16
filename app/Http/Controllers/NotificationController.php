<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getAllUnreadNotification()
    {
        return response()->json([
            'data' => Notification::where('user_id', '=', \Auth::id())
                ->where('is_read', '=', false)->orderBy('created_at')->get(),
            'status' => 'success']);
    }

    public function modifyNotificationStatus(Request $request)
    {
        $notificationId = $request->notification_id;
        $isRead = $request->is_read;

        $notification = Notification::where('id', '=', $notificationId)->first();
        if ($notification == null) return response()->json(['error' => true, 'message' => 'Notification not exist!']); ;
        \DB::beginTransaction();
        try {
            $notification->fill(['is_read' => $isRead])->save();
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
            return response()->json(['error' => true, 'message' => $exception->getMessage()]);
        }

        return response()->json(['error' => false, 'data' => $notification]);
    }
}
