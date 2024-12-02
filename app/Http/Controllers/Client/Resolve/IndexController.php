<?php

namespace App\Http\Controllers\Client\Resolve;


use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\Product;
use App\Models\Resolve;

use App\Models\ResolveProduct;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function main( )
    {
        $resolves = Resolve::query()->limit(20)->get();
        $title = trans('nav.solution');
        return view('client.resolve.index', compact('title','resolves'));
    }
    public function view( Resolve $resolve)
    {
        $language= new LanguageHandler();
        $products = [];
        $resolveProducts = ResolveProduct::where('resolve_id', $resolve->id)->get();
        foreach ($resolveProducts as $item) {
            $products[]=Product::where('id', $item->product_id)->where('status', 1)->first();
        }

        foreach ($products as $product) {
            $product['variants']= $product->productVariants;
        }

//        dd($products);
        $parentLink = [
            'url'=>'client.resolve',
            'transValue'=>trans('nav.solution'),
        ];

        $title = $language->replace($resolve->name_ro, $resolve->name_ru, $resolve->name_en);
        return view('client.resolve.view', compact('parentLink', 'title','resolve', 'products'));
    }
}
