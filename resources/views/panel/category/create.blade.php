@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('category')}}" class="btn btn-secondary" >
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
                <div class="row ">
                    <form action="{{route('category.store')}}" method="post" class="w-100" enctype="multipart/form-data">
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
                                    <div class="form-group col-sm-3">
                                        <label for="status">{{trans('panel.status')}}</label>
                                        <select class="custom-select form-control" name="status" id="status" >
                                            <option value="1" selected>{{trans('panel.status_active')}}</option>
                                            <option value="0">{{trans('panel.status_disabled')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="" class="">{{trans('panel.sort')}}</label>
                                        <input type="number" class="form-control" name="sort_order" placeholder="{{trans('panel.sort')}}" value="{{count($categories)+1}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="industry">{{trans('panel.industry')}}</label>
                                        <select class="custom-select form-control" name="industry_id" id="industry" >
                                            @foreach($industries as $item)
                                            <option value="{{$item->id}}" >{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="tags_ro">Tags Ro</label>
                                        <select class="custom-select form-control category_tags_select" name="tags_ro[]" id="tags_ro" multiple="multiple">
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="tags_ru">Tags Ru</label>
                                        <select class="custom-select form-control category_tags_select" name="tags_ru[]" id="tags_ru" multiple="multiple">
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="tags_en">Tags En</label>
                                        <select class="custom-select form-control category_tags_select" name="tags_en[]" id="tags_en" multiple="multiple">
                                        </select>
                                    </div>
                                </div>

                                @include("panel.components.forms.name",["title" => trans('panel.category_name'), "placeholder" => trans('panel.category_name'), "valueRo" => old('name_ro'), "valueRu" => old('name_ru'), "valueEn" => old('name_en')])
                                @include("panel.components.forms.description",["title" => trans('panel.category_description'), "placeholder" => trans('panel.category_description'), "valueRo" => old('description_ro'), "valueRu" =>old('description_ru'), "valueEn" => old('description_ro')])


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
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mainImageContainer = document.getElementById('mainImageContainer');

                $(".category_tags_select").select2({
                    tags: true,
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
                                image.alt = "Preview category image";
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
                                image.alt = "Main category image";
                                image.classList.add('added_main_image');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mainImageContainer.append(image);
                            }
                        }
                    }
                }

            </script>
    @endpush
