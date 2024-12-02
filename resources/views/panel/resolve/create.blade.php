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
                    <form action="{{route('resolve.store')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf


                        <input name="items" id='items' type="hidden">

                        @include("panel.components.forms.name",["title" => "Numele soluții", "placeholder" => "Numele soluții", "valueRo" => old('name_ro'), "valueRu" => old('name_ru'), "valueEn" => old('name_en')])



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

                                        <div class="col-sm-6 ml-3 d-flex flex-wrap position-relative" >
                                            <div style="width: 400px; position: relative" id="previewImageContainer" >

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

                                            </tbody>
                                        </table>

                                    </div>

                                </div>


                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" onclick="submitHandler()" value="Save">
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
                const category = document.getElementById('category');
                const product = document.getElementById('product');
                const tableBody = document.getElementById('tableBody');



                let z = 0;
                const itemsInput = document.getElementById('items')
                const products = {!! $products !!};
                let items = []
                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })


                function selectCategory() {

                    let industryId = $('#industry').find(":selected").val();
                    console.log(industryId)

                    if(industryId === '0') {
                        let options = "";

                        products.forEach(item=> {
                            options += `<option value="${item.id}" >${item.name_ro}</option>`;
                        })

                        product.innerHTML = options;
                    } else {
                        let industries = {!! json_encode($industriesAll) !!};

                        let IndustryList = industries.find(item => item.id === Number(industryId))

                        const CategoryList = IndustryList.categories
                        const ProductList = IndustryList.products

                        if(CategoryList) {
                            let options = "";
                            //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                            CategoryList.forEach(category=> {

                                options += `<option value="${category.id}" >${category.name_ro}</option>`;
                            })

                            category.innerHTML = options;

                        }



                        if(ProductList) {
                            let options = "";
                            //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                            ProductList.forEach(item=> {
                                options += `<option value="${item.id}" >${item.name_ro}</option>`;
                            })

                            product.innerHTML = options;
                        }
                    }



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



                function submitHandler() {
                    itemsInput.value = JSON.stringify(items)
                }
                // Добавление новых товаров
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




                selectImagePreview.onchange = evt => {
                    const imgs = document.querySelectorAll('.added_preview_image')
                    if (imgs) {
                        imgs.forEach(img => {
                            img.remove()
                        })

                    }
                    const files = selectImagePreview.files

                    let imagesArray = []
                    // console.log(files)
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
                            imagesArray.push(files[i])
                            if (files[i]) {
                                const image = document.createElement("img");
                                image.src = URL.createObjectURL(files[i]);
                                image.alt = "Preview solution image";
                                image.classList.add('added_preview_image');
                                image.style.width = "400px";
                                // image.style.marginBottom = "20px";
                                // image.style.marginRight = "20px";
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
