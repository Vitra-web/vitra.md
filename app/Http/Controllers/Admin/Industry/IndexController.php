<?php

namespace App\Http\Controllers\Admin\Industry;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Industry\StoreRequest;
use App\Http\Requests\Industry\UpdateRequest;
use App\Models\Category;
use App\Models\CategoryIdeaProduct;
use App\Models\Industry;
use App\Models\IndustryCategory;
use App\Models\IndustryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $language= new  LanguageHandler();
        $industries = Industry::all();
        $title = $language->replace('Industrii', 'Индустрии','Industries') ;
        return view('panel.industry.index', compact('industries', 'title'));

    }
    public function create()
    {
        $language= new  LanguageHandler();
        $title = $language->replace('Adauga Industrie', 'Добавить индустрию','Add industry') ;
        $industries = Industry::all();
        return view('panel.industry.create', compact( 'industries','title'));
    }

    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        $imagePreview = $request->file('image_preview');
        $imageMain = $request->file('image_main');
        $pdfFile = $request->file('pdf');

        if(isset( $imagePreview)) {
            $path = Storage::disk('public')->put('/images/industries' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }
        if(isset( $imageMain)) {
            $path = Storage::disk('public')->put('/images/industries' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }

        $industry = Industry::firstOrCreate($data);
        if(isset( $pdfFile)) {
            $file_ext = $pdfFile->getClientOriginalExtension();
            $newName = $industry->name. "-catalog." . $file_ext;
            $path = Storage::disk('public')->putFileAs('/images/industries',  $pdfFile, $newName);
            $data['pdf'] = 'images/industries/'. $newName;
            $data['pdf_size'] =round($pdfFile->getSize()/1000000, 1) ;
        }

        if($industry) {
            return redirect()->route('industry');
        } else {
            return back()->with('flash_message_error', 'industry n-a fost creat');
        }
    }

    public function edit(Industry $industry)
    {
        $language= new  LanguageHandler();
        $title = $language->replace('Editarea Industriei', 'Редактировать индустрию','Edit industry') ;
        $industryCategories = IndustryCategory::where('industry_id', $industry->id)->get();
        $industryProducts = IndustryProduct::all();


        foreach ($industryCategories as $category) {
            $products = [];
            foreach ($industryProducts as $item) {
                if($category->id == $item->industry_category_id && isset($item->product)) {
                    $products[] = $item->product;
                }
            }
            $category['addProducts'] = $products;
        }

//dd($industryCategories);

        return view('panel.industry.edit', compact( 'title',  'industry', 'industryCategories'));
    }

    public function update(UpdateRequest $request, Industry $industry)
    {
        $data = $request->validated();
        if(isset($_POST['delete'])) {
            $IndustryProducts = IndustryProduct::where('industry_id', $industry->id)->get();
            foreach ($IndustryProducts as $product) {
                $product->delete();
            }
            return back()->with('flash_message_success', 'Produsele a fost excluse');
        }

        elseif(isset($_POST['update'])) {
            $imagePreview = $request->file('image_preview');
            $imageMain = $request->file('image_main');
            $pdfFile = $request->file('pdf');

            if (isset($imagePreview)) {
                if (isset($industry->image_preview)) {
                    Storage::disk('public')->delete($industry->image_preview);
                }
                $path = Storage::disk('public')->put('/images/industries', $imagePreview);
                compressFiles($path);
                $data['image_preview'] = $path;
            }
            if (isset($imageMain)) {
                if (isset($industry->image_main)) {
                    Storage::disk('public')->delete($industry->image_main);
                }
                $path = Storage::disk('public')->put('/images/industries', $imageMain);
                compressFiles($path);
                $data['image_main'] = $path;
            }

            if (isset($pdfFile)) {
                $file_ext = $pdfFile->getClientOriginalExtension();
                $newName = $industry->name . "-catalog." . $file_ext;
                $path = Storage::disk('public')->putFileAs('/images/industries', $pdfFile, $newName);
                $data['pdf'] = 'images/industries/' . $newName;
                $data['pdf_size'] = round($pdfFile->getSize() / 1000000, 1);

            }

            $industry->update($data);
            return redirect()->route('industry');
        }
    }

//    public function delete(Industry $industry)
//    {
//        if(isset($industry->image_preview)) {
//            Storage::disk('public')->delete($industry->image_preview);
//        }
//        if(isset($industry->image_main)) {
//            Storage::disk('public')->delete($industry->image_main);
//        }
//        $categories=Category::where('industry_id', $industry)->get();
//        if(isset($categories)) {
//            foreach ($categories as $category) {
//                $category->delete();
//            }
//        }
//        $industry->delete();
//        return redirect()->route('industry');
//    }
}
