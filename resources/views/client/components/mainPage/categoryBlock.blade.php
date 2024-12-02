<section class="retail-section full_screen_block ">
    <div class="container-custom retail-section__container">
        <div class="retail-section__body retail ">
            <a href="{{route('client.industry', $industries[0]->slug)}}" class="retail__text">
                <div  class="industry_name">
                    <p class="industry_name_products">{{trans('labels.products')}}</p>
                    <p class="industry_name_title">RETAIL</p>
                </div>
                    <button type="button" class="industry_name_btn">
                        <svg width="30px" height="30px">
                            <use xlink:href="{{url('images/svg/up-arrow.svg#upArrow')}}"></use>
                        </svg>
                    </button>

            </a>

            @foreach($retailSolutions as $index=> $solution)
                <div class="retail-img retail-img{{$index+1}}">
                    <a href="{{route('client.industry', $industries[0]->slug)}}" class="d-block w-100 h-100">
                        <img src="{{url('storage/'.$solution->image)}}" alt="Product Image">
                    </a>
                        @foreach($solutionProducts as $key=>$solutionProduct)
                            @if($solution->id == $solutionProduct->solution_id)

                                @include('client.components.point', ['solutionProduct'=>$solutionProduct])

                            @endif
                        @endforeach
                    </div>

            @endforeach
            <a href="{{route('client.industry', $industries[0]->slug)}}" class="retail-more_container">
                <p class=" retail-more">{{trans('labels.moreCategory')}}</p>
                <div class="industry-more_btn_container">
                    <p class="industry-more_btn">

                    </p>
                </div>

            </a>

        </div>

        <div class="swiper-text__body">
            <h2 class="swiper-text__body-title">{{trans('labels.moreSolutions')}}</h2>
            <div class="swiper filerSwiper lifeFilerSwiper">
                <div class="swiper-wrapper swiper-tab-nav">
                    <div class="swiper-slide filter-slide">
                        <button class="filter-slide-btn active portfolio_category_btn1" onclick="portfolioCategoryHandler(this,1, 0)">{{trans('labels.all')}}</button>
                    </div>

                    @foreach($portfolioCategories as $category)
                        @if($category->industry_id == 1 && count($category->portfolios) >0)
                            <div class="swiper-slide filter-slide">
                                <button class="filter-slide-btn portfolio_category_btn1" onclick="portfolioCategoryHandler(this, 1, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                            </div>
                        @endif
                    @endforeach
                </div>
{{--                <div class="swiper-scrollbar filter-swiper-scrollbar"></div>--}}
            </div>
        </div>
        <!-- Slider main container -->
        <div class="swiper retailSwiper industriesSwiper portfolioSwiper1">
            <div class="swiper-wrapper portfolio_container1" >
                <!-- Slides -->
                @foreach($portfolios as $portfolio)
                    @if($portfolio->industry_id ==1)
                        <div class="swiper-slide " >
                            <a href="{{route('client.portfolioView', $portfolio->id)}}">
                                <img class="swiper-slide__img" src="{{url('storage/'.$portfolio->image_preview)}}" alt="Portfolio image">
                            </a>
                            <div class="d-block">
                                <p class="swiper-slide__text">{{$language->replace($portfolio->name_ro, $portfolio->name_ru,$portfolio->name_en )}}</p>
                            </div>
                        </div>

                    @endif
                @endforeach

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <div class="swiper-scrollbar retail-scrollbar-track bar">
                <div class="swiper-scrollbar-drag retail-scrollbar-handle" ></div>

            </div>

{{--            <div class="swiper-scrollbar custom-scrollbar-retail"></div>--}}

        </div>

    </div>

</section>





