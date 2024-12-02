<?php

namespace App\Http\Controllers\Client;

use App\Classes\FormSend;
use App\Http\Controllers\Controller;
use App\Mail\ConsultationMail;
use App\Mail\ContactMail;
use App\Mail\VacancyMail;
use App\Models\Product;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    public function mainPage(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:1|string',
            'email' => 'nullable|email|string',
            'phone' => 'required|min:1|string',
            'newsNotification' => 'nullable',
        ]);

        $data['source'] = 1;

        $userPath = request()->cookie('userPath');
        $data['user_path'] = $userPath;
        \App\Models\Mail::firstOrCreate($data);
        $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/crm-webhook-form');
        $careerFormSend->sendVacancy($data);
//        Mail::to('info@vitra.md')->send(new ContactMail($data));
        return response()->json([
            'message' => 'Message sent successfully',
            'status'=>'ok',
            'userPath'=>$userPath
        ]);
    }


    public function consultation(Request $request) {
       $data = $request->validate([
            'name' => 'required|min:1|string',
            'phone' => 'required|min:1|string',
            'email' => 'nullable|email|string',
            'message' => 'nullable|min:1|string',
            'product_id' => 'nullable',
        ]);
        $userPath = request()->cookie('userPath');
       $data['source'] = 1;
        $data['user_path'] = $userPath;
       \App\Models\Mail::firstOrCreate($data);
       if($data['product_id']) {
           $product = Product::where('id',$data['product_id'] )->first();
           if($product) {
               $data['product_path'] = route('client.product', [$product->categoryId, $product->subcategoryId, $product->slug ]);
           }
       }
       unset($data['product_id']);
//       dd($data);
        $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/crm-webhook-form');
        $careerFormSend->sendVacancy($data);
//        Mail::to('info@vitra.md')->send(new ConsultationMail($data));
        return back()->with(['success'=> trans('labels.email_was_send')]);
    }

    public function contact(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:1|string',
            'email' => 'nullable|email|string',
            'phone' => 'required|min:1|string',
            'message' => 'required|min:1|string',
        ]);

//        dd($data);
        $userPath = request()->cookie('userPath');
        $data['user_path'] = $userPath;
        $data['source'] = 2;
        \App\Models\Mail::firstOrCreate($data);
