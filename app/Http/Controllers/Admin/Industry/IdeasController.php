<?php

namespace App\Http\Controllers\Admin\Industry;

use App\Http\Controllers\Controller;
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
        $industryCategories = IndustryCategory::all();
        $title = trans('panel.industry_product_categories');
        return view('panel.industry.categories', compact(  'industryCategories','title'));

    }

    public function createCategory()
    {
        $title = trans('panel.add_category') ;

        return view('panel.industry.createCategory', compact( 'title'));
    }

    public function createCategoryProducts(Industry $industry)
    {
        $title = trans('panel.add_industry_products') ;

        $industryCategories = IndustryCategory::where('industry_id', $industry->id)->get();
        $products = Product::all();

        return view('panel.industry.createCategoryProducts', compact( 'title', 'industry', 'industryCategories', 'products'));
    }


    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);

        $industryCategory = IndustryCategory::firstOrCreate($data);

        if($industryCategory) {
            return  back()->with('flash_message_success', 'Industry products category a fost adaugat');
        } else {
            return back()->with('flash_message_error', 'Industry products category n-a fost creat');
        }
    }

    public function storeCategoryProducts(Request $request)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'industry_category_id' => 'required|integer',
            'products' => 'required|array',
        ]);

        $products = $data['products'];

        if($products) {
            foreach ($products as $product) {
                $item = new IndustryProduct();
//            $item->industry_id = $data['industry_id'];
                $item->industry_category_id = $data['industry_category_id'];
                $item->product_id = $product;
                $item->save();
            }
            return redirect()->route('industry.edit', $data['industry_id']);
        } else {
            return back()->with('flash_message_error', 'Industry products n-a fost creat');
        }
    }


    public function editCategory(IndustryCategory $industryCategory)
    {

        return view('panel.industry.editCategory', compact(   'industryCategory'));
    }

    public function updateCategory(Request $request, IndustryCategory $industryCategory)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'name_en' => 'required|min:1|string',
            'name_ro' => 'required|min:1|string',
            'name_ru' => 'required|min:1|string',
        ]);


        if($industryCategory->update($data)) {
            return  redirect()->route('industry.categories');
        } else {
            return back()->with('flash_message_error', 'Industry products category n-a fost editat');
        }
    }
    public function deleteCategory(IndustryCategory $industryCategory)
    {

        $industryCategory->delete();
        return redirect()->route('industry.categories');
    }

    public function editCategoryProducts(IndustryCategory $industryCategory, Industry $industry)
    {
        $title = trans('panel.edit_industry_products') ;
        $industryCategories = IndustryCategory::all();
        $products = Product::all();
        $industryProducts = IndustryProduct::where('industry_category_id', $industryCategory->id)->get();

        foreach ($products as $product) {
            foreach ($industryProducts as $item) {
                if($product->id == $item->product->id) {
                    $product['selected'] = true;
                }
            }
        }

        return view('panel.industry.editCategoryProducts', compact(   'title','industryCategory', 'industryCategories', 'products', 'industry'));
    }

    public function updateCategoryProducts(Request $request, IndustryCategory $industryCategory)
    {
        $data = $request->validate([
            'industry_id' => 'required|integer',
            'industry_category_id' => 'required|integer',
            'products' => 'required|array',
        ]);
//dd($data);



        if($industryCategory->products()->sync($data['products'])) {
            return redirect()->route('industry.edit', $data['industry_id']);
        } else {
            return back()->with('flash_message_error', 'Industry products category n-a fost editat');
        }
    }
    public function deleteCategoryProducts(IndustryCategory $industryCategory)
    {

        $industryCategory->delete();
        return redirect()->route('industry.categories');
    }


}
