<?php

namespace App\Http\Controllers\Client\Solution;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\News;
use App\Models\Portfolio;
use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Models\SolutionProduct;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function main( )
    {
        $categories = Category::all();
        $solutions = Solution::query()->orderBy('sort_order', 'asc')->limit(20)->get();
        $solutionCategories = SolutionCategory::all();
        $solutionProducts = SolutionProduct::all();
        $title = 'Solutions';
        $language= new  LanguageHandler();
        foreach ($solutions as $solution) {
            $solution['ratio'] = $solution->ratio->value;
        }
        foreach ($solutionProducts as $product){
            if(isset($product->product)) {
                $productList=[
                    'name'=>$language->replace($product->product->name_ro, $product->product->name_ru,$product->product->name_en),
                    'price'=>$product->product->price,
                    'code'=>$product->product->code_1c,
                ];
                $product['productItem']=$productList;
            }

        }
        return view('client.solution.index', compact('title','solutions', 'categories', 'solutionCategories', 'solutionProducts'));
    }
    public function viewIndustry( Industry $item)
    {
        $categories = Category::all();
        $solutions = Solution::where('industry_id',$item->id )->limit(20)->get();
        $solutionCategories = SolutionCategory::where('industry_id', $item->id)->get();
        $solutionProducts = SolutionProduct::all();
        $title = 'Solutions';
        $language= new  LanguageHandler();

        foreach ($solutions as $solution) {
            $solution['ratio'] = $solution->ratio->value;
        }

        foreach ($solutionProducts as $product){
            if(isset($product->product)) {
                $productList=[
                    'name'=>$language->replace($product->product->name_ro, $product->product->name_ru,$product->product->name_en),
                    'price'=>$product->product->price,
                    'code'=>$product->product->code_1c,
                ];
                $product['productItem']=$productList;
            }

        }
        return view('client.solution.index', compact('title','item','solutions', 'categories', 'solutionCategories', 'solutionProducts'));
    }
    public function viewCategory( Category $item)
    {
        $categories = Category::all();
        $solutions = Portfolio::where('category_id',$item->id )->get();
        $title = $item->name_ro;
        return view('client.solution.viewCategory', compact('title','item', 'solutions','categories'));
    }
}
