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
                        <h1 class="m-0">{{$solution->name_ro}}</h1>
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
                    <form action="{{route('solution.update', $solution->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input name="items" id='items' type="hidden">


                        <div class="modal-view__descr modal" id="modal">
                            <div class="modal-title__body justify-content-end">

                                <button id="close__dialog" class="close__dialog">
                                    <svg width="800px" height="800px" viewBox="-0.5 0 25 25" fill="black" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 21.32L21 3.32001" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3 3.32001L21 21.32" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-sm-6">
                                    <div style="width: 580px; position: relative" id="previewImageContainer">
                                        <img src="{{url('storage/'.$solution->image)}}" alt="Solution Image" class="modal-body__img">
                                    </div>
                                    @foreach($solutionProducts as $key=>$solutionProduct)
                                        @if($solution->id == $solutionProduct->solution_id)
                                            <div class="modal_point d-flex align-items-center justify-content-center" id="modal_point{{$key}}" style="top: {{$solutionProduct->percent_y}}%; left: {{$solutionProduct->percent_x}}%">
                                                <span class="text-black " style="z-index: 50">{{$key+1}}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="row justify-content-end mt-4">
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-primary" onclick="submitHandler()" name="update" value="Save">Save</button>
                                        </div>
                                        {{--                        <div class="col-4">--}}
                                        {{--                            <button class="btn btn-secondary" onclick="submitHandler()" >Save</button>--}}
                                        {{--                        </div>--}}
                                    </div>
                                </div>

                                <div class="modal-body__items col-sm-6">
                                    @foreach($solutionProducts as $solutionProduct)
                                        @if($solution->id == $solutionProduct->solution_id)
                                            <div class="modal-body__items-item modal-item row">
                                                <div class="col-4">
                                                    <img src="{{url('storage/'.$solutionProduct->product->image_preview)}}" alt="Product image" class="modal-item__img">

                                                </div>

                                                <div class="modal-item__descr col-4">
                                                    <h3 class="modal-item__descr-title">{{$language->replace($solutionProduct->product->name_ro, $solutionProduct->product->name_ru,$solutionProduct->product->name_en )}}</h3>

                                                </div>
                                                <div class="modal-item__actions col-4">
                                                    <button type="submit" name="delete" value="{{$solutionProduct->product_id}}" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
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

                let z =Number({{count($solutionProducts)-1}});
                const itemsInput = document.getElementById('items')
                const products = {!! $products !!};
                const solutionProducts = {!! $solutionProducts !!};
                let items = []
                solutionProducts.forEach(solutionProduct=>{
                    const product = {
                        product_id: solutionProduct['product_id'],
                        percent_x: solutionProduct['percent_x'],
                        percent_y: solutionProduct['percent_y']
                    }
                    items.push(product)
                })

                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                function mousedownEvent( item, j) {
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

                document.querySelectorAll('.img_point').forEach((item, key)=>{

                    // itemsInput.value = JSON.stringify(mousedownEvent(items, item, key))
                    mousedownEvent( item, key)

                })

            function submitHandler() {
                itemsInput.value = JSON.stringify(items)
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
                                                <label for="product">Producere ${z+1}</label>
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
                        mousedownEvent( item, key)
                    })
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

                    items[j]['product_id'] = input.value

                    itemsInput.value = JSON.stringify(items)
                }
                // function getProductX(input, j=0) {
                //
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



            </script>
    @endpush


        @section('after_styles')

            <style>
                {!! Vite::content('resources/sass/style.scss') !!}
            </style>
            <style>

                .img_point__body--code span {
                    font-family: 'GalanoGrotesque-Bold', sans-serif;
                }

                .img_point__body--btn a{

                    display: block;
                    width: 100%;
                    font-family: 'GalanoGrotesque-Medium', sans-serif;
                    font-size: 14px;
                    color: #000;
                    background-color: #e8e8e8;
                    text-align: center;
                    padding: 15px 10px;

                }

                .modal_point {
                    position: absolute;
                    display: block;
                    cursor: move;
                    border-radius: 50%;
                    width: 30px;
                    height: 30px;
                    top: 10%;
                    left: 10%;
                    background: #ffffff50;
                    border-color: #fff;

                }

                .modal_point::after {
                    position: absolute;
                    display: block;
                    content: '';
                    width: 15px;
                    height: 15px;
                    border-radius: 50%;
                    background: #fff;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    transition: .3s ease-in-out;
                }
                .modal_point:hover {
                    border: 1px solid #fff;

                }
                .modal_point:hover::after {
                    width: 10px;
                    height: 10px;
                }


                .modal_point__body--info-title a {
                    font-size: 16px;
                    color: #333232;
                    max-width: 100px;
                }



                .modal_point__body--code span {
                    font-family: 'GalanoGrotesque-Bold', sans-serif;
                }

                .modal_point__body--btn a{

                    display: block;
                    width: 100%;
                    font-family: 'GalanoGrotesque-Medium', sans-serif;
                    font-size: 14px;
                    color: #000;
                    background-color: #e8e8e8;
                    text-align: center;
                    padding: 15px 10px;

                }
            </style>

@endsection
