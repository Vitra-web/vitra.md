<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageAnswer;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Chat';
        $chats = Chat::when($request->industry != null, function ($q) use ($request) {
            return $q->where('industry_id', $request->industry);
        })->when($request->checked != null, function ($q) use ($request) {
            return $q->where('checked', $request->checked);
        })->orderBy('checked', 'ASC')->get();

        $newChats = Chat::where('checked', 0)->get();
        return view('panel.chat.index',compact('title', 'chats', 'newChats'));
    }
    public function show(Chat $chat)
    {
        $title = 'Chat';

        if($chat->checked == 0)
        $chat->update(['checked'=>1]);
        $messages = $chat->messages;
        $newChats = Chat::where('checked', 0)->get();

        return view('panel.chat.show',compact('title',  'chat', 'messages', 'newChats'));
    }
    public function sendMessage(Request $request) {
        $userId = $request->input('userId');
        $industryId = $request->input('industryId');
        $message = $request->input('message');


        $data = [
            'industry_id'=>  $industryId,
            'user_id'=>  $userId,
            'message'=>  $message,
            'checked'=>  0,
        ];

        $existingChat = Chat::where('user_id', $userId)->where('industry_id', $industryId)->first();
        $existingChat->update(['checked'=>2]);
        if(isset($existingChat)) {
            ChatMessage::firstOrCreate(['chat_id'=>$existingChat->id, 'message'=>$message, 'checked'=>0,'type'=>'answer']);
        } else {
            $chat =  Chat::firstOrCreate($data);
            ChatMessage::firstOrCreate(['chat_id'=>$chat->id, 'message'=>$message, 'checked'=>0, 'type'=>'answer']);
        }


        event(new MessageAnswer($userId, $industryId, $message));



        return response()->json([
            'message' => 'Message sent successfully',
        ]);


    }
}
