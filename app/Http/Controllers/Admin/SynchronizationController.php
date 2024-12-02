<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\CategoryIdeaProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\ProductVariant;
use App\Models\Role;
use App\Models\SolutionProduct;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Datlechin\GoogleTranslate\Facades\GoogleTranslate;


class SynchronizationController extends Controller
{
    public function index()
    {
        $login = 'HTTPServices';
        $password = 'Vitra123$';


        $categoriesSelected = Category::where('industry_id', 3)->get();


//          -----------------  delete products -----------------

//        $products = Product::where('industry_id', 3)->get();
//
//        foreach ($products as $product) {
//            if($product->id !=19 ) {
//                $solutionProducts = SolutionProduct::where('product_id',$product->id )->get();
//                if(count($solutionProducts) >0) {
//                    foreach ($solutionProducts as $solutionProduct) {
//                        $solutionProduct->delete();
//                    }
//                }
//
//                $categoryIdeaProducts = CategoryIdeaProduct::where('product_id',$product->id )->get();
//                if(count($categoryIdeaProducts) >0) {
//                    foreach ($categoryIdeaProducts as $categoryProduct) {
//                        $categoryProduct->delete();
//                    }
//                }
//                $product->update(['status'=>0]);
//            }
//        }
//
//        dd('end');
        //          ----------------- end delete products -----------------


        //          -----------------  download by subcategory -----------------

//        foreach($categoriesSelected as $categorySelected) {
//            $subcategoriesSelected = Subcategory::where('industry_id', 4)->where('category_id', $categorySelected->id)->get();
//
//            foreach($subcategoriesSelected as $subcategory) {
//                $code_1c = $subcategory->code_1c;
                $code_1c = '4d1a02a1-f7f7-11ee-b52c-4cd98f29f38d';

                if ($code_1c) {
                    $response = Http::withHeaders([
                        'Authorization' => "Basic " . base64_encode($login . ":" . $password),
                    ])->connectTimeout(200)->get('http://77.89.199.134/ViTRA_SQL/hs/WebSiteExchange/GetNomenclature/?GUID=' . $code_1c);
                    $result = json_decode($response, true);
            dump($result);
            if(count($result['items']) > 0) {
                foreach ($result['items'] as $item) {
                    $productExist = Product::where('code_uuid', $item['UUID'])->first();


                    $categories = $item['categories'];
                    $subcategories = $item['subcategories'];

                    if (!$productExist) {
                        $nameRo = $item['name_ro'];
                        $translateEn = GoogleTranslate::source('ro')
                            ->target('en')
                            ->translate($nameRo);
                        $nameEn = $translateEn->getTranslatedText();

                        $translateRu = GoogleTranslate::source('ro')
                            ->target('ru')
                            ->translate($nameRo);
                        $nameRu = $translateRu->getTranslatedText();
                        $postData = [
                            'code_uuid' => $item['UUID'],
                            'code_1c' => $item['ID'],
                            'status' => $item['is_visible'] ? 1 : 0,
                            'name_ro' => $nameRo,
                            'name_ru' => $nameRu,
                            'name_en' => $nameEn,
                            'description_ro' => $item['specification_ro'],
                            'description_ru' => $item['specification_ru'],
                            'description_en' => $item['specification_en'],
                            'industry_id' => 2,

                            'price' => $item['price'],
                            'image_preview' => 'images/product/No-image-available.png',
                        ];
                        $attributes = $item['attributes'];
                        if (count($attributes) > 0) {
                            foreach ($attributes as $attribute) {
                                if ($attribute['name_en'] == 'Dimensions') {
                                    $postData['dimension'] = str_replace("mm", "", $attribute['value_ro']);
                                }
                                if ($attribute['name_en'] == 'Color') {
                                    $postData['color'] = strtolower($attribute['value_en']);
                                    $postData['color_name_ro'] = $attribute['value_ro'];
                                    $postData['color_name_ru'] = $attribute['value_ru'];
                                    $postData['color_name_en'] = $attribute['value_en'];
                                }
                                if ($attribute['name_en'] == 'Material') {
                                    $postData['material_ro'] = $attribute['value_ro'];
                                    $postData['material_ru'] = $attribute['value_ru'];
                                    $postData['material_en'] = $attribute['value_en'];
                                }
                                if ($attribute['name_en'] == 'Destination') {
                                    $postData['destination_ro'] = $attribute['value_ro'];
                                    $postData['destination_ru'] = $attribute['value_ru'];
                                    $postData['destination_en'] = $attribute['value_en'];
                                }
                                if ($attribute['name_en'] == 'Shelf type') {
                                    $postData['shelf_type_ro'] = $attribute['value_ro'];
                                    $postData['shelf_type_ru'] = $attribute['value_ru'];
                                    $postData['shelf_type_en'] = $attribute['value_en'];
                                }
                                if ($attribute['name_en'] == 'Weight') {
                                    $postData['weight'] = str_replace(" kg", "", $attribute['value_ro']);
                                }
                            }
                        }

            //                    dd($postData);
                        $product = Product::firstOrCreate($postData);

                        $productId = $product->id;

                        $options = $item['options'];

                         foreach ($categories as $category) {
                                $categoryDb = Category::where('code_1c', $category['UUID'])->first();
                                if($categoryDb) {
                                    $productCategory = ProductCategory::where('product_id', $productId)->where('category_id', $categoryDb['id'])->first();
                                } else {
                                    $productCategory = null;
                                }

                                if($categoryDb && !$productCategory ) {
                                    $categoriesData = [
                                        'category_id' => $categoryDb['id'],
                                        'product_id' => $productId
                                    ];
                                    ProductCategory::firstOrCreate($categoriesData);
                                }
                        }


                            foreach ($subcategories as $subcategory) {
                                $subcategoryDb = Subcategory::where('code_1c', $subcategory['UUID'])->first();
                                if($subcategoryDb) {
                                    $productSubcategory = ProductSubCategory::where('product_id', $productId)->where('subcategory_id', $subcategoryDb['id'])->first();
                                } else {
                                    $productSubcategory = null;
                                }

                                if($subcategoryDb && !$productSubcategory) {
                                    $subcategoriesData = [
                                        'subcategory_id' => $subcategoryDb['id'],
                                        'product_id' => $productId
                                    ];
                                    ProductSubCategory::firstOrCreate($subcategoriesData);
                                }

                            }



                        if (count($options) > 0) {
                            foreach ($options as $option) {
                                $variantsData = [
                                    'product_id'=>$productId,
                                    'code'=>$option['ID'],
                                    'price'=>$option['price'],
                                    'color'=>strtolower($option['color_en']),
                                    'color_name_ro'=>$option['color_ro'],
                                    'color_name_ru'=>$option['color_ru'],
                                    'color_name_en'=>$option['color_en'],
                                    'dimension' => str_replace("mm", "", $option['dimensions_ro']),
                                ];
                                ProductVariant::firstOrCreate($variantsData);
                            }

                        }
                    }
                else {
                    $productId = $productExist->id;
                    foreach ($categories as $category) {
                        $categoryDb = Category::where('code_1c', $category['UUID'])->first();
                        if($categoryDb) {
                            $productCategory = ProductCategory::where('product_id', $productId)->where('category_id', $categoryDb['id'])->first();
                        } else {
                            $productCategory = null;
                        }

                        if($categoryDb && !$productCategory ) {
                            $categoriesData = [
                                'category_id' => $categoryDb['id'],
                                'product_id' => $productId
                            ];
                            ProductCategory::firstOrCreate($categoriesData);
                        }
                    }


                    foreach ($subcategories as $subcategory) {
                        $subcategoryDb = Subcategory::where('code_1c', $subcategory['UUID'])->first();
                        if($subcategoryDb) {
                            $productSubcategory = ProductSubCategory::where('product_id', $productId)->where('subcategory_id', $subcategoryDb['id'])->first();
                        } else {
                            $productSubcategory = null;
                        }

                        if($subcategoryDb && !$productSubcategory) {
                            $subcategoriesData = [
                                'subcategory_id' => $subcategoryDb['id'],
                                'product_id' => $productId
                            ];
                            ProductSubCategory::firstOrCreate($subcategoriesData);
                        }

                    }

                }

                }
            }



                }
//            }
//
//        }

        //          ----------------- end  download by subcategory -----------------


        //          -----------------  download by subcategory -----------------

//        foreach($categoriesSelected as $subcategory) {
////            $subcategoriesSelected = Subcategory::where('industry_id', 4)->where('category_id', $categorySelected->id)->get();
//
//
//                $code_1c = $subcategory->code_1c;
//
//                if ($code_1c) {
//                    $response = Http::withHeaders([
//                        'Authorization' => "Basic " . base64_encode($login . ":" . $password),
//                    ])->connectTimeout(200)->get('http://77.89.199.134/ViTRA_SQL/hs/WebSiteExchange/GetNomenclature/?GUID=' . $code_1c);
//                    $result = json_decode($response, true);
////                    dump($result);
//                    if(count($result['items']) > 0) {
//                        foreach ($result['items'] as $item) {
//                            $productExist = Product::where('code_uuid', $item['UUID'])->first();
//
//
//                            $categories = $item['categories'];
//                            $subcategories = $item['subcategories'];
////                    foreach ($categories as $category) {
////                        dump('category', $category);
////                    }
////                    foreach ($subcategories as $subcategory) {
////                        dump('subcategory', $subcategory);
////                    }
//                            if (!$productExist) {
//                                dump($item);
//
////                                $postData = [
////                                    'code_uuid' => $item['UUID'],
////                                    'code_1c' => $item['ID'],
////                                    'status' => $item['is_visible'] ? 1 : 0,
////                                    'name_ro' => $item['name_ro'],
////                                    'name_ru' => $item['name_ru'],
////                                    'name_en' => $item['name_en'],
////                                    'description_ro' => $item['specification_ro'],
////                                    'description_ru' => $item['specification_ru'],
////                                    'description_en' => $item['specification_en'],
////                                    'industry_id' => 4,
////
////                                    'price' => $item['price'],
////                                    'image_preview' => 'images/product/No-image-available.png',
////                                ];
////                                $attributes = $item['attributes'];
////                                if (count($attributes) > 0) {
////                                    foreach ($attributes as $attribute) {
////                                        if ($attribute['name_en'] == 'Dimensions') {
////                                            $postData['dimension'] = str_replace("mm", "", $attribute['value_ro']);
////                                        }
////                                        if ($attribute['name_en'] == 'Color') {
////                                            $postData['color'] = strtolower($attribute['value_en']);
////                                            $postData['color_name_ro'] = strtolower($attribute['value_ro']);
////                                            $postData['color_name_ru'] = strtolower($attribute['value_ru']);
////                                            $postData['color_name_en'] = strtolower($attribute['value_en']);
////                                        }
////                                        if ($attribute['name_en'] == 'Material') {
////                                            $postData['material_ro'] = strtolower($attribute['value_ro']);
////                                            $postData['material_ru'] = strtolower($attribute['value_ru']);
////                                            $postData['material_en'] = strtolower($attribute['value_en']);
////                                        }
////                                        if ($attribute['name_en'] == 'Destination') {
////                                            $postData['destination_ro'] = strtolower($attribute['value_ro']);
////                                            $postData['destination_ru'] = strtolower($attribute['value_ru']);
////                                            $postData['destination_en'] = strtolower($attribute['value_en']);
////                                        }
////                                    }
////                                }
////
////                                //                    dd($postData);
////                                $product = Product::firstOrCreate($postData);
////
////                                $productId = $product->id;
////                                $categories = $item['subcategories'];
////
////                                $options = $item['options'];
////
////
////                                foreach ($categories as $category) {
////                                    $categoryDb = Category::where('code_1c', $category['UUID'])->first();
////                                    if($categoryDb) {
////                                        $productCategory = ProductCategory::where('product_id', $productId)->where('category_id', $categoryDb['id'])->first();
////                                    } else {
////                                        $productCategory = null;
////                                    }
////
////                                    if($categoryDb && !$productCategory ) {
////                                        $categoriesData = [
////                                            'category_id' => $categoryDb['id'],
////                                            'product_id' => $productId
////                                        ];
////                                        ProductCategory::firstOrCreate($categoriesData);
////                                    }
////                                }
////
////
////
////
////
////                                if (count($options) > 0) {
////                                    foreach ($options as $option) {
////                                        $versionsData = [
////                                            'code' => $option['ID'],
////                                            'product_id' => $productId,
////                                            'price' => $option['price']
////
////                                        ];
////                                        ProductVariant::firstOrCreate($versionsData);
////                                    }
////
////                                }
//                            }
////                            else {
////                                dump('yes');
////
////                                $productId = $productExist->id;
////                                foreach ($categories as $category) {
////                                    $categoryDb = Category::where('code_1c', $category['UUID'])->first();
////                                    if($categoryDb) {
////                                        $productCategory = ProductCategory::where('product_id', $productId)->where('category_id', $categoryDb['id'])->first();
////                                    } else {
////                                        $productCategory = null;
////                                    }
////
////                                    if($categoryDb && !$productCategory ) {
////                                        $categoriesData = [
////                                            'category_id' => $categoryDb['id'],
////                                            'product_id' => $productId
////                                        ];
////                                        ProductCategory::firstOrCreate($categoriesData);
////                                    }
////                                }
////
////
////                                foreach ($subcategories as $subcategory) {
////                                    $subcategoryDb = Subcategory::where('code_1c', $subcategory['UUID'])->first();
////                                    if($subcategoryDb) {
////                                        $productSubcategory = ProductSubCategory::where('product_id', $productId)->where('subcategory_id', $subcategoryDb['id'])->first();
////                                    } else {
////                                        $productSubcategory = null;
////                                    }
////
////                                    if($subcategoryDb && !$productSubcategory) {
////                                        $subcategoriesData = [
////                                            'subcategory_id' => $subcategoryDb['id'],
////                                            'product_id' => $productId
////                                        ];
////                                        ProductSubCategory::firstOrCreate($subcategoriesData);
////                                    }
////
////                                }
////
////                            }
//
//                        }
//                    }
//
//
//
//                }
//
//
//        }

        //          ----------------- end  download by subcategory -----------------



            dd('yes');

        }

}
