<?php

namespace App\Http\Controllers\Client\Basket;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\UserFavorite;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function main( )
    {
        $language= new  LanguageHandler();
        $title = $language->replace('Coș de cumpărături', 'Корзина','Shopping cart') ;
        $recommendProducts = Product::where('recommend', 1)->get();
        foreach ($recommendProducts as $product) {
            $product['variants']= $product->productVariants;
        }

        $products  = [];
        $productsLocale = request()->cookie('vitraProducts');
//        dd($productsLocale);
        if(Auth::user()) {
            $userProducts = UserProduct::where('user_id',Auth::user()->id )->get();
            if($userProducts) {
                foreach ($userProducts as $item) {
                    $product = Product::where('id', $item->product_id)->first();
                    if(isset($item->product_moduline)) {
                        if($item->product_moduline) {
//                            dd(json_decode($item->product_moduline));
                            $product['price'] = json_decode($item->product_moduline)->price;
                        }
                    }
                    $data = [
                        'product'=>$product,
                        'quantity'=>$item->quantity,
                        'product_variant'=>isset($item->product_variant) ? ProductVariant::where('code', $item->product_variant)->first() : '',
                        'product_moduline'=>isset($item->product_moduline) ? json_decode($item->product_moduline) : ''
                    ];
                    $products[]= $data;


                }
            }
        } elseif($productsLocale) {
//            dd($productsLocale);
            foreach (json_decode($productsLocale) as $item) {
                $product = Product::where('id', $item->product_id)->first();
                if(isset($item->product_moduline)) {
                    if($item->product_moduline) {
                        $product['price']=json_decode($item->product_moduline)->price;
                    }

                }
                $data = [
                    'product'=>$product,
                    'quantity'=>$item->quantity,
                    'product_variant'=>isset($item->product_variant) ? ProductVariant::where('code', $item->product_variant)->first() : '',
                    'product_moduline'=>isset($item->product_moduline) ? json_decode($item->product_moduline) : ''
                ];
                $products[] = $data;
            }
        }


//        dd($products);


        $favoriteProducts  = [];
        if(Auth::user()) {
            $userFavorite = UserFavorite::where('user_id', Auth::user()->id)->get();
            foreach ($userFavorite as $item) {
                $favoriteProducts[]['product_id']=$item->product_id;
            }
        }
//        dd($favoriteProducts);

        return view('client.basket.index', compact('title', 'recommendProducts', 'favoriteProducts', 'products'));
    }

}
