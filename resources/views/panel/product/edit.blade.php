@extends('layouts.admin')

@php
    $industryId = request()->get('industry');
    $categoryId = request()->get('category');
    $subcategoryId = request()->get('subcategory');
    $brandRequest = request()->get('brand');
    $nameRequest = request()->get('productName');

@endphp

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('product',['industry'=>$industryId, 'category'=>$categoryId, 'subcategory'=>$subcategoryId, 'brand'=>$brandRequest, 'productName'=>$nameRequest]) }}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$product->name_ro}}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">


                <div class="form_container">
                    <form action="{{route('product.update', $product->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input name="variantItems" id='variantItems' type="hidden">
                        <input name="specificationItems" id='specificationItems' type="hidden">


                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active fs-5" id="common-tab" data-toggle="tab" href="#common" role="tab" aria-controls="common" aria-selected="true">
                                    Common
                                </a>
                                <a class="nav-item nav-link fs-5" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
                                    Media
                                </a>
                                <a class="nav-item nav-link fs-5" id="tec-info-tab" data-toggle="tab" href="#tec-info" role="tab" aria-controls="tec-info" aria-selected="false">
                                    Technical information
                                </a>
                                <a class="nav-item nav-link fs-5" id="add-info-tab" data-toggle="tab" href="#add-info" role="tab" aria-controls="add-info" aria-selected="false">
                                    Additional specifications
                                </a>
                                <a class="nav-item nav-link fs-5" id="key-features-tab" data-toggle="tab" href="#key-features" role="tab" aria-controls="key-features" aria-selected="false">
                                    Key features
                                </a>
                                <a class="nav-item nav-link fs-5" id="similar-products-tab" data-toggle="tab" href="#similar-products" role="tab" aria-controls="similar-products" aria-selected="false">
                                   Similar products
                                </a>
                            </div>
                        </nav>

                        <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">
                                <div class="form_block row mb-3">
                                    <div class="row mb-2">
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="status">Status</label>
                                        <select class="custom-select form-control " name="status" id="status" >
                                            <option value="1" {{$product->status == 1 ? 'selected' : ''}}>Activat</option>
                                            <option value="0" {{$product->status == 0 ? 'selected' : ''}}>Dezactivat</option>
                                        </select>
                                    </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="stock">Stock</label>
                                            <select class="custom-select form-control" name="stock" id="stock" >
                                                <option value="1" {{$product->stock == 1 ? 'selected': ''}}>In stock</option>
                                                <option value="2" {{$product->stock == 2 ? 'selected': ''}}>To order</option>
                                            </select>
                                        </div>
{{--                                    <div class="form-group col-lg-3 col-sm-6">--}}
{{--                                        <label for="" class="">Ordinea</label>--}}
{{--                                        <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{$product->sort_order}}">--}}
{{--                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                    </div>--}}
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="price" class="">Preț</label>
                                        <input type="number" class="form-control" name="price" id="price" placeholder="Preț" value="{{$product->price}}">
                                        @error('price')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="constructor_id">Tipul produse</label>
                                            <select class="custom-select form-control" name="constructor_id" id="constructor_id" >
                                                @foreach($constructors as $constructor)
                                                    <option value="{{$constructor->id}}" {{$constructor->id == $product->constructor_id ? 'selected': ''}} >{{$constructor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="industry">Industrie</label>
                                            <select class="custom-select form-control select2" name="industry_id" id="industry"  >
                                                @foreach($industries as $item)
                                                <option value="{{$item->id}}" {{$product->industry_id == $item->id ? 'selected' : ''}}>
                                                    {{$item->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="industry">Categorie</label>
                                            <select class="custom-select select2 form-control" name="category_id[]" id="category" multiple="multiple">
                                                @foreach($categoriesOld as $item)
                                                    <option  selected value="{{$item->id}}" >{{$item->name_ro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="industry">Subcategorie</label>
                                            <select class="custom-select select2 form-control" name="subcategory_id[]" id="subcategory" multiple="multiple">
                                                @foreach($subcategoriesOld as $item)
                                                    <option {{isset($item['selected']) ? 'selected' : '' }}  value="{{$item->id}}" >{{$item->name_ro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @include("panel.components.forms.name",["title" => "Numele produsului", "placeholder" => "Numele produsului", "valueRo" => $product->name_ro, "valueRu" => $product->name_ru, "valueEn" => $product->name_en])
                                @include("panel.components.forms.description",["title" => "Descriere produsului", "placeholder" => "Descriere produsului", "valueRo" => $product->description_ro, "valueRu" => $product->description_ru, "valueEn" => $product->description_en])



                            </div>
                            <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form_block row mb-3 ">
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="previewImage">Upload preview image</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="image_preview" class="form-control" id="previewImage" >
                                                </div>
                                            </div>
                                            @error('image_preview')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">min size: 220x200</p>
                                            <p class="text-info">ratio: 1,1 : 1</p>
                                            <p class="text-info">formats: jpeg, png, webp</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                            @if($product->image_preview)
                                                <a href="{{url('storage/'.$product->image_preview)}}" data-fancybox data-caption="Preview image">
                                                <img id="image_preview" src="{{url('storage/'.$product->image_preview)}}" alt="Preview product image" class="added_preview_image "  style="width: 300px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="mainImage">Upload slider images and video</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="images[]" class="form-control" id="mainImages" multiple="multiple" >
                                                </div>
                                            </div>
                                            @error('images')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">min size: 540x400</p>
                                            <p class="text-info">ratio: 1,35 : 1</p>
                                            <p class="text-info">formats: jpeg, png, webp, mp4, webm</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap row" id="mainImageContainer" >

                                            @if($images)
                                                @foreach($images as $item)
                                                    @if($item->type == 'image')
                                                        <div class="image_block mb-2 col-sm-6" >
                                                            <button type="submit" name="delete" value="{{$item->id}}" class="btn btn-sm btn-danger image_btn">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <a href="{{url('storage/'.$item->url)}}" data-gallery >
                                                                <img id="image_main{{$item->id}}" src="{{url('storage/'.$item->url)}}" alt="Preview product image" class=" " style="width: 300px">
                                                            </a>
                                                        </div>
                                                   @elseif($item->type == 'video')
                                                        <div class="image_block mb-2 col-sm-6">
                                                            <button type="submit" name="delete" value="{{$item->id}}" class="btn btn-sm btn-danger video_btn">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <a href="{{url('storage/'.$item->url)}}" data-gallery >
                                                        <video src="{{url('storage/'.$item->url)}}" controls width="300" height="240"></video>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="form_block row mb-3">
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="pdf">Upload catalog</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="pdf[]" class="form-control" id="pdf"  multiple="multiple">
                                                </div>
                                            </div>
                                            @error('pdf')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">formats: pdf</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 " >
                                            @if($productPdfs)
                                                @foreach($productPdfs as $productPdf)
                                                    <div class="image_block mb-2 col-sm-6">
                                                        <button type="submit" name="deletePdf" value="{{$productPdf->id}}" class="btn btn-sm btn-danger image_btn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <a href="{{asset('images/'.$productPdf->pdf_image)}}" data-gallery >
                                                            <img id="image_main" src="{{asset('images/'.$productPdf->pdf_image)}}" alt="Preview pdf image" class=" " style="width: 100px">
                                                        </a>
                                                    </div>

                                                @endforeach
                                            @endif

                                            {{--                                        @if($product->pdf && $product->pdf_image)--}}
                                            {{--                                            <img id="image_main" src="{{asset('images/'.$product->pdf_image)}}" alt="Preview pdf" class=" " style="width: 100px">--}}
                                            {{--                                        @endif--}}
                                        </div>

                                    </div>

                                    <div class="form-group col-sm-4 ">
                                        <label  class="col-form-label" for="mainImage">Upload Video instructiune</label>
                                        <div class="input-group mb-2">
                                            <div class="custom-file">
                                                <input type="file" name="video" class="form-control" id="videoInstruction">
                                            </div>
                                        </div>
                                        @error('video')<p class="text-danger"> {{$message}}</p>@enderror
                                        <p class="text-info">min size: 125x100</p>
                                        <p class="text-info">ratio: 1,25 : 1</p>
                                        <p class="text-info">formats: mp4, mov, wmv, webm</p>
                                    </div>
                                    <div class="col-sm-6 ml-3 " id="videoInstructionContainer">
                                        @if($product->video)
                                            <div class="image_block mb-2">
                                                <button type="submit" name="delete" value="{{$item->id}}" class="btn btn-sm btn-danger video_btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <a href="{{url('storage/'.$product->video)}}" data-gallery >
                                                    <video src="{{url('storage/'.$product->video)}}" controls width="300" height="240"></video>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade " id="tec-info" role="tabpanel" aria-labelledby="tec-info-tab">
                                <div class="form_block row mb-3">
                                    <div class="row mb-2">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="code_1c">Cod produs</label>
                                            <input type="text" class="form-control" id="code_1c" name="code_1c" placeholder="Cod produs" value="{{$product->code_1c}}">
                                            @error('code_1c')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="material">Material Ro</label>
                                            <input type="text" class="form-control" id="materialRo" name="material_ro" placeholder="Material Ro" value="{{$product->material_ro}}">
                                            @error('material_ro')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="material">Material Ru</label>
                                            <input type="text" class="form-control" id="materialRu" name="material_ru" placeholder="Material Ru" value="{{$product->material_ru}}">
                                            @error('material_ru')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="material">Material En</label>
                                            <input type="text" class="form-control" id="materialEn" name="material_en" placeholder="Material En" value="{{$product->material_en}}">
                                            @error('material_en')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="weight">Weight, kg</label>
                                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight" value="{{$product->weight}}">
                                            @error('weight')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="dimension">Dimension</label>
                                            <input type="text" class="form-control" id="dimension" name="dimension" placeholder="000x000x000" value="{{$product->dimension}}">
                                            @error('dimension')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="brand">Brand</label>
                                            <select class="custom-select form-control" name="brand" id="brand" >
                                                @foreach($brands as $item)
                                                    <option {{$item->name == $product->brand? 'selected': ''}} value="{{$item->name}}" >{{$item->name}}</option>
                                                @endforeach
                                            </select>

                                            @error('brand')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="power">Power, kW</label>
                                            <input type="text" class="form-control" id="power" name="power" placeholder="" value="{{$product->power}}">
                                            @error('power')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <div class="d-flex">
                                                <label for="colorProduct">Color</label>
                                                <div class="color_box" id="color_product_box" style="background-color: {{$product->color}}"></div>
                                            </div>
                                            <input type="text" class="form-control" onfocusout="colorProductHandler(this)"  id="colorProduct"  placeholder="Color">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_product_name_ro">Color name Ro</label>
                                            <input type="text" class="form-control" value="{{$product->color_name_ro}}" name="color_name_ro"  id="color_product_name_ro"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_product_name_ru">Color name Ru</label>
                                            <input type="text" class="form-control" value="{{$product->color_name_ru}}" name="color_name_ru"  id="color_product_name_ru"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_product_name_en">Color name En</label>
                                            <input type="text" class="form-control" value="{{$product->color_name_en}}" name="color_name_en"  id="color_product_name_en"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="volume">Volume, L</label>
                                            <input type="text" class="form-control" value="{{$product->volume}}" name="volume"  id="volume"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="capacity">Capacitate</label>
                                            <input type="text" class="form-control" value="{{$product->capacity}}" name="capacity"  id="capacity"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="voltage">Tensiune, V</label>
                                            <input type="text" class="form-control" value="{{$product->voltage}}" name="voltage"  id="voltage"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="rotation_speed">Viteză de rotație</label>
                                            <input type="text" class="form-control" value="{{$product->rotation_speed}}" name="rotation_speed"  id="rotation_speed"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="water_consumption">Consumul de apă, l/cycle</label>
                                            <input type="text" class="form-control" value="{{$product->water_consumption}}" name="water_consumption"  id="water_consumption"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="cycle_duration">Durata ciclului de lucru, sec</label>
                                            <input type="text" class="form-control" value="{{$product->cycle_duration}}" name="cycle_duration"  id="cycle_duration"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="maximum_temperature">Temperatura maximă, C</label>
                                            <input type="text" class="form-control" value="{{$product->maximum_temperature}}" name="maximum_temperature"  id="maximum_temperature"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="frequency">Frecvență, Hz</label>
                                            <input type="text" class="form-control" value="{{$product->frequency}}" name="frequency"  id="frequency"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="shelf_number">Numărul de rafturi</label>
                                            <input type="number" class="form-control" value="{{$product->shelf_number}}" name="shelf_number"  id="shelf_number"  >
                                        </div>



                                    </div>



                                    @if($product->brand == 'Stalgast')
                                    <div class="row mb-3">
                                        <div class="form-group col-lg-5">
                                            <label for="characteristics">Caracteristice furnizorii</label>
                                            <textarea name="characteristics" class="form-control" cols="30" id="characteristics" rows="10">{{$product->characteristics}}</textarea>
                                        </div>
                                    </div>
                                    @endif

                                    @if($product->constructor_id == '4')
                                        <h3 class="text-bold fs-3 mb-4">Сaracteristici speciale</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3 col-sm-6">
                                                <label for="nesting_capacity">Nesting capacity, mm</label>
                                                <input type="text" class="form-control" value="{{isset($product->constructorTrolley->nesting_capacity) ? $product->constructorTrolley->nesting_capacity : ''}}" name="nesting_capacity"  id="nesting_capacity"  >
                                            </div>
                                            <div class="form-group col-lg-3 col-sm-6">
                                                <label for="travelator_capacity"> Nesting capacity of travelator, mm</label>
                                                <input type="text" class="form-control" value="{{isset($product->constructorTrolley->travelator_capacity) ? $product->constructorTrolley->travelator_capacity : ''}}" name="travelator_capacity"  id="travelator_capacity"  >
                                            </div>

                                            <div class="form-group col-lg-3 col-sm-6">
                                                <label for="wheels">Roți de cărucior</label>
                                                <select class="custom-select select2 form-control" name="wheels[]" id="wheels" multiple="multiple">
                                                    @foreach($wheels as $item)
                                                        <option {{$item['selected'] ? 'selected': ''}}  value="{{$item->id}}" >{{$item->name_ro}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3 col-sm-6 color_select_block">
                                                <label for="body_colors">Body colors</label>
                                                <select class="custom-select select2 form-control" name="body_colors[]" id="body_colors" multiple="multiple">
                                                    @foreach($trolleyColors as $item)
                                                        <option {{$item['bodyColorSelected'] ? 'selected': ''}} value="{{$item->id}}" style="color:{{$item->code}}" data-color={{$item->code}}  ><div class="rounded-circle" style="width: 10px; height: 10px; background-color: {{$item->code}}"></div> {{$item->name_ro}} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-3 col-sm-6 color_select_block">
                                                <label for="handle_colors">Handle colors</label>
                                                <select class="custom-select select2 form-control" name="handle_colors[]" id="handle_colors" multiple="multiple">
                                                    @foreach($trolleyColors as $item)
                                                        <option {{$item['handleColorSelected'] ? 'selected': ''}} value="{{$item->id}}" style="color:{{$item->code}}" data-color={{$item->code}}  ><div class="rounded-circle" style="width: 10px; height: 10px; background-color: {{$item->code}}"></div> {{$item->name_ro}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3 col-sm-6 color_select_block">
                                                <label for="back_colors">Back colors</label>
                                                <select class="custom-select select2 form-control" name="back_colors[]" id="back_colors" multiple="multiple">
                                                    @foreach($trolleyColors as $item)
                                                        <option {{$item['backColorSelected'] ? 'selected': ''}} value="{{$item->id}}" style="color:{{$item->code}}" data-color={{$item->code}}  ><div class="rounded-circle" style="width: 10px; height: 10px; background-color: {{$item->code}}"></div> {{$item->name_ro}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3 col-sm-6 color_select_block">
                                                <label for="baby_seat_colors">Baby seat colors</label>
                                                <select class="custom-select select2 form-control" name="baby_seat_colors[]" id="baby_seat_colors" multiple="multiple">
                                                    @foreach($trolleyColors as $item)
                                                        <option {{$item['babySeatColorSelected'] ? 'selected': ''}} value="{{$item->id}}" style="color:{{$item->code}}" data-color={{$item->code}}  ><div class="rounded-circle" style="width: 10px; height: 10px; background-color: {{$item->code}}"></div> {{$item->name_ro}} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-3 col-sm-6 color_select_block">
                                                <label for="basket_colors">Basket colors</label>
                                                <select class="custom-select select2 form-control" name="basket_colors[]" id="basket_colors" multiple="multiple">
                                                    @foreach($trolleyColors as $item)
                                                        <option {{$item['basketColorSelected'] ? 'selected': ''}} value="{{$item->id}}" style="color:{{$item->code}}" data-color={{$item->code}}  ><div class="rounded-circle" style="width: 10px; height: 10px; background-color: {{$item->code}}"></div> {{$item->name_ro}} </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>

                                    @endif

                                    @if($product->constructor_id == '5')
                                        <h3 class="text-bold fs-3 mb-4">Сaracteristici speciale</h3>
                                        <div class="row">
                                            <div class="form-group col-lg-3 col-sm-6">
                                                <label for="stacking_capacity">Stacking capacity, mm</label>
                                                <input type="text" class="form-control" value="{{isset($product->constructorBasket->stacking_capacity) ? $product->constructorBasket->stacking_capacity : ''}}" name="stacking_capacity"  id="stacking_capacity"  >
                                            </div>


                                            <div class="form-group col-lg-3 col-sm-6 color_select_block">
                                                <label for="basket_colors">Basket colors</label>
                                                <select class="custom-select select2 form-control" name="basket_colors[]" id="basket_colors" multiple="multiple">
                                                    @foreach($constructorBasketColors as $item)
                                                        <option {{$item['basketColorSelected'] ? 'selected': ''}} value="{{$item->id}}" style="color:{{$item->code}}" data-color={{$item->code}}  ><div class="rounded-circle" style="width: 10px; height: 10px; background-color: {{$item->code}}"></div> {{$item->name_ro}} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-3 col-sm-6 color_select_block">
                                                <label for="handle_colors">Handle colors</label>
                                                <select class="custom-select select2 form-control" name="handle_colors[]" id="handle_colors" multiple="multiple">
                                                    @foreach($constructorBasketColors as $item)
                                                        <option {{$item['handleColorSelected'] ? 'selected': ''}} value="{{$item->id}}" style="color:{{$item->code}}" data-color={{$item->code}}  ><div class="rounded-circle" style="width: 10px; height: 10px; background-color: {{$item->code}}"></div> {{$item->name_ro}} </option>
                                                    @endforeach
                                                </select>
                                            </div>



                                        </div>
                                    @endif



                                </div>

                                @if($product->constructor_id == 2)

                                <div class="form_block row mb-3" id="variants-container">
                                    <h2 class="text-bold fs-3 mb-4">Opțiuni de produs</h2>
                                    @foreach($productVariants as $key=>$variant)
                                    <div class="row mb-2">
                                        <h3 class="fs-4 mb-4">Optiune - {{$key+1}}</h3>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="code0">Cod produs</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['code']}}" data-name="code" id="code0" placeholder="Cod produs">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="weight0">Weight, kg</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['weight']}}" data-name="weight" id="weight0" placeholder="Weight" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="price0">Price</label>
                                            <input type="number" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['price']}}" data-name="price" id="price0" placeholder="Price">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="type_ro0">Type Ro</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['type_ro']}}" data-name="type_ro" id="type_ro0" placeholder="Type Ro">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="type_ru0">Type Ru</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['type_ru']}}" data-name="type_ru" id="type_ru0" placeholder="Type Ru">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="type_en0">Type En</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['type_en']}}" data-name="type_en" id="type_en0" placeholder="Type En">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <div class="d-flex">
                                                <label for="color0">Color</label>
                                                <div class="color_box" id="color_box{{$key}}" style="background-color: {{$variant['color']}}"></div>
                                            </div>
                                            <input type="text" class="form-control" onfocusout="colorHandler(this, {{$key}})" oninput="variantHandler(this, {{$key}})" value="{{$variant['color']}}" data-name="color" id="color0"  placeholder="Color">
                                        </div>

                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_ro0">Color name Ro</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['color_name_ro']}}" data-name="color_name_ro" id="color_name_ro0" placeholder="Color name Ro" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_ru0">Color name Ru</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['color_name_ru']}}" data-name="color_name_ru" id="color_name_ru0" placeholder="Color name Ru" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_en0">Color name En</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['color_name_en']}}" data-name="color_name_en" id="color_name_en0" placeholder="Color name En" >
                                        </div>

                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="model0">Model</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['model']}}" data-name="model" id="model0" placeholder="Model">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="max_load0">Max loaded, kg</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['max_load']}}" data-name="max_load" id="max_load0" placeholder="Max loaded">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="extension_length0">Lungime de extensie</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['extension_length']}}" data-name="extension_length" id="extension_length0" placeholder="Lungime de extensie">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="dimension0">Dimensiune</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['dimension']}}" data-name="dimension" id="dimension0" placeholder="Dimensiune">
                                        </div>

{{--                                        <div class="form-group col-lg-3 col-sm-6">--}}
{{--                                            <label for="shelf_quantity0">Cantitatea poliței</label>--}}
{{--                                            <input type="number" class="form-control" oninput="variantHandler(this, {{$key}})" value="{{$variant['shelf_quantity']}}" id="shelf_quantity0" data-name="shelf_quantity_en" placeholder="">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-lg-3 col-sm-6">--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <label for="shelf_color0">Culoare poliței</label>--}}
{{--                                                <div class="color_box" id="color_shelf_box{{$key}}" style="background-color: {{$variant['shelf_color']}}"></div>--}}
{{--                                            </div>--}}
{{--                                            <input type="text" class="form-control" onfocusout="colorShelfHandler(this, {{$key}})" oninput="variantHandler(this, {{$key}})" value="{{$variant['shelf_color']}}" data-name="shelf_color" id="shelf_color0"  placeholder="">--}}
{{--                                        </div>--}}
                                    </div>
                                    @endforeach

                                    <div class="d-flex justify-content-between mb-5">
                                        <button type="button" class="btn btn-outline-primary" onclick="addVariant()">Adauga optiune</button>
                                    </div>

                                </div>

                                @endif
                                <div class="form_block row mb-3">
                                    <div class="row mb-3">
                                        <h3 class="text-bold fs-3 mb-4">Labels</h3>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="badge_top">Top 100</label>
                                            <select class="custom-select  form-control " name="badge_top" id="badge_top" >
                                                <option value="1" {{$product->badge_top == 1 ? 'selected' : ''}}> Activat</option>
                                                <option value="0" {{$product->badge_top == 0 ? 'selected' : ''}}>Dezactivat</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="badge_new">Produs nou</label>
                                            <select class="custom-select  form-control " name="badge_new" id="badge_new" >
                                                <option value="1" {{$product->badge_new == 1 ? 'selected' : ''}}> Activat</option>
                                                <option value="0" {{$product->badge_new == 0 ? 'selected' : ''}}>Dezactivat</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="badge_moldova">Produs în Moldova</label>
                                            <select class="custom-select  form-control " name="badge_moldova" id="badge_moldova" >
                                                <option value="1" {{$product->badge_moldova == 1 ? 'selected' : ''}}> Activat</option>
                                                <option value="0" {{$product->badge_moldova == 0 ? 'selected' : ''}}>Dezactivat</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="tab-pane fade " id="add-info" role="tabpanel" aria-labelledby="add-info-tab">
                                @foreach($productSpecifications as $key=>$specification)
                                    <div class="form_block mb-4">
                                        <div class="row mb-3 ">
                                            <h4 class="mb-3">Numele specificatii suplimentare-{{$key+1}}</h4>
                                            <div class="d-flex form-group col-sm-4">
                                                <label for="title_ro{{$key}}">
                                                    <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
                                                </label>
                                                <input type="text" class="form-control ml-2"  id="title_ro{{$key}}" oninput="specificationHandler(this, {{$key}})" value="{{$specification['title_ro']}}" data-name="title_ro" placeholder="Numele specificatii suplimentare Ro" >

                                            </div>
                                            <div class="d-flex form-group col-sm-4">
                                                <label for="title_ru{{$key}}">
                                                    <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">
                                                </label>
                                                <input type="text" class="form-control ml-2" id="title_ru{{$key}}" oninput="specificationHandler(this, {{$key}})" value="{{$specification['title_ru']}}" data-name="title_ru" placeholder="Numele specificatii suplimentare Ru">

                                            </div>

                                            <div class="d-flex form-group col-sm-4">
                                                <label for="title_en{{$key}}">
                                                    <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">
                                                </label>
                                                <input type="text" class="form-control ml-2" id="title_en{{$key}}" oninput="specificationHandler(this, {{$key}})" value="{{$specification['title_en']}}" data-name="title_en" placeholder="Numele specificatii suplimentare En" >

                                            </div>
                                        </div>

                                        <div class="row mb-3 ">

                                            <h4 class="mb-3">Descriere specificatii suplimentare-{{$key+1}}</h4>
                                            <div class=" form-group mb-3 col-sm-4">
                                                <label for="description_ro{{$key}}">
                                                    Romana
                                                </label>
                                                <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="description_ro{{$key}}" onchange="specificationHandler(this, {{$key}})" data-name="description_ro"
                                                          placeholder="Descriere specificatii suplimentare Ro" >{!! $specification['description_ro'] !!}</textarea>
                                            </div>
                                            <div class="form-group mb-3 col-sm-4">
                                                <label for="description_ru{{$key}}">
                                                    Russian
                                                </label>
                                                <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="description_ru{{$key}}" onchange="specificationHandler(this, {{$key}})" data-name="description_ru"
                                                          placeholder="Descriere specificatii suplimentare Ru" >{!! $specification['description_ru'] !!}</textarea>
                                            </div>
                                            <div class=" form-group mb-3 col-sm-4">
                                                <label for="description_en{{$key}}">
                                                    English
                                                </label>
                                                <textarea cols="6" rows="6" class="form-control ml-2 description_editor" id="description_en{{$key}}" onchange="specificationHandler(this, {{$key}})" data-name="description_en"
                                                          placeholder="Descriere specificatii suplimentare En" >{!! $specification['description_en'] !!}</textarea>
                                            </div>


                                        </div>
                                    </div>

                                @endforeach

                                <div class="d-flex justify-content-between mb-5">
                                    <button type="button" class="btn btn-outline-primary" onclick="addSpecification()">Adauga specificatie</button>
                                </div>

                            </div>
                            <div class="tab-pane fade " id="key-features" role="tabpanel" aria-labelledby="key-features-tab">
                                   <div class="row mb-4 align-items-start">

                                    <div class="col-sm-8">
                                        <h1 class="m-0">Caracteristici cheie</h1>
                                    </div><!-- /.col -->
                                    <div class="col-sm-4 d-flex justify-content-end">
                                        <a href="{{route('product.createFeature', $product->id)}}" class="btn btn-outline-primary mr-5 px-3 ">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </div>
                                   </div>
                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-hover text-nowrap" id="featureTable">
                                                    <thead>
                                                    <tr>

                                                        <th>Image</th>
                                                        <th>Numele</th>
                                                        <th>Descriere</th>
                                                        <th>Acțiune</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($features as $item)
                                                        @php
                                                         if(strlen($item->description_ro) > 150){
                                                      $descriptionText = substr($item->description_ro, 0, 100).'...';
                                                   }  else $descriptionText = $item->description_ro;
                                                   @endphp

                                                        <tr >

                                                            <td>
                                                                <img src="{{url('storage/'.$item->image)}}" alt="Product image" width="50px">
                                                            </td>
                                                            <td> {{$item->title_ro}}</td>
                                                            <td> {{$descriptionText}}</td>


                                                            <td class="d-flex">
                                                                <div class="mr-2">
                                                                    <a href="{{route('product.editFeature', [$item->id, $product->id])}}" class="btn btn-sm btn-warning">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                </div>

{{--                                                                <form action="{{route('product.deleteFeature', [$item->id, $product->id])}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">--}}
{{--                                                                    @csrf--}}
{{--                                                                    @method(('delete'))--}}
                                                                    <button type="submit" name="deleteFeature" value="{{$item->id}}" class="btn btn-sm btn-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
{{--                                                                </form>--}}

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div><!-- /.container-fluid -->
                                </section>




                            </div>
                            <div class="tab-pane fade " id="similar-products" role="tabpanel" aria-labelledby="similar-products-tab">
                                <div class="row mb-4 align-items-start">

                                    <div class="col-sm-8">
                                        <h1 class="m-0">Produse Similare</h1>
                                    </div><!-- /.col -->
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="industry">Produse</label>
                                        <select class="custom-select select2 form-control" name="similarProducts_id[]" id="similarProducts" multiple="multiple">
                                            @foreach($products as $item)
                                                <option  value="{{$item->id}}" >{{$item->name_ro}}</option>
                                            @endforeach
                                        </select>
                                    </div>

{{--                                    <div class="col-sm-4 d-flex justify-content-end">--}}
{{--                                        <a href="{{route('product.createFeature', $product->id)}}" class="btn btn-outline-primary mr-5 px-3 ">--}}
{{--                                            <i class="fas fa-plus-circle"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                </div>
                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @if(isset($similarProducts))
                                            <div class="col-12">
                                                <table class="table table-hover text-nowrap" id="similarTable">
                                                    <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Numele</th>
                                                        <th>Acțiune</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($similarProducts as $item)

                                                        <tr>
                                                            <td>
                                                                <img src="{{url('storage/'.$item->image_preview)}}" alt="Product image" width="50px">
                                                            </td>
                                                            <td> {{$item->name_ro}}</td>

                                                            <td class="d-flex">
                                                                <button type="submit" name="deleteProduct" value="{{$item->id}}" class="btn btn-sm btn-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                             @endif
                                        </div>

                                    </div><!-- /.container-fluid -->
                                </section>




                            </div>
                        </div>

                        <div class="form-group text-center d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" id="saveBtn" name="update" value="Save">
                            <div class="spinner-border text-primary ms-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                    </form>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        @endsection

        @push('script')


            <script>

                const selectImagePreview =  document.getElementById('previewImage');
                const selectImageMain =  document.getElementById('mainImages');
                const videoInstruction =  document.getElementById('videoInstruction');
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mainImageContainer = document.getElementById('mainImageContainer');
                const videoInstructionContainer = document.getElementById('videoInstructionContainer');

                const category = document.getElementById('category');
                const subcategory = document.getElementById('subcategory');
                const specificationItemsInput = document.getElementById('specificationItems')
                const variantItemsInput = document.getElementById('variantItems')
                const variantsContainer = document.getElementById('variants-container')
                const specificationsContainer = document.getElementById('add-info')

                const productVariants = {!! $productVariants !!};
                const productSpecifications = {!! $productSpecifications !!};
                const specificationsLength = productSpecifications.length

                console.log(productSpecifications)

                const table = $('#featureTable').DataTable({
                    "language": {
                        "lengthMenu": "_MENU_  elemente pe pagină",
                        "info": "Arătată _START_ pînă la _END_ de la _TOTAL_ elemente",
                        "search": "Căutare:",
                        "paginate": {
                            "first": "First",
                            "last": "Last",
                            "next": ">",
                            "previous": "<"
                        }
                    },
                    // order: [[3, 'asc']],
                    "columnDefs": [
                        { "orderable": false, "targets": [3] }
                    ]
                });
                table.buttons( '.export' ).remove();

                const similarTable = $('#similarTable').DataTable({
                    "language": {
                        "lengthMenu": "_MENU_  elemente pe pagină",
                        "info": "Arătată _START_ pînă la _END_ de la _TOTAL_ elemente",
                        "search": "Căutare:",
                        "paginate": {
                            "first": "First",
                            "last": "Last",
                            "next": ">",
                            "previous": "<"
                        }
                    },
                    // order: [[3, 'asc']],
                    "columnDefs": [
                        { "orderable": false, "targets": [2] }
                    ]
                });
                similarTable.buttons( '.export' ).remove();

                for(let i=0; i<specificationsLength; i+=1) {
                    ClassicEditor.create(document.querySelector('#description_ro'+i), editorConfig)
                        .catch(error => {
                            console.error(error);
                        }).then(editor => {
                        editor.model.document.on('change:data', (evt, data) => {
                            specificationItems[i]['description_ro']=editor.getData();
                            specificationItemsInput.value = JSON.stringify(specificationItems)
                            console.log('specificationItems', specificationItems)

                        });
                    })
                        .catch(error => {
                            console.error('Editor initialization error.', error);
                        });
                    ClassicEditor.create(document.querySelector('#description_ru'+i), editorConfig)
                        .catch(error => {
                            console.error(error);
                        }).then(editor => {
                        editor.model.document.on('change:data', (evt, data) => {
                            specificationItems[i]['description_ru']=editor.getData();
                            specificationItemsInput.value = JSON.stringify(specificationItems)
                            console.log('specificationItems', specificationItems)

                        });
                    })
                        .catch(error => {
                            console.error('Editor initialization error.', error);
                        });
                    ClassicEditor.create(document.querySelector('#description_en'+i), editorConfig)
                        .catch(error => {
                            console.error(error);
                        }).then(editor => {
                        editor.model.document.on('change:data', (evt, data) => {
                            specificationItems[i]['description_en']=editor.getData();
                            specificationItemsInput.value = JSON.stringify(specificationItems)
                            console.log('specificationItems', specificationItems)

                        });
                    })
                        .catch(error => {
                            console.error('Editor initialization error.', error);
                        });
                }




                const variantItems = []
                productVariants.forEach(item=>{
                    const variant = {
                        id:item['id'],
                        code:item['code'],
                        color:item['color'],
                        price:item['price'],
                        weight:item['weight'],
                        type_ro:item['type_ro'],
                        type_ru:item['type_ru'],
                        type_en:item['type_en'],
                        max_load:item['max_load'],
                        color_name_ro:item['color_name_ro'],
                        color_name_ru:item['color_name_ru'],
                        color_name_en:item['color_name_en'],
                        model:item['model'],
                        extension_length:item['extension_length'],
                        dimension:item['dimension'],

                    }
                    variantItems.push(variant)
                })

                const specificationItems = []

                productSpecifications.forEach(item => {
                    const specification = {
                        id:item['id'],
                        title_ro:item['title_ro'],
                        title_ru:item['title_ru'],
                        title_en:item['title_en'],
                        description_ro:item['description_ro'],
                        description_ru:item['description_ru'],
                        description_en:item['description_en'],
                    }
                    specificationItems.push(specification)
                })



                let variantCount = productVariants.length-1;
                let specCount = productSpecifications.length-1;

                function formatState(state) {
                    const option = $(state.element);
                    const color = option.data("color");

                    if (!color) {
                        return state.text;
                    }

                    return $(`<span style="color: ${color}">${state.text}</span>`);
                }


                $('.select2').select2({
                    templateResult: formatState,
                    templateSelection: formatState,
                })

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                Fancybox.bind("[data-fancybox]", {
                    // Your custom options
                });
                Fancybox.bind("[data-gallery]", {
                    // Your custom options
                });

                document.getElementById('saveBtn').addEventListener('click', ()=>{
                    document.querySelector('.spinner-border').style.display = 'block';
                })




                // mainImageContainer.addEventListener('mousedown', function(event) {
                //         var mousePosition;
                //         var offset = [0,0];
                //         var isDown = false;
                //     let startElement = null;
                //     let endElement = null;
                //
                //         const el = event.target;
                //
                //
                //         var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
                //
                //         function dragMouseDown(e) {
                //             // e = e || window.event;
                //             e.preventDefault();
                //
                //             // get the mouse cursor position at startup:
                //             pos3 = e.clientX;
                //             pos4 = e.clientY;
                //
                //             startElement = e.target;
                //
                //
                //             isDown = true;
                //             offset = [
                //                 el.offsetLeft - e.clientX,
                //                 el.offsetTop - e.clientY
                //             ];
                //
                //             mainImageContainer.onmouseup = closeDragElement;
                //             // call a function whenever the cursor moves:
                //             mainImageContainer.onmousemove = elementDrag;
                //         }
                //         dragMouseDown(event)
                //
                //         function elementDrag(e) {
                //             // e = e || window.event;
                //
                //             e.preventDefault();
                //             if (isDown) {
                //                 mousePosition = {
                //
                //                     x : event.clientX,
                //                     y : event.clientY
                //
                //                 };
                //                 el.style.left = (mousePosition.x + offset[0]) + 'px';
                //                 el.style.top  = (mousePosition.y + offset[1]) + 'px';
                //             }
                //
                //         }
                //
                //         function closeDragElement(e) {
                //
                //              endElement = e.target;
                //
                //             const src = startElement.src
                //
                //             startElement.src = endElement.src
                //             e.target.src = src
                //
                //             isDown = false;
                //
                //             mainImageContainer.onmouseup = null;
                //             mainImageContainer.onmousemove = null;
                //         }
                //
                //     })






                function selectCategory() {
                    let industryId = $('#industry').find(":selected").val();

                    let industries = {!! json_encode($industriesAll) !!};

                    let IndustryList = industries.find(item => item.id === Number(industryId))
                    const CategoryList = IndustryList.categories

                    if(CategoryList) {
                        let options = "";

                        CategoryList.forEach(category=> {
                            options += `<option value="${category.id}" >${category.name_ro}</option>`;
                        })

                        category.innerHTML = options;
                    }

                    let categories = {!! json_encode($categoriesAll) !!};


                    let categoryList = categories.find(item => item.industry_id === Number(industryId))

                    const subCategoryList = categoryList.subcategories

                    if(subCategoryList) {
                        let options = "";
                        //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                        subCategoryList.forEach(category=> {
                            options += `<option value="${category.id}" >${category.name_ro}</option>`;
                        })

                        subcategory.innerHTML = options;
                    }
                    // selectSubcategory()
                }

                function selectSubcategory() {
                    let categoryId = $('#category').find(":selected").val();

                    console.log(categoryId)

                    let categories = {!! json_encode($categoriesAll) !!};

                    let categoryList = categories.find(item => item.id === Number(categoryId))
                    if(categoryList) {
                        const CategoryList = categoryList.subcategories

                        if(CategoryList) {
                            let options = "";
                            //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                            CategoryList.forEach(category=> {
                                options += `<option value="${category.id}" >${category.name_ro}</option>`;
                            })

                            subcategory.innerHTML = options;
                        }
                    }

                }

                // selectCategory()
                // selectSubcategory()

                $('#industry').on('change', event=>{
                    selectCategory()

                })


                selectImagePreview.onchange = evt => {
                    const imgs = document.querySelectorAll('.added_preview_image')
                    if (imgs) {
                        imgs.forEach(img => {
                            img.remove()
                        })

                    }
                    const files = selectImagePreview.files
                    let imagesArray = []

                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png') {
                            imagesArray.push(files[i])
                            if (files[i]) {

                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Preview product image";
                                image.classList.add('added_preview_image');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                previewImageContainer.append(image);

                            }
                        }
                    }
                }

                selectImageMain.onchange = evt => {
                    const imgs = document.querySelectorAll('.added_main_image')
                    if (imgs) {
                        imgs.forEach(img => {
                            img.remove()
                        })

                    }
                    const files = selectImageMain.files
                    let imagesArray = []

                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
                            imagesArray.push(files[i])
                            if (files[i]) {
                                const imageBlock = document.createElement("div");
                                imageBlock.classList.add('image_block');

                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Main product image";
                                image.classList.add('added_main_image');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mainImageContainer.append(imageBlock);
                                imageBlock.append(image);
                            }
                        }
                        if (files[i].type === 'video/mp4'  || files[i].type === 'video/mov' || files[i].type === 'video/wmv' || files[i].type === 'video/webm') {
                            if (files[i]) {
                                const video = document.createElement("video");
                                video.src = URL.createObjectURL(files[i]);
                                video.autoplay = false;
                                video.controls = true;
                                video.muted = false;
                                video.height = 240;
                                video.width = 300;
                                video.style.marginBottom = "20px";
                                mainImageContainer.append(video);
                            }
                        }
                    }
                }

                videoInstruction.onchange = evt => {
                    const video = document.querySelector('.added_video')
                    if (video) {
                        video.remove()

                    }
                    const files = videoInstruction.files


                    for (let i = 0; i < files.length; i++) {

                        if (files[i].type === 'video/mp4'  || files[i].type === 'video/mov' || files[i].type === 'video/wmv' || files[i].type === 'video/webm') {
                            if (files[i]) {
                                const video = document.createElement("video");
                                video.src = URL.createObjectURL(files[i]);
                                video.autoplay = false;
                                video.controls = true;
                                video.muted = false;
                                video.height = 240;
                                video.width = 300;
                                video.classList.add('added_video');

                                videoInstructionContainer.append(video);
                            }
                        }
                    }
                }


                function variantHandler(input, j=0) {
                    const name = input.dataset.name
                    variantItems[j][name]=input.value;
                    variantItemsInput.value = JSON.stringify(variantItems)
                    console.log('variantItems', variantItems)
                }

                function specificationHandler(input, j=0) {
                    const name = input.dataset.name
                    console.log(name)
                    specificationItems[j][name]=input.value;
                    specificationItemsInput.value = JSON.stringify(specificationItems)
                    console.log('specificationItems', specificationItems)
                }

                function colorProductHandler(el) {
                    document.querySelector('#color_product_box').style.backgroundColor = el.value
                }


                function colorHandler(el, index) {
                    document.querySelector('#color_box'+index).style.backgroundColor = el.value
                }

                // function featureImageHandler(input, j=0) {
                //
                //     const existingImage = document.querySelector('.added_feature_image'+j)
                //     if(existingImage) {
                //         existingImage.remove();
                //     }
                //     const files = document.getElementById('featureImage'+j).files
                //     featureItems[j]['image']=files;
                //     featuresItemsInput.value = JSON.stringify(featureItems)
                //     let imagesArray = []
                //     console.log(featuresItemsInput.value)
                //     for (let i = 0; i < files.length; i++) {
                //         if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
                //             imagesArray.push(files[i])
                //             if (files[i]) {
                //                 const image = document.createElement("img");
                //                 image.src = URL.createObjectURL(files[i]);
                //                 image.alt = "Feature product image";
                //                 image.classList.add('added_feature_image'+j);
                //                 image.style.width = "300px";
                //                 image.style.marginBottom = "20px";
                //                 image.style.marginRight = "20px";
                //                 document.getElementById('featureImageContainer'+j).append(image);
                //             }
                //         }
                //     }
                // }

                function addVariant() {
                    variantItems.push({
                        id:0,
                        code:'',
                        color:'',
                        price:0,
                        weight:'',
                        type:'',
                        max_load:'',
                        color_name_ro:'',
                        color_name_ru:'',
                        color_name_en:'',
                        type_ro:'',
                        type_ru:'',
                        type_en:'',
                        model:'',
                        extension_length:'',
                        dimension:'',


                    })
                    const markup = document.createElement('div');
                    markup.classList = 'form-row-variant--' + ++variantCount;
                    markup.innerHTML =`<h3 class="fs-4 mb-4">Optiune - ${variantCount+1}</h3>
                                        <div class="row mb-2">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="code${variantCount}">Cod produs</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" data-name="code" id="code${variantCount}" placeholder="Cod produs">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="weight${variantCount}">Weight</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" data-name="weight" id="weight${variantCount}" placeholder="Weight" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="price${variantCount}">Price</label>
                                            <input type="number" class="form-control" oninput="variantHandler(this, variantCount)" data-name="price" id="price${variantCount}" placeholder="Price">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="type_ro${variantCount}">Type Ro</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" data-name="type_ro" id="type_ro${variantCount}" placeholder="Type">
                                        </div>
       <div class="form-group col-lg-3 col-sm-6">
                                            <label for="type_ru${variantCount}">Type Ru</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" data-name="type_ru" id="type_ru${variantCount}" placeholder="Type">
                                        </div>
       <div class="form-group col-lg-3 col-sm-6">
                                            <label for="type_en${variantCount}">Type En</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" data-name="type_en" id="type_en${variantCount}" placeholder="Type">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                              <div class="d-flex">
                                                <label for="color${variantCount}">Color</label>
                                                <div class="color_box" id="color_box${variantCount}"></div>
                                            </div>
                                            <input type="text" class="form-control"  onfocusout="colorHandler(this, variantCount)" oninput="variantHandler(this, variantCount)" data-name="color" id="color${variantCount}"  placeholder="Color">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_ro${variantCount}">Color name Ro</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, ${variantCount})"  data-name="color_name_ro" id="color_name_ro${variantCount}" placeholder="Color name Ro" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_ru${variantCount}">Color name Ru</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, ${variantCount})"  data-name="color_name_ru" id="color_name_ru${variantCount}" placeholder="Color name Ru" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_en${variantCount}">Color name En</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, ${variantCount})"  data-name="color_name_en" id="color_name_en${variantCount}" placeholder="Color name En" >
                                        </div>


                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="model${variantCount}">Model</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" data-name="model" id="model${variantCount}" placeholder="Model">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="max_load${variantCount}">Max loaded, kg</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" id="max_load${variantCount}" data-name="max_load" placeholder="Max loaded">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="extension_length${variantCount}">Lungime de extensie</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" id="extension_length${variantCount}" data-name="extension_length" placeholder="Lungime de extensie">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="dimension${variantCount}">Dimensiune</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" id="dimension${variantCount}" data-name="dimension" placeholder="Dimensiune">
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-between mb-5">
                                        <button type="button" class="btn btn-outline-primary" onclick="addVariant()">Adauga optiune</button>
                                        <button type="button" class="btn btn-outline-danger" onclick="removeVariant()">Sterge optiune</button>
                                    </div>`;
                    variantsContainer.append(markup);
                }

                function removeVariant() {
                    const div = document.querySelector('.form-row-variant--' + variantCount);
                    div.remove();
                    variantItems.splice(variantCount, 1);
                    --variantCount;
                }

                function addSpecification() {
                    specificationItems.push({
                        id:0,
                        title_ro:'',
                        title_ru:'',
                        title_en:'',
                        description_ro:'',
                        description_ru:'',
                        description_en:'',
                    })
                    const markup = document.createElement('div');
                    markup.classList ='form_block mb-4 '+ 'form-row--' + ++specCount;
                    markup.innerHTML = `<div class="row mb-3 ">
                                    <h4 class="mb-3">Numele specificatii suplimentare-${specCount+1}</h4>
                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_ro1">
                                            <img src="/images/flags/ro.png" width="20px" alt="Romana">
                                        </label>
                                        <input type="text" class="form-control ml-2"  id="title_ro1" oninput="specificationHandler(this, specCount)" data-name="title_ro" placeholder="Numele specificatii suplimentare Ro" >

                                    </div>
                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_ru1">
                                            <img src="/images/flags/ru.png" width="20px" alt="Russian">
                                        </label>
                                        <input type="text" class="form-control ml-2" id="title_ru1" oninput="specificationHandler(this, specCount)" data-name="title_ru" placeholder="Numele specificatii suplimentare Ru">

                                    </div>

                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_en1">
                                            <img src="/images/flags/gb.png" width="20px" alt="English">
                                        </label>
                                        <input type="text" class="form-control ml-2" id="title_en1" onchange="specificationHandler(this, specCount)" data-name="title_en" placeholder="Numele specificatii suplimentare En" >

                                    </div>
                                </div>

                                <div class="row mb-3 ">
                                    <h4 class="mb-3">Descriere specificatii suplimentare-${specCount+1}</h4>
                                    <div class=" form-group mb-3 col-sm-4">
                                        <label for="description_ro1">
                                            Romana
                                        </label>
                                        <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="description_ro${specCount}" onchange="specificationHandler(this, specCount)" data-name="description_ro" placeholder="Descriere specificatii suplimentare Ro" ></textarea>
                                    </div>
                                    <div class="form-group mb-3 col-sm-4">
                                        <label for="description_ru1">
                                            Russian
                                        </label>
                                        <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="description_ru${specCount}" onchange="specificationHandler(this, specCount)" data-name="description_ru" placeholder="Descriere specificatii suplimentare Ru" ></textarea>
                                    </div>
                                    <div class=" form-group mb-3 col-sm-4">
                                        <label for="description_en1">
                                            English
                                        </label>
                                        <textarea cols="6" rows="6" class="form-control ml-2 description_editor" id="description_en${specCount}" onchange="specificationHandler(this, specCount)" data-name="description_en" placeholder="Descriere specificatii suplimentare En" ></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mb-5">
                                    <button type="button" class="btn btn-outline-primary" onclick="addSpecification()">Adauga specificatie</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="removeSpecification()">Sterge specificatie</button>
                                </div>`;
                    specificationsContainer.append(markup)

                    ClassicEditor.create(document.querySelector('#description_ro'+specCount), editorConfig)
                        .catch(error => {
                            console.error(error);
                        }).then(editor => {
                        editor.model.document.on('change:data', (evt, data) => {
                            specificationItems[specCount]['description_ro']=editor.getData();
                            specificationItemsInput.value = JSON.stringify(specificationItems)
                            console.log('specificationItems', specificationItems)

                        });
                    })
                        .catch(error => {
                            console.error('Editor initialization error.', error);
                        });
                    ClassicEditor.create(document.querySelector('#description_ru'+specCount), editorConfig)
                        .catch(error => {
                            console.error(error);
                        }).then(editor => {
                        editor.model.document.on('change:data', (evt, data) => {
                            specificationItems[specCount]['description_ru']=editor.getData();
                            specificationItemsInput.value = JSON.stringify(specificationItems)
                            console.log('specificationItems', specificationItems)

                        });
                    })
                        .catch(error => {
                            console.error('Editor initialization error.', error);
                        });
                    ClassicEditor.create(document.querySelector('#description_en'+specCount), editorConfig)
                        .catch(error => {
                            console.error(error);
                        }).then(editor => {
                        editor.model.document.on('change:data', (evt, data) => {
                            specificationItems[specCount]['description_en']=editor.getData();
                            specificationItemsInput.value = JSON.stringify(specificationItems)
                            console.log('specificationItems', specificationItems)

                        });
                    })
                        .catch(error => {
                            console.error('Editor initialization error.', error);
                        });


                }

                function removeSpecification() {
                    const div = document.querySelector('.form-row--' + specCount);
                    div.remove();
                    specificationItems.splice(specCount, 1);
                    --specCount;
                }

                // function addFeature() {
                //     console.log('featureItems', featureItems)
                //     featureItems.push({
                //         title_ro:'',
                //         title_ru:'',
                //         title_en:'',
                //         description_ro:'',
                //         description_ru:'',
                //         description_en:'',
                //         image:'',
                //
                //     })
                //     const markup = document.createElement('div');
                //     markup.classList = 'form-feature-row--' + ++featureCount;
                //     markup.innerHTML = `<div class="form_block row mb-3 ">
                //                  <h4 class="mb-3">Caracteristici cheie-${featureCount+1}</h4>
                //                     <div class="row">
                //                     <div class="d-flex form-group col-sm-4">
                //                         <label for="feature_title_ro${featureCount}">
                //                             <img src="/images/flags/ro.png" width="20px" alt="Romana">
                //                         </label>
                //                         <input type="text" class="form-control ml-2"  id="feature_title_ro${featureCount}" oninput="featureHandler(this, featureCount)" data-name="title_ro" placeholder="Numele caracteristic Ro" >
                //                     </div>
                //                     <div class="d-flex form-group col-sm-4">
                //                         <label for="feature_title_ru${featureCount}">
                //                             <img src="/images/flags/ru.png" width="20px" alt="Russian">
                //                         </label>
                //                         <input type="text" class="form-control ml-2" id="feature_title_ru${featureCount}" oninput="featureHandler(this, featureCount)" data-name="title_ru" placeholder="Numele caracteristic Ru">
                //                     </div>
                //                     <div class="d-flex form-group col-sm-4">
                //                         <label for="feature_title_en${featureCount}">
                //                             <img src="/images/flags/gb.png" width="20px" alt="English">
                //                         </label>
                //                         <input type="text" class="form-control ml-2" id="feature_title_en${featureCount}" onchange="featureHandler(this, featureCount)" data-name="title_en" placeholder="Numele caracteristic En" >
                //                     </div>
                //                     </div>
                //                     <div class="row">
                //                         <div class=" form-group mb-3 col-sm-4">
                //                             <label for="feature_description_ro${featureCount}">
                //                                 Romana
                //                             </label>
                //                             <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="feature_description_ro${featureCount}" onchange="featureHandler(this, featureCount)" data-name="description_ro"  placeholder="Descriere caracteristic Ro" ></textarea>
                //                         </div>
                //                         <div class="form-group mb-3 col-sm-4">
                //                             <label for="feature_description_ru${featureCount}">
                //                                 Russian
                //                             </label>
                //                             <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="feature_description_ru${featureCount}" onchange="featureHandler(this, featureCount)" data-name="description_ru" placeholder="Descriere caracteristic Ru" ></textarea>
                //                         </div>
                //                         <div class=" form-group mb-3 col-sm-4">
                //                             <label for="feature_description_en${featureCount}">
                //                                 English
                //                             </label>
                //                             <textarea cols="6" rows="6" class="form-control ml-2 description_editor" id="feature_description_en${featureCount}" onchange="featureHandler(this, featureCount)" data-name="description_en" placeholder="Descriere caracteristic En" ></textarea>
                //                         </div>
                //                     </div>
                //                     <div class="row mb-3">
                //                         <div class="form-group col-sm-4 ">
                //                             <label  class="col-form-label" for="featureImage">Upload image</label>
                //                             <div class="input-group mb-2">
                //                                 <div class="custom-file">
                //                                     <input type="file" onchange="featureImageHandler(this, featureCount)" class="form-control" id="featureImage${featureCount}" >
                //                                 </div>
                //                             </div>
                //                             <p class="text-info">min size: 290x250</p>
                //                             <p class="text-info">ratio: 1,15 : 1</p>
                //                             <p class="text-info">formats: jpeg, png, webp</p>
                //                         </div>
                //                         <div class="col-sm-6 ml-3 d-flex flex-wrap" id="featureImageContainer${featureCount}">
                //                         </div>
                //                     </div>
                //                 <div class="d-flex justify-content-between mb-5">
                //                     <button type="button" class="btn btn-outline-primary" onclick="addFeature()">Adauga caracteristica</button>
                //                     <button type="button" class="btn btn-outline-danger" onclick="removeFeature()">Sterge caracteristica</button>
                //                 </div>`;
                //     featuresContainer.append(markup)
                // }
                //
                // function removeFeature() {
                //     const div = document.querySelector('.form-feature-row--' + featureCount);
                //     div.remove();
                //     featureItems.splice(featureCount, 1);
                //     --featureCount;
                // }
            </script>
    @endpush


        @section('after_styles')
            <style>
                .image_block {
                    position: relative;
                    width: 320px;
                }
                .image_btn {
                    position: absolute;
                    top: 40px;
                    right: 0;
                    content: '';
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 30px;
                    height: 30px;
                    padding: 5px;
                    border-radius: 50%;
                    background-color: #c78c91;
                    color: #f6f2f2;
                    cursor: pointer;
                }
                .image_btn:hover {
                    background-color: #82565a;
                }
                .video_btn {
                    position: absolute;
                    top: 40px;
                    right: -40px;
                    content: '';
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 30px;
                    height: 30px;
                    padding: 5px;
                    border-radius: 50%;
                    background-color: #c78c91;
                    color: #f6f2f2;
                    cursor: pointer;
                }

                .main_view {
                    display: none;
                    position: absolute;
                    top: 10%;
                    left:10%;
                    width: 80vw;
                    height: 80vh;
                    z-index: 10;
                }

                .main_view img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;

                }

               .color_select_block .select2-selection__choice { background-color: #cdcde0 !important; }
            </style>

@endsection

