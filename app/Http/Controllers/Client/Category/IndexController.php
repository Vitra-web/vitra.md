<?php

namespace App\Http\Controllers\Client\Category;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryIdea;
use App\Models\CategoryIdeaProduct;
use App\Models\Industry;
use App\Models\IndustryCategory;
use App\Models\IndustryProduct;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function main( $category)
    {

      $category = Category::where('slug', $category)->first();
        $portfolioCategories = PortfolioCategory::where('industry_id', $category->industry_id)->get();
//        dd($category);
        $industryItem = Industry::where('id', $category->industry_id)->first();

        $language= new  LanguageHandler();
        $subCategories = Subcategory::where('category_id', $category->id)->where('status', 1)->get();
        $portfolios = Portfolio::where('industry_id', $category->industry_id)->get();
        $title = $language->replace($category->name_ro, $category->name_ru,$category->name_en);

        $categoryIdeas = CategoryIdea::where('industry_id', $category->industry_id)->get();
        $categoryIdeaProducts = CategoryIdeaProduct::all();

        $isProducts = false;
        foreach ($categoryIdeas as $categoryIdea) {
            $products = [];
            foreach ($categoryIdeaProducts as $item) {
                if($categoryIdea->id == $item->category_idea_id && $item->category_id ==$category->id) {
                    $products[] = $item->product;
                    if($item->product) {
                        $products[] = $item->product;
                        $isProducts = true;
                    }

                }
            }
            $categoryIdea['addProducts'] = $products;
        }

//        $categoryIdeas['isProducts'] = $isProducts;

//               if(Auth::user() && Auth::user()->id == 1) {
//
//                        dd($categoryIdeas);
//                    }

        $productsCategories = ProductCategory::where('category_id',$category->id )->get();
        $categoryProducts = [];


        if(isset($productsCategories)) {
            foreach ($productsCategories as $item) {

                $product = Product::where('id', $item->product_id)->where('status', 1)->first();

                if($product) {
                    $productSubcategories = ProductSubCategory::where('product_id', $product->id)->first();
//                    if(Auth::user()->id == 1) {
//                        dd($productSubcategories);
//                    }

                    if(!$productSubcategories) {
                        $categoryProducts[] = $product;
                    }

                }

            }

        }

//        dd($categoryProducts);
        if(count($categoryProducts) > 0) {
            $categoryProducts = favoriteFilter($categoryProducts);
            foreach ($categoryProducts as $product) {
                $product['variants']= $product->productVariants;
            }
        }


        return view('client.category.index', compact('category',  'industryItem', 'subCategories', 'portfolios',
            'portfolioCategories',  'title', 'categoryIdeas', 'categoryProducts', 'isProducts'));
    }
}
