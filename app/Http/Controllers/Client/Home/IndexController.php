<?php

namespace App\Http\Controllers\Client\Home;

use App\Classes\LanguageHandler;
use App\Http\Controllers\Controller;
use App\Models\AboutBenefit;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Industry;
use App\Models\Mission;
use App\Models\News;
use App\Models\PageContent;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Product;
use App\Models\SearchSetting;
use App\Models\Slider;
use App\Models\Solution;
use App\Models\SolutionCategory;
use App\Models\SolutionProduct;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    static function emptyRequest() {
        $language= new  LanguageHandler();
        $output = "";
        $searchProducts = SearchSetting::where('type', 'products')->orderBy('sort_order')->get();
        $searchCategories = SearchSetting::where('type', 'categories')->orderBy('sort_order')->get();

        $productImage = '<svg class="search_product_image " width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" id="searchProducts">
                                    <g clip-path="url(#clip0_6_67)">
                                        <path d="M0 7.77635C0 12.0627 3.48989 15.5527 7.77605 15.5527C9.63841 15.5527 11.3453 14.8995 12.6851 13.803L18.8802 20L20 18.881L13.8033 12.6848C14.9379 11.301 15.5561 9.56582 15.5521 7.77635C15.5521 3.49003 12.0622 -3.18485e-08 7.77605 -3.18485e-08C3.48989 -3.18485e-08 0 3.49003 0 7.77635ZM1.55521 7.77635C1.55521 4.33143 4.33126 1.55527 7.77605 1.55527C11.2208 1.55527 13.9969 4.33143 13.9969 7.77635C13.9969 11.2213 11.2208 13.9974 7.77605 13.9974C4.33126 13.9974 1.55521 11.2213 1.55521 7.77635Z" fill="black"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_6_67">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                    </svg>';


        $categoryImage = '<svg width="20" height="20" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" id="searchCategory">
                    <g clip-path="url(#clip0_2691_263)">
                    <path d="M7.66162 9.05843H1.39681C0.625772 9.05749 0.000945534 8.43266 0 7.66162V1.39681C0.000945534 0.625772 0.625772 0.000945534 1.39681 0H7.66162C8.43266 0.000945534 9.05749 0.625772 9.05843 1.39681V7.66162C9.05749 8.43266 8.43266 9.05749 7.66162 9.05843ZM1.39681 0.644682C0.981421 0.644682 0.644682 0.981421 0.644682 1.39681V7.66162C0.644682 8.07701 0.981421 8.41375 1.39681 8.41375H7.66162C8.07701 8.41375 8.41375 8.07701 8.41375 7.66162V1.39681C8.41375 0.981421 8.07701 0.644682 7.66162 0.644682H1.39681Z" fill="black"/>
                    <path d="M9.5991 11H3.34267C2.56929 10.9992 1.9425 10.3725 1.94156 9.5991V8.73608C1.94156 8.55806 2.08588 8.41374 2.2639 8.41374C2.44192 8.41374 2.58624 8.55806 2.58624 8.73608V9.5991C2.58684 10.0166 2.92519 10.3548 3.34267 10.3553H9.5991C10.0165 10.3548 10.3548 10.0165 10.3553 9.5991V3.34267C10.3548 2.92519 10.0166 2.58684 9.5991 2.58624H8.73608C8.55806 2.58624 8.41374 2.44192 8.41374 2.2639C8.41374 2.08588 8.55806 1.94156 8.73608 1.94156H9.5991C10.3725 1.9425 10.9992 2.56929 11 3.34267V9.5991C10.9992 10.3724 10.3724 10.9992 9.5991 11Z" fill="black"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_2691_263">
                    <rect width="11" height="11" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg>';


        if($searchProducts) {
            $searchProductsLeft = 5 - count($searchProducts);
            if($searchProductsLeft >0) {
//                $searchProductsArray = [];
//                foreach($searchProducts as $searchProduct) {
//                    if($searchProduct->name == 'product' && $searchProduct->item_id) {
//                        $searchProductsArray[]= $searchProduct->item_id;
//                    }
//
//                }
                    $popularProducts = Product::query()->orderBy('visits', 'desc')->when($searchProductsLeft >0, function ($q) use ($searchProducts) {

                        foreach ($searchProducts as  $searchProduct) {
                            if($searchProduct->name == 'product' && $searchProduct->item_id)
                                $q->where('id', '!=', $searchProduct->item_id );
                        }
                        return $q;
                    })->limit($searchProductsLeft)->get();
                if($popularProducts) {
                    foreach($popularProducts as $product) {
                        $productName = $language->replace($product->name_ro, $product->name_ru,$product->name_en);
                        $output .= '<p class="search_product_item"><a href="/product/'.$product->categoryId.'/'.$product->subcategoryId.'/'.$product->slug.'" class="search_product_link">
                               ' . $productImage. $productName . '</a></p>';
                    }
                }

            }
            foreach($searchProducts as $item) {
                if($item->name == 'product' && $item->item_id) {
                    $product = Product::where('id',$item->item_id )->first();
                    if($product) {
                        $productName = $language->replace($product->name_ro, $product->name_ru,$product->name_en);
                        $output .= '<p class="search_product_item"><a href="/product/'.$product->categoryId.'/'.$product->subcategoryId.'/'.$product->slug.'" class="search_product_link">
                                   ' . $productImage . $productName . '</a></p>';
                    }

                } elseif($item->name == 'tag' && $item->value_ro) {
                    $tagName = $language->replace($item->value_ro, $item->value_ru,$item->value_en);
                    $output .= '<p class="search_product_item"><a href="/search-page/'.$tagName.'" class="search_product_link">
                                ' . $productImage . $tagName . '</a></p>';

                }

            }
        }

        if($searchCategories) {
            foreach($searchCategories as $item) {
                if($item->name == 'category') {
                    $category = Category::where('id',$item->item_id )->first();
                    if($category) {
                        $categoryName = $language->replace($category->name_ro, $category->name_ru,$category->name_en);
                        $output .= '<p class="search_product_item"><a href="/category/'.$category->slug.'" class="search_product_link">
                                  '  .$categoryImage. $categoryName . '</a></p>';

                    }
                } elseif($item->name == 'subcategory') {
                    $subcategory = Subcategory::where('id',$item->item_id )->first();
                    if($subcategory) {
                        $subcategoryName = $language->replace($subcategory->name_ro, $subcategory->name_ru,$subcategory->name_en);
                        $output .= '<p class="search_product_item"><a href="/subcategory/'.$subcategory->slug.'" class="search_product_link">
                                   ' .$categoryImage . $subcategoryName . '</a></p>';

                    }
                }

            }
        }

        return $output;
    }
    public function main()
    {

        $sliders = Slider::where('status', 1)->get();

        $missions = Mission::query()->orderBy('sort_order', 'asc')->get();
        $news = News::query()->orderBy('sort_order', 'desc')->limit(4)->get();
        $language= new  LanguageHandler();
        $benefits = AboutBenefit::where('main_page', 1)->get();
        $portfolios = Portfolio::all();
        $portfolioCategories = PortfolioCategory::all();
        $retailSolutions = Solution::where('industry_id', 1)->where('main_page', 1)->orderBy('sort_order', 'asc')->limit(3)->get();
        $logisticSolutions = Solution::where('industry_id', 2)->where('main_page', 1)->limit(4)->get();
        $horecaSolutions = Solution::where('industry_id', 3)->where('main_page', 1)->limit(4)->get();
        $lifeSolutions = Solution::where('industry_id', 4)->where('main_page', 1)->orderBy('sort_order', 'asc')->limit(3)->get();

        $lifeSolutionsAll = Solution::where('industry_id', 4)->get();
        $solutionCategories = SolutionCategory::where('industry_id', 4)->get();
//        dd($solutionCategories);
//        foreach($solutionCategories as $category) {
//            dump($category->name_ro);
//            dump($category->categories);
//        }
//        dd('yes');
        $solutionProducts = SolutionProduct::all();
        $aboutPage = PageContent::where('page', 'about')->first();
        foreach ($solutionProducts as $product){
            if(isset($product->product)) {
                $productList=[
                    'name'=>$language->replace($product->product->name_ro, $product->product->name_ru,$product->product->name_en),
                    'price'=>$product->product->price,
                    'code'=>$product->product->code_1c,
                ];
                $product['productItem']=$productList;
            }

        }

        return view('client.index',
            compact( 'sliders', 'missions', 'benefits', 'news', 'portfolios', 'lifeSolutions',
                'retailSolutions', 'logisticSolutions', 'solutionCategories', 'solutionProducts', 'horecaSolutions', 'aboutPage', 'portfolioCategories', 'lifeSolutionsAll'));
    }

    public function search(Request $request)
    {
        if ($request->ajax() ) {
            $output = "";
            $language= new  LanguageHandler();
            $name='name_'.App::getLocale();

            $productImage = '<svg class="search_product_image " width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" id="searchProducts">
                                    <g clip-path="url(#clip0_6_67)">
                                        <path d="M0 7.77635C0 12.0627 3.48989 15.5527 7.77605 15.5527C9.63841 15.5527 11.3453 14.8995 12.6851 13.803L18.8802 20L20 18.881L13.8033 12.6848C14.9379 11.301 15.5561 9.56582 15.5521 7.77635C15.5521 3.49003 12.0622 -3.18485e-08 7.77605 -3.18485e-08C3.48989 -3.18485e-08 0 3.49003 0 7.77635ZM1.55521 7.77635C1.55521 4.33143 4.33126 1.55527 7.77605 1.55527C11.2208 1.55527 13.9969 4.33143 13.9969 7.77635C13.9969 11.2213 11.2208 13.9974 7.77605 13.9974C4.33126 13.9974 1.55521 11.2213 1.55521 7.77635Z" fill="black"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_6_67">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                    </svg>';

            $categoryImage = '<svg width="20" height="20" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" id="searchCategory">
                    <g clip-path="url(#clip0_2691_263)">
                    <path d="M7.66162 9.05843H1.39681C0.625772 9.05749 0.000945534 8.43266 0 7.66162V1.39681C0.000945534 0.625772 0.625772 0.000945534 1.39681 0H7.66162C8.43266 0.000945534 9.05749 0.625772 9.05843 1.39681V7.66162C9.05749 8.43266 8.43266 9.05749 7.66162 9.05843ZM1.39681 0.644682C0.981421 0.644682 0.644682 0.981421 0.644682 1.39681V7.66162C0.644682 8.07701 0.981421 8.41375 1.39681 8.41375H7.66162C8.07701 8.41375 8.41375 8.07701 8.41375 7.66162V1.39681C8.41375 0.981421 8.07701 0.644682 7.66162 0.644682H1.39681Z" fill="black"/>
                    <path d="M9.5991 11H3.34267C2.56929 10.9992 1.9425 10.3725 1.94156 9.5991V8.73608C1.94156 8.55806 2.08588 8.41374 2.2639 8.41374C2.44192 8.41374 2.58624 8.55806 2.58624 8.73608V9.5991C2.58684 10.0166 2.92519 10.3548 3.34267 10.3553H9.5991C10.0165 10.3548 10.3548 10.0165 10.3553 9.5991V3.34267C10.3548 2.92519 10.0166 2.58684 9.5991 2.58624H8.73608C8.55806 2.58624 8.41374 2.44192 8.41374 2.2639C8.41374 2.08588 8.55806 1.94156 8.73608 1.94156H9.5991C10.3725 1.9425 10.9992 2.56929 11 3.34267V9.5991C10.9992 10.3724 10.3724 10.9992 9.5991 11Z" fill="black"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_2691_263">
                    <rect width="11" height="11" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg>';
            if($request->search == '') {

                $output =  self::emptyRequest();


            } else {
                $products = Product::where($name, 'LIKE', '%' . $request->search . "%")->orWhere('code_1c', 'LIKE', '%' . $request->search . "%" )->where('status', 1)->orderBy($name)->get();
                $categories = Category::where($name, 'LIKE', '%' . $request->search . "%")->where('status', 1)->get();
                $subcategories = Subcategory::where($name, 'LIKE', '%' . $request->search . "%")->where('status', 1)->get();
                $news = News::where($name, 'LIKE', '%' . $request->search . "%")->get();
                if ($products) {
//                $output .= '<div class="search_block_item"><span class="search_block_title"></span><a class="search_block_link" href="/search-page/'.$request->search .'">'.trans('labels.all').'</a></div>';
                    foreach ($products as $key => $product) {
                        $productName = $language->replace($product->name_ro, $product->name_ru,$product->name_en);
                        $output .= '<p class="search_product_item"><a href="/product/'.$product->categoryId.'/'.$product->subcategoryId.'/'.$product->slug.'" class="search_product_link">
                       ' .$productImage . $productName . '</a></p>';
                        if($key == 5) {
                            break;
                        }
                    }
                }

                if ($categories) {
//                $output .= '<div class="search_block_item"><span class="search_block_title">'.trans('labels.categories').'</span><a class="search_block_link" href="">'.trans('labels.all').'</a></div>';
                    foreach ($categories as $key => $item) {
                        $categoryName = $language->replace($item->name_ro, $item->name_ru,$item->name_en);
                        $output .= '<p class="search_product_item"><a href="/category/'.$item->slug.'" class="search_product_link">
                        '.$categoryImage . $categoryName . '</a></p>';
                        if($key == 4) {
                            break;
                        }
                    }
                }

                if ($subcategories) {
//                $output .= '<div class="search_block_item"><span class="search_block_title">'.trans('labels.categories').'</span><a class="search_block_link" href="">'.trans('labels.all').'</a></div>';
                    foreach ($subcategories as $key => $subcategory) {
                        $subcategoryName = $language->replace($subcategory->name_ro, $subcategory->name_ru,$subcategory->name_en);
                        $output .= '<p class="search_product_item"><a href="/subcategory/'.$subcategory->slug.'" class="search_product_link">
                       ' .$categoryImage . $subcategoryName . '</a></p>';
                        if($key == 3) {
                            break;
                        }
                    }
                }

                if ($news) {
//                $output .= '<div class="search_block_item"><span class="search_block_title">'.trans('labels.news').'</span><a class="search_block_link" href="">'.trans('labels.all').'</a></div>';
                    foreach ($news as $key => $itemnews) {
                        $itemName = $language->replace($itemnews->name_ro, $itemnews->name_ru,$itemnews->name_en);
                        if(strlen($itemName) > 90){
                            $newsText = substr($itemName, 0, 90).'...';
                        }  else $newsText = $itemName;
                        $output .= '<p class="search_product_item"><a href="/news/'.$itemnews->id.'" class="search_product_link">
                        '.$categoryImage . $newsText . '</a></p>';
                        if($key == 3) {
                            break;
                        }
                    }
                }

            }



            return Response($output);
        }
    }

    public function searchPopular(Request $request) {
        if ($request->ajax() ) {
            $output =   self::emptyRequest();
            return Response($output);
        }
    }
}
