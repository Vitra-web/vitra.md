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
                        <h1 class="m-0">{{$portfolio->name_ro}}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="main_view" onclick="this.style.display ='none'">
                    <img src="" id="main" alt="IMAGE">
                </div>
                <div class="form_container">
                    <form action="{{route('portfolio.update', $portfolio->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')


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
                                <div class="form_block row mb-3">
                                    <div class="row mb-2">
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="status">Status</label>
                                        <select class="custom-select form-control " name="status" id="status" >
                                            <option value="1" {{$portfolio->status == 1 ? 'selected' : ''}}>Activat</option>
                                            <option value="0" {{$portfolio->status == 0 ? 'selected' : ''}}>Dezactivat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="" class="">Data</label>



                                        <input type="text" class="form-control datepicker" name="date" autocomplete="off" id="portfolioDate" value="{{date("d.m.Y", strtotime($portfolio->date))}}" data-inputmask-alias="dd.mm.yyyy" placeholder="dd.mm.yyyy" data-provide="datepicker">
                                        @error('date')<p class="text-danger"> {{$message}}</p>@enderror
{{--                                        <label for="" class="">Ordinea</label>--}}
{{--                                        <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{$portfolio->sort_order}}">--}}
{{--                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror--}}
                                    </div>
                                        <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                                            <label for="industry">Industrie</label>
                                            <select class="custom-select select2 form-control" name="industry_id" id="industry" >
                                                @foreach($industries as $item)
                                                    <option {{$portfolio->industry_id == $item->id ? 'selected' : ''}} value="{{$item->id}}" >{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="category">Categorie</label>
                                            <select class="custom-select select2 form-control" name="category_id" id="category" >
                                                @foreach($portfolioCategories as $item)
                                                    <option  {{$portfolio->category_id == $item->id ? 'selected' : ''}} value="{{$item->id}}" >{{$item->name_ro}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                @include("panel.components.forms.name",["title" => "Numele portfolio", "placeholder" => "Numele portfolio", "valueRo" => $portfolio->name_ro, "valueRu" => $portfolio->name_ru, "valueEn" => $portfolio->name_en])
                                @include("panel.components.forms.descriptionEditor2",["title" => "Descriere portfolio", "placeholder" => "Descriere portfolio", "valueRo" => $portfolio->description_ro, "valueRu" => $portfolio->description_ru, "valueEn" => $portfolio->description_en])



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
                                            @if($portfolio->image_preview)
                                                <a href="{{url('storage/'.$portfolio->image_preview)}}" data-fancybox data-caption="Single image">
                                                <img id="image_preview" src="{{url('storage/'.$portfolio->image_preview)}}" alt="Preview portfolio image" class="added_preview_image " style="width: 300px">
                                                </a>
                                            @endif
                                        </div>
{{--                                         onclick="change(this.src)"--}}
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
                                            @if($portfolio->image_main)
                                                <a href="{{url('storage/'.$portfolio->image_main)}}" data-fancybox >
                                                    <img id="image_main" src="{{url('storage/'.$portfolio->image_main)}}" alt="Preview category image" class="added_main_image " onclick="" style="max-width: 500px">
                                                </a>
                                            @endif
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
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap row" id="mainSliderContainer">

                                            @if($images)
                                                @foreach($images as $item)
                                                    @if($item->type == 'image')
                                                        <div class=" col-lg-6 mb-3">
                                                            <div class="image_block">
                                                                <button type="submit" name="delete" value="{{$item->id}}" class="btn btn-sm btn-danger image_btn">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                                <a href="{{url('storage/'.$item->url)}}" data-gallery >
                                                                    <img id="image_main" src="{{url('storage/'.$item->url)}}"  alt="Preview portfolio image" class=" "  onclick="" style="width: 300px">
                                                                </a>
                                                            </div>

                                                        </div>
                                                   @elseif($item->type == 'video')
                                                        <div class=" col-lg-6 mb-3">
                                                            <div class="image_block">
                                                                <button type="submit" name="delete" value="{{$item->id}}" class="btn btn-sm btn-danger video_btn">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                                <a href="{{url('storage/'.$item->url)}}" data-gallery >
                                                                    <video src="{{url('storage/'.$item->url)}}" controls width="300" height="240"></video>
                                                                </a>
                                                            </div>

                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

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
                const selectImageMain =  document.getElementById('mainImage');
                const selectSlider =  document.getElementById('slider');
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mainImageContainer = document.getElementById('mainImageContainer');
                const mainSliderContainer = document.getElementById('mainSliderContainer');
                const saveBtn = document.getElementById('saveBtn');

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


                Fancybox.bind("[data-fancybox]", {
                    // Your custom options
                });
                Fancybox.bind("[data-gallery]", {
                    // Your custom options
                });
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
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png'|| files[i].type === 'image/webp') {
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
                    const imgs = document.querySelectorAll('.added_image_block')
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
                                const imageBlock = document.createElement("div");
                                imageBlock.classList.add('added_image_block');
                                imageBlock.classList.add('col-lg-6');
                                imageBlock.classList.add('mb-2');
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Main portfolio image";
                                image.classList.add('added_slider_images');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mainSliderContainer.append(imageBlock);
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
                                video.classList.add('added_slider_images');
                                mainSliderContainer.append(video);
                            }
                        }
                    }
                }

                saveBtn.addEventListener('click', ()=>{
                    document.querySelector('.spinner-border').style.display = 'block';
                })
            </script>
    @endpush


        @section('after_styles')
{{--            <link--}}
{{--                rel="stylesheet"--}}
{{--                href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"--}}
{{--            />--}}
            <style>
                .image_block {
                    position: relative;
                    width: 300px;
                }

                .image_btn {
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

                tbody tr {
                    height:auto;
                }
            </style>

@endsection
