@extends('layouts.client')
{{--    @php--}}
{{--     switch ($industry->id){--}}
{{--             case 1:--}}
{{--    $color='rgba(238, 42, 38, 0.03)';--}}
{{--    break;--}}
{{--    case 2:--}}
{{--        $color = 'rgba(38, 78, 238, 0.03)';--}}
{{--        break;--}}
{{--         case 3:--}}
{{--        $color = 'rgba(171, 38, 238, 0.03)';--}}
{{--        break;--}}
{{--         case 4:--}}
{{--        $color = 'rgba((38, 238, 85, 0.03)';--}}
{{--        break;--}}

{{--        default:--}}
{{--          $color='rgba(238, 42, 38, 0.03)';--}}
{{--     }--}}

{{--        @endphp--}}
@section('content')
    <main>
        <section class="mainindustry-section">
            <div class=" main_slider_block " style="background-image: url({{url('storage/'.$industry->image_preview)}});">
                <h1 class="mainindustry-section__title ">ViTRA <span class="industry-title__span ">{{$title}}</span></h1>
            </div>
        </section>
        @include('client.components.breadСrumbs')


        <section class="industry-info__slider industry-info main-section">
            <div class="custom-container industry-info__container">
                <div class="industry-info__cards">
                    @foreach($allCategories as $category)
                        @include('client.components.blocks.categoryCard', ['category'=>$category, 'route'=>'client.category'])
                    @endforeach

                    @if(count($productsNoCategory)>0)
                        @foreach($productsNoCategory as $product)
{{--                                @include('client.components.blocks.categoryCard', ['category'=>$product, 'route'=>'client.product', 'subcategoryId'=>0])--}}
                                @include('client.components.productPage.productCard', ['$product'=>$product])
                        @endforeach
                        @endif


                </div>
            </div>
        </section>

        @if(count($industryCategories)>0 && count($industryCategories[0]['addProducts']) >0)
        <section class="more-ideas__section more-ideas">
            <div class="custom-container mode-ideas__container">
                <h2 class="more-ideas__title">{{trans('labels.moreIdeas')}}</h2>



                <div class="swiper filerSwiper categoryFilerSwiper">
                    <div class="swiper-wrapper swiper-tab-nav">
                        <div class="swiper-slide filter-slide">
                            <button class="filter-slide-btn active" onclick="categoryHandler(this, 0)">{{trans('labels.all')}}</button>
                        </div>

                        @foreach($industryCategories as $category)
                            <div class="swiper-slide filter-slide">
                                <button class="filter-slide-btn" onclick="categoryHandler(this, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                            </div>

                        @endforeach
                    </div>
{{--                    <div class="swiper-scrollbar filter-swiper-scrollbar"></div>--}}
                </div>

                <!-- Slider main container -->
                <div id="moreIdeasContainer">

                <div class="swiper moreIdeas">
                    <div class="swiper-wrapper more-ideas-wrapper" >
                        <!-- Slides -->
                        @foreach($industryCategories as $category)
                            @if(count($category['addProducts']) >0)


                                @foreach($category['addProducts'] as $product)
{{--                                    @dump($product)--}}
                            <div class="swiper-slide" >
                                <a href="{{route('client.product', [$product->categoryId, $product->subcategoryId, $product->slug])}}"><img src="{{url('storage/'.$product->image_preview)}}" alt="{{$product->name_ro}}"></a>
                            </div>
                                @endforeach
                            @endif
                        @endforeach
                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>


{{--                    <div class="swiper-scrollbar__position">--}}
                        <div class="swiper-scrollbar more-ideas-scrollbar-track">
                            <div class="swiper-scrollbar-drag more-ideas-scrollbar-handle" ></div>
                        </div>
{{--                    </div>--}}

                </div>
                </div>
            </div>
        </section>
        @endif


    </main>

@endsection

@push('script')
    <script src="{{asset('js/industry.js')}}"></script>
    <script src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/Draggable.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/ScrollToPlugin.min.js"></script>
    <script>

        const industryCategories = {!! $industryCategories !!};
        let products = [];


        function createDraggable() {
            Draggable.create('.more-ideas-scrollbar-handle', {
                type: "x",
                bounds: ".more-ideas-scrollbar-track",
                throwProps: true,
                onDrag() {
                    gsap.to('.more-ideas-wrapper', {x: -this.x, overwrite: true});
                }
            });
        }
        createDraggable()

        industryCategories.forEach(category =>{

            category['addProducts'].forEach(product =>{
                product['industry_category'] =category['id']
                products.push(product)
            })

        })

        const moreIdeasContainer =document.getElementById('moreIdeasContainer')
        function categoryHandler(el, categoryId) {
            document.querySelectorAll('.filter-slide-btn').forEach(item=>{
                item.classList.remove('active')
            })
            el.parentElement.parentElement.querySelectorAll('.swiper-slide').forEach(item=>{
                item.classList.remove('swiper-slide-active')
            })
            el.classList.add('active')
            el.parentElement.classList.add('swiper-slide-active')
            if(categoryId === 0) {
                moreIdeasContainer.innerHTML=`<div class="swiper moreIdeas">
                    <div class="swiper-wrapper more-ideas-wrapper" >
                    ${products.map(product=>{
                        const url = window.location.origin+'/product/' + product['id']+'/0';
                        return `  <div class="swiper-slide" >
                                <a href="${url}"><img src="/storage/${product['image_preview']}" alt="${product['name_ro']}"></a>
                            </div>`
                    }).join('')}
                      </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-scrollbar more-ideas-scrollbar-track">
                            <div class="swiper-scrollbar-drag more-ideas-scrollbar-handle" ></div>
                    </div>`

                let moreIdeas = new Swiper('.moreIdeas', {
                    slidesPerView: "auto",
                    spaceBetween: 15,
                    pagination: false,
                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },

                    loop: true,
                    // And if we need scrollbar
                    scrollbar: {
                        el: '.swiper-scrollbar',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 15
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        768: {
                            slidesPerView: "auto",
                            spaceBetween: 20
                        },
                    }

                });
                createDraggable()

            } else {
                moreIdeasContainer.innerHTML=`<div class="swiper moreIdeas">
                    <div class="swiper-wrapper more-ideas-wrapper" >
                    ${products.map(product=>{

                    if(product['industry_category'] ===categoryId) {

                            const url = window.location.origin+'/product/' + product['id']+'/0';
                            return `  <div class="swiper-slide" >
                                <a href="${url}"><img src="/storage/${product['image_preview']}" alt="${product['name_ro']}"></a>
                            </div>`
                    }
                }).join('')}
                      </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-scrollbar more-ideas-scrollbar-track">
                            <div class="swiper-scrollbar-drag more-ideas-scrollbar-handle" ></div>
                    </div>`

                let moreIdeas = new Swiper('.moreIdeas', {
                    slidesPerView: 1,
                    spaceBetween: 15,
                    pagination: false,
                    loop: true,
                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },

                    // And if we need scrollbar
                    scrollbar: {
                        el: '.swiper-scrollbar',
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 15
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 20
                        },
                        768: {
                            slidesPerView: "auto",
                            spaceBetween: 20
                        },
                    }

                });
                createDraggable()
            }
        }
    </script>
@endpush

@section('after_styles')
    <style>
        {{--.industry-title::after {--}}
        {{--    background-color: {!! $color !!};--}}

        {{--}--}}
    </style>
@endsection
