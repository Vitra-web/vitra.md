<?php

namespace App\Http\Controllers\Client\Contacts;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\PageContent;


class IndexController extends Controller
{
    public function main( )
    {
        $language= new  LanguageHandler();
        $contactsPage = PageContent::where('page', 'contacts')->first();
        $contacts = Contact::all();
        $title = $language->replace($contactsPage->title_ro, $contactsPage->title_ru,  $contactsPage->title_en) ;

        return view('client.contacts.index', compact('title', 'contactsPage', 'contacts'));
    }
}
