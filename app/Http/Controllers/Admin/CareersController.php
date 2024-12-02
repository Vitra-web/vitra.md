<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vacancy\StoreRequest;
use App\Http\Requests\Vacancy\UpdateRequest;
use App\Models\CareersBenefits;
use App\Models\PageContent;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareersController extends Controller
{
    public function index()
    {
        $vacancy = Vacancy::all();
        $benefits = CareersBenefits::all();
        $title = 'Cariere';
        $careersPage = PageContent::where('page', 'careers')->first();

        return view('panel.careers.index', compact('vacancy', 'title', 'careersPage', 'benefits'));

    }
    public function create()
    {
        $title = 'Adauga Post vacant';
        $items = Vacancy::all();

        return view('panel.careers.create', compact( 'items','title'));
    }

    public function createBenefit()
    {
        $title = 'Adauga Benefit';
        $items = CareersBenefits::all();

        return view('panel.careers.createBenefit', compact( 'items','title'));
    }



    public function show(Vacancy $vacancy)
    {
        return view('panel.careers.show', compact(   'vacancy'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

//        $image = $request->file('image');
//
//        if(isset( $image)) {
//            $path = Storage::disk('public')->put('/images/careers' , $image );
//            $data['image'] = $path;
//        }

        $vacancy = Vacancy::firstOrCreate($data);

      if($vacancy) {
          return redirect()->route('careers');
      } else {
          return back()->with('error', 'careers n-a fost creat');
      }
    }

    public function storeBenefit(Request $request)
    {

        $data=$request->validate([
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'sort_order' => 'required|integer',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'image' => 'nullable',
        ]);

        $image = $request->file('image');

        if(isset( $image)) {
            $path = Storage::disk('public')->put('/images/careers' , $image );
            compressFiles($path);
            $data['image'] = $path;
        }

        $benefit = CareersBenefits::firstOrCreate($data);

        if($benefit) {
            return redirect()->route('careers');
        } else {
            return back()->with('error', 'benefit n-a fost creat');
        }
    }

    public function edit(Vacancy $vacancy)
    {
            $title = 'Editarea Vacancy';

            return view('panel.careers.edit', compact( 'title',  'vacancy'));
    }

    public function update(UpdateRequest $request, Vacancy $vacancy)
    {
        $data = $request->validated();
//        $image = $request->file('image');
//
//        if(isset( $image)) {
//            if(isset($vacancy->image)) {
//                Storage::disk('public')->delete($vacancy->image);
//            }
//            $path = Storage::disk('public')->put('/images/careers' , $image );
//            $data['image'] = $path;
//        }


        $vacancy->update($data);
        return redirect()->route('careers');
    }

    public function editBenefit(CareersBenefits $benefit)
    {
        $title = 'Editarea CareersBenefits';

        return view('panel.careers.editBenefit', compact( 'title',  'benefit'));
    }

    public function updateBenefit(Request $request, CareersBenefits $benefit)
    {
        $data=$request->validate([
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'sort_order' => 'required|integer',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'image' => 'nullable',
        ]);
        $image = $request->file('image');

        if(isset( $image)) {
            if(isset($benefit->image)) {
                Storage::disk('public')->delete($benefit->image);
            }
            $path = Storage::disk('public')->put('/images/careers' , $image );

            compressFiles($path);

            $data['image'] = $path;
        }


        $benefit->update($data);
        return redirect()->route('careers');
    }

    public function delete(Vacancy $vacancy)
    {
        if(isset($vacancy->image)) {
            Storage::disk('public')->delete($vacancy->image);
        }

        $vacancy->delete();
        return redirect()->route('careers');
    }

    public function deleteBenefit(CareersBenefits $benefit)
    {
        if(isset($benefit->image)) {
            Storage::disk('public')->delete($benefit->image);
        }

        $benefit->delete();
        return redirect()->route('careers');
    }

    public function editPage(PageContent $careersPage)
    {
        return view('panel.careers.editPage', compact('careersPage'));
    }

    public function updatePage(Request $request, PageContent $careersPage)
    {
        $data=$request->validate([
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'title_second_en' => 'required|min:1|string',
            'title_second_ro' => 'required|min:1|string',
            'title_second_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'description_title_en' => 'nullable|min:1|string',
            'description_title_ro' => 'nullable|min:1|string',
            'description_title_ru' => 'nullable|min:1|string',
            'description_title_second_en' => 'required|min:1|string',
            'description_title_second_ro' => 'required|min:1|string',
            'description_title_second_ru' => 'required|min:1|string',
            'image' => 'nullable',
            'image_second' => 'nullable',
        ]);

        $imageMain = $request->file('image');
        $imageSecond = $request->file('image_second');

        if(isset( $imageMain)) {
            if(isset($careersPage->image)) {
                Storage::disk('public')->delete($careersPage->image);
            }
            if(isset($careersPage->image_mobile)) {
                Storage::disk('public')->delete($careersPage->image_mobile);
            }
            $path = Storage::disk('public')->put('/images/careers' , $imageMain );
            $pathMobile = Storage::disk('public')->put('/images/careers/mobile' , $imageMain );
            compressFiles($path);
            compressMobileFiles($pathMobile);
            $data['image'] = $path;
            $data['image_mobile'] = $pathMobile;
        }
        if(isset( $imageSecond)) {
            if(isset($careersPage->image_second)) {
                Storage::disk('public')->delete($careersPage->image_second);
            }
            $path = Storage::disk('public')->put('/images/careers' , $imageSecond );
            compressFiles($path);
            $data['image_second'] = $path;
        }

        $careersPage->update($data);
        return back()->with('success', 'Pagina a schimbat ');

    }
}
