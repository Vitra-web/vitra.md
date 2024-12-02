<?php


use App\Models\UserFavorite;
use Illuminate\Support\Facades\Auth;

function compressFiles($path){

    $filepath = public_path('storage/'.$path);


   try {
       \Tinify\setKey(env("TINIFY_KEY"));
       $source = \Tinify\fromFile($filepath);

       $source->toFile($filepath);


   } catch(\Tinify\AccountException $e) {
       // Verify your API key and account limit.
       return back()->with('error', $e->getMessage());
   }

}

function compressMobileFiles($path){

    $filepath = public_path('storage/'.$path);

    try {
        \Tinify\setKey(env("TINIFY_KEY"));
        $source = \Tinify\fromFile($filepath);

        $resized = $source->resize( ["method"=> "cover",
            "width"=> 300,
            "height"=> 400]);
        $resized->toFile($filepath);
    } catch(\Tinify\AccountException $e) {
        // Verify your API key and account limit.
        return back()->with('error', $e->getMessage());
    }

}

function favoriteFilter($products) {
    $favoriteLocale = request()->cookie('vitraFavorite');
    if(Auth::user()) {
        $userFavorite = UserFavorite::where('user_id',Auth::user()->id )->get();
        if($userFavorite) {
            foreach ($userFavorite as $item) {
                foreach ($products as $product) {
                    if($product->id == $item->product_id) {
                        $product['favorite']= true;
                    }
                }
            }
        }
    } elseif($favoriteLocale) {
        foreach (json_decode($favoriteLocale) as $item) {
            foreach ($products as $product) {
                if($product->id == $item->product_id) {
                    $product['favorite']= true;
                }
            }
        }
    }

    return $products;
}
