@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('slider')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$slider->name_ro}}</h1>
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
                    <form action="{{route('slider.update', $slider->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')


                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
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
                                <div class="form_block row mb-2">
                                    <div class="form-group col-lg-2 col-sm-6">
                                        <label for="status">Status</label>
                                        <select class="custom-select form-control " name="status" id="status" >
                                            <option value="1" {{$slider->status == 1 ? 'selected' : ''}}>Activat</option>
                                            <option value="0" {{$slider->status == 0 ? 'selected' : ''}}>Dezactivat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 col-sm-6">
                                        <label for="" class="">Ordinea</label>
                                        <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{$slider->sort_order}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                    <div class="form-group col-lg-4 col-sm-6">
                                        <label for="link" class="">Link</label>
                                        <input type="text" id="link" class="form-control" name="link" value="{{$slider->link}}" placeholder="Link" >

                                    </div>
                                    <div class="form-group col-lg-4 col-sm-6 d-flex" data-select2-id="1">
                                        <div>
                                            <label for="slider_category_id">Categorie</label>
                                            <select class="custom-select select2 form-control" name="slider_category_id" id="slider_category_id" >
                                                @foreach($sliderCategories as $item)
                                                    <option value="{{$item->id}}" {{$slider->slider_category_id == $item->id ? 'selected' : ''}} >{{$item->name_ro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-end ml-3">
                                            <a href="{{route('slider.createCategory')}}" class="btn btn-outline-primary mr-5 px-3 ">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @include("panel.components.forms.name",["title" => "Numele slider", "placeholder" => "Numele slider", "valueRo" => $slider->name_ro, "valueRu" => $slider->name_ru, "valueEn" => $slider->name_en])
                                @include("panel.components.forms.description",["title" => "Descriere slider", "placeholder" => "Descriere slider", "valueRo" => $slider->description_ro, "valueRu" => $slider->description_ru, "valueEn" => $slider->description_en])


                            </div>
                            <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form_block row mb-3 ">

                                    <div class="row mb-3">
                                        <div class="form-group col-md-3 ">
                                            <label  class="col-form-label" for="previewImage">Upload image</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="form-control" id="previewImage" >
                                                </div>
                                            </div>
                                            @error('image')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">min size: 1440*720</p>
                                            <p class="text-info">ratio: 2 : 1</p>
                                            <p class="text-info">formats: jpeg, png, webp</p>
                                        </div>
                                        <div class="col-md-5 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                            @if($slider->image)
                                                <a href="{{url('storage/'.$slider->image)}}" data-fancybox data-caption="Preview image">
                                                <img id="image_preview" src="{{url('storage/'.$slider->image)}}" alt="Preview slider image" class="added_preview_image w-100" onclick="" >
                                                </a>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="row mb-3">
                                        <div class="form-group col-md-3 ">
                                            <label  class="col-form-label" for="previewImage">Upload mobile image</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="image_mobile" class="form-control" id="mobileImage" >
                                                </div>
                                            </div>
                                            @error('image_mobile')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">min size: 450*450</p>
                                            <p class="text-info">ratio: 1 : 1</p>
                                            <p class="text-info">formats: jpeg, png, webp</p>
                                        </div>

                                        <div class="col-md-3 ml-3 d-flex flex-wrap" id="mobileImageContainer">
                                            @if($slider->image_mobile)
                                                <a href="{{url('storage/'.$slider->image_mobile)}}" data-fancybox data-caption="Preview image_mobile">
                                                    <img id="image_mobile_preview" src="{{url('storage/'.$slider->image_mobile)}}" alt="Preview slider image_mobile" class="added_mobile_image " onclick="" style="max-width: 300px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="mainImage">Upload video</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="video" class="form-control" id="video" >
                                                </div>
                                            </div>
                                            @error('video')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">formats: mp4, MOV, WMV, WebM</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="videoContainer">
                                            @if($slider->video)
                                                <a href="{{url('storage/'.$slider->video)}}" data-gallery >
                                                <video src="{{url('storage/'.$slider->video)}}" class="added_video" controls width="300" height="240"></video>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>

                        <div class="form-group text-center d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" id="saveBtn" value="Save">
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
                const selectImageMobile =  document.getElementById('mobileImage');
                const selectVideo =  document.getElementById('video');
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mobileImageContainer = document.getElementById('mobileImageContainer');
                const videoContainer = document.getElementById('videoContainer');


                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
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
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
                            imagesArray.push(files[i])
                            if (files[i]) {
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Preview slider image";
                                image.classList.add('added_preview_image');
                                image.style.width = "500px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                previewImageContainer.append(image);
                            }
                        }
                    }
                }

                selectImageMobile.onchange = evt => {
                    const imgs = document.querySelectorAll('.added_mobile_image')
                    if (imgs) {
                        imgs.forEach(img => {
                            img.remove()
                        })

                    }
                    const files = selectImageMobile.files
                    let imagesArray = []

                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png'|| files[i].type === 'image/webp') {
                            imagesArray.push(files[i])
                            if (files[i]) {
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Mobile slider image";
                                image.classList.add('added_mobile_image');
                                image.style.width = "300px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mobileImageContainer.append(image);
                            }
                        }
                    }
                }


                selectVideo.onchange = evt => {
                    const imgs = document.querySelectorAll('.added_video')
                    if (imgs) {
                        imgs.forEach(img => {
                            img.remove()
                        })

                    }
                    const files = selectVideo.files

                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'video/mp4' || files[i].type === 'video/mov' || files[i].type === 'video/wmv' || files[i].type === 'video/webm') {
                            if (files[i]) {
                                const video = document.createElement("video");
                                video.src = URL.createObjectURL(files[i]);
                                video.autoplay = false;
                                video.controls = true;
                                video.muted = false;
                                video.height = 240;
                                video.width = 300;
                                video.style.marginBottom = "20px";
                                video.classList.add('added_video');
                                videoContainer.append(video);
                            }
                        }
                    }

                }

                document.getElementById('saveBtn').addEventListener('click', ()=>{
                    document.querySelector('.spinner-border').style.display = 'block';
                })


            </script>
    @endpush
