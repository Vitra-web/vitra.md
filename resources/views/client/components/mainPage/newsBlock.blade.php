

<section class="news-section">

    <div class="custom-container news-section__container">
        <h2 class="section_title mb-2" >
            <a href="{{route('client.news')}}" class="">{{trans('labels.news_title')}}</a>
        </h2>

        <div class="news-section__body swiper newsSwiper">
            <div class="swiper-wrapper">
            @foreach($news as $item)
                     @php
                        $name = $language->replace($item->name_ro, $item->name_ru,$item->name_en );

                           if(strlen($name) > 115){
                              $nameText = substr($name, 0, 115).'...';
                           }  else $nameText = $name;
                    @endphp
            <div class="swiper-slide news-section__card">
                <a href="{{route('client.newsView',$item->id )}}">
                    <img src="{{url('storage/'.$item->image)}}" alt="" class="news-section__card-img">
                </a>
{{--                <a href="{{route('client.newsView',$item->id )}}" class="news-section__card-description d-block">--}}
{{--                    {{$nameText}}--}}
{{--                </a>--}}
                <a href="{{route('client.newsView',$item->id )}}" class="news-section__card-utilities">

                        <p class="news-section__card-description" >{{$nameText}}</p>
                        <p class="industry-more_btn" ></p>

                </a>
            </div>
            @endforeach
            </div>
        </div>
{{--        <div class="d-flex justify-content-center">--}}
{{--            <div class="btn-group">--}}
{{--                <a href="{{route('client.news')}}" class="btn view-more-btn custom-btn">{{trans('labels.more')}}</a>--}}
{{--            </div>--}}
{{--        </div>--}}


    </div>
</section>
