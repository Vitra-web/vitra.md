@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-3">
                <a href="{{route('careers')}}" class="btn btn-secondary" >
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
                <form action="{{route('careers.updatePage', $careersPage->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    @include("panel.components.forms.title",["title" => "Career page title", "placeholder" => "Career page title", "valueRo" => $careersPage->title_ro, "valueRu" => $careersPage->title_ru, "valueEn" => $careersPage->title_en])


                    <div class="form_block row mb-3 ">
                        <h4 class="mb-3">First description title</h4>
                        <div class="d-flex form-group col-sm-4">
                            <label for="description_title_ro">
                                <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
                            </label>
                            <input type="text" class="form-control ml-2" name="description_title_ro"  id="description_title_ro" placeholder="description title Ro" value="{{$careersPage->description_title_ro}}">

                        </div>
                        <div class="d-flex form-group col-sm-4">
                            <label for="description_title_ru">
                                <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">
                            </label>
                            <input type="text" class="form-control ml-2" name="description_title_ru" id="description_title_ru" placeholder="description title Ru" value="{{$careersPage->description_title_ru}}">

                        </div>

                        <div class="d-flex form-group col-sm-4">
                            <label for="description_title_en">
                                <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">
                            </label>
                            <input type="text" class="form-control ml-2" name="description_title_en" id="description_title_en" placeholder="description title En" value="{{$careersPage->description_title_en}}">

                        </div>
                    </div>

                    @include("panel.components.forms.editorVariable",["title" => "Description first", "placeholder" => "Description first", "name"=>'description', "valueRo" => $careersPage->description_ro, "valueRu" => $careersPage->description_ru, "valueEn" => $careersPage->description_en])


                    <div class="form_block row mb-3 ">
                        <h4 class="mb-3">Second description title</h4>
                        <div class="d-flex form-group col-sm-4">
                            <label for="title_second_ro">
                                <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
                            </label>
                            <input type="text" class="form-control ml-2" name="title_second_ro"  id="title_second_ro" placeholder="description second title Ro" value="{{$careersPage->title_second_ro}}">

                        </div>
                        <div class="d-flex form-group col-sm-4">
                            <label for="title_second_ru">
                                <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">
                            </label>
                            <input type="text" class="form-control ml-2" name="title_second_ru" id="title_second_ru" placeholder="description second title Ru" value="{{$careersPage->title_second_ru}}">

                        </div>

                        <div class="d-flex form-group col-sm-4">
                            <label for="title_second_en">
                                <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">
                            </label>
                            <input type="text" class="form-control ml-2" name="title_second_en" id="title_second_en" placeholder="description second title En" value="{{$careersPage->title_second_en}}">

                        </div>
                    </div>


                    @include("panel.components.forms.editorVariable",["title" => "Description second", "placeholder" => "Description second", "name"=>'description_title_second', "valueRo" => $careersPage->description_title_second_ro, "valueRu" => $careersPage->description_title_second_ru, "valueEn" => $careersPage->description_title_second_en])


                    <div class="form_block row mb-3 ">

                        <div class="row mb-3">
                            <div class="form-group col-sm-4 ">
                                <label  class="col-form-label" for="previewImage">Upload main image</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="form-control" id="previewImage" >
                                    </div>
                                </div>
                                @error('image')<p class="text-danger"> {{$message}}</p>@enderror
                                <p class="text-info">min size: 1380*500</p>
                                <p class="text-info">ratio: 2,75 : 1</p>
                                <p class="text-info">formats: jpeg, png, webp</p>
                            </div>
                            <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                @if($careersPage->image)
                                    <a href="{{url('storage/'.$careersPage->image)}}" data-fancybox data-caption="Single image">
                                        <img id="image" src="{{url('storage/'.$careersPage->image)}}" alt="Preview category image" class="added_preview_image "  style="width: 300px">
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="form-group col-sm-4 ">
                                <label  class="col-form-label" for="secondImage">Upload second image</label>
                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input type="file" name="image_second" class="form-control" id="secondImage" >
                                    </div>
                                </div>
                                @error('image_second')<p class="text-danger"> {{$message}}</p>@enderror
                                <p class="text-info">min size: 900*600</p>
                                <p class="text-info">ratio: 1,5 : 1</p>
                                <p class="text-info">formats: jpeg, png, webp</p>
                            </div>
                            <div class="col-sm-6 ml-3 d-flex flex-wrap" id="secondImageContainer">
                                @if($careersPage->image_second)
                                    <a href="{{url('storage/'.$careersPage->image_second)}}" data-fancybox-secons data-caption="Single image_second">
                                        <img id="image_second" src="{{url('storage/'.$careersPage->image_second)}}" alt="Preview category image" class="added_second_image "  style="width: 300px">
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

        const selectImageSecond =  document.getElementById('secondImage');
        const secondImageContainer = document.getElementById('secondImageContainer');

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });

        Fancybox.bind("[data-fancybox-second]", {
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

        selectImageSecond.onchange = evt => {
            const imgs = document.querySelectorAll('.added_second_image')
            if (imgs) {
                imgs.forEach(img => {
                    img.remove()
                })

            }
            const files = selectImageSecond.files


            for (let i = 0; i < files.length; i++) {
                if (files[i].type === 'image/jpeg' || files[i].type === 'image/png'|| files[i].type === 'image/webp') {
                    if (files[i]) {
                        const image = document.createElement("img");
                        image.src = URL.createObjectURL(files[i]);
                        image.alt = "Second image";
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
