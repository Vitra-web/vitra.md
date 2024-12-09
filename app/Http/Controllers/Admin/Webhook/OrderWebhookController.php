<?php

namespace App\Http\Controllers\Admin\Webhook;

use App\Events\MessageAnswer;
use App\Http\Controllers\Controller;


use App\Models\Mail;
use App\Models\Order;
use App\Models\User;
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

    public function webhookOdoSynchronization(Request $request){

        $manager = User::where('login',$request['login'])->orWhere('email', $request['email'])->first();
        $order = Order::where('order_number', $request['order_number']);
        $mail =  Mail::where('order_number', $request['order_number']);

        if($manager && $order) {
            $order->update(['status'=>$request['status'], 'manager_id'=>$manager->id]);
        }
        elseif($manager && $mail) {
            $mail->update(['status'=>$request['status'], 'manager_id'=>$manager->id]);
        }

        return response("ок", 200);

    }
}
