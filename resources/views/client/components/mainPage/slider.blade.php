<div class="swiper main-swiper full_screen_block pt-0">
    <div class="swiper-wrapper">
        @foreach($sliders as $slider)
            @if(isset($slider->image))
                <div class="swiper-slide">
                    <a href="{{$slider->link}}" class="w-100 h-100">
                        <picture>
                            @if(isset($slider->image_mobile))
                                <source class="slider_img" media="(max-width: 700px)"
                                        srcset="{{url('storage/'.$slider->image_mobile)}}"/>
                            @endif
                            <img class="slider_img" src="{{url('storage/'.$slider->image)}}" alt=""/>
                        </picture>

                        <div
                            class="custom-container swiper-container position-relative d-flex flex-column justify-content-center h-100">
                            <div>
                                <h1 class="swiper-title">{{$language->replace($slider->name_ro, $slider->name_ru,$slider->name_en )}}</h1>
                                <p class="swiper-text">{{$language->replace($slider->description_ro, $slider->description_ru,$slider->description_en )}}</p>
                            </div>

                            <span class="swiper-btn custom-btn">{{trans('labels.slider_btn')}}</span>

                        </div>
                    </a>
                </div>
            @elseif(isset($slider->video))
                <div class="swiper-slide video-swiper">
                    <a class="video_container" href="{{url('storage/'.$slider->video)}}" data-mainSlider>
                        <video src="{{url('storage/'.$slider->video)}}" muted class="added_video" id="video"
                               width="100%" height="100%"></video>

                        <div class="overlay"></div>

                    </a>

                    <div class="custom-container swiper-container">
                        <div class="swiper-video-container">
                            <h1 class="swiper-title">{{$language->replace($slider->name_ro, $slider->name_ru,$slider->name_en )}}</h1>
                            <p class="swiper-text">{{$language->replace($slider->description_ro, $slider->description_ru,$slider->description_en )}}</p>

                            <a href="{{url('storage/'.$slider->video)}}" data-mainSlider class="play_btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                     fill="rgba(243, 233, 233, 0.8)" class="bi bi-play-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"></path>
                                </svg>
                            </a>

                            @if(isset($slider->link))
                                <div class="video-swiper-btn-container">
                                    <a href="{{$slider->link}}"
                                       class="swiper-btn custom-btn">{{trans('labels.slider_btn')}}</a>
                                </div>

                            @endif
                        </div>


                    </div>
                </div>
            @endif
        @endforeach

    </div>
    <div class="swiper-buttons__bottom custom-container buttons-bottom__container">
        <div class="append-buttons">
            <div class="append-buttons__body">
                @foreach($sliders as $key=> $slider)
                    <a href="" class="append-buttons__text buttons-slide{{$slider->sort_order}}">
                        <p class="append-buttons__text_first">{{$language->replace($slider->category->name_ro, $slider->category->name_ru,$slider->category->name_en) }}</p>
                        <p class="append-buttons__text_second">{{$language->replace($slider->name_ro, $slider->name_ru,$slider->name_en) }}</p>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
    <div class="swipper-scrollbar__body custom-container">
        <div class="swiper-scrollbar ">
            <div class="swiper-scrollbar-drag swiper-scrollbar-drag-life"></div>
        </div>
        <div class="swipper-scrollbar__body-arrows">
            <div class="swiper-button-next main-swiper__next">

            </div>
            <div class="swiper-button-prev main-swiper__prev">

            </div>
        </div>
    </div>
</div>

@push('script')

    <script>

        setTimeout(() => {
            document.querySelector('.append-buttons__body').style.gridTemplateColumns = `repeat(${document.querySelectorAll('.append-buttons__text').length}, 1fr)`;
            document.querySelector('.main-section .swiper-scrollbar-drag').style.width = `${100 / document.querySelectorAll('.append-buttons__text').length}%`;
        }, 0)

        Fancybox.bind("[data-mainSlider]", {
            // Your custom options
        });
        let lastSuccessfulSlide = null;
        let allExistingSlides = document.querySelectorAll('.append-buttons__text')

        const mainSwiper = new Swiper('.main-swiper', {
            slidesPerView: 1,
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
                        let activeSlider = this.slides.find(e => e.matches('.swiper-slide.swiper-slide-active'));
                        allExistingSlides.forEach(item => {
                            item.classList.remove('active')
                        })
                        allExistingSlides[activeSlider.dataset.swiperSlideIndex].classList.add('active')
                    }, 0)

                    const videoSwiper = document.querySelectorAll('.video-swiper.swiper-slide-next')
                    if (videoSwiper.length > 0) {
                        const video = document.querySelector('.added_video')
                        const duration = Math.round(video.duration) * 1000;
                        document.querySelector('.video-swiper').dataset.swiperAutoplay = String(duration);

                        if (window.innerWidth >= 425 && video) {
                            video.play()
                        }

                    }

                },
                init: function () {
                    setTimeout(() => {
                        allExistingSlides.forEach((el, index) => {
                            el.addEventListener('click', (e) => {
                                e.preventDefault();
                                allExistingSlides.forEach(item => {
                                    item.classList.remove('active')
                                })
                                el.classList.add('active')
                                mainSwiper.slideTo(index);
                            });
                        });
                    }, 0)
                },

            },
        });


    </script>

@endpush
