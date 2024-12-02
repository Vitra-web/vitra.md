<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\CategoryIdea;
use App\Models\CategoryIdeaProduct;
use App\Models\Industry;
use App\Models\IndustryCategory;
use App\Models\IndustryProduct;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index(Request $request)
    {
//        $categories = Category::all();
        $industries = Industry::all();

        $categoriesAll = Category::when($request->industry != null, function ($q) use ($request) {
            return $q->where('industry_id', $request->industry);
        })->orderBy('sort_order', 'ASC')->get();
        $title = trans('panel.categories');
        return view('panel.category.index', compact('categoriesAll', 'industries', 'title'));

    }
    public function create()
    {
        $title = trans('panel.add_category');
        $industries = Industry::all();
        $categories = Category::all();
        return view('panel.category.create', compact( 'title', 'industries', 'categories'));
    }
    public function show( $category)
    {
        $category = Category::where('id',$category )->first();
        return view('panel.category.show', compact(   'category'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

//        dd($data);
        $imagePreview = $request->file('image_preview');
        $imageMain = $request->file('image_main');

        if(isset( $imagePreview)) {
            $path = Storage::disk('public')->put('/images/category' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }
        if(isset( $imageMain)) {
            $path = Storage::disk('public')->put('/images/category' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }
        $data['slug']= str_replace(' ', '-', strtolower($data['name_en']));
        if(isset($data['tags_ro'])) {
            $data['tags_ro']= json_encode($data['tags_ro']);
        }
        if(isset($data['tags_ru'])) {
            $data['tags_ru']= json_encode($data['tags_ru']);
        }
        if( isset($data['tags_en'])) {
            $data['tags_en']= json_encode($data['tags_en']);
        }

        $category = Category::firstOrCreate($data);

        if($category) {
            return redirect()->route('category');
        } else {
            return back()->with('flash_message_error', 'category n-a fost creat');
        }
    }

    public function edit( $category)
    {
        $category = Category::where('id',$category )->first();
        $industries = Industry::all();
        $categoryIdeas = CategoryIdea::where('industry_id', $category->industry_id)->get();
        $categoryIdeaProducts = CategoryIdeaProduct::all();

//dd();
        foreach ($categoryIdeas as $categoryIdea) {
            $products = [];
            foreach ($categoryIdeaProducts as $item) {
                if($categoryIdea->id == $item->category_idea_id && $item->category_id ==$category->id && isset($item->product) ) {
                    $products[] = $item->product;
                }
            }
            $categoryIdea['addProducts'] = $products;
        }
//        dd($categoryIdeas);
        return view('panel.category.edit', compact(  'industries', 'category', 'categoryIdeas', ));
    }


    public function update(UpdateRequest $request, $category)
    {
        $category = Category::where('id',$category )->first();
        $data = $request->validated();

        if(isset($_POST['delete'])) {
            $categoryIdeaProducts = CategoryIdeaProduct::where('category_id', $category->id)->get();
            foreach ($categoryIdeaProducts as $product) {
                $product->delete();
            }
            return back()->with('flash_message_success', 'Produsele a fost excluse');
        }

        elseif(isset($_POST['update'])) {
            $imagePreview = $request->file('image_preview');
            $imageMain = $request->file('image_main');

            if(isset( $imagePreview)) {
                if(isset($category->image_preview)) {
                    Storage::disk('public')->delete($category->image_preview);
                }
                $path = Storage::disk('public')->put('/images/category' , $imagePreview );
                compressFiles($path);
                $data['image_preview'] = $path;
            }
            if(isset( $imageMain)) {
                if(isset($category->image_main)) {
                    Storage::disk('public')->delete($category->image_main);
                }
                $path = Storage::disk('public')->put('/images/category' , $imageMain );
                compressFiles($path);
                $data['image_main'] = $path;
            }
            $slug = str_replace(' ', '-', strtolower($data['name_en']));
            $categoryExist = Category::where('slug',$slug )->first();
            if($categoryExist) {
                $data['slug']= $slug.'-'.rand(1,100);
            } else $data['slug']= $slug;

            if(isset($data['tags_ro'])) {
                $data['tags_ro']= json_encode($data['tags_ro']);
            }
            if(isset($data['tags_ru'])) {
                $data['tags_ru']= json_encode($data['tags_ru']);
            }
            if( isset($data['tags_en'])) {
                $data['tags_en']= json_encode($data['tags_en']);
            }
            $category->update($data);
            return redirect()->route('category');
        }

    }

    public function delete( $category)
    {
        $category = Category::where('id',$category )->first();
        $productCategories = ProductCategory::where('category_id', $category->id)->get();

        if($productCategories ) {
            foreach ($productCategories as $productCategory) {
                $productCategory->delete();
            }
        }
//dd('stop');
        if(isset($category->image_preview)) {
            Storage::disk('public')->delete($category->image_preview);
        }
        if(isset($category->image_main)) {
            Storage::disk('public')->delete($category->image_main);
        }
        $category->delete();
        return redirect()->route('category');
    }

}
