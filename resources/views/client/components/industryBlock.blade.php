<section class="category-section industry_block">
    <div class=" category-section__container">
        <div class="industry-body">
            @foreach($industries as $industry)
                @php
                  $nameLower=  strtolower($industry->name);
                @endphp
                <div class="industry-body__cards">
                    <a href="{{route('client.industry', $industry->slug)}}" class="industry-body__card industry-body__{{$nameLower}}" style="background-image: url({{url('storage/'.$industry->image_preview)}})" >
                        <div class="industry-body__cards_gradient-{{$nameLower}}">

                        </div>
                    </a>
                    <div class="industry-text__container industry-text__container-{{$nameLower}}">
                        <h3 class="industry-body__title">{{$industry->name}}</h3>
                        <button class="industry-more_btn industry-body__arrow"></button>
{{--                        <img src="{{asset('images/arrow-circle.png')}}" alt="Arrow" class="industry-body__arrow">--}}
                    </div>
                </div>
            @endforeach

           </div>

        <div class="industry-body-mobile swiper industrySwiper">
            <div class="swiper-wrapper">
            @foreach($industries as $industry)
                @php
                    $nameLower=  strtolower($industry->name);
                @endphp
                <div class="swiper-slide industry-body-mobile__cards">
                    <a href="{{route('client.industry', $industry->slug)}}" class="industry-body-mobile__card industry-body-mobile__{{$nameLower}}" style="background-image: url({{url('storage/'.$industry->image_preview)}})" >
                        <div class="industry-body-mobile__cards_gradient-{{$nameLower}}">

                        </div>
                    </a>
                    <div class="industry-text-mobile__container industry-text-mobile__container-{{$nameLower}}">
                        <h3 class="industry-body-mobile__title">{{$industry->name}}</h3>
                        <button class="industry-more_btn industry-body__arrow"></button>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</section>
