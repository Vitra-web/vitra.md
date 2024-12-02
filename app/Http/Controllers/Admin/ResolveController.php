<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resolve\StoreRequest;
use App\Http\Requests\Resolve\UpdateRequest;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Resolve;
use App\Models\ResolveProduct;
use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Models\SolutionProduct;
use App\Models\SolutionRatio;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResolveController extends Controller
{
    public function index(Request $request)
    {
     $resolves = Resolve::all();

        $title = 'Solutii';
        return view('panel.resolve.index', compact('resolves',   'title'));
    }

    public function create()
    {
        $title = 'Adauga Solutie';
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();

        $products = Product::all();

        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $productsList = Product::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
            $industry['products'] = $productsList;
        }
        foreach ($categoriesAll as $category){
            $categoryList = Subcategory::where('category_id', $category->id)->get();
            $productCategory = ProductCategory::where('category_id', $category->id)->get();
            $category['subcategories'] = $categoryList;
            $productsCategory = [];
            if($productCategory) {
                foreach ($productCategory as $item) {
                    $productsCategory[]= Category::where('id', $item->category_id)->first();
                }
            }
            $category['products'] = $productsCategory;
        }




        return view('panel.resolve.create', compact( 'title',   'products', 'industriesAll', 'categoriesAll'));
    }
    public function show(Solution $portfolio)
    {

        return view('panel.solution.show', compact(   'portfolio', ));
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
            $path = Storage::disk('public')->put('/images/resolve' , $image );
            compressFiles($path);
            $data['image'] = $path;
        }

        $resolve = Resolve::firstOrCreate($data);

        if(isset( $items) & $items[0]->product_id != 0) {
            foreach ($items as $item) {

                $product = new ResolveProduct();

                $product->resolve_id = $resolve->id;
                $product->product_id = $item->product_id;
                $product->save();

            }

        }

        if($resolve) {
            return redirect()->route('resolve');
        } else {
            return back()->with('error', 'Solutie n-a fost creat');
        }
    }

    public function edit(Resolve $resolve)
    {
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();

        $products = Product::all();

        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $productsList = Product::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
            $industry['products'] = $productsList;
        }
        foreach ($categoriesAll as $category){
            $categoryList = Subcategory::where('category_id', $category->id)->get();
            $productCategory = ProductCategory::where('category_id', $category->id)->get();
            $category['subcategories'] = $categoryList;
            $productsCategory = [];
            if($productCategory) {
                foreach ($productCategory as $item) {
                    $productsCategory[]= Category::where('id', $item->category_id)->first();
                }
            }
            $category['products'] = $productsCategory;
        }

        $resolveProducts = [];
        $resolveProductsArray = ResolveProduct::where('resolve_id', $resolve->id)->get();

        if($resolveProductsArray) {
            foreach ($resolveProductsArray as $item) {
                $resolveProducts[]= Product::where('id', $item->product_id)->first();
            }
        }


        return view('panel.resolve.edit', compact(   'resolve', 'products', 'industriesAll', 'categoriesAll', 'resolveProducts'));
    }


    public function update(UpdateRequest $request, Resolve $resolve)
    {
        $data = $request->validated();

//        dd($data);
        if(isset($_POST['delete']))
        {
            $resolveProduct = ResolveProduct::where('resolve_id', $resolve->id)->where('product_id', $request->delete)->first();
            if($resolveProduct) {
                $resolveProduct->delete();
                return back()->with('success', 'Продукт удален');
            }else{
                return back()->with('error', 'Продукт не удален');
            }

        } elseif(isset($_POST['update'])){
            $image = $request->file('image');
            $items= json_decode($data['items']);

            unset($data['items']);
            if(isset( $image)) {
                if(isset($resolve->image)) {
                    Storage::disk('public')->delete($resolve->image);
                }
                $path = Storage::disk('public')->put('/images/solution' , $image );
                compressFiles($path);
                $data['image'] = $path;
            }

            $resolve->update($data);
            if(isset( $items) & $items[0]->product_id != 0) {
                foreach ($items as $item) {
                    $product = ResolveProduct::where('product_id',$item->product_id )->where('resolve_id',$resolve->id )->first();
//dump($product);

                    if(!isset($product) && $item->product_id != 0) {
                        $newProduct = new ResolveProduct();
                        $newProduct->resolve_id = $resolve->id;
                        $newProduct->product_id = $item->product_id;
                        $newProduct->save();
                    }

                }

            }
//            dd('yes');
            return back()->with('success', 'Soluție a schimbat');

        }

    }

    public function delete(Resolve $resolve)
    {

        if(isset($resolve->image)) {
            Storage::disk('public')->delete($resolve->image);
        }

        $resolve->delete();
        return redirect()->route('resolve');
    }
}
