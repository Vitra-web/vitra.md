@extends('layouts.client2')

@section('content')
    <main>
        <section class="custom-container" style="margin-top:145px">

            @include('client.components.breadСrumbs')

            <div class="swiper filerSwiper categoryFilerSwiper mb-4 mt-4">
                <div class="swiper-wrapper swiper-tab-nav">
                    <div class="swiper-slide filter-slide">
                        <button class="filter-slide-btn active" onclick="categoryHandler(this, 0)">{{trans('labels.all')}}</button>
                    </div>
                    @foreach($portfolioCategories as $category)
                        @if(count($category->portfolios) > 0)
                            <div class="swiper-slide filter-slide">
                                <button class="filter-slide-btn" onclick="categoryHandler(this, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                            </div>
                        @endif
                    @endforeach
                </div>
{{--                <div class="swiper-scrollbar filter-swiper-scrollbar"></div>--}}

            </div>

            <div class="w-100" id="portfolioWrapper">

                <div class="portfolio-container w-100 my-0 mx-auto" id="portfolioContainer">
                    @foreach($portfolios as $key=>$portfolio)
                        @if($key == 12)
                            @php
                                break;
                            @endphp
                        @endif
                        <a href="{{route('client.portfolioView', $portfolio->id)}}" class="w-100">
                            <div class="portfolio-block">

                                <div class="portfolio-block_img">
                                    <img src="{{url('storage/'.$portfolio->image_preview)}}" alt="">
                                </div>
                                <p class="portfolio-block__text">{{$language->replace($portfolio->name_ro, $portfolio->name_ru,$portfolio->name_en )}}</p>
                                <p class="portfolio-block__date">{{$portfolio->date == null ? " ": $portfolio->date}}</p>
                            </div>
                        </a>
                    @endforeach


                </div>

                @if(count($portfolios) > 12)
                    <div class="more_block w-100 my-0 mx-auto"></div>
                    <div class="see-more-btn_container mb-5">
                        <button id="mainSeeMoreBtn" class="custom-btn my-2 mx-auto" onclick="seeMoreHandler(12, 24)">{{trans('labels.more')}}</button>
                    </div>
                @endif

            </div>

        </section>


    </main>

@endsection

