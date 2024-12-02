<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\Category;
use App\Models\Industry;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\PageContent;
use App\Models\Role;
use App\Models\Slider;
use App\Models\SliderCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        $newsCategories = NewsCategory::all();
        $newsPage = PageContent::where('page', 'news')->first();
        $title = 'News';
        return view('panel.news.index', compact('news', 'title', 'newsCategories', 'newsPage'));

    }
    public function create()
    {
        $title = 'Adauga News';
        $news = News::all();
        $newsCategories = NewsCategory::all();
        return view('panel.news.create', compact( 'news','title', 'newsCategories'));
    }

    public function createCategory()
    {
        $title = 'Adauga News Category';

        return view('panel.news.createCategory', compact( 'title'));
    }
    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);

        $sliderCategory = NewsCategory::firstOrCreate($data);

        if($sliderCategory) {
            return  back()->with('flash_message_success', 'slider category a fost adaugat');
        } else {
            return back()->with('flash_message_error', 'slider category n-a fost creat');
        }
    }

    public function show(News $news)
    {
        return view('panel.news.show', compact(   'news'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $image = $request->file('image');
        $imageMain = $request->file('image_main');

        if(isset( $image)) {
            $path = Storage::disk('public')->put('/images/news' , $image );
            compressFiles($path);
            $data['image'] = $path;
        }
        if(isset( $imageMain)) {
            $path = Storage::disk('public')->put('/images/news' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }


        $news = News::firstOrCreate($data);

      if($news) {
          return redirect()->route('news');
      } else {
          return back()->with('flash_message_error', 'news n-a fost creat');
      }
    }

    public function edit(News $news)
    {
            $title = 'Editarea News';
            $newsCategories = NewsCategory::all();

            return view('panel.news.edit', compact( 'title',  'news', 'newsCategories'));
    }

    public function update(UpdateRequest $request, News $news)
    {
        $data = $request->validated();
        $image = $request->file('image');
        $imageMain = $request->file('image_main');

        if(isset( $image)) {
            if(isset($news->image)) {
                Storage::disk('public')->delete($news->image);
            }
            $path = Storage::disk('public')->put('/images/news' , $image );
            compressFiles($path);
            $data['image'] = $path;
        }
        if(isset( $imageMain)) {
            if(isset($news->image_main)) {
                Storage::disk('public')->delete($news->image_main);
            }
            $path = Storage::disk('public')->put('/images/news' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }

        $news->update($data);
        return redirect()->route('news');
    }

    public function delete(News $news)
    {
        if(isset($news->image)) {
            Storage::disk('public')->delete($news->image);
        }
        if(isset($news->image_main)) {
            Storage::disk('public')->delete($news->image_main);
        }
        $news->delete();
        return redirect()->route('news');
    }

    public function editPage(PageContent $newsPage)
    {
        return view('panel.news.editPage', compact('newsPage'));
    }

    public function updatePage(Request $request, PageContent $newsPage)
    {
        $data=$request->validate([
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'image' => 'nullable',
        ]);

        $imageMain = $request->file('image');

        if(isset( $imageMain)) {
            if(isset($newsPage->image)) {
                Storage::disk('public')->delete($newsPage->image);
            }
            if(isset($newsPage->image_mobile)) {
                Storage::disk('public')->delete($newsPage->image_mobile);
            }
            $path = Storage::disk('public')->put('/images/news' , $imageMain );
            $pathMobile = Storage::disk('public')->put('/images/news/mobile' , $imageMain );
            compressFiles($path);
            compressMobileFiles($pathMobile);
            $data['image'] = $path;
            $data['image_mobile'] = $pathMobile;
        }
        $newsPage->update($data);
        return redirect()->route('news');

    }
}
