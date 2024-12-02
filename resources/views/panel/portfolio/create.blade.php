@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('portfolio')}}" class="btn btn-secondary" >
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
                    <form action="{{route('portfolio.store')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="created_by" value="{{\Illuminate\Support\Facades\Auth::id()}}" >

                        <nav class="w-100">
                            <div class="nav nav-tabs" id="portfolio-tab" role="tablist">
                                <a class="nav-item nav-link active fs-5" id="common-tab" data-toggle="tab" href="#common" role="tab" aria-controls="common" aria-selected="true">
                                    Common
                                </a>
                                <a class="nav-item nav-link fs-5" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
                                    Images
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
                                            <label for="" class="">Data</label>
                                            <input type="text" class="form-control datepicker" name="date" id="portfolioDate"  autocomplete="off" data-inputmask-alias="dd.mm.yyyy" placeholder="dd.mm.yyyy" data-provide="datepicker">
                                            @error('date')<p class="text-danger"> {{$message}}</p>@enderror
{{--                                            <label for="" class="">Ordinea</label>--}}
{{--                                            <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{count($portfolios)+1}}">--}}
{{--                                            @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror--}}
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                                            <label for="industry">Industrie</label>
                                            <select class="custom-select select2 form-control" name="industry_id" id="industry" >
                                                @foreach($industries as $item)
                                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="category_id">Categorie</label>
                                            <select class="custom-select select2 form-control" name="category_id" id="category" >
                                                @foreach($portfolioCategories as $item)
                                                    <option value="{{$item->id}}" >{{$item->name_ro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                @include("panel.components.forms.name",["title" => "Numele portfolio", "placeholder" => "Numele portfolio", "valueRo" => old('name_ro'), "valueRu" => old('name_ru'), "valueEn" => old('name_en')])
                                @include("panel.components.forms.descriptionEditor2",["title" => "Descriere portfolio", "placeholder" => "Descriere portfolio", "valueRo" => old('description_ro'), "valueRu" =>old('description_ru'), "valueEn" => old('description_ro')])


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
                                            <p class="text-info">min size: 220x220</p>
                                            <p class="text-info">ratio: 1 : 1</p>
                                            <p class="text-info">formats: jpeg, png, webp</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="mainImage">Upload main image</label>
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
                                            <label  class="col-form-label" for="mainImage">Upload slider images and video</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="images[]" class="form-control" id="slider" multiple="multiple" >
                                                </div>
                                            </div>
                                            @error('images')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">min size: 560x400</p>
                                            <p class="text-info">ratio: 1,4 : 1</p>
                                            <p class="text-info">formats: jpeg, png, webp, mp4</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="mainSliderContainer">

                                        </div>
                                    </div>
                                </div>

                            </div>





                        </div>


                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>

            </div><!-- /.container-fluid -->
        </section>

            <style>
                tbody tr {
                    height:auto;
                }
            </style>
        <!-- /.content -->
        @endsection

        @push('script')
            <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
            <script>
                const selectImagePreview =  document.getElementById('previewImage');
                const selectImageMain =  document.getElementById('mainImage');
                const selectSlider =  document.getElementById('slider');
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mainImageContainer = document.getElementById('mainImageContainer');
                const mainSliderContainer = document.getElementById('mainSliderContainer');

                // const category = document.getElementById('category');

                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
                document.addEventListener('DOMContentLoaded', function() {

                    const inputmask_options =
                        {
                            mask: "99.99.9999",
                            alias: "date",
                            insertMode: false
                        }

                    $( function() {
                        $( "#portfolioDate" ).datepicker({
                            dateFormat: "dd.mm.yy",
                            alias: "date",
                            insertMode: false,
                            changeMonth: true,
                            changeYear: true,
                            yearRange: "1990:+10",
                        }).datepicker().inputmask("99.99.9999", inputmask_options);
                    } );
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
                                image.alt = "Preview portfolio image";
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
                                image.style.maxWidth = "500px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mainImageContainer.append(image);
                            }
                        }
                    }
                }



                selectSlider.onchange = evt => {
                    const imgs = document.querySelectorAll('.added_slider_images')
                    if (imgs) {
                        imgs.forEach(img => {
                            img.remove()
                        })

                    }
                    const files = selectSlider.files

                    let imagesArray = []

                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
                            imagesArray.push(files[i])
                            if (files[i]) {
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Main portfolio image";
                                image.classList.add('added_slider_images');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mainSliderContainer.append(image);
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
                                video.classList.add('added_slider_images');
                                mainSliderContainer.append(video);
                            }
                        }

                    }
                }

            </script>
    @endpush
