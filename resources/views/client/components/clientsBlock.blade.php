@php
$clients = [
    ['id'=>1,
     'name'=>'azart',
    'image'=>'images/clients/azart.jpg',
    ],
     ['id'=>2,
     'name'=>'linella',
    'image'=>'images/clients/linella.png',
    ],
         ['id'=>3,
     'name'=>'local',
    'image'=>'images/clients/local.png',
    ],
         ['id'=>4,
     'name'=>'kleber-2',
    'image'=>'images/clients/kleber-2.png',
    ],
         ['id'=>5,
     'name'=>'metro',
    'image'=>'images/clients/metro.jpeg',
    ],
         ['id'=>6,
     'name'=>'kaufland',
    'image'=>'images/clients/kaufland.png',
    ],
         ['id'=>7,
     'name'=>'Nr.1',
    'image'=>'images/clients/Nr.1.png',
    ],
         ['id'=>8,
     'name'=>'green-hills',
    'image'=>'images/clients/green-hills.jpg',
    ],
         ['id'=>9,
     'name'=>'volta',
    'image'=>'images/clients/volta.png',
    ],
     ['id'=>10,
     'name'=>'zikkurat',
    'image'=>'images/clients/zikkurat.jpg',
    ],
     ['id'=>11,
     'name'=>'andys',
    'image'=>'images/clients/andys.png',
    ],
     ['id'=>12,
     'name'=>'melio',
    'image'=>'images/clients/melio.png',
    ],
         ['id'=>13,
     'name'=>'gefest_logo',
    'image'=>'images/clients/gefest_logo.png',
    ],
         ['id'=>14,
     'name'=>'supraten',
    'image'=>'images/clients/supraten.png',
    ],
         ['id'=>15,
     'name'=>'crafti_square',
    'image'=>'images/clients/crafti_square.png',
    ],
         ['id'=>16,
     'name'=>'Farmacia-Familiei',
    'image'=>'images/clients/Farmacia-Familiei.png',
    ],
         ['id'=>17,
     'name'=>'cover',
    'image'=>'images/clients/cover.png',
    ],
         ['id'=>18,
     'name'=>'librarius',
    'image'=>'images/clients/librarius.png',
    ],
         ['id'=>19,
     'name'=>'profmet',
    'image'=>'images/clients/profmet.jpg',
    ],
         ['id'=>20,
     'name'=>'bicomplex',
    'image'=>'images/clients/bicomplex.jpg',
    ],
         ['id'=>21,
     'name'=>'dulcinela',
    'image'=>'images/clients/dulcinela.png',
    ],
     ['id'=>22,
     'name'=>'cronix',
    'image'=>'images/clients/cronix.png',
    ],
         ['id'=>23,
     'name'=>'smart_md',
    'image'=>'images/clients/smart_md.png',
    ],
         ['id'=>24,
     'name'=>'marcu',
    'image'=>'images/clients/marcu.png',
    ],
         ['id'=>25,
     'name'=>'maib',
    'image'=>'images/clients/maib.jpg',
    ],
         ['id'=>26,
     'name'=>'micb',
    'image'=>'images/clients/micb.png',
    ],
         ['id'=>27,
     'name'=>'azamaet',
    'image'=>'images/clients/azamaet.jpg',
    ],
         ['id'=>28,
     'name'=>'casa-curata',
    'image'=>'images/clients/casa-curata.png',
    ],
         ['id'=>29,
     'name'=>'stroy-lux',
    'image'=>'images/clients/stroy-lux.png',
    ],
         ['id'=>30,
     'name'=>'tehno-construct',
    'image'=>'images/clients/tehno-construct.png',
    ],
];


@endphp

<section class="sponsor-section custom-container">

    <h3 class="section_title">{{trans('labels.chooseUs')}}</h3>

    <div class="clientsSwiper_container ">

        <div class="swiper clientsSwiper ">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper " id="">

                @for($i=0; $i<count($clients); $i+=2)
                    <div class="swiper-slide">
                        @for($j=0; $j<2; $j++)
                            <div class=" sponsor-img ">
                                <img src="{{asset($clients[$i+$j]['image'])}}" alt="{{$clients[$i+$j]['name']}}">
                            </div>
                        @endfor
                    </div>
                @endfor

        </div>

{{--            <div class="swiper-scrollbar">--}}
{{--                <div class="swiper-scrollbar-drag swiper-scrollbar-drag-life"></div>--}}
{{--            </div>--}}

    </div>

        <div class="swiper clientsMobileSwiper ">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper " id="">

                    @for($i=0; $i<count($clients); $i+=5)
                        <div class="swiper-slide">
                            @for($j=0; $j<4; $j++)
                                <div class=" sponsor-img ">
                                    <img src="{{asset($clients[$i+$j]['image'])}}" alt="{{$clients[$i+$j]['name']}}">
                                </div>
                            @endfor
                        </div>
                    @endfor

            </div>

{{--            <div class="swiper-scrollbar">--}}
{{--                <div class="swiper-scrollbar-drag swiper-scrollbar-drag-life"></div>--}}
{{--            </div>--}}

        </div>
{{--        <div class="swiper-button-prev-unique"></div>--}}
{{--        <div class="swiper-button-next-unique"></div>--}}

    </div>


</section>
