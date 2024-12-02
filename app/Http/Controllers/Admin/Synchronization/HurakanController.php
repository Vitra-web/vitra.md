<?php

namespace App\Http\Controllers\Admin\Synchronization;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\ProductTypeImage;
use App\Models\ProductVariant;
use App\Models\Subcategory;
use Datlechin\GoogleTranslate\Facades\GoogleTranslate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Psy\Exception\ErrorException;
use Psy\Readline\Hoa\Exception;

class HurakanController extends Controller
{
    public function index() {
        $apiKey = env('HURAKAN_KEY');

        function downloadImage($image) {
            $ch = curl_init($image);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $info = curl_getinfo($ch);
            curl_close($ch);

            if($image && $info['http_code'] != 404) {
                $context = stream_context_create(array(
                    'http' => array('ignore_errors' => true),
                ));
                $contents = file_get_contents($image, false, $context);
                $name = substr($image, strrpos($image, '/') + 1);
                $path = 'images/product/scrapping/'.$name;
                Storage::disk('public')->put($path , $contents );
            } else $path = 'images/product/No-image-available.png';

            return $path;
        }



        $subcategories = Subcategory::where('hurakan_parsed', 1)->where('hurakan_parsed2', 0)->where('hurakan_category2', '!=', '')->get();
        dump($subcategories);
//        Дозаторы и охладители для воды
//        ->limit(5)
//        id=178
            $response = Http::get('https://api.equip.me/v1/dealer/products/categories/?apikey='.$apiKey.'&lang=ru' );
            $result = json_decode($response, true);
//            dd($result);
            if($result['response']['success']) {
//            dump($result['response']);

                $hurakanCategories = $result['response']['sections'];

                foreach ($hurakanCategories as $item) {
                    foreach($subcategories as $subcategory) {
                        $industryId = $subcategory->industry_id;
                        $categoryId = $subcategory->category_id;
                        $subcategoryId = $subcategory->id;
//                        dump(mb_strtolower($subcategory->hurakan_category1,'UTF-8'));
//                        dump(mb_strtolower($item['name'],'UTF-8'));
                    if($item['parent'] >0 && mb_strtolower($subcategory->hurakan_category2,'UTF-8') == mb_strtolower($item['name'],'UTF-8') ) {

//                        Миксеры для молочных коктейлей
//                        Миксеры для молочных коктейлей
                        dump($item);
                        $responseProducts = Http::get('https://api.equip.me/v1/dealer/products/?apikey='.$apiKey.'&with_add_desc=true&lang=ru&category_id='.$item['id'] );
                        $resultProducts = json_decode($responseProducts, true);
                        dump($resultProducts);
                        $hurakanProducts = $resultProducts['response']['products'];
                        if($resultProducts['response']['success'] && count($hurakanProducts) >0) {

                            foreach ($hurakanProducts as $hurakanProduct) {
                                $brand = $hurakanProduct['fields']['brand'];
                                $code = $hurakanProduct['code_1c'];
                                $brandExist = Brand::where('name', $brand)->first();
                                if(!$brandExist) {
                                    $newBrand = new Brand();
                                    $newBrand->name=$brand;
                                    $newBrand->save();
                                }
                                $nameRu = $hurakanProduct['fields']['name'];
                                $descriptionRu = $hurakanProduct['add_desc'] ?? $hurakanProduct['props']['description'];
                                $image =$hurakanProduct['fields']['image'];



                                if($nameRu) {
                                    $translateEn = GoogleTranslate::source('ru')
                                        ->target('en')
                                        ->translate($nameRu);
                                    $nameEn = $translateEn->getTranslatedText();
                                    $translateRo = GoogleTranslate::source('ru')
                                        ->target('ro')
                                        ->translate($nameRu);
                                    $nameRo = $translateRo->getTranslatedText();
                                } else {
                                    $nameEn = '';
                                    $nameRo = '';
                                }

                                     if($descriptionRu && $descriptionRu !='') {
                                         if(strlen($descriptionRu) <=5000) {
                                             try {
                                                 $translateDescriptionEn = GoogleTranslate::source('ru')
                                                     ->target('en')
                                                     ->translate($descriptionRu);
                                                 $descriptionEn = $translateDescriptionEn->getTranslatedText();
                                                 $translateDescriptionRo = GoogleTranslate::source('ru')
                                                     ->target('ro')
                                                     ->translate($descriptionRu);
                                                 $descriptionRo = $translateDescriptionRo->getTranslatedText();
                                             } catch(Exception $e) {
                                                 dump($e);
                                             }


                                         } else {
                                            $descriptionEn = $descriptionRu;
                                            $descriptionRo = $descriptionRu;
                                         }


                                     } else {
                                         $descriptionEn = '';
                                         $descriptionRo = '';

                                     }


//                                $descriptionEn = $descriptionRu;
//                                $descriptionRo = $descriptionRu;


                                $productExist = Product::where('code_hurakan',$code )->orWhere('code_1c','H'.$code)->first();
//
                                if($productExist) {

                                $path = downloadImage($image);

                                    $productData = [
                                        'status'=>1,
                                        'image_preview'=>$path,
                                        'name_ro'=>$nameRo,
                                        'name_ru'=>$nameRu,
                                        'name_en'=>$nameEn,
                                        'slug'=>str_replace([' ', '/'], '-', strtolower($nameEn)),
                                        'description_ro'=>$descriptionRo,
                                        'description_ru'=>$descriptionRu,
                                        'description_en'=>$descriptionEn,
                                        'code_hurakan'=>$code,
                                        'code_1c'=>'H'.$code,
                                        'brand'=>$brand,
                                        'dimension'=>$hurakanProduct['props']['widthmm'].'x'.$hurakanProduct['props']['lengthmm'].'x'.$hurakanProduct['props']['heightmm'],
                                        'voltage'=>$hurakanProduct['props']['voltage'],
                                        'power'=>$hurakanProduct['props']['powerkVt'],
                                        'weight'=>$hurakanProduct['props']['weightkg'],
                                    ];

                                    $productExist->update($productData);

                                } else {

                                    $path = downloadImage($image);
                                    $productData = [
                                        'status'=>1,
                                        'industry_id'=>$industryId,
                                        'image_preview'=>$path,
                                        'name_ro'=>$nameRo,
                                        'name_ru'=>$nameRu,
                                        'name_en'=>$nameEn,
                                        'slug'=>str_replace([' ', '/'], '-', strtolower($nameEn)),
                                        'description_ro'=>$descriptionRo,
                                        'description_ru'=>$descriptionRu,
                                        'description_en'=>$descriptionEn,
                                        'code_hurakan'=>$code,
                                        'code_1c'=>'H'.$code,
                                        'brand'=>$brand,
                                        'dimension'=>$hurakanProduct['props']['widthmm'].'x'.$hurakanProduct['props']['lengthmm'].'x'.$hurakanProduct['props']['heightmm'],
                                        'voltage'=>$hurakanProduct['props']['voltage'],
                                        'power'=>$hurakanProduct['props']['powerkVt'],
                                        'weight'=>$hurakanProduct['props']['weightkg'],
                                    ];

//                                    dump($productData);

                                    $product = Product::firstOrCreate($productData);

                                    if(isset($categoryId)) {
                                        $categoryItem = new ProductCategory();
                                        $categoryItem->product_id = $product->id;
                                        $categoryItem->category_id = $categoryId;
                                        $categoryItem->save();
                                    }

                                    if(isset($subcategoryId)) {
                                        $categoryItem = new ProductSubCategory();
                                        $categoryItem->product_id = $product->id;
                                        $categoryItem->subcategory_id = $subcategoryId;
                                        $categoryItem->save();
                                    }

                                }




                            }
                        }
                        $subcategory->update(['hurakan_parsed2'=>1]);
                    break;
                    }
                }

                }

        }


    }

