<div class="full_screen_block mission_block">

    <div class="mission_container">

        <h2 class="mission_title">{{trans('labels.our_mission')}}</h2>
        <div class="mission_description_container">
            <p class="mission_description">{{trans('labels.our_mission_description')}}</p>
        </div>

        <div class=" mission_list swiper missionSwiper">
            <div class="swiper-wrapper">
                @foreach($missions as $mission)
                <div class="mission_item swiper-slide">
                    <div class="item_hover_block">
                        <img src="{{url('storage/'.$mission->image)}}" class="mission_item_image" alt="">
                        <p class="mission_item_title">{!!$language->replace($mission->title_ro, $mission->title_ru,$mission->title_en )!!}</p>

                    </div>
                    <div class="mission_item_description_block">
                        <p class="mission_item_description">{!!$language->replace($mission->description_ro, $mission->description_ru,$mission->description_en )!!}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="swipper-scrollbar__body ">
                <div class="swipper-scrollbar__body-arrows">
                    <div class="swiper-button-next ">
                    </div>
                    <div class="swiper-button-prev ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
