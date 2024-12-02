<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }

    public function handleGoogleCallback(Request $request)

    {

        $googleUser = Socialite::driver('google')->user();
//        dd($googleUser);
        $user = User::where('email', $googleUser->email)->first();
        if(!$user)
        {

            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email,'google_id' => $googleUser->id, 'picture_url' => $googleUser->user['picture'],'role_id' => 4,'password' => Hash::make(rand(100000,999999)), 'status' =>1, 'type'=>1]);
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
