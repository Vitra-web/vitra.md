<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutBenefit;
use App\Models\PageContent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $item = PageContent::where('page', 'about')->first();
        $benefits = AboutBenefit::all();
        $title = 'Despre noi pagina';
        return view('panel.about.index', compact('item', 'title', 'benefits'));

    }
    public function createBenefit()
    {
        $title = 'Adauga Beneficii';
        $benefits = AboutBenefit::all();
        return view('panel.about.createBenefits', compact( 'title', 'benefits'));
    }
//    public function show(User $user)
//    {
////        $manager = User::where('id', $user->manager_id)->first();
////        return view('user.manager.show', compact('user', 'manager'));
//    }
    public function storeBenefit(Request $request)
    {
        $data = $request->validate([
            'main_page'=>'nullable',
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'description_en' => 'nullable|min:1|string',
            'description_ro' => 'nullable|min:1|string',
            'description_ru' => 'nullable|min:1|string',
            'image' => 'nullable',
            'slider_image' => 'nullable',
            'image_mobile' => 'nullable',
            'number' => 'nullable',
            'sort_order' => 'integer',
        ]);
//        dd($data);
        if(isset($data['main_page'])){
            $data['main_page'] = (int)$data['main_page'];
        } else $data['main_page'] =0;


        $imageMain = $request->file('image');
        $imageSlider = $request->file('slider_image');
        $imageMobile = $request->file('image_mobile');

        if(isset( $imageMain)) {
            $path = Storage::disk('public')->put('/images/about' , $imageMain );
            $data['image'] = $path;
        }
        if(isset( $imageSlider)) {
            $path = Storage::disk('public')->put('/images/about' , $imageSlider );
            compressFiles($path);
            $data['slider_image'] = $path;
        }
        if(isset( $imageMobile)) {
            $pathMobile = Storage::disk('public')->put('/images/about/mobile' , $imageMobile );
            compressFiles($imageMobile);
            $data['image_mobile'] = $pathMobile;
        }
        $benefit = AboutBenefit::firstOrCreate($data);

        if($benefit) {
            return redirect()->route('about');
        } else {
            return back()->with('error', 'benefit  n-a fost creat');
        }
    }

    public function edit(PageContent $item)
    {
        return view('panel.about.edit', compact('item'));
    }

    public function editBenefit(AboutBenefit $item)
    {
        return view('panel.about.editBenefits', compact('item'));
    }

    public function updateBenefit(Request $request, AboutBenefit $item)
    {
        $data=$request->validate([
            'main_page'=>'nullable',
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'description_en' => 'nullable|min:1|string',
            'description_ro' => 'nullable|min:1|string',
            'description_ru' => 'nullable|min:1|string',
            'image' => 'nullable',
            'image_mobile' => 'nullable',
            'slider_image' => 'nullable',
            'number' => 'nullable',
            'sort_order' => 'integer',
        ]);
        if(isset($data['main_page'])){
            $data['main_page'] = (int)$data['main_page'];
        } else $data['main_page'] =0;


        $imageMain = $request->file('image');
        $imageSlider = $request->file('slider_image');
        $imageMobile = $request->file('image_mobile');

        if(isset( $imageMain)) {
            if(isset($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $path = Storage::disk('public')->put('/images/about' , $imageMain );
            $data['image'] = $path;
        }
        if(isset( $imageSlider)) {
            if(isset($item->slider_image)) {
                Storage::disk('public')->delete($item->slider_image);
            }
            $path = Storage::disk('public')->put('/images/about' , $imageSlider );
            compressFiles($path);
            $data['slider_image'] = $path;
        }

        if(isset( $imageMobile)) {
            if(isset($item->image_mobile)) {
                Storage::disk('public')->delete($item->image_mobile);
            }
            $pathMobile = Storage::disk('public')->put('/images/about/mobile' , $imageMobile );
            compressFiles($pathMobile);
            $data['image_mobile'] = $pathMobile;
        }

        $item->update($data);
        return redirect()->route('about');
    }


    public function update(Request $request, PageContent $item)
    {
       $data=$request->validate([
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'image' => 'nullable',
            'video' => 'nullable',
        ]);

        $imageMain = $request->file('image');

        if(isset( $imageMain)) {
            if(isset($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            if(isset($item->image_mobile)) {
                Storage::disk('public')->delete($item->image_mobile);
            }
            $path = Storage::disk('public')->put('/images/about' , $imageMain );
            $pathMobile = Storage::disk('public')->put('/images/about/mobile' , $imageMain );
            compressFiles($path);
            compressMobileFiles($pathMobile);
            $data['image'] = $path;
            $data['image_mobile'] = $pathMobile;
        }


        $video = $request->file('video');

        if(isset( $video)) {
            if(isset($item->video)) {
                Storage::disk('public')->delete($item->video);
            }
            $path = Storage::disk('public')->put('/images/about' , $video );
            $data['video'] = $path;
        }

        $item->update($data);
        return redirect()->route('about');

    }

    public function deleteBenefit(AboutBenefit $item)
    {
        if(isset($item->slider_image)) {
            Storage::disk('public')->delete($item->slider_image);
        }
        if(isset($item->image_mobile)) {
            Storage::disk('public')->delete($item->image_mobile);
        }
        $item->delete();
        return redirect()->route('about');
    }
}
