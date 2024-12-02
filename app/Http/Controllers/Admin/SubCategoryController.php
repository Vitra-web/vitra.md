<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Subcategory\StoreRequest;
use App\Http\Requests\Subcategory\UpdateRequest;
use App\Models\Category;

use App\Models\Industry;
use App\Models\Subcategory;

use App\Models\SubcategorySpecification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();

        $subcategories = Subcategory::when($request->industry != null, function ($q) use ($request) {
            return $q->where('industry_id', $request->industry);
        })->when($request->category != null, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->orderBy('sort_order', 'ASC')->get();
        $title = trans('panel.subcategories');

        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }
        foreach ($categoriesAll as $category){
            $categoryList = Subcategory::where('category_id', $category->id)->get();
            $category['subcategories'] = $categoryList;
        }

        return view('panel.subcategory.index', compact('subcategories', 'industriesAll', 'categoriesAll','title'));

    }
    public function create()
    {

        $title = trans('panel.add_subcategory');
        $industriesAll = Industry::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();

        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }
        return view('panel.subcategory.create', compact( 'title', 'industriesAll', 'categories', 'subcategories'));
    }
    public function show( $subcategory)
    {
        $subcategory = Subcategory::where('id',$subcategory )->first();
        return view('panel.subcategory.show', compact(   'subcategory'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $imagePreview = $request->file('image_preview');
        $imageMain = $request->file('image_main');
        $imageSecond = $request->file('image_second');
//        $length = $data['length'];
//        $depth = $data['depth'];
//        $height = $data['height'];
//        $material = $data['material'];

        if(isset( $imagePreview)) {
            $path = Storage::disk('public')->put('/images/subcategory' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }
        if(isset( $imageMain)) {
            $path = Storage::disk('public')->put('/images/subcategory' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }
        if(isset( $imageSecond)) {
            $path = Storage::disk('public')->put('/images/subcategory' , $imageSecond );
            compressFiles($path);
            $data['image_second'] = $path;
        }
        $data['slug']= str_replace([' ', '/'], '-', strtolower($data['name_en']));
//        unset($data['length'], $data['depth'],$data['height'], $data['material'] );
        $subcategory = Subcategory::firstOrCreate($data);

//        if(isset($length) || isset($depth)) {
//            $specificationData = [
//                'subcategory_id'=>$subcategory->id,
//                'length'=>$length,
//                'depth'=>$depth,
//                'height'=>$height,
//                'material'=>$material,
//
//            ];
//            SubcategorySpecification::firstOrCreate($specificationData);
//        }


        if($subcategory) {
            return redirect()->route('subcategory');
        } else {
            return back()->with('error', 'category n-a fost creat');
        }
    }

    public function edit($subcategory)
    {
        $subcategory = Subcategory::where('id',$subcategory )->first();
        $industriesAll = Industry::all();
        $categoriesOld = Category::where('industry_id', $subcategory->industry_id)->get();


        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }

        return view('panel.subcategory.edit', compact(  'industriesAll', 'subcategory', 'categoriesOld'));
    }

    public function update(UpdateRequest $request, $subcategory)
    {
        $subcategory = Subcategory::where('id',$subcategory )->first();
        $data = $request->validated();

        $imagePreview = $request->file('image_preview');
        $imageMain = $request->file('image_main');
        $imageSecond = $request->file('image_second');



        if(isset( $imagePreview)) {
            if(isset($subcategory->image_preview)) {
                Storage::disk('public')->delete($subcategory->image_preview);
            }
            $path = Storage::disk('public')->put('/images/subcategory' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }
        if(isset( $imageMain)) {
            if(isset($subcategory->image_main)) {
                Storage::disk('public')->delete($subcategory->image_main);
            }
            $path = Storage::disk('public')->put('/images/subcategory' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }
        if(isset( $imageSecond)) {
            if(isset($subcategory->image_second)) {
                Storage::disk('public')->delete($subcategory->image_second);
            }
            $path = Storage::disk('public')->put('/images/subcategory' , $imageSecond );
            compressFiles($path);
            $data['image_second'] = $path;
        }
        $data['slug']= str_replace([' ', '/'], '-', strtolower($data['name_en']));
        $subcategory->update($data);

        return back()->with('success', 'Subcategorie a schimbat ');
    }

    public function delete($subcategory)
    {
        $subcategory = Subcategory::where('id',$subcategory )->first();
        if(isset($subcategory->image_preview)) {
            Storage::disk('public')->delete($subcategory->image_preview);
        }
        if(isset($subcategory->image_main)) {
            Storage::disk('public')->delete($subcategory->image_main);
        }

        $subcategory->delete();
        return redirect()->route('subcategory');
    }


}
