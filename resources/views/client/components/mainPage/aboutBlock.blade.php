@php
    $count=1;
@endphp

<div class="full_screen_block ">

    <div class="industry_block_container container-custom">
        <h2 class="industry_block_title">{{trans('labels.specialist_in')}}</h2>
        @include('client.components.industryBlock')
    </div>


</div>


<div class="full_screen_block about_block">
    <section class="category-section">

        <div class="category-section__container h-100">

            <div class="swiper about_slider aboutSwiper ">

                <div class="custom-container position-relative">
                    <h2 class="about_block_title">{{trans('labels.who_we')}}</h2>
                </div>

                <div class="swiper-wrapper ">
                    @foreach($benefits as $benefit)

                        <div class="swiper-slide about_slider_img" data-order="{{$benefit->sort_order}}">

                            <picture>
                                @if(isset($benefit->image_mobile))
                                    <source class="slider_img" media="(max-width: 765px)"
                                            srcset="{{url('storage/'.$benefit->image_mobile)}}"/>
                                @endif
                                <img class="slider_img" src="{{url('storage/'.$benefit->slider_image)}}" alt=""/>
                            </picture>

                            <div class="custom-container benefit_main_container">

                                <div class="cards__counter ">
                                    <div class="counter">
                                        <div class="counter__number">{{$benefit->number}}</div>
                                        @if($benefit->sort_order == 1)
                                            <p class="counter__text ms-2">
                                                {{trans('labels.years')}}
                                            </p>
                                        @elseif($benefit->sort_order == 4)
                                            <p class="counter__text ms-2">

                                            </p>
                                        @elseif($benefit->sort_order == 7)
                                            <p class=" ms-2">
                                                <span style="">m2</span>
                                            </p>
                                        @else
                                            <p class="counter__plus ">

                                            </p>
                                        @endif

                                    </div>
                                    <p class="cards__counter-text"
                                       style="text-transform: lowercase">{{$language->replace($benefit->title_ro, $benefit->title_ru,$benefit->title_en )}}</p>

                                </div>

                                <p class="cards__counter-description">{{$language->replace($benefit->description_ro, $benefit->description_ru,$benefit->description_en )}}</p>

                                <a href="{{route('client.about')}}"
                                   class="swiper-btn custom-btn">{{trans('labels.discover')}}</a>
                            </div>
                        </div>

                    @endforeach
                </div>

                {{--                    -------------Slider bottom text ---------------------}}

                <div class="swiper-buttons__bottom custom-container buttons-bottom__container">
                    <div class="append-buttons">
                        <div class="append-buttons__body">
                            @foreach($benefits as $benefit)
                                <a href="#" class="append-buttons-about__text about-buttons-slide{{$count}}"
                                   data-order="{{$benefit->sort_order}}">
                                    <div class="cards__counter ">
                                        <div class="counter">
                                            <div class="counter__number" id="num{{$count}}"></div>
                                            @if($benefit->sort_order == 1)
                                                <p class="counter__text ms-2">
                                                    {{trans('labels.years')}}
                                                </p>
                                            @elseif($benefit->sort_order == 2)
                                                <p class="counter__text ms-2">

                                                </p>
                                            @elseif($benefit->sort_order == 7)
                                                <p class=" ms-2" style="display: flex;">
                                                    <span style="">m2</span>
                                                    <span class="counter__plus"> +</span>
                                                </p>
                                            @else
                                                <p class="counter__plus ms-2">
                                                    +
                                                </p>
                                            @endif

                                        </div>
                                        <p class="cards__counter-text">{{$language->replace($benefit->title_ro, $benefit->title_ru,$benefit->title_en )}}</p>
                                    </div>
                                </a>
                                @php
                                    $count++
                                @endphp
                            @endforeach

                        </div>
                    </div>
                </div>


                {{--                    -----------------Slider scrollbar -------------------------}}
                <div class="swipper-scrollbar__body custom-container">
                    <div class="swiper-scrollbar ">
                        <div class="swiper-scrollbar-drag swiper-scrollbar-drag-life"></div>
                    </div>
                    <div class="swipper-scrollbar__body-arrows">
                        <div class="swiper-button-next about-swiper__next">

                        </div>
                        <div class="swiper-button-prev about-swiper__prev">

                        </div>
                    </div>
                </div>


            </div>


        </div>
    </section>


</div>

{{--@include('client.components.mainPage.missionBlock')--}}

@push('script')
    <script>
        const benefits = {!! $benefits !!};

        let allExistingAboutSlides = document.querySelectorAll('.append-buttons-about__text')
        const aboutSwiper = new Swiper('.aboutSwiper', {
            slidesPerView: 1,
            centeredSlides: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            scrollbar: {
                el: '.swiper-scrollbar',
            },
            loop: true,
            autoplay: {
                delay: 4000,
            },
            speed: 1200,
            on: {

                slideChange: function () {
                    setTimeout(() => {
                        let activeSlider = this.slides.find(e => e.matches('.swiper-slide.about_slider_img.swiper-slide-active'));
                        allExistingAboutSlides.forEach(item => {
                            item.classList.remove('active')
                        })
                        allExistingAboutSlides[activeSlider.dataset.swiperSlideIndex].classList.add('active')
                    }, 0)
                },

                init: function () {
                    setTimeout(() => {
                        allExistingAboutSlides.forEach((el, index) => {
                            el.addEventListener('click', (e) => {
                                e.preventDefault();
                                allExistingAboutSlides.forEach(item => {
                                    item.classList.remove('active')
                                })
                                el.classList.add('active')
                                aboutSwiper.slideTo(allExistingAboutSlides.length-1 > index ? index+1 : 0);
                            });
                        });
                    }, 0)
                },

            },
        });


        // Num counter
        function numCounter(selector, number, time, step) {
            const counter = document.querySelector(selector);
            if (counter.innerHTML) return;
            let res = 0;
            const allTime = Math.round(time / (number / step));

            let interval = setInterval(() => {
                res = res + step;

                if (res >= number) {
                    clearInterval(interval);
                    res = number;
                }
                counter.innerHTML = res;
            }, allTime);
        }


        function startCountersWhenVisible() {
            const countersData = [
                {selector: '#num1', number: Number(benefits[0].number), time: 2000, step: 1},
                {selector: '#num2', number: Number(benefits[1].number), time: 100, step: 1},
                {selector: '#num3', number: Number(benefits[2].number), time: 3000, step: 10},
                {selector: '#num4', number: Number(benefits[3].number), time: 4000, step: 1000},
                {selector: '#num5', number: Number(benefits[4].number), time: 4000, step: 1000},
                {selector: '#num6', number: Number(benefits[5].number), time: 4000, step: 1000}
            ];

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counterId = entry.target.id;
                        const counterData = countersData.find(data => data.selector === `#${counterId}`);
                        if (counterData) {
                            numCounter(counterData.selector, counterData.number, counterData.time, counterData.step);
                        }
                    }
                });
            });

            countersData.forEach(counterData => {
                const counterElement = document.querySelector(counterData.selector);
                if (counterElement && !counterElement.innerHTML) {
                    observer.observe(counterElement);
                }
            });
        }

        startCountersWhenVisible();


    </script>

@endpush
