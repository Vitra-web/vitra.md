<?php

namespace App\Http\Controllers\Client\Search;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Product;
use App\Models\Resolve;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
    public function main(Request $request )
    {
        $language= new  LanguageHandler();
        $name='name_'.App::getLocale();
        $similarSearch = [];
//        dd($request->value);

        $products = Product::where('name_ro', 'LIKE', '%' . $request->value . "%")->orWhere('name_ru', 'LIKE', '%' . $request->value . "%")->orWhere('name_en', 'LIKE', '%' . $request->value . "%")->orWhere('code_1c', 'LIKE', '%' . $request->value . "%" )->where('status', 1)->orderBy($name)->paginate(24);
        $searchCategories = Category::where('name_ro', 'LIKE', '%' . $request->value . "%")->orWhere('name_ru', 'LIKE', '%' . $request->value . "%")->orWhere('name_en', 'LIKE', '%' . $request->value . "%")->where('status', 1)->orderBy($name)->get();
        $searchCategory = Category::where('name_ro', 'LIKE', '%' . $request->value . "%")->orWhere('name_ru', 'LIKE', '%' . $request->value . "%")->orWhere('name_en', 'LIKE', '%' . $request->value . "%")->where('status', 1)->first();
        $searchSubcategories = Subcategory::where('name_ro', 'LIKE', '%' . $request->value . "%")->orWhere('name_ru', 'LIKE', '%' . $request->value . "%")->orWhere('name_en', 'LIKE', '%' . $request->value . "%")->orderBy($name)->get();
        $searchSubcategory = Subcategory::where('name_ro', 'LIKE', '%' . $request->value . "%")->orWhere('name_ru', 'LIKE', '%' . $request->value . "%")->orWhere('name_en', 'LIKE', '%' . $request->value . "%")->first();
        $searchSolutions = Resolve::where('name_ro', 'LIKE', '%' . $request->value . "%")->orWhere('name_ru', 'LIKE', '%' . $request->value . "%")->orWhere('name_en', 'LIKE', '%' . $request->value . "%")->get();

        if(count($products)>0) {
            $products = favoriteFilter($products);
        }
        if(count($searchCategories) > 0) {
            $seeMoreCategories = Category::where('industry_id', $searchCategories[0]->industry_id)->where('status', 1)->limit(4)->get();

        } else $seeMoreCategories = [];

        if(count($searchSubcategories) > 0) {
            $seeMoreSubcategories = Subcategory::where('category_id', $searchSubcategories[0]->category_id)->where('status', 1)->where('id', '!=',$searchSubcategories[0]->id )->limit(4)->get();

        } else $seeMoreSubcategories = [];

        if(count($searchCategories) == 0 && count($searchSubcategories) ==0) {
            $recommendSubcategories = Subcategory::where('status', 1)->where('recommend', 1 )->get();
        } else $recommendSubcategories = [];
//        dd($seeMoreSubcategories);
        $news = News::where('name_ro', 'LIKE', '%' . $request->value . "%")->orWhere('name_ru', 'LIKE', '%' . $request->value . "%")->orWhere('name_en', 'LIKE', '%' . $request->value . "%")->get();
        $title = $language->replace('Cautare', 'Поиск','Search') ;
        $value = $request->value;

        if(!$searchCategory && $searchSubcategory) {
            $searchCategory = Category::where('id', $searchSubcategory->category_id)->first();
            if($searchCategory) {
               if(App::getLocale() == 'ro') {
                   $tags = json_decode($searchCategory->tags_ro);
                   if($tags) {
                       foreach ($tags as $tag) {
                           $tagProducts = Product::where('name_ro', 'LIKE', '%' . $tag . "%")->where('status', 1)->get();
                           $similarSearch[] = [
                               'tag'=>$tag,
                               'count'=>count($tagProducts),
                           ];
                       }
                   }

               } elseif(App::getLocale() == 'ru') {
                   $tags = json_decode($searchCategory->tags_ru);
                   if($tags) {
                       foreach ($tags as $tag) {
                           $tagProducts = Product::where('name_ru', 'LIKE', '%' . $tag . "%")->where('status', 1)->get();
                           $similarSearch[] = [
                               'tag'=>$tag,
                               'count'=>count($tagProducts),
                           ];
                       }
                   }

               } else {
                   $tags = json_decode($searchCategory->tags_en);
                   if($tags) {
                       foreach ($tags as $tag) {
                           $tagProducts = Product::where('name_en', 'LIKE', '%' . $tag . "%")->where('status', 1)->get();
                           $similarSearch[] = [
                               'tag'=>$tag,
                               'count'=>count($tagProducts),
                           ];
                       }
                   }

               }


            }

        }

//        dd($similarSearch);

        return view('client.search.index', compact('title', 'value', 'products', 'searchCategories', 'searchSubcategories', 'searchSolutions',
            'news', 'seeMoreCategories', 'seeMoreSubcategories', 'recommendSubcategories', 'similarSearch' ));
    }

    public function searchMore(Request $request) {
        return redirect(route('client.searchPage',$request->input('search_value') ));
    }

}
