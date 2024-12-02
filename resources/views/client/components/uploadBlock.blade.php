<section class="upload-block__section upload-block">
    <div class="custom-container">
        <div class="upload-block__body">
            <div class="upload-block__items">
                <div class="listBtnDropdown">
                    <div class="btnDropdown first">
                        <button class="btnNav">

                            <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="none" />
                                <path d="M5 12V18C5 18.5523 5.44772 19 6 19H18C18.5523 19 19 18.5523 19 18V12"
                                      stroke="#000000" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 3L12 15M12 15L16 11M12 15L8 11" stroke="#000000" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                            <p class="mt-2">{!! trans('labels.download_documents') !!}</p>
                            <svg width="800px" height="800px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="arrow-upload-block">
                                <defs>
                                    <style>.cls-1{fill:none;stroke:#000000;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
                                </defs>
                                <title/>
                                <g id="chevron-top">
                                    <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5"/>
                                    <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5"/>
                                </g>
                            </svg>
                        </button>
                        <div class="dropdown">
                            <div class="dropdown-content">
                                <ul class="dropdown-content__ul">
                                    @foreach($industries as $industry)
                                    <li>
                                        <a class="dropdown-content__a" href="{{url('storage/'.$industry->pdf)}}" download><img src="{{asset('images/1.png')}}" alt="">{{trans('labels.download_catalog')}}
                                            {{$industry->name}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="upload-block__tell">
                    <img src="{{asset('images/phone.svg')}}" alt="">
                    <a href="tel:+37322944955">+373 (22)-944-955</a>
                </div>
                <div class="upload-block__email">
                    <img src="{{asset('images/mail-header.svg')}}" alt="">
                    <a href="mailto:info@vitra.md">info@vitra.md</a>
                </div>
            </div>
            <div class="upload-block__btn">
                <a href="" class="custom-btn offer-info-btn">{!! trans('labels.requestConsultation') !!}</a>
            </div>
        </div>
    </div>
</section>

@include('client.components.modals.consultationModal')

@push('script')
    <script>
        bindModal('.offer-info-btn', '.modal__wrapper-offer', '.modal__close-offer')
    </script>
@endpush
