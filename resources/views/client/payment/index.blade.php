@extends('layouts.client2')

@section('content')
<main style="padding-top: 120px">

    @include('client.components.breadСrumbs')

    <section class="checkout-form checkout-form__section">
        <div class="custom-container checkout-form__container">
            <form action="{{route('client.postOrder')}}" method="post" id="orderForm">
                <input type="hidden" name="phone" id="phoneHidden">
                <input type="hidden" name="paymentType" id="paymentType">
                <input type="hidden" name="products" id="productsHidden">
                <input type="hidden" name="priceProducts" id="priceProductsHidden">
                <input type="hidden" name="priceDelivery" id="priceDeliveryHidden">
                <input type="hidden" name="priceTotal" id="priceTotalHidden">
            <div class="checkout-form__body payment-order__body row">

                    @csrf
                <div class="col-xl-9">
                    <div class="payment_form" id="deliveryAddressContent">
                        <h2 class="checkout-form__title" id="deliveryAddressTitle">
                            {!! trans('labels.where_sent_order') !!}
                        </h2>

                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="payment-checkout" >

                                    <h4 class="checkout-form__instructions">{!! trans('labels.order_type') !!}</h4>
                                    <div class="checkbox_container ps-4 mb-4">
                                        <label for="city" class="delivery-select-container">
                                            <select class=" form-select select2 " name="location" id="location" >
                                                <option value="0" selected disabled >{{trans('labels.choose_location')}}</option>
                                                <option value="Chișinău" data-region="Municipiul Chișinău">Chișinău</option>
                                            </select>
                                        </label>
                                        <p class="text_error" id="location_danger"></p>
                                    </div>
                                    <div class="payment-checkout_block">
                                        <div class="d-flex align-items-center ">
                                            <label class="checkbox__item ">
                                                <input type="radio" name="deliveryType" autocomplete="off" value="1" class="checkbox__input" id="vitraCheckbox">
                                                <span class="fake" id="vitraFake"></span>
                                                <span class="delivery_type_title">{!! trans('labels.vitra_delivery') !!}</span>
                                            </label>
                                            <div class="information_block_container" >
                                                <div class="information_block">
                                                    <p class="mb-2">{!! trans('labels.delivery_time_descr') !!}</p>

                                                </div>
                                                <img class="information_image" onclick="informationHandler(this)" src="/images/product/information-button.png" alt="information-button">
                                            </div>

                                        </div>
                                        <p class="checkbox__item_description">{!! trans('labels.delivery_time') !!}</p>
                                    </div>
                                    <div class="payment-checkout_block">
                                        <div class="d-flex align-items-center ">
                                            <label class="checkbox__item ">
                                                <input type="radio" name="deliveryType" autocomplete="off" value="2" class="checkbox__input" id="novaposhtaCheckbox">
                                                <span class="fake" id="novaposhtaFake"></span>
                                                <span class="delivery_type_title">{!! trans('labels.courier_delivery') !!}</span>
                                            </label>


                                            <div class="information_block_container" >
                                                <div class="information_block">
                                                    <p class="mb-2">{!! trans('labels.delivery_time_np') !!}</p>
                                                    <p>{!! trans('labels.delivery_time_np_descr') !!}</p>

                                                </div>
                                                <img class="information_image" onclick="informationHandler(this)" src="/images/product/information-button.png" alt="information-button">
                                            </div>
                                        </div>
                                        <p class="checkbox__item_description">{!! trans('labels.delivery_time_np') !!}</p>
                                    </div>
                                    <div class="payment-checkout_block">
                                        <div class="d-flex align-items-center  ">
                                        <label class="checkbox__item ">
                                            <input type="radio" name="deliveryType" autocomplete="off" value="3" class="checkbox__input" id="">
                                            <span class="fake"></span>
                                            <span class="delivery_type_title">{!! trans('labels.store_pickup') !!}</span>
                                        </label>

                                        <div class="information_block_container" >
                                            <div class="information_block">
                                                <p>{!! trans('labels.delivery_anytime_descr') !!}</p>
                                            </div>
                                            <img class="information_image" onclick="informationHandler(this)" src="/images/product/information-button.png" alt="information-button">
                                        </div>
                                    </div>
                                        <p class="checkbox__item_description">{!! trans('labels.delivery_anytime') !!}</p>
                                    </div>

                                    <p class="text_error" id="delivery_danger"></p>


                                </div>
                            </div>
                            <div class="col-md-7" id="deliveryTypeForm">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <img class="delivery_icon" src="/images/product/delivery-2.png" alt="delivery-icon">
                                </div>

