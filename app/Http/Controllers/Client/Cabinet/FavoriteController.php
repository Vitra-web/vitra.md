<?php

namespace App\Http\Controllers\Client\Cabinet;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\AboutBenefit;
use App\Models\PageContent;
use App\Models\Product;
use App\Models\User;
use App\Models\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    public function main( )
    {
        $title = trans('cabinet.favorite');
        $user = Auth::user();

        $userFavorite = UserFavorite::where('user_id',$user->id )->get();
        $favoriteProducts = [];
        foreach ($userFavorite as $product)  {
            $favoriteProducts[]= Product::where('id', $product->product_id)->first();
        }

//        dd($favoriteProducts);
        return view('client.cabinet.favorites', compact('title', 'user', 'favoriteProducts'));
    }


}