{{--////-------------logistics-section -----------------//////////--}}

<section class="logistics-section full_screen_block">
    <div class="container-custom logistics-section__container">
        <div class="logistics-section__body logistics ">
            <a href="{{route('client.industry', $industries[1]->slug)}}" class="logistics__text">
                <div  class="industry_name">
                    <p class="industry_name_products">{{trans('labels.products')}}</p>
                    <p class="industry_name_title">LOGISTICS</p>
                </div>
                <button type="button" class="industry_name_btn">
                    <svg width="30px" height="30px">
                        <use xlink:href="{{url('images/svg/up-arrow.svg#upArrow')}}"></use>
                    </svg>
                </button>

            </a>

            @foreach($logisticSolutions as $index=> $solution)
                <div class="logistics-img logistics-img{{$index+1}}">
                    <a href="{{route('client.industry', $industries[1]->slug)}}" class="d-block w-100 h-100">
                        <img src="{{url('storage/'.$solution->image)}}" alt="Product Image">
                    </a>
                    @foreach($solutionProducts as $key=>$solutionProduct)
                        @if($solution->id == $solutionProduct->solution_id)
                            @include('client.components.point', ['solutionProduct'=>$solutionProduct])
                        @endif
                    @endforeach
                </div>
            @endforeach
            <a href="{{route('client.industry', $industries[1]->slug)}}" class="logistics-more-container">
                <p  class=" logistics-more">{{trans('labels.moreCategory')}}</p>
                <div class="industry-more_btn_container">
                    <p class="industry-more_btn">
                    </p>
                </div>

            </a>
        </div>

        <div class="swiper-text__body">
            <h2 class="swiper-text__body-title">{{trans('labels.moreSolutions')}}</h2>
            <div class="swiper filerSwiper lifeFilerSwiper">
                <div class="swiper-wrapper swiper-tab-nav">
                    <div class="swiper-slide filter-slide">
                        <button class="filter-slide-btn active portfolio_category_btn2" onclick="portfolioCategoryHandler(this, 2, 0)">{{trans('labels.all')}}</button>
                    </div>

                    @foreach($portfolioCategories as $category)
                        @if($category->industry_id == 2 && count($category->portfolios) >0)
                            <div class="swiper-slide filter-slide ">
                                <button class="filter-slide-btn portfolio_category_btn2" onclick="portfolioCategoryHandler(this, 2, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                            </div>
                        @endif
                    @endforeach
                </div>
{{--                <div class="swiper-scrollbar filter-swiper-scrollbar"></div>--}}
            </div>
        </div>




        <!-- Slider main container -->
        <div class="swiper logisticsSwiper industriesSwiper portfolioSwiper2">

            <!-- Additional required wrapper -->
            <div class="swiper-wrapper portfolio_container2">
                <!-- Slides -->
                @foreach($portfolios as $portfolio)
                    @if($portfolio->industry_id ==2)
                        <div class="swiper-slide " >
                            <a href="{{route('client.portfolioView', $portfolio->id)}}">
                                <img class="swiper-slide__img" src="{{url('storage/'.$portfolio->image_preview)}}" alt="">
                            </a>
                            <div class="d-block">
                                <p class="swiper-slide__text">{{$language->replace($portfolio->name_ro, $portfolio->name_ru,$portfolio->name_en )}}</p>
                            </div>
                        </div>
                    @endif
                @endforeach


            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <div class="swiper-scrollbar logistics-scrollbar-track">
                <div class="swiper-scrollbar-drag logistics-scrollbar-handle" ></div>
            </div>
{{--            <div class="swiper-scrollbar">--}}
{{--                <div class="swiper-scrollbar-drag swiper-scrollbar-drag-logistics"></div>--}}
{{--            </div>--}}

        </div>

    </div>

</section>

{{--@include('client.components.offerBlock')--}}

{{--////-------------horeca-section -----------------//////////--}}

<section class="horeca-section full_screen_block">
    <div class="container-custom horeca-section__container">
        <div class="horeca-section__body horeca">
            <a href="{{route('client.industry', $industries[2]->slug)}}" class="horeca__text">
                <div class="industry_name" >
                    <p class="industry_name_products">{{trans('labels.products')}}</p>
                    <p class="industry_name_title">HORECA</p>
                </div>
                <button type="button" class="industry_name_btn">
                    <svg width="30px" height="30px">
                        <use xlink:href="{{url('images/svg/up-arrow.svg#upArrow')}}"></use>
                    </svg>
                </button>

            </a>

            @foreach($horecaSolutions as $index=> $solution)
                <div class="horeca-img horeca-img{{$index+1}}">
                    <a href="{{route('client.industry', $industries[2]->slug)}}" class="d-block w-100 h-100">
                        <img src="{{url('storage/'.$solution->image)}}" alt="Product Image">
                    </a>
                    @foreach($solutionProducts as $key=>$solutionProduct)
                        @if($solution->id == $solutionProduct->solution_id)
                            @include('client.components.point', ['solutionProduct'=>$solutionProduct])
                        @endif
                    @endforeach
                </div>
            @endforeach
            <a href="{{route('client.industry', $industries[2]->slug)}}" class="horeca-more-container">
                <p  class=" horeca-more">{{trans('labels.moreCategory')}}</p>
                <div class="industry-more_btn_container">
                    <p class="industry-more_btn">
                    </p>
                </div>
            </a>

        </div>
        <!-- Slider main container -->

            <div class="swiper-text__body">
                <h2 class="swiper-text__body-title">{{trans('labels.moreSolutions')}}</h2>
                <div class="swiper filerSwiper lifeFilerSwiper">
                    <div class="swiper-wrapper swiper-tab-nav">
                        <div class="swiper-slide filter-slide">
                            <button class="filter-slide-btn active portfolio_category_btn3" onclick="portfolioCategoryHandler(this, 3, 0)">{{trans('labels.all')}}</button>
                        </div>

                        @foreach($portfolioCategories as $category)
                            @if($category->industry_id == 3 && count($category->portfolios) >0)
                                <div class="swiper-slide filter-slide">
                                    <button class="filter-slide-btn portfolio_category_btn3" onclick="portfolioCategoryHandler(this, 3, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                                </div>
                            @endif
                        @endforeach
                    </div>
{{--                    <div class="swiper-scrollbar filter-swiper-scrollbar"></div>--}}

                </div>
            </div>

        <div class="swiper horecaSlider industriesSwiper portfolioSwiper3">
            <div class="swiper-wrapper portfolio_container3" >
                <!-- Slides -->
                @foreach($portfolios as $portfolio)
                    @if($portfolio->industry_id == 3)
                        <div class="swiper-slide " >
                            <a href="{{route('client.portfolioView', $portfolio->id)}}">
                                <img class="swiper-slide__img" src="{{url('storage/'.$portfolio->image_preview)}}" alt="">
                            </a>
                            <div class="d-block">
                                <p class="swiper-slide__text">{{$language->replace($portfolio->name_ro, $portfolio->name_ru,$portfolio->name_en )}}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <div class="swiper-scrollbar horeca-scrollbar-track">
                <div class="swiper-scrollbar-drag horeca-scrollbar-handle" ></div>
            </div>
{{--            <div class="swiper-scrollbar os-scrollbar-track">--}}
{{--                <div class="swiper-scrollbar-drag swiper-scrollbar-drag-horeca os-scrollbar-handle" id="handler"></div>--}}
{{--            </div>--}}

        </div>

    </div>

</section>




{{--////-------------life-section -----------------//////////--}}


<section class="life-section full_screen_block">
    <div class="container-custom life-section__container">
        <div class="life-section__body life">
            <a href="{{route('client.industry', $industries[3]->slug)}}"  class="life__text">
                <div class="industry_name">
                    <p class="industry_name_products">{{trans('labels.products')}}</p>
                    <p class="industry_name_title">LIFE</p>
                </div>
                <button type="button" class="industry_name_btn">
                    <svg width="30px" height="30px">
                        <use xlink:href="{{url('images/svg/up-arrow.svg#upArrow')}}"></use>
                    </svg>
                </button>
            </a>
            @foreach($lifeSolutions as $index=> $solution)
                    <div class="life-img life-img{{$index+1}}">
                        <a href="{{route('client.industry', $industries[3]->slug)}}" class="d-block w-100 h-100">
                            <img src="{{url('storage/'.$solution->image)}}" alt="Product Image">
                        </a>
                    @foreach($solutionProducts as $key=>$solutionProduct)
                            @if($solution->id == $solutionProduct->solution_id)
                                @include('client.components.point', ['solutionProduct'=>$solutionProduct])
                            @endif
                        @endforeach
                    </div>

            @endforeach

            <a href="{{route('client.industry', $industries[3]->slug)}}" class="life-img life-more-container">
                <p  class=" life-more">{{trans('labels.moreCategory')}}</p>
                <div class="industry-more_btn_container">
                    <p class="industry-more_btn">
                    </p>
                </div>
            </a>


        </div>
        <!-- Slider main container -->
        <div class="">
            <div class="swiper-text__body">

               <h2 class=" swiper-text__body-title">{{trans('labels.moreSolutions')}}</h2>
               <div class="swiper filerSwiper lifeFilerSwiper">
                   <div class="swiper-wrapper swiper-tab-nav">
                       <div class="swiper-slide filter-slide">
                           <button class="filter-slide-btn filter_solution_btn active" onclick="categoryHandler(this, 0)">{{trans('labels.all')}}</button>
                       </div>

                       @foreach($solutionCategories as $category)
                           @if(count($category->solutions) > 0 )
                               <div class="swiper-slide filter-slide">
                                   <button class="filter-slide-btn filter_solution_btn" onclick="categoryHandler(this, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                               </div>
                           @endif

                       @endforeach
                   </div>

{{--                   <div class="swiper-scrollbar filter-swiper-scrollbar"></div>--}}
               </div>

              </div>

            <div class="swiper lifeSwiper industriesSwiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper life_solution_swiper" id="solution_slider">

                @foreach($lifeSolutionsAll as $solution)

                        <div class="swiper-slide swiper-slide__img ">
                            <div style="width: 100%; position: relative" id="previewImageContainer">
                                <img src="{{url('storage/'.$solution->image)}}" alt="Product Image"  style='cursor:pointer' onclick="solutionHandler({{$solution->id}})">
                            @foreach($solutionProducts as $key=>$solutionProduct)
                                @if($solution->id == $solutionProduct->solution_id)
                                        @include('client.components.point', ['solutionProduct'=>$solutionProduct])

                                @endif
                            @endforeach
                            </div>
                        </div>

                @endforeach


            </div>
                <div class="solutions_container">
                    @foreach($lifeSolutionsAll as $solution)
                        @include('client.components.modals.solutionModal', ['solution'=>$solution, 'solutionProducts'=>$solutionProducts])
                    @endforeach
                </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

{{--            <div class="swiper-scrollbar">--}}
{{--                <div class="swiper-scrollbar-drag swiper-scrollbar-drag-life"></div>--}}
{{--            </div>--}}
                <div class="swiper-scrollbar life-scrollbar-track">
                    <div class="swiper-scrollbar-drag life-scrollbar-handle" ></div>
                </div>

        </div>
        </div>

    </div>


</section>



@push('script')
    <script>

        const solutionCategories = {!! $solutionCategories !!};
        const solutions = {!! $lifeSolutionsAll!!};
        const solutionProducts = {!! $solutionProducts!!};
        const portfolios = {!! $portfolios !!};
        const solutionSlider =document.getElementById('solution_slider')

        console.log('solutionCategories',solutionCategories)
        console.log('portfolios', portfolios)

        function imgHover() {
            document.querySelectorAll('.img_point_container').forEach(item=>{
                item.addEventListener('mouseover', function() {
                    this.children[0].children[0].style.display = 'block'
                    this.children[0].children[0].style.zIndex = 100
                })
                item.addEventListener('mouseout', function() {
                    this.children[0].children[0].style.display = 'none'
                    this.children[0].children[0].style.zIndex = 0
                })
            })

        }
        imgHover()

        function categoryHandler(el, categoryId){
            document.querySelectorAll('.filter_solution_btn').forEach(item=>{
                item.classList.remove('active')
            })
            el.parentElement.parentElement.querySelectorAll('.swiper-slide').forEach(item=>{
                item.classList.remove('swiper-slide-active')
            })
            el.classList.add('active')
            el.parentElement.classList.add('swiper-slide-active')

            const labels = {
                'cod': '{!! trans('labels.product_code') !!}',
                'ascConsultation': '{!! trans('labels.ascConsultation') !!}',
            }


            if(parseInt(categoryId) === 0){
                solutionSlider.innerHTML =  solutions.map(solution =>{


            return `<div class="lifeSwiper swiper-slide swiper-slide__img" >
                            <div style="width: 100%; position: relative" id="previewImageContainer">
                                <img src="/storage/${solution['image']}" style='cursor:pointer' onclick="solutionHandler(${solution['id']})" alt="Product Image">${solutionProducts.map((product, key)=>{
                if(solution['id'] === product['solution_id']) {
                    return ` <div class="img_point_container" style="top: ${product['percent_y']}%; left: ${product['percent_x']}%">
                                <div class="img_point " id="img_point${key}" >
                                    <div class="img_point__body  point__body_left" >
                                        <div class="img_point__body--info">
                                            <h4 class="img_point__body--info-title">
                                                <a href="/product/${product['productItem']/0}"> ${product['productItem']['name']}</a>
                                            </h4>
                                            <div class="img_point__body--code">
                                              <p >Cod Produs: </p>
                                              <p class="bold">${product['productItem']['code']}</p>
                                             <a href="/product/${product['productItem']/0}" class="img_point__more_link">
                                                <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                            </a>
                                            </div>
                                            <a class="img_point_price" href="/product/${product['productItem']/0}" >
                                                     ${product['productItem']['price'] > 10000 ? labels.cod : product['productItem']['price'] + 'MDL' }
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>`
                        }
                    }).join("")}</div></div>`

            }).join("")
        } else {
            solutionSlider.innerHTML =  solutions.map(solution =>{
                if(parseInt(solution['category_id']) === parseInt(categoryId)){
                    return `<div class="lifeSwiper swiper-slide swiper-slide__img" >
                                    <div style="width: 100%; position: relative" id="previewImageContainer">
                                        <img src="/storage/${solution['image']}" style='cursor:pointer' alt="Product Image" onclick="solutionHandler(${solution['id']})">
                    ${solutionProducts.map((product, key)=>{
                        if(solution['id'] === product['solution_id']) {
                            return ` <div class="img_point_container" style="top: ${product['percent_y']}%; left: ${product['percent_x']}%">
                                <div class="img_point " id="img_point${key}" >
                                    <div class="img_point__body  point__body_left" >
                                        <div class="img_point__body--info">
                                            <h4 class="img_point__body--info-title">
                                                <a href="/product/${product['productItem']/0}"> ${product['productItem']['name']}</a>
                                            </h4>
                                            <div class="img_point__body--code">
                                              <p >Cod Produs: </p>
                                              <p class="bold">${product['productItem']['code']}</p>
                                              <a href="/product/${product['productItem']/0}" class="img_point__more_link">
                                                <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                            </a>
                                            </div>

                                            <a class="img_point_price" href="/product/${product['productItem']/0}" >
                                                    ${product['productItem']['price'] > 10000 ? labels.cod : product['productItem']['price'] + 'MDL' }
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>`}}).join("")}
                    </div></div>`
                }
            }).join("")

        }

            imgHover()
        }


        function solutionHandler(id){
            const modal = document.getElementById('modal'+id);

            let overlay;
            const main = document.getElementById('main');
            // main.append(modal)

            // const modalInMain =main.lastElementChild
            modal.style.opacity = '1';
            modal.style.pointerEvents = 'auto';
            createOverlay();
            setTimeout(() => {
                document.querySelector('.overlay-block').append(modal)
                modal.style.display = 'block';
            }, 50);




            const closeModalBtn = modal.querySelector('.close__dialog');
            closeModalBtn.addEventListener('click', function() {
                // modal.style.display = 'none';
                modal.style.opacity = '0';
                modal.style.pointerEvents = 'none';
                removeOverlay();
                document.querySelector('.solutions_container').append(modal)
            });

            window.addEventListener('click', function(event) {
                if (event.target == overlay) {
                    // modal.style.display = 'none';
                    modal.style.opacity = '0';
                    modal.style.pointerEvents = 'none';
                    removeOverlay();
                }
            });
        }


        function portfolioCategoryHandler(el, industry, category_id) {

            document.querySelectorAll('.portfolio_category_btn'+industry).forEach(item=>{
                item.classList.remove('active')
            })
            el.parentElement.parentElement.querySelectorAll('.swiper-slide').forEach(item=>{
                item.classList.remove('swiper-slide-active')
            })
            el.classList.add('active')
            el.parentElement.classList.add('swiper-slide-active')

            if(parseInt(category_id) === 0) {
                document.querySelector('.portfolio_container'+industry).innerHTML = portfolios.map(portfolio =>{
                    if(parseInt(portfolio['industry_id']) === parseInt(industry)) {
                        return `<div class="swiper-slide " >
                                    <a href="/portfolio/${portfolio['id']}" >
                                        <img class="swiper-slide__img" src="/storage/${portfolio['image_preview']}" alt="Portfolio image">
                            <div  class="d-block ">
                                <p class="swiper-slide__text">${portfolio['name_ro']}</p>
                            </div>
                            </a>
                        </div>
                    `
                    }

                }).join('')

                const portfolioSwiper = new Swiper('.portfolioSwiper'+industry, {
                    slidesPerView: "auto",
                    spaceBetween: 15,
                    pagination: false,
                    loop:true,
                    // Navigation arrows
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },

                    scrollbar: {
                        el: '.swiper-scrollbar',
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: "auto",
                            spaceBetween: 23
                        },
                    }

                });

            } else {
                document.querySelector('.portfolio_container'+industry).innerHTML = portfolios.map(portfolio =>{
                    if(parseInt(portfolio['industry_id']) === parseInt(industry) && parseInt(portfolio['category_id']) === parseInt(category_id) ) {
                        return `<div class="swiper-slide " >
                                    <a href="/portfolio/${portfolio['id']}" >
                                        <img class="swiper-slide__img" src="/storage/${portfolio['image_preview']}" alt="Portfolio image">
                            <div  class="d-block ">
                                <p class="swiper-slide__text">${portfolio['name_ro']}</p>
                            </div>
                            </a>
                        </div>
                    `
                    }

                }).join('')

                const portfolioSwiper = new Swiper('.portfolioSwiper'+industry, {

                    slidesPerView: "auto",
                    spaceBetween: 15,
                    pagination: false,
                    loop:true,
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
                        768: {
                            slidesPerView: "auto",
                            spaceBetween: 23
                        },
                    }

                });
            }

        }


    </script>
@endpush
@section('after_styles')

    <style>


    </style>

@endsection
