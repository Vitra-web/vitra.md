<?php

namespace App\Http\Controllers\Admin\Webhook;

use App\Events\MessageAnswer;
use App\Http\Controllers\Controller;


use App\Models\Order;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class OrderWebhookController extends Controller
{
    /**
     * @param Request $request
     * @return json
     */
    public function webhookHandler(Request $request){

//        dd($request);
        $result = $request['result'];

        if(isset($result)) {
            Order::where('order_number', $result['orderId'])->update(['pay_status'=>$result['status'], 'pay_id'=>$result['payId']]);
        }




            return response("ок", 200);

    }
}