{{--                                <p class="checkout-form__instructions">{{trans('labels.sent_address')}}</p>--}}
{{--                                <div class="payment-name-container row p-0">--}}
{{--                                    <label for="name" class="col-sm-6 payment-name-label">--}}
{{--                                        <input id="name" name="name" type="text" class="steps-form__input-global"  value="{{old('name')}}" placeholder="{{trans('labels.name')}}">--}}
{{--                                        <p class="text_error" id="name_danger"></p>--}}
{{--                                        @error('name')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                    </label>--}}
{{--                                    <label for="surname" class="col-sm-6 payment-name-label">--}}
{{--                                        <input id="surname" name="surname" type="text" class="steps-form__input-global"  value="{{old('surname')}}" placeholder="{{trans('labels.second_name')}}">--}}
{{--                                        <p class="text_error" id="surname_danger"></p>--}}
{{--                                        @error('surname')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                    </label>--}}

{{--                                    <label for="address" class="payment-name-label">--}}
{{--                                        <input id="address" name="address" type="text" class="steps-form__input-global"  value="{{old('address')}}" placeholder="{{trans('labels.address')}}">--}}
{{--                                        <p class="text_error" id="address_danger"></p>--}}
{{--                                        @error('address')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                    </label>--}}


{{--                                </div>--}}
{{--                                <label for="deliveryComments" class="w-100">--}}
{{--                                    <textarea rows="10" id="orderComments" name="comment" class="payment_form-textarea" placeholder="{{trans('labels.comment')}}"></textarea>--}}
{{--                                </label>--}}


{{--                                <h4 class="checkout-form__instructions">{{trans('labels.contacts')}}</h4>--}}
{{--                                <div class="payment-contacts-container">--}}
{{--                                    <label for="email" class="payment-data-label">--}}
{{--                                        <input id="email" name="email" type="text" class="steps-form__input-global"  value="{{old('email')}}"  placeholder="{{trans('labels.email')}}">--}}
{{--                                        <p class="text_error" id="email_danger"></p>--}}
{{--                                        @error('email')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                    </label>--}}
{{--                                    <label for="payment_phone" class="payment-data-label">--}}
{{--                                        <input id="payment_phone"  type="tel" class="steps-form__input-global"  value="{{old('phone')}}"  >--}}
{{--                                        <p class="text_error" id="phone_danger"></p>--}}
{{--                                        @error('phone')<p class="text-danger"> {{$message}}</p>@enderror--}}
{{--                                    </label>--}}

{{--                                </div>--}}



                            </div>

                        </div>
                        <p class="checkout-form__instructions ">{!! trans('labels.how_to_pay') !!}</p>
                        <div class="">
                            <div class="payment_form-buttons">
                                <button type="button" class="payment_form-buttons-btn active__number" data-type="1"><img src="{{url('images/checkout-img-btn1.png')}}" alt="">{{trans('labels.card_pay')}}</button>
                                <button type="button" class="payment_form-buttons-btn" data-type="2"><img src="{{url('images/checkout-img-btn2.png')}}" alt="">{{trans('labels.transfer_pay')}}</button>
                                <button type="button" class="payment_form-buttons-btn" data-type="3"><img src="{{url('images/checkout-img-btn3.png')}}" alt="">{{trans('labels.courier_pay')}}</button>
                            </div>
                            <div class="buttons_select_content">

                                <div class="card-details ">

                                </div>

                            </div>
                            <label class="checkbox__item mb-3">
                                <input type="checkbox" value="1" class="checkbox__input" id="collectionCheckbox">
                                <span class="fake"></span>
                                <span class="checkbox_text payment_checkbox_text">{{trans('labels.accept_checkbox2')}}</span>
                            </label>
                            <label class="checkbox__item">
                                <input type="checkbox"  value="1" class="checkbox__input" id="policyCheckbox">
                                <span class="fake"></span>
                                <span class="checkbox_text payment_checkbox_text">{{trans('labels.accept_checkbox3')}} <a href="{{route('client.policy')}}" target="_blank" class="checkbox_link">{{trans('labels.policy')}}</a> ViTRA.</span>
                            </label>
                            <p class="text_error" id="policy_danger"></p>
                        </div>


                    </div >

                </div>

