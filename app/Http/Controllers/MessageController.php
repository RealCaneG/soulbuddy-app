<?php

namespace App\Http\Controllers;

use App\ApprovedUserChatContactRecord;
use App\Events\MessageEvent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Json;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat.chat');
    }

    public function fetchAll()
    {
        return Message::with('user')->get();
    }

    public function getApprovedUserList()
    {
        $contactList = ApprovedUserChatContactRecord::where('user_id', '=', \Auth::id())
            ->where('status', '=', 'active')->with('owner', 'contactUser')->get();
        return response()->json(['error => false',
            'data' => $contactList]);
    }

    public function fetchAllWithUserId()
    {
        $userId = \Auth::id();
        error_log($userId);
        $messages = Message::where('to_user_id', $userId)
            ->orWhere('user_id', $userId)->with('user', 'toUser')->get();

        foreach ($messages as $msg) {
            $userId = ($msg->user_id == $userId) ? $msg->to_user_id : $msg->user_id;
            $msg->key = $userId;
        }
        $messages = $messages->groupBy('key')->sortBy('created_at');
//        error_log($messages->all());
        return response()->json(['data' => $messages->all(), 'status' => 'success']);
    }

    public function sendMessage(Request $request)
    {
        $chat = Message::create(['to_user_id' => $request->user_id, 'user_id' => \Auth::id(), 'message' => $request->message]);

        broadcast(new MessageEvent($chat->load('user')))->toOthers();

        return response()->json(['status' => 'success']);
    }
}
