@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('careers')}}" class="btn btn-secondary" >
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
                    <form action="{{route('careers.store')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="created_by" value="{{\Illuminate\Support\Facades\Auth::id()}}" >


                                <div class="form_block row mb-3">
                                    <div class="form-group col-lg-4 col-sm-6">
                                        <label for="status">Status</label>
                                        <select class="custom-select form-control" name="status" id="status" >
                                            <option value="1" selected>Activat</option>
                                            <option value="0">Dezactivat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-sm-6">
                                        <label for="" class="">Ordinea</label>
                                        <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{count($items)+1}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>

                                </div>

                        @include("panel.components.forms.name",["title" => "Numele postului", "placeholder" => "Numele postului", "valueRo" => old('name_ro'), "valueRu" => old('name_ru'), "valueEn" => old('name_en')])

                        @include("panel.components.forms.textVariable",["title" => "Localitate", 'name'=>'location', "placeholder" => "Localitate", "valueRo" => old('location_ro'), "valueRu" => old('location_ru'), "valueEn" => old('location_en')])

                        @include("panel.components.forms.textVariable",["title" => "Departament", 'name'=>'department', "placeholder" => "Departament", "valueRo" => old('department_ro'), "valueRu" => old('department_ru'), "valueEn" => old('department_en')])


                        @include("panel.components.forms.descriptionEditor2",["title" => "Descriere postului", "placeholder" => "Descriere postului", "valueRo" => old('description_ro'), "valueRu" =>old('description_ru'), "valueEn" => old('description_ro')])


{{--                                <div class="form_block row mb-3 ">--}}
{{--                                    <div class="row mb-3">--}}
{{--                                        <div class="form-group col-sm-4 ">--}}
{{--                                            <label  class="col-form-label" for="previewImage">Upload image</label>--}}
{{--                                            <div class="input-group mb-2">--}}
{{--                                                <div class="custom-file">--}}
{{--                                                    <input type="file" name="image" class="form-control" id="previewImage" >--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            @error('image')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                            <p class="text-info">min size: 256*256</p>--}}
{{--                                            <p class="text-info">ratio: 1 : 1</p>--}}
{{--                                            <p class="text-info">formats: jpeg, png, webp</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">--}}

{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}


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
                // const selectImagePreview =  document.getElementById('previewImage');
                // const previewImageContainer = document.getElementById('previewImageContainer');
                //
                //
                // selectImagePreview.onchange = evt => {
                //     const imgs = document.querySelectorAll('.added_preview_image')
                //     if (imgs) {
                //         imgs.forEach(img => {
                //             img.remove()
                //         })
                //
                //     }
                //     const files = selectImagePreview.files
                //
                //     for (let i = 0; i < files.length; i++) {
                //         if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
                //
                //             if (files[i]) {
                //                 const image = document.createElement("img");
                //                 image.src = URL.createObjectURL(files[i]);
                //                 image.alt = "Preview careers image";
                //                 image.classList.add('added_preview_image');
                //                 image.style.width = "300px";
                //                 image.style.marginBottom = "20px";
                //                 image.style.marginRight = "20px";
                //                 previewImageContainer.append(image);
                //             }
                //         }
                //     }
                // }



            </script>
    @endpush
