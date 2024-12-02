@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-3">
                <a href="{{route('mission')}}" class="btn btn-secondary" >
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
                <form action="{{route('mission.store')}}" method="post" class="w-100" enctype="multipart/form-data">
                    @csrf

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
                            <div class="form_block row mb-3">

                                <div class="form-group col-lg-2 col-sm-6">
                                    <label for="sort_order" class="">Ordinea</label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" placeholder="Ordinea" value="{{count($missions)+1}}">
                                    @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                </div>




                            </div>

                            @include("panel.components.forms.title",["title" => "Numele misiunea", "placeholder" => "Numele misiunea", "valueRo" => old('title_ro'), "valueRu" => old('title_ru'), "valueEn" => old('title_en')])
                            @include("panel.components.forms.description",["title" => "Descriere misiunea", "placeholder" => "Descriere misiunea", "valueRo" => old('description_ro'), "valueRu" =>old('description_ru'), "valueEn" => old('description_ro')])


                        </div>
                        <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                            <div class="form_block row mb-3 ">

                                <div class="row mb-3">
                                    <div class="form-group col-sm-4 ">
                                        <label  class="col-form-label" for="previewImage">Upload image</label>
                                        <div class="input-group mb-2">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="form-control" id="previewImage" >
                                            </div>
                                        </div>
                                        @error('image')<p class="text-danger"> {{$message}}</p>@enderror
                                        <p class="text-info">min size: 380*410</p>
                                        <p class="text-info">ratio: 1 : 1,1</p>
                                        <p class="text-info">formats: jpeg, png, webp</p>
                                    </div>
                                    <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">

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
    <!-- /.content -->
@endsection

@push('script')
    <script>
        const selectImagePreview =  document.getElementById('previewImage');

        const previewImageContainer = document.getElementById('previewImageContainer');



        $('.select2').select2()



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
                if (files[i].type === 'image/jpeg' || files[i].type === 'image/png'|| files[i].type === 'image/webp') {
                    imagesArray.push(files[i])
                    if (files[i]) {
                        const image = document.createElement("img");
                        image.src = URL.createObjectURL(files[i]);
                        image.alt = "Preview slider image";
                        image.classList.add('added_preview_image');
                        image.style.width = "300px";
                        image.style.marginBottom = "20px";
                        image.style.marginRight = "20px";
                        previewImageContainer.append(image);
                    }
                }
            }
        }



    </script>
@endpush
