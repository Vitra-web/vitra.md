@php
    use  \App\Classes\LanguageHandler;
    $language = new LanguageHandler();
@endphp
<header class="header" style="background: #fff">
    <div class="header__top header-contacts">
        <div class="container-custom d-flex justify-content-between">
            <div class="header_promotion">
                <img src="{{asset('images/megaphone-white.svg')}}" width="16" class="me-2" alt=""> <a href="/news/{{$promotionNews->id}}">{{trans('labels.week_promo')}}</a>
            </div>
            <div class="header-contacts__container">
                <a href="mailto:info@vitra.md" class="contacts__email">
                    <img src="{{asset('images/mail-header-white.svg')}}" alt="">
                    <span>info@vitra.md</span>
                </a>
                <a href="tel:+37322944955" class="contacts__phone">
                    <img src="{{asset('images/phone-white.svg')}}" alt="">
                    <span class="contacts__phone_text">+373 (22)-944-955</span>
                </a>
            </div>

        </div>
    </div>
    <div class="header__container" style="background-color: #fff">
        <div class="custom-container header__container_block">
            <div class="d-flex align-items-center">
            <div class="menu-btn__body" id="menuBtn">
                <div class="menu-btn" >
                    <span class="bar bg-black"></span>
                    <span class="bar bg-black"></span>
                    <span class="bar bg-black"></span>
                </div>
                <div class="menu-btn__body--text">
                    <p class="menu-text text-black">{{trans('labels.burger_label')}}</p>
                </div>

                <div class="nav__left--menu position-relative">
                    <div class="nav--left" onmouseleave="menuItemOut()" id="menuContent">

                        <nav class="nav--left__mainmenu">
                            <ul class="nav--left__ul">
                                <li class="nav--left__link"><a href="{{route('client.resolve')}}">{{trans('nav.solution')}}</a></li>
                                <li class="nav--left__link"><a href="{{route('client.portfolio')}}">{{trans('nav.portfolio')}}</a></li>
                                <li class="nav--left__link"><a href="{{route('client.about')}}">{{trans('nav.company')}}</a></li>
                                <li class="nav--left__link"><a href="{{route('client.contacts')}}">{{trans('nav.contacts')}}</a></li>
                            </ul>
                        </nav>

                        <div class="d-flex" id="menuContent">
                            <ul class="nav__list--left">
                                @foreach($industries as $industry)
                                    <li class="nav__list-item accordion__item left_item" onmouseenter="menuIndustryHover(this, {{$industry->id}}, '{{$industry->color}}' )"  onmouseleave="linkOut(this)" >
                                        <div class="nav__link--dropdown  accordion__item-trigger" onmouseenter="industryActiveHandler(this)">
                                            <a class="nav__link--left " style="color: {{$industry->color}}" href="{{route('client.industry', $industry->slug)}}">
                                                {{$industry->name}}
                                            </a>
                                            <svg width="18" height="18" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                <defs>
                                                    <style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
                                                </defs>
                                                <title/>
                                                <g id="chevron-top">
                                                    <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5"/>
                                                    <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5"/>
                                                </g>
                                            </svg>
                                        </div>

                                    </li>
                                @endforeach
                            </ul>
                            <div class="d-flex">
                                <ul class="accordion__left-content" id="accordion__left-content">

                                </ul>
                                <ul class="accordion__subcategory-content " id="accordionSubcategoryContent">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__logo" >
                <a href="{{url('/')}}" ><img class="header__logo_img" src="{{asset('images/logo-black.png')}}"  alt="Vitra"></a>
            </div>
            </div>

            <nav class="nav header__nav ">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="{{route('client.resolve')}}" class="nav__link text-black">{{trans('nav.solution')}}</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('client.portfolio')}}" class="nav__link text-black">{{trans('nav.portfolio')}}</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('client.about')}}" class="nav__link text-black">{{trans('nav.company')}}</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{route('client.contacts')}}" class="nav__link text-black">{{trans('nav.contacts')}}</a>
                    </li>
                </ul>

            </nav>
            <div class="search_desktop">
                <input type="text" class="nav__search black_icon" id="search" autocomplete="off" onfocus="onFocus()" min="1" max="50">
                <img class="close_search" src="{{asset('images/cross.svg')}}" alt="" onclick="clearSearch()">
                <div class="search_block" id="search_block"></div>
            </div>

            <div class="header__utilities_container">
            <div class="header__utilities">

                <a  href="{{route('client.basket')}}"  class="header__wishlist header__wishlist-cart" id="basketHeaderWhiteImage">
                    <img src="{{asset('images/cart_black.svg')}}" alt="">
                </a>
                <a  href="{{route('client.favorite')}}"  class="header__wishlist ">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet" >
                        <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                           fill="#000000" stroke="none">
                            <path d="M1262 4830 c-319 -40 -586 -171 -812 -399 -203 -204 -325 -420 -395 -701 -124 -487 -34 -967 264 -1418 191 -289 438 -554 891 -958 288 -257 1167 -1007 1210 -1032 40 -24 55 -27 140 -27 85 0 100 3 140 27 43 25 924 776 1210 1032 455 406 700 670 891 958 298 451 388 931 264 1418 -70 281 -192 497 -395
                                701 -202 203 -418 320 -701 380 -142 30 -404 33 -528 5 -346 -75 -611 -248 -853 -556 l-28 -35 -27 35 c-239 302 -500 475 -833 551 -99 23 -327 33 -438 19z m334 -305 c284 -50 529 -214 723 -485 33 -47 74 -103 90 -126 74 -104 228 -104 302 0 16 23 57 79 90 126 265 370 634 544 1036 489 446 -61 794 -373 927
                                -832 105 -363 59 -744 -132 -1087 -160 -287 -427 -588 -892 -1005 -225 -201 -1171 -1015 -1180 -1015 -10 0 -952 811 -1180 1015 -715 641 -997 1041 -1065 1510 -44 303 19 629 172 886 230 387 678 599 1109 524z"/>
                        </g>
                    </svg>
                </a>
                <a href="{{route('client.cabinet')}}" class="header__wishlist header__wishlist-login">
                    <img src="{{asset('images/login_black.svg')}}" alt="">
                </a>
                <div class="dropdown">
                    <button class="dropbtn-lang">
                        <img src="{{asset('images/language_black.svg')}}" alt="">
                        <span class="dropbtn-lang-text text-black">{{ Config::get('languages')[App::getLocale()] }}</span>
                    </button>
                    <div class="dropdown-content">
                        @foreach (Config::get('languages') as $lang => $language)
                            <a class="dropdown-link" href="{{ route('lang.switch', $lang) }}"> {{strtoupper($language)}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
            <div class="header_mobile">
                <div class="menu-btn__open-body">
                    <div class="d-flex w-75 justify-content-between mb-4">
                        <a href="{{url('/')}}" class="d-block" ><img src="{{asset('images/logo2-header.png')}}" alt="logo" class="nav--left__img"></a>


                    </div>

                    <div class="menu-btn__close">
                        <img src="{{asset('images/cancel.svg')}}" alt="">
                    </div>

                </div>
                <ul class="nav--left__mobile-menu">
                    <li class="nav--left__link"><a href="{{route('client.resolve')}}">{{trans('nav.solution')}}</a></li>
                    <li class="nav--left__link"><a href="{{route('client.portfolio')}}">{{trans('nav.portfolio')}}</a></li>
                    <li class="nav--left__link"><a href="{{route('client.about')}}">{{trans('nav.company')}}</a></li>
                    <li class="nav--left__link"><a href="{{route('client.contacts')}}">{{trans('nav.contacts')}}</a></li>
                </ul>
                <ul class="nav__list__mobile--left">
                    @foreach($industries as $industry)
                        <li class="nav__list-item accordion__item_mobile">
                            <div class="nav__link--dropdown  accordion__item-trigger">
                                <a class="nav__link--left" style="color: {{$industry->color}}" href="{{route('client.industry', $industry->slug)}}">
                                    {{$industry->name}}
                                </a>
                                <div class="trigger__img">
                                    <svg width="28px" height="28px" viewBox="0 0 32 32"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: #fff;
                                                    stroke: #fff;
                                                    stroke-linecap: round;
                                                    stroke-linejoin: round;
                                                    stroke-width: 2px;
                                                }
                                            </style>
                                        </defs>
                                        <title />
                                        <g id="chevron-top">
                                            <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5" />
                                            <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" />
                                        </g>
                                    </svg>
                                </div>
                            </div>

                            <ul class="nav__link--sublist accordion__item-content">
                                @foreach($categories as $category)
                                    {{--                            @dump($category)--}}
                                    @if($category->industry->id == $industry->id)
                                        <li class="nav__link--sublist-item">
                                            <a href="{{route('client.category', $category->slug)}}">{{$category->name_ro}}</a>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </li>
                    @endforeach
                </ul>


                @include('client.components.searchModal')
            </div>
        </div>
    </div>


