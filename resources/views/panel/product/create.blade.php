@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('product')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
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
                    <form action="{{route('product.store')}}" method="post" id="form" class="w-100" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="created_by" value="{{\Illuminate\Support\Facades\Auth::id()}}" >
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

                            </div>
                        </nav>

                        <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">
                                <div class="form_block mb-3">
                                    <div class="row mb-2">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="status">Status</label>
                                            <select class="custom-select form-control" name="status" id="status" >
                                                <option value="1" selected>Activat</option>
                                                <option value="0">Dezactivat</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="stock">Stock</label>
                                            <select class="custom-select form-control" name="stock" id="stock" >
                                                <option value="1" selected>In stock</option>
                                                <option value="2">To order</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="recommend">Recomendate</label>
                                            <select class="custom-select form-control" name="recommend" id="recommend" >
                                                <option value="0" selected>Nu pune resomandate</option>
                                                <option value="1">Pune recomandate</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="constructor_id">Tipul produse</label>
                                            <select class="custom-select form-control" name="constructor_id" id="constructor_id" >
                                                @foreach($constructors as $constructor)
                                                <option value="{{$constructor->id}}" >{{$constructor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
{{--                                        <div class="form-group col-lg-3 col-sm-6">--}}
{{--                                            <label for="" class="">Ordinea</label>--}}
{{--                                            <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{count($products)+1}}">--}}
{{--                                            @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                        </div>--}}



                                    </div>

                                    <div class="row">

                                        <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                                            <label for="industry">Industrie</label>
                                            <select class="custom-select select2 form-control" name="industry_id" id="industry" >
                                                @foreach($industries as $item)
                                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="category">Categorie</label>
                                            <select class="custom-select select2 form-control" name="category_id[]" multiple="multiple" id="category" >

                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="subcategory">Subcategorie</label>
                                            <select class="custom-select select2 form-control" name="subcategory_id[]" multiple="multiple" id="subcategory" >

                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="price" class="">Preț</label>
                                            <input type="number" class="form-control" name="price" id="price" placeholder="Preț" >
                                            @error('price')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                    </div>

                                </div>

                                @include("panel.components.forms.name",["title" => "Numele produsului", "placeholder" => "Numele produsului", "valueRo" => old('name_ro'), "valueRu" => old('name_ru'), "valueEn" => old('name_en')])
                                @include("panel.components.forms.description",["title" => "Descriere produsului", "placeholder" => "Descriere produsului", "valueRo" => old('description_ro'), "valueRu" =>old('description_ru'), "valueEn" => old('description_ro')])


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
                                            <p class="text-info">formats: jpeg, png, webp, mp4</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="mainImageContainer">

                                        </div>
                                    </div>

                                </div>
                                <div class="form_block row mb-3">
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="pdf">Upload catalog</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="pdf" class="form-control" id="pdf" >
                                                </div>
                                            </div>
                                            @error('pdf')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">formats: pdf</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 " >

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

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade " id="tec-info" role="tabpanel" aria-labelledby="tec-info-tab">
                                <div class="form_block row mb-3">
                                    <div class="row mb-2">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="code_1c">Cod produs</label>
                                            <input type="text" class="form-control" id="code_1c" name="code_1c" placeholder="Cod produs" value="{{old('code_1c')}}">
                                            @error('code_1c')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="material_ro">Material Ro</label>
                                            <input type="text" class="form-control" id="material_ro" name="material_ro" placeholder="Material" value="{{old('material_ro')}}">
                                            @error('material_ro')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="material_ru">Material Ru</label>
                                            <input type="text" class="form-control" id="material_ru" name="material_ru" placeholder="Material" value="{{old('material_ru')}}">
                                            @error('material_ru')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="material_en">Material En</label>
                                            <input type="text" class="form-control" id="material_en" name="material_en" placeholder="Material" value="{{old('material_en')}}">
                                            @error('material_en')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="weight">Weight, kg</label>
                                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight" value="{{old('weight')}}">
                                            @error('weight')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="dimension">Dimension</label>
                                            <input type="text" class="form-control" id="dimension" name="dimension" placeholder="000x000x000" value="{{old('dimension')}}">
                                            @error('dimension')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="brand">Brand</label>
                                            <select class="custom-select  form-control" name="brand" id="brand" >
                                                <option value="" >Alege brand</option>
                                                @foreach($brands as $item)
                                                    <option value="{{$item->name}}" >{{$item->name}}</option>
                                                @endforeach
                                            </select>

                                            @error('brand')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="power">Power, kW</label>
                                            <input type="text" class="form-control" id="power" name="power" placeholder="" value="{{old('power')}}">
                                            @error('power')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <div class="d-flex">
                                                <label for="colorProduct">Color</label>
                                                <div class="color_box" id="color_product_box" style="background-color: {{old('color')}}"></div>
                                            </div>
                                            <input type="text" class="form-control" onfocusout="colorProductHandler(this)"  id="colorProduct"  placeholder="Color">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_product_name_ro">Color name Ro</label>
                                            <input type="text" class="form-control" value="{{old('color_name_ro')}}" name="color_name_ro"  id="color_product_name_ro"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_product_name_ru">Color name Ru</label>
                                            <input type="text" class="form-control" value="{{old('color_name_ru')}}" name="color_name_ru"  id="color_product_name_ru"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_product_name_en">Color name En</label>
                                            <input type="text" class="form-control" value="{{old('color_name_en')}}" name="color_name_en"  id="color_product_name_en"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="volume">Volume</label>
                                            <input type="text" class="form-control" value="{{old('volume')}}" name="volume"  id="volume"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="capacity">Capacitate</label>
                                            <input type="text" class="form-control" value="{{old('capacity')}}" name="capacity"  id="capacity"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="voltage">Tensiune, V</label>
                                            <input type="text" class="form-control" value="{{old('voltage')}}" name="voltage"  id="voltage"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="rotation_speed">Viteză de rotație</label>
                                            <input type="text" class="form-control" value="{{old('rotation_speed')}}" name="rotation_speed"  id="rotation_speed"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="water_consumption">Consumul de apă, l/cycle</label>
                                            <input type="text" class="form-control" value="{{old('water_consumption')}}" name="water_consumption"  id="water_consumption"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="cycle_duration">Durata ciclului de lucru, sec</label>
                                            <input type="text" class="form-control" value="{{old('cycle_duration')}}" name="cycle_duration"  id="cycle_duration"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="maximum_temperature">Temperatura maximă, C</label>
                                            <input type="text" class="form-control" value="{{old('maximum_temperature')}}" name="maximum_temperature"  id="maximum_temperature"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="frequency">Frecvență, Hz</label>
                                            <input type="text" class="form-control" value="{{old('frequency')}}" name="frequency"  id="frequency"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="shelf_number">Numărul de rafturi</label>
                                            <input type="number" class="form-control" value="{{old('shelf_number')}}" name="shelf_number"  id="shelf_number"  >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="badge_top">Top 100</label>
                                            <select class="custom-select  form-control " name="badge_top" id="badge_top" >
                                                <option value="1" > Activat</option>
                                                <option value="0" selected>Dezactivat</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="badge_new">Produs nou</label>
                                            <select class="custom-select  form-control " name="badge_new" id="badge_new" >
                                                <option value="1" > Activat</option>
                                                <option value="0" selected>Dezactivat</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="badge_moldova">Produs în Moldova</label>
                                            <select class="custom-select  form-control " name="badge_moldova" id="badge_moldova" >
                                                <option value="1" > Activat</option>
                                                <option value="0" selected>Dezactivat</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form_block row mb-3" id="variants-container">
                                    <h2 class="text-bold fs-3 mb-4">Opțiuni de produs</h2>
                                    <div class="row mb-2">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="code0">Cod produs</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="code" id="code0" placeholder="Cod produs">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="weight0">Weight, kg</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="weight" id="weight0" placeholder="Weight" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="price0">Price</label>
                                            <input type="number" class="form-control" oninput="variantHandler(this)" data-name="price" id="price0" placeholder="Price">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="type0">Type</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="type" id="type0" placeholder="Type">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <div class="d-flex">
                                                <label for="color0">Color</label>
                                                <div class="color_box" id="color_box0" ></div>
                                            </div>
                                            <input type="text" class="form-control" onfocusout="colorHandler(this)" oninput="variantHandler(this)" data-name="color" id="color0"  placeholder="Color">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_ro0">Color name Ro</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="color_name_ro" id="color_name_ro0" placeholder="Color name Ro" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_ru0">Color name Ru</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="color_name_ru" id="color_name_ru0" placeholder="Color name Ru" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name_en0">Color name En</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="color_name_en" id="color_name_en0" placeholder="Color name En" >
                                        </div>

                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="model0">Model</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="model" id="model0" placeholder="Model">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="max_load0">Max loaded, kg</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="max_load" id="max_load0" placeholder="Max loaded">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="extension_length0">Lungime de extensie</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="extension_length" id="extension_length0" placeholder="Lungime de extensie">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="dimension0">Dimensiune</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this)" data-name="dimension" id="dimension0" placeholder="Dimensiune">
                                        </div>

{{--                                        <div class="form-group col-lg-3 col-sm-6">--}}
{{--                                            <label for="shelf_quantity0">Cantitatea poliței</label>--}}
{{--                                            <input type="number" class="form-control" oninput="variantHandler(this)"  id="shelf_quantity0" data-name="shelf_quantity_en" placeholder="">--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="d-flex justify-content-between mb-5">
                                        <button type="button" class="btn btn-outline-primary" onclick="addVariant()">Adauga optiune</button>
                                    </div>

                                </div>


                            </div>

                            <div class="tab-pane fade " id="add-info" role="tabpanel" aria-labelledby="add-info-tab">
                                <div class="form_block row mb-3 ">
                                    <h4 class="mb-3">Numele specificatii suplimentare-1</h4>
                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_ro0">
                                            <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
                                        </label>
                                        <input type="text" class="form-control ml-2"  id="title_ro0" oninput="specificationHandler(this)" data-name="title_ro" placeholder="Numele specificatii suplimentare Ro" >

                                    </div>
                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_ru0">
                                            <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">
                                        </label>
                                        <input type="text" class="form-control ml-2" id="title_ru0" oninput="specificationHandler(this)" data-name="title_ru" placeholder="Numele specificatii suplimentare Ru">

                                    </div>

                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_en0">
                                            <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">
                                        </label>
                                        <input type="text" class="form-control ml-2" id="title_en0" onchange="specificationHandler(this)" data-name="title_en" placeholder="Numele specificatii suplimentare En" >

                                    </div>
                                </div>

                                <div class="form_block row mb-3 ">
                                    <h4 class="mb-3">Descriere specificatii suplimentare-1</h4>
                                    <div class=" form-group mb-3 col-sm-4">
                                        <label for="description_ro0">
                                            Romana
                                        </label>
                                        <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="description_ro0" onchange="specificationHandler(this)" data-name="description_ro"  placeholder="Descriere specificatii suplimentare Ro" ></textarea>
                                    </div>
                                    <div class="form-group mb-3 col-sm-4">
                                        <label for="description_ru0">
                                            Russian
                                        </label>
                                        <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="description_ru0" onchange="specificationHandler(this)" data-name="description_ru" placeholder="Descriere specificatii suplimentare Ru" ></textarea>
                                    </div>
                                    <div class=" form-group mb-3 col-sm-4">
                                        <label for="description_en0">
                                            English
                                        </label>
                                        <textarea cols="6" rows="6" class="form-control ml-2 description_editor" id="description_en0" onchange="specificationHandler(this)" data-name="description_en" placeholder="Descriere specificatii suplimentare En" ></textarea>
                                    </div>
                                </div>


                                <div class="d-flex justify-content-between mb-5">
                                    <button type="button" class="btn btn-outline-primary" onclick="addSpecification()">Adauga specificatie</button>
                                </div>

                            </div>

                        </div>


                        <div class="form-group text-center">
                            <input type="submit" id="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        @endsection

        @push('script')

            <script >
                const selectImagePreview =  document.getElementById('previewImage');
                const selectImageMain =  document.getElementById('mainImages');
                const videoInstruction =  document.getElementById('videoInstruction');
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mainImageContainer = document.getElementById('mainImageContainer');
                const category = document.getElementById('category');
                const subcategory = document.getElementById('subcategory');
                const videoInstructionContainer = document.getElementById('videoInstructionContainer');
                const specificationItemsInput = document.getElementById('specificationItems')

                const variantItemsInput = document.getElementById('variantItems')
                const variantsContainer = document.getElementById('variants-container')
                const specificationsContainer = document.getElementById('add-info')



                const variantItems = [{
                    code:'',
                    color:'',
                    price:0,
                    weight:'',
                    color_name_ro:'',
                    color_name_ru:'',
                    color_name_en:'',
                    type:'',
                    max_load:'',
                    model:'',
                    extension_length:'',
                    dimension:'',

                }
                ]
                const specificationItems = [{
                    title_ro:'',
                    title_ru:'',
                    title_en:'',
                    description_ro:'',
                    description_ru:'',
                    description_en:'',
                }
                ]



                let variantCount = 0;
                let specCount = 0;



                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })


                ClassicEditor.create(document.querySelector('#description_ro0'), editorConfig)
                    .catch(error => {
                        console.error(error);
                    }).then(editor => {
                    editor.model.document.on('change:data', (evt, data) => {
                        specificationItems[0]['description_ro']=editor.getData();
                        specificationItemsInput.value = JSON.stringify(specificationItems)


                    });
                })
                    .catch(error => {
                        console.error('Editor initialization error.', error);
                    });
                ClassicEditor.create(document.querySelector('#description_ru0'), editorConfig)
                    .catch(error => {
                        console.error(error);
                    }).then(editor => {
                    editor.model.document.on('change:data', (evt, data) => {
                        specificationItems[0]['description_ru']=editor.getData();
                        specificationItemsInput.value = JSON.stringify(specificationItems)


                    });
                })
                    .catch(error => {
                        console.error('Editor initialization error.', error);
                    });
                ClassicEditor.create(document.querySelector('#description_en0'), editorConfig)
                    .catch(error => {
                        console.error(error);
                    }).then(editor => {
                    editor.model.document.on('change:data', (evt, data) => {
                        specificationItems[0]['description_en']=editor.getData();
                        specificationItemsInput.value = JSON.stringify(specificationItems)


                    });
                })
                    .catch(error => {
                        console.error('Editor initialization error.', error);
                    });


                function variantHandler(input, j=0) {
                    const name = input.dataset.name
                    variantItems[j][name]=input.value;
                    variantItemsInput.value = JSON.stringify(variantItems)
                }

                function specificationHandler(input, j=0) {
                    const name = input.dataset.name
                    specificationItems[j][name]=input.value;
                    specificationItemsInput.value = JSON.stringify(specificationItems)
                }



                function colorHandler(el, index) {
                    document.querySelector('#color_box'+index).style.backgroundColor = el.value
                }

                function selectCategory() {
                    subcategory.innerHTML = null
                    let industryId = $('#industry').find(":selected").val();
                    console.log(industryId)

                    let industries = {!! json_encode($industriesAll) !!};

                    let IndustryList = industries.find(item => item.id == Number(industryId))

                    const CategoryList = IndustryList.categories

                    if(CategoryList) {
                        let options = "";
                        //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                        CategoryList.forEach(category=> {

                            options += `<option value="${category.id}" >${category.name_ro}</option>`;
                        })

                        category.innerHTML = options;

                    }

                    let categories = {!! json_encode($categoriesAll) !!};

                    let categoryList = categories.find(item => item.industry_id == Number(industryId))

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

                    let categories = {!! json_encode($categoriesAll) !!};

                    let categoryList = categories.find(item => item.id == Number(categoryId))
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

                selectCategory()
                // selectSubcategory()

                $('#industry').on('change', event=>{
                    selectCategory()

                })
                $('#category').on('change', event=>{
                    selectSubcategory()

                })

                mainImageContainer.addEventListener('mousedown', function(event) {
                    var mousePosition;
                    var offset = [0,0];
                    var isDown = false;
                    let startElement = null;
                    let endElement = null;

                    const el = event.target;
                    // el.style.position = "absolute";
                    // el.style.left = "0px";
                    // el.style.top = "0px";

                    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

                    function dragMouseDown(e) {
                        // e = e || window.event;
                        e.preventDefault();

                        // get the mouse cursor position at startup:
                        pos3 = e.clientX;
                        pos4 = e.clientY;

                        startElement = e.target;


                        isDown = true;
                        offset = [
                            el.offsetLeft - e.clientX,
                            el.offsetTop - e.clientY
                        ];

                        mainImageContainer.onmouseup = closeDragElement;
                        // call a function whenever the cursor moves:
                        mainImageContainer.onmousemove = elementDrag;
                    }
                    dragMouseDown(event)

                    function elementDrag(e) {
                        // e = e || window.event;

                        e.preventDefault();
                        if (isDown) {
                            mousePosition = {

                                x : event.clientX,
                                y : event.clientY

                            };
                            el.style.left = (mousePosition.x + offset[0]) + 'px';
                            el.style.top  = (mousePosition.y + offset[1]) + 'px';
                        }
                        // calculate the new cursor position:
                        // pos1 = pos3 - e.clientX;
                        // pos2 = pos4 - e.clientY;
                        // pos3 = e.clientX;
                        // pos4 = e.clientY;
                        //
                        // // set the element's new position:
                        // el.style.top = (el.offsetTop - pos2) + "px";
                        // el.style.left = (el.offsetLeft - pos1) + "px";
                    }

                    function closeDragElement(e) {
                        /* stop moving when mouse button is released:*/
                        // const endElement = e.currentTarget
                        // jQuery(el).detach().appendTo(endElement)
                        // el.style.position = "static";
                        // endElement.style.position = "static";
                        endElement = e.target;
                        console.log('endElement', endElement.value)

                        console.log('startElement', startElement.value)


                        // endElement.src = startElement.src
                        const src = startElement.src

                        startElement.src = endElement.src
                        e.target.src = src

                        isDown = false;
                        // const top = el.style.top.replace('px', '')
                        // const left = el.style.left.replace('px', '')
                        // console.log(top)
                        // console.log(left)
                        // console.log(el.parentElement.clientHeight)
                        // console.log(el.parentElement.clientWidth)

                        // items[j]['percent_x'] =calcPercentX
                        mainImageContainer.onmouseup = null;
                        mainImageContainer.onmousemove = null;
                    }

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
                    // console.log(files)
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
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
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Main product image";
                                image.classList.add('added_main_image');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mainImageContainer.append(image);
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

                function addVariant() {
                    variantItems.push({
                        id:0,
                        code:'',
                        color:'',
                        price:0,
                        weight:'',
                        type:'',
                        max_load:'',
                        color_name:'',
                        model:'',
                        extension_length:'',

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
                                              <div class="d-flex">
                                                <label for="color${variantCount}">Color</label>
                                                <div class="color_box" id="color_box${variantCount}"></div>
                                            </div>
                                            <input type="text" class="form-control"  onfocusout="colorHandler(this, variantCount)" oninput="variantHandler(this, variantCount)" data-name="color" id="color${variantCount}"  placeholder="Color">
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="color_name${variantCount}">Color name</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, ${variantCount})"  data-name="color_name" id="color_name${variantCount}" placeholder="Color name" >
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
                                            <label for="type${variantCount}">Type</label>
                                            <input type="text" class="form-control" oninput="variantHandler(this, variantCount)" data-name="type" id="type${variantCount}" placeholder="Type">
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
                        title_ro:'',
                        title_ru:'',
                        title_en:'',
                        description_ro:'',
                        description_ru:'',
                        description_en:'',
                    })
                    const markup = document.createElement('div');
                    markup.classList = 'form-row--' + ++specCount;
                    markup.innerHTML = `<div class="form_block row mb-3 ">
                                    <h4 class="mb-3">Numele specificatii suplimentare-${specCount+1}</h4>
                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_ro${specCount}">
                                            <img src="/images/flags/ro.png" width="20px" alt="Romana">
                                        </label>
                                        <input type="text" class="form-control ml-2"  id="title_ro${specCount}" oninput="specificationHandler(this, specCount)" data-name="title_ro" placeholder="Numele specificatii suplimentare Ro" >

                                    </div>
                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_ru${specCount}">
                                            <img src="/images/flags/ru.png" width="20px" alt="Russian">
                                        </label>
                                        <input type="text" class="form-control ml-2" id="title_ru${specCount}" oninput="specificationHandler(this, specCount)" data-name="title_ru" placeholder="Numele specificatii suplimentare Ru">

                                    </div>

                                    <div class="d-flex form-group col-sm-4">
                                        <label for="title_en${specCount}">
                                            <img src="/images/flags/gb.png" width="20px" alt="English">
                                        </label>
                                        <input type="text" class="form-control ml-2" id="title_en${specCount}" onchange="specificationHandler(this, specCount)" data-name="title_en" placeholder="Numele specificatii suplimentare En" >

                                    </div>
                                </div>

                                <div class="form_block row mb-3 ">
                                    <h4 class="mb-3">Descriere specificatii suplimentare-${specCount+1}</h4>
                                    <div class=" form-group mb-3 col-sm-4">
                                        <label for="description_ro${specCount}">
                                            Romana
                                        </label>
                                        <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="description_ro${specCount}" onchange="specificationHandler(this, specCount)" data-name="description_ro" placeholder="Descriere specificatii suplimentare Ro" ></textarea>
                                    </div>
                                    <div class="form-group mb-3 col-sm-4">
                                        <label for="description_ru${specCount}">
                                            Russian
                                        </label>
                                        <textarea cols="6" rows="6" class="form-control ml-2 description_editor"  id="description_ru${specCount}" onchange="specificationHandler(this, specCount)" data-name="description_ru" placeholder="Descriere specificatii suplimentare Ru" ></textarea>
                                    </div>
                                    <div class=" form-group mb-3 col-sm-4">
                                        <label for="description_en${specCount}">
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


            </script>
    @endpush


