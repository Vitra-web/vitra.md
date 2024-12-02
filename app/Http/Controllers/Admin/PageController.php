<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = PageContent::where('id', '>', 5)->get();
        $title = 'Pagini';
        return view('panel.pages.index', compact( 'title', 'pages'));

    }
    public function edit(PageContent $page)
    {
        return view('panel.pages.edit', compact('page'));
    }

    public function update(Request $request, PageContent $page)
    {
        $data=$request->validate([
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
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
            $path = Storage::disk('public')->put('/images/pages' , $imageMain );
            $pathMobile = Storage::disk('public')->put('/images/pages/mobile' , $imageMain );
            compressFiles($path);
            compressMobileFiles($pathMobile);
            $data['image'] = $path;
            $data['image_mobile'] = $pathMobile;
        }
        $page->update($data);
        return redirect()->route('pages');

    }
}
