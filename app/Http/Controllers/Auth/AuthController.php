<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('panel.login');
    }
    public function postLogin(Request $request){
        $request->validate([
            'login'=> 'required|string',
            'password'=>'required'
        ]);
        $data = $request->input();
//        dd($data);

        if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']])) {
            Session::put('adminSession',$data['login']);
            return redirect()->route('statistic');
        } else {
            return redirect()->back()->with('message_error','Invalid Login or Password');
        }
    }


    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
