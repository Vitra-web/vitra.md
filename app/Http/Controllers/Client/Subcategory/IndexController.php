<?php

namespace App\Http\Controllers\Client\Subcategory;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductSubCategory;
use App\Models\Subcategory;
use App\Models\SubcategoryType;
use App\Models\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;



class IndexController extends Controller
{



    public function main( $subcategory, Request $request)
    {
        $subcategory = Subcategory::where('slug', $subcategory)->first();
        $categories = Category::all();

        $industryItem = Industry::where('id', $subcategory->industry_id)->first();
        $categoryItem = Category::where('id', $subcategory->category_id)->first();
        $categoriesRecommended = Category::where('industry_id', $subcategory->industry_id)->where('id', '!=',$subcategory->category_id )->limit(5)->get();
        $language= new  LanguageHandler();

        $productSubcategories = ProductSubCategory::where('subcategory_id', $subcategory->id)->get();
        $products = new Collection();
        if(isset($productSubcategories)) {
            foreach ($productSubcategories as $item) {
                $selectedProduct = Product::where('id', $item->product_id)->where('status', 1)->first();
                if($selectedProduct) {
                    $products[] = $selectedProduct;
                }

            }

        }




        foreach ($products as $product) {

            if(isset($product->productVariants)) {
                $product['variants']= $product->productVariants;
            }
        }

        $brands = array_unique(array_column($products->toArray(),'brand'));
        if(count($brands) >0) {
            if($brands[0] == null) {
                $brands = [];
            }
        }


//        if(Auth::user() && Auth::user()->id == 1) {
//            dd($brands);
//        }
        $products = $products->when($request->brand != null, function ($q) use ($request) {
            if($request->brand != 0){
                return $q->where('brand', $request->brand);
            }
        })->when($request->sort != null, function ($q) use ($request) {
            if($request->sort ==1){
                return $q->sortByDesc('visits');
            } elseif($request->sort ==2) {
                return $q->sortBy('created_at');
            }elseif($request->sort ==3) {
                return $q->sortByDesc('price');
            } elseif($request->sort ==4) {
                return $q->sortBy('price')->where('price', '!=', null)->concat($q->where('price', '==', null)->sortBy('name_ro'));
            }
        })->when($request->sort == null && $request->brand == null, function ($q) use ($request) {
            return $q->sortByDesc('visits');
        })->paginate(24);


        $products = favoriteFilter($products);

//        $share_buttons = (new \Jorenvh\Share\Share)->currentPage()->facebook();
//        $share_buttons = Share::page(
//            'https://www.laravelclick.com/post/laravel-10-social-media-share-buttons-integration-tutorial',
//            'How to Add Social Media Share Button in Laravel 10 App?'
//        )
//            ->facebook()
//            ->twitter()
//            ->linkedin()
//            ->whatsapp()
//            ->telegram()
//            ->reddit();

        $subcategoryTypes = SubcategoryType::where('subcategory_id', $subcategory->id)->orderBy('sort_order')->get();
        $title = $language->replace($subcategory->name_ro, $subcategory->name_ru,$subcategory->name_en);
        return view('client.subcategory.index', compact('subcategory', 'industryItem',
            'categoryItem',  'categories', 'products', 'title', 'categoriesRecommended', 'subcategoryTypes', 'brands'));
    }
}
