<?php

namespace App\Http\Controllers\Admin;

use App\Classes\FormSend;
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
        })->when(Auth::user()->role_id == 3 || Auth::user()->role_id == 5 , function ($q) use ($request) {
            return $q->whereIn('source',[1, 2, 3, 4]);
        })->when(Auth::user()->role_id == 6 , function ($q) use ($request) {
            return $q->whereIn('source',[5,6,7]);
        })->when($request->status != null, function ($q) use ($request) {
            return $q->where('status',$request->status);
        })->orderBy('created_at', 'DESC')->get();

        $totalMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->get();

        $totalConsultationMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->whereIn('source', [1, 2, 3, 4])->get();

        $totalVacancyMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->whereIn('source', [5,6,7])->get();

        $consultationMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source', 1)->get();

        $contactsMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source', 2)->get();

        $catalogsMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source', 3)->get();

        $companyMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source', 4)->get();

        $vacancyCvMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source',5)->get();

        $vacancyFullMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source',6)->get();
        $vacancySpecialMails = Mail::when($request->date_from != null && $request->date_to != null, function ($q) use ($request) {
            return $q->whereBetween('created_at', [$request->date_from, $request->date_to]);
        })->where('source',7)->get();

        $managers = User::where('role_id', 3)->get();
//        $newChats = Chat::where('checked', 0)->get();
        return view('panel.statistic.index', compact('title', 'mails', 'totalMails', 'consultationMails', 'contactsMails', 'totalConsultationMails',
            'totalVacancyMails', 'catalogsMails', 'companyMails', 'vacancyCvMails', 'vacancyFullMails', 'vacancySpecialMails',  'managers'));
    }

    public function show(Mail $mail) {

//        dd(json_encode($mail));
        $title = 'Email from '.$mail->name;
        if($mail->status == 'new')
            $mail->update(['status'=>'viewed']);

        if(Auth::user()->role_id == 3) {
            $userViewed = json_decode($mail->user_viewed);
            if($userViewed && count($userViewed) >0) {
                $addManager = 0;
             foreach ($userViewed as $item) {
                 if($item->id == Auth::user()->id) {
                     break;
                 } else $addManager = 1;
             }
             if($addManager) {
                 $userViewed[]= [
                     'id'=>Auth::user()->id,
                     'name'=>Auth::user()->name,
                 ];
                 $mail->update(['user_viewed'=>json_encode($userViewed)]);
             }
            } else {
                $userViewed = [
                    'id'=>Auth::user()->id,
                    'name'=>Auth::user()->name,
                ];
                $mail->update(['user_viewed' => json_encode([$userViewed])]);
            };
        }
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
        if($data['status'] == 'work') {
            $data['user_work']= $user->id;
        }
        elseif($data['status'] == 'offer') {
            $data['user_offer']= $user->id;

        }
        elseif($data['status'] == 'won') {
            $data['user_won']= $user->id;

        }
        elseif($data['status'] == 'visit') {
            $data['user_visit']= $user->id;
        }

        elseif($data['status'] == 'lost') {
            $data['user_lost']= $user->id;
        }

        if($user->role_id ==3 )
            $data['manager_id']= $user->id;
        elseif(! $data['manager_id'])
            $data['manager_id']= $user->id;

        if($data['manager_id'])
            $manager = User::where('id', $data['manager_id'])->first() ;
        else $manager = $user;

        $synchronizationData = [
            "order_number"=> $mail->order_number,
           "manager_email"=> $manager->email,
           "manager_login"=> $manager->login,
           "status"=> $data['status'],
        ];

        if($data['status'] != 'viewed') {
            $syncSend = new FormSend('https://vitraserv1c.vitra.md/sync-callback-crm');
            $syncSend->sendVacancy($synchronizationData);
        }


        $mail->update($data);
        return redirect()->route('statistic');
    }
}
