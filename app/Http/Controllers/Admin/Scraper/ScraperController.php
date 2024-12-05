<?php

namespace App\Http\Controllers\Admin\Scraper;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Parser;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductSubCategory;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Goutte\Client as Scraper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Datlechin\GoogleTranslate\Facades\GoogleTranslate;

class ScraperController extends Controller
{

    public function index() {
        $title = 'Parsing';


        $scrapers = Parser::all();
        return view('panel.scraper.index', compact( 'title', 'scrapers'));
    }


    public function show( Parser $parser) {
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();
        $subcategories = Subcategory::all();

        foreach ($industriesAll as $industry){
            if(Category::where('industry_id', $industry->id)->get()) {
                $categoryList = Category::where('industry_id', $industry->id)->get();
                $industry['categories'] = $categoryList;
            } else $industry['categories'] =[];

        }
        foreach ($categoriesAll as $category){
            if(Subcategory::where('category_id', $category->id)->get()) {
                $categoryList = Subcategory::where('category_id', $category->id)->get();
                $category['subcategories'] = $categoryList;
            } else $category['subcategories'] = [];

        }
//        dd($categoriesAll);
            return view('panel.scraper.edit', compact(  'parser', 'industriesAll', 'categoriesAll', 'subcategories'));
    }

    public function send(Request $request, Parser $parser) {

        ini_set('max_execution_time', 300); //5 minutes

        function storeSlider($slider,$productExist ) {
            if(count( $slider) > 0) {
                foreach ($slider as $item) {
                    $image = new ProductImage();

             $contents = file_get_contents($item);

            $name = substr($item, strrpos($item, '/') + 1);
            $path = 'images/product/scrapping/'.$name;
           Storage::disk('public')->put($path , $contents );

                    $image->url = $path;
                    $image->product_id = $productExist->id;
                    $image->type='image';
//                    if($contents->getClientOriginalExtension() == 'mp4' || $contents->getClientOriginalExtension() == 'mov' || $contents->getClientOriginalExtension() == 'wmv' || $contents->getClientOriginalExtension() == 'webm') {
//                        $image->type='video';
//                    } else $image->type='image';
                    $image->save();

                }
            }
        }

        $data = $request->validate([
            'industry_id'=>'required|integer',
            'category_id'=>'required|integer',
            'subcategory_id'=>'required|integer',
            'url'=>'required|string',
        ]);
        $industryId = $data['industry_id'];
        $categoryId = $data['category_id'];
        $subcategoryId = $data['subcategory_id'];
        if($parser->id == 1) {
            $client = new Scraper();

            $website = $client->request('GET', $data['url']);



            $products = $website->filter('.product-list__body .product-list__body--sku a')->each(function ($node) {
                                $href = $node->attr('href');
//                return [
//                    'href'=>$href,
//                ];


                $clientProduct = new Scraper();
                $product = $clientProduct->request('GET', $href);

                $productCode = $product->filter('.product-presentation__main--body-details .bold')->first()->text();

//                $productExist = Product::where('industry_id', $industryId )->where('code_1c', )->first();
                $productNameFiltered = $product->filter('.product-presentation__main--heading')->text();
                $productName =  ucfirst($productNameFiltered);



                if($product->filter('.tab-content .product-description')->count() > 0) {
                    $productDescriptionFiltered = $product->filter('.tab-content .product-description')->text();
                    $productDescription = ucfirst($productDescriptionFiltered);
                    if($productDescription) {
                        $translateDescriptionEn = GoogleTranslate::source('pl')
                            ->target('en')
                            ->translate($productDescription);
                        $descriptionEn = $translateDescriptionEn->getTranslatedText();
                        $translateDescriptionRo = GoogleTranslate::source('pl')
                            ->target('ro')
                            ->translate($productDescription);
                        $descriptionRo = $translateDescriptionRo->getTranslatedText();
                        $translateDescriptionRu = GoogleTranslate::source('pl')
                            ->target('ru')
                            ->translate($productDescription);
                        $descriptionRu = $translateDescriptionRu->getTranslatedText();
                    } else {
                        $descriptionRo = '';
                        $descriptionRu='';
                        $descriptionEn='';
                    }



                } else {
                    $descriptionRo = '';
                    $descriptionRu='';
                    $descriptionEn='';
                };

                if($product->filter('#tab-2')->count() > 0) {
                    $productCharacteristics = $product->filter('#tab-2')->text();
                    $productCharacteristics1 = str_replace('max.', 'maksymalna', $productCharacteristics);
                    $productCharacteristics2 = str_replace('min.', 'maksymalna', $productCharacteristics1);

                    if($productCharacteristics) {
                        $translateCharacteristicsRo = GoogleTranslate::source('pl')
                            ->target('en')
                            ->translate($productCharacteristics2);
                        $characteristicsRo = $translateCharacteristicsRo->getTranslatedText();
                    } else {
                        $characteristicsRo = '';
                    }


                } else $characteristicsRo = '';

//                dd($characteristicsRo);

//                $productImage = $product->filter('.product-presentation__slide--link.active.miniature img')->attr('src');

                $sliderArr = [];

                    $slider =  $product->filter('.product-page-slider .product-presentation__thumbnails--single-image');

//                    dump($slider->count());
                    if($slider->count() == 1) {
                        $productImage = $slider->attr('src');

                    }
                    elseif($slider->count() > 1) {
                        $sliderArr = $slider->each(function ($image) {
                            return $image->attr('src');

                        });

                        $productImage =array_shift($sliderArr);


                    } else {
                        $productImage = '';
                        $sliderArr = [];
                    }

//
//                dump($productImage);
//                dd($sliderArr);


                $translateEn = GoogleTranslate::source('pl')
                    ->target('en')
                    ->translate($productName);
                $nameEn = $translateEn->getTranslatedText();

                $translateRo = GoogleTranslate::source('pl')
                    ->target('ro')
                    ->translate($productName);
                $nameRo = $translateRo->getTranslatedText();

                $translateRu = GoogleTranslate::source('pl')
                    ->target('ru')
                    ->translate($productName);
                $nameRu = $translateRu->getTranslatedText();


                return [
                    'code'=> $productCode,
                    'name_ro'=>$nameRo,
                    'name_ru'=>$nameRu,
                    'name_en'=>$nameEn,
                    'description_ro'=>$descriptionRo,
                    'description_ru'=>$descriptionRu,
                    'description_en'=>$descriptionEn,
                    'characteristics'=>$characteristicsRo,
                    'productImage'=>$productImage,
                    'slider'=>$sliderArr,
                ];

//
            });

            if(Auth::user()->id ==1) {
                dd($products);
            }

            foreach ($products as $product) {
                $productExist = Product::where('industry_id', $industryId )->where('code_1c', 'ST'.$product['code'] )->first();

                $slider = $product['slider'];

                if($productExist) {

//                    if(isset( $product['productImage'])) {
//                        if($product['productImage']) {
//                            if(isset($productExist->image_preview)) {
//                                Storage::disk('public')->delete($productExist->image_preview);
//                            }
//
////                        dump($product['productImage']);
//                            $contents = file_get_contents($product['productImage']);
//                            $name = substr($product['productImage'], strrpos($product['productImage'], '/') + 1);
//                            $path = 'images/product/scrapping/'.$name;
////                        dump($path);
//                            Storage::disk('public')->put($path , $contents );
//                        } else $path = 'images/product/No-image-available2.png';
//
//                    } else $path = 'images/product/No-image-available2.png';


//                    $productExist->update(['image_preview'=>$path]);

//                    $images = ProductImage::where('product_id', $productExist->id)->get();
//
//                    if($images) {
//                        foreach ($images as $image) {
//                            if(Storage::disk('public')->delete($image->url)) {
//                                $image->delete();
//                            }
//                        }
//                    }

                    $productExist->update([
//                        'status'=>1,
//                        'name_ro'=>$product['name_ro'],
//                        'name_ru'=>$product['name_ru'],
//                        'name_en'=>$product['name_en'],
//                        'slug'=>str_replace([' ', '/'], '-', strtolower($product['name_en'])),
//                        'description_ro'=>$product['description_ro'],
//                        'description_ru'=>$product['description_ru'],
//                        'description_en'=>$product['description_en'],
                        'characteristics'=>$product['characteristics'],
//                        'image_preview'=>$path,
//                        'brand'=>'Stalgast',
                            ]
                            );


//                   storeSlider($slider,$productExist );
                }

                else {

                    if(isset( $product['productImage'])) {
                        if($product['productImage']) {
                            if(isset($productExist->image_preview)) {
                                Storage::disk('public')->delete($productExist->image_preview);
                            }

//                        dump($product['productImage']);
                            $contents = file_get_contents($product['productImage']);
                            $name = substr($product['productImage'], strrpos($product['productImage'], '/') + 1);
                            $path = 'images/product/scrapping/'.$name;
//                        dump($path);
                            Storage::disk('public')->put($path , $contents );
                        } else $path = 'images/product/No-image-available2.png';

                    } else $path = 'images/product/No-image-available2.png';

                    $data = [
                        'status'=>1,
                        'industry_id'=>$industryId,
                        'image_preview'=>$path,
                        'name_ro'=>$product['name_ro'],
                        'name_ru'=>$product['name_ru'],
                        'name_en'=>$product['name_en'],
                        'slug'=>str_replace([' ', '/'], '-', strtolower($product['name_en'])),
                        'description_ro'=>$product['description_ro'],
                        'description_ru'=>$product['description_ru'],
                        'description_en'=>$product['description_en'],
                        'characteristics'=>$product['characteristics'],
                        'code_1c'=>'ST'.$product['code'],
                        'brand'=>'Stalgast',
                    ];

                    $productExist = Product::firstOrCreate($data);

                    if(isset($categoryId)) {
                        $categoryItem = new ProductCategory();
                        $categoryItem->product_id = $productExist->id;
                        $categoryItem->category_id = $categoryId;
                        $categoryItem->save();
                    }

                    if(isset($subcategoryId)) {
                        $categoryItem = new ProductSubCategory();
                        $categoryItem->product_id = $productExist->id;
                        $categoryItem->subcategory_id = $subcategoryId;
                        $categoryItem->save();
                    }

                    storeSlider($slider,$productExist );
                }
            }
        }
//dd('yes');
        return back()->with('success', 'Produse a adaugat');

    }

