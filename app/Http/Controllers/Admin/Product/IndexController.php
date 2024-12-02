<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryIdeaProduct;
use App\Models\Constructor;
use App\Models\ConstructorBasket;
use App\Models\ConstructorBasketColor;
use App\Models\ConstructorTrolley;
use App\Models\ConstructorTrolleyColor;
use App\Models\Industry;
use App\Models\News;
use App\Models\PageContent;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductFeature;
use App\Models\ProductImage;
use App\Models\ProductPdf;
use App\Models\ProductSpecification;
use App\Models\ProductSubCategory;
use App\Models\ProductVariant;
use App\Models\SimilarProduct;
use App\Models\SolutionProduct;
use App\Models\Subcategory;
use App\Models\Wheel;
use App\Models\WheelConstructorTrolley;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $products = Product::when($request->industry != null, function ($q) use ($request) {
            return $q->where('industry_id', $request->industry);
        })->when($request->brand != null, function ($q) use ($request) {
            return $q->where('brand', $request->brand);
        })->when($request->productName != null, function ($q) use ($request) {
            $name='name_'.App::getLocale();
            return $q->where($name,'LIKE', '%' . $request->productName . "%")->orWhere('code_1c', 'LIKE', '%' . $request->productName . "%" );
        })->when($request->category != null, function ($q) use ($request) {
            $categoryProducts = ProductCategory::where('category_id',$request->category )->get();
            $productsCategory = [];
            if($categoryProducts) {
                foreach ($categoryProducts as $item) {
                    $productsCategory[]=$item->product_id;
                }
            }
            return $q->whereIn('id', $productsCategory);
        })->when($request->subcategory != null, function ($q) use ($request) {
            $productSubcategory = ProductSubCategory::where('subcategory_id', $request->subcategory)->get();
            $productsSubcategory = [];
            if($productSubcategory) {
                foreach($productSubcategory as $item) {
                    $productsSubcategory[]=$item->product_id;
                }
            }
            return $q->whereIn('id',$productsSubcategory );
        })->orderBy('sort_order', 'ASC')->paginate(10);
        $title = 'Produsele';

        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }
        foreach ($categoriesAll as $category){
            $categoryList = Subcategory::where('category_id', $category->id)->get();
            $category['subcategories'] = $categoryList;
        }


        return view('panel.product.index', compact('products', 'industriesAll', 'categoriesAll','title', 'subcategories', 'brands'));

    }

    public function create()
    {
        $title = 'Adauga Produse';
        $industriesAll = Industry::all();
        $categoriesAll = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
//        $products = Product::all();
        $constructors = Constructor::all();
        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;
        }
        foreach ($categoriesAll as $category){
            $categoryList = Subcategory::where('category_id', $category->id)->get();
            $category['subcategories'] = $categoryList;
        }
        return view('panel.product.create', compact( 'title', 'industriesAll', 'categoriesAll', 'subcategories', 'constructors', 'brands'));
    }
    public function show($product)
    {
        $product = Product::where('id',$product )->first();
        $images= ProductImage::where('product_id', $product->id)->get();

        return view('panel.product.show', compact(   'product', 'images'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

//        dd($data);
        $imagePreview = $request->file('image_preview');
        $imageMain = $request->file('images');
        $pdfFile = $request->file('pdf');
        $variantItems = json_decode($data['variantItems'], true);
        $specificationItems = json_decode($data['specificationItems'], true);
//        $featuresItems = json_decode($data['featuresItems'], true);
        $categories = $data['category_id'];
        $subcategories = $data['subcategory_id'];
        unset($data['images'], $data['category_id'], $data['subcategory_id'], $data['variantItems'], $data['specificationItems']);
        if(isset( $imagePreview)) {
            $path = Storage::disk('public')->put('/images/product/preview' , $imagePreview );
            compressFiles($path);
            $data['image_preview'] = $path;
        }

        $data['slug']= str_replace([' ', '/'], '-', strtolower($data['name_en']));

        $product = Product::firstOrCreate($data);

        if(isset( $imageMain)) {
            foreach ($imageMain as $item) {
                $image = new ProductImage();
                $path = Storage::disk('public')->put('/images/product' , $item );
                compressFiles($path);
                $image->url = $path;
                $image->product_id = $product->id;



                if($item->getClientOriginalExtension() == 'mp4' || $item->getClientOriginalExtension() == 'mov' || $item->getClientOriginalExtension() == 'wmv' || $item->getClientOriginalExtension() == 'webm') {
                    $image->type='video';
                } else $image->type='image';
                $image->save();

            }

              }
         if(isset($categories)) {
             foreach ($categories as $category) {
                 $categoryItem = new ProductCategory();
                 $categoryItem->product_id = $product->id;
                 $categoryItem->category_id = $category;
                 $categoryItem->save();
             }
         }
        if(isset($subcategories)) {
            foreach ($subcategories as $category) {
                $categoryItem = new ProductSubCategory();
                $categoryItem->product_id = $product->id;
                $categoryItem->subcategory_id = $category;
                $categoryItem->save();
            }
        }

        if(isset( $pdfFile)) {
            function generateRandomString($length = 10) {
                return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
            }
            $fileName =  generateRandomString();
            $pdf = new \Spatie\PdfToImage\Pdf($pdfFile->getPathname());
            $pdf->setPage(1)->saveImage('images/product-pdf/'.$fileName.'.jpg');

            $file_ext = $pdfFile->getClientOriginalExtension();
            $newName = $product->name_ro. "-catalog." . $file_ext;
            $path = Storage::disk('public')->putFileAs('/images/product',  $pdfFile, $newName);
            $data['pdf'] = $path;
            $data['pdf_size'] =round($pdfFile->getSize()/1000000, 1) ;
        }

//        dd($variantItems);
        if(isset($variantItems)) {
            foreach ($variantItems as $item) {
                $variantItem = new ProductVariant();
                $variantItem->product_id = $product->id;
                $variantItem->code = $item['code'];
                $variantItem->weight = $item['weight'];
                $variantItem->price = $item['price'];
                $variantItem->type = $item['type'];
                $variantItem->color = $item['color'];
                $variantItem->color_name_ro = $item['color_name_ro'];
                $variantItem->color_name_ru = $item['color_name_ru'];
                $variantItem->color_name_en = $item['color_name_en'];

                $variantItem->model = $item['model'];
                $variantItem->max_load = $item['max_load'];
                $variantItem->extension_length = $item['extension_length'];
                $variantItem->dimension = $item['dimension'];

                $variantItem->save();
            }
        }
        if(isset($specificationItems)) {
            foreach ($specificationItems as $item) {
                $specificationItem = new ProductSpecification();
                $specificationItem->product_id = $product->id;
                $specificationItem->title_ro = $item['title_ro'];
                $specificationItem->title_ru = $item['title_ru'];
                $specificationItem->title_en = $item['title_en'];
                $specificationItem->description_ro = $item['description_ro'];
                $specificationItem->description_ru = $item['description_ru'];
                $specificationItem->description_en = $item['description_en'];
                $specificationItem->save();
            }
        }
//        if(isset($featuresItems)) {
//            foreach ($featuresItems as $item) {
//                if(isset($item['image'])) {
//                    $path = Storage::disk('public')->put('/images/product/feature' , $item['image'] );
//                } else $path = '';
//                $featureItem = new ProductFeature();
//                $featureItem->product_id = $product->id;
//                $featureItem->title_ro = $item['title_ro'];
//                $featureItem->title_ru = $item['title_ru'];
//                $featureItem->title_en = $item['title_en'];
//                $featureItem->description_ro = $item['description_ro'];
//                $featureItem->description_ru = $item['description_ru'];
//                $featureItem->description_en = $item['description_en'];
//                $featureItem->image = $path;
//            }
//
//        }
            if($product) {
            return redirect()->route('product');
        } else {
            return back()->with('error', 'category n-a fost creat');
        }
    }

    public function edit( $product)
    {
        $industriesAll = Industry::all();

        $product = Product::where('id',$product )->first();
        $categoriesAll = Category::all();
        $subcategories = Subcategory::all();
        $wheels = Wheel::all();
        $trolleyColors = ConstructorTrolleyColor::all();
        $constructorBasketColors = ConstructorBasketColor::all();
        $brands = Brand::all();


        if( $product->constructorTrolley) {
            foreach($wheels as $wheel) {
                $wheelTrolleys = WheelConstructorTrolley::where('constructor_trolley_id', $product->constructorTrolley->id)->get();
                if($wheelTrolleys) {
                    foreach ($wheelTrolleys as $trolley) {
                        if($trolley->wheel_id ==$wheel->id ) {
                            $wheel['selected'] = true;
                        }
                    }
                }
            }

            foreach ($trolleyColors as $color) {
                $bodyColors = $product->constructorTrolley->body_colors;
                $handleColors = $product->constructorTrolley->handle_colors;
                $backColors = $product->constructorTrolley->back_colors;
                $babySeatColors = $product->constructorTrolley->baby_seat_colors;
                $basketColors = $product->constructorTrolley->basket_colors;
                if($bodyColors) {
                    $bodyColors = json_decode($bodyColors);
                    foreach ($bodyColors as $item) {
                        if($color->id ==$item ) {
                            $color['bodyColorSelected'] = true;
                        }
                    }
                }
                if($handleColors) {
                    $handleColors = json_decode($handleColors);
                    foreach ($handleColors as $item) {
                        if($color->id ==$item ) {
                            $color['handleColorSelected'] = true;
                        }
                    }
                }
                if($backColors) {
                    $backColors = json_decode($backColors);
                    foreach ($backColors as $item) {
                        if($color->id ==$item ) {
                            $color['backColorSelected'] = true;
                        }
                    }
                }
                if($babySeatColors) {
                    $babySeatColors = json_decode($babySeatColors);
                    foreach ($babySeatColors as $item) {
                        if($color->id ==$item ) {
                            $color['babySeatColorSelected'] = true;
                        }
                    }
                }
                if($basketColors) {
                    $basketColors = json_decode($basketColors);
                    foreach ($basketColors as $item) {
                        if($color->id ==$item ) {
                            $color['basketColorSelected'] = true;
                        }
                    }
                }
            }
        }

        if($product->constructorBasket) {
            foreach ($constructorBasketColors as $color) {
                $handleColors = $product->constructorBasket->handle_colors;
                $basketColors = $product->constructorBasket->basket_colors;

                if($handleColors) {
                    $handleColors = json_decode($handleColors);
                    foreach ($handleColors as $item) {
                        if($color->id ==$item ) {
                            $color['handleColorSelected'] = true;
                        }
                    }
                }

                if($basketColors) {
                    $basketColors = json_decode($basketColors);
                    foreach ($basketColors as $item) {
                        if($color->id ==$item ) {
                            $color['basketColorSelected'] = true;
                        }
                    }
                }
            }
        }

//        $subcategoriesOld = Subcategory::where('industry_id', $product->industry_id)->get();
        $images= ProductImage::where('product_id', $product->id)->get();
        $productPdfs = ProductPdf::where('product_id', $product->id)->get();
        $constructors = Constructor::all();
        $features = ProductFeature::where('product_id', $product->id)->get();
        foreach ($industriesAll as $industry){
            $categoryList = Category::where('industry_id', $industry->id)->get();
            $industry['categories'] = $categoryList;

            foreach ($categoriesAll as $category){
                if($category->industry_id == $industry->id)  {
                    $categoryList = Subcategory::where('industry_id', $industry->id)->get();
                    $category['subcategories'] = $categoryList;
                }
            }
        }
//        foreach ($categoriesAll as $category){
////            $categoryList = Subcategory::where('category_id', $category->id)->get();
//            $categoryList = Subcategory::where('industry_id', $industry->id)->get();
//            $category['subcategories'] = $categoryList;
//        }

        $categoriesOld = [];
        $productCategory = ProductCategory::where('product_id', $product->id)->get();
        if($productCategory) {
            foreach ($productCategory as $item) {
                $categoriesOld[]= Category::where('id', $item->category_id)->first();
            }
        }
//dd($categoriesOld);
        $subcategoriesOld = Subcategory::where('industry_id', $product->industry_id)->get();
        $productSubCategory = ProductSubCategory::where('product_id', $product->id)->get();
                if($productSubCategory) {
            foreach ($productSubCategory as $item) {
                foreach ($subcategoriesOld as $subcategory) {
                    if($subcategory->id == $item->subcategory_id) {
                        $subcategory['selected'] = 1;
                    }
                }
            }
        }
                $products = Product::all();

                $similarProducts = [];
                $similarProductsTable = SimilarProduct::where('product_id', $product->id)->get();
                if($similarProductsTable) {
                    foreach ($similarProductsTable as $item) {
                        $similarProducts[]= Product::where('id', $item->similar_product_id)->first();
                    }
                }
//                dd($similarProducts);

                $productVariants = ProductVariant::where('product_id', $product->id)->get();
                $productSpecifications = ProductSpecification::where('product_id', $product->id)->get();

//                if(Auth::user() && Auth::user()->id == 1) {
//                    dd($productVariants);
//                 }
//        $subcategoriesOld = [];
//        $productSubCategory = ProductSubCategory::where('product_id', $product->id)->get();
//        if($productSubCategory) {
//            foreach ($productSubCategory as $item) {
//                $subcategoriesOld[]= Subcategory::where('id', $item->subcategory_id)->first();
//            }
//        }

        return view('panel.product.edit', compact(  'industriesAll', 'product', 'images', 'categoriesOld',
            'categoriesAll', 'subcategories', 'subcategoriesOld', 'productVariants', 'productSpecifications', 'features', 'products',
            'similarProducts', 'productPdfs' , 'constructors', 'wheels', 'trolleyColors', 'brands', 'constructorBasketColors'));
    }

    /**
     * @throws \Spatie\PdfToImage\Exceptions\PdfDoesNotExist
     */
    public function update(UpdateRequest $request, $product)
    {
        $product = Product::where('id',$product )->first();
        $data = $request->validated();
//        dd($data['name_en']);
        if(isset($_POST['delete']))
        {
            $image = ProductImage::where('id', $request->delete)->first();

            if(Storage::disk('public')->delete($image->url)) {
                $image->delete();
                return back()->with('success', 'Изображение удалено');
            }
            return back()->with('error', 'Изображение не удалено');
        } elseif(isset($_POST['deleteProduct']))
        {
            $similarProduct = SimilarProduct::where('product_id', $product->id)->where('similar_product_id', $request->deleteProduct)->first();
//            dd($similarProduct);

            if($similarProduct) {
                $similarProduct->delete();
                return back()->with('success', 'Продукт удален');
            }
            return back()->with('error', 'Продукт не удален');
        }  elseif(isset($_POST['deletePdf']))
        {
           $productPdf = ProductPdf::where('id',$request->deletePdf )->first();
//            dd($similarProduct);

            if($productPdf) {
                Storage::disk('public')->delete($productPdf->pdf);
                Storage::disk('public2')->delete($productPdf->pdf_image);
                $productPdf->delete();
                return back()->with('success', 'Pdf удален');
            }
            return back()->with('error', 'Pdf не удален');
        }elseif(isset($_POST['update']))
        {
            $imagePreview = $request->file('image_preview');
            $imageMain = $request->file('images');
            $pdfFiles = $request->file('pdf');
            $videoFile = $request->file('video');
            $variantItems = json_decode($data['variantItems'], true);
            $specificationItems = json_decode($data['specificationItems'], true);
            if(isset($data['wheels'])) {
                $wheels =$data['wheels'];
            }


            $data['slug']= str_replace([' ', '/'], '-', strtolower($data['name_en']));
            unset($data['images'], $data['variantItems'], $data['specificationItems'], $data['wheels']);

//            if(Auth::user()->id ==1) {
//
//                dd($imagePreview);
//            }

            if(isset( $imagePreview)) {
                if(isset($product->image_preview)) {
                    Storage::disk('public')->delete($product->image_preview);
                }
                $path = Storage::disk('public')->put('/images/product' , $imagePreview );
                compressFiles($path);
                $data['image_preview'] = $path;
            }
            if(isset( $imageMain)) {
                foreach ($imageMain as $item) {
                    $image = new ProductImage();
                    $path = Storage::disk('public')->put('/images/product' , $item );
//                    compressFiles($path);
                    $image->url = $path;
                    $image->product_id = $product->id;

                    if($item->getClientOriginalExtension() == 'mp4' || $item->getClientOriginalExtension() == 'mov' || $item->getClientOriginalExtension() == 'wmv' || $item->getClientOriginalExtension() == 'webm') {
                        $image->type='video';
                    } else $image->type='image';
                    $image->save();

                }

            }
            if(isset( $pdfFiles)) {
                function generateRandomString($length = 10) {
                    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
                }

                foreach($pdfFiles as $pdfFile) {
                    $fileName =  generateRandomString();
                    $pdf = new \Spatie\PdfToImage\Pdf($pdfFile->getPathname());
                    $pdf->setPage(1)->saveImage('images/product-pdf/'.$fileName.'.jpg');


                    $file_ext = $pdfFile->getClientOriginalExtension();
                    $newName = $product->name_ro. "-catalog-" .rand(10, 9999).'.'. $file_ext;
                    $path = Storage::disk('public')->putFileAs('/images/product',  $pdfFile, $newName);

                    $pdfData = [
                        'product_id'=>$product->id,
                        'pdf'=>$path,
                        'pdf_size'=>round($pdfFile->getSize()/1000000, 1),
                        'pdf_image'=>'product-pdf/'.$fileName.'.jpg'
                    ];

                    ProductPdf::firstOrCreate($pdfData);

                }



            }
            if(isset( $videoFile)) {
                $videoPath = Storage::disk('public')->put('/images/product' , $videoFile );
                $data['video'] = $videoPath;
            }

            if(isset($data['category_id'])) {
                $product->categories()->sync($data['category_id']);
                unset($data['category_id']);
            }
            if(isset($data['subcategory_id'])) {
                $product->subcategories()->sync($data['subcategory_id']);
                unset($data['subcategory_id']);
            }
            if(isset($data['similarProducts_id'])) {
//                dd($data['similarProducts_id']);
                foreach ($data['similarProducts_id'] as $similar) {
                    SimilarProduct::firstOrCreate(['product_id'=>$product->id, 'similar_product_id'=>$similar]);
                }

                unset($data['similarProducts_id']);
            }

//            dd($variantItems);
            if(isset($variantItems)) {
                foreach ($variantItems as $item) {
                    if($item['id'] ==0) {
                        $variantItem = new ProductVariant();
                        $variantItem->product_id = $product->id;
                        $variantItem->code = $item['code'];
                        $variantItem->color = $item['color'];
                        $variantItem->color_name_ro = $item['color_name_ro'];
                        $variantItem->color_name_ru = $item['color_name_ru'];
                        $variantItem->color_name_en = $item['color_name_en'];
                        $variantItem->price = $item['price'];
                        $variantItem->weight = $item['weight'];
                        $variantItem->dimension = $item['dimension'];
                        $variantItem->type_ro = $item['type_ro'];
                        $variantItem->type_ru = $item['type_ru'];
                        $variantItem->type_en = $item['type_en'];
                        $variantItem->max_load = $item['max_load'];
                        $variantItem->model = $item['model'];
                        $variantItem->extension_length = $item['extension_length'];

                        $variantItem->save();
                    } else {
                        $productVariant = ProductVariant::where('id', $item['id'])->first();
                        $variantItem = [
                         'code' => $item['code'],
                        'color' => $item['color'],
                        'color_name_ro' => $item['color_name_ro'],
                        'color_name_ru' => $item['color_name_ru'],
                        'color_name_en' => $item['color_name_en'],
                        'price' => $item['price'],
                        'weight' => $item['weight'],
                        'type_ro' => isset( $item['type_ro']) ?  $item['type_ro'] : '',
                        'type_ru' => isset( $item['type_ru']) ?  $item['type_ru'] : '',
                        'type_en' => isset( $item['type_en']) ?  $item['type_en'] : '',
                        'max_load' => $item['max_load'],
                        'model' => $item['model'],
                        'extension_length' => $item['extension_length'],
                        'dimension' => $item['dimension'],

                        ];
                        $productVariant->update($variantItem);
                    }

                }
            }

            if(isset($specificationItems)) {
                foreach ($specificationItems as $item) {
                    if($item['id'] ==0) {
                        $specificationItem = new ProductSpecification();
                        $specificationItem->product_id = $product->id;
                        $specificationItem->title_ro = $item['title_ro'];
                        $specificationItem->title_ru = $item['title_ru'];
                        $specificationItem->title_en = $item['title_en'];
                        $specificationItem->description_ro = $item['description_ro'];
                        $specificationItem->description_ru = $item['description_ru'];
                        $specificationItem->description_en = $item['description_en'];
                        $specificationItem->save();
                    } else {
                        $productSpecification = ProductSpecification::where('id', $item['id'])->first();
                        $specificationItem = [
                        'title_ro' => $item['title_ro'],
                        'title_ru' => $item['title_ru'],
                        'title_en' => $item['title_en'],
                        'description_ro' => $item['description_ro'],
                        'description_ru' => $item['description_ru'],
                        'description_en' => $item['description_en'],
                        ];
                        $productSpecification->update($specificationItem);
                    }
                }
            }

            if($product->constructor_id == '4') {
                $constructorTrolley = ConstructorTrolley::where('product_id', $product->id)->first();
                $trolleyData = [
                    'product_id'=>$product->id,
                    'nesting_capacity'=>$data['nesting_capacity'],
                    'travelator_capacity'=>$data['travelator_capacity'],
                    'body_colors'=>isset($data['body_colors']) ? json_encode($data['body_colors']) : '',
                    'handle_colors'=>isset($data['handle_colors']) ? json_encode($data['handle_colors']): '',
                    'back_colors'=>isset($data['back_colors']) ? json_encode($data['back_colors']): '',
                    'baby_seat_colors'=>isset($data['baby_seat_colors']) ? json_encode($data['baby_seat_colors']): '',
                    'basket_colors'=>isset($data['basket_colors']) ? json_encode($data['basket_colors']): '',
                ];
                if($constructorTrolley) {
                    unset($trolleyData['product_id']);
                    $constructorTrolley->update($trolleyData);

                } else {
                    $constructorTrolley = ConstructorTrolley::firstOrCreate($trolleyData);
                }

                if(isset($wheels) && $constructorTrolley) {
                    $constructorTrolley->wheels()->sync($wheels);
                }
                unset($data['nesting_capacity'], $data['travelator_capacity'],$data['body_colors'],$data['baby_seat_colors'],$data['handle_colors'],$data['back_colors'],$data['basket_colors'] );
            } elseif($product->constructor_id == '5') {
                $constructorBasket = ConstructorBasket::where('product_id', $product->id)->first();
                $basketData = [
                    'product_id'=>$product->id,
                    'stacking_capacity'=>$data['stacking_capacity'],
                    'handle_colors'=>isset($data['handle_colors']) ? json_encode($data['handle_colors']): '',
                    'basket_colors'=>isset($data['basket_colors']) ? json_encode($data['basket_colors']): '',
                ];

                if($constructorBasket) {
                    unset($basketData['product_id']);
                    $constructorBasket->update($basketData);
                } else {
                     ConstructorBasket::firstOrCreate($basketData);
                }
                unset($data['stacking_capacity'],$data['handle_colors'],$data['basket_colors']  );
            }



            $product->update($data);
            return back()->with('success', 'Produse a schimbat');
        }

    }


    public function editor(Request $request) {
        $image = $request->file('upload');
        if(isset($image)) {
            $originalName = $image->getClientOriginalName();
            $fileName = pathinfo($originalName, PATHINFO_FILENAME);
            $file_ext = $image->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$file_ext;
            $image->move(public_path('images/editor'),$fileName );
            $url = asset('images/editor/'. $fileName);

            return response()->json(['fileName'=>'some', 'uploaded'=>1, 'url'=>$url]);
        }

    }

    public function delete( $product)
    {
        $product = Product::where('id',$product )->first();
        if(isset($product->image_preview) && $product->image_preview != 'images/product/No-image-available.png') {
            Storage::disk('public')->delete($product->image_preview);
        }
        $images = ProductImage::where('product_id', $product->id)->get();

        if($images) {
            foreach ($images as $image) {
                if(Storage::disk('public')->delete($image->url)) {
                    $image->delete();
                }
            }
        }

        $solutionProducts = SolutionProduct::where('product_id',$product->id )->get();
        if(count($solutionProducts) >0) {
            foreach ($solutionProducts as $solutionProduct) {
                $solutionProduct->delete();
            }
        }

        $categoryIdeaProducts = CategoryIdeaProduct::where('product_id',$product->id )->get();
        if(count($categoryIdeaProducts) >0) {
            foreach ($categoryIdeaProducts as $categoryProduct) {
                $categoryProduct->delete();
            }
        }
        $product->delete();
        return redirect()->route('product');
    }



}
