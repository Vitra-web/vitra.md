<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function main(Request $request)
    {


        $title = 'Statistic';
        $mails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->when($request->source != null, function ($q) use ($request) {
            return $q->where('source',$request->source);
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

//        $newChats = Chat::where('checked', 0)->get();
        return view('panel.statistic.index', compact('title', 'mails', 'totalMails', 'consultationMails', 'contactsMails', 'vacancyMails'));
    }

    public function show(Mail $mail) {

//        dd(json_encode($mail));
        $title = 'Email from '.$mail->name;
        if($mail->status == 0)
            $mail->update(['status'=>1]);
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
}
