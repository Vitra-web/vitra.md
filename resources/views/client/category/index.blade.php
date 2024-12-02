@extends('layouts.client')
@php
$imageUrl = isset($category->image_main) ? $category->image_main : $category->image_preview;
@endphp
@section('content')
    <main>

        <section class="mainindustry-section">
            <div class=" main_slider_block " style="background-image: url({{url('storage/'.$imageUrl)}});">
                <h1 class="mainindustry-section__title text-uppercase">{{$title}}</h1>
            </div>
        </section>
        @include('client.components.breadСrumbs')

        <section class="category-items-section category-items">
            <div class="custom-container">
                <div class="category-items__cards">
                    @foreach($subCategories as $category)

                        @include('client.components.blocks.categoryCard', ['category'=>$category, 'route'=>'client.subcategory'])

                    @endforeach
                </div>
            </div>

            @if(count($categoryProducts) > 0)
                <section class="product-cards__section product-cards">
                    <div class="custom-container">
                        <h2 class="product-cards__title">{!! trans('labels.lookProducts') !!}</h2>
                        <div class="product-cards__body">
                            @foreach($categoryProducts as $product)
                                @include('client.components.productPage.productCard', ['$product'=>$product])
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

        </section>

        @if(count($categoryIdeas)>0  && $isProducts)
        <section class="more-ideas__section more-ideas">
            <div class="custom-container mode-ideas__container">
                <h2 class="more-ideas__title">{{trans('labels.moreIdeas')}}</h2>

                <div class="swiper filerSwiper ll subcategoryFilerSwiper">
                    <div class="swiper-wrapper swiper-tab-nav">
                        <div class="swiper-slide filter-slide">
                            <button class="filter-slide-btn active" onclick="categoryHandler(this, 0)">{{trans('labels.all')}}</button>
                        </div>
                        @foreach($categoryIdeas as $category)
                            <div class="swiper-slide filter-slide">
                                <button class="filter-slide-btn" onclick="categoryHandler(this, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                            </div>

                        @endforeach
                    </div>
{{--                    <div class="swiper-scrollbar filter-swiper-scrollbar"></div>--}}
                </div>


                <div id="moreIdeasContainer">
                    <div class="swiper moreIdeas">

                        <div class="swiper-wrapper more-ideas-wrapper" >
                            @foreach($categoryIdeas as $category)
                                @if(count($category['addProducts']) >0)

                                    @foreach($category['addProducts'] as $product)
                                        @if(isset($product->id))
                                        <div class="swiper-slide" style="width:300px">
                                            <a href="{{route('client.product', [$product->categoryId, $product->subcategoryId, $product->slug ])}}"><img src="{{url('storage/'.$product->image_preview)}}" alt="{{$product->name_ro}}"></a>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
{{--                            <!-- Slides -->--}}
{{--                            @foreach($portfolios as $portfolio)--}}
{{--                                <div class="swiper-slide" style="width:300px">--}}
{{--                                    <a href="{{route('client.portfolioView', $portfolio->id)}}"><img src="{{url('storage/'.$portfolio->image_preview)}}" alt=""></a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

                        </div>

                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <div class="swiper-scrollbar more-ideas-scrollbar-track">
                            <div class="swiper-scrollbar-drag more-ideas-scrollbar-handle" ></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        @endif


    </main>
@endsection

@push('script')
    <script src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/Draggable.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/ScrollToPlugin.min.js"></script>
    <script>
        const categoryFilterSwiper = new Swiper('.subcategoryFilerSwiper', {
            slidesPerView: "auto",
            spaceBetween: 0,
            pagination: false,
            // scrollbar: {
            //     el: '.swiper-scrollbar',
            // },

        });


        const categoryIdeas = {!! $categoryIdeas !!};
        let categoryProducts = {!! json_encode($categoryProducts) !!};
        console.log(categoryProducts, 'products')
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

        categoryIdeas.forEach(category =>{
            if(category) {
                category['addProducts'].forEach(product =>{
                    if(product) {
                        product['industry_category'] =category['id']
                        products.push(product)
                    }
                })
            }

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
                    return `  <div class="swiper-slide" style="width:300px">
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
                        return `<div class="swiper-slide" style="width:300px">
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
                    slidesPerView: "auto",
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
