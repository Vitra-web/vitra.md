<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    public function login(){
        return view('client.login');
    }
    public function signup(){
        return view('client.signup');
    }
    public function chooseType(User $user) {



        return view('client.cabinet.chooseType', compact('user'));
    }
    public function chooseTypePost(Request $request){
        $data =  $request->validate([
            'type'=>'required',
            'user_id'=>'nullable',
        ]);


//        dd($data);
        $user = User::where('id', $data['user_id'])->update(['type'=>$data['type']]);

        if($user) {

            return redirect()->route('client.cabinet');
        } else {
            return back()->with('message_error', 'Something went wrong');
        }
    }
    public function postLogin(Request $request){
        $request->validate([
            'email'=> 'required|string',
            'password'=>'required'
        ]);
        $data = $request->input();
//        dd($data);


        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = User::where('email',  $data['email'])->first();
//            dd($user);
            Auth::login($user);
//            Session::put('adminSession',$user->login);
            Session::put('userSession',$user->email);
            return redirect()->route('client.cabinet');
        } else {
            return redirect()->back()->with('message_error','Invalid Email or Password');
        }
    }

    public function postSignup(Request $request){
        $data = $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=>'required'
        ]);

        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];

//        dd($data);
        $user = User::where('email',  $data['email'])->first();

        if($user) {
            return redirect()->back()->with('message_error','This Email has already exist');
        }

        return view('client.cabinet.chooseType', compact('name', 'email', 'password'));

    }

    public function logout(){
        auth()->logout();
        return redirect()->route('home');
    }
}
