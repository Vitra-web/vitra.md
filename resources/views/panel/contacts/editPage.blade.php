@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-3">
                <a href="{{route('contacts')}}" class="btn btn-secondary" >
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
                <form action="{{route('contacts.updatePage', $page->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                    @csrf
                    @method('patch')


                    @include("panel.components.forms.title",["title" => "Contacts page title", "placeholder" => "Contacts page title", "valueRo" => $page->title_ro, "valueRu" => $page->title_ru, "valueEn" => $page->title_en])
                    @include("panel.components.forms.description",["title" => "Contacts page description", "placeholder" => "Contacts page description", "valueRo" => $page->description_ro, "valueRu" => $page->description_ru, "valueEn" => $page->description_en])

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
                                <p class="text-info">min size: 1380*500</p>
                                <p class="text-info">ratio: 2,75 : 1</p>
                                <p class="text-info">formats: jpeg, png, webp</p>
                            </div>
                            <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                @if($page->image)
                                    <a href="{{url('storage/'.$page->image)}}" data-fancybox data-caption="Single image">
                                        <img id="image" src="{{url('storage/'.$page->image)}}" alt="Preview category image" class="added_preview_image "  style="width: 300px">
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

        Fancybox.bind("[data-fancybox]", {
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



    </script>
@endpush