<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AppleController extends Controller
{
    public function redirect()

    {

        return Socialite::driver('apple')->redirect();

    }

    public function handleCallback(Request $request)

    {

        $user = Socialite::driver('apple')->user();
//        dd($user);
        $user = User::where('apple_id', $user->id)->first();
        if(!$user)
        {
            $user = User::create(['name' => $user->name, 'email' => $user->email,'apple_id' => $user->id, 'role_id' => 4,'password' => Hash::make(rand(100000,999999)), 'status' =>1]);
        }

        Auth::login($user);

        return redirect()->route('client.cabinet');

    }
}
