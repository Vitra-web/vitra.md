<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Slider\StoreRequest;
use App\Http\Requests\Slider\UpdateRequest;
use App\Models\Category;

use App\Models\Industry;
use App\Models\Slider;
use App\Models\SliderCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $title = 'Sliders';
        return view('panel.slider.index', compact('sliders', 'title'));
    }

    public function create()
    {
        $title = 'Adauga Slider';
        $sliders = Slider::all();
        $sliderCategories = SliderCategory::all();
        return view('panel.slider.create', compact( 'title', 'sliders', 'sliderCategories'));
    }

    public function createCategory()
    {
        $title = 'Adauga Slider Category';

        return view('panel.slider.createCategory', compact( 'title'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);

        $sliderCategory = SliderCategory::firstOrCreate($data);

        if($sliderCategory) {
            return back()->with('success', 'slider category a fost adaugat');
        } else {
            return back()->with('error', 'slider category n-a fost creat');
        }
    }

    public function show(Slider $slider)
    {
        return view('panel.slider.show', compact(   'slider'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $image = $request->file('image');
        $imageMobile = $request->file('image_mobile');
        $video = $request->file('video');

        if(isset( $image)) {
            $path = Storage::disk('public')->put('/images/slider' , $image );
            compressFiles($path);
            $data['image'] = $path;
        }
        if(isset( $imageMobile)) {
            $pathMobile = Storage::disk('public')->put('/images/slider/mobile' , $imageMobile );
            compressFiles($pathMobile);
            $data['image_mobile'] = $pathMobile;
        }

        if(isset( $video)) {
            $path = Storage::disk('public')->put('/images/slider' , $video );
            $data['video'] = $path;
        }
        $slider = Slider::firstOrCreate($data);

        if($slider) {
            return redirect()->route('slider');
        } else {
            return back()->with('error', 'slider n-a fost creat');
        }
    }

    public function edit(Slider $slider)
    {

        $sliderCategories = SliderCategory::all();
        return view('panel.slider.edit', compact(  'sliderCategories', 'slider'));
    }

    public function update(UpdateRequest $request, Slider $slider)
    {
        $data = $request->validated();

        $image = $request->file('image');
        $imageMobile = $request->file('image_mobile');
        $video = $request->file('video');

        if(isset( $image)) {
            if(isset($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $path = Storage::disk('public')->put('/images/slider' , $image );
            compressFiles($path,);
            $data['image'] = $path;
        }

        if(isset( $imageMobile)) {
            if(isset($slider->image_mobile)) {
                Storage::disk('public')->delete($slider->image_mobile);
            }
           $pathMobile = Storage::disk('public')->put('/images/slider/mobile' , $imageMobile );
            compressFiles($pathMobile,);
            $data['image_mobile'] = $pathMobile;
        }
        if(isset( $video)) {
            if(isset($slider->video)) {
                Storage::disk('public')->delete($slider->video);
            }
            $path = Storage::disk('public')->put('/images/slider' , $video );
            $data['video'] = $path;
        }
        $slider->update($data);
        return back()->with('success', 'Slider a schimbat');
    }

    public function delete(Slider $slider)
    {
        if(isset($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        if(isset($slider->image_mobile)) {
            Storage::disk('public')->delete($slider->image_mobile);
        }
        if(isset($slider->video)) {
            Storage::disk('public')->delete($slider->video);
        }
        $slider->delete();
        return redirect()->route('slider');
    }


}
