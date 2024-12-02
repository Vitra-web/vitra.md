@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('resolve')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$resolve->name_ro}}</h1>
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
                    <form action="{{route('resolve.update', $resolve->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input name="items" id='items' type="hidden">


                        @include("panel.components.forms.name",["title" => "Numele soluții", "placeholder" => "Numele soluții", "valueRo" => $resolve->name_ro, "valueRu" => $resolve->name_ru, "valueEn" => $resolve->name_en])



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
                                    <p class="text-info">min size: 300x300</p>
                                    <p class="text-info">ratio: 1 : 1</p>
                                    <p class="text-info">formats: jpeg, png, webp</p>
                                </div>
                                <div class="col-sm-5 ml-3 d-flex flex-wrap position-relative" >
                                    <div style="width: 400px; position: relative" id="previewImageContainer">
                                        @if($resolve->image)
                                            <a href="{{url('storage/'.$resolve->image)}}" data-fancybox data-caption="Single image">
                                                <img id="image" src="{{url('storage/'.$resolve->image)}}" alt="Preview solution image" class="added_preview_image " style="width: 400px">
                                            </a>
                                        @endif

                                    </div>

                                </div>

                            </div>
                            <div class="row mb-3 align-items-start">
                                <div class="row" id="products">
                                    <div class="form-group col-lg-2 col-sm-6" data-select2-id="1">
                                        <label for="industry">Industrie</label>
                                        <select class="custom-select select2 form-control" id="industry" >
                                            <option value="0" >Toate</option>
                                            @foreach($industries as $item)
                                                <option value="{{$item->id}}" >{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 col-sm-6">
                                        <label for="category">Categorie</label>
                                        <select class="custom-select select2 form-control"  id="category" >

                                        </select>
                                    </div>

                                    <div class="col-lg-2 col-sm-6 form-group" >
                                        <label for="product">Producere</label>
                                        <div class="d-flex">
                                            <select class="custom-select select2 form-control" id="product" >
                                                <option value="0" >Select product</option>
                                                @foreach($products as $item)
                                                    <option value="{{$item->id}}" >{{$item->name_ro}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>


                                    <div class="col-lg-2 col-sm-2 d-flex align-items-end " style="margin-bottom: 1rem">
                                        <button type="button" class="btn btn-outline-primary" onclick="addProduct()">Adauga product</button>
                                    </div>
                                </div>

                            </div>

                            <div class="products_table">
                                <table class="table table-hover text-nowrap" id="crudTable">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Numele</th>


                                        <th>Acțiune</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    @foreach($resolveProducts as $item)
                                        <tr >

                                            <td>
                                                <img src="{{url('storage/'.$item->image_preview)}}" alt="Solution image" width="100px">
                                            </td>

                                            <td> {{$item->name_ro}}</td>


                                            <td class="d-flex">
                                                <div class="mr-2">
                                                    <a href="{{route('product.show', $item->id)}}" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>


{{--                                                <form action="{{route('resolve.deleteProduct',[$resolve->id, $item->id])}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">--}}
{{--                                                    @csrf--}}
{{--                                                    @method(('delete'))--}}
                                                    <button type="submit" name="delete" value="{{$item->id}}" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
{{--                                                </form>--}}

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>



                        <div class="form-group text-center d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" id="saveBtn" name="update" onclick="submitHandler()" value="Save">
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
{{--            <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>--}}


            <script>
                const selectImagePreview =  document.getElementById('previewImage');
                const previewImageContainer = document.getElementById('previewImageContainer');
                const category = document.getElementById('category');
                const product = document.getElementById('product');
                const tableBody = document.getElementById('tableBody');
                const itemsInput = document.getElementById('items')
                const products = {!! $products !!};

                let items = []




                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })


            function submitHandler() {
                itemsInput.value = JSON.stringify(items)
                document.querySelector('.spinner-border').style.display = 'block';
            }
                function selectSubcategory() {
                    let categoryId = $('#category').find(":selected").val();

                    let categories = {!! json_encode($categoriesAll) !!};

                    let categoryList = categories.find(item => item.id === Number(categoryId))
                    const CategoryList = categoryList.products

                    if(CategoryList) {
                        let options = "";
                        //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                        CategoryList.forEach(category=> {
                            options += `<option value="${category.id}" >${category.name_ro}</option>`;
                        })

                        product.innerHTML = options;
                    }
                }

                // selectCategory()
                // selectSubcategory()

                $('#industry').on('change', event=>{
                    selectCategory()

                })
                $('#category').on('change', event=>{
                    selectSubcategory()

                })
                function addProduct() {
                    const productId = $('#product').find(":selected").val();
                    items.push({
                        product_id: productId,
                    })

                    let productItem = products.find(item => item.id === Number(productId))

                    const tableRow = document.createElement('tr');
                    tableRow.id= 'productRow'+productItem['id'];

                    tableRow.innerHTML = `<td>
                                                <img src="/storage/${productItem['image_preview']}" alt="Solution image" width="100px">
                                            </td>
                                            <td> ${productItem['name_ro']}</td>
                                            <td class="d-flex">
                                                <div class="mr-2">
                                                    <a href="/panel/product/${productItem['id']}" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <button type="button" onclick="deleteProduct(${productItem['id']})" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                        </td>`;
                    tableBody.appendChild(tableRow);

                }

                function deleteProduct(productId) {
                    document.getElementById('productRow'+productId).remove();
                    items = items.filter(item => item.product_id !== String(productId))
                    console.log(items)
                }

                Fancybox.bind("[data-fancybox]", {
                    // Your custom options
                });
                Fancybox.bind("[data-gallery]", {
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
                                image.alt = "Preview portfolio image";
                                image.classList.add('added_preview_image');
                                image.style.width = "400px";
                                previewImageContainer.append(image);

                            }
                        }
                    }
                }








            </script>
    @endpush


        @section('after_styles')

            <style>

            </style>

@endsection
