<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Industry\StoreRequest;
use App\Http\Requests\Industry\UpdateRequest;
use App\Models\Category;
use App\Models\Industry;
use App\Models\IndustryCategory;
use App\Models\IndustryProduct;
use App\Models\PortfolioCategory;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::all();
        $title = 'Industrii';
        return view('panel.industry.index', compact('industries', 'title'));

    }
    public function create()
    {
        $title = 'Adauga Industrie';
        $industries = Industry::all();
        return view('panel.industry.create', compact( 'industries','title'));
    }

    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        $imagePreview = $request->file('image_preview');
        $imageMain = $request->file('image_main');
        $pdfFile = $request->file('pdf');

        if(isset( $imagePreview)) {
            $path = Storage::disk('public')->put('/images/industries' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }
        if(isset( $imageMain)) {
            $path = Storage::disk('public')->put('/images/industries' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }

        $industry = Industry::firstOrCreate($data);
        if(isset( $pdfFile)) {
            $file_ext = $pdfFile->getClientOriginalExtension();
            $newName = $industry->name. "-catalog." . $file_ext;
            $path = Storage::disk('public')->putFileAs('/images/industries',  $pdfFile, $newName);
            $data['pdf'] = 'images/industries/'. $newName;
            $data['pdf_size'] =round($pdfFile->getSize()/1000000, 1) ;
        }

      if($industry) {
          return redirect()->route('industry');
      } else {
          return back()->with('flash_message_error', 'industry n-a fost creat');
      }
    }

    public function categories()
    {
        $industryCategories = IndustryCategory::all();
        $title = 'Industry products categories';
        return view('panel.industry.categories', compact(  'industryCategories','title'));

    }

    public function createCategory()
    {
        $title = 'Adauga Industry products Category';

        return view('panel.industry.createCategory', compact( 'title'));
    }

    public function createCategoryProducts(Industry $industry)
    {
        $title = 'Adauga Industry products';

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
        $title = 'Edit Industry products';
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

    public function edit(Industry $industry)
    {
            $title = 'Editarea Industriei';
            $industryCategories = IndustryCategory::where('industry_id', $industry->id)->get();
            $industryProducts = IndustryProduct::all();


        foreach ($industryCategories as $category) {
            $products = [];
            foreach ($industryProducts as $item) {
                if($category->id == $item->industry_category_id) {
                    $products[] = $item->product;
                }
            }
            $category['addProducts'] = $products;
        }

//dd($industryCategories);

            return view('panel.industry.edit', compact( 'title',  'industry', 'industryCategories'));
    }

    public function update(UpdateRequest $request, Industry $industry)
    {
        $data = $request->validated();
        $imagePreview = $request->file('image_preview');
        $imageMain = $request->file('image_main');
        $pdfFile = $request->file('pdf');

        if(isset( $imagePreview)) {
            if(isset($industry->image_preview)) {
                Storage::disk('public')->delete($industry->image_preview);
            }
            $path = Storage::disk('public')->put('/images/industries' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }
        if(isset( $imageMain)) {
            if(isset($industry->image_main)) {
                Storage::disk('public')->delete($industry->image_main);
            }
            $path = Storage::disk('public')->put('/images/industries' , $imageMain );
            compressFiles($path);
            $data['image_main'] = $path;
        }

        if(isset( $pdfFile)) {
            $file_ext = $pdfFile->getClientOriginalExtension();
            $newName = $industry->name. "-catalog." . $file_ext;
            $path = Storage::disk('public')->putFileAs('/images/industries',  $pdfFile, $newName);
            $data['pdf'] = 'images/industries/'. $newName;
            $data['pdf_size'] =round($pdfFile->getSize()/1000000, 1) ;

        }

        $industry->update($data);
        return redirect()->route('industry');
    }

    public function delete(Industry $industry)
    {
        if(isset($industry->image_preview)) {
            Storage::disk('public')->delete($industry->image_preview);
        }
        if(isset($industry->image_main)) {
            Storage::disk('public')->delete($industry->image_main);
        }
        $categories=Category::where('industry_id', $industry)->get();
        if(isset($categories)) {
            foreach ($categories as $category) {
                $category->delete();
            }
        }
        $industry->delete();
        return redirect()->route('industry');
    }
}
