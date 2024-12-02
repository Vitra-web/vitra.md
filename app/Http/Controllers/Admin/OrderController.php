<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Mail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
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
        })->where('status', 'open')->get();


        $closeOrders = Order::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('status', 'close')->get();


        return view('panel.orders.index', compact('title', 'orders', 'totalOrders', 'newOrders', 'openOrders', 'closeOrders'));
    }

    public function show(Order $order) {
        $title = trans('panel.see_order');

        $products = json_decode($order->products);
        foreach ($products as $product) {
//            dump($product->product_variant);
            $product->product = Product::where('id',$product->product->id )->first();
            if(isset($product->product_variant) && $product->product_variant) {
                $product->product->code_1c = $product->product_variant->code;
                $product->product->price = $product->product_variant->price;
                $product->product->dimension = $product->product_variant->dimension;

            }
        }

//        dd($products);
        return view('panel.orders.edit', compact('title', 'order', 'products'));

    }

    public function update(Order $order, Request $request) {

        $data= $request->validate([
            'status'=>'required|string',
            'paymentType'=>'required|string',
            'deliveryType'=>'required|string',
        ]);

        $order->update(['status'=>$data['status'], 'paymentType'=>$data['paymentType'],'deliveryType'=>$data['deliveryType'] ]);

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
