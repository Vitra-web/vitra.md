<?php

namespace App\Http\Controllers\Client\Favorite;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function main(Request $request )
    {
        $language= new  LanguageHandler();
        $title = $language->replace('Favorite', 'Избранные','Favorite') ;
        $products = [];
        $favorite = request()->cookie('vitraFavorite');
        if(Auth::user()) {
            $userFavorite = UserFavorite::where('user_id',Auth::user()->id )->get();
            if($userFavorite) {
                foreach ($userFavorite as $item) {
                    $products[]= Product::where('id', $item->product_id)->first();
                }
            }
        } elseif($favorite) {
            foreach (json_decode($favorite) as $item) {
                $products[]= Product::where('id', $item->product_id)->first();
            }
        }

        foreach ($products as $product) {
            if(isset($product->productVariants)) {
                $product['variants']= $product->productVariants;
            }
            $product['favorite']= true;
        }

        return view('client.favorite.index', compact('title', 'products'));
    }



}
