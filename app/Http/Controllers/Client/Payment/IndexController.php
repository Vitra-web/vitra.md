<?php

namespace App\Http\Controllers\Client\Payment;

use App\Classes\FormSend;
use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    public function main( )
    {
        $language= new  LanguageHandler();
        $title = $language->replace('Achitarea', 'Оплата','Payment') ;

        $products  = [];
        $productsLocale = request()->cookie('vitraProducts');
        if(Auth::user()) {
            $userProducts = UserProduct::where('user_id',Auth::user()->id )->get();
            if($userProducts) {
                foreach ($userProducts as $item) {
                    $product = Product::where('id', $item->product_id)->first();
                    if(isset($item->product_moduline) ) {
                        if($item->product_moduline) {
                            $product['price'] = json_decode($item->product_moduline)->price;
                        }
                    }
                    $data = [
                        'product'=>$product,
                        'quantity'=>$item->quantity,
                        'product_variant'=>isset($item->product_variant) ? ProductVariant::where('code', $item->product_variant)->first() : '',
                        'product_moduline'=>isset($item->product_moduline) ? json_decode($item->product_moduline) : ''
                    ];
                    $products[]= $data;


                }
            }
        } elseif($productsLocale) {
//            dd($productsLocale);
            foreach (json_decode($productsLocale) as $item) {
                $product = Product::where('id', $item->product_id)->first();
                if(isset($item->product_moduline)) {
                    if($item->product_moduline) {
                        $product['price'] = json_decode($item->product_moduline)->price;
                    }
                }
                $data = [
                    'product'=>$product,
                    'quantity'=>$item->quantity,
                    'product_variant'=>isset($item->product_variant) ? ProductVariant::where('code', $item->product_variant)->first() : '',
                    'product_moduline'=>isset($item->product_moduline) ? json_decode($item->product_moduline) : ''
                ];
                $products[] = $data;
            }
        }
        return view('client.payment.index', compact('title', 'products'));
    }

    public function postOrder(StoreRequest $request) {

        $data = $request->validated();

        // get the original IP address
//        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//            $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
//        } else {
//            $clientIP = $_SERVER['REMOTE_ADDR'];
//        }
        $clientIP = $_SERVER['REMOTE_ADDR'];


        $orderId = strval(rand(100000,999999)) ;
        $products = json_decode($data['products']);

        $items = [];
        foreach ($products as $product) {
            $items[]=[
                'id'=>strval($product->product->id),
                'name'=>$product->product->name_ro,
                'price'=>isset($product->product_variant->price)? $product->product_variant->price : $product->product->price,
                'quantity'=>$product->quantity,
            ];
        }


        $data['status'] = 'new';
        $data['order_number'] = $orderId;
        if(Auth::user()) {
            $data['user_id'] =  Auth::user()->id;
        }

//        dd($data) ;
//        dd(json_encode(json_decode($data['products']),  JSON_UNESCAPED_UNICODE ) );
        $order = Order::firstOrCreate($data);
//        $order = 1;
        $data['source'] = '0';
        $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/crm-webhook-form');
        $careerFormSend->sendVacancy($data);
        $mailData = [
            'url'=>env('APP_URL'),
//            'url'=>'https://vitranew.vitra.md',
            'date'=>date("m.d.y"),
            'products'=>$products,
            'data'=>$data,
        ];

//        dd($mailData['url']);

//        return view('client.mail.orderMail', compact('mailData'));
        if($order) {




            Mail::to($data['email'])->send(new OrderMail($mailData));
            if($data['paymentType'] == 1) {
                $post = [
                    'amount' => floatval($data['priceTotal']),
                    'currency' => "MDL",
                    "clientIp" => $clientIP,
                    "language" => 'ro',
                    "description" => 'Achitare produsele de la Vitra',
                    "clientName" => $data['name'].' '.$data['surname'],
                    "email" => $data['email'],
                    "phone" => $data['phone'],
                    "orderId" => $orderId,
                    'delivery' => floatval($data['priceDelivery']),
                    "items" => $items,
                    "callbackUrl" => env('MAIB_CALLBACK_URL'),
                    "okUrl"=>  env('MAIB_OK_URL'),
                    "failUrl"=>  env('MAIB_FAIL_URL')

                ];

//        dump($post);

                $tokenResponse =  Http::withHeaders([
                    'Content-Type: application/json',
                ])->post('https://api.maibmerchants.md/v1/generate-token', [ "projectId"=> env('MAIB_PROJECTID'),
                    "projectSecret"=> env('MAIB_PROJECTSECRET')]);
                $tokenResult = json_decode($tokenResponse, true);

dump($tokenResult);
                $response =  Http::withHeaders([
                    'Authorization' => 'Bearer ' . $tokenResult['result']['accessToken'],
                ])->post('https://api.maibmerchants.md/v1/pay', $post);
                $result = json_decode($response, true);
//dd($result);
                if($result['ok']) {
                    $order->update(['pay_id'=>$response['result']['payId']]);
                    return redirect($response['result']['payUrl']);
                } else return back()->with('error', 'Something went wrong. Try again later.');
            } else {
                return redirect()->route('client.paymentSuccess',['orderId'=> $order->order_number]);
            }
        }
    }

    public function successPage(Request $request) {
        $language= new  LanguageHandler();
        $title = $language->replace('Achitarea reușită', 'Успешная оплата','Payment success') ;

        $orderId = $request->query('orderId');


        if(Auth::user()) {
            $userProducts = UserProduct::where('user_id', Auth::user()->id)->get();
            if($userProducts) {
                foreach ($userProducts as $item) {
                    $item->delete();
                }
            }
        }


        $order = Order::where('order_number', $orderId)->first();


        return view('client.payment.success', compact('title', 'order'));
    }
    public function errorPage() {
        $language= new  LanguageHandler();
        $title = $language->replace('Achitarea nu reușită', 'Оплата не прошла','Payment is not success') ;

        return view('client.payment.error', compact('title'));
    }

    public function testMail() {
        $title = 'test Mail';
        return view('client.mail.orderMail', compact('title'));
    }
}