</header>

@push('script')
    <script>

        const categories = {!! $categories !!};
        const subcategories = {!! $subcategoriesGlobal !!} ;



        function menuIndustryHover(el, industryId, color) {
            const accordionLeft = document.getElementById('accordion__left-content');
            el.style.color = color;


            accordionLeft.innerHTML =  categories.map(category =>{

                if(category['industry_id'] ==industryId) {
                    const url = window.location.origin+'/category/' + category['slug'];
                    const name = languageReplace('{{App::getLocale()}}', category['name_ro'], category['name_ru'], category['name_en'])

                    return `   <li class="on_hover_item" onmouseenter="menuCategoryHover(this, ${category['id']})" >
                                    <a href="${url}">${name}</a>
                                </li>`
                }

            }).join('')

            menuCategoryLeave();
        }

        function industryActiveHandler(el) {
            document.querySelectorAll('.nav__link--dropdown').forEach(item =>{
                item.classList.remove('active')

            })
            el.classList.add('active')
        }



        function menuCategoryHover(el, categoryId) {
            const accordionLeft = document.getElementById('accordionSubcategoryContent');
            accordionLeft.style.display = 'block';
            accordionLeft.style.backgroundColor = '#f8f5f5';

            document.querySelectorAll('.on_hover_item').forEach(item =>{
                item.classList.remove('active')

            })
            el.classList.add('active')

            accordionLeft.innerHTML =  subcategories.map(subcategory =>{

                if(subcategory['category_id'] ==categoryId) {
                    const url = window.location.origin+'/subcategory/' + subcategory['slug'];
                    const name = languageReplace('{{App::getLocale()}}', subcategory['name_ro'], subcategory['name_ru'], subcategory['name_en'])
                    return `   <li class="on_hover_item">
                                    <a href="${url}">${name}</a>
                                </li>`
                }

            }).join('')
        }

        function menuCategoryLeave() {
            document.getElementById('accordionSubcategoryContent').innerHTML = '';
            document.getElementById('accordionSubcategoryContent').style.display = 'none';
        }


        function linkOut(el) {
            el.style.color = 'black'
        }

        function menuItemOut() {
            document.getElementById('accordion__left-content').style.backgroundColor = '#fff';
        }

        function linkHandle() {
            document.querySelectorAll('.nav__link').forEach(item=>{
                const url = item.getAttribute("href")
                if(url === location.href) {
                    item.classList.add('active')
                }
            })
          }

        linkHandle()

        window.onload = function () {
            document.querySelector('.search_desktop').style.pointerEvents = 'all';
        };

        let searchInput = document.getElementById('search')
        searchInput.addEventListener('keyup', key => {
            if (key.code === 'Enter' && searchInput.value !== '') {
                window.location = `/search-page/${searchInput.value}`
            }
        })
        function clearSearch() {
            searchInput.value = '';
        }
        function closeSearchBlock(event) {
            if (event.target.id !== "search_block" && event.target.id !== "search") {
                document.querySelector('.search_desktop').classList.remove('focused')
                document.querySelector('.search_block').classList.remove('focused')
                document.querySelector('.close_search').style.display = 'none'
                document.querySelector('.main__body').classList.remove('active')
                document.querySelector('.main__body').style.overflow = 'initial'
                window.removeEventListener('click', closeSearchBlock)
            }
        }

        function onFocus() {
            document.querySelector('.search_desktop').classList.add('focused')
            document.querySelector('.search_block').classList.add('focused')
            document.querySelector('.close_search').style.display = 'block'
            document.querySelector('.main__body').classList.add('active')
            document.querySelector('.main__body').style.overflow = 'hidden'
            window.addEventListener('click', closeSearchBlock)
        }

        // function onFocusOut() {
        //     document.querySelector('.search_block').style.display ='none';
        // }

        $('#search').on('click',function() {
            const value = $(this).val();

            if (value === '') {
                $.ajax({
                    type: 'get',
                    url: '{{route('client.searchPopular')}}',
                    data: {'search': value},
                    success: function (data) {
                        $('.search_block').html(data);
                    }
                });
            } else {
                $.ajax({
                    type: 'get',
                    url: '{{route('client.search')}}',
                    data: {'search': value},
                    success: function (data) {
                        $('.search_block').html(data);
                    }
                });
            }
        });

        $('#search').on('keyup',function() {
            const value = $(this).val();

            $.ajax({
                type: 'get',
                url: '{{route('client.search')}}',
                data: {'search': value},
                success: function (data) {
                    $('.search_block').html(data);
                }
            });
        });

        {{--function onMobileSearch() {--}}
        {{--    const modal = document.getElementById('searchModal');--}}
        {{--    // console.log(modal)--}}
        {{--    let overlay;--}}
        {{--    const main = document.getElementById('main');--}}
        {{--    // main.append(modal)--}}

        {{--    // const modalInMain =main.lastElementChild--}}
        {{--    modal.style.opacity = '1';--}}
        {{--    modal.style.pointerEvents = 'auto';--}}
        {{--    createOverlay();--}}
        {{--    setTimeout(() => {--}}
        {{--        document.querySelector('.overlay').append(modal)--}}
        {{--        // modal.style.display = 'block';--}}
        {{--    }, 50);--}}

        {{--    const closeModalBtn = modal.querySelector('.close__dialog');--}}
        {{--    closeModalBtn.addEventListener('click', function() {--}}
        {{--        // modal.style.display = 'none';--}}
        {{--        modal.style.opacity = '0';--}}
        {{--        modal.style.pointerEvents = 'none';--}}
        {{--        removeOverlay();--}}
        {{--        document.querySelector('.header_mobile').append(modal)--}}
        {{--    });--}}

        {{--    $('.mobile__search_input').on('keyup',function() {--}}
        {{--        const value = $(this).val();--}}

        {{--        $.ajax({--}}
        {{--            type: 'get',--}}
        {{--            url: '{{route('client.search')}}',--}}
        {{--            data: {'search': value},--}}
        {{--            success: function (data) {--}}
        {{--                $('.search_mobile_block').html(data);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endpush



