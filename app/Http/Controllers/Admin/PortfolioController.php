<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\StoreRequest;
use App\Http\Requests\Portfolio\UpdateRequest;

use App\Models\Category;
use App\Models\Industry;
use App\Models\NewsCategory;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    private function dateHandler($data) {
        $data["date"] = explode(".", $data["date"]);
        $data["date"] = array_reverse($data["date"]);
        $data["date"] = implode("-",$data["date"]);
        $data["date"] = strtotime($data["date"]);
        return date('Y-m-d', $data["date"]);

    }
    public function index(Request $request)
    {
        $industries = Industry::all();
        $portfolioCategories = PortfolioCategory::all();
        $portfolios = Portfolio::when($request->industry != null, function ($q) use ($request) {
            return $q->where('industry_id', $request->industry);
        })->when($request->category != null, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->orderBy('sort_order', 'ASC')->get();
        $title = 'Portfolio';
        return view('panel.portfolio.index', compact('portfolios',  'industries', 'portfolioCategories','title'));

    }
    public function create()
    {
        $title = 'Adauga Portfolio';
        $industries = Industry::all();
        $portfolioCategories = PortfolioCategory::all();
        $portfolios = Portfolio::all();
        foreach ($industries as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }

        return view('panel.portfolio.create', compact( 'title',  'industries', 'portfolioCategories',  'portfolios'));
    }
    public function show(Portfolio $portfolio)
    {
        $images= PortfolioImage::where('portfolio_id', $portfolio->id)->get();

        return view('panel.portfolio.show', compact(   'portfolio', 'images'));
    }

    public function categories(Request $request)
    {
        $portfolioCategories = PortfolioCategory::all();
        $title = 'Portfolio categories';
        return view('panel.portfolio.categories', compact(  'portfolioCategories','title'));

    }

    public function createCategory()
    {
        $title = 'Adauga portfolio Category';
        $portfolioCategories = PortfolioCategory::all();

        return view('panel.portfolio.createCategory', compact( 'title', 'portfolioCategories'));
    }
    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
//            'sort_order' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);

        $portfolioCategory = PortfolioCategory::firstOrCreate($data);

        if($portfolioCategory) {
            return  back()->with('success', 'portfolio category a fost adaugat');
        } else {
            return back()->with('error', 'portfolio category n-a fost creat');
        }
    }

    public function editCategory(PortfolioCategory $portfolioCategory)
    {

        return view('panel.portfolio.editCategory', compact(   'portfolioCategory'));
    }

    public function updateCategory(Request $request, PortfolioCategory $portfolioCategory)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
//            'sort_order' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);


        if($portfolioCategory->update($data)) {
            return  back()->with('success', 'portfolio category a fost editat');
        } else {
            return back()->with('error', 'portfolio category n-a fost editat');
        }
    }
    public function deleteCategory(PortfolioCategory $portfolioCategory)
    {

        $portfolioCategory->delete();
        return redirect()->route('portfolio.categories');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $imagePreview = $request->file('image_preview');
        $imageMain = $request->file('image_main');

        $images = $request->file('images');
        unset($data['images']);
        if(isset( $imagePreview)) {
            $path = Storage::disk('public')->put('/images/portfolio/preview' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }
        if(isset( $imageMain)) {
            $path = Storage::disk('public')->put('/images/portfolio' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }


        $data['date'] = $this->dateHandler($data);

        // dd($data);
        $portfolio = Portfolio::firstOrCreate($data);

        if(isset( $images)) {
            foreach ($images as $item) {

                $image = new PortfolioImage();
                $path = Storage::disk('public')->put('/images/portfolio' , $item );
                compressFiles($path);
                $image->url = $path;
                $image->portfolio_id = $portfolio->id;

                if($item->getClientOriginalExtension() == 'mp4' || $item->getClientOriginalExtension() == 'mov' || $item->getClientOriginalExtension() == 'wmv' || $item->getClientOriginalExtension() == 'webm') {
                    $image->type='video';
                } else $image->type='image';
                $image->save();

            }

        }

        if($portfolio) {
            return redirect()->route('portfolio');
        } else {
            return back()->with('error', 'Portfolio n-a fost creat');
        }
    }

    public function edit(Portfolio $portfolio)
    {

        $industries = Industry::all();
        $portfolioCategories = PortfolioCategory::all();

//        foreach ($industries as $industry){
//            $categoryList = Category::where('industry_id', $industry->id)->get();
//            $industry['categories'] = $categoryList;
//        }

        $images= PortfolioImage::where('portfolio_id', $portfolio->id)->get();


        return view('panel.portfolio.edit', compact(   'portfolio', 'images', 'industries', 'portfolioCategories'));
    }

    public function update(UpdateRequest $request, Portfolio $portfolio)
    {
        $data = $request->validated();
        if(isset($_POST['delete']))
        {
            $image = PortfolioImage::where('id', $request->delete)->first();

            if(Storage::disk('public')->delete($image->url)) {
                $image->delete();
                return back()->with('success', 'Изображение удалено');
            }

            return back()->with('error', 'Изображение не удалено');
        } elseif(isset($_POST['update'])){

            $imagePreview = $request->file('image_preview');
            $imageMain = $request->file('image_main');
            $images = $request->file('images');
            unset($data['images']);

            if(isset( $imagePreview)) {
                if(isset($portfolio->image_preview)) {
                    Storage::disk('public')->delete($portfolio->image_preview);
                }
                $path = Storage::disk('public')->put('/images/portfolio' , $imagePreview );
                compressFiles($path);
                $data['image_preview'] = $path;
            }
            if(isset( $imageMain)) {
                if(isset($portfolio->image_main)) {
                    Storage::disk('public')->delete($portfolio->image_main);
                }
                $path = Storage::disk('public')->put('/images/portfolio' , $imageMain );
                compressFiles($path);
                $data['image_main'] = $path;
            }
            if(isset( $images)) {
                foreach ($images as $item) {
                    $image = new PortfolioImage();
                    $path = Storage::disk('public')->put('/images/portfolio' , $item );
                    compressFiles($path);
                    $image->url = $path;
                    $image->portfolio_id = $portfolio->id;

                    if($item->getClientOriginalExtension() == 'mp4' || $item->getClientOriginalExtension() == 'mov' || $item->getClientOriginalExtension() == 'wmv' || $item->getClientOriginalExtension() == 'webm') {
                        $image->type='video';
                    } else $image->type='image';
                    $image->save();
                }
            }


            $data["date"] = $this->dateHandler($data);

            $portfolio->update($data);
            return back()->with('success', 'Portfoliul schimbat ');
        }
    }

    public function delete(Portfolio $portfolio)
    {
        $images = PortfolioImage::where('portfolio_id', $portfolio->id)->get();
        if(isset($portfolio->image_preview)) {
            Storage::disk('public')->delete($portfolio->image_preview);
        }
        if(isset($portfolio->image_main)) {
            Storage::disk('public')->delete($portfolio->image_main);
        }
        if($images) {
            foreach ($images as $image) {
                if(Storage::disk('public')->delete($image->url)) {
                    $image->delete();
                }
            }
        }

        $portfolio->delete();
        return redirect()->route('portfolio');
    }

}
