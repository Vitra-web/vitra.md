@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('category')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$category->name_ro}}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="row ">
                    <form action="{{route('category.update', $category->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')


                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active fs-5" id="common-tab" data-toggle="tab" href="#common" role="tab" aria-controls="common" aria-selected="true">
                                    {{trans('panel.common')}}
                                </a>
                                <a class="nav-item nav-link fs-5" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
                                    {{trans('panel.images')}}
                                </a>
                                <a class="nav-item nav-link fs-5" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">
                                    {{trans('panel.products')}}
                                </a>

                            </div>
                        </nav>

                        <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">
                                <div class="form_block row mb-3">
                                    <div class="form-group col-sm-3">
                                        <label for="status">{{trans('panel.status')}}</label>
                                        <select class="custom-select form-control" name="status" id="status" >
                                            <option value="1" {{$category->status == 1 ? 'selected' : ''}}>{{trans('panel.status_active')}}</option>
                                            <option value="0" {{$category->status == 0 ? 'selected' : ''}}>{{trans('panel.status_disabled')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="" class="">{{trans('panel.sort')}}</label>
                                        <input type="number" class="form-control" name="sort_order" placeholder="{{trans('panel.sort')}}" value="{{$category->sort_order}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="industry">{{trans('panel.industry')}}</label>
                                        <select class="custom-select form-control" name="industry_id" id="industry" >
                                            @foreach($industries as $item)
                                            <option value="{{$item->id}}" {{$category->industry_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
{{--                                        <div class="form-group col-sm-6">--}}
{{--                                            <label for="" class="">Code 1c</label>--}}
{{--                                            <input type="text" class="form-control" name="code_1c" placeholder="" value="{{$category->code_1c}}">--}}
{{--                                            @error('code_1c')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                        </div>--}}
                                        <div class="form-group col-sm-4">
                                            <label for="tags_ro">Tags Ro</label>
                                            <select class="custom-select form-control category_tags_select" name="tags_ro[]" id="tags_ro" multiple="multiple" >
                                                @if($category->tags_ro)
                                                @foreach(json_decode($category->tags_ro) as $item)
                                                    <option value="{{$item}}" selected>{{$item}}</option>
                                                @endforeach
                                                 @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="tags_ru">Tags Ru</label>
                                            <select class="custom-select form-control category_tags_select" name="tags_ru[]" id="tags_ru" multiple="multiple" >
                                                @if($category->tags_ru)
                                                    @foreach(json_decode($category->tags_ru) as $item)
                                                        <option value="{{$item}}" selected>{{$item}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="tags_en">Tags En</label>
                                            <select class="custom-select form-control category_tags_select" name="tags_en[]" id="tags_en" multiple="multiple" >
                                                @if($category->tags_en)
                                                    @foreach(json_decode($category->tags_en) as $item)
                                                        <option value="{{$item}}" selected>{{$item}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                @include("panel.components.forms.name",["title" => trans('panel.category_name'), "placeholder" => trans('panel.category_name'), "valueRo" => $category->name_ro, "valueRu" => $category->name_ru, "valueEn" => $category->name_en])
                                @include("panel.components.forms.description",["title" => trans('panel.category_description'), "placeholder" => trans('panel.category_description'), "valueRo" => $category->description_ro, "valueRu" => $category->description_ru, "valueEn" => $category->description_en])


                            </div>
                            <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form_block row mb-3 ">

                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="previewImage">{{trans('panel.upload_preview_image')}}</label>
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
                                            @if($category->image_preview)
                                                <a href="{{url('storage/'.$category->image_preview)}}" data-fancybox >
                                                <img id="image_preview" src="{{url('storage/'.$category->image_preview)}}" alt="Preview category image" class="added_preview_image " onclick="" style="width: 300px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="mainImage">{{trans('panel.upload_main_image')}}</label>
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
                                            @if($category->image_main)
                                                <a href="{{url('storage/'.$category->image_main)}}" data-fancybox >
                                                <img id="image_main" src="{{url('storage/'.$category->image_main)}}" alt="Preview category image" class="added_main_image " onclick="" style="width: 500px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade " id="products" role="tabpanel" aria-labelledby="products-tab">

                                <div class="form_block row mb-3">
                                    <div class="row mb-4 align-items-start">

                                        <div class="col-sm-8">
                                            <h1 class="m-0">{{trans('panel.inspiration_products')}}</h1>
                                        </div><!-- /.col -->
                                        <div class="col-sm-4 d-flex justify-content-end">
                                            <a href="{{route('category.createCategoryProducts', [$category->industry_id, $category->id])}}" class="btn btn-outline-primary mr-5 px-3 ">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <section class="content">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-hover text-nowrap" id="featureTable">
                                                        <thead>
                                                        <tr>
                                                            <th>{{trans('panel.category')}}</th>
                                                            <th>{{trans('panel.products')}}</th>
                                                            <th>{{trans('panel.action')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($categoryIdeas as $item)

                                                            @if(count($item['addProducts']) >0)


                                                                <tr >
                                                                    <td> {{$item->name_ro}}</td>
                                                                    <td>
                                                                        @foreach($item['addProducts'] as $product)
                                                                            <a class="mr-2" href="{{route('product.show', $product->id)}}">{{$product->name_ro}}</a>


                                                                        @endforeach
                                                                    </td>


                                                                    <td class="d-flex">
                                                                        <div class="mr-2">
                                                                            <a href="{{route('category.editCategoryProducts', [$item->id, $category->industry_id, $category->id])}}" class="btn btn-sm btn-warning">
                                                                                <i class="fas fa-edit"></i>
                                                                            </a>
                                                                        </div>

{{--                                                                        <form action="{{route('category.deleteCategoryProducts', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">--}}
{{--                                                                            @csrf--}}
{{--                                                                            @method(('delete'))--}}
                                                                            <button type="submit" name="delete" value="{{$item->id}}" class="btn btn-sm btn-danger">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
{{--                                                                        </form>--}}

                                                                    </td>

                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div><!-- /.container-fluid -->
                                    </section>

                                </div>



                            </div>



                        </div>


                        <div class="form-group text-center d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" id="saveBtn" name="update" value="{{trans('panel.save')}}">
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

                $(".category_tags_select").select2({
                    tags: true,

                })


                Fancybox.bind("[data-fancybox]", {
                    // Your custom options
                });
                // Fancybox.bind("[data-gallery]", {
                //     // Your custom options
                // });

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
