<?php

namespace App\Http\Controllers\Client\About;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\AboutBenefit;
use App\Models\PageContent;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function main( )
    {
        $language= new  LanguageHandler();
        $title = $language->replace('Despre noi', 'О нас','About us') ;
        $page = PageContent::where('page', 'about')->first();
        $benefits = AboutBenefit::all();
        return view('client.about.index', compact('title', 'page', 'benefits'));
    }

}
