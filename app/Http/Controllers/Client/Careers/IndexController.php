<?php

namespace App\Http\Controllers\Client\Careers;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\CareerLanguage;
use App\Models\CareersBenefits;
use App\Models\PageContent;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function main( )
    {
        $language= new  LanguageHandler();
        $benefits = CareersBenefits::all();
        $vacancy = Vacancy::all();
        $languages = CareerLanguage::all();
        $careersPage = PageContent::where('page', 'careers')->first();
        $title = $language->replace($careersPage->title_ro, $careersPage->title_ru,$careersPage->title_en) ;

        return view('client.careers.index', compact('title', 'benefits', 'vacancy', 'careersPage', 'languages'));
    }

}
