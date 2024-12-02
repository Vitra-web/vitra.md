<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LinkedinController extends Controller
{
    public function redirect()

    {
        $clientId = config('services.linkedin.client_id');

        $redirectUri = config('services.linkedin.redirect');

        $scope = 'openid%20profile%20email';

        $response_type = 'code';

        // $state = bin2hex(random_bytes(16));

        // session(['linkedin_state' => $state]); //optional

        // if you are creating state then you also need to pass in url

        return redirect("https://www.linkedin.com/oauth/v2/authorization?response_type=$response_type&client_id=$clientId&redirect_uri=$redirectUri&scope=$scope");

    }

    public function handleCallback(Request $request)

    {
        // $state = $request->query('state');

        //  Verify the state parameter to prevent CSRF attacks

        // if (!$state || $state !== $request->session()->pull('linkedin_state')) {

        //     return response()->json(['error' => 'Invalid state'], 400);

        // }

        $code = $request->query('code');

        if (empty($code)) {

            return response()->json(['error' => 'Authorization code not provided'], 400);

        }

        $clientId = config('services.linkedin.client_id');

        $clientSecret = config('services.linkedin.client_secret');

        $redirectUri = config('services.linkedin.redirect');

        $response = Http::asForm()->post('https://www.linkedin.com/oauth/v2/accessToken', [
            'code'          => $code,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri'  => $redirectUri,
            'grant_type'    => 'authorization_code',
        ]);

        $accessToken = $response->json('access_token');

        $userData = $this->getUserData($accessToken);

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {

            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'linkedin_id' => $userData['sub'],
                'picture_url'   => $userData['picture'],
                'role_id' => 4,
                'password' => Hash::make(rand(100000,999999)),
                'status' =>1,
                'type' =>1
            ]);
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
//        $user = $this->findOrCreateUser($userData);

//        $userRecord = User::where('email', $user['email'])->where('linkedin_id', $user['linkedin_id'])->first();
//
//        if ($userRecord) {
//            Auth::login($userRecord);
//
//            return redirect()->route('client.cabinet'); //Redirect the user where you want
//
//        } else {
//            return redirect()->route('client.login');
//        }


    }

    private function getUserData($accessToken)

    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('https://api.linkedin.com/v2/userinfo');

        return $response->json();

    }

    private function findOrCreateUser($userData)

    {
        $user = User::where('email', $userData['email'])->first();

        if (!$user) {

            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'linkedin_id' => $userData['sub'],
                'picture_url'   => $userData['picture'],
                'role_id' => 4,
                'password' => Hash::make(rand(100000,999999)),
                'status' =>1,
                'type' =>1
            ]);
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
