<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    public function createFeature(Product $product)
    {
        $title = 'Adauga Feature';


        return view('panel.product.createFeature', compact( 'title', 'product'));
    }

    public function storeFeature(Request $request)
    {
        $data=$request->validate([
            'product_id' => 'required|integer',
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'image' => 'nullable',
        ]);

        $image = $request->file('image');

        if(isset( $image)) {
            $path = Storage::disk('public')->put('/images/product/features' , $image );
            compressFiles($path);
            $data['image'] = $path;
        }

        $feature = ProductFeature::firstOrCreate($data);

        if($feature) {
            return redirect()->route('product.edit',$data['product_id']);
        } else {
            return back()->with('error', 'news n-a fost creat');
        }
    }

    public function editFeature(ProductFeature $feature, Product $product)
    {
        return view('panel.product.editFeature', compact('feature', 'product'));
    }


    public function updateFeature(Request $request, ProductFeature $feature)
    {
        $data=$request->validate([
            'product_id' => 'required|integer',
            'title_en' => 'required|min:1|string',
            'title_ro' => 'required|min:1|string',
            'title_ru' => 'required|min:1|string',
            'description_ro' => 'required|min:1|string',
            'description_ru' => 'required|min:1|string',
            'description_en' => 'required|min:1|string',
            'image' => 'nullable',
        ]);

        $imageMain = $request->file('image');

        if(isset( $imageMain)) {
            if(isset($feature->image)) {
                Storage::disk('public')->delete($feature->image);
            }
            $path = Storage::disk('public')->put('/images/product/features' , $imageMain );
            compressFiles($path);
            $data['image'] = $path;
        }
        $feature->update($data);
        return redirect()->route('product.edit', $data['product_id']);

    }

    public function deleteFeature(ProductFeature $feature, Product $product)
    {
        if(isset($feature->image)) {
            Storage::disk('public')->delete($feature->image);
        }

        $feature->delete();
        return redirect()->route('product.edit', $product->id);
    }
}
