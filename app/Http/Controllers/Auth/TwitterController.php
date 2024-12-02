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

class TwitterController extends Controller
{
    public function redirectToTwitter()

    {

        return Socialite::driver('twitter')->redirect();

    }

    public function handleCallback(Request $request)

    {

        $socialUser = Socialite::driver('twitter')->user();
//        dd($socialUser);
        $user = User::where('twitter_id', $socialUser->id)->first();
        if(!$user)
        {
            $email = isset($socialUser->email) ? $socialUser->email : $socialUser->nickname.'@twitter.com';
            $password = Hash::make(rand(100000,999999));

//            return view('client.cabinet.chooseType', compact('name', 'email', 'password', 'twitter_id'));
            $user = User::create(['name' => $socialUser->name, 'email' => $email,'twitter_id' => $socialUser->id, 'picture_url'=>$socialUser->avatar, 'role_id' => 4,'password' => $password, 'status' =>1, 'type'=>1]);
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
