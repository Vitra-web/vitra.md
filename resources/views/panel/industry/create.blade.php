@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('industry')}}" class="btn btn-secondary" >
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
                    <form action="{{route('industry.store')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf


                        <div class="form_block row mb-3">
                            <div class="form-group col-sm-4">
                                <label for="" class="">Ordinea</label>
                                <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{count($industries)+1}}">
                                @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                            <div class=" form-group col-sm-4">
                                <label for="">
                                    Numele industriei
                                </label>
                                <input type="text" class="form-control ml-2" name="name"   placeholder="Numele industriei" value="{{old('name')}}">
                                @error('name')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                        </div>



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
                                    <p class="text-info">min size: 150*180</p>
                                    <p class="text-info">ratio: 1 : 1,2</p>
                                </div>
                                <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">

                                </div>
                            </div>
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
{{--                                <div class="form-group col-sm-4 ">--}}
{{--                                    <label  class="col-form-label" for="mainImage">Upload main image</label>--}}
{{--                                    <div class="input-group mb-2">--}}
{{--                                        <div class="custom-file">--}}
{{--                                            <input type="file" name="image_main" class="form-control" id="mainImage" >--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @error('image_main')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                    <p class="text-info">min size: 1380*500</p>--}}
{{--                                    <p class="text-info">ratio: 2,7 : 1</p>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-6 ml-3 d-flex flex-wrap" id="mainImageContainer">--}}

{{--                                </div>--}}
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
                const selectImageMain =  document.getElementById('mainImage');
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mainImageContainer = document.getElementById('mainImageContainer');


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
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png') {
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
