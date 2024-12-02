@extends('layouts.admin')
@php
    $industryId = request()->get('industry');
    $categoryId = request()->get('category');
    $subcategoryId = request()->get('subcategory');

@endphp
@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('type', ['industry'=>$industryId, 'category'=>$categoryId, 'subcategory'=>$subcategoryId])}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$type->title_ro}}</h1>
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
                    <form action="{{route('type.update', $type->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active fs-5" id="common-tab" data-toggle="tab" href="#common" role="tab" aria-controls="common" aria-selected="true">
                                    {{trans('panel.common')}}
                                </a>
                                <a class="nav-item nav-link fs-5" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
                                    {{trans('panel.images')}}
                                </a>
                                <a class="nav-item nav-link fs-5" id="specification-tab" data-toggle="tab" href="#specification" role="tab" aria-controls="specification" aria-selected="false">
                                    {{trans('panel.specification')}}
                                </a>
                            </div>
                        </nav>

                        <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">
                                <div class="form_block row mb-3">
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="status">{{trans('panel.status')}}</label>
                                        <select class="custom-select form-control" name="status" id="status" >
                                            <option value="1" {{$type->status == 1 ? 'selected' : ''}}>{{trans('panel.status_active')}}</option>
                                            <option value="0" {{$type->status == 0 ? 'selected' : ''}}>{{trans('panel.status_disabled')}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                                        <label for="industry">{{trans('panel.industry')}}</label>
                                        <select class="custom-select select2 form-control" name="industry_id" id="industry" >
                                            @foreach($industries as $item)
                                                <option value="{{$item->id}}" {{$type->industry_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="category">{{trans('panel.category')}}</label>
                                        <select class="custom-select select2 form-control" name="category_id" id="category" >
                                            @foreach($categoriesOld as $item)
                                                <option  {{$type->category_id == $item->id ? 'selected' : ''}} value="{{$item->id}}" >{{$item->name_ro}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="subcategory">{{trans('panel.subcategory')}}</label>
                                        <select class="custom-select select2 form-control" name="subcategory_id" id="subcategory" >
                                            @foreach($subcategoriesOld as $item)
                                                <option  {{$type->subcategory_id == $item->id ? 'selected' : ''}} value="{{$item->id}}" >{{$item->name_ro}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="" class="">{{trans('panel.sort')}}</label>
                                        <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{$type->sort_order}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                </div>


                                @include("panel.components.forms.title",["title" => trans('panel.type_subcategory_name'), "placeholder" => trans('panel.type_subcategory_name'), "valueRo" => $type->title_ro, "valueRu" => $type->title_ru, "valueEn" => $type->title_en])
                                @include("panel.components.forms.description",["title" => trans('panel.type_subcategory_description'), "placeholder" => trans('panel.type_subcategory_description'), "valueRo" =>$type->description_ro, "valueRu" =>$type->description_ru, "valueEn" => $type->description_en])



                            </div>
                            <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form_block row mb-3 ">

                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="previewImage">{{trans('panel.upload_preview_image')}}</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="image_preview" class="form-control" id="previewImage" >
                                                </div>
                                            </div>
                                            @error('image_preview')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">min size: 150*180</p>
                                            <p class="text-info">ratio: 1 : 1,2</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                            @if($type->image_preview)
                                                <a href="{{url('storage/'.$type->image_preview)}}" data-fancybox >
                                                    <img id="image_preview" src="{{url('storage/'.$type->image_preview)}}" alt="Preview subcategory image" class="added_preview_image " onclick="" style="width: 300px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                                <div class="form_block  mb-3">

                                    <div class="row mb-3">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="length" class="">{{trans('labels.length')}}, mm</label>
                                            <input type="text" id="length" class="form-control" name="length" value="{{$type->length}}" placeholder="Lungime" >
                                            @error('length')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="depth" class="">{{trans('labels.depth')}}, mm</label>
                                            <input type="text" id="depth" class="form-control" name="depth" value="{{$type->depth}}" placeholder="Adîncime" >
                                            @error('depth')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="height" class="">{{trans('labels.height')}}, mm</label>
                                            <input type="text" id="height" class="form-control" name="height" value="{{$type->height}}" placeholder="Înălțime" >
                                            @error('height')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="perforation_pitch" class="">{{trans('labels.perforation_pitch')}}</label>
                                            <input type="text" id="perforation_pitch" class="form-control" name="perforation_pitch" value="{{$type->perforation_pitch}}" placeholder="{{trans('labels.perforation_pitch')}}" >
                                            @error('perforation_pitch')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="inclination_angle" class="">{{trans('labels.inclination_angle')}}</label>
                                            <input type="text" id="inclination_angle" class="form-control" name="inclination_angle" value="{{$type->inclination_angle}}" placeholder="Unghi de înclinare" >
                                            @error('inclination_angle')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="shelf_height" class="">{{trans('labels.shelf_height')}}</label>
                                            <input type="text" id="shelf_height" class="form-control" name="shelf_height" value="{{$type->shelf_height}}" placeholder="Înălțimea nivelului raftului de bază" >
                                            @error('shelf_height')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="available_basins" class="">{{trans('labels.available_basins')}}</label>
                                            <input type="text" id="available_basins" class="form-control" name="available_basins" value="{{$type->available_basins}}" placeholder="Bazine disponibile" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="electrical_parameters" class="">{{trans('labels.electrical_parameters')}}</label>
                                            <input type="text" id="electrical_parameters" class="form-control" name="electrical_parameters" value="{{$type->electrical_parameters}}" placeholder="Parametri electrici" >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="available_conveyors" class="">{{trans('labels.available_conveyors')}}</label>
                                            <input type="text" id="available_conveyors" class="form-control" name="available_conveyors" value="{{$type->available_conveyors}}" placeholder="Transportoare disponibile" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="protection_class" class="">{{trans('labels.protection_class')}}</label>
                                            <input type="text" id="protection_class" class="form-control" name="protection_class" value="{{$type->protection_class}}" placeholder="Clasa de protecție IP" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="certificates" class="">{{trans('labels.certificates')}}</label>
                                            <input type="text" id="certificates" class="form-control" name="certificates" value="{{$type->certificates}}" placeholder="Certificate" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="processor" class="">{{trans('labels.processor')}}</label>
                                            <input type="text" id="processor" class="form-control" name="processor" value="{{$type->processor}}" placeholder="Procesor" >
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="operating_system" class="">{{trans('labels.operating_system')}}</label>
                                            <input type="text" id="operating_system" class="form-control" name="operating_system"  value="{{$type->operating_system}}" placeholder="Sistem de operare" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="software" class="">{{trans('labels.software')}}</label>
                                            <input type="text" id="software" class="form-control" name="software"  value="{{$type->software}}" placeholder="Software" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="shelves_depth" class="">{{trans('labels.shelves_depth')}}</label>
                                            <input type="text" id="shelves_depth" class="form-control" name="shelves_depth" value="{{$type->shelves_depth}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="temperature_class" class="">{{trans('labels.temperature_class')}}</label>
                                            <input type="text" id="temperature_class" class="form-control" name="temperature_class" value="{{$type->temperature_class}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="cooling_system" class="">{{trans('labels.cooling_system')}}</label>
                                            <input type="text" id="cooling_system" class="form-control" name="cooling_system" value="{{$type->cooling_system}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="refrigerant" class="">{{trans('labels.refrigerant')}}</label>
                                            <input type="text" id="refrigerant" class="form-control" name="refrigerant" value="{{$type->refrigerant}}" placeholder="" >
                                        </div>

                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="maximum_lifting_height" class="">{{trans('labels.maximum_lifting_height')}} </label>
                                            <input type="text" id="maximum_lifting_height" class="form-control" name="maximum_lifting_height" value="{{$type->maximum_lifting_height}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="battery_type" class="">{{trans('labels.battery_type')}}</label>
                                            <input type="text" id="battery_type" class="form-control" name="battery_type" value="{{$type->battery_type}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="platform_area" class="">{{trans('labels.platform_area')}}</label>
                                            <input type="text" id="platform_area" class="form-control" name="platform_area" value="{{$type->platform_area}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="maximum_load" class="">{{trans('labels.maximum_load')}}</label>
                                            <input type="text" id="maximum_load" class="form-control" name="maximum_load" value="{{$type->maximum_load}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="fork_width" class="">{{trans('labels.fork_width')}}</label>
                                            <input type="text" id="fork_width" class="form-control" name="fork_width" value="{{$type->fork_width}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="fork_length" class="">{{trans('labels.fork_length')}}</label>
                                            <input type="text" id="fork_length" class="form-control" name="fork_length" value="{{$type->fork_length}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="battery_capacity" class="">{{trans('labels.battery_capacity')}}</label>
                                            <input type="text" id="battery_capacity" class="form-control" name="battery_capacity" value="{{$type->battery_capacity}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="weight" class="">{{trans('labels.weight')}}</label>
                                            <input type="text" id="weight" class="form-control" name="weight" value="{{$type->weight}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="volume" class="">{{trans('labels.volume')}}</label>
                                            <input type="text" id="volume" class="form-control" name="volume" value="{{$type->volume}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="maximum_height" class="">{{trans('labels.maximum_height')}}</label>
                                            <input type="text" id="maximum_height" class="form-control" name="maximum_height" value="{{$type->maximum_height}}" placeholder="" >
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="minimum_height" class="">{{trans('labels.minimum_height')}}</label>
                                            <input type="text" id="minimum_height" class="form-control" name="minimum_height" value="{{$type->minimum_height}}" placeholder="" >
                                        </div>


                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="coating_ro" class="">{{trans('labels.coating')}} Ro</label>
                                            <input type="text" id="coating_ro" class="form-control" name="coating_ro" value="{{$type->coating_ro}}" placeholder="" >
                                            @error('coating_ro')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="coating_ru" class="">{{trans('labels.coating')}} Ru</label>
                                            <input type="text" id="coating_ru" class="form-control" name="coating_ru" value="{{$type->coating_ru}}" placeholder="" >
                                            @error('coating_ru')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="coating_en" class="">{{trans('labels.coating')}} En</label>
                                            <input type="text" id="coating_en" class="form-control" name="coating_en" value="{{$type->coating_en}}" placeholder="" >
                                            @error('coating_en')<p class="text-danger"> {{$message}}</p>@enderror
                                        </div>
                                    </div>

                                </div>


                                @include("panel.components.forms.editorVariable",["title" => trans('labels.components'), "placeholder" => "", "name"=>'components', "valueRo" => $type->components_ro, "valueRu" =>$type->components_ru, "valueEn" => $type->components_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.install'), "placeholder" => "", "name"=>'install', "valueRo" => $type->install_ro, "valueRu" =>$type->install_ru, "valueEn" => $type->install_en])

                                @include("panel.components.forms.editorVariable",["title" => trans('labels.material'), "placeholder" => "", "name"=>'material', "valueRo" => $type->material_ro, "valueRu" =>$type->material_ru, "valueEn" => $type->material_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.type'), "placeholder" => "", "name"=>'type', "valueRo" => $type->type_ro, "valueRu" =>$type->type_ru, "valueEn" => $type->type_en])

                                @include("panel.components.forms.editorVariable",["title" => trans('labels.panel_type'), "placeholder" => "", "name"=>'panel_type', "valueRo" => $type->panel_type_ro, "valueRu" =>$type->panel_type_ru, "valueEn" => $type->panel_type_en])

                                @include("panel.components.forms.editorVariable",["title" => trans('labels.construction_principle'), "placeholder" => "", "name"=>'construction_principle', "valueRo" => $type->construction_principle_ro, "valueRu" =>$type->construction_principle_ru, "valueEn" => $type->construction_principle_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.electricity_connection'), "placeholder" => "", "name"=>'electricity_connection', "valueRo" => $type->electricity_connection_ro, "valueRu" =>$type->electricity_connection_ru, "valueEn" => $type->electricity_connection_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.working_places'), "placeholder" => "", "name"=>'working_places', "valueRo" => $type->working_places_ro, "valueRu" =>$type->working_places_ru, "valueEn" => $type->working_places_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.warranty'), "placeholder" => "", "name"=>'warranty', "valueRo" => $type->warranty_ro, "valueRu" =>$type->warranty_ru, "valueEn" => $type->warranty_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.touch_screen'), "placeholder" => "", "name"=>'touch_screen', "valueRo" => $type->touch_screen_ro, "valueRu" =>$type->touch_screen_ru, "valueEn" => $type->touch_screen_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.interactive_support'), "placeholder" => "", "name"=>'interactive_support', "valueRo" => $type->interactive_support_ro, "valueRu" =>$type->interactive_support_ru, "valueEn" => $type->interactive_support_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.integration_options'), "placeholder" => "", "name"=>'integration_options', "valueRo" => $type->integration_options_ro, "valueRu" =>$type->integration_options_ru, "valueEn" => $type->integration_options_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.barcode_scanner'), "placeholder" => "", "name"=>'barcode_scanner', "valueRo" => $type->barcode_scanner_ro, "valueRu" =>$type->barcode_scanner_ru, "valueEn" => $type->barcode_scanner_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.integrated_accessories'), "placeholder" => "", "name"=>'integrated_accessories', "valueRo" => $type->integrated_accessories_ro, "valueRu" =>$type->integrated_accessories_ru, "valueEn" => $type->integrated_accessories_en])

                                @include("panel.components.forms.editorVariable",["title" => trans('labels.front_type'), "placeholder" => "", "name"=>'front_type', "valueRo" => $type->front_type_ro, "valueRu" =>$type->front_type_ru, "valueEn" => $type->front_type_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.energy_efficiency_class'), "placeholder" => "", "name"=>'energy_efficiency_class', "valueRo" => $type->energy_efficiency_class_ro, "valueRu" =>$type->energy_efficiency_class_ru, "valueEn" => $type->energy_efficiency_class_en])
                                @include("panel.components.forms.editorVariable",["title" => trans('labels.energy_efficient_features'), "placeholder" => "", "name"=>'energy_efficient_features', "valueRo" => $type->energy_efficient_features_ro, "valueRu" =>$type->energy_efficient_features_ru, "valueEn" => $type->energy_efficient_features_en])

                                @include("panel.components.forms.editorVariable",["title" =>trans('labels.wheel'), "placeholder" => trans('labels.wheel'), "name"=>'wheel', "valueRo" => $type->wheel_ro, "valueRu" =>$type->wheel_ru, "valueEn" => $type->wheel_en])



                            </div>



                        </div>

                        <div class="form-group text-center d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" id="saveBtn" name="update" value="{{trans('panel.save')}}">
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
                const previewImageContainer = document.getElementById('previewImageContainer');
                const category = document.getElementById('category');
                const subcategory = document.getElementById('subcategory');

                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                function selectCategory() {
                    let industryId = $('#industry').find(":selected").val();

                    let industries = {!! json_encode($industriesAll) !!};

                    let IndustryList = industries.find(item => item.id === Number(industryId))
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

                    let categoryList = categories.find(item => Number(item.industry_id) === Number(industryId))

                    const subCategoryList = categoryList.subcategories

                    if(subCategoryList) {
                        let options = "";
                        //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                        subCategoryList.forEach(category=> {
                            options += `<option value="${category.id}" >${category.name_ro}</option>`;
                        })

                        subcategory.innerHTML = options;
                    }

                }
                function selectSubcategory() {
                    let categoryId = $('#category').find(":selected").val();

                    let categories = {!! json_encode($categoriesAll) !!};

                    let categoryList = categories.find(item => Number(item.id) === Number(categoryId))
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

                // selectCategory()


                $('#industry').on('change', event=>{
                    selectCategory()

                })
                $('#category').on('change', event=>{
                    selectSubcategory()

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
                                image.alt = "Preview subcategory image";
                                image.classList.add('added_preview_image');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                previewImageContainer.append(image);
                            }
                        }
                    }
                }

                document.getElementById('saveBtn').addEventListener('click', ()=>{
                    document.querySelector('.spinner-border').style.display = 'block';
                })

            </script>
    @endpush

