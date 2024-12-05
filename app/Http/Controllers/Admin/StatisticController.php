<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    public function main(Request $request)
    {


        $title = 'Statistic';
        $mails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->when($request->source != null, function ($q) use ($request) {
            return $q->where('source',$request->source);
        })->when($request->manager_id != null, function ($q) use ($request) {
            return $q->where('manager_id',$request->manager_id);
        })->when($request->status != null, function ($q) use ($request) {
            return $q->where('status',$request->status);
        })->orderBy('created_at', 'DESC')->get();

        $totalMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->get();

        $consultationMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source', 1)->get();

        $contactsMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source', 2)->get();


        $vacancyMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->whereIn('source',[ 5, 6,7])->get();

        $managers = User::where('role_id', 3)->get();
//        $newChats = Chat::where('checked', 0)->get();
        return view('panel.statistic.index', compact('title', 'mails', 'totalMails', 'consultationMails', 'contactsMails', 'vacancyMails', 'managers'));
    }

    public function show(Mail $mail) {

//        dd(json_encode($mail));
        $title = 'Email from '.$mail->name;
        if($mail->status == 'new')
            $mail->update(['status'=>'viewed']);
        $newChats = Chat::where('checked', 0)->get();
        $managers = User::where('role_id', 3)->get();
        return view('panel.statistic.show', compact('title', 'mail', 'newChats', 'managers'));
    }

    public function changeStatus(Mail $mail, $status) {

        $mail->update(['status'=>$status]);
//        dd($mail);
        $title = 'Email from '.$mail->name;
        $newChats = Chat::where('checked', 0)->get();
        $managers = User::where('role_id', 3)->get();
        return view('panel.statistic.show', compact('title', 'mail', 'newChats', 'managers'));
//        return back()->with('success', 'Status a fost schimbat');
    }
    public function update(Request $request, Mail $mail) {

        $user = Auth::user();
        $data = $request->validate([
            'status'=>'string|nullable',
            'manager_id'=>'integer|nullable',
        ]);
        if($data['status'] == 'close') {
            $data['user_closed']= $user->id;
            if($user->role_id ==3 )
                $data['manager_id']= $user->id;
            elseif(! $data['manager_id'])
                $data['manager_id']= $user->id;
        }
        elseif($data['status'] == 'work' ) {
            $data['user_work']= $user->id;
            if($user->role_id ==3)
                $data['manager_id']= $user->id;
            elseif(! $data['manager_id'])
                $data['manager_id']= $user->id;

        }
        elseif($data['status'] == 'cancelled' ) {
            $data['user_cancelled']= $user->id;
            if($user->role_id ==3 && ! $data['manager_id'])
                $data['manager_id']= $user->id;
            elseif(! $data['manager_id'])
                $data['manager_id']= $user->id;
        }
        elseif($data['status'] == 'stopped' ) {
            $data['user_stopped']= $user->id;
            if($user->role_id ==3)
                $data['manager_id']= $user->id;
            elseif(! $data['manager_id'])
                $data['manager_id']= $user->id;
        }
        $mail->update($data);
        return redirect()->route('statistic');
    }
}
