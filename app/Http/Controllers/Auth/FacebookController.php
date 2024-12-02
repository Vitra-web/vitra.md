<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirect()

    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleCallback(Request $request)

    {
        $user = Socialite::driver('facebook')->user();
//        dd($user);
        $user = User::where('facebook_id', $user->id)->first();
        if(!$user)
        {

            $user = User::create(['name' => $user->name, 'email' => $user->email,'facebook_id' => $user->id, 'role_id' => 4,'password' => Hash::make(rand(100000,999999)), 'status' =>1, 'type'=>1]);
            if($user) {
                Auth::login($user);
                Session::put('userSession',$user->email);
                return redirect()->route('client.chooseType', $user->id);
            } else {
                return back()->with('message_error', 'Something went wrong');
            }

        }

        Auth::login($user);

        return redirect()->route('client.cabinet');

    }
}
