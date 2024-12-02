@php
    $user = \Illuminate\Support\Facades\Auth::user();
    if(isset($user)) {
        $userId = $user->id;
    } else {
        $userId = '';
    }
@endphp

@extends('layouts.client2')

@section('content')
    <main style="padding-top: 120px">

        @include('client.components.breadСrumbs')

        <section class="payment-order__section payment-order">
            <div class="custom-container payment-order__container">


                <div class="basket_inner_container">

                    @if(count($products) > 0)
                        <div class="payment-order__body row">
                            <div class="steps__form col-xl-9">
                                <h2 class="payment-order__title">{{trans('labels.basket')}} </h2>
                                <div class="steps">
                                    <div class="form__step">
                                        @foreach($products as $product)
                                            @php
                                                if(isset($product['product_variant']['price'])) {
                                                     $price =  $product['product_variant']['price'];
                                                    } else {
                                                     $price =  $product['product']['price'];
                                                    }

                                                if(isset($product['product']->subcategoryId)) {
                                                    $productUrl = route('client.product', [$product['product']->categoryId, $product['product']->subcategoryId, $product['product']['slug'], ]);
                                                } else  $productUrl = route('client.product', [$product['product']->categoryId, $product['product']['slug'], ]);
                                            @endphp
                                            <div class="form__step-item row"
                                                 id="productItem{{isset($product['product_variant']['id']) ? $product['product_variant']['id'] :
                                                                ( isset($product['product_moduline']) && $product['product_moduline'] !== '' ?
                                                                json_decode(json_encode($product['product_moduline']))->unique_id : $product['product']['id'])}}">
                                                <div class="form__step-item__img">
                                                    <img src="/storage/{{$product['product']['image_preview']}}"
                                                         alt=""/>
                                                </div>
                                                <div class="form__step-item__descr">
                                                    <a href="{{$productUrl}}" class="form__step-item__title">
                                                        {{$product['product']['name_ro']}}
                                                    </a>

                                                    <div class="form__step-item-container">

                                                        <div class="form__step-item__text">
                                                            <p class="form__step-item__label ">{{trans('labels.product_code')}}
                                                                : </p>
                                                            <p class="form__step-item__value">{{$product['product_variant'] ? $product['product_variant']['code'] : $product['product']['code_1c']}}</p>
                                                        </div>

                                                        @if(!isset($product['product_moduline']) && !isset($product['product_variant']))
                                                            <div class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.color')}}
                                                                    : </p>
                                                                <p class="form__step-item__value">{!! $language->replace($product['product']['color_name_ro'], $product['product']['color_name_ru'],$product['product']['color_name_en'] ) !!}</p>
                                                            </div>
                                                            <div class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.material')}}
                                                                    : </p>
                                                                <p class="form__step-item__value">{!! $language->replace($product['product']['material_ro'], $product['product']['material_ru'],$product['product']['material_en'] ) !!}</p>
                                                            </div>
                                                        @endif

                                                        @if(isset($product['product_moduline']) && $product['product_moduline'] !== '')
                                                            @php
                                                                $modulineProduct = json_decode(json_encode($product['product_moduline']), true);
                                                            @endphp
                                                            <div
                                                                class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.dimensions')}}: </p>
                                                                <p class="form__step-item__value">{{$modulineProduct['travers_height'].'x'.$modulineProduct['travers_width'].'x'.$modulineProduct['travers_depth']}}</p>
                                                            </div>

                                                            <div
                                                                class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.color')}}: </p>
                                                                <p class="form__step-item__value"> {{$modulineProduct['travers_color']}}</p>
                                                            </div>

                                                            <div
                                                                class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.type')}}: </p>
                                                                <p class="form__step-item__value"> {!! $language->replace($modulineProduct['shelves_type_ro'], $modulineProduct['shelves_type_ru'],$modulineProduct['shelves_type_en'] ) !!}</p>
                                                            </div>

                                                            <div
                                                                class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.color_shelf')}}: </p>
                                                                <p class="form__step-item__value"> {{$modulineProduct['shelves_color']}}</p>
                                                            </div>

                                                            <div
                                                                class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.shelf_quantity')}}: </p>
                                                                <p class="form__step-item__value"> {{$modulineProduct['shelves_number']}}</p>
                                                            </div>
                                                        @endif

                                                        @if(isset($product['product_variant']) && $product['product_variant'] !== '')
                                                            <div
                                                                class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.color')}}: </p>
                                                                <p class="form__step-item__value"> {{$product['product_variant']['color_name']}}</p>
                                                            </div>
                                                            <div
                                                                class="form__step-item__text">
                                                                <p class="form__step-item__label ">{{trans('labels.dimensions')}}: </p>
                                                                <p class="form__step-item__value"> {{$product['product_variant']['dimension']}}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="form__step-buttons_container">
                                                        <button class="form__step-item__price-delete"
                                                                onclick="addToFavorite(this, {{$product['product']['id']}}, '{{csrf_token()}}', '{{trans('cabinet.addFavoriteToast')}}', {{isset($user) && $user !== '' ? $user->id : null}})">
                                                            <img
                                                                src="{{$product['product']->favorite ? '/images/product/heart-red-full.png' : '/images/product/heart-red.png'}}"
                                                                data-selected="{{$product['product']->favorite ? 1 : 0}}"
                                                                class="favorite_icon" alt="heart-icon">
                                                        </button>
                                                        <button class="form__step-item__price-delete" type="button"
                                                                onclick="removeProduct({{isset($product['product_variant']['id']) ? $product['product_variant']['id'] : $product['product']['id']}},
                                                                '{{isset($product['product_variant']) && $product['product_variant'] !== '' ? $product['product_variant']['code'] : 0}}',
                                                                '{{isset($product['product_moduline']) && $product['product_moduline'] !== '' ? $product['product_moduline']->unique_id : 0}}',
                                                                '{{csrf_token()}}', {{isset($userId) && $userId !== '' ? $userId : null }})">
                                                            <img src="/images/delete.png" alt="trash icon">
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form__step-item__price">
                                                    <div class="form__step-item__counter">
                                                        <div class="input-number-group form__step-item__price-input ">
                                                            <div class="input-group-button">
                                                                <span class="input-number-decrement"
                                                                      onclick="incrementHandler(this, {{$product['product']['id']}},
                                                                       '{{isset($product['product_variant']) && $product['product_variant'] !== '' ? $product['product_variant']['code'] : 0}}',
                                                                    '{{isset($product['product_moduline']) && $product['product_moduline'] !== '' ? $product['product_moduline']->unique_id : 0}}',
                                                                       '{{csrf_token()}}', false)">-</span>
                                                            </div>
                                                            <input class="input-number" type="number"
                                                                   style="width: 3rem;"
                                                                   value="{{$product['quantity']}}"
                                                                   oninput="updatePriceAndQuantityOninput(this,
                                                                    {{$product['product']['id']}},
                                                                    '{{isset($product['product_variant']) && $product['product_variant'] !== '' ? $product['product_variant']['code'] : 0}}',
                                                                    '{{isset($product['product_moduline']) && $product['product_moduline'] !== '' ? $product['product_moduline']->unique_id : 0}}',
                                                                     '{{csrf_token()}}')"
                                                                   min="1" max="3"/>
                                                            <div class="input-group-button">
                                                                <span class="input-number-increment"
                                                                      onclick="incrementHandler(this, {{$product['product']['id']}},
                                                                       '{{isset($product['product_variant']) && $product['product_variant'] !== '' ? $product['product_variant']['code'] : 0}}',
                                                                    '{{isset($product['product_moduline']) && $product['product_moduline'] !== '' ? $product['product_moduline']->unique_id : 0}}',
                                                                       '{{csrf_token()}}', true)"
                                                                >+</span>
                                                            </div>
                                                        </div>
                                                        <p class="price-body__one ">
                                                            <input class="price-amount" type="hidden"
                                                                   value="{{$price}}">
                                                            <span class="">{{$price}}</span> <span
                                                                class="">MDL/produs</span>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="price-body__nr ">
                                                            <input class="price-amount" type="hidden"
                                                                   value="{{$price}}">
                                                            <span
                                                                class="total-price">{{$price * $product['quantity']}}</span>
                                                            <span class="price-body__currency">MDL</span>
                                                        </p>
                                                        {{--                                                        <p class="previous_price">{{$product['product']['previous_price'] ? trans('labels.previous_price'). ': '. $product['product']['previous_price'] : '' }}</p>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="payment-order__checkout col-xl-3">

                                <div class=" basket-checkout">
                                    <h4 class="basket-checkout__title">{{trans('labels.order_summary')}}</h4>
                                    <div class="basket-checkout_price_block">
                                        <div class="basket-checkout__info">
                                            <p class="basket-checkout__info-text">{{trans('labels.product_quantity')}}</p>
                                            <p class="basket-checkout__info-price price-body__nr">
                                                <span class="price-body__quantity price_count"></span>
                                            </p>
                                        </div>
                                        <div class="basket-checkout__info">
                                            <div class="basket-checkout__info-text">
                                                <p>{{trans('labels.products_price')}}</p>
                                                <p class="tva_label">{{trans('labels.tva_include')}}</p>
                                            </div>
                                            <p class="basket-checkout__info-price price-body__nr">
                                                <span class="price-body__products price_count">0</span>
                                                <span class="price-body__currency">MDL</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" onclick="checkDelivery()"
                                                class="custom-btn basket-checkout_btn">{{trans('labels.place_order')}}</button>
                                    </div>
                                    <p class="text_error text-center" id="deliveryError"></p>
                                </div>
                            </div>

                        </div>
                    @else
                        <div class="">
                            <div class="empty_basket">
                                <img class="empty_basket_img" src="/images/shopping-cart.png" alt="shopping-cart">
                                <div class="empty_basket_description_block">
                                    <p class="empty_basket_text">{{trans('labels.nothing_in_basket')}}</p>
                                    <p class="empty_basket_description">{{trans('labels.empty_basket_description')}}</p>
                                    <a href="{{route('client.resolve')}}"
                                       class="custom-btn empty_basket_btn">{{trans('labels.add_to_basket')}}</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @if(count($recommendProducts) > 0)
            <section class="payment-viewmore__section product-cards__section product-cards payment-viewmore">
                <div class="custom-container payment-viewmore__container">
                    <h2 class="product-cards__title">{!! trans('labels.recommend_products') !!}</h2>

                    <div
                        class="swiper productCardsSwiper product-more__swiper d-flex align-items-center justify-content-center">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper product-more__swiper-wrapper row p-0" style="flex-wrap: nowrap">
                            @foreach($recommendProducts as $product)

                                @include('client.components.productPage.productCard', ['$product'=>$product])

                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </section>
        @endif


    </main>

@endsection

@push('script')

    <script>
        let products = {!! json_encode($products) !!};
        let productsFavorite = {!! json_encode($favoriteProducts) !!};

        const userId = '{{$userId}}';

        if ($.cookie('vitraFavorite') && productsFavorite !== [] && !userId) {
            productsFavorite = JSON.parse($.cookie('vitraFavorite'), {path: '/'})
        }

        console.log('productsFavorite', productsFavorite)

        console.log('products', products)
        let totalPrice = 0;
        let productsQuantity = 0;
        let deliveryPrice = 0;
        let weight = 0;
        let cityList = [];

        if (products) {
            products.forEach(product => {
                totalPrice += product['product']['price'] * product['quantity']

                productsQuantity += parseInt(product['quantity'])
                if (product['product_variant']) {
                    if (product['product_variant']['weight']) {
                        weight += Number(product['product_variant']['weight'].replace(',', '.'))
                    }
                } else {
                    if (product['product']['weight']) {
                        weight += Number(String(product['product']['weight']).replace(',', '.'))
                    }
                }
            })
        }

        if (document.querySelector('.price-body__products')) {
            document.querySelector('.price-body__products').textContent = totalPrice;
            document.querySelector('.price-body__quantity').textContent = String(productsQuantity);
        }


        // const orderData = {
        //     'quantity': productsQuantity,
        //     'productsPrice': totalPrice,
        //     'totalPrice': totalPrice,
        // }
        // $.cookie('vitraOrder', JSON.stringify(orderData))

        const recommendProducts = {!! json_encode($recommendProducts) !!};

        if (productsFavorite && recommendProducts.length > 0) {

            if (recommendProducts.length > 0) {
                recommendProducts.forEach(item => {
                    productsFavorite.forEach(favorite => {
                        if (favorite.product_id === item.id) {
                            const productCard = document.getElementById('productCard' + item.id);
                            const favoriteImage = productCard.querySelector('.favorite_icon')
                            favoriteImage.src = '/images/product/heart-red-full.png';
                            favoriteImage.dataset.selected = '1';
                        }
                    })
                })
            }
        }


        const labels = {
            'basket': '{{trans('labels.basket')}}',
            'nothing_in_basket': '{{trans('labels.nothing_in_basket')}}',
            'empty_basket_description': '{{trans('labels.empty_basket_description')}}',
            'add_to_basket': '{{trans('labels.add_to_basket')}}',
            'how_get_order': '{{trans('labels.how_get_order')}}',
            'courier_delivery': '{{trans('labels.courier_delivery')}}',
            'store_pickup': '{{trans('labels.store_pickup')}}',
            'order_type': '{{trans('labels.order_type')}}',
            'order_summary': '{{trans('labels.order_summary')}}',
            'products_price': '{{trans('labels.products_price')}}',
            'tva_include': '{{trans('labels.tva_include')}}',
            'delivery': '{{trans('labels.delivery')}}',
            'vitra_delivery': '{{trans('labels.vitra_delivery')}}',
            'from_storage': '{{trans('labels.from_storage')}}',
            'assembly': '{{trans('labels.assembly')}}',
            'total': '{{trans('labels.total')}}',
            'place_order': '{{trans('labels.place_order')}}',
            'product_code': '{{trans('labels.product_code')}}',
            'color': '{{trans('labels.color')}}',
            'dimension': '{{trans('labels.dimension')}}',
            'dimensions': '{{trans('labels.dimensions')}}',
            'previous_price': '{{trans('labels.previous_price')}}',
            'product_quantity': '{{trans('labels.product_quantity')}}',
        };

        function checkDelivery() {
            window.location = '/payment'
        }

        // function serviceHandler(el, price) {
        //
        //     const initialValue =  document.querySelector('.price-body__nr-total').textContent
        //     if(el.checked) {
        //         document.querySelector('.price-body__nr-total').textContent = String(Number(initialValue) + price)
        //         document.querySelector('.price-body__assembly').textContent = String(Number(initialValue) + price)
        //     } else {
        //         document.querySelector('.price-body__nr-total').textContent = String(Number(initialValue) - price)
        //         document.querySelector('.price-body__assembly').textContent = String(Number(initialValue) - price)
        //     }
        //     updateTotalPrice()
        // }

        function removeProduct(id, productVariant, productModuline, token, userId) {
            const existingProducts = $.cookie('vitraProducts');
            const productsParsed = JSON.parse(existingProducts);
            let productFiltered;

            function filterCookies() {
                $.cookie('vitraProducts', JSON.stringify(productFiltered), {path: '/'});
                const productsCount = document.getElementById('cartCount').textContent;
                document.getElementById('cartCount').textContent = String(Number(productsCount) - 1);
                productFiltered.length > 0 ? updateTotalPrice() : location.reload()
            }

            if (!userId) {
                if (parseInt(productVariant) !== 0) {
                    productFiltered = productsParsed.filter(item => item['product_variant'] !== productVariant.toString())
                    $('#productItem' + id).remove();
                    filterCookies()
                } else if (parseInt(productModuline) !== 0) {
                    productFiltered = productsParsed.filter(item => {
                        return item['product_moduline'] !== ''
                            ? JSON.parse(item['product_moduline'])['unique_id'] !== productModuline.toString()
                            : true;
                    });
                    $('#productItem' + productModuline).remove();
                    filterCookies()
                } else {
                    $('#productItem' + id).remove();

                    productFiltered = productsParsed.filter(item => item['product_id'] !== id)
                    filterCookies()
                }
            } else {
                const data = {
                    'user_id': userId,
                    'product_id': id,
                    "_token": token,
                    // 'product_variant': productVariant,
                    // 'product_moduline': productModuline,
                }

                $.ajax({
                    url: "/remove-basket",
                    method: 'POST',
                    data: data,

                }).done(function (res) {
                    console.log('res', res)
                    // location.reload()
                });
            }
        }

        function addToBasket(productId, token, addText = 'Adăugat în coș', userId = null) {
            const storageBasket = $.cookie('vitraProducts');
            console.log('storageBasket', storageBasket)
            let isNewProduct = true;
            let productIndex = -1;
            let productsFavorite = storageBasket ? JSON.parse(storageBasket) : [];
            let matchingProducts = false;
            try {
                matchingProducts = recommendProducts.find(product => parseInt(product.id) === parseInt(productId))
                console.log('matchingProducts', matchingProducts.variants[0].code)
            } catch (e) {
            }

            console.log('productsFavorite', productsFavorite)
            if (!userId) {
                productIndex = productsFavorite.findIndex(item => item.product_id === productId);

                if (matchingProducts && matchingProducts['variants'].length > 0) {
                    let matches = productsFavorite.find(product => product.product_variant.trim() === matchingProducts.variants[0].code.trim()) || false;
                    if (matches) {
                        matches.quantity += 1;
                        isNewProduct = false;

                        $.cookie('vitraProducts', JSON.stringify(productsFavorite), {path: '/'});
                        showToast(addText, 'success');
                    } else {
                        console.log(matches, 'no matches')
                    }
                } else {

                    if (productIndex !== -1) {
                        productsFavorite[productIndex].quantity += 1;
                        isNewProduct = false;
                    } else {
                        productsFavorite.push({
                            'product_id': productId,
                            'quantity': 1,
                            'product_variant': matchingProducts.variants.length > 0 ? matchingProducts.variants[0].code : '',
                            'product_moduline': '',
                        });
                    }
                    console.log('productsFavorite', productsFavorite)

                    $.cookie('vitraProducts', JSON.stringify(productsFavorite), {path: '/'});
                    showToast(addText, 'success');
                }

            } else {
                const data = {
                    'user_id': userId,
                    'product_id': productId,
                    'quantity': 1,
                    "_token": token,
                }

                $.ajax({
                    url: "/add-basket",
                    method: 'POST',
                    data: data,

                }).done(function (res) {
                    console.log(res)
                    if (res.status === 'ok') {
                        showToast(addText, 'success')
                    } else {
                        showToast('Datele n-au fost trimise', 'danger')
                    }
                });

            }

            const product = recommendProducts.find(item => item['id'] === productId)

            let price = product['price'];
            let favoriteUrl = '/images/product/heart-red.png';
            let dataset = 0;
            // if (productsFavorite) {
            //     const selectedProduct = productsFavorite.find(item => item.product_id === product['id'])
            //     if (selectedProduct) {
            //         favoriteUrl = '/images/product/heart-red-full.png';
            //         dataset = 1;
            //     }
            // }

            const tokenValue = '{{csrf_token()}}';
            const userIdValue = '{{$userId}}';

            const markup = `
<div class="form__step-item row" id="productItem${product['id']}">
                                    <div class="form__step-item__img">
                                    <img src="/storage/${product['image_preview']}" alt="" />
                                    </div>
                                    <div class="form__step-item__desr">
                                        <a href="/product/${product['id']}/0" class="form__step-item__title">
                                            ${product['name_ro']}
                                        </a>

                                        <div class="">
                                            <div class="form__step-item__text ">
                                                <p class="form__step-item__label ">${labels.product_code}:</p>
                                                <p class="form__step-item__value">${product['code_1c']}</p>
                                            </div>
                                            ${product['variants'][0]['color_name'] ? `
                                            <div class="form__step-item__text ">
                                                <p class="form__step-item__label ">${labels.color}:</p>
                                                <p class="form__step-item__value" >${product['variants'][0]['color_name']}</p>
                                            </div>` : ''}
                                            ${product['dimension'] ? `
                                            <div class="form__step-item__text ">
                                                <p class="form__step-item__label ">${labels.dimensions}:</p>
                                                <p class="form__step-item__value">${product['dimension']}</p>
                                            </div>` : ''}


                                        </div>
                                        <div class="form__step-buttons_container">
                                                 <button class="form__step-item__price-delete" onclick="addToFavorite(this, ${product['id']}, '${tokenValue}', 'Salvat în favorite',  ${userIdValue})">
                                                      <img src="${favoriteUrl}" data-selected="${dataset}" class="favorite_icon" alt="heart-icon">
                                                </button>
                                                <button class="form__step-item__price-delete" type="button" onclick="removeProduct(${product['id']},'${product.variants && product.variants.length > 0 ? product.variants[0]?.code : 0}',0 , '${tokenValue}', ${userIdValue})">
                                                    <img src="/images/delete.png" alt="trash icon">
                                                </button>
                                            </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form__step-item__price ">
                                            <div>
                                                <div class="input-number-group form__step-item__price-input ">
                                                    <div class="input-group-button">
                                                        <span class="input-number-decrement" onclick="incrementHandler(this, ${product['id']}, '${tokenValue}', false)">-</span>
                                                    </div>
                                                    <input class="input-number" style="width: 3rem;" type="number" value="1" oninput="updatePriceAndQuantityOninput(this, ${product['id']}, '${tokenValue}')"  min="1" max="3"  />
                                                    <div class="input-group-button">
                                                        <span class="input-number-increment" onclick="incrementHandler(this, ${product['id']}, '${tokenValue}', true)">+</span>
                                                    </div>
                                                </div>
                                                <p class="price-body__one ">
                                                    <input class="price-amount" type="hidden" value=${price}>
                                                    <span class="">${price}</span> <span class="">MDL/produs</span>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="price-body__nr ">
                                                <input class="price-amount" type="hidden" value=${price}>
                                                <span class="total-price">${price}</span> <span class="price-body__currency">MDL</span>
                                                </p>
                                                 <p class="previous_price">${product['previous_price'] ? labels.previous_price + ': ' + product['previous_price'] : ''}</p>
                                            </div>

                                    </div>
                                    </div>
                                </div>
            `

            if (isNewProduct) {
                productsFavorite.push({
                    'product_id': productId,
                    'quantity': 1,
                    'product_variant': matchingProducts.variants.length > 0 ? matchingProducts.variants[0].code : '',
                    'product_moduline': '',
                });
                $.cookie('vitraProducts', JSON.stringify(productsFavorite), {path: '/'});
                showToast(addText, 'success');
                if (document.querySelector('.form__step')) {
                    document.querySelector('.form__step').insertAdjacentHTML('beforeend', markup);
                    updateTotalPrice();
                } else {
                    location.reload();
                }
            } else {
                const existingItem = document.querySelector(`#productItem${productId} .input-number`);
                if (existingItem) {
                    existingItem.value = productsFavorite[productIndex].quantity;
                }
            }
        }

        function incrementHandler(el, productId, productVariant, productModuline, token, increment) {
            const input = el.closest(".input-number-group").querySelector(".input-number");
            const val = parseInt(input.value, 10);
            let moreThanOne = el.closest(".input-number-group").parentElement.querySelector('.price-body__one')
            let newValue = increment ? Math.min(val + 1, 100) : Math.max(val - 1, 1);

            if (newValue < 2) moreThanOne.classList.remove('active')
            else if (newValue >= 2) moreThanOne.classList.add('active')

            if (val < 100) {
                input.value = newValue;

                updateTotalPrice(el);

                if (userId) {
                    const data = {
                        'user_id': userId,
                        'product_id': productId,
                        'quantity': newValue,
                        "_token": token,
                    }

                    $.ajax({
                        url: "/quantity-basket",
                        method: 'POST',
                        data: data,

                    }).done(function (res) {
                        console.log(res)
                    });
                } else {
                    const existingProducts = $.cookie('vitraProducts');
                    const productsParsed = JSON.parse(existingProducts)

                    const newProducts = productsParsed.map(product => {
                        if (product.product_variant && product.product_variant === productVariant) {
                            product.quantity = newValue;
                        } else if (product.product_moduline && JSON.parse(product.product_moduline)['unique_id'].trim() === productModuline.trim()) {
                            product.quantity = newValue;
                        } else if (parseInt(product.product_id) === parseInt(productId) && product.product_variant === '' && product.product_moduline === '') {
                            product.quantity = newValue;
                        }
                        return product;
                    })
                    $.cookie('vitraProducts', JSON.stringify(newProducts), {path: '/'})
                }
            }
        }

        function updatePriceAndQuantityOninput(el, productId, productVariant, productModuline, token) {
            function updateCache() {
                if (val < 2) moreThanOne.classList.remove('active')
                else if (val >= 2) moreThanOne.classList.add('active')

                if (val < 100) {
                    updateTotalPrice(el);
                    if (userId) {
                        const data = {
                            'user_id': userId,
                            'product_id': productId,
                            'quantity': val,
                            "_token": token,
                        }

                        $.ajax({
                            url: "/quantity-basket",
                            method: 'POST',
                            data: data,
                        }).done(function (res) {
                            console.log(res)
                        });
                    } else {
                        const existingProducts = $.cookie('vitraProducts');
                        const productsParsed = JSON.parse(existingProducts)

                        const newProducts = productsParsed.map(product => {
                            if (product.product_variant && product.product_variant === productVariant) {
                                product.quantity = val;
                            } else if (product.product_moduline && JSON.parse(product.product_moduline)['unique_id'].trim() === productModuline.trim()) {
                                product.quantity = val;
                            } else if (parseInt(product.product_id) === parseInt(productId) && product.product_variant === '' && product.product_moduline === '') {
                                product.quantity = val;
                            }
                            return product;
                        })
                        $.cookie('vitraProducts', JSON.stringify(newProducts), {path: '/'})
                    }
                }
                console.log(val,'change')
            }
            el.value = Math.min(Math.max(el.value.replace(/[^0-9]/g, ''), 1), 100)
            let input = el.closest(".input-number-group").querySelector(".input-number");
            let val = parseInt(input.value);
            let moreThanOne = el.closest(".input-number-group").parentElement.querySelector('.price-body__one')

            input.removeEventListener('input', updateCache);
            input.removeEventListener('change', updateCache);

            input.addEventListener('input', updateCache());
            input.addEventListener('change', updateCache());
        }

        function updateTotalPrice(element = null) {
            if (element) {
                const quantity = parseInt(element.closest(".input-number-group").querySelector(".input-number").value, 10);
                const pricePerUnit = parseInt(element.closest(".form__step-item__price").querySelector(".price-amount").value, 10);
                const totalPriceElement = element.closest(".form__step-item__price").querySelector(".total-price");
                totalPriceElement.textContent = quantity * pricePerUnit;
            }

            let productsSum = 0;
            let quantity = 0;

            document.querySelectorAll('.total-price').forEach(item => {
                productsSum += Number(item.textContent)
            })
            document.querySelectorAll('.input-number').forEach(item => {
                quantity += Number(item.value)
            })


            // const orderData = {
            //     'quantity': quantity,
            //     'productsPrice': productsSum,
            // }

            // console.log('orderData', orderData)
            // $.cookie('vitraOrder', JSON.stringify(orderData))

            document.querySelector('.price-body__products').textContent = String(productsSum);
            document.querySelector('.price-body__quantity').textContent = String(quantity);

        }


        //acordion
        function accordion(triggerSelector, activeClass) {
            const triggers = document.querySelectorAll(triggerSelector)
            triggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    trigger.classList.toggle(activeClass);
                    const content = trigger.nextElementSibling;
                    if (content.style.display === "block") {
                        content.style.display = "none";
                    } else {
                        content.style.display = "block";
                    }
                })
            })
        }

        accordion('.coupon-accordion__item-trigger', 'coupon-accordion__item-active')

        const productCardsSwiper = new Swiper('.productCardsSwiper', {
            slidesPerView: 5,
            spaceBetween: 15,
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 6
                },
                470: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                1080: {
                    slidesPerView: 4,
                    spaceBetween: 30
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 30
                },
            },

        });

        document.querySelectorAll('.form__step-item__price-input').forEach(e => {
            if (e.querySelector('.input-number').value >= 2) {
                e.closest(".input-number-group").parentElement.querySelector('.price-body__one').classList.add('active')
            }
        })

        function onInputHandler(el) {
            el.value = Math.min(Math.max(el.value.replace(/[^0-9]/g, ''), 1), 100)

            // const input = el.closest(".input-number-group").querySelector(".input-number");
            // const val = parseInt(input.value, 10);
            //
            // if (val === 2) {
            //     el.closest(".input-number-group").parentElement.querySelector('.price-body__one').classList.remove('active')
            // }
            // if (val > 1) {
            //     updateTotalPrice(el);
            //
            //     if (userId) {
            //         const data = {
            //             'user_id': userId,
            //             'product_id': productId,
            //             'quantity': val,
            //             "_token": token,
            //         }
            //
            //         $.ajax({
            //             url: "/quantity-basket",
            //             method: 'POST',
            //             data: data,
            //
            //         }).done(function (res) {
            //             console.log(res)
            //
            //         });
            //     } else {
            //         const existingProducts = $.cookie('vitraProducts');
            //         const productsParsed = JSON.parse(existingProducts)
            //
            //         const newProducts = productsParsed.map(product => {
            //             if (product.product_id === productId) {
            //                 product.quantity = val - 1;
            //             }
            //             return product;
            //         })
            //
            //         $.cookie('vitraProducts', JSON.stringify(newProducts), {path: '/'})
            //     }
            // }
        }
    </script>
@endpush

