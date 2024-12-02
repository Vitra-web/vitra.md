<?php

namespace App\Http\Controllers\Client\Product;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ConstructorBasketColor;
use App\Models\ConstructorTrolleyColor;
use App\Models\Industry;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductMontant;
use App\Models\ProductShelve;
use App\Models\ProductSubCategory;
use App\Models\ProductTraversDeep;
use App\Models\ProductTraversWidth;
use App\Models\ProductTypeImage;
use App\Models\ProductTypeShelve;
use App\Models\SimilarProduct;
use App\Models\Subcategory;
use App\Models\UserFavorite;
use App\Models\Wheel;
use App\Models\WheelConstructorTrolley;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ViewErrorBag;


class IndexController extends Controller
{
    public function main( $category,  $subcategory, $product, Request $request)
    {
//        dd($product);



        $product = Product::where('slug',$product )->first();
        $favorite = request()->cookie('vitraFavorite');


//                if(Auth::user() && Auth::user()->id ==1) {
//            dd($product->constructor);
//        }
        if($product) {
            $product->update(['visits'=>$product->visits + 1]);
            if(Auth::user() ) {
                $userFavorite = UserFavorite::where('user_id',Auth::user()->id )->where('product_id',$product->id )->first();
                if($userFavorite) {
                    $product['favorite'] = true;
                }
            } elseif($favorite  ) {
                foreach (json_decode($favorite) as $item) {
                    if($item->product_id == $product->id) {
                        $product['favorite'] = true;
                    }
                }
            }


            $productFeatures = ProductFeature::where('product_id',$product->id )->get();

            if($category) {
                $categoryItem = Category::where('slug', $category )->first();
            } else $categoryItem = '';

            if($subcategory) {
                $subcategoryItem = Subcategory::where('slug',$subcategory )->first();
            } else $subcategoryItem = '';

            $industryItem = Industry::where('id', $product->industry_id)->first();

            $language= new  LanguageHandler();

            $productImages =ProductImage::where('product_id',$product->id )->orderBy('type', 'desc')->get();
            $productCategory = ProductCategory::where('product_id', $product->id)->first();
            if(isset($productCategory)) {
                $productCategories = ProductCategory::where('category_id', $productCategory->category_id)->get();

            } else {
                $productCategories = null;

            }

            $similarProducts = [];
            $similarProductsTable = SimilarProduct::where('product_id', $product->id)->get();
            if($similarProductsTable) {
                foreach ($similarProductsTable as $item) {
                    $productEx = Product::where('id', $item->similar_product_id)->where('status', 1)->first();
                    if($productEx) {
                        $similarProducts[]= $productEx;
                    }

                }
            }


            if(count($similarProducts) <4 && isset($productCategories)) {


//            $count = count($productCategories)<=5? count($productCategories): 5;
                $count = count($similarProducts);

                foreach ($productCategories as $item) {
                    if($item->product_id != $product->id) {
                        if(Product::where('id', $item->product_id)->where('status', 1)->first()) {
                            $similarProducts[] = Product::where('id', $item->product_id)->where('status', 1)->first();
                            $count+=1;
                        }


                    }
                    if($count == 5) break;
                }


            }

            $similarProducts = favoriteFilter($similarProducts);


//        dd($categoryProducts);
            $product['variants']= $product->productVariants;
            $product['specifications']= $product->productSpecifications;

            if($product->status == 1) {
                $title = $language->replace($product->name_ro, $product->name_ru,$product->name_en);
            } else $title = '';




            $product['colorVariants'] = $product->productColor;

            if($product->productType) {
                $type = [];
                foreach($product->productType as $item) {
                    $type[] =[
                        'name_ro'=>$item['type_name_ro'],
                        'name_ru'=>$item['type_name_ru'],
                        'name_en'=>$item['type_name_en'],
                        'image'=>$item['image'],
                        'shelves'=> ProductTypeShelve::where('product_type_id', $item->id)->get(),
                        'images'=>ProductTypeImage::where('product_type_id', $item->id)->get(),
                    ];
                }
                $product['typeVariants'] = $type;
            }

            $width = [];
            foreach($product->productWidth as $productWidth) {
                $width[] = [
                    'width'=>$productWidth['width'],
                    'traversWidthVariants'=>ProductTraversWidth::where('product_width_id', $productWidth->id)->get()
                ];
            }
            $product['widthVariants'] = $width;
            $deep = [];
            foreach($product->productDeep as $productDeep) {
                $deep[] = [
                    'deep'=>$productDeep['deep'],
                    'traversDeepVariants'=>ProductTraversDeep::where('product_deep_id', $productDeep->id)->get()
                ];
            }
            $product['deepVariants'] = $deep;

            $height = [];
            foreach($product->productHeight as $productHeight) {
                $height[] = [
                    'height'=>$productHeight['height'],
                    'traversHeightVariants'=>ProductMontant::where('product_height_id', $productHeight->id)->get(),
                    'shelvesVariants'=>ProductShelve::where('product_height_id', $productHeight->id)->get()
                ];
            }
            $product['heightVariants'] = $height;

            if($product->constructor_id == 4 && $product->constructorTrolley) {
                $product['constructorTrolley']['nesting_capacity'] = $product->constructorTrolley->nesting_capacity;
                $product['constructorTrolley']['travelator_capacity'] = $product->constructorTrolley->travelator_capacity;

                $wheels = [];
                $wheelConstructorTrolleys = WheelConstructorTrolley::where('constructor_trolley_id', $product->constructorTrolley->id)->get();
                if($wheelConstructorTrolleys) {
                    foreach ($wheelConstructorTrolleys as $trolley) {
                        $wheels[]=Wheel::where('id', $trolley->wheel_id)->first();
                    }
                }
                $product['constructorTrolley']['wheels'] = $wheels;

                $colors = ConstructorTrolleyColor::all();
                $bodyColors = $product->constructorTrolley->body_colors;
                $handleColors = $product->constructorTrolley->handle_colors;
                $backColors = $product->constructorTrolley->back_colors;
                $babySeatColors = $product->constructorTrolley->baby_seat_colors;
                $basketColors = $product->constructorTrolley->basket_colors;

                $bodyColorsArr = [];
                $handleColorsArr = [];
                $backColorsArrArr = [];
                $babySeatColorsArr = [];
                $basketColorsArr = [];

                foreach ($colors as $color) {
                    if($bodyColors) {
                        $bodyColorsParsed = json_decode($bodyColors) ;
                        foreach ($bodyColorsParsed as $item) {
                            if($item == $color->id) {
                                $bodyColorsArr[] = $color;
                            }
                        }
                    }
                    if($handleColors) {
                        $handleColorsParsed = json_decode($handleColors) ;
                        foreach ($handleColorsParsed as $item) {
                            if($item == $color->id) {
                                $handleColorsArr[] = $color;
                            }
                        }
                    }
                    if($backColors) {
                        $backColorsParsed = json_decode($backColors) ;
                        foreach ($backColorsParsed as $item) {
                            if($item == $color->id) {
                                $backColorsArrArr[] = $color;
                            }
                        }
                    }
                    if($babySeatColors) {
                        $babySeatColorsParsed = json_decode($babySeatColors) ;
                        foreach ($babySeatColorsParsed as $item) {
                            if($item == $color->id) {
                                $babySeatColorsArr[] = $color;
                            }
                        }
                    }
                    if($basketColors) {
                        $basketColorsParsed = json_decode($basketColors) ;
                        foreach ($basketColorsParsed as $item) {
                            if($item == $color->id) {
                                $basketColorsArr[] = $color;
                            }
                        }
                    }
                }

                $product['constructorTrolley']['body_colors'] = $bodyColorsArr;
                $product['constructorTrolley']['handle_colors'] = $handleColorsArr;
                $product['constructorTrolley']['back_colors'] = $backColorsArrArr;
                $product['constructorTrolley']['baby_seat_colors'] = $babySeatColorsArr;
                $product['constructorTrolley']['basket_colors'] = $basketColorsArr;
            }

            if($product->constructor_id == 5 && $product->constructorBasket) {
                $product['constructorBasket']['stacking_capacity'] = $product->constructorBasket->stacking_capacity;
                $colors = ConstructorBasketColor::all();

                $handleColors = $product->constructorBasket->handle_colors;
                $basketColors = $product->constructorBasket->basket_colors;


                $handleColorsArr = [];
                $basketColorsArr = [];

                foreach ($colors as $color) {

                    if($handleColors) {
                        $handleColorsParsed = json_decode($handleColors) ;
                        foreach ($handleColorsParsed as $item) {
                            if($item == $color->id) {
                                $handleColorsArr[] = $color;
                            }
                        }
                    }

                    if($basketColors) {
                        $basketColorsParsed = json_decode($basketColors) ;
                        foreach ($basketColorsParsed as $item) {
                            if($item == $color->id) {
                                $basketColorsArr[] = $color;
                            }
                        }
                    }
                }

                $product['constructorBasket']['handle_colors'] = $handleColorsArr;
                $product['constructorBasket']['basket_colors'] = $basketColorsArr;


            }


            if($product->status == 1) {

                return view('client.product.index', compact( 'industryItem', 'categoryItem',
                    'subcategoryItem',  'title', 'product', 'similarProducts', 'productImages',  'productFeatures'));
            } else return view('errors.404', [], 404);


        } else return view('errors.404');



    }
}
