<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\SubcategoryType\StoreRequest;
use App\Http\Requests\SubcategoryType\UpdateRequest;
use App\Models\Category;

use App\Models\Industry;
use App\Models\Subcategory;

use App\Models\SubcategorySpecification;
use App\Models\SubcategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryTypeController extends Controller
{

    private function CheckSpecifications($data) {
        $selectedData = $data;
        unset($selectedData['status'],
            $selectedData['industry_id'],
            $selectedData['category_id'],
            $selectedData['subcategory_id'],
            $selectedData['title_en'],
            $selectedData['title_ro'],
            $selectedData['title_ru'],
            $selectedData['description_en'],
            $selectedData['description_ro'],
            $selectedData['description_ru'],
            $selectedData['created_by'],
        );
        $specifications = 0;
        foreach ($selectedData as $item) {
            if($item != null && $item != '<p>&nbsp;</p>') {
                $specifications = 1;
                break;
            }
        }
        return $specifications;

    }
    public function index(Request $request)
    {
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();
        $subcategories = Subcategory::all();
        $types = SubcategoryType::when($request->industry != null, function ($q) use ($request) {
            return $q->where('industry_id', $request->industry);
        })->when($request->category != null, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->when($request->subcategory != null, function ($q) use ($request) {
            return $q->where('subcategory_id', $request->subcategory);
        })->get();
        $title = trans('panel.subcategory_types');


        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }
        foreach ($categoriesAll as $category){
            $categoryList = Subcategory::where('category_id', $category->id)->get();
            $category['subcategories'] = $categoryList;
        }

        return view('panel.subcategoryType.index', compact('subcategories', 'title','industriesAll', 'categoriesAll', 'types'));

    }
    public function create()
    {

        $title = trans('panel.add_subcategory_types');
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();
        $subcategories = Subcategory::all();
        $types = SubcategoryType::all();

        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }
        foreach ($categoriesAll as $category){
            $categoryList = Subcategory::where('category_id', $category->id)->get();
            $category['subcategories'] = $categoryList;
        }
        return view('panel.subcategoryType.create', compact( 'title', 'industriesAll', 'categoriesAll', 'subcategories', 'types'));
    }
    public function show(Subcategory $subcategory)
    {
        return view('panel.subcategory.show', compact(   'subcategory'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
       $data['specifications'] = $this->CheckSpecifications($data);

        $imagePreview = $request->file('image_preview');
        if(isset( $imagePreview)) {
            $path = Storage::disk('public')->put('/images/subcategoryType' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }


        $type = SubcategoryType::firstOrCreate($data);

        if($type) {
            return redirect()->route('type');
        } else {
            return back()->with('error', 'category n-a fost creat');
        }
    }

    public function edit(SubcategoryType $type)
    {
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();
        $categoriesOld = Category::where('industry_id', $type->industry_id)->get();
        $subcategoriesOld = Subcategory::where('category_id', $type->category_id)->get();



        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;

        }
        foreach ($categoriesAll as $category){
            $categoryList = Subcategory::where('category_id', $category->id)->get();
            $category['subcategories'] = $categoryList;
        }
        return view('panel.subcategoryType.edit', compact(  'industriesAll', 'categoriesOld', 'categoriesAll',  'subcategoriesOld','type'));
    }

    public function update(UpdateRequest $request, SubcategoryType $type)
    {
        $data = $request->validated();

        $data['specifications'] = $this->CheckSpecifications($data);

        $imagePreview = $request->file('image_preview');

        if(isset( $imagePreview)) {
            if(isset($type->image_preview)) {
                Storage::disk('public')->delete($type->image_preview);
            }
            $path = Storage::disk('public')->put('/images/subcategoryType' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }
        $type->update($data);

        return back()->with('success', 'Tipul subcategoriei a schimbat ');
    }

    public function delete(SubcategoryType $type)
    {
        if(isset($type->image_preview)) {
            Storage::disk('public')->delete($type->image_preview);
        }

        $type->delete();
        return redirect()->route('type');
    }


}
