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
                        <h1 class="m-0">{{$industry->name_ro}}</h1>
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
                    <form action="{{route('industry.update', $industry->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active fs-5" id="common-tab" data-toggle="tab" href="#common" role="tab" aria-controls="common" aria-selected="true">
                                    {{trans('panel.common')}}
                                </a>
                                <a class="nav-item nav-link fs-5" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">
                                    {{trans('panel.products')}}
                                </a>

                            </div>
                        </nav>

                        <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">

                                <div class="form_block row mb-3">
                                    <div class="form-group col-sm-4">
                                        <label for="sort_order" class="">{{trans('panel.sort')}}</label>
                                        <input type="number" class="form-control" id="sort_order" name="sort_order" placeholder="{{trans('panel.sort')}}" value="{{$industry->sort_order}}">
                                        @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                    <div class=" form-group col-sm-4">
                                        <label for="name">
                                            {{trans('panel.industry_name')}}
                                        </label>
                                        <input type="text" class="form-control ml-2" name="name" id="name"  placeholder="{{trans('panel.industry_name')}} Ro" value="{{$industry->name}}">
                                        @error('name')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                    <div class=" form-group col-sm-4">
                                        <label for="color">
                                            {{trans('panel.color')}}
                                        </label>
                                        <input type="text" id="color" class="form-control ml-2" name="color"   placeholder="{{trans('panel.color')}}" value="{{$industry->color}}">
                                        @error('color')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                </div>

                                <div class="form_block row mb-3 ">

                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="previewImage">{{trans('panel.upload_preview_image')}} </label>
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
                                            @if($industry->image_preview)
                                                <img id="image_preview" src="{{url('storage/'.$industry->image_preview)}}" alt="Preview category image" class="added_preview_image " onclick="" style="width: 300px">

                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-group col-sm-4 ">
                                            <label  class="col-form-label" for="pdf">{{trans('panel.upload_catalog')}}</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" name="pdf" class="form-control" id="pdf" >
                                                </div>
                                            </div>
                                            @error('pdf')<p class="text-danger"> {{$message}}</p>@enderror
                                            <p class="text-info">formats: pdf</p>
                                        </div>
                                        <div class="col-sm-6 ml-3 " >
                                            @if($industry->pdf)
                                                <img id="image_main" src="{{asset('images/1.png')}}" alt="Preview pdf" class=" " style="width: 100px">

                                            @endif
                                        </div>
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
        {{--                                    @if($industry->image_main)--}}
        {{--                                        <img id="image_main" src="{{url('storage/'.$industry->image_main)}}" alt="Preview category image" class="added_main_image " onclick="" style="width: 300px">--}}

        {{--                                    @endif--}}
        {{--                                </div>--}}
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
                                            <a href="{{route('industry.createCategoryProducts', $industry->id)}}" class="btn btn-outline-primary mr-5 px-3 ">
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
                                                        @foreach($industryCategories as $item)

                                                            @if(count($item['addProducts']) >0)

                                                            <tr >
                                                                <td> {{$item->name_ro}}</td>
                                                                <td>
                                                                    @foreach($item['addProducts'] as $product)
                                                                      <a class="mr-2" href="{{route('product.show', $product->id)}}">{{$product->name_ro}}</a>/


                                                                    @endforeach
                                                                </td>


                                                                <td class="d-flex">
                                                                    <div class="mr-2">
                                                                        <a href="{{route('industry.editCategoryProducts', [$item->id, $industry->id])}}" class="btn btn-sm btn-warning">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    </div>
                                                                        <button type="submit" name="delete" value="{{$item->id}}" class="btn btn-sm btn-danger">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>

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

                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" name="update" value="{{trans('panel.save')}}">
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
                // const selectImageMain =  document.getElementById('mainImage');
                const previewImageContainer = document.getElementById('previewImageContainer');
                // const mainImageContainer = document.getElementById('mainImageContainer');

                const table = $('#featureTable').DataTable({
                    "language": {
                        "lengthMenu": "_MENU_  elemente pe pagină",
                        "info": "Arătată _START_ pînă la _END_ de la _TOTAL_ elemente",
                        "search": "Căutare:",
                        "paginate": {
                            "first": "First",
                            "last": "Last",
                            "next": ">",
                            "previous": "<"
                        }
                    },

                    "columnDefs": [
                        { "orderable": false, "targets": [2] }
                    ]
                });
                table.buttons( '.export' ).remove();

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

                // selectImageMain.onchange = evt => {
                //     const imgs = document.querySelectorAll('.added_main_image')
                //     if (imgs) {
                //         imgs.forEach(img => {
                //             img.remove()
                //         })
                //
                //     }
                //     const files = selectImageMain.files
                //     let imagesArray = []
                //
                //     for (let i = 0; i < files.length; i++) {
                //         if (files[i].type === 'image/jpeg' || files[i].type === 'image/png'|| files[i].type === 'image/webp') {
                //             imagesArray.push(files[i])
                //             if (files[i]) {
                //                 const image = document.createElement("img");
                //                 image.src = URL.createObjectURL(files[i]);
                //                 image.alt = "Main category image";
                //                 image.classList.add('added_main_image');
                //                 image.style.width = "300px";
                //                 image.style.marginBottom = "20px";
                //                 image.style.marginRight = "20px";
                //                 mainImageContainer.append(image);
                //             }
                //         }
                //     }
                // }

            </script>
    @endpush
