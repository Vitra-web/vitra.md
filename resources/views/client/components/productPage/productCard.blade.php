@php
$user = \Illuminate\Support\Facades\Auth::user();
@endphp
<div class="swiper-slide product-card__swiper-slide p-0">
    <div class="products-card__body product-card" id="productCard{{$product->id}}">
        <div class="product-card__img">
            <a href="{{route('client.product', [$product->categoryId, $product->subcategoryId, $product->slug ])}}">
                <img src="{{url('storage/'.$product->image_preview)}}">
            </a>
        </div>
        <div class="product-card__content">
            <h4 class="product-card__title">
                <a href="{{route('client.product', [$product->categoryId, $product->subcategoryId, $product->slug ])}}">
                    {{$language->replace($product->name_ro, $product->name_ru,$product->name_en )}}
                </a>
            </h4>
            @if($product->price <= 10000  && isset($product->price))
            <div class="product-card__price">
                <div class="product-card__price-body">
                    <a href="{{route('client.product', [$product->categoryId, $product->subcategoryId, $product->slug ])}}" class="d-flex">
                        <p class="product-card__price-nr">{{$product->price}}</p>
                        <p class="product-card__price-currency">MDL</p>
                    </a>
                </div>
                <div class="d-flex gap-1">
                    <button type="button" class="product-card__price-cart" onclick="addToFavorite(this, {{$product->id}}, '{{csrf_token()}}', '{{trans('cabinet.addFavoriteToast')}}', {{isset($user)? $user->id: null}})">
                        <img src="{{$product->favorite ? '/images/product/heart-red-full.png' : '/images/product/heart-red.png'}}" data-selected="{{$product->favorite ? 1 : 0}}" class="favorite_icon" alt="heart-icon">
                    </button>

                    @if($product->id == 2594)
                        <a href="{{route('client.product', [$product->categoryId, $product->subcategoryId, $product->slug ])}}" class="product-card__price-cart">
                            <img src="/images/cart_black.svg" alt="cart">
                        </a>
                    @else
                        <button  type="button" class="product-card__price-cart" onclick="addToBasket({{$product->id}}, '{{csrf_token()}}', '{{trans('cabinet.addBasketToast')}}', {{isset($user)? $user->id: null}})">
                            <img src="/images/cart_black.svg" alt="cart">
                        </button>
                    @endif

                </div>

            </div>
                @else
                <div class="product-card__offer">
                    <button type="button" class="product-card__price-cart me-3" onclick="addToFavorite(this, {{$product->id}}, '{{csrf_token()}}', '{{trans('cabinet.addFavoriteToast')}}', {{isset($user)? $user->id: null}})">
                        <img src="{{$product->favorite ? '/images/product/heart-red-full.png' : '/images/product/heart-red.png'}}" data-selected="{{$product->favorite ? 1 : 0}}" class="favorite_icon" alt="heart-icon">
                    </button>
                    <button type="button" class="product-card__offer-btn product-card__offer-btn-text" onclick="openConsultationModal(this, '.modal__wrapper-offer', '.modal__close-offer')">
                        {{trans('labels.asc_price')}}
                    </button>
                </div>
                @endif
        </div>

        <div class="card_badges_container">
            @if($product->badge_top == 1)
                <div class="card_top_badge">{{trans('labels.top_products')}}</div>
            @endif
            @if($product->badge_new == 1)
                <div class="card_new_badge">{{trans('labels.new_products')}}</div>
            @endif
            @if($product->badge_moldova == 1)
                <div class="card_moldova_badge">{{trans('labels.moldova_products')}}</div>
            @endif
        </div>

    </div>



</div>


@push('script')
    <script>
        function openConsultationModal(el, modal, close) {
            modal = document.querySelector(modal)
            close = document.querySelector(close)
            const body = document.body
            modal.style.display = 'flex'
            body.classList.add('locked')
            document.getElementById('consultationProductId').value ="{{$product->id}}";

            close.addEventListener('click', () => {
            modal.style.display = 'none'
            body.classList.remove('locked')
            });

            modal.addEventListener('click', e => {
                if (e.target === modal) {
                    modal.style.display = 'none'
                    body.classList.remove('locked')
                }
            })
        }
    </script>
@endpush
