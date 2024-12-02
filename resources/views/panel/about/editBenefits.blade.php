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
                <form action="{{route('about.updateBenefit', $item->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                    @csrf
                    @method('patch')


                    @include("panel.components.forms.title",["title" => "Benefit title", "placeholder" => "Benefit title", "valueRo" => $item->title_ro, "valueRu" => $item->title_ru, "valueEn" => $item->title_en])
                    @include("panel.components.forms.description",["title" => "Benefit description", "placeholder" => "Benefit description", "valueRo" => $item->description_ro, "valueRu" => $item->description_ru, "valueEn" => $item->description_en])


                    <div class="form_block row mb-3 ">

                        <div class="row">
                            <div class="col-sm-4 form-check mb-3 d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" name="main_page" value="1" {{$item->main_page ==1 ? 'checked': ''}} id="flexCheckDefault">
                                @error('main_page')<p class="text-danger"> {{$message}}</p>@enderror
                                <label class="form-check-label fs-4" for="flexCheckDefault">
                                    Arata la pagina principala
                                </label>
                            </div>
                            <div class="col-sm-3 d-flex align-items-center">
                                <label for="exampleFormControlInput1" class="form-label">Number</label>
                                <input type="text" name="number" class="form-control ml-3" value="{{$item->number}}" id="exampleFormControlInput1" >
                                @error('number')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                            <div class="col-sm-3 d-flex align-items-center">
                                <label for="sort_order" class="form-label mr-3">Ordinea</label>
                                <input type="number" class="form-control" name="sort_order" id="sort_order" placeholder="Ordinea" value="{{$item->sort_order}}">
                                @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>

                        </div>


                        <div class="row mb-3 align-items-start">
                            <div class="form-group col-sm-4 ">
                                <label  class="col-form-label" for="previewImage">Upload icon</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="form-control" id="previewImage" >
                                    </div>
                                </div>
                                @error('image')<p class="text-danger"> {{$message}}</p>@enderror
                                <p class="text-info">min size: 50*50</p>
                                <p class="text-info">ratio: 1 : 1</p>
                                <p class="text-info">formats: jpeg, png, webp</p>
                            </div>
                            <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                @if($item->image)
                                    <a href="{{url('storage/'.$item->image)}}" data-fancybox data-caption="Single image">
                                    <img id="image" src="{{url('storage/'.$item->image)}}" alt="Preview category image" class="added_preview_image "  style="width: 100px">
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3 align-items-start">
                            <div class="form-group col-sm-3 ">
                                <label  class="col-form-label" for="sliderImage">Upload slider image</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" name="slider_image" class="form-control" id="sliderImage" >
                                    </div>
                                </div>
                                @error('slider_image')<p class="text-danger"> {{$message}}</p>@enderror
                                <p class="text-info">min size: 1440*720</p>
                                <p class="text-info">ratio: 2 : 1</p>
                                <p class="text-info">formats: jpeg, png, webp</p>
                            </div>
                            <div class="col-sm-5 ml-3 d-flex flex-wrap" id="sliderImageContainer">
                                @if($item->slider_image)
                                    <a href="{{url('storage/'.$item->slider_image)}}" data-fancybox2 data-caption="Single image">
                                        <img id="image" src="{{url('storage/'.$item->slider_image)}}" alt="Preview category image" class="added_slider_image w-100"  >
                                    </a>
                                @endif
                            </div>

                        </div>

                        <div class="row mb-3 align-items-start">
                            <div class="form-group col-sm-3 ">
                                <label  class="col-form-label" for="mobileImage">Upload slider mobile image</label>
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
                            <div class="col-sm-6 ml-3 d-flex flex-wrap" id="mobileImageContainer">
                                @if($item->image_mobile)
                                    <a href="{{url('storage/'.$item->image_mobile)}}" data-fancybox data-caption="Preview image_mobile">
                                        <img id="image_mobile_preview" src="{{url('storage/'.$item->image_mobile)}}" alt="Preview slider image_mobile" class="added_mobile_image " onclick="" style="max-width: 300px">
                                    </a>
                                @endif
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
    <!-- /.content -->
@endsection

@push('script')
    <script>
        const selectImagePreview =  document.getElementById('previewImage');
        const previewImageContainer = document.getElementById('previewImageContainer');
        const selectSliderImage =  document.getElementById('sliderImage');
        const sliderImageContainer = document.getElementById('sliderImageContainer');
        const selectImageMobile =  document.getElementById('mobileImage');
        const mobileImageContainer = document.getElementById('mobileImageContainer');

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });

        Fancybox.bind("[data-fancybox2]", {
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
                        image.style.width = "100px";
                        image.style.marginBottom = "20px";
                        image.style.marginRight = "20px";
                        previewImageContainer.append(image);
                    }
                }
            }
        }


        selectSliderImage.onchange = evt => {
            const imgs = document.querySelectorAll('.added_slider_image')
            if (imgs) {
                imgs.forEach(img => {
                    img.remove()
                })

            }
            const files = selectSliderImage.files


            for (let i = 0; i < files.length; i++) {
                if (files[i].type === 'image/jpeg' || files[i].type === 'image/png'|| files[i].type === 'image/webp') {
                    if (files[i]) {
                        const image = document.createElement("img");
                        image.src = URL.createObjectURL(files[i]);
                        image.alt = "Preview category image";
                        image.classList.add('added_slider_image');
                        image.style.width = "400px";
                        image.style.marginBottom = "20px";
                        image.style.marginRight = "20px";
                        sliderImageContainer.append(image);
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

    </script>
@endpush
