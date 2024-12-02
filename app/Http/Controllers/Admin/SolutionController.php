<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Solution\StoreRequest;
use App\Http\Requests\Solution\UpdateRequest;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;
use App\Models\Product;
use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Models\SolutionProduct;
use App\Models\SolutionRatio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolutionController extends Controller
{
    public function index(Request $request)
    {
        $industries = Industry::all();
        $solutionCategories = SolutionCategory::all();
        $solutions = Solution::when($request->category != null, function ($q) use ($request) {
            return $q->where('category_id', $request->category);
        })->get();

        $title = 'Solutii';
        return view('panel.solution.index', compact('solutions',  'solutionCategories','industries', 'title'));
    }

    public function create()
    {
        $title = 'Adauga Solutie';
        $industries = Industry::all();
        $solutionCategories = SolutionCategory::all();
        $products=Product::all();
        $ratios = SolutionRatio::all();

        foreach ($industries as $industry){
            $categoryList = SolutionCategory::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }

        return view('panel.solution.create', compact( 'title',  'industries', 'solutionCategories', 'products', 'ratios'));
    }
    public function show(Solution $portfolio)
    {

        return view('panel.solution.show', compact(   'portfolio', ));
    }

    public function categories(Request $request)
    {
        $solutionCategories = SolutionCategory::all();
        $title = 'Solution categories';
        return view('panel.solution.categories', compact(  'solutionCategories','title'));

    }

    public function createCategory()
    {
        $title = 'Add solution Category';
        $industries = Industry::all();
        return view('panel.solution.createCategory', compact( 'title', 'industries'));
    }
    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);

        $solutionCategory = SolutionCategory::firstOrCreate($data);

        if($solutionCategory) {
            return back()->with('success', 'solution category a fost adaugat');
        } else {
            return back()->with('error', 'solution category n-a fost creat');
        }
    }

    public function editCategory(SolutionCategory $solutionCategory)
    {
        $industries = Industry::all();
        return view('panel.solution.editCategory', compact(   'solutionCategory', 'industries'));
    }

    public function updateCategory(Request $request, SolutionCategory $solutionCategory)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);


        if($solutionCategory->update($data)) {
            return back()->with('success', 'solution category a fost editat');
        } else {
            return back()->with('error', 'solution category n-a fost editat');
        }
    }
    public function deleteCategory(SolutionCategory $solutionCategory)
    {

        $solutionCategory->delete();
        return redirect()->route('solution.categories');
    }

    public function mainPageSolutions()
    {
        $industries = Industry::all();
        $retailSolutions = Solution::where('industry_id', 1)->where('main_page', 1)->orderBy('sort_order', 'asc')->limit(5)->get();
        $lifeSolutions = Solution::where('industry_id', 4)->where('main_page', 1)->get();
        $logisticSolutions = Solution::where('industry_id', 2)->where('main_page', 1)->limit(4)->get();
        $horecaSolutions = Solution::where('industry_id', 3)->where('main_page', 1)->limit(5)->get();
        $solutionProducts = SolutionProduct::all();
        $portfolios = Portfolio::all();
        $title = 'Pagina principala';
        return view('panel.mainPage.index', compact( 'title', 'retailSolutions', 'lifeSolutions','logisticSolutions', 'horecaSolutions',
            'solutionProducts', 'industries', 'portfolios' ));
    }
    public function  editSolution(Solution $solution)
    {
        $products=Product::all();
        $solutionProducts=SolutionProduct::where('solution_id', $solution->id)->get();
        return view('panel.mainPage.edit', compact( 'solutionProducts', 'solution', 'products'));

    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

//        dd($data);
        $image = $request->file('image');
        $items= json_decode($data['items']);
//        dd($items[0]->product_id);
        unset($data['items']);
        if(isset( $image)) {
            $path = Storage::disk('public')->put('/images/solution' , $image );
            compressFiles($path);
            $data['image'] = $path;
        }

        $solution = Solution::firstOrCreate($data);

        if(isset( $items) & $items[0]->product_id != 0) {
            foreach ($items as $item) {

                $product = new SolutionProduct();

                $product->solution_id = $solution->id;
                $product->product_id = $item->product_id;
                $product->percent_x = $item->percent_x;
                $product->percent_y = $item->percent_y;
                $product->save();

            }

        }

        if($solution) {
            return redirect()->route('solution');
        } else {
            return back()->with('error', 'Solutie n-a fost creat');
        }
    }

    public function edit(Solution $solution)
    {

        $industries = Industry::all();
        $categoriesOld = SolutionCategory::where('industry_id', $solution->industry_id)->get();
        $products=Product::all();
        $solutionProducts=SolutionProduct::where('solution_id', $solution->id)->get();
        $ratios = SolutionRatio::all();
        foreach ($industries as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }


        return view('panel.solution.edit', compact(   'solution', 'products', 'industries', 'categoriesOld', 'solutionProducts', 'ratios'));
    }

    public function update(UpdateRequest $request, Solution $solution)
    {
        $data = $request->validated();

        if(isset($_POST['delete']))
        {
            $product = SolutionProduct::where('product_id',$request->delete )->where('solution_id',$solution->id )->first();

//            dd($request->delete);
            if(isset($product)) {
                $product->delete();
                return back()->with('success', 'Продукт удален');
            } else{
                return back()->with('error', 'Продукт не удален');
            }


        } elseif(isset($_POST['update'])){
            $image = $request->file('image');
            $items= json_decode($data['items']);


            unset($data['items']);
            if(isset( $image)) {
                if(isset($solution->image)) {
                    Storage::disk('public')->delete($solution->image);
                }
                $path = Storage::disk('public')->put('/images/solution' , $image );
                compressFiles($path);
                $data['image'] = $path;
            }
            if(isset($data['main_page'])) {
                $data['main_page'] =1;
            }else $data['main_page'] = null;
            $solution->update($data);
            if(isset( $items) & $items[0]->product_id != 0) {
                foreach ($items as $item) {
                    $product = SolutionProduct::where('product_id',$item->product_id )->where('solution_id',$solution->id )->first();
//dump($product);

                    if(isset($product)){
                        $product->update(['percent_x'=>$item->percent_x , 'percent_y'=>$item->percent_y ]);
                    } else {
                        if($item->product_id != 0) {
                            $newProduct = new SolutionProduct();
                            $newProduct->solution_id = $solution->id;
                            $newProduct->product_id = $item->product_id;
                            $newProduct->percent_x = $item->percent_x;
                            $newProduct->percent_y = $item->percent_y;
                            $newProduct->save();
                        }

                    }

                }

            }
//            dd('yes');
            return back()->with('success', 'Soluție a schimbat');
//            if(str_contains(url()->previous(), 'panel/home-page'))
//            {
//                return redirect()->route('mainPage.editSolution');
//            } else return redirect()->route('solution');

        }


    }

    public function delete(Solution $solution)
    {

        if(isset($solution->image)) {
            Storage::disk('public')->delete($solution->image);
        }
        $solutionProducts=SolutionProduct::where('solution_id', $solution->id)->get();

        if($solutionProducts) {
            foreach ($solutionProducts as $solutionProduct) {
                $solutionProduct->delete();
            }
        }

        $solution->delete();
        return redirect()->route('solution');
    }
}
