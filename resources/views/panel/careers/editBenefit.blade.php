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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$benefit->name_ro}}</h1>
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
                    <form action="{{route('careers.updateBenefit', $benefit->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')


                                <div class="form_block row mb-3">
{{--                                    <div class="form-group col-sm-3">--}}
{{--                                        <label for="status">Status</label>--}}
{{--                                        <select class="custom-select form-control" name="status" id="status" >--}}
{{--                                            <option value="1" {{$benefit->status == 1 ? 'selected' : ''}}>Activat</option>--}}
{{--                                            <option value="0" {{$benefit->status == 0 ? 'selected' : ''}}>Dezactivat</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="form-group col-sm-3">
                                        <label for="sort_order" class="">Ordinea</label>
                                        <input type="number" class="form-control" name="sort_order" id="sort_order" placeholder="Ordinea" value="{{$benefit->sort_order}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>

                                </div>

                        @include("panel.components.forms.title",["title" => "Numele postului", "placeholder" => "Numele postului", "valueRo" => $benefit->title_ro, "valueRu" => $benefit->title_ru, "valueEn" => $benefit->title_en])
                        @include("panel.components.forms.description",["title" => "Descriere postului", "placeholder" => "Descriere postului", "valueRo" => $benefit->description_ro, "valueRu" => $benefit->description_ru, "valueEn" => $benefit->description_en])



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
                                            <p class="text-info">min size: 256*256</p>
                                            <p class="text-info">ratio: 1 : 1</p>
                                            <p class="text-info">formats: png</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                            @if($benefit->image)
                                                <img id="image_preview" src="{{url('storage/'.$benefit->image)}}" alt="Preview vacancy image" class="added_preview_image " onclick="" style="width: 300px">

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



                selectImagePreview.onchange = evt => {
                    const imgs = document.querySelectorAll('.added_preview_image')
                    if (imgs) {
                        imgs.forEach(img => {
                            img.remove()
                        })

                    }
                    const files = selectImagePreview.files

                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png') {
                            if (files[i]) {
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Preview careers image";
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
