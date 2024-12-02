@extends('layouts.client')

@php
    $imageSecond = isset($subcategory->image_second)?$subcategory->image_second : $subcategory->image_preview;


       $brandRequest = request()->get('brand');
       $sortRequest = request()->get('sort');

@endphp
@section('content')
    <main>
        <section class="mainindustry-section">
            <div class=" main_slider_block"
                 style="background-image: url({{url('storage/'.$subcategory->image_main)}});">
                <h1 class="mainindustry-section__title text-uppercase">{{$title}}</h1>
            </div>
        </section>
        @include('client.components.breadСrumbs')

        <section class="products-info__section products-info d-none d-xl-block">
            <div class="custom-container products-info__container">
                <div class="products-info__body row w-100">
                    <div class="products-info__img col-sm-6">
                        <img src="{!!url('storage/'.$imageSecond)  !!}" alt="" class="products-info__img1">
                    </div>
                    <div class="products-info__text col-sm-6">
                        <p class="products-info__title">{{$title}}</p>
                        <p class="products-info__descr">{{$language->replace($subcategory->description_ro, $subcategory->description_ru,$subcategory->description_en )}}</p>
                        <div class="products-info__consult align-items-start">
                            <img src="{{asset('images/product-info__consult-removebg-preview.png')}}" alt="Call"
                                 class="products-info__consult-img">
                            <p class="products-info__consult-text">{{trans('labels.consultDescription')}}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button
                                class="custom-btn products-info__btn offer-body__text-info-btn">{{trans('labels.requestConsultation')}}</button>

                        </div>
                    </div>
                </div>
            </div>
        </section>


        @if(isset($subcategoryTypes))
            <section class="custom-container mt-5">
                <div class="">
                    @foreach($subcategoryTypes as $key=>$type)
                        <div class=" mb-5">
                            <div class="row title_image_container" id="subcategoryItem{{$key}}">
                                <div class="type_text_container col-md-6">
                                    <h3 class="type_title">{{$language->replace($type->title_ro, $type->title_ru,$type->title_en )}}</h3>
                                    <div>
                                        <div class="type_description hidden"
                                             id="type_description{{$key}}">{!!$language->replace($type->description_ro, $type->description_ru,$type->description_en)!!}</div>
                                    </div>
                                    @if($type->specifications == 1)
                                        <div class="d-flex justify-content-end">
                                            <a href="#" role="button" onclick="showMore(event, {{$key}})"
                                               class="type_show-more">{{trans('labels.more')}}</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <img src="{{url('storage/'.$type->image_preview)}}" alt="{{$type->title_ro}}"
                                         class="type_image ">
                                </div>
                            </div>


                            @if($type->specifications == 1)
                                <div class=" see_more_block" id="see_more_block{{$key}}">
                                    <ul class="type_list">
{{--                                        @dd($type)--}}

                                        @if($type->length != null || $type->depth != null || $type->height != null)
                                        <li class="type_block">
                                            <p class="type_description_title">{{trans('labels.dimensions')}}</p>
                                            <ul>
                                                @if($type->length != null)
                                                    <li class="type_item">
                                                        <span>{{trans('labels.length')}}: </span>
                                                        <span>{{$type->length}}</span>
                                                    </li>
                                                @endif
                                                @if($type->depth != null)
                                                    <li class="type_item">
                                                        <span>{{trans('labels.depth')}}: </span>
                                                        <span>{{$type->depth}}</span>
                                                    </li>
                                                @endif
                                                    @if($type->height != null)
                                                <li class="type_item">
                                                    <span>{{trans('labels.height')}}: </span>
                                                    <span>{{$type->height}}</span>
                                                </li>
                                                    @endif
                                            </ul>
                                        </li>
                                        @endif
                                        @if($type->components_ro != null && $type->components_ro != '<p>&nbsp;</p>' )

                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.components')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->components_ro, $type->components_ru,$type->components_en ) !!}
                                                </div>

                                            </li>
                                        @endif

                                        @if($type->type != null )
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.type')}}</p>
                                                <div
                                                    class="type_item ">{!! $language->replace($type->type_ro, $type->type_ru,$type->type_en ) !!}</div>
                                            </li>
                                        @endif

                                        @if($type->perforation_pitch != null )
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.perforation_pitch')}}</p>
                                                <p class="type_item ">{!! $type->perforation_pitch !!}</p>
                                            </li>
                                        @endif

                                        @if($type->inclination_angle != null )
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.inclination_angle')}}</p>
                                                <p class="type_item ">{!! $type->inclination_angle !!}</p>
                                            </li>
                                        @endif

                                        @if($type->shelf_height != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.shelf_height')}}</p>
                                                <p class="type_item ">{!! $type->shelf_height !!}</p>
                                            </li>
                                        @endif

                                        @if($type->coating != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.coating')}}</p>
                                                <div
                                                    class="type_item ">{!! $language->replace($type->coating_ro, $type->coating_ru,$type->coating_en ) !!}</div>
                                            </li>
                                        @endif

                                        @if($type->available_basins != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.available_basins')}}</p>
                                                <p class="type_item ">{!! $type->available_basins !!}</p>
                                            </li>
                                        @endif

                                        @if($type->electrical_parameters != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.electrical_parameters')}}</p>
                                                <p class="type_item ">{!! $type->electrical_parameters !!}</p>
                                            </li>
                                        @endif

                                        @if($type->available_conveyors != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.available_conveyors')}}</p>
                                                <p class="type_item ">{!! $type->available_conveyors !!}</p>
                                            </li>
                                        @endif

                                        @if($type->protection_class != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.protection_class')}}</p>
                                                <p class="type_item ">{!! $type->protection_class !!}</p>
                                            </li>
                                        @endif

                                        @if($type->certificates != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.certificates')}}</p>
                                                <p class="type_item ">{!! $type->certificates !!}</p>
                                            </li>
                                        @endif
                                        @if($type->processor != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.processor')}}</p>
                                                <p class="type_item ">{!! $type->processor !!}</p>
                                            </li>
                                        @endif

                                        @if($type->operating_system != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.operating_system')}}</p>
                                                <p class="type_item ">{!! $type->operating_system !!}</p>
                                            </li>
                                        @endif

                                        @if($type->software != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.software')}}</p>
                                                <p class="type_item ">{!! $type->software !!}</p>
                                            </li>
                                        @endif

                                        @if($type->shelves_depth != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.shelves_depth')}}</p>
                                                <p class="type_item ">{!! $type->shelves_depth !!}</p>
                                            </li>
                                        @endif

                                        @if($type->temperature_class != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.temperature_class')}}</p>
                                                <p class="type_item ">{!! $type->temperature_class !!}</p>
                                            </li>
                                        @endif
                                        @if($type->cooling_system != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.cooling_system')}}</p>
                                                <p class="type_item ">{!! $type->cooling_system !!}</p>
                                            </li>
                                        @endif
                                        @if($type->refrigerant != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.refrigerant')}}</p>
                                                <p class="type_item ">{!! $type->refrigerant !!}</p>
                                            </li>
                                        @endif
                                        {{--added--}}


                                        @if($type->maximum_lifting_height != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.maximum_lifting_height')}}</p>
                                                <p class="type_item ">{!! $type->maximum_lifting_height !!}</p>
                                            </li>
                                        @endif

                                        @if($type->battery_type != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.battery_type')}}</p>
                                                <p class="type_item ">{!! $type->battery_type !!}</p>
                                            </li>
                                        @endif
                                        @if($type->platform_area != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.platform_area')}}</p>
                                                <p class="type_item ">{!! $type->platform_area !!}</p>
                                            </li>
                                        @endif

                                        @if($type->maximum_load != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.maximum_load')}}</p>
                                                <p class="type_item ">{!! $type->maximum_load !!}</p>
                                            </li>
                                        @endif

                                        @if($type->fork_width != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.fork_width')}}</p>
                                                <p class="type_item ">{!! $type->fork_width !!}</p>
                                            </li>
                                        @endif

                                        @if($type->fork_length != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.fork_length')}}</p>
                                                <p class="type_item ">{!! $type->fork_length !!}</p>
                                            </li>
                                        @endif

                                        @if($type->battery_capacity != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.battery_capacity')}}</p>
                                                <p class="type_item ">{!! $type->battery_capacity !!}</p>
                                            </li>
                                        @endif

                                        @if($type->weight != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.weight')}}</p>
                                                <p class="type_item ">{!! $type->weight !!}</p>
                                            </li>
                                        @endif

                                        @if($type->volume != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.volume')}}</p>
                                                <p class="type_item ">{!! $type->volume !!}</p>
                                            </li>
                                        @endif

                                        @if($type->maximum_height != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.maximum_height')}}</p>
                                                <p class="type_item ">{!! $type->maximum_height !!}</p>
                                            </li>
                                        @endif

                                        @if($type->minimum_height != null)
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.minimum_height')}}</p>
                                                <p class="type_item ">{!! $type->minimum_height !!}</p>
                                            </li>
                                        @endif





                                        @if($type->material_ro != null && $type->material_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.material')}}</p>
                                                <div
                                                    class="type_item ">{!! $language->replace($type->material_ro, $type->material_ru,$type->material_en ) !!}</div>
                                            </li>
                                        @endif

                                        @if($type->type_ro != null && $type->type_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.type')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->type_ro, $type->type_ru,$type->type_en ) !!}
                                                </div>
                                            </li>
                                        @endif

                                        @if($type->panel_type_ro != null && $type->panel_type_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.panel_type')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->panel_type_ro, $type->panel_type_ru,$type->panel_type_en ) !!}
                                                </div>
                                            </li>
                                        @endif

                                        @if($type->construction_principle_ro != null && $type->construction_principle_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.construction_principle')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->construction_principle_ro, $type->construction_principle_ru,$type->construction_principle_en ) !!}
                                                </div>

                                            </li>
                                        @endif

                                        @if($type->electricity_connection_ro != null && $type->electricity_connection_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.electricity_connection')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->electricity_connection_ro, $type->electricity_connection_ru,$type->electricity_connection_en ) !!}
                                                </div>

                                            </li>
                                        @endif

                                        @if($type->working_places_ro != null && $type->working_places_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.working_places')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->working_places_ro, $type->working_places_ru,$type->working_places_en ) !!}
                                                </div>

                                            </li>
                                        @endif


                                        @if($type->warranty_ro != null && $type->warranty_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.warranty')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->warranty_ro, $type->warranty_ru,$type->warranty_en ) !!}
                                                </div>
                                            </li>
                                        @endif

                                        @if($type->touch_screen_ro != null && $type->touch_screen_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.touch_screen')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->touch_screen_ro, $type->touch_screen_ru,$type->touch_screen_en ) !!}
                                                </div>
                                            </li>
                                        @endif

                                        @if($type->interactive_support_ro != null && $type->interactive_support_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.interactive_support')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->interactive_support_ro, $type->interactive_support_ru,$type->interactive_support_en ) !!}
                                                </div>
                                            </li>
                                        @endif

                                        @if($type->integration_options_ro != null && $type->integration_options_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.integration_options')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->integration_options_ro, $type->integration_options_ru,$type->integration_options_en ) !!}
                                                </div>
                                            </li>
                                        @endif
                                        @if($type->barcode_scanne_ro != null && $type->barcode_scanne_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.barcode_scanne')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->barcode_scanne_ro, $type->barcode_scanne_ru,$type->barcode_scanne_en ) !!}
                                                </div>
                                            </li>
                                        @endif

                                        @if($type->integrated_accessories_ro != null && $type->integrated_accessories_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.integrated_accessories')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->integrated_accessories_ro, $type->integrated_accessories_ru,$type->integrated_accessories_en ) !!}
                                                </div>
                                            </li>
                                        @endif

                                        @if($type->front_type_ro != null && $type->front_type_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.front_type')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->front_type_ro, $type->front_type_ru,$type->front_type_en ) !!}
                                                </div>
                                            </li>
                                        @endif
                                        @if($type->energy_efficiency_class_ro != null && $type->energy_efficiency_class_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.energy_efficiency_class')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->energy_efficiency_class_ro, $type->energy_efficiency_class_ru,$type->energy_efficiency_class_en ) !!}
                                                </div>
                                            </li>
                                        @endif
                                        @if($type->energy_efficient_features_ro != null && $type->energy_efficient_features_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.energy_efficient_features')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->energy_efficient_features_ro, $type->energy_efficient_features_ru,$type->energy_efficient_features_en ) !!}
                                                </div>
                                            </li>
                                        @endif
                                        @if($type->wheel_ro != null && $type->wheel_ro != '<p>&nbsp;</p>')
                                            <li class="type_block">
                                                <p class="type_description_title">{{trans('labels.wheel')}}</p>
                                                <div class="type_item">
                                                    {!! $language->replace($type->wheel_ro, $type->wheel_ru,$type->wheel_en ) !!}
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
        {{----product-cards----}}

        @if(count($products) >0)
            <section class="product-cards__section product-cards">
                <form action="" method="GET" class="py-3" id="productsForm">
                    <div class="custom-container">
                        <div class="filter-container">
                            <h2 class="product-cards__title m-0">{!! trans('labels.lookProducts') !!}</h2>
                            <div class="filter-select__wrapper">
                                <div class="filter-select__container">
                                    <select class="filter-select__select" name="sort" id=""
                                            onchange="productsFiltered()">
                                        <option value="1" class="filter-select__option" selected="">
                                            {!! trans('labels.popular') !!}
                                        </option>
                                        <option value="2"
                                                {{$sortRequest == 2 ? 'selected': ''}} class="filter-select__option">
                                            {!! trans('labels.new') !!}
                                        </option>
                                        <option value="3"
                                                {{$sortRequest == 3 ? 'selected': ''}} class="filter-select__option">
                                            {!! trans('labels.expensive') !!}
                                        </option>
                                        <option value="4"
                                                {{$sortRequest == 4 ? 'selected': ''}} class="filter-select__option">
                                            {!! trans('labels.cheap') !!}
                                        </option>
                                    </select>
                                    <img src="{{asset('images/arrow-down.svg')}}" alt="">
                                </div>

{{--                                <div class="filter-select__container">--}}
{{--                                    <select class="filter-select__select" name="brand" id=""--}}
{{--                                            onchange="productsFiltered()">--}}
{{--                                        <option value="0" class="filter-select__option" selected="">Brand</option>--}}
{{--                                        @foreach($brands as $brand)--}}
{{--                                            <option value="{{$brand}}"--}}
{{--                                                    {{$brandRequest == $brand ? 'selected': ''}} class="filter-select__option">{{$brand}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    <img src="{{asset('images/arrow-down.svg')}}" alt="">--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <div class="product-cards__body">
                            @foreach($products as $product)
                                @include('client.components.productPage.productCard', ['$product'=>$product])
                            @endforeach
                        </div>

                        <div class="pagination-container">
                            {{--                            {{ $products->appends($_GET)->links() }}--}}
                            {{ $products->appends(request()->query())->links('client.vendor.pagination.custom') }}

                        </div>
                    </div>
                </form>
            </section>
            {{--        <div class="custom-container">--}}
            {{--         --}}
            {{--        </div>--}}

        @endif

        {{--     Products slider   ---------}}

        <section class="products-slider__section">
            <div class="custom-container">
                <div class="swiper recommendsCategorySwiper">
                    <h2 class="swiper-title">{!! trans('labels.categoryRecommend') !!}</h2>
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach($categoriesRecommended as $category)
                            <div class="swiper-slide swiper-slide__img" style=" ">
                                <a href="{{route('client.category', $category->slug)}}">
                                    <img src="{{url('storage/'.$category->image_preview)}}" alt="">
                                </a>

                                <a class="swiper-slide__text d-block"
                                   href="{{route('client.category', $category->slug)}}">
                                    {{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}
                                </a>
                            </div>
                        @endforeach


                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
        </section>


    </main>
@endsection

@push('script')

    <script>

        {{--const products = [{!!implode(",",$products)  !!}]  ;--}}
        {{--const products = {!!json_decode($products)  !!};--}}
        {{--console.log(products)--}}

        // const productsFavorite = $.cookie('vitraFavorite');
        // if(productsFavorite && products.length > 0) {
        //     const favoritesParsed = JSON.parse(productsFavorite)
        //
        //     if(products.length>0) {
        //         products.forEach(item => {
        //             favoritesParsed.forEach(favorite => {
        //                 if(favorite.product_id === item.id) {
        //                     const productCard = document.getElementById('productCard'+item.id);
        //                     const favoriteImage = productCard.querySelector('.favorite_icon')
        //                     favoriteImage.src='/images/product/heart-red-full.png';
        //                     favoriteImage.dataset.selected='1';
        //                 }
        //             })
        //         })
        //     }
        // }

        function productsFiltered() {
            document.getElementById('productsForm').submit();
        }

        function showMore(event, index) {
            const link = event.target;
            const linkText = link.textContent;
            event.preventDefault();
            if (linkText === '{{trans('labels.more')}}') {
                link.textContent = '{{trans('labels.less')}}';
                if (document.getElementById('see_more_block' + index)) {
                    document.getElementById('see_more_block' + index).style.display = 'block';
                }

                document.getElementById('type_description' + index).classList.toggle('hidden')
                document.getElementById('subcategoryItem' + index).scrollIntoView({behavior: "smooth"});
            } else {
                link.textContent = '{{trans('labels.more')}}';
                document.getElementById('see_more_block' + index).style.display = 'none';
                document.getElementById('type_description' + index).classList.toggle('hidden')

            }
        }


        // ПЕРВЫЙ аргумент - класс кнопки, при клике на которую будет открываться модальное окно.
        // ВТОРОЙ аргумент - класс самого модального окна.
        // ТРЕТИЙ аргумент - класс кнопки, при клике на которую будет закрываться модальное окно.
        bindModal('.offer-body__text-info-btn', '.modal__wrapper-offer', '.modal__close-offer')


    </script>
@endpush

@section('after_styles')
    <style>
        nav.flex.items-center.justify-between {
            padding-top: 30px;
        }

        span.relative.z-0.inline-flex svg {
            width: 25px;
        }

        .flex.justify-between.flex-1 {
            display: none;
        }

        .text-sm.text-gray-700.leading-5 {
            margin-bottom: 15px;
        }

        .filter-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            margin-bottom: 1rem;
            gap: 30px;
        }

        @media (min-width: 751px) {
            .filter-container {
                flex-direction: row;
                align-items: center;
            }
        }

        .filter-select__wrapper {
            width: 100%;
            display: grid;
            gap: 15px;
            grid-template-columns: 1fr 1fr;
            max-width: 460px;
        }

        @media (max-width: 400px) {
            .filter-select__wrapper {
                grid-template-columns: 1fr;
                gap: 5px;
            }
        }

        .filter-select__container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .filter-select__container > select {
            width: 100%;
            height: 35px;
            padding-left: 10px;
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none;
            background: unset;
            cursor: pointer;
            border: 1px solid black;
            border-radius: 25px;
            color: black;
        }

        .filter-select__container > select:focus {
            outline: none;
        }

        .filter-select__container > img {
            width: 14px;
            height: auto;
            aspect-ratio: 1;
            position: absolute;
            right: 14px;
            pointer-events: none;
        }

        .pagination-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .pagination-next, .pagination-prev {
            width: fit-content;
            height: 35px;
            border-radius: 25px;
            padding: 0 1rem;
            white-space: nowrap;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 3px;
            transition: background-color 0.3s ease;
        }

        .pagination-next:hover, .pagination-prev:hover {
            background-color: rgba(196, 196, 196, 0.5);
        }

        .pagination-next {
            margin-left: 5px;
        }

        .pagination-prev {
            margin-right: 5px;
        }

        @media (max-width: 576px) {
            .pagination-next, .pagination-prev {
                display: none;
            }
        }

        .page {
            width: 35px;
            height: auto;
            aspect-ratio: 1;
            background-color: transparent;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
            cursor: pointer;
            font-size: 18px;
            font-family: "GalanoGrotesque", sans-serif;
            font-weight: 500;
            user-select: none;
        }

        .page:hover {
            background-color: rgba(196, 196, 196, 0.5);
        }

        .page.active {
            background-color: #C4C4C4;
            cursor: default;
        }

        .page.ellipsis {
            pointer-events: none;
        }

    </style>
@endsection
