@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('news')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$news->name_ro}}</h1>
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
                    <form action="{{route('news.update', $news->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')


                                <div class="form_block row mb-3">
                                    <div class="form-group col-sm-3">
                                        <label for="status">Status</label>
                                        <select class="custom-select form-control" name="status" id="status" >
                                            <option value="1" {{$news->status == 1 ? 'selected' : ''}}>Activat</option>
                                            <option value="0" {{$news->status == 0 ? 'selected' : ''}}>Dezactivat</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="" class="">Ordinea</label>
                                        <input type="number" class="form-control" name="sort_order" placeholder="Ordinea" value="{{$news->sort_order}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                    <div class="form-group col-lg-4 col-sm-6 " >
                                        <div>
                                            <label for="category_id">Industrie</label>
                                            <select class="custom-select select2 form-control" name="industry_id" id="industry_id" >
                                                @foreach($industries as $item)
                                                    <option {{$news->industry_id == $item->id ? 'selected' : ''}} value="{{$item->id}}" >{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group col-lg-4 col-sm-6 d-flex" data-select2-id="1">
                                        <div>
                                            <label for="category_id">Categorie</label>
                                            <select class="custom-select select2 form-control" name="category_id" id="category_id" >
                                                @foreach($newsCategories as $item)
                                                    <option value="{{$item->id}}" {{$news->category_id == $item->id ? 'selected' : ''}} >{{$item->name_ro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-end ml-3">
                                            <a href="{{route('news.createCategory')}}" class="btn btn-outline-primary mr-5 px-3 ">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                        @include("panel.components.forms.name",["title" => "Numele noutații", "placeholder" => "Numele noutații", "valueRo" => $news->name_ro, "valueRu" => $news->name_ru, "valueEn" => $news->name_en])

                        <div class="form_block row mb-3 ">
                            <div class="row mb-3">
                                <div class="form-group col-sm-4 ">
                                    <label  class="col-form-label" for="previewImage">Upload preview image</label>
                                    <div class="input-group mb-2">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="form-control" id="previewImage" >
                                        </div>
                                    </div>
                                    @error('image')<p class="text-danger"> {{$message}}</p>@enderror
                                    <p class="text-info">min size: 150*180</p>
                                    <p class="text-info">ratio: 1 : 1,2</p>
                                    <p class="text-info">formats: jpeg, png, webp</p>
                                </div>
                                <div class="col-sm-6 ml-3 d-flex flex-wrap" id="previewImageContainer">
                                    @if($news->image)
                                        <a href="{{url('storage/'.$news->image)}}" data-fancybox data-caption="Single image">
                                            <img id="image_preview" src="{{url('storage/'.$news->image)}}" alt="Preview news image" class="added_preview_image " onclick="" style="width: 300px">
                                        </a>
                                    @endif
                                </div>
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
                                    @if($news->image_main)
                                        <a href="{{url('storage/'.$news->image_main)}}" data-fancybox >
                                            <img id="image_main" src="{{url('storage/'.$news->image_main)}}" alt="Preview category image" class="added_main_image " onclick="" style="width: 500px">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @include("panel.components.forms.descriptionEditor2",["title" => "Descriere noutații", "placeholder" => "Descriere noutații", "valueRo" => $news->description_ro, "valueRu" => $news->description_ru, "valueEn" => $news->description_en])







                        <div class="form-group text-center d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" value="Save" id="saveBtn">
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
                const previewImageContainer = document.getElementById('previewImageContainer');
                const mainImageContainer = document.getElementById('mainImageContainer');
                const saveBtn = document.getElementById('saveBtn');

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
                    let imagesArray = []

                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png') {
                            imagesArray.push(files[i])
                            if (files[i]) {
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Preview news image";
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
                                image.style.width = "500px";
                                image.style.marginBottom = "20px";
                                image.style.marginRight = "20px";
                                mainImageContainer.append(image);
                            }
                        }
                    }
                }

                saveBtn.addEventListener('click', ()=>{
                    document.querySelector('.spinner-border').style.display = 'block';
                })
            </script>
    @endpush