@push('script')
    <script>

        let portfolioContainer = document.getElementById('portfolioContainer');
        const portfolios = {!! $portfolios !!};

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

            document.querySelector('.more_block').innerHTML="";

            let seeMoreBtnContainer = document.querySelector('.see-more-btn_container');

            seeMoreBtnContainer.innerHTML="";

            if(parseInt(categoryId) === 0) {
                seeMoreBtnContainer.innerHTML="";
                portfolioContainer.innerHTML = portfolios.map((portfolio, index)=>{
                    if(index < 12) {
                        const url = window.location.origin+'/portfolio/' + portfolio['id'];
                        {{--const name =String({{$language->replace($portfolio->name_ro, $portfolio->name_ru,$portfolio->name_en )}});--}}
                            return `<a href="${url}" class="">
                            <div class="portfolio-block ">
                                <div class="portfolio-block_img">
                                <img src="/storage/${portfolio['image_preview']}" alt="${portfolio['name_ro']}">
                               </div>
                                <p class="portfolio-block__text">${portfolio['name_ro']}</p>
                                <p class="portfolio-block__date">${portfolio['date'] == null ? " ": portfolio['date']}</p>
                            </div>
                        </a>`
                    }
                }).join('')

                let text = '{!! trans('labels.more') !!}';
                const moreBtn = document.createElement('div');
                moreBtn.innerHTML=`<button id="mainSeeMoreBtn" class="custom-btn my-2 mx-auto" onclick="seeMoreHandler(12, 24)">${text}</button>`;
                seeMoreBtnContainer.append(moreBtn);

            } else {
                let till = 12;
                let times = 0;

                let text = '{!! trans('labels.more') !!}';
                portfolioContainer.innerHTML = portfolios.map((portfolio)=>{
                    if (times < 12) {
                        if(parseInt(portfolio['category_id']) === parseInt(categoryId)) {
                            times+=1;
                            const url = window.location.origin+'/portfolio/' + portfolio['id'];
                            {{--const name = String({{$language->replace($portfolio->name_ro, $portfolio->name_ru,$portfolio->name_en )}});--}}
                                return `<a href="${url}" class="">
                                <div class="portfolio-block">
                                    <div class="portfolio-block_img">
                                        <img src="/storage/${portfolio['image_preview']}" alt="${portfolio['name_ro']}">
                                    </div>
                                    <p class="portfolio-block__text">${portfolio['name_ro']}</p>
                                    <p class="portfolio-block__date">${portfolio['date'] == null ? " ": portfolio['date']}</p>
                                </div>
                            </a>`
                        }
                    }

                }).join('')

                if (times < 12) {
                } else {
                    const moreBtn = document.createElement('div');
                    moreBtn.classList.add('justify-content-center')
                    moreBtn.classList.add('d-flex')
                    moreBtn.classList.add('my-2')
                    moreBtn.innerHTML=`<button id="categorySeeMoreBtn" class="custom-btn" onclick="categoryShowMore(12, ${till} + 12, ${categoryId})">${text}</button>`
                    seeMoreBtnContainer.append(moreBtn)
                }

            }
        }

        function categoryShowMore(from, till, categoryId) {
            let seeMoreBtnContainer = document.querySelector('.see-more-btn_container');
            let count = 0;
            portfolios.map(portfolio=>{
                if (parseInt(portfolio['category_id']) === parseInt(categoryId)) {
                    count+=1;
                }
            });


            portfolioContainer.innerHTML = portfolios.map(portfolio=>{
                if(parseInt(portfolio['category_id']) === parseInt(categoryId)) {
                    const url = window.location.origin+'/portfolio/' + portfolio['id'];
                    {{--const name = String({{$language->replace($portfolio->name_ro, $portfolio->name_ru,$portfolio->name_en )}});--}}
                        return `<a href="${url}" class="">
                            <div class="portfolio-block">
                                <div class="portfolio-block_img">
                                    <img src="/storage/${portfolio['image_preview']}" alt="${portfolio['name_ro']}">
                                </div>
                                <p class="portfolio-block__text">${portfolio['name_ro']}</p>
                                <p class="portfolio-block__date">${portfolio['date'] == null ? " ": portfolio['date']}</p>
                            </div>
                        </a>`
                }
            }).join('')

            let portfolioContainerTest = document.getElementById('portfolioContainer');
            if(count === portfolioContainerTest.children.length ) {
                seeMoreBtnContainer.innerHTML = "";
            }
        }


        function seeMoreHandler(from, till) {
            let seeMoreBtnContainer = document.querySelector('.see-more-btn_container');
            let moreBlock = document.querySelector('.more_block');

            seeMoreBtnContainer.innerHTML = "";

            let text = '{!! trans('labels.more') !!}';
            const moreBtn = document.createElement('div');
            moreBtn.innerHTML=`<button id="mainSeeMoreBtn" class="custom-btn my-2 mx-auto" onclick="seeMoreHandler(1, ${till} + 12)">${text}</button>`;
            seeMoreBtnContainer.append(moreBtn);
            moreBlock.innerHTML = portfolios.map((portfolio, index) =>{
                if(index >= 12 && index < till) {
                    const url = window.location.origin+'/portfolio/' + portfolio['id'];
                    return `<a href="${url}" class="w-100">
                            <div class="portfolio-block " >
                                <div class="portfolio-block_img">
                                <img src="/storage/${portfolio['image_preview']}" alt="${portfolio['name_ro']}">
                               </div>
                                <p class="portfolio-block__text">${portfolio['name_ro']}</p>
                                <p class="portfolio-block__date">${portfolio['date'] == null ? " ": portfolio['date']}</p>
                            </div>
                        </a>`
                }
            }).join('')


            if(portfolios.length === moreBlock.children.length + 12) {
                seeMoreBtnContainer.innerHTML = "";
            }
        }

    </script>

@endpush
