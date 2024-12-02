<?php

namespace App\Http\Controllers\Client\Industry;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\IndustryCategory;
use App\Models\IndustryProduct;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function main( $industry)
    {
        $industry = Industry::where('slug', $industry)->first();
        $categories = Category::all();

        $allCategories = Category::where('industry_id', $industry->id)->get();

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

        $productsIndustry = Product::where('industry_id', $industry->id)->where('status', 1)->get();


        $productsNoCategory = [];
        foreach ($productsIndustry as $item) {

            if(count($item->productCategories) == 0) {
                $productsNoCategory[]=$item;
            }
        }

//        dd($industryCategories);
        $portfolios = Portfolio::where('industry_id', $industry->id)->get();
        $title = $industry->name;
        return view('client.industry.index', compact('industry', 'categories', 'portfolios', 'allCategories', 'industryCategories', 'title', 'productsNoCategory'));
    }


}