    public function hurakan()
    {
        $client = new Scraper();

        $website = $client->request('GET', 'https://hurakan.ru/catalog/barnoe-i-kofejnoe-oborudovanie/blendery/');



        $products = $website->filter('.item_931')->each(function ($node) {
            $host = 'https://hurakan.ru';
//            dump($node->attr('href'));


            $nameRu = $node->text();
            dump($nameRu);
            $translateEn = GoogleTranslate::source('ru')
                ->target('en')
                ->translate($nameRu);
            $nameEn = $translateEn->getTranslatedText();

            $translateRo = GoogleTranslate::source('ru')
                ->target('ro')
                ->translate($nameRu);
            $nameRo = $translateRo->getTranslatedText();

            dump($nameEn);
            dump($nameRo);

//            $href = $node->attr('href');
//            $clientProduct = new Scraper();
//            $product = $clientProduct->request('GET', $host.$href);
//
//            dump($product->filter('img[loading="lazy"]')->attr('src'));
//            $src = $product->filter('img[loading="lazy"]')->attr('src');
//           $contents = file_get_contents($src);
//           dump($contents);
//            $name = substr($src, strrpos($src, '/') + 1);
//            $path = 'images/product/scrapping/'.$name;
//           Storage::disk('public')->put($path , $contents );
//            dump($path);

        });

    }
    public function updatePrice1c() {

    }
}
