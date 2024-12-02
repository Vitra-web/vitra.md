<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryIdea;
use App\Models\CategoryIdeaProduct;
use App\Models\Industry;
use App\Models\IndustryCategory;
use App\Models\IndustryProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function categories()
    {
        $categoryIdeas = CategoryIdea::all();
        $title = trans('panel.category_products_categories') ;
        return view('panel.category.categories', compact(  'categoryIdeas','title'));

    }

    public function createCategory()
    {
        $title = trans('panel.add_category_products_category') ;

        return view('panel.category.createCategory', compact( 'title'));
    }

    public function createCategoryProducts(Industry $industry, Category $category)
    {
        $title = trans('panel.add_category_products') ;

        $categoryIdeas = CategoryIdea::where('industry_id', $industry->id)->get();
        $products = Product::all();

        return view('panel.category.createCategoryProducts', compact( 'title', 'industry', 'category', 'categoryIdeas', 'products'));
    }


    public function storeCategory(Request $request)
    {
//        dd($request);
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);

        $data['category_id'] = 1;

        $categoryIdea = CategoryIdea::firstOrCreate($data);

        if($categoryIdea) {
            return  back()->with('flash_message_success', 'Industry products category a fost adaugat');
        } else {
            return back()->with('flash_message_error', 'Industry products category n-a fost creat');
        }
    }

    public function storeCategoryProducts(Request $request)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'category_id' => 'required|integer',
            'category_idea_id' => 'required|integer',
            'products' => 'required|array',
        ]);

        $products = $data['products'];

        if($products) {
            foreach ($products as $product) {
                $item = new CategoryIdeaProduct();
                $item->category_id = $data['category_id'];
                $item->category_idea_id = $data['category_idea_id'];
                $item->product_id = $product;
                $item->save();
            }
            return redirect()->route('category.edit', $data['category_id']);
        } else {
            return back()->with('flash_message_error', 'Industry products n-a fost creat');
        }
    }


    public function editCategory(CategoryIdea $categoryIdea)
    {

        return view('panel.category.editCategory', compact(   'categoryIdea'));
    }

    public function updateCategory(Request $request, CategoryIdea $categoryIdea)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);
        $data['category_id'] = 1;

        if($categoryIdea->update($data)) {
            return  redirect()->route('category.categories');
        } else {
            return back()->with('flash_message_error', 'Industry products category n-a fost editat');
        }
    }
    public function deleteCategory(CategoryIdea $categoryIdea)
    {

        $categoryIdea->delete();
        return redirect()->route('category.categories');
    }

    public function editCategoryProducts(CategoryIdea $categoryIdea, Industry $industry, Category $category)
    {
        $title = trans('panel.edit_category_products') ;
        $categoryIdeas = CategoryIdea::all();
        $products = Product::all();
        $categoryProducts = CategoryIdeaProduct::where('category_idea_id', $categoryIdea->id)->get();

        foreach ($products as $product) {
            foreach ($categoryProducts as $item) {
                if($product->id == $item->product->id) {
                    $product['selected'] = true;
                }
            }
        }

        return view('panel.category.editCategoryProducts', compact(   'title','categoryIdea', 'categoryIdeas', 'products', 'industry', 'category'));
    }

    public function updateCategoryProducts(Request $request, CategoryIdea $categoryIdea)
    {
//        dd($request);
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'category_id' => 'required|integer',
            'category_idea_id' => 'required|integer',
            'products' => 'required|array',
        ]);
//dd($data);

$products = [];
        foreach ($data['products'] as $item ) {
            $products[]= [
                'product_id'=>$item,
                'category_id'=>$data['category_id'],
                'category_idea_id'=>$data['category_idea_id']
            ];

        }

//dd($products);
        if($categoryIdea->products()->sync($products)) {
            return redirect()->route('category.edit', $data['category_id']);
        } else {
            return back()->with('flash_message_error', 'Industry products category n-a fost editat');
        }
    }
//    public function deleteCategoryProducts(CategoryIdea $categoryIdea)
//    {
//
//        $categoryIdea->delete();
//        return redirect()->route('category.categories');
//    }

//    public function edit(Industry $industry)
//    {
//        $title = 'Editarea Industriei';
//        $industryCategories = CategoryIdea::where('industry_id', $industry->id)->get();
//        $industryProducts = IndustryProduct::all();
//
//
//        foreach ($industryCategories as $category) {
//            $products = [];
//            foreach ($industryProducts as $item) {
//                if($category->id == $item->industry_category_id) {
//                    $products[] = $item->product;
//                }
//            }
//            $category['addProducts'] = $products;
//        }
//
////dd($industryCategories);
//
//        return view('panel.category.edit', compact( 'title',  'industry', 'industryCategories'));
//    }
}
