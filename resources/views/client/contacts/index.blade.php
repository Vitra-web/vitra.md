@extends('layouts.client')

@section('content')
    <main>


        <section class="mainindustry-section">
            <div class=" main_slider_block" style="background-image: url({{url('storage/'.$contactsPage->image)}});">
                <h1 class="mainindustry-section__title text-uppercase">{{$title}}</h1>
            </div>
        </section>

        @include('client.components.breadСrumbs')

        <section class="custom-container">

            <div class="d-flex justify-content-center">
                <div class="contacts_block">

                    <div class="contacts_list ">
                        @foreach($contacts as $contact)
                            <div class="contacts_item ">
                                <div class="contacts_bg_block">
                                    <p class="contact_location_name">{{$language->replace($contact->title_ro, $contact->title_ru,$contact->title_en )}}</p>
                                </div>
                                <div class="contacts_bottom">
                                    <div class="d-flex flex-column h-100">
                                        <div class="contacts_address_mail">
                                            <div class="d-flex flex-column gap-3">

                                                <div class="d-flex align-items-center w-100 h-100">
                                                    <img src="{{asset('images/location.png')}}" alt="Location"
                                                         class="contact_img">
                                                    @if(isset($contact->link))
                                                        <a target="_blank" href="{{$contact->link}}"
                                                           class="contact_text">{!! $contact->address !!}</a>
                                                    @else
                                                        <span class="contact_text">{!! $contact->address !!}</span>
                                                    @endif
                                                </div>

                                                @if(isset($contact->link))
                                                    <div class="w-100 h-100">
                                                        <a class="contact_see_google" target="_blank"
                                                           href="{{$contact->link}}">{{trans('labels.see_in_map')}}</a>
                                                    </div>
                                                @else
                                                    <div class="w-100" style="height: 15px;"></div>
                                                @endif
                                            </div>

                                            <div class="d-flex flex-column gap-3">
                                                @if(isset($contact->phone))
                                                    <div class="w-100">
                                                        <img src="{{asset('images/mobile-call.png')}}" alt="Phone"
                                                             class="contact_img">
                                                        <a href="tel:{{str_replace(' ', '', $contact->phone) }}"
                                                           class="contact_text">{{$contact->phone}}</a>
                                                    </div>
                                                @else
                                                    <div class="w-100" style="height: 27px;"></div>
                                                @endif

                                                @if(isset($contact->email))
                                                    <div class="w-100">
                                                        <img src="{{asset('images/mail.png')}}" alt="Email"
                                                             class="contact_img">
                                                        <a href="mailto:{{$contact->email}}"
                                                           class="contact_text">{{$contact->email}}</a>
                                                    </div>
                                                @else
                                                    <div class="w-100" style="height: 27px;"></div>
                                                @endif
                                            </div>
                                        </div>


                                    </div>

                                </div>

                            </div>
                        @endforeach
                        <div class="contacts_item ">
                            <div class="contacts_bg_block">
                                <p class="contact_location_name">{{trans('labels.departments')}}</p>
                            </div>
                            <div class="contacts_bottom">
                                <div class="contacts_bottom_container">

                                    <div class="department_item">
                                        <p class="department_name">{{trans('labels.finances')}}</p>

                                        <div class="department_data ">
                                            <img src="{{asset('images/mobile-call.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="tel:+37379997407" target="blank" class="department_text">+373 79
                                                997 407</a>
                                        </div>

                                        <div class="department_data ">
                                            <img src="{{asset('images/mail.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="mailto:contabil1@vitra.md"
                                               class="contact_text">contabil1@vitra.md</a>
                                        </div>
                                    </div>

                                    <div class="department_item">
                                        <p class="department_name">{{trans('labels.acquisitions')}}</p>
                                        <div class="department_data ">
                                            <img src="{{asset('images/mobile-call.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="tel:+37379922862" target="blank" class="department_text">+373 79
                                                922 862</a>
                                        </div>

                                        <div class="department_data ">
                                            <img src="{{asset('images/mail.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="mailto:import1@vitra.md" class="contact_text">import1@vitra.md</a>
                                        </div>
                                    </div>

                                    <div class="department_item">
                                        <p class="department_name">{{trans('labels.international_sales')}}</p>
                                        <div class="department_data ">
                                            <img src="{{asset('images/mobile-call.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="tel:+37378229912" target="blank" class="department_text">+373 78
                                                229 912</a>
                                        </div>

                                        <div class="department_data ">
                                            <img src="{{asset('images/mail.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="mailto:sales@moduline.md"
                                               class="contact_text">sales@moduline.md</a>
                                        </div>
                                    </div>

                                    <div class="department_item">
                                        <p class="department_name">{{trans('labels.marketing')}}</p>
                                        <div class="department_data ">
                                            <img src="{{asset('images/mobile-call.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="tel:+37369657770" target="blank" class="department_text">+373 69
                                                657 770</a>
                                        </div>

                                        <div class="department_data ">
                                            <img src="{{asset('images/mail.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="mailto:vitrasrl@gmail.com"
                                               class="contact_text">vitrasrl@gmail.com</a>
                                        </div>
                                    </div>

                                    <div class="department_item">
                                        <a href="{{route('client.careers')}}" class="department_name"
                                           style="text-decoration: underline;">{{trans('labels.human_resources')}}</a>
                                        <div class="department_data ">
                                            <img src="{{asset('images/mobile-call.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="tel:+37379606070" target="blank" class="department_text">+373 79
                                                606 070</a>
                                        </div>

                                        <div class="department_data ">
                                            <img src="{{asset('images/mail.png')}}" alt="Location"
                                                 class="department_img">
                                            <a href="mailto:hr@vitra.md" class="contact_text">hr@vitra.md</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>
            </div>


        </section>

        <section class="contact-form__section contact-form">
            <div class="custom-container contact-form__container">

                <p class="contact-form-title">{{trans('labels.contact_form_title')}}</p>

                <form action="{{route('client.contactMail')}}" method="post" class="contact-form__action row p-0">
                    @csrf
                    <div class="contact-form-image_container col-md-5 p-0">
                        <img class="contact-form-image" src="{{url('/images/forms/contact_page.png')}}"
                             alt="form image">

                    </div>

                    <div class="col-md-7 p-0">
                        <div class="contact-form-right ">
                            <p class="contact-form-description">{{trans('labels.contact_form_description')}}</p>
                            <div class="contact-form-inputs">
                                <label for="name" class="contact-name-label">
                                    <input id="name" name="name" type="text" class="contact-input-text"
                                           value="{{old('name')}}"
                                           placeholder="{{trans('labels.name')}} {{trans('labels.second_name')}}*">
                                    <p class="text_error" id="name_danger"></p>
                                    @error('name')<p class="text-danger"> {{$message}}</p>@enderror
                                </label>

                                <label for="email" class="contact-name-label">
                                    <input id="email" name="email" type="email" class="contact-input-text"
                                           value="{{old('email')}}" placeholder="{{trans('labels.email')}}">
                                    <p class="text_error" id="email_danger"></p>
                                    @error('email')<p class="text-danger"> {{$message}}</p>@enderror
                                </label>

                                <label for="phone" class="contact-name-label">
                                    <input id="phone" name="phone" type="tel" class="contact-input-text"
                                           style="padding-left:55px" value="{{old('phone')}}">
                                    <p class="text_error" id="phone_danger"></p>
                                    @error('phone')<p class="text-danger"> {{$message}}</p>@enderror
                                </label>


                            </div>


                            <label for="message" class="contact-message-label">
                                <textarea rows="4" name="message" id="message" class="contact-form__action-textarea"
                                          placeholder="{{trans('labels.message')}}">{{old('message')}}</textarea>
                                <p class="text_error" id="message_danger"></p>
                                @error('message')<p class="text-danger"> {{$message}}</p>@enderror
                            </label>

                            <div class="checkbox-btn-container">
                                <div>
                                    <label class="checkbox__item">
                                        <input type="checkbox" name="vacancyNotification" value="1"
                                               class="checkbox__input" id="contactCheckbox">
                                        <span class="fake"></span>
                                        <span class="checkbox_text">{{trans('labels.accept_policy')}} <a
                                                href="{{route('client.terms')}}" target="_blank"
                                                class="checkbox_link">{{trans('nav.terms')}}</a></span>
                                    </label>
                                    <p class="text_error" id="policy_danger"></p>
                                </div>

                                <div class="contact-form__action-btn_container">
                                    <button class="custom-btn contact-form__action-btn" onclick="handleSubmit()"
                                            type="button">{{trans('labels.send')}}</button>
                                </div>

                            </div>

                        </div>
                    </div>


                </form>


            </div>
        </section>


        <div id="map" style="width: 100%; height: 500px"></div>
        <div class="toast-overlay"
             id="toast-overlay"></div>
        {{--    @include('client.components.uploadBlock')--}}
    </main>

