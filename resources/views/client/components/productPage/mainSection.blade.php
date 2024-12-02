@php use Illuminate\Support\Facades\Auth; @endphp
@php use Illuminate\Support\Facades\App; @endphp
@php
    $currentUser = Auth::user()
@endphp

<section class="product-main-section product-section">
    <div class="custom-container">
        <div class="product-section__body">
            <div class="product-section__gallery">
                <div class="test">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                         class="swiper gallerySwiper">
                        <div class="swiper-wrapper gallerySwiper-wrapper" style="align-items: center;">
                            @if(count($productImages) >0)
                                @foreach($productImages as $productImage)
                                    @if($productImage->type == 'image')
                                        <div class="swiper-slide gallerySwiper-slide">
                                            <a
                                                data-fslightbox="gallery"
                                                class="swiper-slide gallerySwiper-slide "
                                                href="{{url('storage/'.$productImage->url)}}"
                                            >
                                                <img class="product_image" src="{{url('storage/'.$productImage->url)}}"
                                                     alt="Product image">

                                            </a>
                                        </div>
                                    @elseif($productImage->type == 'video')
                                        <div class="swiper-slide gallerySwiper-slide position-relative">
                                            <a data-fslightbox="video" class="swiper-slide gallerySwiper-slide"
                                               id="videoFancybox" href="{{url('storage/'.$productImage->url)}}">
                                                <video src="{{url('storage/'.$productImage->url)}}" width="100%"
                                                       class="productSlideVideo" autoplay muted loop height="500"
                                                       style="pointer-events: none; object-fit: contain"></video>

                                            </a>
                                            <div class="big_play_btn" onclick="stopPlayHandler(this)">
                                                <img src="/images/pause.png" class="pause_image active" alt="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                                     fill="#fff" class="bi bi-play-fill play_image" viewBox="0 0 16 16">
                                                    <path
                                                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                </svg>
                                            </div>
                                            <div class="volume_image" onclick="volumeTurn(this)">
                                                <svg width="20" height="20" class="volume_off active">
                                                    <use xlink:href="/images/svg/volume-off.svg#volume"></use>
                                                </svg>
                                                <svg width="20" height="20" class="volume_turn ">
                                                    <use xlink:href="/images/svg/volume.svg#volume"></use>
                                                </svg>
                                            </div>

                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="swiper-slide gallerySwiper-slide">
                                    <a data-fslightbox="gallery" class="swiper-slide gallerySwiper-slide"
                                       href="{{url('storage/'.$product->image_preview)}}">
                                        <img src="{{url('storage/'.$product->image_preview)}}" alt="Product image">
                                    </a>
                                </div>
                            @endif

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>

                    </div>
                    <div class="badges_container">
                        @if($product->badge_top == 1)
                            <div class="product_top_badge">{{trans('labels.top_products')}}</div>
                        @endif
                        @if($product->badge_new == 1)
                            <div class="product_new_badge">{{trans('labels.new_products')}}</div>
                        @endif
                        @if($product->badge_moldova == 1)
                            <div class="product_moldova_badge">{{trans('labels.moldova_products')}}</div>
                        @endif
                    </div>

                    <div thumbsSlider="" class="swiper galleryThumbs">
                        <div class="swiper-wrapper galleryThumbs-wrapper">
                            @if(count($productImages) >0)
                                @foreach($productImages as $productImage)
                                    @if($productImage->type == 'image')
                                        <div class="swiper-slide galleryThumbs-slide">
                                            <img src="{{url('storage/'.$productImage->url)}}" alt="Product image">
                                        </div>
                                    @elseif($productImage->type == 'video')
                                        <div class="swiper-slide galleryThumbs-slide position-relative">
                                            <video src="{{url('storage/'.$productImage->url)}}" width="100%"
                                                   style="height: 100%;object-fit: cover;"></video>
                                            <div class="small_play_btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                     fill="#fff" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="swiper-slide galleryThumbs-slide">
                                    <img src="{{url('storage/'.$product->image_preview)}}" alt="Product image">
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="product-section__descr product-descr">
                <div class="d-flex align-items-center align-content-lg-start justify-content-between mb-3 gap-3">
                    <h2 class="product-descr__title">{{$title}}</h2>
                    <img id="shareLinkBtn" class="product-descr__img" style="cursor: pointer;"
                         onclick="shareBasedOnDeviceType()" src="{{asset('images/share-btn.svg')}}" alt="">
                </div>


                {{--                <div class="product-descr__stars">--}}
                {{--                    <img src="{{url('images/star-full.svg')}}" class="star_svg" alt="star">--}}
                {{--                    <img src="{{url('images/star-full.svg')}}" class="star_svg" alt="star">--}}
                {{--                    <img src="{{url('images/star-full.svg')}}" class="star_svg" alt="star">--}}
                {{--                    <img src="{{url('images/empty-star.svg')}}" class="star_svg" alt="star">--}}

                {{--                    <p class="product-descr__stars-rate">45 {{trans('labels.reviews')}}</p>--}}
                {{--                </div>--}}
                {{--                <div class="product-descr__price price">--}}
                {{--                    @if(intval($product->price) < 10000)--}}
                {{--                    <div class="product-descr__price-body price-body">--}}
                {{--                        <p class="product-descr__price-nr price-body__nr">{{$product->productVariants[0]['price'] ?? $product->price}}</p>--}}
                {{--                        <p class="product-descr__price-currency price-body__currency">MDL</p>--}}
                {{--                    </div>--}}
                {{--                  --}}
                {{--                    @endif--}}
                {{--                </div>--}}

                {{--                <p class="product-descr__code">{{trans('labels.product_code')}} : <span class="product-descr__code-span">{{$product->productVariants[0]['code'] ?? $product->code_1c}}</span></p>--}}

                @if($product->constructor_id == 3)
                    @include('client.components.productPage.constructors.moduline')
                @elseif($product->constructor_id == 2)
                    @include('client.components.productPage.constructors.runden')
                @else
                    @include('client.components.productPage.constructors.noConstructor')
                @endif

                <div class="product-descr__table">
                    <h2 class="product-descr__table-title">{{trans('labels.technicalInformation')}}</h2>
                    <div class="product-descr__table-body row">

                        <div class="product-descr__table-body__char">
                            <p class="product-descr__table-td">{{trans('labels.product_code')}}:</p>
                        </div>
                        <div class="product-descr__table-body__value">
                            <p class="product-descr__table-td product_code">{{$product->productVariants[0]['code'] ?? $product->code_1c}}</p>
                        </div>

                        @if(isset($product->material_ro) && $product->material_ro !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.material')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics product_material">{{ $language->replace($product->material_ro, $product->material_ru, $product->material_en) }}</p>
                            </div>
                        @endif

                        @if(isset($product->productVariants[0]['model']) && $product->productVariants[0]['model'] !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.model')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics product_model">{{$product->productVariants[0]['model']}}</p>
                            </div>
                        @endif

                        @if(isset($product->weight) && $product->weight !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.weight')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics">
                                    <span>{{$product->productVariants[0]['weight'] ?? $product->weight}}</span>kg</p>
                            </div>
                        @endif
                        @if(isset($product->shelf_number) && $product->shelf_number !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.shelf_quantity')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics">
                                    <span>{{$product->productVariants[0]['shelf_number'] ?? $product->shelf_number}}</span>
                                </p>
                            </div>
                        @endif

                        @if(isset($product->power) && $product->power !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.power')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics">
                                    <span>{{$product->productVariants[0]['power'] ?? $product->power}}</span>
                                    kw</p>
                            </div>
                        @endif

                        @if(isset($product->voltage) && $product->voltage !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.voltage')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics">
                                    <span>{{$product->productVariants[0]['voltage'] ?? $product->voltage}}</span>
                                    V</p>
                            </div>
                        @endif

                        @if(isset($product->frequency) && $product->frequency !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.frequency')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics">
                                    <span>{{$product->productVariants[0]['frequency'] ?? $product->frequency}}</span>
                                    hz</p>
                            </div>
                        @endif
                        @if(isset($product->maximum_temperature) && $product->maximum_temperature !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.maximum_temperature')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics">
                                    <span>{{$product->productVariants[0]['maximum_temperature'] ?? $product->maximum_temperature}}</span>
                                    °C</p>
                            </div>
                        @endif

                        @if(isset($product->volume) && $product->volume !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.volume')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics">
                                    <span>{{$product->productVariants[0]['volume'] ?? $product->volume}}</span>
                                    l</p>
                            </div>
                        @endif

                        @if(isset($product->capacity) && $product->capacity !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.capacity')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics">
                                    <span>{{$product->productVariants[0]['weight'] ?? $product->capacity}}</span>
                                </p>
                            </div>
                        @endif

                        @if(isset($product->dimension) && $product->dimension !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.dimension')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics product_dimension">{{$product->productVariants[0]['dimension'] ?? $product->dimension}}</p>
                            </div>
                        @endif

                        @if(isset($product->rotation_speed) && $product->rotation_speed !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.rotation_speed')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics product_dimension">{{$product->productVariants[0]['rotation_speed'] ?? $product->rotation_speed}}</p>
                            </div>
                        @endif

                        @if(isset($product->cycle_duration) && $product->cycle_duration !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.cycle_duration')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics product_dimension">
                                    {{$product->productVariants[0]['cycle_duration'] ?? $product->cycle_duration}} sec
                                </p>
                            </div>
                        @endif

                        @if(isset($product->water_consumption) && $product->water_consumption !== '')
                            <div class="product-descr__table-body__char">
                                <p class="product-descr__table-td">{{trans('labels.water_consumption')}}:</p>
                            </div>
                            <div class="product-descr__table-body__value">
                                <p class="product-descr__table-td characteristics product_dimension">{{$product->productVariants[0]['water_consumption'] ?? $product->water_consumption}} {{trans('labels.cycle')}}</p>
                            </div>
                        @endif

                        @if(count($product->productVariants) > 0)
                            @if(isset($product->productVariants[0]['color_name']) && $product->productVariants[0]['color_name'] !== '')
                                <div class="product-descr__table-body__char">
                                    <p class="product-descr__table-td">{{trans('labels.color_name')}}:</p>
                                </div>
                                <div class="product-descr__table-body__value">
                                    <p class="product-descr__table-td characteristics product_color_name">{{$product->productVariants[0]['color_name']}}</p>
                                </div>
                            @endif

                            @if(isset($product->productVariants[0]['max_load']) && $product->productVariants[0]['max_load'] !== '')
                                <div class="product-descr__table-body__char">
                                    <p class="product-descr__table-td">{{trans('labels.max_load')}}:</p>
                                </div>
                                <div class="product-descr__table-body__value">
                                    <p class="product-descr__table-td characteristics">
                                        <span
                                            class="product_max_load">{{$product->productVariants[0]['max_load']}}</span>kg
                                    </p>
                                </div>
                            @endif

                            @if(isset($product->productVariants[0]['extension_length']) && $product->productVariants[0]['extension_length'] !== '')
                                <div class="product-descr__table-body__char">
                                    <p class="product-descr__table-td">{{trans('labels.extension_length')}}:</p>
                                </div>
                                <div class="product-descr__table-body__value">
                                    <p class="product-descr__table-td characteristics product_extension_length">{{$product->productVariants[0]['extension_length']}}</p>
                                </div>
                            @endif
                        @endif

                    </div>

                </div>

                <div id="placeholderBuyCard"></div>

                <div class="product-descr__info">
                    <div class="product-descr__info-content">
                        <h2 class="product-descr__info-title">{{trans('labels.aboutProduct')}}</h2>
                        <div class="js-excerpt excerpt-hidden">

                            <p>{!! $language->replace($product->description_ro, $product->description_ru,$product->description_en ) !!}</p>

                            @if($product['specifications'])
                                <div class="addition_specifications_block">
                                    @foreach($product['specifications'] as $item)
                                        <div class="addition_specifications">
                                            <div class="addition_specifications-title">
                                                {!! $language->replace($item['title_ro'], $item['title_ru'],$item['title_en'] ) !!}
                                            </div>
                                            <div class="addition_specifications-content">
                                                <div
                                                    class="content__text">{!! $language->replace($item['description_ro'], $item['description_ru'],$item['description_en'] ) !!}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <a href="#" role="button" class="js-show-more">{{trans('labels.more')}}</a>
                </div>


                <div class="product-descr__catalogs">
                    @if(count($product->productPdfs) > 0)
                        @foreach($product->productPdfs as $pdf)
                            <div class="product-descr__catalogs-item">
                                <div class="product-descr__catalogs-img">
                                    <img src="{{asset('images/'.$pdf->pdf_image)}}" alt="Product image">
                                </div>
                                <div class="product-descr__catalogs-text">
                                    <h3 class="product-descr__catalogs-title">{{$title}}</h3>
                                    <p class="product-descr__catalogs-descr">{{trans('labels.download_product_label')}}</p>

                                    <a href="{{url('storage/'.$pdf->pdf)}}" class="" id="productLink" hidden
                                       download></a>
                                    <button class="product-descr__catalogs-download" type="button"
                                            onclick="downloadProductCatalog()">
                                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect width="24" height="24" fill="white"/>
                                            <path
                                                d="M5 12V18C5 18.5523 5.44772 19 6 19H18C18.5523 19 19 18.5523 19 18V12"
                                                stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 3L12 15M12 15L16 11M12 15L8 11" stroke="#000000"
                                                  stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                        </svg>
                                        .PDF({{$pdf->pdf_size}} MB)
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="product-descr__catalogs-item">
                        <div class="product-descr__catalogs-img">
                            <img src="{{url('storage/'.$industryItem->image_preview)}}" alt="Industry image">
                        </div>
                        <div class="product-descr__catalogs-text">
                            <h3 class="product-descr__catalogs-title">{{$industryItem->name}}</h3>
                            <p class="product-descr__catalogs-descr">{{trans('labels.download_industry_label')}}</p>
                            <a href="{{url('storage/'.$industryItem->pdf)}}" class="" id="industryLink" download hidden>
                            </a>
                            <button class="product-descr__catalogs-download" type="button"
                                    onclick="downloadIndustryCatalog({{$product->industry_id}})">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect width="24" height="24" fill="white"/>
                                    <path d="M5 12V18C5 18.5523 5.44772 19 6 19H18C18.5523 19 19 18.5523 19 18V12"
                                          stroke="#000000" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 3L12 15M12 15L16 11M12 15L8 11" stroke="#000000" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                                .PDF({{$industryItem->pdf_size}} MB)
                            </button>
                        </div>
                    </div>
                    @if(isset($product->video))
                        <div class="product-descr__catalogs-item">
                            <div class="product-descr__catalogs-video">
                                <a href="{{url('storage/'.$product->video)}}" data-fancybox>
                                    <video src="{{url('storage/'.$product->video)}}" width="125" height="100"></video>
                                </a>
                            </div>
                            <div class="product-descr__catalogs-text">
                                <h3 class="product-descr__catalogs-title">{{trans('labels.video_instruction')}}</h3>
                                <p class="product-descr__catalogs-descr">{{trans('labels.video_instruction_label')}}</p>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div id="placeholderBuyCardOld" style="height: fit-content;">
                <div class="product-section__action">

                    @if(isset($product->price) && intval($product->price) < 10000)

                        <div class="product_action_price_container">
                            <div style="height: 60px;">
                                <div class="product-descr__price-body price-body">
                                    {{--                                    <p class="price-body__nr">{{$product->productVariants[0]['price'] ?? $product->price}}</p>--}}
                                    @if(count($product->productVariants) > 0 && $product->productVariants[0]['price'] !== '')
                                        <p class="price-body__nr price-body__nr">{{$product->productVariants[0]['price']}}</p>
                                    @else
                                        <p class="price-body__nr price-body__nr"></p>
                                    @endif
                                    <p class="product-descr__price-currency price-body__currency">MDL</p>
                                </div>
                                <p class="previous_price" style="display: none;">
                                    {{trans('labels.piece_price')}}: <span class="previous_price-text"></span> MDL
                                </p>
                            </div>
                            <div class="product-descr__availability">
                                @if($product->stock == 1)
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                         stroke="#3bab32">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                           stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#3bab32" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    <p class="product-descr__availability-text">{{trans('labels.in_stock')}}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(intval($product->price) < 10000 && isset($product->price))
                        <div class=" input-number-group mb-4">
                            <div class="input-group-button">
                                <span class="input-number-decrement">-</span>
                            </div>
                            <input class="input-number" id="productQuantity" type="number"
                                   oninput="onInputHandler(this)"
                                   value="1" min="1" max="3">
                            <div class="input-group-button">
                                <span class="input-number-increment">+</span>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex align-items-center mb-2">
                        <img src="{{asset('images/delivery-truck.svg')}}" alt="" style="width: 32px;">
                        <p class="product-descr__delivery-time">{{trans('labels.delivery_time')}}</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{asset('images/delivery-return.svg')}}" alt="" style="width: 28px;">
                        <p class="product-descr__delivery-time">{{trans('labels.return')}}</p>
                    </div>

                    @if(intval($product->price) < 10000 && isset($product->price))
                        <button class="product-descr__btn custom-btn"
                                onclick="addToBasketVariants( '{{csrf_token()}}', '{{trans('cabinet.addBasketToast')}}', {{isset($currentUser)? $currentUser->id: null}})">
                            <img src="/images/cart_black.svg" alt="cart">
                            <span class="w-100">{{trans('labels.add_to_basket')}}</span>
                        </button>
                    @else
                        <button type="button" class="product-descr__btn custom-btn"
                                onclick="openConsultationModal(this, '.modal__wrapper-offer', '.modal__close-offer')">
                            <span class="w-100">{{trans('labels.asc_price')}}</span>
                        </button>
                    @endif
                    <button class="product-descr__btn custom-btn "
                            onclick="addToFavorite(this, {{$product->id}},  '{{csrf_token()}}', '{{trans('cabinet.addFavoriteToast')}}', {{isset($currentUser)? $currentUser->id: null}})">
                        <img
                            src="{{$product->favorite ? '/images/product/heart-red-full.png' : '/images/product/heart-red.png'}}"
                            data-selected="{{$product->favorite ? 1 : 0}}" class="favorite_icon me-2"
                            alt="heart-icon">
                        <span class="favorite_text w-100">{{trans('labels.add_favorite')}}</span>
                    </button>
                    @if(intval($product->price) < 10000 && isset($product->price))
                        <button class="product-descr__btn custom-btn " style=" padding-left: 20px; color: #45A73C;"
                                onclick="buyNow('{{csrf_token()}}', '{{trans('cabinet.addBasketToast')}}', {{isset($currentUser) ? $currentUser->id : null}})">
                            <span class="w-100" style=" padding-left: 20px;">{{trans('labels.buy_now')}}</span>
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @if(isset($product['variants'][0]['size_table']))
        <div class="modal__wrapper-table">
            <div class="modal-offer">
                <div class="d-flex justify-content-end">
                    {{--                    <p class="modal_table_title">{{trans('labels.size_table')}}</p>--}}
                    <div class="modal__close-table">
                        <img src="{{asset('images/cancel.svg')}}" alt="cancel" width="15px" height="15px">
                    </div>
                </div>

                <div class="modal-offer__img">
                    <picture>
                        @if(isset($product['variants'][0]['size_table_mobile']))
                            <source class="modal_table_img" media="(max-width: 979px)"
                                    srcset="{{url('storage/'.$product['variants'][0]['size_table_mobile'])}}"/>
                        @endif
                        <img src="{{url('storage/'.$product['variants'][0]['size_table'])}}" alt=""
                             class="modal_table_img">
                    </picture>
                </div>
            </div>
        </div>
    @endif

    <div class="modal_share-link">
        <div class="modal_share-link__container">
            <div class="modal_share-link__head">
                <div class="modal_share-link__head-title">{{trans('labels.share')}}</div>
                <div class="modal_share-link__head-close"><img src="{{asset('images/cancel.svg')}}" alt=""></div>
            </div>
            <div class="modal_share-link__copy">
                <input class="modal_share-link__copy-url" readonly
                       value="https://vitranew.vitra.md/product/wall-mounted-rack-for-wheels-and-fitness-balls/none/wall-mounted-holder-for-wheels-and-fitness-balls"
                >
                <div class="modal_share-link__copy-btn">{{trans('labels.copy')}}</div>
            </div>
            <div class="modal_share-link__social">

                <a class="modal_share-link__social-el" href="http://twitter.com/share?text={{Request::url()}}"
                   target="_blank">
                    <img src="{{asset('images/svg/twitter.svg')}}" alt="">
                </a>

                <a class="modal_share-link__social-el" href="https://t.me/share/url?url={{Request::url()}}"
                   target="_blank">
                    <img src="{{asset('images/svg/telegram.svg')}}" alt="">
                </a>

                <a class="modal_share-link__social-el" href="fb-messenger://share?link={{Request::url()}}"
                   target="_blank">
                    <img src="{{asset('images/svg/messenger.svg')}}" alt="">
                </a>

                <a class="modal_share-link__social-el"
                   href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" target="_blank">
                    <img src="{{ asset('images/svg/facebook.svg') }}" alt="">
                </a>

                <a class="modal_share-link__social-el" href="https://wa.me/?text={{Request::url()}}" target="_blank">
                    <img src="{{asset('images/svg/whatsapp.svg')}}" alt="">
                </a>

                <a class="modal_share-link__social-el" href="https://vk.com/share.php?url={{Request::url()}}"
                   target="_blank">
                    <img src="{{ asset('images/svg/vk.svg') }}" alt="">
                </a>

                <a class="modal_share-link__social-el"
                   href="https://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}&title={{$title}}"
                   target="_blank">
                    <img src="{{ asset('images/svg/linkedin.svg') }}" alt="">
                </a>

                <a class="modal_share-link__social-el" href="viber://forward?text={{Request::url()}}" target="_blank">
                    <img src="{{ asset('images/svg/viber.svg') }}" alt="">
                </a>

            </div>
        </div>
    </div>
</section>


@push('script')

    <script>

        const productConstructor = `{{$product->constructor}}`;
        console.log(productConstructor)
        {{--const product = {!! $product !!};--}}

        // let data = {
        //     'product': product,
        //     'product_variant': product[0],
        //     'product_moduline': '',
        //     'quantity': 1
        // };

        {{--const lang = '{{App::getLocale()}}';--}}
        {{--const productImg = {!! $productImages !!};--}}

        {{--console.log('product', product)--}}
        {{--let modulinePrice = 0;--}}

        {{--const userLoginProduct = '{!! isset($currentUser) ? $currentUser->id : '' !!}';--}}

        {{--const productsFavorite = window.localStorage.getItem('vitraFavorite');--}}

        {{--const similarProducts = {!! json_encode($similarProducts) !!};--}}


        //sahre
        let isEventListenerSet = false;

        function shareLinkMobileTablet() {
            if (navigator.share) {
                navigator.share({
                    title: `{{trans('labels.share_title')}}`,
                    text: `{{trans('labels.share_description')}}`,
                    url: `${window.location.href}`,
                    image: `{{isset($product->image_preview) ? url('storage/'.$product->image_preview) : url('images/logo-white.png')}}`
                })
                    .then(() => console.log('Content shared successfully!'))
                    .catch((error) => console.error('Error sharing:', error));
            } else {
                console.log('Something is wrong.');
            }
        }

        function shareLinkPcLaptop() {
            let shareBtn = document.getElementById('shareLinkBtn');
            let modalShareCloseBtn = document.querySelector('.modal_share-link__head-close');
            let modalShare = document.querySelector('.modal_share-link');

            let urlToCopy = document.querySelector('.modal_share-link__copy-url');
            let copyBtn = document.querySelector('.modal_share-link__copy-btn');

            function toggleModal() {
                modalShare.classList.toggle('active');
                document.body.classList.toggle('overflow-hidden')
                copyBtn.classList.remove('copied');
                copyBtn.innerHTML = '{{trans('labels.copy')}}';
            }

            function copy() {
                copyBtn.classList.add('copied');
                copyBtn.innerHTML = '{{trans('labels.copied')}}';

                if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
                    urlToCopy.contenteditable = true;
                    urlToCopy.readonly = false;

                    let range = document.createRange();
                    range.selectNodeContents(urlToCopy);

                    let selection = window.getSelection();
                    selection.removeAllRanges();
                    selection.addRange(range);
                    urlToCopy.setSelectionRange(0, 999999);
                } else {
                    urlToCopy.select()
                }
                document.execCommand('copy');
            }

            if (!isEventListenerSet) {
                copyBtn.addEventListener('click', copy);
                shareBtn.addEventListener('click', toggleModal);
                modalShareCloseBtn.addEventListener('click', toggleModal);
                isEventListenerSet = true;
                shareBtn.click();
            }
        }

        function shareBasedOnDeviceType() {
            const platform = navigator.platform || '';
            const userAgentString = navigator.userAgent || '';

            const isMobileOrTablet = /(Mobi|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|Symbian|Kindle|Silk|Bada|Tizen|MeeGo|Palm|Tablet|Nexus 7|Nexus 10|SM-T|SCH-I800|GT-P|Tab|PlayBook|Transformer)/i.test(userAgentString);
            const isDesktopPlatform = /(Win|Win32|Mac|MacIntel|Linux|X11)/i.test(platform);
            const maxTouchPoints = navigator.maxTouchPoints || 0;
            const hasMouseSupport = matchMedia('(pointer:fine)').matches;
            const isSmallScreen = window.innerWidth <= 768;
            const isTabletScreen = window.innerWidth > 768 && window.innerWidth <= 1400;

            let chromeAgent = /(Chrome|CriOS)/i.test(userAgentString) || /Google Inc/.test(navigator.vendor);
            let firefoxAgent = /(Firefox)/i.test(userAgentString);
            let safariAgent = /(Safari)/i.test(userAgentString);

            if (chromeAgent && safariAgent) {
                safariAgent = false;
            }

            // Case 1: User is on a PC/Laptop
            if (!isMobileOrTablet && isDesktopPlatform && maxTouchPoints === 0) {
                return shareLinkPcLaptop();
            }
            // Case 2: User is simulating a phone using a PC/Laptop
            if (isMobileOrTablet && isDesktopPlatform && (maxTouchPoints <= 1 || hasMouseSupport || isSmallScreen)) {
                return shareLinkPcLaptop();
            }
            // Case 3: User is on a tablet
            if ((isMobileOrTablet && isDesktopPlatform && maxTouchPoints > 0 && isTabletScreen) ||
                (isMobileOrTablet && !isDesktopPlatform && maxTouchPoints > 0 && isTabletScreen)) {
                document.querySelector('.modal_share-link').style.alignItems = 'flex-end'
                return safariAgent || firefoxAgent ? shareLinkPcLaptop() : shareLinkMobileTablet();
            }
            // Case 4: User is on a mobile device
            if (isMobileOrTablet && !isDesktopPlatform && maxTouchPoints > 0 && !isTabletScreen) {
                document.querySelector('.modal_share-link').style.alignItems = 'flex-end'
                return safariAgent || firefoxAgent ? shareLinkPcLaptop() : shareLinkMobileTablet();
            }
            // Unknown Device
            return shareLinkPcLaptop();
        }

        //share end

        function setBuyCardPosition() {
            let placeholderBuyCard = document.getElementById('placeholderBuyCard')
            let placeholderBuyCardOld = document.getElementById('placeholderBuyCardOld')
            let buyCard = document.querySelector('.product-section__action')
            if (window.innerWidth <= 1360) {
                placeholderBuyCard.appendChild(buyCard);
            } else {
                placeholderBuyCardOld.appendChild(buyCard);
            }
        }

        setBuyCardPosition()
        window.addEventListener('resize', () => {
            setBuyCardPosition()
        })

        if (document.querySelector('.js-excerpt').innerHTML.trim().split(' ').length < 37) {
            document.querySelector('.js-show-more').style.display = 'none'
        }

        document.querySelectorAll('.show-more-shelf').forEach(e => {
            e.addEventListener('click', function () {
                document.querySelector('body').classList.toggle('no_scroll')
                document.querySelector('.modal-see-more').classList.toggle("show");
            })
        })


        if (productsFavorite) {
            const favoritesParsed = JSON.parse(productsFavorite)
            const selectedProduct = favoritesParsed.find(item => item.product_id === product['id'])
            if (selectedProduct) {
                const favoriteImage = document.querySelector('.favorite_icon')
                favoriteImage.src = '/images/product/heart-red-full.png';
                favoriteImage.dataset.selected = '1';
            }
        }


        function onInputHandler(el) {
            el.value = Math.min(Math.max(el.value.replace(/[^0-9]/g, ''), 1), 100)
        }

        function checkQuantity() {
            if (parseInt(document.getElementById('productQuantity').value) > 1) {
                document.querySelector('.previous_price').style.display = 'block'
                document.querySelector('.previous_price-text').innerHTML = `${modulinePrice}`
            } else {
                document.querySelector('.previous_price').style.display = 'none'
                document.querySelector('.previous_price-text').innerHTML = ''
            }
        }

        (function updatePrice() {
            const updatePrice = (increment) => {
                const input = document.querySelector('.input-number-group .input-number');
                if (!input) return;

                let value = parseInt(input.value);
                let newValue = increment ? Math.min(value + 1, 100) : Math.max(value - 1, 1);

                if (newValue !== value) {
                    input.value = data['quantity'] = newValue;

                    console.log(`data['product_variant']?.price`, data['product_variant']?.price)
                    const productPrice = modulinePrice || data['product_variant']?.price || data['product'].price;
                    document.querySelector('.price-body__nr').textContent = `${parseInt(newValue) * parseInt(productPrice)}`;

                    checkQuantity();
                }
            };

            document.querySelector('.input-number-increment')?.addEventListener('click', () => updatePrice(true));
            document.querySelector('.input-number-decrement')?.addEventListener('click', () => updatePrice(false));
        })();


        function stopPlayHandler(el) {
            const parent = el.parentElement;
            const video = parent.querySelector('.productSlideVideo')
            if (parent.querySelector('.pause_image.active')) {
                video.pause();

                parent.querySelector('.pause_image').classList.remove('active')
                parent.querySelector('.play_image').classList.add('active')
            } else {
                video.play();
                parent.querySelector('.play_image').classList.remove('active')
                parent.querySelector('.pause_image').classList.add('active')
            }

        }

        function volumeTurn(el) {
            const parent = el.parentElement;
            const video = parent.querySelector('.productSlideVideo')
            video.muted = !video.muted;

            if (el.querySelector('.volume_off.active')) {
                el.querySelector('.volume_off').classList.remove('active')
                el.querySelector('.volume_turn').classList.add('active')
            } else {
                el.querySelector('.volume_turn').classList.remove('active')
                el.querySelector('.volume_off').classList.add('active')
            }
        }

        function openFeedbackModal(link) {
            const modal = document.getElementById('feedbackModal');
            const close = document.getElementById('feedbackClose');
            const submitBtn = document.getElementById('feedbackSubmitBtn');
            const body = document.body
            modal.style.display = 'flex';
            body.classList.add('locked')

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

            submitBtn.addEventListener('click', () => {
                const name = document.getElementById('feedbackName');
                const nameDanger = document.getElementById('feedback_name_danger');
                const email = document.getElementById('feedbackEmail');
                const emailDanger = document.getElementById('feedback_email_danger');
                checkInputField(name, nameDanger, '{{trans('labels.form_name_error')}}')
                checkInputField(email, emailDanger, '{{trans('labels.form_email_error')}}')

                if (name.value !== '' && email.value !== '') {
                    const data = {
                        'name': name.value,
                        'email': email.value,
                    }

                    $.ajax({
                        url: "/feedback-mail",
                        method: 'POST',
                        data: data,

                    }).done(function (res) {
                        if (res.status === 'ok') {
                            showToast('Datele au fost trimise', 'success')
                            name.value = '';
                            email.value = '';
                            document.getElementById('feedbackModal').style.display = 'none'
                            body.classList.remove('locked')
                            document.getElementById(link).click();
                            window.localStorage.setItem('VitraSentData', '1')
                        } else {
                            showToast('Datele n-au fost trimise', 'danger')
                        }
                    });
                }
            })

        }

        function downloadIndustryCatalog() {
            const sent = window.localStorage.getItem('VitraSentData')
            if (userLoginProduct || sent) {
                document.getElementById('industryLink').click();
            } else {
                openFeedbackModal('industryLink')
            }
        }

        function downloadProductCatalog() {
            const sent = window.localStorage.getItem('VitraSentData')
            if (userLoginProduct || sent) {
                document.getElementById('productLink').click();
            } else {
                openFeedbackModal('productLink')
            }
        }

        function addToBasketVariants(token, addText = 'Adăugat în coș', userId = null) {
            const storageBasket = $.cookie('vitraProducts');
            if (!userId) {
                if (storageBasket) {
                    const productsBasket = JSON.parse(storageBasket);

                    let productExists = false;
                    if (product.variants?.length > 0) {
                        let matches = productsBasket.find(product => product.product_variant === data.product_variant.code) || false;
                        if (matches) {
                            matches.quantity += parseInt(data.quantity);
                        } else {
                            productsBasket.push({
                                'product_id': data.product.id,
                                'quantity': data.quantity,
                                'product_variant': data.product_variant.code,
                                'product_moduline': ''
                            });
                        }
                    } else if (product.typeVariants?.length > 0) {
                        let modulineProduct;
                        try {
                            modulineProduct = JSON.parse(setProductModuline());
                        } catch (error) {
                            console.error("Failed to parse JSON:", error);
                        }
                        let modulineMatches;
                        try {
                            productsBasket.forEach((item) => {
                                if (item.product_moduline && item.product_moduline !== '') {
                                    modulineMatches = JSON.parse(item.product_moduline)
                                    if (modulineMatches.travers_width === modulineProduct.travers_width
                                        && modulineMatches.travers_height === modulineProduct.travers_height
                                        && modulineMatches.travers_depth === modulineProduct.travers_depth
                                        && modulineMatches.travers_color === modulineProduct.travers_color
                                        && modulineMatches.shelves_type === modulineProduct.shelves_type
                                        && modulineMatches.shelves_number === modulineProduct.shelves_number
                                        && modulineMatches.shelves_color === modulineProduct.shelves_color) {
                                        productExists = true;
                                    }
                                }
                                if (productExists === true) item.quantity += parseInt(document.getElementById('productQuantity').value);
                            });
                        } catch (e) {
                            alert(`{!! trans('labels.product_error') !!} 'Price'`)
                            location.reload();
                        }
                        console.log('modulineMatches', modulineMatches)

                        if (!productExists) {
                            productsBasket.push({
                                'product_id': data.product.id,
                                'quantity': data.quantity,
                                'product_variant': product.variants.length > 0 ? data.product_variant.code : '',
                                'product_moduline': product.variants.length > 0 ? '' : setProductModuline()
                            });
                        }
                    } else {
                        productsBasket.forEach((item) => {
                            if (item.product_id === data.product.id) {
                                item.quantity += parseInt(data.quantity);
                                productExists = true;
                            }
                        });

                        if (!productExists) {
                            productsBasket.push({
                                'product_id': data.product.id,
                                'quantity': data.quantity,
                                'product_variant': product.variants.length > 0 ? data.product_variant.code : '',
                                'product_moduline': '',
                            });
                        }
                    }

                    $.cookie('vitraProducts', JSON.stringify(productsBasket), {path: '/'});
                    if (document.getElementById('cartCount')) {
                        document.getElementById('cartCount').textContent = String(productsBasket.length);
                    } else {
                        const headerCartCount = document.createElement('div')
                        headerCartCount.classList.add('header_cart_count_black')
                        headerCartCount.id = 'cartCount'
                        headerCartCount.innerHTML = '1';
                        document.querySelector('.header__wishlist-cart').append(headerCartCount)
                    }
                    console.log('productsBasket', productsBasket)

                } else {
                    $.cookie('vitraProducts', JSON.stringify([{
                        'product_id': data.product.id,
                        'quantity': data.quantity,
                        'product_variant': product.variants.length > 0 ? data.product_variant.code : '',
                        'product_moduline': product.variants.length > 0 ? '' : setProductModuline()
                    }]), {path: '/'});
                    const headerCartCount = document.createElement('div')
                    headerCartCount.classList.add('header_cart_count_black')
                    headerCartCount.id = 'cartCount'
                    headerCartCount.innerHTML = '1';
                    document.querySelector('.header__wishlist-cart').append(headerCartCount)
                }
                showToast(addText, 'success')

            } else {
                const postData = {
                    'user_id': userId,
                    'product_id': data.product.id,
                    'product_variant': product.variants.length > 0 ? data.product_variant.code : '',
                    'product_moduline': product.variants.length > 0 ? '' : setProductModuline(),
                    'quantity': data.quantity,
                    "_token": token,
                }

                $.ajax({
                    url: "/add-basket",
                    method: 'POST',
                    data: postData,

                }).done(function (res) {
                    console.log('res', res)
                    if (res.status === 'ok') {
                        const quantity = {{$basketProducts}};
                        if (document.getElementById('cartCount')) {
                            document.getElementById('cartCount').textContent = String(quantity + 1)
                        } else {
                            const headerCartCount = document.createElement('div')
                            headerCartCount.classList.add('header_cart_count_black')
                            headerCartCount.id = 'cartCount'
                            headerCartCount.innerHTML = '1';
                            document.querySelector('.header__wishlist-cart').append(headerCartCount)
                        }

                        showToast(addText, 'success')
                    } else {
                        showToast('Datele n-au fost trimise', 'danger')
                    }
                });
                console.log('postData', postData)
            }
        }

        function buyNow(token, addText, userId) {

            addToBasketVariants(token, addText, userId)
            location.href = '/basket';
        }

        // Show more
        const Utils = {
            addClass: function (element, theClass) {
                element.classList.add(theClass);
            },

            removeClass: function (element, theClass) {
                element.classList.remove(theClass);
            },

            showMore: function (container, excerpt) {
                container.addEventListener("click", event => {
                    if (event.target.matches(".js-show-more")) {
                        const link = event.target;
                        const linkText = link.textContent;
                        event.preventDefault();

                        if (linkText === '{{trans('labels.more')}}') {
                            link.textContent = '{{trans('labels.less')}}';
                            this.removeClass(excerpt, "excerpt-hidden");
                            this.addClass(excerpt, "excerpt-visible");
                        } else {
                            link.textContent = '{{trans('labels.more')}}';
                            this.removeClass(excerpt, "excerpt-visible");
                            this.addClass(excerpt, "excerpt-hidden");
                        }
                    }
                });
            }
        };

        const ExcerptWidget = {
            showMore: function (showMoreLinksTarget, excerptTarget) {
                const showMoreLinks = document.querySelectorAll(showMoreLinksTarget);

                showMoreLinks.forEach(function (link) {
                    const excerpt = link.previousElementSibling.querySelector(excerptTarget);
                    Utils.showMore(link, excerpt);
                });
            }
        };

        ExcerptWidget.showMore('.js-show-more', '.js-excerpt');

        function openConsultationModal(el, modal, close) {
            modal = document.querySelector(modal)
            close = document.querySelector(close)
            const body = document.body
            modal.style.display = 'flex'
            body.classList.add('locked')
            document.getElementById('consultationProductId').value = "{{$product->id}}";

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

        if ({!! $product['id'] !!} === 2594) {

        } else if ({!! $product['id'] !!} === 19) {

        } else {

        }

        (function setCounterOnReloadNType() {
            function updatePrice() {
                document.querySelector('.input-number-group .input-number')
                    .value = data['quantity'] = productQuantity.value;

                const productPrice = modulinePrice || data['product_variant']?.price || data['product'].price;
                document.querySelector('.price-body__nr').textContent = `${parseInt(productQuantity.value) * parseInt(productPrice)}`;
            }

            let productQuantity = document.querySelector('#productQuantity');
            if (productQuantity) {
                productQuantity.value = 1;

                productQuantity.addEventListener('input', () => {
                    if (typeof constructorTotalPrice === 'function') {
                        constructorTotalPrice();
                        checkQuantity();
                    } else {
                        updatePrice();
                        checkQuantity();
                    }
                });
                productQuantity.addEventListener('change', () => {
                    if (typeof constructorTotalPrice === 'function') {
                        constructorTotalPrice();
                        checkQuantity();
                    } else {
                        updatePrice();
                        checkQuantity();
                    }
                });
            }
        })()

        let modalMoreSwiper = new Swiper(".modal-more-swiper", {
            slidesPerView: 1,
            spaceBetween: 15,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

    </script>

@endpush

