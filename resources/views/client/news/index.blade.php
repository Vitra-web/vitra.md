@extends('layouts.client')

@section('content')
<main>

    <section class="mainindustry-section">
        <div class=" main_slider_block " style="background-image: url({{url('images/news-bkg.jpg')}});">
            <h1 class="mainindustry-section__title text-uppercase">{{$title}}</h1>
        </div>
    </section>
    @include('client.components.breadСrumbs')

    <section class="custom-container mt-4">
        <div class="swiper filerSwiper categoryFilerSwiper mb-4">
            <div class="swiper-wrapper swiper-tab-nav">
                <div class="swiper-slide filter-slide">
                    <button class="filter-slide-btn active" onclick="categoryHandler(this, 0)">{{trans('labels.all')}}</button>
                </div>
                @foreach($newsCategories as $category)
                    <div class="swiper-slide filter-slide">
                        <button class="filter-slide-btn" onclick="categoryHandler(this, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                    </div>

                @endforeach
            </div>
{{--            <div class="swiper-scrollbar filter-swiper-scrollbar"></div>--}}

        </div>
    </section>



    <section class="news-blocks__section">
        <div class="custom-container" >

            <div class="more-news__body row" id="newsContainer">
                @foreach($news as $key=> $newsItem)

                    <a href="{{route('client.newsView', $newsItem->id)}}" class="more-news__item col-md-6">
                        <img src="{{url('storage/'.$newsItem->image)}}" alt="" class="more-news__item-img">
                        <div class="more-news__item-descr news-descr">
                            <div class="d-flex flex-column align-items-start w-100">
                                <p class="news-descr__category news-block__industry">{{$newsItem->industry->name}}</p>
                                <h4 class="news-descr__title">{!! $language->replace($newsItem->name_ro, $newsItem->name_ru,$newsItem->name_en  ) !!}</h4>
                                <p class="news-descr__date">{{date_format($newsItem->created_at,"d/m/Y")}}</p>
                            </div>

                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <div class="news-descr__utilities">
{{--                                    <a href="#" class="news-descr__share-items  news-descr__share">--}}
{{--                                        <img src="{{asset('images/share.svg')}}" alt="Share" class="news-share__img news-section__card-share--img">--}}
{{--                                        <p class="news-descr__share-text">Share</p>--}}
{{--                                    </a>--}}
                                    <div class="news-descr__views-items news-descr__views">
                                        <img src="{{asset('images/views.svg')}}" alt="Views" class="news-views__img news-section__card-views--img">
                                        <p class="news-descr__views-text">({{$newsItem->views}})</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <div class="news-descr__more news-blocks__individual-open news-block__more">
                                        <p class="news-block__more-text">{{trans('labels.more')}}</p>

                                        <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                            <g id="SVGRepo_iconCarrier"> <path d="M13 15L16 12M16 12L13 9M16 12H8M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>

                                        </svg>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </a>

                @endforeach
            </div>