@endsection

@push('script')

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUqh4ukNpbpeP_hZadM0G27TXklXgHxaw&language=ro&callback=initMap"></script>


    <script>
        let contactInputAll = document.querySelectorAll('.contact-input-text');
        let itiContacts = null;

        $(document).ready(function () {
            itiContacts = phoneCountryHandler('#phone')
        });


        for (let inputOne of contactInputAll) {
            inputOne.addEventListener('focusin', (el) => {
                // el.target.id = el.target.name
                if (el.target.placeholder !== "" && el.target.type !== 'tel') {
                    el.target.insertAdjacentHTML('beforebegin', `
                            <div class="input_placeholder">${el.target.placeholder}</div>
                        `)
                }
                el.target.placeholder = ""
            })

        }

        const contactTextarea = document.querySelector('.contact-form__action-textarea')

        contactTextarea.addEventListener('focusin', (el) => {
            // el.target.id = el.target.name
            if (el.target.placeholder !== "") {
                el.target.insertAdjacentHTML('beforebegin', `
                            <div class="input_placeholder">${el.target.placeholder}</div>
                        `)
            }
            el.target.placeholder = ""
        })

        function handleSubmit() {
            const name = document.getElementById('name');
            const nameDanger = document.getElementById('name_danger');
            const email = document.getElementById('email');
            const emailDanger = document.getElementById('email_danger');
            const phone = document.getElementById('phone');
            const phoneDanger = document.getElementById('phone_danger');
            const message = document.getElementById('message');
            const messageDanger = document.getElementById('message_danger');
            const policyDanger = document.getElementById('policy_danger');


            checkInputField(name, nameDanger, '{{trans('labels.form_name_error')}}')
            checkInputField(phone, phoneDanger, '{{trans('labels.form_phone_error')}}')
            checkInputField(message, messageDanger, '{{trans('labels.form_message_error')}}')

            const checkboxChecked = document.getElementById('contactCheckbox').checked

            if (!checkboxChecked) {
                policyDanger.style.display = 'block';
                policyDanger.textContent = '{{trans('labels.form_policy_error')}}';
            }

            if (name.value !== '' && phone.value !== '' && message.value !== '' && checkboxChecked) {

                const data = {
                    'name': name.value,
                    'email': email.value,
                    'phone': itiContacts.getNumber(),
                    'message': message.value,

                }
                console.log(data)
                $.ajax({
                    url: "/contact-mail",
                    method: 'POST',
                    data: data,
                    // headers: {
                    //     'Content-Type': 'application/json',
                    //
                    // },

                }).done(function (res) {
                    console.log(res)
                    if (res.status === 'ok') {
                        showToast('Datele au fost trimise', 'success')
                        name.value = '';
                        email.value = '';
                        phone.value = '';
                        message.value = '';
                        policyDanger.style.display = 'none';
                    } else {
                        showToast('Datele n-au fost trimise', 'danger')
                    }
                });
            }

        }

        // $("#phone").on("change keyup paste", function () {
        //     var output;
        //     var input = $("#phone").val();
        //     input = input.replace(/[^0-9]/g, '');
        //     var area = input.substr(0, 3);
        //     var pre = input.substr(3, 3);
        //     var tel = input.substr(6, 5);
        //
        //     if (area.length < 3) {
        //         output = "(+" + area;
        //     } else if (area.length == 3 && pre.length < 3) {
        //         output = "(+" + area + ")" + " " + pre;
        //     } else if (area.length == 3 && pre.length == 3 ) {
        //         output = "(+" + area + ")" + " " + pre + "-" + tel;
        //     }
        //     $("#phone").val(output);
        // });


        let map;
        const contacts = {!! $contacts !!};

        // console.log(contacts[0]['title_ro'])
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 47.015321391818205,
                    lng: 28.872963180004227
                },
                zoom: 13,
                styles: [{
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#444444"
                    }]
                }, {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [{
                        "color": "#f2f2f2"
                    }]
                }, {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [{
                        "saturation": -100
                    }, {
                        "lightness": 45
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "simplified"
                    }]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [{
                        "color": "#46bcec"
                    }, {
                        "visibility": "on"
                    }]
                }]
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: 47.015321391818205,
                    lng: 28.872963180004227
                },
                map: map,
                title: contacts[0]['title_ro'],
                icon: '/images/logo3.png'
            });
            var marker2 = new google.maps.Marker({
                position: {
                    lat: 47.02005594764298,
                    lng: 28.89869571095975
                },
                map: map,
                title: contacts[1]['title_ro'],
                icon: '/images/logo3.png'
            });


            // Создаем наполнение для информационного окна
            var contentString = '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<div id="bodyContent">' +
                '<p style="margin-bottom: 0"><b style="font-weight: 900">' + contacts[0]['title_ro'] + '</b></p>' +
                '<p style="margin-bottom: 0"><b>str. Uzinelor 4</b></p>' +
                '<p style="margin-bottom: 0"><b>Program 9.00 – 18.00</b></p>' +
                '</div>' +
                '</div>';


            // Создаем наполнение для информационного окна
            var contentString2 = '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<div id="bodyContent">' +
                '<p style="margin-bottom: 0"><b style="font-weight: 900">' + contacts[1]['title_ro'] + '</b></p>' +
                '<p style="margin-bottom: 0"><b>str. Industriala, 5</b></p>' +
                '<p style="margin-bottom: 0"><b>Program 9.00 – 18.00</b></p>' +
                '</div>' +
                '</div>';


            // Создаем информационное окно
            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 280,
                maxHeight: 100
            });
            // Создаем информационное окно
            var infowindow2 = new google.maps.InfoWindow({
                content: contentString2,
                maxWidth: 280,
                maxHeight: 100
            });

            // Создаем прослушивание, по клику на маркер - открыть инфо-окно infowindow
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });

            // Создаем прослушивание, по клику на маркер - открыть инфо-окно infowindow
            marker2.addListener('click', function () {
                infowindow2.open(map, marker2);
            });

            // Загружаем сразу инфо-окно
            infowindow.open(map, marker);
            infowindow2.open(map, marker2);
            //infoWindow.open(map);

        }


    </script>

@endpush
