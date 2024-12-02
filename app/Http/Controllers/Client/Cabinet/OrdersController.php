<?php

namespace App\Http\Controllers\Client\Cabinet;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\AboutBenefit;
use App\Models\Order;
use App\Models\PageContent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function main( )
    {
        $title = trans('cabinet.orders');
        $user = Auth::user();

        $orders = Order::where('user_id',$user->id )->get();
        return view('client.cabinet.orders', compact('title', 'user', 'orders'));
    }


}
