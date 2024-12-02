<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\UpdateRequest;
use App\Models\Contact;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        $contactsPage = PageContent::where('page', 'contacts')->first();
        $title = 'Contacts';
        return view('panel.contacts.index', compact( 'title', 'contactsPage', 'contacts'));

    }


    public function edit(Contact $contact)
    {
            $title = 'Editarea Contact';

            return view('panel.contacts.edit', compact( 'title',  'contact'));
    }

    public function update(UpdateRequest $request, Contact $contact)
    {
        $data = $request->validated();
        $contact->update($data);
        return redirect()->route('contacts');
    }



    public function editPage(PageContent $page)
    {
        return view('panel.contacts.editPage', compact('page'));
    }

    public function updatePage(Request $request, PageContent $page)
    {
        $data=$request->validate([
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'image' => 'nullable',
        ]);

        $imageMain = $request->file('image');

        if(isset( $imageMain)) {
            if(isset($page->image)) {
                Storage::disk('public')->delete($page->image);
            }
            if(isset($page->image_mobile)) {
                Storage::disk('public')->delete($page->image_mobile);
            }
            $path = Storage::disk('public')->put('/images/contacts' , $imageMain );
            $pathMobile = Storage::disk('public')->put('/images/contacts/mobile' , $imageMain );
            compressFiles($path);
            compressMobileFiles($pathMobile);
            $data['image'] = $path;
            $data['image_mobile'] = $pathMobile;
        }
        $page->update($data);
        return redirect()->route('contacts');

    }
}