    public function test() {
        $products = Product::where('code_uuid', null)->get();
        foreach ($products as $product) {

            $product->update(['visible_1c'=> 1 ]);


        }



dump(count($products));




//        if (strpos($http_response_header[0], "200")) {
//            echo "image exists<br>";
//        } else {
//            echo "image DOES NOT exist<br>";
//        }
//        $products = Subcategory::where('slug', 'LIKE', '%/%')->get();
//        foreach ($products as $product) {

//            $product->update(['slug'=> str_replace('/', '-', $product->slug) ]);
//            $name = str_replace([' ', '/'], '-', strtolower($product->name_en));
//            $productExist = Product::where('slug', $name)->first();
//            if($productExist) {
//                $product->update(['slug'=>$name.'-'.rand(1,100) ]);
//            } else $product->update(['slug'=>$name ]);


//        }
dd('yes');

//        dd($products);
    }

    public function tags() {

        function getTagsValues($array) {
            $tagsArray = array();
            foreach ($array as $item)
            {$tagsArray = array_merge($tagsArray, explode(" ",$item));}


            $counted = array_count_values($tagsArray);
            arsort($counted);
            dump($counted);

            $nameTags = [];

            for($i=1; $i<=5; ) {
                if(key($counted) && $counted > 1 && strlen(key($counted)) > 2)
                {

                    $nameTags[] = key($counted);
                    array_shift($counted);
                    $i++;
                } else break;
            }
            return $nameTags;

        }

        $category = Category::where('id', 42)->first();

        $categoryProducts = $category->products;
        $nameRoArr = [];
        $nameRuArr = [];
        $nameEnArr = [];
        foreach ($categoryProducts as $item) {
            $nameRoArr[] = $item->name_ro;
            $nameRuArr[] = $item->name_ru;
            $nameEnArr[] = $item->name_en;
        }

        $nameRoTags = getTagsValues($nameRoArr);
        $nameRuTags = getTagsValues($nameRuArr);
        $nameEnTags = getTagsValues($nameEnArr);

//        $category->update(['tags_ro'=>json_encode($nameRoTags), 'tags_ru'=>json_encode($nameRuTags, JSON_UNESCAPED_UNICODE ), 'tags_en'=>json_encode($nameEnTags)]);





        dump($nameRoTags);
        dump($nameRuTags);
        dump($nameEnTags);
//        }
        dd('yes');


    }
}