{{--            <div class="news-blocks__body">--}}
{{--                <div class="row">--}}
{{--                @foreach($news as $key=> $item)--}}
{{--                    @if($key ==0)--}}
{{--                    <div class="col-lg-6 mb-4 news-block__main">--}}
{{--                        <div class="news-block__descr">--}}
{{--                            <img src="{{url('storage/'.$item->image)}}" alt="" class="news-block__img">--}}
{{--                            <div class="news-block__info px-2">--}}
{{--                                <span class="news-block__industry">{{$item->industry->name}}</span>--}}
{{--                                <h3 class="news-block__title">{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</h3>--}}
{{--                                <a href="{{route('client.newsView', $item->id)}}" class="news-block__info-more news-block__more">--}}
{{--                                    <p class="news-block__more-text">{{trans('labels.more')}}</p>--}}
{{--                                    <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000">--}}
{{--                                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>--}}
{{--                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                        <g id="SVGRepo_iconCarrier"> <path d="M13 15L16 12M16 12L13 9M16 12H8M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>--}}

{{--                                    </svg>--}}
{{--                                </a>--}}
{{--                                <div class="news-block__info-other news-block__other">--}}
{{--                                    <div class="news-block__other-body">--}}
{{--                                        <a href="#" class="news-block__other-share news-share">--}}
{{--                                            <img src="{{asset('images/share.svg')}}" alt="Share" class="news-share__img news-section__card-share--img">--}}
{{--                                            <p class="news-share__text">Share</p>--}}
{{--                                        </a>--}}
{{--                                        <div class="news-block__other-views news-views">--}}
{{--                                            <img src="{{asset('images/views.svg')}}" alt="Views" class="news-views__img news-section__card-views--img">--}}
{{--                                            <p class="news-views__text">(1430)</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="news-block__other-date news-date">--}}
{{--                                        <p class="news-date__text">{{date_format($item->created_at,"d/m/Y")}}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                   @endif--}}

{{--                    @endforeach--}}
{{--                    <div class="col-lg-6 row">--}}
{{--                    @foreach($news as $key=> $item)--}}
{{--                    @if($key >0 & $key < 5 )--}}
{{--                        @php--}}
{{--                        $name = $language->replace($item->name_ro, $item->name_ru,$item->name_en  );--}}
{{--                        if(strlen($name) > 200){--}}
{{--                        $nameText = substr($name, 0, 200).'...';--}}
{{--                        }  else $nameText = $name;--}}
{{--                        @endphp--}}
{{--                    <div class="col-sm-6 mb-3 pe-0 news-blocks news-blocks__second-individual ">--}}
{{--                            <div class="news-blocks__second-individual news-blocks__individual">--}}
{{--                                <img src="{{url('storage/'.$item->image)}}" alt="" class="news-blocks__individual-img">--}}

{{--                                <div class="px-2 pb-2">--}}

{{--                                    <div class="news-blocks__individual-other">--}}
{{--                                        <p class="news-blocks__individual-industry news-block__industry">{{$item->industry->name}}</p>--}}
{{--                                        <p class="news-blocks__individual-date">{{date_format($item->created_at,"d/m/Y")}}</p>--}}
{{--                                    </div>--}}


{{--                                    <div class="d-flex flex-column justify-content-between" style="height: 130px">--}}
{{--                                        <h4 class="news-blocks__individual-descr">{!! $nameText !!}</h4>--}}
{{--                                        <div class="news-blocks__individual-share news-block__other-body">--}}
{{--                                            <a href="#" class="news-block__other-share news-share">--}}
{{--                                                <img src="{{asset('images/share.svg')}}" alt="Share" class="news-share__img news-section__card-share--img">--}}
{{--                                                <p class="news-share__text">Share</p>--}}
{{--                                            </a>--}}
{{--                                            <div class="news-block__other-views news-views">--}}
{{--                                                <img src="{{asset('images/views.svg')}}" alt="Views" class="news-views__img news-section__card-views--img">--}}
{{--                                                <p class="news-views__text">({{$item->views}})</p>--}}
{{--                                            </div>--}}
{{--                                            <a href="{{route('client.newsView', $item->id)}}" class="news-blocks__individual-open news-block__more">--}}
{{--                                                <p class="news-block__more-text">{{trans('labels.more')}}</p>--}}
{{--                                                <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000">--}}
{{--                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>--}}
{{--                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                                    <g id="SVGRepo_iconCarrier"> <path d="M13 15L16 12M16 12L13 9M16 12H8M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>--}}

{{--                                                </svg>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}



{{--                                </div>--}}

{{--                            </div>--}}


{{--                    </div>--}}


{{--                    @endif--}}

{{--                @endforeach--}}
{{--                        </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>

{{--    <section class="more-news__section more-news">--}}
{{--        <div class="custom-container">--}}
{{--           --}}
{{--        </div>--}}
{{--    </section>--}}

    <div class="custom-container mb-5">
        @include('client.components.industryBlock')
    </div>



</main>

@endsection


@push('script')
    <script>

        const newsContainer = document.getElementById('newsContainer');
        const news = {!! $news !!};
        console.log(news)

        const categoryPortfolioSlider = new Swiper('.categoryFilerSwiper', {
            slidesPerView: "auto",
            spaceBetween: 0,
            pagination: false,
            // scrollbar: {
            //     el: '.swiper-scrollbar',
            // },
        });

        function categoryHandler(el, categoryId) {
            document.querySelectorAll('.filter-slide-btn').forEach(item => {
                item.classList.remove('active')
            })
            el.parentElement.parentElement.querySelectorAll('.swiper-slide').forEach(item=>{
                item.classList.remove('swiper-slide-active')
            })
            el.classList.add('active')
            el.parentElement.classList.add('swiper-slide-active')

            if(categoryId === 0) {
                newsContainer.innerHTML = news.map(item=>{
                    const url = window.location.origin+'/news/' + item['id'];
                    const name =item['name_ro'];
                    const date = '{{date_format($newsItem->created_at,"d/m/Y")}}';
                    const more = '{!! trans('labels.more') !!}';
                    return `
                            <div class="more-news__item">
                        <img src="/storage/${item['image']}" alt="" class="more-news__item-img">
                        <div class="more-news__item-descr news-descr">
                            <div class="d-flex flex-column align-items-start">
                                <p class="news-descr__category news-block__industry">${item['industryName']}</p>
                                <h4 class="news-descr__title">${name}</h4>
                                <p class="news-descr__date">${date}</p>
                            </div>

                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <div class="news-descr__utilities">
                                    <a href="#" class="news-descr__share-items  news-descr__share">
                                        <img src="/images/share.svg" alt="Share" class="news-share__img news-section__card-share--img">
                                        <p class="news-descr__share-text">Share</p>
                                    </a>
                                    <div class="news-descr__views-items news-descr__views">
                                        <img src="/images/views.svg" alt="Views" class="news-views__img news-section__card-views--img">
                                        <p class="news-descr__views-text">(${item['views']})</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <a href="${url}" class="news-descr__more news-blocks__individual-open news-block__more">
                                        <p class="news-block__more-text">${more}</p>

                                        <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                            <g id="SVGRepo_iconCarrier"> <path d="M13 15L16 12M16 12L13 9M16 12H8M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>

                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>`
                }).join('')
            } else {
                newsContainer.innerHTML = news.map(item=>{
                    if(item['category_id'] === categoryId) {
                        const url = window.location.origin+'/news/' + item['id'];
                        const name =item['name_ro'];
                        const date = '{{date_format($newsItem->created_at,"d/m/Y")}}';
                        const more = '{!! trans('labels.more') !!}';
                            return `
                            <div class="more-news__item">
                        <img src="/storage/${item['image']}" alt="" class="more-news__item-img">
                        <div class="more-news__item-descr news-descr">
                            <div class="d-flex flex-column align-items-start">
                                <p class="news-descr__category news-block__industry">${item['industryName']}</p>
                                <h4 class="news-descr__title">${name}</h4>
                                <p class="news-descr__date">${date}</p>
                            </div>

                            <div class="w-100 d-flex justify-content-between align-items-center">
                                <div class="news-descr__utilities">
                                    <a href="#" class="news-descr__share-items  news-descr__share">
                                        <img src="/images/share.svg" alt="Share" class="news-share__img news-section__card-share--img">
                                        <p class="news-descr__share-text">Share</p>
                                    </a>
                                    <div class="news-descr__views-items news-descr__views">
                                        <img src="/images/views.svg" alt="Views" class="news-views__img news-section__card-views--img">
                                        <p class="news-descr__views-text">(${item['views']})</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <a href="${url}" class="news-descr__more news-blocks__individual-open news-block__more">
                                        <p class="news-block__more-text">${more}</p>

                                        <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                            <g id="SVGRepo_iconCarrier"> <path d="M13 15L16 12M16 12L13 9M16 12H8M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>

                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

`
                    }
                }).join('')
            }
        }

    </script>

@endpush
