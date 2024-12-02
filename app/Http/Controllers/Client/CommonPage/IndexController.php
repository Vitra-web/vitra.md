<?php

namespace App\Http\Controllers\Client\CommonPage;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\AboutBenefit;
use App\Models\PageContent;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function services()
    {
        $title = trans('nav.ourServices') ;
        $page = PageContent::where('page', 'services')->first();

        return view('client.commonPage.index', compact('title', 'page'));
    }
    public function terms()
    {
        $title = trans('nav.terms') ;
        $page = PageContent::where('page', 'terms')->first();
        return view('client.commonPage.index', compact('title', 'page'));
    }
    public function delivery()
    {
        $title = trans('nav.delivery') ;
        $page = PageContent::where('page', 'delivery')->first();
        return view('client.commonPage.index', compact('title', 'page'));
    }
    public function policy()
    {
        $title = trans('labels.policy') ;
        $page = PageContent::where('page', 'policy')->first();
        return view('client.commonPage.index', compact('title', 'page'));
    }
}
