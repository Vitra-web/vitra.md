<?php

namespace App\Http\Controllers\Admin\Webhook;

use App\Events\MessageAnswer;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class ChatWebhookController extends Controller
{
    /**
     * @param Request $request
     * @return json
     */
    public function webhookHandler(Request $request){

//        dd($request);
        $userId = $request['user_id'];
        $industryId= $request['industry_id'];
        $message= $request['message'];

        event(new MessageAnswer($userId, $industryId, $message));

            return response("ок", 200);

    }
}
