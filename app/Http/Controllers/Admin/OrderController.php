<?php

namespace App\Http\Controllers\Admin;

use App\Classes\FormSend;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Mail;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function main(Request $request)
    {


        $title = trans('panel.orders');
        $orders = Order::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->when($request->status != null, function ($q) use ($request) {
            return $q->where('status',$request->status);
        })->when($request->manager_id != null, function ($q) use ($request) {
            return $q->where('manager_id',$request->manager_id);
        })->when($request->deliveryType != null, function ($q) use ($request) {
            return $q->where('deliveryType',$request->deliveryType);
        })->when($request->paymentType != null, function ($q) use ($request) {
            return $q->where('paymentType',$request->paymentType);
        })->orderBy('created_at', 'DESC')->get();

        $totalOrders = Order::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->get();

        $newOrders = Order::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('status', 'new')->get();

        $openOrders = Order::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('status', 'work')->get();


        $closeOrders = Order::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('status', 'offer')->get();

        $managers = User::where('role_id', 3)->get();

        return view('panel.orders.index', compact('title', 'orders', 'totalOrders', 'newOrders', 'openOrders', 'closeOrders', 'managers'));
    }

    public function show(Order $order) {
        $title = trans('panel.see_order');

        $managers = User::where('role_id', 3)->get();
        $products = json_decode($order->products);
        if($order->status == 'new')
            $order->update(['status'=>'viewed']);

        if(Auth::user()->role_id == 3) {
            $userViewed = json_decode($order->user_viewed);
            if($userViewed && count($userViewed) >0) {
                $addManager = 0;
                foreach ($userViewed as $item) {
                    if($item->id == Auth::user()->id) {
                        break;
                    } else $addManager = 1;
                }
                if($addManager) {
                    $userViewed[]= [
                        'id'=>Auth::user()->id,
                        'name'=>Auth::user()->name,
                    ];
                    $order->update(['user_viewed'=>json_encode($userViewed)]);
                }
            } else {
                $userViewed = [
                    'id'=>Auth::user()->id,
                    'name'=>Auth::user()->name,
                ];
                $order->update(['user_viewed' => json_encode([$userViewed])]);
            };
        }

        foreach ($products as $product) {
//            dump($product->product_variant);
            $product->product = Product::where('id',$product->product->id )->first();
            if(isset($product->product_variant) && $product->product_variant) {
                $product->product->code_1c = $product->product_variant->code;
                $product->product->price = $product->product_variant->price;
                $product->product->dimension = $product->product_variant->dimension;

            }
        }

//        if(Auth::user()->id ==1)
//        dd($products);

        return view('panel.orders.edit', compact('title', 'order', 'products', 'managers'));

    }

    public function update(Order $order, Request $request) {

        $data= $request->validate([
            'status'=>'required|string',
            'manager_id'=>'integer|nullable',
            'paymentType'=>'required|string',
            'deliveryType'=>'required|string',
        ]);
        $user = Auth::user();

        if($data['status'] == 'work') {
            $data['user_work']= $user->id;
        }
        elseif($data['status'] == 'offer') {
            $data['user_offer']= $user->id;

        }
        elseif($data['status'] == 'won') {
            $data['user_won']= $user->id;

        }
        elseif($data['status'] == 'visit') {
            $data['user_visit']= $user->id;
        }

        elseif($data['status'] == 'lost') {
            $data['user_lost']= $user->id;
        }

        if($user->role_id ==3 )
            $data['manager_id']= $user->id;
        elseif(! $data['manager_id'])
            $data['manager_id']= $user->id;

        if($data['manager_id'])
            $manager = User::where('id', $data['manager_id'])->first() ;
        else $manager = $user;

        $synchronizationData = [
            "order_number"=> $order->order_number,
            "manager_email"=> $manager->email,
            "manager_login"=> $manager->login,
            "status"=> $data['status'],
        ];

        if($data['status'] != 'viewed') {
            $syncSend = new FormSend('https://vitraserv1c.vitra.md/sync-callback-crm');
            $syncSend->sendVacancy($synchronizationData);
        }

        $order->update($data);

        return redirect()->route('orders');


    }

    public function check(Order $order) {

        $tokenResponse =  Http::withHeaders([
            'Content-Type: application/json',
        ])->post('https://api.maibmerchants.md/v1/generate-token', [ "projectId"=> env('MAIB_PROJECTID'),
            "projectSecret"=> env('MAIB_PROJECTSECRET')]);
        $tokenResult = json_decode($tokenResponse, true);

        $response =  Http::withHeaders([
            'Authorization' => 'Bearer ' . $tokenResult['result']['accessToken'],
        ])->get('https://api.maibmerchants.md/v1/pay-info/'.$order->pay_id);
        $result = json_decode($response, true);

//        dd($result);
        if($result['ok']) {
            return back()->with('flash_message_success', 'pay status - '.$result['result']['status']);
        } else return back()->with('flash_message_error', 'Something was wrong');

    }

    public function return(Order $order) {

        $tokenResponse =  Http::withHeaders([
            'Content-Type: application/json',
        ])->post('https://api.maibmerchants.md/v1/generate-token', [ "projectId"=> env('MAIB_PROJECTID'),
            "projectSecret"=> env('MAIB_PROJECTSECRET')]);
        $tokenResult = json_decode($tokenResponse, true);


        $post =[
            'payId'=>$order->pay_id,
            'refundAmount'=>$order->priceTotal,
        ];
        $response =  Http::withHeaders([
            'Authorization' => 'Bearer ' . $tokenResult['result']['accessToken'],
        ])->post('https://api.maibmerchants.md/v1/refund', $post);
        $result = json_decode($response, true);

        if($result['ok']) {
            $order->update(['status'=>'return']);
            return back()->with('flash_message_success', 'plata a fost returnată');
        } else return back()->with('flash_message_error', 'Something was wrong');


    }

}
