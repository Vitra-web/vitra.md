@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('subcategory')}}" class="btn btn-secondary" >
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
                    <form action="{{route('subcategory.store')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="created_by" value="{{\Illuminate\Support\Facades\Auth::id()}}" >

                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active fs-5" id="common-tab" data-toggle="tab" href="#common" role="tab" aria-controls="common" aria-selected="true">
                                    {{trans('panel.common')}}
                                </a>
                                <a class="nav-item nav-link fs-5" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
                                    {{trans('panel.images')}}
                                </a>

                            </div>
                        </nav>

                        <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">
                                <div class="form_block row mb-3">
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="status">{{trans('panel.status')}}</label>
                                        <select class="custom-select form-control" name="status" id="status" >
                                            <option value="1" selected>{{trans('panel.status_active')}}</option>
                                            <option value="0">{{trans('panel.status_disabled')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="" class="">{{trans('panel.sort')}}</label>
                                        <input type="number" class="form-control" name="sort_order" placeholder="{{trans('panel.sort')}}" value="{{count($subcategories)+1}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                    <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                                        <label for="industry">{{trans('panel.industry')}}</label>
                                        <select class="custom-select select2 form-control" name="industry_id" id="industry" >
                                            @foreach($industries as $item)
                                            <option value="{{$item->id}}" >{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="industry">{{trans('panel.category')}}</label>
                                        <select class="custom-select select2 form-control" name="category_id" id="category" >
{{--                                            @foreach($categories as $item)--}}
{{--                                                <option value="{{$item->id}}" >{{$item->name_ro}}</option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>

                                @include("panel.components.forms.name",["title" => "Numele subcategoriei", "placeholder" => "Numele subcategoriei", "valueRo" => old('name_ro'), "valueRu" => old('name_ru'), "valueEn" => old('name_en')])
                                @include("panel.components.forms.description",["title" => "Descriere subcategoriei", "placeholder" => "Descriere subcategoriei", "valueRo" => old('description_ro'), "valueRu" =>old('description_ru'), "valueEn" => old('description_ro')])



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

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="mainImage">{{trans('panel.upload_main_image')}}</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="image_main" class="form-control" id="mainImage" >
                                                </div>
                                            </div>
                                            @error('image_main')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">min size: 1380*500</p>
                                            <p class="text-info">ratio: 2,7 : 1</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="mainImageContainer">

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="secondImage">{{trans('panel.upload_second_image')}}</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="image_second" class="form-control" id="secondImage" >
                                                </div>
                                            </div>
                                            @error('image_second')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">min size: 800*600</p>
                                            <p class="text-info">ratio: 1,3 : 1</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="secondImageContainer">

                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>


                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="{{trans('panel.save')}}">
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
                const selectImageMain =  document.getElementById('mainImage');
                const selectImageSecond =  document.getElementById('secondImage');
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mainImageContainer = document.getElementById('mainImageContainer');
                const secondImageContainer = document.getElementById('secondImageContainer');
                const category = document.getElementById('category');

                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                function selectCompany() {
                    let industryId = $('#industry').find(":selected").val();
                    console.log(industryId)
                    let industries = {!! json_encode($industriesAll) !!};
                    console.log(industries);
                    let IndustryList = industries.find(item => item.id === Number(industryId))
                    const CategoryList = IndustryList.categories
                    console.log(CategoryList)
                    if(CategoryList) {
                        let options = "";
                        //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                        CategoryList.forEach(category=> {
                            console.log(category.id)
                            options += `<option value="${category.id}" >${category.name_ro}</option>`;
                        })

                        category.innerHTML = options;

                    }
                }
                selectCompany()


                $('#industry').on('change', event=>{
                    selectCompany()

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
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
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
                                image.alt = "Main subcategory image";
                                image.classList.add('added_main_image');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mainImageContainer.append(image);
                            }
                        }
                    }
                }

                selectImageSecond.onchange = evt => {
                    const imgs = document.querySelectorAll('.added_second_image')
                    if (imgs) {
                        imgs.forEach(img => {
                            img.remove()
                        })

                    }
                    const files = selectImageSecond.files
                    let imagesArray = []

                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
                            imagesArray.push(files[i])
                            if (files[i]) {
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Second subcategory image";
                                image.classList.add('added_second_image');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                secondImageContainer.append(image);
                            }
                        }
                    }
                }


            </script>
    @endpush
