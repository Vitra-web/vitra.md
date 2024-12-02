<?php

namespace App\Http\Controllers\Client\News;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function main( )
    {
        $language= new  LanguageHandler();
        $news = News::all();

        $newsCategories = NewsCategory::all();
        foreach ($news as $key=> $item) {
            $item['industryName'] = $item->industry->name;
            $item['categoryItem'] = $item->category;
        }
//        dd($news);
        $title = $language->replace('Bine de știut', 'Новости','News') ;
        return view('client.news.index', compact('news',  'newsCategories', 'title'));
    }
    public function view( News $item)
    {
        $language= new  LanguageHandler();
        $title =$language->replace($item->name_ro, $item->name_ru,$item->name_en );
        $views = $item->views;
        $item->update(['views'=>$views+1]);
        return view('client.news.view', compact('item', 'title'));
    }
}
