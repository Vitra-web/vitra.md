<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Product;
use App\Models\SearchSetting;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
       $productTypes =SearchSetting::where('type', 'products')->orderBy('sort_order')->get();
       $categoryTypes =SearchSetting::where('type', 'categories')->orderBy('sort_order')->get();
        $title = 'Product types';
        $title2 = 'Category types';
        return view('panel.searchSetting.index', compact('title', 'title2','productTypes', 'categoryTypes' ));

    }
    public function createProductType()
    {
        $title = 'Add product type search';

        $searchSettings = SearchSetting::where('type', 'products')->get();
        $products = Product::all();
        return view('panel.searchSetting.createProductType', compact( 'title', 'searchSettings', 'products'));
    }
    public function createCategoryType()
    {
        $title = 'Add category type search';

        $searchSettings = SearchSetting::where('type', 'categories')->get();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('panel.searchSetting.createCategoryType', compact( 'title', 'searchSettings', 'categories', 'subcategories'));
    }

    public function storeProductType(Request $request) {

        $data = $request->validate([
            'sort_order'=>'required|integer',
            'name'=>'required|string',
            'item_id'=>'nullable|string',
            'value_ro'=>'nullable|string',
            'value_ru'=>'nullable|string',
            'value_en'=>'nullable|string',
        ]);
        $data['type']='products';

      $searchSetting =  SearchSetting::firstOrCreate($data);

        if($searchSetting) {
            return redirect()->route('searchSettings');
        } else {
            return back()->with('error', 'product type  n-a fost creat');
        }

    }

    public function storeCategoryType(Request $request) {

        $data = $request->validate([
            'sort_order'=>'required|integer',
            'name'=>'required|string',
            'category_id'=>'nullable|string',
            'subcategory_id'=>'nullable|string',
        ]);
        $data['type']='categories';
        if($data['category_id']) {
            $data['item_id'] = $data['category_id'];
        } elseif($data['subcategory_id']) {
            $data['item_id'] = $data['subcategory_id'];
        } else $data['item_id'] = 0;

        unset($data['category_id'], $data['subcategory_id']);
//dd($data);
        $searchSetting =  SearchSetting::firstOrCreate($data);

        if($searchSetting) {
            return redirect()->route('searchSettings');
        } else {
            return back()->with('error', 'product type  n-a fost creat');
        }

    }

    public function editProductType(SearchSetting $searchSetting) {

        $title = 'Edit product type search';
        $products = Product::all();
        return view('panel.searchSetting.editProductType', compact( 'title', 'searchSetting', 'products'));
    }

    public function editCategoryType(SearchSetting $searchSetting) {

        $title = 'Edit category type search';
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('panel.searchSetting.editCategoryType', compact( 'title', 'searchSetting', 'categories', 'subcategories'));
    }

    public function updateProductType(Request $request, SearchSetting $searchSetting) {
        $data = $request->validate([
            'sort_order'=>'required|integer',
            'name'=>'required|string',
            'item_id'=>'nullable|string',
            'value_ro'=>'nullable|string',
            'value_ru'=>'nullable|string',
            'value_en'=>'nullable|string',
        ]);

        if($data['name'] == 'tag') {
            $data['item_id'] = null;
        } elseif($data['name'] == 'product') {
            $data['value_ro'] = null;
            $data['value_ru'] = null;
            $data['value_en'] = null;
        }

        $searchSetting->update($data);
        return redirect()->route('searchSettings');
    }

    public function updateCategoryType(Request $request, SearchSetting $searchSetting) {
        $data = $request->validate([
            'sort_order'=>'required|integer',
            'name'=>'required|string',
            'category_id'=>'nullable|string',
            'subcategory_id'=>'nullable|string',
        ]);

        if($data['category_id'] && $data['name'] == 'category' ) {
            $data['item_id'] = $data['category_id'];
        } elseif($data['subcategory_id'] && $data['name'] == 'subcategory') {
            $data['item_id'] = $data['subcategory_id'];
        } else $data['item_id'] = 0;

        $searchSetting->update(['sort_order'=> $data['sort_order'], 'name'=> $data['name'],'item_id'=> $data['item_id']]);
        return redirect()->route('searchSettings');
    }

    public function delete(SearchSetting $searchSetting) {
        $searchSetting->delete();
        return redirect()->route('searchSettings');

    }
}
