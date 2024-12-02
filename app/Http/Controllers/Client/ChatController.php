<?php

namespace App\Http\Controllers\Client;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function sendMessage(Request $request) {
        $userId = $request->input('userId');
        $industryId = $request->input('industryId');
        $message = $request->input('message');


//dump($username);
//dd($message);
        $data = [
          'industry_id'=>  $industryId,
          'user_id'=>  $userId,
          'message'=>  $message,
          'checked'=>  0,
        ];

        $existingChat = Chat::where('user_id', $userId)->where('industry_id', $industryId)->first();
        if(isset($existingChat)) {
            $existingChat->update(['checked'=> 0]);
            ChatMessage::firstOrCreate(['chat_id'=>$existingChat->id, 'message'=>$message, 'checked'=>0, 'type'=>'send']);
        } else {
            $chat =  Chat::firstOrCreate($data);
            ChatMessage::firstOrCreate(['chat_id'=>$chat->id, 'message'=>$message, 'checked'=>0, 'type'=>'send']);
        }


        $data = json_encode($data, JSON_UNESCAPED_UNICODE );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://vitraserv1c.vitra.md/vitra/livechat',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
//                'Authorization: Token '.env('MFO_TOKEN'),
                'Accept-Charset: utf-8'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        event(new MessageSent($userId, $industryId, $message));



            return response()->json([
                'message' => 'Message sent successfully',
            ]);


    }
}