{{--                right block--}}

                <div class="payment-order__checkout  col-xl-3">

                    <div class="basket-checkout">
                    <h4 class="basket-checkout__title">{{trans('labels.sum_order')}}</h4>
                        <div class="products_basket_container">
                            @if(count($products) > 0)
                                @foreach($products as $product)
                                    <div class="row products_basket_block">
                                        <div class="col-4 ps-0 ">
                                            <img class="products_basket_image" src=" {{url('storage/'.$product['product']['image_preview'])}}" alt="">
                                        </div>
                                        <div class="col-8 d-flex flex-column justify-content-between p-0">
                                            <p class="products_basket_title">{{$product['product']['name_ro']}}</p>
                                            <div class="products_basket__text ">
                                                <p class="products_basket__label ">{{trans('labels.product_code')}}:</p>
                                                <p class="products_basket__value">{{$product['product_variant']? $product['product_variant']['code'] : $product['product']['code_1c']}}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                @if($product['quantity'] >1)
                                                    <p class="products_basket__label">{{$product['quantity']}} produse</p>
                                                @else
                                                    <p></p>
                                                    @endif

                                                <p class="products_basket__price">{{$product['product_variant']? $product['product_variant']['price'] * $product['quantity']:$product['product']['price']* $product['quantity'] }}   MDL</p>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                                @endif
                        </div>

                    <div class="basket-checkout__info">
                        <div class="basket-checkout__info-text">
                            <p>{{trans('labels.products_price')}}</p>
                            <p class="tva_label">{{trans('labels.tva_include')}}</p>
                        </div>
                        <p class="basket-checkout__info-price price-body__nr">
                           <span class="price_count " id="priceProducts">0</span>
                           <span class="price-body__currency">MDL</span>
                        </p>
                    </div>
                    <div class="basket-checkout__info">
                        <p class="basket-checkout__info-text">{{trans('labels.delivery')}}</p>
                        <p class="basket-checkout__info-price price-body__nr">
                            <span  class="price_count" id="priceDelivery">0</span>
                            <span class="price-body__currency">MDL</span>
                        </p>
                    </div>
                    <div class="basket-checkout__total">
                        <p class="basket-checkout__total-text">{{trans('labels.total_order')}}</p>
                        <p class="basket-checkout__total-price price-body__nr">
                            <span  class="price_count " id="priceTotal">0</span>
                            <span class="price-body__currency">MDL</span>
                        </p>
                    </div>
                    <!-- Accordion -->
{{--                    <div class="coupon-accordion__body">--}}
{{--                        <div class="coupon-accordion__item">--}}
{{--                            <div class="coupon-accordion__item-trigger">--}}
{{--                                <div class="trigger__text coupon-accordion__text">--}}
{{--                                    {{trans('labels.enter_discount_code')}}--}}
{{--                                </div>--}}
{{--                                <div class="trigger__img coupon-accordion__img">--}}
{{--                                    <svg width="20px" height="20px" >--}}
{{--                                        <use href="/images/svg/select-arrow.svg#selectArrow"></use>--}}
{{--                                    </svg>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="accordion__item-content">--}}
{{--                                <div class="content__text">--}}
{{--                                    <p class="content__text-info">{{trans('labels.able_enter_discount_code')}}</p>--}}
{{--                                    <div class="content__text-buttons">--}}
{{--                                        <input type="text" class="accordion__item-content-input" placeholder="Cod" />--}}
{{--                                        <button type="button" class="accordion__item-content-btn">{{trans('labels.apply_discount')}}</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="d-flex justify-content-center">
                        <button type="button" onclick="payProducts()" class="custom-btn payment_btn">{{trans('labels.pay_products')}}</button>
                    </div>
                    </div>

                </div>

            </div>
            </form>
        </div>
    </section>



</main>

@endsection

@push('script')

    <script>
        let cityList = [];
        let productsPrice = 0;
        let distance = 0;
        let productsQuantity = 0;
        let deliveryPrice = 0;
        let weight = 0;
        let locationName = 'Chișinău';
        let itiPhone = null;
        const mapName = '{!! env('MAP_KEY') !!}';
        $('.select2').select2()

        $.ajax({
            url:     "https://map.md/api/companies/webmap/list_cities",
            method:  'GET',
            dataType: 'json',
            username: mapName,
            password: '',
            headers: {
                'Content-Type': 'application/json',
                "Authorization": "Basic " + btoa(mapName + ":" + '')
            },

        }).done(function (res) {
            console.log(res)
            cityList = res

            const markup = cityList.map(item => {
                if(item['name'] !=='Chișinău') {
                    return `<option value="${item['name']}" data-lat="${item['centroid']['lat']}" data-lon="${item['centroid']['lon']}" data-region="${item['is_in']}">${item['name']}</option>`
                }
            }).join('')

            document.getElementById('location').insertAdjacentHTML( 'beforeend',markup)

        });

        // $(document).ready(function() {
        //
        //
        // });
        const buttonsSelectContent = document.querySelector('.buttons_select_content')

        const labels = {
            'card_number': '{{trans('labels.card_number')}}',
            'card_user': '{{trans('labels.card_user')}}',
            'product_code': '{{trans('labels.product_code')}}',
            'sent_address': '{{trans('labels.sent_address')}}',
            'name': '{{trans('labels.name')}}',
            'second_name': '{{trans('labels.second_name')}}',
            'comment': '{{trans('labels.comment')}}',
            'address': '{{trans('labels.address')}}',
            'contacts': '{{trans('labels.contacts')}}',
            'email': '{{trans('labels.email')}}',
            'pickup_text': '{{trans('labels.pickup_text')}}',
            'pickup_text2': '{{trans('labels.pickup_text2')}}',

            'legal_entity': '{{trans('labels.legal_entity')}}',
            'payer_type_tva': '{{trans('labels.payer_type_tva')}}',
            'payer_type_no_tva': '{{trans('labels.payer_type_no_tva')}}',
            'tva': '{{trans('labels.tva')}}',
            'company': '{{trans('labels.company')}}',
            'legal_entity_address': '{{trans('labels.legal_entity_address')}}',
            'tax_code': '{{trans('labels.tax_code')}}',
            'physical_address': '{{trans('labels.physical_address')}}',
            'bank_name': '{{trans('labels.bank_name')}}',
            'bank_code': '{{trans('labels.bank_code')}}',
        }

        // const order = $.cookie('vitraOrder');
        const products = {!! json_encode($products) !!};

        // if(order) {
        //     const orderParsed = JSON.parse(order)
        //     $('#priceProducts').text(orderParsed.productsPrice)
        //     $('#priceTotal').text(orderParsed.productsPrice)
        // }


        products.forEach(product => {
            productsPrice += product['product']['price'] * product['quantity']

            productsQuantity += product['quantity']
            if(product['product_variant']) {
                if(product['product_variant']['weight']) {
                    weight+=Number(product['product_variant']['weight'].replace(',', '.'))
                }
                product['product']['specifications'] = [];
                product['product']['variants'] = [];


            } else {
                if(product['product']['weight']) {
                    weight+=Number(String(product['product']['weight']).replace(',', '.'))
                }
            }
            $('#priceProducts').text(productsPrice)
            $('#priceTotal').text(productsPrice)

        })

        // if(products) {
        //     console.log('products', products)
        //  document.querySelector('.products_basket_container').innerHTML =  products.map(product=>{
        //      console.log('product', product)
        //
        //         return `
        //         <div class="row products_basket_block">
        //             <div class="col-4 ps-0 ">
        //             <img class="products_basket_image" src="/storage/${product['product']['image_preview']}" alt="">
        //             </div>
        //             <div class="col-8 d-flex flex-column justify-content-between">
        //             <p class="products_basket_title">${product['product']['name_ro']}</p>
        //             <div class="products_basket__text ">
        //                 <p class="products_basket__label ">${labels.product_code}:</p>
        //                 <p class="products_basket__value">${product['product_variant']? product['product_variant']['code'] : product['product']['code_1c']}</p>
        //             </div>
        //             <div class="d-flex justify-content-between">
        //                 ${product['quantity'] > 1 ? `<p class="products_basket__label">${product['quantity']} produse</p>`: `<p></p>`}
        //                 <p class="products_basket__price">${product['product_variant']? product['product_variant']['price'] * product['quantity'] : product['product']['price'] * product['quantity']}  MDL</p>
        //             </div>
        //
        //             </div>
        //         </div>
        //         `
        //     }).join('')
        // }

        document.querySelectorAll(".payment_form-buttons-btn").forEach(item =>{
            item.addEventListener("click", function() {
                const currentActive = document.querySelector(".payment_form-buttons-btn.active__number");
                if (currentActive) {
                    currentActive.classList.remove("active__number");
                }
                this.classList.add("active__number");

                const type = this.dataset.type;
                if(type === '1') {
                    buttonsSelectContent.innerHTML = `
                    <div class="card-details ">

                        </div>
                    `
                } else if(type === '2') {
                    buttonsSelectContent.innerHTML = `
                    <div class="card-details ">
                                <label for="card_number" class="payment-data-label payment_select_container">
                                    <select name="juridic_type" id="juridic_type" class="steps-form__input-global payment_select">
                                        <option value="0" selected disabled hidden="">${labels.legal_entity}</option>
                                        <option value="1">${labels.payer_type_no_tva}</option>
                                        <option value="2">${labels.payer_type_tva}</option>
                                    </select>
                                        <p class="text_error" id="juridic_type_danger"></p>
                                    <svg width="20px" height="20px" >
                                        <use href="/images/svg/select-arrow.svg#selectArrow"></use>
                                    </svg>
                                    <p class="text_error" id="juridic_type_danger"></p>
                                </label>
                                <label for="company_name" class="payment-data-label">
                                    <input id="company_name" name="company_name" type="text" class="steps-form__input-global"  placeholder="${labels.company}"
                                       <p class="text_error" id="company_name_danger"></p>
                                </label>
                                <label for="tva" class="payment-data-label">
                                    <input id="tva" name="tva" type="text" class="steps-form__input-global"  placeholder="${labels.tva}">
                                    <p class="text_error" id="tva_danger"></p>
                                </label>
                                <label for="juridic_address" class="payment-data-label">
                                    <input id="juridic_address" name="juridic_address" type="text" class="steps-form__input-global"   placeholder="${labels.legal_entity_address}">
                                    <p class="text_error" id="juridic_address_danger"></p>
                                </label>

                                <label for="fiscal_code" class="payment-data-label">
                                    <input id="fiscal_code" name="fiscal_code" type="text" class="steps-form__input-global"   placeholder="${labels.tax_code}">
                                    <p class="text_error" id="fiscal_code_danger"></p>
                                </label>
                                <label for="physical_address" class="payment-data-label">
                                    <input id="physical_address" name="physical_address" type="text" class="steps-form__input-global"  placeholder="${labels.physical_address}">
                                    <p class="text_error" id="physical_address_danger"></p>
                                </label>

                                <label for="bank_name" class="payment-data-label">
                                    <input id="bank_name" name="bank_name" type="text" class="steps-form__input-global"  placeholder="${labels.bank_name}">
                                    <p class="text_error" id="bank_name_danger"></p>
                                </label>
                                <label for="bank_name" class="payment-data-label">
                                    <input id="bank_code" name="bank_code" type="text" class="steps-form__input-global"  placeholder="${labels.bank_code}">
                                    <p class="text_error" id="bank_code_danger"></p>
                                </label>
                                <label for="iban" class="payment-data-label">
                                    <input id="iban" name="iban" type="text" class="steps-form__input-global"  placeholder="IBAN">
                                    <p class="text_error" id="iban_danger"></p>
                                </label>

                            </div>
                    `
                } else {
                    buttonsSelectContent.innerHTML = `
                      <div class="cash_description">

                        </div>
                    `
                }

            });
        });

        function updateTotalPrice() {

            document.getElementById('priceProducts').textContent = String(productsPrice);
            document.getElementById('priceDelivery').textContent = String(deliveryPrice);
            document.getElementById('priceTotal').textContent = String(deliveryPrice >0 ? productsPrice + deliveryPrice :productsPrice );

            document.getElementById('priceDeliveryHidden').value = deliveryPrice;
            document.getElementById('priceTotalHidden').value = deliveryPrice >0 ? productsPrice + deliveryPrice :productsPrice;
        }

        function closeInformation(event) {

            if ( !event.target.classList.contains('information_block') && !event.target.classList.contains('information_block_container') && !event.target.classList.contains('information_image')) {
                document.querySelectorAll('.information_block').forEach(item => {
                    item.classList.remove('active');
                })
                window.removeEventListener('click', closeInformation)
            }
        }



        function informationHandler(el) {
            el.parentElement.querySelector('.information_block').classList.toggle('active')
            window.addEventListener('click', closeInformation)
        }

        $('#location').on('change', (event) =>{
            const latitude = $('#location').find(":selected").data('lat')
            const longitude = $('#location').find(":selected").data('lon')
            const region = $('#location').find(":selected").data('region')
            locationName = $('#location').find(":selected").text()

            if(locationName !== 'Chișinău') {

                $.ajax({
                    url:     "/define-destination?latitude="+latitude+"&longitude="+longitude,
                    method:  'GET',

                }).done(function (res) {
                    console.log(res)
                    distance = Math.round(res.result['rows'][0]['elements'][0]['distance'].value /1000);

                });
            }
        if(region === "Municipiul Chișinău") {
                $('#novaposhtaCheckbox').attr("disabled", true)
                $('#novaposhtaFake').removeClass('fake')
                $('#novaposhtaFake').addClass('fake_disabled')

            if($('#vitraCheckbox').attr("disabled")) {
                $('#vitraCheckbox').attr("disabled", false)
                $('#vitraFake').removeClass('fake_disabled')
                $('#vitraFake').addClass('fake')
            }
        } else {
            $('#vitraCheckbox').attr("disabled", true)
            $('#vitraFake').removeClass('fake')
            $('#vitraFake').addClass('fake_disabled')

            if($('#novaposhtaCheckbox').attr("disabled")) {
                $('#novaposhtaCheckbox').attr("disabled", false)
                $('#novaposhtaFake').removeClass('fake_disabled')
                $('#novaposhtaFake').addClass('fake')
            }
        }

        const deliveryValue = $('input[name = "deliveryType"]:checked').val();
            if(deliveryValue) {
                checkDeliveryType(deliveryValue)


            }

        })

        function checkDeliveryType(value) {
            let deliveryType = {};
            if(value === '1') {
                if(locationName === 'Chișinău') {
                    if(productsPrice <10000) {
                        if(weight <=50) {
                            deliveryPrice = 90;
                        } else if(weight>50 && weight <=100){
                            deliveryPrice = 200
                        } else {
                            deliveryPrice = 400
                        }
                    } else {
                        deliveryPrice =0;
                    }
                    deliveryType = {
                        'type': 1,
                        'value': {
                            'name':'Vitra-Chisinau',
                            'locationName': 'Chișinău'
                        }
                    }

                } else {
                    deliveryPrice = distance * 15;
                    deliveryType = {
                        'type': 1,
                        'value': {
                            'name':'Vitra-Chisinau',
                            'locationName': locationName
                        }
                    }
                }

            } else if(value === '2') {
                if(locationName === 'Chișinău') {
                    if(productsPrice >=10000) {
                        deliveryPrice = 0;

                    } else {
                        let cityDeliveryCost = 0;
                        if(weight <=30) {
                            if(weight<=2) {
                                cityDeliveryCost=29;
                            } else if(weight>2 && weight<=5) {
                                cityDeliveryCost = 39;
                            }else if(weight>5 && weight<=10) {
                                cityDeliveryCost = 49;
                            }else if(weight>10 && weight<=20) {
                                cityDeliveryCost = 59;
                            } else  {
                                cityDeliveryCost = 69;
                            }

                            deliveryPrice = cityDeliveryCost + 19;

                        } else {
                            deliveryPrice =( weight * 2) + 39;

                        }
                    }
                    deliveryType = {
                        'type': 2,
                        'value': {
                            'name':'Nova-Poshta',
                            'type': 1,
                            'locationName': 'Chișinău'

                        }
                    }

                } else {
                    let cityDeliveryCost = 0;
                    if(weight <=30) {
                        if(weight<=2) {
                            cityDeliveryCost=49;
                        } else if(weight>2 && weight<=5) {
                            cityDeliveryCost = 59;
                        }else if(weight>5 && weight<=10) {
                            cityDeliveryCost = 69;
                        }else if(weight>10 && weight<=20) {
                            cityDeliveryCost = 79;
                        } else  {
                            cityDeliveryCost = 89;
                        }

                        deliveryPrice = cityDeliveryCost + 19;

                    } else {
                        deliveryPrice =( weight * 3) + 39;

                    }

                    deliveryType = {
                        'type': 3,
                        'value': {
                            'name':'Nova-Poshta',
                            'type': 2,
                            'locationName': locationName

                        }
                    }

                }

            }  else if(value === '3') {
                deliveryPrice = 0;
                deliveryType = {
                    'type': 3,
                    'value': {
                        'name':'From-shop',
                    }
                }

            }
            localStorage.setItem('vitraDelivery', JSON.stringify(deliveryType))
            updateTotalPrice();
        }


        document.querySelectorAll('input[name = "deliveryType"]').forEach(item =>{
            item.addEventListener('change', (event)=>{
                const deliveryValue = event.target.value;
                checkDeliveryType(deliveryValue)

                if(deliveryValue === '1' || deliveryValue === '2') {
                    document.getElementById('deliveryTypeForm').innerHTML = `
                       <p class="checkout-form__instructions">${labels.sent_address}</p>
                    <div class="payment-name-container row p-0">
                        <label for="name" class="col-sm-6 payment-name-label">
                            <input id="name" name="name" type="text" class="steps-form__input-global"   placeholder="${labels.name}">
                            <p class="text_error" id="name_danger"></p>
                    </label>
                    <label for="surname" class="col-sm-6 payment-name-label">
                        <input id="surname" name="surname" type="text" class="steps-form__input-global"   placeholder="${labels.second_name}">
                        <p class="text_error" id="surname_danger"></p>
                    </label>
                    <label for="address" class="payment-name-label">
                        <input id="address" name="address" type="text" class="steps-form__input-global"   placeholder="${labels.address}">
                        <p class="text_error" id="address_danger"></p>
                    </label>
                </div>
                <label for="deliveryComments" class="w-100">
                    <textarea rows="10" id="orderComments" name="comment" class="payment_form-textarea" placeholder="${labels.comment}"></textarea>
                        </label>
                        <h4 class="checkout-form__instructions">${labels.contacts}</h4>
                        <div class="payment-contacts-container">
                            <label for="email" class="payment-data-label">
                                <input id="email" name="email" type="email" class="steps-form__input-global"   placeholder="${labels.email}">
                                <p class="text_error" id="email_danger"></p>
                            </label>
                            <label for="payment_phone" class="payment-data-label">
                                <input id="payment_phone"  type="tel" class="steps-form__input-global">
                                <p class="text_error" id="phone_danger"></p>
                            </label>

                </div>
`
                } else {
                    document.getElementById('deliveryTypeForm').innerHTML = `
                       <p class="checkout-form__instructions">${labels.contacts}</p>
                    <div class="payment-contacts-container">
                        <label for="name" class="payment-data-label">
                            <input id="name" name="name" type="text" class="steps-form__input-global"   placeholder="${labels.name}">
                            <p class="text_error" id="name_danger"></p>
                    </label>
                    <label for="surname" class=" payment-data-label">
                        <input id="surname" name="surname" type="text" class="steps-form__input-global"   placeholder="${labels.second_name}">
                        <p class="text_error" id="surname_danger"></p>
                    </label>
                    </div>
                    <div class="payment-contacts-container">
                        <label for="email" class="payment-data-label">
                            <input id="email" name="email" type="email" class="steps-form__input-global"   placeholder="${labels.email}">
                            <p class="text_error" id="email_danger"></p>
                        </label>
                        <label for="payment_phone" class="payment-data-label">
                            <input id="payment_phone"  type="tel" class="steps-form__input-global">
                            <p class="text_error" id="phone_danger"></p>
                        </label>
                    </div>
                    <div class="pickup_text">
                        <p >${labels.pickup_text}</p>
                        <p>${labels.pickup_text2}</p>
                    </div>

`
                }
                if(document.getElementById('payment_phone')) {
                    itiPhone = phoneCountryHandler('#payment_phone')
                }
            })
        })

        function payProducts() {
            console.log('payProducts')
            const form =document.getElementById('orderForm');
            const location =document.getElementById('location');
            const locationDanger =document.getElementById('location_danger');
            const delivery =$('input[name="deliveryType"]');
            const deliveryChecked =$('input[name="deliveryType"]:checked');
            const deliveryDanger =document.getElementById('delivery_danger');
            const name =form.querySelector('#name');
            const nameDanger =form.querySelector('#name_danger');
            const secondName =document.getElementById('surname');
            const secondNameDanger =document.getElementById('surname_danger');
            const address =document.getElementById('address');
            const addressDanger =document.getElementById('address_danger');
            const email =document.getElementById('email');
            const emailDanger =document.getElementById('email_danger');
            const phone =document.getElementById('payment_phone');
            const phoneDanger =document.getElementById('phone_danger');
            const policyDanger =document.getElementById('policy_danger');

            const juridicType =document.getElementById('juridic_type');
            const juridicTypeDanger =document.getElementById('juridic_type_danger');
            const companyName =document.getElementById('company_name');
            const companyNameDanger =document.getElementById('company_name_danger');
            const tva =document.getElementById('tva');
            const tvaDanger =document.getElementById('tva_danger');
            const juridicAddress =document.getElementById('juridic_address');
            const juridicAddressDanger =document.getElementById('juridic_address_danger');
            const fiscalCode =document.getElementById('fiscal_code');
            const fiscalCodeDanger =document.getElementById('fiscal_code_danger');
            const physicalAddress =document.getElementById('physical_address');
            const physicalAddressDanger =document.getElementById('physical_address_danger');
            const bankName =document.getElementById('bank_name');
            const bankNameDanger =document.getElementById('bank_name_danger');
            const bankCode =document.getElementById('bank_code');
            const bankCodeDanger =document.getElementById('bank_code_danger');
            const iban =document.getElementById('iban');
            const ibanDanger =document.getElementById('iban_danger');

            let collectionChecked = document.getElementById('collectionCheckbox').checked;
            let policyChecked = document.getElementById('policyCheckbox').checked;


            if(location.value === '0') {
                location.style.borderColor = '#f63c3c';
                locationDanger.style.display = 'block';
                locationDanger.textContent= '{{trans('labels.form_location_error')}}';
            } else {
                location.style.borderColor = '#1f1f1f';
                locationDanger.style.display = 'none';
            }

            if(delivery.is(":checked")) {
                deliveryDanger.style.display = 'none';
            } else {
                deliveryDanger.style.display = 'block';
                deliveryDanger.textContent= '{{trans('labels.form_delivery_error')}}';
            }
            if(!collectionChecked && !policyChecked) {
                policyDanger.style.display = 'block';
                policyDanger.textContent= '{{trans('labels.form_policy_error')}}';
            }

            // location.value !== '0'
            if(location.value !== '0' && delivery.is(":checked") && collectionChecked && policyChecked) {
             const paymentType = document.querySelector('.payment_form-buttons-btn.active__number').dataset.type
                document.getElementById('phoneHidden').value = itiPhone.getNumber()
                document.getElementById('productsHidden').value = JSON.stringify(products);
                document.getElementById('paymentType').value = paymentType
                document.getElementById('priceProductsHidden').value = productsPrice

                if(paymentType === '2') {
                    if(juridicType.value === '0') {
                        juridicType.style.borderColor = '#f63c3c';
                        juridicTypeDanger.style.display = 'block';
                        juridicTypeDanger.textContent= '{{trans('labels.form_error')}}';
                    } else {
                        juridicType.style.borderColor = '#1f1f1f';
                        juridicTypeDanger.style.display = 'none';
                    }

                    checkInputField(companyName,companyNameDanger, '{{trans('labels.form_name_error')}}')
                    checkInputField(tva,tvaDanger, '{{trans('labels.form_name_error')}}')
                    checkInputField(juridicAddress,juridicAddressDanger, '{{trans('labels.form_name_error')}}')
                    checkInputField(fiscalCode,fiscalCodeDanger, '{{trans('labels.form_name_error')}}')
                    checkInputField(physicalAddress,physicalAddressDanger, '{{trans('labels.form_name_error')}}')
                    checkInputField(bankName,bankNameDanger, '{{trans('labels.form_name_error')}}')
                    checkInputField(bankCode,bankCodeDanger, '{{trans('labels.form_name_error')}}')
                    checkInputField(iban,ibanDanger, '{{trans('labels.form_name_error')}}')

                    if(juridicType.value === '0' || companyName.value ===''|| tva.value ==='' || juridicAddress.value ===''|| fiscalCode.value ===''|| physicalAddress.value ===''|| bankName.value ===''|| iban.value ==='') {
                        return;
                    }
                }

                let mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                if(deliveryChecked.val() === '1' || deliveryChecked.val() === '2') {

                    checkInputField(name,nameDanger, '{{trans('labels.form_error')}}')
                    checkInputField(secondName,secondNameDanger, '{{trans('labels.form_surname_error')}}')
                    checkInputField(address,addressDanger, '{{trans('labels.form_address_error')}}')
                    checkInputField(email,emailDanger, '{{trans('labels.form_email_error')}}')
                    checkInputField(phone,phoneDanger, '{{trans('labels.form_phone_error')}}')

                    if(name.value !== '' && secondName.value !=='' && address.value !=='' && email.value.match(mailformat) && phone.value !=='') {
                        form.submit();
                        // console.log('form.submit()')
                    }
                } else {
                    checkInputField(name,nameDanger, '{{trans('labels.form_name_error')}}')
                    checkInputField(secondName,secondNameDanger, '{{trans('labels.form_surname_error')}}')
                    checkInputField(email,emailDanger, '{{trans('labels.form_email_error')}}')
                    checkInputField(phone,phoneDanger, '{{trans('labels.form_phone_error')}}')
                    if(name.value !== '' && secondName.value !=='' && email.value.match(mailformat) && phone.value !=='') {
                        form.submit();
                        // console.log('form.submit()')
                    }
                }


            }
            // if($('input[name="deliveryType"]').is(":checked")) {
            //      window.location = '/payment'
            // } else {
            //     document.getElementById('deliveryError').style.display= 'block';
            //    document.getElementById('deliveryError').textContent = 'Alegeți, vă rog, livrare'
            // }
        }
    </script>
@endpush
