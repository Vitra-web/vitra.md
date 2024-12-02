@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-3">
                <a href="{{route('about')}}" class="btn btn-secondary" >
                    <i class="fas fa-backward mr-2"></i>
                </a>

            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

    <section class="content">
        <div class="container-fluid ml-4">
            <div class="form_container">
                <form action="{{route('about.update', $item->id)}}" method="post" class="w-100" enctype="multipart/form-data">
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


                         @include("panel.components.forms.title",["title" => "About page title", "placeholder" => "About page title", "valueRo" => $item->title_ro, "valueRu" => $item->title_ru, "valueEn" => $item->title_en])

                         @include("panel.components.forms.descriptionEditor2",["title" => "Descriere despre noi page", "placeholder" => "Descriere despre noi page", "valueRo" => $item->description_ro, "valueRu" => $item->description_ru, "valueEn" => $item->description_en])


                        </div>
                        <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                            <div class="form_block row mb-3 ">
                                <div class="row mb-3 align-items-start">
                            <div class="form-group col-sm-3 ">
                                <label  class="col-form-label" for="previewImage">Upload image main</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="form-control" id="previewImage" >
                                    </div>
                                </div>
                                @error('image')<p class="text-danger"> {{$message}}</p>@enderror
                                <p class="text-info">min size: 1380*500</p>
                                <p class="text-info">ratio: 2,75 : 1</p>
                                <p class="text-info">formats: jpeg, png, webp, mp4</p>
                            </div>
                            <div class="col-sm-5 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                @if($item->image)
                                    <a href="{{url('storage/'.$item->image)}}" data-fancybox data-caption="Single image">
                                        <img id="image" src="{{url('storage/'.$item->image)}}" alt="Preview category image" class="added_preview_image w-100"  >
                                    </a>
                                @endif
                            </div>
                            <div class="col-sm-3 " >
                                @if($item->image_mobile)
                                    <a href="{{url('storage/'.$item->image_mobile)}}" data-fancybox data-caption="Single image">
                                        <img id="image" src="{{url('storage/'.$item->image_mobile)}}" alt="Preview category image" class="added_preview_image w-100"  >
                                    </a>
                                @endif
                            </div>
                        </div>
                            </div>

                            <div class="form_block row mb-3 ">
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="form-group col-sm-4 ">--}}
{{--                                        <label  class="col-form-label" for="secondImage">Upload image second</label>--}}
{{--                                        <div class="input-group mb-2">--}}
{{--                                            <div class="custom-file">--}}
{{--                                                <input type="file" name="image_second" class="form-control" id="secondImage" >--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        @error('second_image')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                        <p class="text-info">min size: 1380*500</p>--}}
{{--                                        <p class="text-info">ratio: 2,75 : 1</p>--}}
{{--                                        <p class="text-info">formats: jpeg, png, webp, mp4</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6 ml-3 d-flex flex-wrap" id="secondImageContainer">--}}
{{--                                        @if($item->image_second)--}}
{{--                                            <a href="{{url('storage/'.$item->image_second)}}" data-imageSecond data-caption="Single image_second">--}}
{{--                                                <img id="secondImage" src="{{url('storage/'.$item->image_second)}}" alt="Preview category second image" class="added_image_second "  style="width: 300px">--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
                                        @if($item->video)
                                            <a href="{{url('storage/'.$item->video)}}" data-video >
                                                <video src="{{url('storage/'.$item->video)}}" class="added_video" controls width="300" height="240"></video>
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
        const previewImageContainer = document.getElementById('previewImageContainer');
        const selectVideo =  document.getElementById('video');

        const selectSecondImage =  document.getElementById('secondImage');
        const secondImageContainer = document.getElementById('secondImageContainer');
        const videoContainer = document.getElementById('videoContainer');

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });

        Fancybox.bind("[data-imageSecond]", {
            // Your custom options
        });

        Fancybox.bind("[data-video]", {
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


            for (let i = 0; i < files.length; i++) {
                if (files[i].type === 'image/jpeg' || files[i].type === 'image/png'|| files[i].type === 'image/webp') {
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

        selectSecondImage.onchange = evt => {
            const imgs = document.querySelectorAll('.added_image_second')
            if (imgs) {
                imgs.forEach(img => {
                    img.remove()
                })
            }
            const files = selectSecondImage.files

            for (let i = 0; i < files.length; i++) {
                if (files[i].type === 'image/jpeg' || files[i].type === 'image/png'|| files[i].type === 'image/webp') {
                    if (files[i]) {
                        const image = document.createElement("img");
                        image.src = URL.createObjectURL(files[i]);
                        image.alt = "Preview category image";
                        image.classList.add('added_image_second');
                        image.style.width = "300px";
                        image.style.marginBottom = "20px";
                        image.style.marginRight = "20px";
                        secondImageContainer.append(image);
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

    </script>
@endpush