//        Mail::to('info@vitra.md')->send(new ContactMail($data));
        $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/crm-webhook-form');
        $careerFormSend->sendVacancy($data);
        return response()->json([
            'message' => 'Message sent successfully',
            'status'=>'ok',
        ]);
    }

    public function feedback(Request $request) {
        $data = $request->validate([
            'name' => 'required|min:1|string',
            'email' => 'required|min:1|string',

        ]);

//        dd($data);
        $userPath = request()->cookie('userPath');
        $data['user_path'] = $userPath;
        $data['source'] = 3;
        \App\Models\Mail::firstOrCreate($data);
        $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/crm-webhook-form');
        $careerFormSend->sendVacancy($data);
//        Mail::to('info@vitra.md')->send(new ContactMail($data));
        return response()->json([
            'message' => 'Message sent successfully',
            'status'=>'ok',
        ]);
    }

    public function about(Request $request) {

        $data = $request->validate([
            'name' => 'required|min:1|string',
            'email' => 'nullable|email|string',
            'phone' => 'required|min:1|string',
            'file' => 'required',
        ]);


        $file = $request->file('file');
        $data['source'] = 4;
        if(isset( $file)) {
            $path = Storage::disk('public')->put('/images/cv' , $file );
            $data['file'] = $path;
        }
        $userPath = request()->cookie('userPath');
        $data['user_path'] = $userPath;
//                dd($data);
        \App\Models\Mail::firstOrCreate($data);
//dd($data);
        $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/crm-webhook-form');
        $careerFormSend->sendVacancy($data);
//        dd($data);
//        Mail::to('iura.radulov@gmail.com')->send(new VacancyMail($data, $file));

        return back()->with('success', trans('labels.email_was_send'));
//        return response()->json([
//            'message' => 'Message sent successfully',
//            'status'=>'ok',
//        ]);
    }


    public function vacancy(Request $request) {

        $data = $request->validate([
            'name' => 'required|min:1|string',
            'email' => 'required|email|string',
            'phone' => 'required|min:1|string',
            'vacancy_id' => 'required',
            'file' => 'required',
            'vacancyNotification' => 'nullable',
            'newsNotification' => 'nullable',
        ]);


        $file = $request->file('file');
        $data['source'] = 5;
        if(isset( $file)) {
            $path = Storage::disk('public')->put('/images/cv' , $file );
            $data['file'] = $path;
        }
        $userPath = request()->cookie('userPath');
        $data['user_path'] = $userPath;
        \App\Models\Mail::firstOrCreate($data);


        $vacancy = Vacancy::where('id', $data['vacancy_id'])->first();
        $data['vacancy']= $vacancy->name_ro;

      $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/hr-webhook-form');
        $careerFormSend->sendVacancy($data);
//        dd($data);
//        Mail::to('iura.radulov@gmail.com')->send(new VacancyMail($data, $file));

        return back()->with('success', trans('labels.email_was_send'));
//        return response()->json([
//            'message' => 'Message sent successfully',
//            'status'=>'ok',
//        ]);
    }


    public function vacancyFull(Request $request) {

        $data = $request->validate([
            'name' => 'required|min:1|string',
            'surname' => 'required|min:1|string',
            'email' => 'required|email|string',
            'phone' => 'required|min:1|string',
            'addition_phone' => 'nullable',
            'birthday' => 'required|min:1|string',
            'location' => 'required|min:1|string',
            'nation' => 'nullable|min:1|string',
            'sex' => 'required',
            'vacancy_id' => 'required',
            'user_photo' => 'required',
            'studies' => 'required|min:1|string',
            'experiences' => 'required',
            'languages' => 'nullable',
            'skills' => 'nullable',
            'curse' => 'nullable',
            'hobby' => 'nullable',
            'license' => 'nullable',
            'skills_description' => 'nullable',
            'vacancyNotification' => 'nullable',
            'newsNotification' => 'nullable',
        ]);


        $file = $request->file('user_photo');
        $data['source'] = 6;
        $data['license'] = json_encode($data['license']);
        $data['vacancyNotification'] = intval($data['vacancyNotification']);
        $data['newsNotification'] = intval($data['newsNotification']);
        if(isset( $file)) {
            $path = Storage::disk('public')->put('/images/cv' , $file );
            $data['user_photo'] = $path;
        }
        $userPath = request()->cookie('userPath');
        $data['user_path'] = $userPath;

        \App\Models\Mail::firstOrCreate($data);

        $vacancy = Vacancy::where('id', $data['vacancy_id'])->first();
        $data['vacancy']= $vacancy->name_ro;
        $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/hr-webhook-form');
        $careerFormSend->sendVacancy($data);

//        Mail::to('iura.radulov@gmail.com')->send(new VacancyMail($data, $file));

        return back()->with('success', trans('labels.email_was_send'));
    }

    public function vacancySpecial(Request $request) {
        $data = $request->validate([
            'file' => 'required',
            'specialisation' => 'required|min:1|string',
            'message' => 'required|min:1|string',
        ]);
        $data['source'] = 7;
        $file = $request->file('file');
        if(isset( $file)) {
            $path = Storage::disk('public')->put('/images/cv' , $file );
            $data['file'] = $path;
        }
        $userPath = request()->cookie('userPath');
        $data['user_path'] = $userPath;

        \App\Models\Mail::firstOrCreate($data);
//        Mail::to('iura.radulov@gmail.com')->send(new VacancyMail($data, $file));
        $careerFormSend = new FormSend('https://vitraserv1c.vitra.md/hr-webhook-form');
        $careerFormSend->sendVacancy($data);
        return back()->with('success', trans('labels.email_was_send'));
//        return response()->json([
//            'message' => 'Message sent successfully',
//            'status'=>'ok',
//        ]);

    }



}
