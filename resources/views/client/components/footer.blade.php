<footer class="footer">
    <div class="footer__container">
        <div class="footer-body row">

            <div class="col-lg-5 row">
                {{--            ---------------Industry block ------------------}}
                <div class="col-sm-3 footer-category footer-common ">
                    <div class="nav__link--dropdown footer-accordion__item-trigger">
                        <h4 class="footer-category__title">{{trans('nav.industries')}}</h4>
                        <div class="trigger__img">

                            <svg width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <style>.cls-1{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
                                </defs>
                                <title></title>
                                <g id="chevron-top">
                                    <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5" style="stroke: #fff;"></line>
                                    <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" style="stroke: #fff;"></line>
                                </g>
                            </svg>
                        </div>
                    </div>

                    <ul class="nav__link--sublist footer-accordion__item-content footer-category__ul">
                        @foreach($industries as $industry)
                        <li class="footer-category__li">
                            <a href="{{route('client.industry',$industry->slug)}}" class="footer-category__link footer-common__link">{{$industry->name}}</a>
                        </li>
                        @endforeach

                        <li class="footer-upload-container open_download_modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#a9a9a9" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                            </svg>
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#a9a9a9" class="bi bi-upload" viewBox="0 0 16 16">--}}
{{--                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>--}}
{{--                                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>--}}
{{--                            </svg>--}}
                            <p class="footer-common__link open_download_modal ms-2">{{trans('nav.catalogPdf')}}</p>
                        </li>
                    </ul>

                </div>

                {{--            ---------------Relatii Clienti block ------------------}}


                <div class="col-sm-5 footer-clients footer-common ">
                    <div class="nav__link--dropdown footer-accordion__item-trigger">
                        <h4 class="footer-category__title">{{trans('nav.customerSupport')}}</h4>
                        <div class="trigger__img">
                            <svg width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <style>.cls-1{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
                                </defs>
                                <title></title>
                                <g id="chevron-top">
                                    <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5" style="stroke: #fff;"></line>
                                    <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" style="stroke: #fff;"></line>
                                </g>
                            </svg>
                        </div>
                    </div>

                    <ul class="nav__link--sublist footer-accordion__item-content footer-category__ul">
                        <li class="footer-category__li">
                            <a href="{{route('client.cabinet')}}" class="footer-category__link footer-common__link">{{trans('nav.personalCabinet')}}</a>
                        </li>
                        <li class="footer-category__li">
                            <a href="{{route('client.services')}}" class="footer-category__link footer-common__link">{{trans('nav.ourServices')}}</a>
                        </li>
                        <li class="footer-category__li">
                            <a href="{{route('client.terms')}}" class="footer-category__link footer-common__link">{{trans('nav.terms')}}</a>
                        </li>
                        <li class="footer-category__li">
                            <a href="{{route('client.delivery')}}" class="footer-category__link footer-common__link">{{trans('nav.delivery')}}</a>
                        </li>
                        <li class="footer-category__li">
                            <a href="{{route('client.policy')}}" class="footer-category__link footer-common__link">{{trans('labels.policy')}}</a>
                        </li>


                    </ul>
                </div>

                {{--            ---------------Companie block ------------------}}

                <div class="col-sm-4 footer-about footer-common  ">
                    <div class="nav__link--dropdown footer-accordion__item-trigger">
                        <h4 class="footer-category__title">{{trans('nav.company')}}</h4>
                        <div class="trigger__img">
                            <svg width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <style>.cls-1{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
                                </defs>
                                <title></title>
                                <g id="chevron-top">
                                    <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5" style="stroke: #fff;"></line>
                                    <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" style="stroke: #fff;"></line>
                                </g>
                            </svg>
                        </div>
                    </div>


                    <ul class="nav__link--sublist footer-accordion__item-content footer-category__ul">
                        <li class="footer-category__li">
                            <a href="{{route('client.about')}}" class="footer-category__link footer-common__link">{{trans('nav.aboutUs')}}</a>
                        </li>
                        <li class="footer-category__li">
                            <a href="{{route('client.news')}}" class="footer-category__link footer-common__link">{{trans('nav.news')}}</a>
                        </li>
                        <li class="footer-category__li">
                            <a href="{{route('client.careers')}}" class="footer-category__link footer-common__link">{{trans('nav.career')}}</a>
                        </li>
                        <li class="footer-category__li">
                            <a href="{{route('client.contacts')}}" class="footer-category__link footer-common__link">{{trans('nav.contacts')}}</a>
                        </li>
                    </ul>
                </div>

            </div>



            {{--            ---------------Contacte block ------------------}}

            <div class="col-lg-7 footer-contacts ">
                <a href="{{route('client.contacts')}}" class="nav__link--dropdown footer-accordion__item-trigger footer-category__contacts_title" style="padding-right: 23px">
                   <p  class="footer-category__title " >{{trans('nav.contacts')}}</p>
                    <div class="contacts_arrow" >
                        <svg width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" >
                            <defs>
                                <style>.cls-1{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
                            </defs>
                            <title></title>
                            <g id="chevron-top">
                                <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5" style="stroke: #fff;"></line>
                                <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" style="stroke: #fff;"></line>
                            </g>
                        </svg>
                    </div>
                </a>
                <ul class="nav__link--sublist row ">
                    <li class="col-sm-4 phone-email-container">
                        <div class="footer-category__li footer-phone">
                            <a href="tel:+37322944955" class="footer-category__link footer-common__link d-flex">
                                <img src="{{asset('images/phone-ringing-2.svg')}}" alt="Phone" class="footer-contacts__img">
                                <span>+373 (22) 944 955</span>
                            </a>
                        </div>
                        <div class="footer-category__li ">
                            <a href="mailto:info@vitra.md" class="footer-category__link footer-common__link">
                                <img src="{{asset('images/mail-142.svg')}}" alt="Email" class="footer-contacts__img">
                                <span>info@vitra.md</span>
                            </a>
                        </div>
                    </li>

                    <li class="col-sm-4">
                        <div class="footer-category__li">
                            <a href="https://www.google.com/maps/place/ViTRA/@47.015229,28.872639,17z/data=!4m6!3m5!1s0x40c97c0db034de07:0xb73eb8df1c872fbc!8m2!3d47.0152293!4d28.872639!16s%2Fg%2F11c1p5m6bs?hl=ru-RU&entry=ttu" target="_blank" class="footer-category__link footer-common__link d-flex align-items-center">
                                <img src="{{asset('images/location.svg')}}" alt="Location" class="footer-contacts__img">
                                <div class="address_text">
                                    <p class=" mb-0">{!! trans('nav.footer_showroom') !!}</p>
                                </div>
                            </a>
                        </div>
                        <div class="footer-category__li">
                            <a href="https://www.google.com/maps/place/ViTRA+(producere)+str.+Industrial%C4%83,+5/@47.0229716,28.8970203,17z/data=!3m1!4b1!4m6!3m5!1s0x40c97bb1686bb885:0x88953a592ce31a2c!8m2!3d47.022968!4d28.8995952!16s%2Fg%2F11sgy3hjv7?hl=ru-RU&entry=ttu" target="_blank" class="footer-category__link footer-common__link d-flex align-items-center">
                                <img src="{{asset('images/location.svg')}}" alt="Location" class="footer-contacts__img">

                                <div class="address_text">
                                    <p class=" mb-0">{!! trans('nav.footer_warehouse') !!}</p>
                                </div>
                            </a>
                        </div>
                        <div class="footer-category__li d-flex align-items-center">
{{--                            <a href="https://www.google.com/maps/place/ViTRA+(producere)+str.+Industrial%C4%83,+5/@47.0229716,28.8970203,17z/data=!3m1!4b1!4m6!3m5!1s0x40c97bb1686bb885:0x88953a592ce31a2c!8m2!3d47.022968!4d28.8995952!16s%2Fg%2F11sgy3hjv7?hl=ru-RU&entry=ttu" target="_blank" class="footer-category__link footer-common__link d-flex align-items-center">--}}
                                <img src="{{asset('images/location.svg')}}" alt="Location" class="footer-contacts__img">

                                <div class="address_text">
                                    <p class=" mb-0">{!! trans('nav.footer_office') !!}</p>
                                </div>
{{--                            </a>--}}
                        </div>

                    </li>

                    <li class="col-sm-4">
                        <div class="social-card-container ">
                            <div class="footer-contacts__social ">
                                <a href="https://www.facebook.com/vitra.shop" target="_blank" class="social-svg__link">

                                    <svg fill="#fff" width="25" height="25" viewBox="0 0 1920 1920"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m1416.013 791.915-30.91 225.617h-371.252v789.66H788.234v-789.66H449.808V791.915h338.426V585.137c0-286.871 176.207-472.329 449.09-472.329 116.87 0 189.744 6.205 231.822 11.845l-3.272 213.66-173.5.338c-4.737-.451-117.771-9.25-199.332 65.655-52.568 48.169-79.191 117.433-79.191 205.65v181.96h402.162Zm-247.276-304.018c44.446-41.401 113.71-36.889 118.787-36.663l289.467-.113 6.204-417.504-43.544-10.717C1511.675 16.02 1426.053 0 1237.324 0 901.268 0 675.425 235.206 675.425 585.137v93.97H337v451.234h338.425V1920h451.234v-789.66h356.7l61.932-451.233H1126.66v-69.152c0-54.937 14.214-96 42.078-122.058Z"
                                            fill-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="https://www.instagram.com/vitra.md/?fbclid=IwAR0GTZbjRmQB4nAbajVRHdMbwNM06M_1-bzP4dAMatH1PRCIJSShqYtfza4" target="_blank" class="social-svg__link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"  fill="#fff"
                                         viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/company/10047444/admin/notifications/all" target="_blank" class="social-svg__link">

                                    <svg fill="#fff" viewBox="0 0 1920 1920" width="23" height="23"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1168 601.321v74.955c72.312-44.925 155.796-71.11 282.643-71.11 412.852 0 465.705 308.588 465.705 577.417v733.213L1438.991 1920v-701.261c0-117.718-42.162-140.06-120.12-140.06-74.114 0-120.12 23.423-120.12 140.06V1920l-483.604-4.204V601.32H1168Zm-687.52-.792v1318.918H0V600.53h480.48Zm-120.12 120.12H120.12v1078.678h240.24V720.65Zm687.52.792H835.267v1075.316l243.364 2.162v-580.18c0-226.427 150.51-260.18 240.24-260.18 109.55 0 240.24 45.165 240.24 260.18v580.18l237.117-2.162v-614.174c0-333.334-93.573-457.298-345.585-457.298-151.472 0-217.057 44.925-281.322 98.98l-16.696 14.173H1047.88V721.441ZM240.24 0c132.493 0 240.24 107.748 240.24 240.24 0 132.493-107.747 240.24-240.24 240.24C107.748 480.48 0 372.733 0 240.24 0 107.748 107.748 0 240.24 0Zm0 120.12c-66.186 0-120.12 53.934-120.12 120.12s53.934 120.12 120.12 120.12 120.12-53.934 120.12-120.12-53.934-120.12-120.12-120.12Z"
                                            fill-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="https://www.youtube.com/@vitramoldova" target="_blank" class="social-svg__link pt-1">

                                    <svg width="32" height="32"  viewBox="0 -0.5 25 25" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" style="z-index: 10;"
                                              d="M18.168 19.0028C20.4724 19.0867 22.41 17.29 22.5 14.9858V9.01982C22.41 6.71569 20.4724 4.91893 18.168 5.00282H6.832C4.52763 4.91893 2.58998 6.71569 2.5 9.01982V14.9858C2.58998 17.29 4.52763 19.0867 6.832 19.0028H18.168Z"
                                              stroke="#a9a9a9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" style="z-index: 10;"
                                              d="M12.008 9.17784L15.169 11.3258C15.3738 11.4454 15.4997 11.6647 15.4997 11.9018C15.4997 12.139 15.3738 12.3583 15.169 12.4778L12.008 14.8278C11.408 15.2348 10.5 14.8878 10.5 14.2518V9.75184C10.5 9.11884 11.409 8.77084 12.008 9.17784Z"
                                              stroke="#a9a9a9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                                <a href="https://t.me/vitramd1" target="_blank" class="social-svg__link">

                                    <svg width="25" height="25" viewBox="0 0 24 24" fill="#fff"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M23.1117 4.49449C23.4296 2.94472 21.9074 1.65683 20.4317 2.227L2.3425 9.21601C0.694517 9.85273 0.621087 12.1572 2.22518 12.8975L6.1645 14.7157L8.03849 21.2746C8.13583 21.6153 8.40618 21.8791 8.74917 21.968C9.09216 22.0568 9.45658 21.9576 9.70712 21.707L12.5938 18.8203L16.6375 21.8531C17.8113 22.7334 19.5019 22.0922 19.7967 20.6549L23.1117 4.49449ZM3.0633 11.0816L21.1525 4.0926L17.8375 20.2531L13.1 16.6999C12.7019 16.4013 12.1448 16.4409 11.7929 16.7928L10.5565 18.0292L10.928 15.9861L18.2071 8.70703C18.5614 8.35278 18.5988 7.79106 18.2947 7.39293C17.9906 6.99479 17.4389 6.88312 17.0039 7.13168L6.95124 12.876L3.0633 11.0816ZM8.17695 14.4791L8.78333 16.6015L9.01614 15.321C9.05253 15.1209 9.14908 14.9366 9.29291 14.7928L11.5128 12.573L8.17695 14.4791Z"
                                              fill="#00000" />
                                    </svg>
                                </a>

                            </div>
                            <div class="d-flex justify-content-end">
                                <ul class="footer-contacts__cards">
                                    <li class="footer-contacts__cards-item">
                                        <img src="{{asset('images/cards/Maestro.png')}}" alt="Maestro">
                                    </li>
                                    <li class="footer-contacts__cards-item">
                                        <img src="{{asset('images/cards/Mastercard.png')}}" alt="Mastercard">
                                    </li>
                                    <li class="footer-contacts__cards-item">
                                        <img src="{{asset('images/cards/visa-electron.png')}}" alt="Visa">
                                    </li>
                                    <li class="footer-contacts__cards-item">
                                        <img src="{{asset('images/cards/Visa.png')}}" alt="Visa">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
{{--            -----------social-card-container ------------------}}

            <div class=" row social-card-block">

            </div>
        </div>

    </div>
    <div class="footer-second">
        <div class="custom-container footer-second__container">
            <img src="{{asset('images/logo-footer.png')}}" alt="" class="footer-second__logo">
            <p class="footer-second__copyright">© 2024 ViTRA</p>
        </div>
    </div>
</footer>
