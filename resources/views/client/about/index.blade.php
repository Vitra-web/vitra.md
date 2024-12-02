@extends('layouts.client')

@section('content')
<main>
    <section class="mainindustry-section">
        <div class=" main_slider_block" style="background-image: url({{url('storage/'.$page->image)}});">
            <h1 class=" text-uppercase mainindustry-section__title">{{$title}}</h1>
        </div>
    </section>
    @include('client.components.breadСrumbs')

    <section class="about-descr__section about-descr">
        <div class="custom-container">
                 <div class="about-descr__body">
                <div class="about-descr__body-left">
                    <iframe width="860" height="515" src="https://www.youtube.com/embed/otnY4wwcfcY" title="ViTRA Rebranding" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"  allowfullscreen></iframe>
                </div>
                <div class="about-descr__body-right">
                    <h3 class="about-descr__title">{!! $language->replace($page->title_ro, $page->title_ru, $page->title_en) !!}</h3>
                    <div class="about-descr__text">
                        {!! $language->replace($page->description_ro, $page->description_ru, $page->description_en) !!}
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section class="about-curiosity__section about-curiosity">
        <div class="custom-container">
            <h3 class="about-descr__title">{{trans('labels.who_we')}}</h3>
            <div class="about-curiosity__body row">

                @foreach($benefits as $key=>$benefit)
                <div class="about-curiosity__block about-counter w-100 pb-3 pt-3" onmouseenter="showDescription(this)" onmouseleave="hideDescription(this)">

                    <div class="about_shown_block " >
                        <div class="about-counter__nr" >
                            <span id="num{{$key+1}}"></span>
                            @if($benefit->sort_order == 1)
                                <p class="about-counter__nr-body-item">
                                    {{trans('labels.years')}}
                                </p>
                            @elseif($benefit->sort_order == 2)
                                <p class="about-counter__nr-body-item">

                                </p>
                            @elseif($benefit->sort_order == 7)
                                <p class="">
                                    <span class="about-counter__nr-body-item" >m2</span>
                                    <span class="about-counter__nr-body-item"> +</span>
                                </p>
                            @else
                                <p class="about-counter__nr-body-item">
                                    +
                                </p>
                            @endif

                        </div>

                        <p class="about-counter__text">{!! $language->replace($benefit->title_ro, $benefit->title_ru, $benefit->title_en) !!}</p>
                    </div>

                    <div class="hidden_block">
                        <p class="about-counter_description">{!! $language->replace($benefit->description_ro, $benefit->description_ru, $benefit->description_en) !!}</p>
                    </div>

                </div>
                @endforeach

            </div>
        </div>
        </div>
    </section>


    <section class="about-video  custom-container">
        <h3 class="about-descr__title">{{trans('labels.about_second_video_title')}}</h3>

        <div class="about_mission_section">
            <div class="col-lg-4 about_mission_block">
                <img  class="about_mission_image" src="{{url('/images/about-leadership.png')}}" alt="about-leadership">
                <p class="about_mission_title">{{trans('labels.about_mission_title')}}</p>
                <p class="about_mission_description">{{trans('labels.about_mission_description')}}</p>
            </div>
            <div class="col-lg-4 about_mission_block">
                <img class="about_mission_image" src="{{url('/images/about-mission.png')}}" alt="about-mission">
                <p class="about_mission_title">{{trans('labels.about_vision_title')}}</p>
                <p class="about_mission_description">{{trans('labels.about_vision_description')}}</p>
            </div>
            <div class="col-lg-4 about_mission_block">
                <img class="about_mission_image" src="{{url('/images/about-star.png')}}" alt="about-star">
                <p class="about_mission_title">{{trans('labels.about_values_title')}}</p>
                <p class="about_mission_description">{{trans('labels.about_values_description')}}</p>
            </div>

        </div>

    </section>

{{--    <div class="about-video__body">--}}
{{--        <div class="about-video__player">--}}
{{--            <a class="w-100" href="{{url('storage/'.$page->video)}}" data-mainSlider>--}}
{{--                <video src="{{url('storage/'.$page->video)}}"  width="160"  height="160"></video>--}}
{{--                <div class="play_btn" >--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#fff" class="bi bi-play-fill" viewBox="0 0 16 16">--}}
{{--                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>--}}
{{--                    </svg>--}}

{{--                </div>--}}
{{--            </a>--}}

{{--        </div>--}}
{{--    </div>--}}

    <div class="custom-container about-industry-container" >
        <h2 class="about-descr__title">{{trans('labels.specialist_in')}}</h2>
        @include('client.components.industryBlock')
    </div>

    <div style="margin-bottom: 50px">
        @include('client.about.formBlock')
    </div>



</main>

@endsection

@push('script')

    <script>
        Fancybox.bind("[data-mainSlider]", {
            // Your custom options
        });

        const benefits = {!! $benefits !!};

        //counter
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
                { selector: '#num1', number: benefits[0]['number'], time: 2000, step: 1 },
                { selector: '#num2', number: benefits[1]['number'], time: 1, step: 1 },
                { selector: '#num3', number: benefits[2]['number'], time: 3000, step: 1 },
                { selector: '#num4', number: benefits[3]['number'], time: 3000, step: 20 },
                { selector: '#num5', number: benefits[4]['number'], time: 3000, step: 50 },
                { selector: '#num6', number: benefits[5]['number'], time: 3000, step: 1000 },
                { selector: '#num7', number: benefits[6]['number'], time: 2000, step: 1000 },
                { selector: '#num8', number: benefits[7]['number'], time: 2000, step: 5000 }
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

        function showDescription(el) {
            const description = el.querySelector('.about-counter_description');

            if(description.textContent !== '') {

                setTimeout(()=>{
                    el.querySelector('.about_shown_block').classList.add('hidden')
                    el.querySelector('.hidden_block').classList.add('active')

                },200)

            }

        }

        function hideDescription(el) {
            const description = el.querySelector('.about-counter_description');

            if(description.textContent !== '') {
                setTimeout(()=>{
                el.querySelector('.hidden_block').classList.remove('active')
                el.querySelector('.about_shown_block').classList.remove('hidden')
                },200)
            }
        }

    </script>

@endpush
