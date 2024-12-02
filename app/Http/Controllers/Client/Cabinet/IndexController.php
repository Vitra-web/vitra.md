<?php

namespace App\Http\Controllers\Client\Cabinet;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\AboutBenefit;
use App\Models\PageContent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function main( )
    {
        $title = 'Cabinet';
        $user = Auth::user();

        return view('client.components.pageInWork', compact('title'));
//        return view('client.cabinet.index', compact('title', 'user'));
    }

    public function account() {
        $title = trans('cabinet.cont');
        $user = Auth::user();
        return view('client.cabinet.account', compact('title', 'user'));
    }

    public function updatePersonalInfo(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|min:1|string',
            'name' => 'required|min:1|string',
            'birthday' => 'required|min:1|string',

        ]);

        User::where('id', $data['user_id'])->update(['name'=>$data['name'], 'birthday'=>$data['birthday']]);

//        dd($data);

        return response()->json([
            'message' => 'Message sent successfully',
            'status'=>'ok',
            'data'=>[
                'name'=>$data['name'],
                'birthday'=>$data['birthday'],
                ]

        ]);
    }

    public function updateContactInfo(Request $request) {
        $data = $request->validate([
            'user_id' => 'required|min:1|string',
            'email' => 'required|min:1|string',
            'phone' => 'required|min:1|string',
            'addPhone' => 'required|min:1|string',

        ]);

        User::where('id', $data['user_id'])->update(['email'=>$data['email'], 'phone'=>$data['phone'], 'add_phone'=>$data['addPhone']]);

//        dd($data);

        return response()->json([
            'message' => 'Message sent successfully',
            'status'=>'ok',
            'data'=>[
                'email'=>$data['email'],
                'phone'=>$data['phone'],
                'addPhone'=>$data['addPhone'],
            ]

        ]);
    }
}
