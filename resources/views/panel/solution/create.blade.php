@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('solution')}}" class="btn btn-secondary" >
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
                    <form action="{{route('solution.store')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" name="created_by" value="{{\Illuminate\Support\Facades\Auth::id()}}" >
                        <input name="items" id='items' type="hidden">

                                <div class="form_block mb-3">
                                    <div class="row mb-2 align-items-center">
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="status">Status</label>
                                            <select class="custom-select form-control" name="status" id="status" >
                                                <option value="1" selected>Activat</option>
                                                <option value="0">Dezactivat</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                                            <label for="industry">Industrie</label>
                                            <select class="custom-select select2 form-control" name="industry_id" id="industry" >
                                                @foreach($industries as $item)
                                                    <option {{$item->id == 4 ? 'selected' : ''}} value="{{$item->id}}" >{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="category">Categorie</label>
                                            <select class="custom-select select2 form-control" name="category_id" id="category" >
                                                @foreach($solutionCategories as $item)
                                                    <option value="{{$item->id}}" >{{$item->name_ro}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-check col-lg-3 col-sm-6 " style="padding-left: 35px">
                                            <input class="form-check-input" type="checkbox" value="1" name="main_page" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Arată la pagina principală
                                            </label>
                                        </div>
                                        <div class="form-group col-lg-3 col-sm-6">
                                            <label for="ratio">Ratio</label>
                                            <select class="custom-select select2 form-control" name="ratio_id" id="ratio" >
                                                @foreach($ratios as $item)
                                                    <option value="{{$item->id}}" >{{$item->value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>


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
                                            <p class="text-info">min size: 220x200</p>
                                            <p class="text-info">ratio: 1,1 : 1</p>
                                            <p class="text-info">formats: jpeg, png, webp</p>
                                        </div>


                                    </div>
                                    <div class="row mb-3 align-items-start">
                                        <div class="col-sm-4" id="products">
                                            <div class="form-group" >
                                                <label for="product">Producere</label>
                                                <select class="custom-select select2 form-control" onchange="getProduct(this)"  id="product" >
                                                    <option value="0" >Select product</option>
                                                    @foreach($products as $item)
                                                        <option value="{{$item->id}}" >{{$item->name_ro}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

{{--                                            <div class="form-group">--}}
{{--                                                <label for="coordinate-x">coordinate-x</label>--}}
{{--                                                <input type="number"  oninput="getProductX(this)" class="form-control" id="coordinate-x">--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="coordinate-y">coordinate-y</label>--}}
{{--                                                <input type="number" class="form-control" oninput="getProductY(this)" id="coordinate-y">--}}
{{--                                            </div>--}}
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-outline-primary" onclick="addInput()">Adauga product</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ml-3 d-flex flex-wrap position-relative" >
                                            <div style="width: 400px; position: relative" id="previewImageContainer" >
{{--                                                <div id="mydiv">--}}
{{--                                                    <div id="mydivheader">1</div>--}}
{{--                                                </div>--}}
                                                <div class="img_point align-items-center justify-content-center" id="img_point0" >
                                                    <span class="text-black " style="z-index: 50">1</span>
{{--                                                    <div id="img_point0header text-center" style="width: 100%; height: 100%">1</div>--}}
                                                </div>
                                            </div>

                                        </div>
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
                const element = document.getElementById('img_point0');


                let z = 0;
                const itemsInput = document.getElementById('items')
                const products = {!! $products !!};
                let items = [{
                    product_id: 0,
                    percent_x: 0,
                    percent_y: 0
                }]
                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })




                document.querySelectorAll('.img_point').forEach((item, key)=>{
                    console.log('item', item)
                    console.log('key', key)
                    mousedownEvent(item, key)
                })

                function mousedownEvent(item, j) {
                    item.addEventListener('mousedown', (event)=>{
                        const el = item;
                        console.log(el)
                        // const el = document.getElementById('img_point'+z)
                        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

                        function dragMouseDown(e) {
                            // e = e || window.event;
                            e.preventDefault();

                            // get the mouse cursor position at startup:
                            pos3 = e.clientX;
                            pos4 = e.clientY;

                            previewImageContainer.onmouseup = closeDragElement;
                            // call a function whenever the cursor moves:
                            previewImageContainer.onmousemove = elementDrag;
                        }
                        dragMouseDown(event)

                        function elementDrag(e) {
                            // e = e || window.event;

                            e.preventDefault();
                            // calculate the new cursor position:
                            pos1 = pos3 - e.clientX;
                            pos2 = pos4 - e.clientY;
                            pos3 = e.clientX;
                            pos4 = e.clientY;

                            // set the element's new position:
                            el.style.top = (el.offsetTop - pos2) + "px";
                            el.style.left = (el.offsetLeft - pos1) + "px";
                        }

                        function closeDragElement() {
                            /* stop moving when mouse button is released:*/

                            const top = el.style.top.replace('px', '')
                            const left = el.style.left.replace('px', '')
                            console.log(top)
                            console.log(left)
                            console.log(el.parentElement.clientHeight)
                            console.log(el.parentElement.clientWidth)

                            items[j]['percent_x'] = Math.round((left *100)/el.parentElement.clientWidth);
                            items[j]['percent_y'] = Math.round((top *100)/el.parentElement.clientHeight);
                            console.log(items)
                            // items[j]['percent_x'] =calcPercentX
                            previewImageContainer.onmouseup = null;
                            previewImageContainer.onmousemove = null;
                        }
                    })
                }

                function selectCompany() {
                    let industryId = $('#industry').find(":selected").val();

                    let industries = {!! json_encode($industries) !!};

                    let IndustryList = industries.find(item => item.id === Number(industryId))
                    const CategoryList = IndustryList.categories
                    console.log(CategoryList)
                    if(CategoryList) {
                        let options = "";
                        //идем по списку девайсов и на каждом создаем очередной option с соответствующими значениями
                        CategoryList.forEach(category=> {
                            console.log(category.id)
                            options += `<option value="${category.id}" >${category.name_ro}</option>`;
                        })

                        category.innerHTML = options;

                    }
                }



                $('#industry').on('change', event=>{
                    selectCompany()

                })

                function submitHandler() {
                    itemsInput.value = JSON.stringify(items)
                }
                // Добавление новых товаров
                function addInput() {
                    items.push({
                        product_id: products[0]['id'],
                        percent_x: 0,
                        percent_y: 0
                    })

                    const profile = document.getElementById('products');

                    const div = document.createElement('div');
                    div.classList = 'row ' + 'form-row--' + ++z;
                    div.innerHTML = `<div class="form-group" >
                                                <label for="product">Producere</label>
                                                <select class="custom-select select2 form-control" onchange="getProduct(this, z)"  id="product" >
                                                    ${products.map(function(item){
                      return  `<option value="${item['id']}" >${item['name_ro']}</option> `
                    })}
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger" onclick="delInput()">Șterge product</button>
                    <button type="button" class="btn btn-outline-primary" onclick="addInput()">Adauga product</button>
                </div>`;
                    profile.appendChild(div);
                    const imageContainer = document.createElement('div')
                    imageContainer.classList = 'img_point d-flex align-items-center justify-content-center';
                    imageContainer.setAttribute("id", `img_point${z}`);
                    imageContainer.innerHTML = `<span class="text-black " style="z-index: 50">${z+1}</span>`
                    previewImageContainer.appendChild(imageContainer)

                    document.querySelectorAll('.img_point').forEach((item, key)=>{
                        console.log('item', item)
                        mousedownEvent(item, key)
                    })
                    // itemsInput.value = z;
                }

                function delInput() {
                    var div = document.querySelector('.form-row--' + z);
                    const imageContainer =document.getElementById(`img_point${z}`)
                    // console.log(productPrice.value)
                    div.remove();
                    imageContainer.remove();
                    items.splice(z, 1);
                    const index = items.indexOf(z);
                    if (index > -1) {
                        items.splice(index, 1);
                    }
                    --z;
                }

                function getProduct(input, j=0) {
                  document.getElementById('img_point'+j).style.display='flex'
                    // dragElement(document.getElementById("img_point0"));
                    // document.getElementById("mydiv").style.display = 'block'
                    items[j]['product_id'] = input.value

                    itemsInput.value = JSON.stringify(items)
                }
                // function getProductX(input, j=0) {
                //     items[j]['percent_x'] = input.value
                //
                //     document.getElementById(`img_point${j}`).style.left=`${input.value}%`
                //     itemsInput.value = JSON.stringify(items)
                //
                // }
                // function getProductY(input, j=0) {
                //     items[j]['percent_y'] = input.value
                //     document.getElementById(`img_point${j}`).style.bottom=`${input.value}%`
                //     itemsInput.value = JSON.stringify(items)
                // }

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


        .img_point {
            position: absolute;
            display: none;
            cursor: move;
            z-index: 20;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            top: 40px;
            left: 40px;
            background: #ffffff50;

            border-color: #fff;



        }

        .img_point::after {
            position: absolute;
            display: block;
            content: '';
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #fff;
            /*background: red;*/
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: .3s ease-in-out;
        }
        .img_point:hover {
            border: 1px solid #fff;

        }
        .img_point:hover::after {
            width: 10px;
            height: 10px;
        }



    </style>
@endsection
