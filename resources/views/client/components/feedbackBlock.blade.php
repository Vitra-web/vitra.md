@php
    use Illuminate\Support\Facades\Route;

    $name = Route::currentRouteName();
@endphp

<div class="feedback_block">
    <div class="feedback_call_container" id="feedbackCall" onclick="callHandler()">
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.000000 512.000000" width="40" height="40"
             preserveAspectRatio="xMidYMid meet" id="feedback_call_icon" class="feedback_call_icon">
            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
               fill="#000000" stroke="none">
                <path d="M1655 4800 c-195 -41 -352 -179 -417 -368 l-23 -67 0 -1805 0 -1805 23 -66 c57 -166 185 -294 350 -351 l67 -23 905 0 905 0 67 23 c165 57 293 185 350 351 l23 66 0 1805 0 1805 -23 67 c-57 164 -178 286 -348 350 l-59 23 -890 2 c-489 0 -908 -3 -930 -7z m1790 -307 c29 -9 66 -33 90 -58 81 -81 75 75 75 -1875 0 -1950 6 -1794 -75 -1875 -78 -78 -33 -75 -975 -75 -942 0 -897 -3 -975 75 -81 81 -75 -75 -75 1875 0 1950 -6 1794 75 1875 76 77 29 73 971 74
                        757 1 845 -1 889 -16z"/>
                <path
                    d="M2288 4189 c-43 -22 -78 -81 -78 -129 0 -50 35 -107 80 -130 36 -18 58 -20 270 -20 212 0 234 2 270 20 45 23 80 80 80 130 0 50 -35 107 -80 130 -36 18 -58 20 -272 20 -212 -1 -236 -3 -270 -21z"/>
                <path d="M2288 1189 c-43 -22 -78 -81 -78 -129 0 -50 35 -107 80 -130 36 -18 58 -20 270 -20 212 0 234 2 270 20 45 23 80 80 80 130 0 50 -35 107 -80 130
                        -36 18 -58 20 -272 20 -212 -1 -236 -3 -270 -21z"/>
                <path
                    d="M275 3587 c-32 -18 -48 -38 -77 -97 -77 -153 -140 -364 -174 -580 -25 -160 -26 -527 -1 -693 32 -215 96 -431 175 -587 41 -82 88 -120 150 -120 77 0 152 73 152 149 0 16 -18 68 -40 115 -218 475 -211 1154 16 1608 13 26 24 61 24 78 0 50 -35 107 -80 130 -51 26 -95 25 -145 -3z"/>
                <path d="M4698 3589 c-42 -22 -78 -81 -78 -128 0 -16 18 -68 40 -115 213 -463  212 -1127 -1 -1570 -21 -45 -39 -96 -39 -114 0 -79 73 -152 152 -152 62 0 109
                        38 150 120 79 156 143 372 175 587 24 164 24 522 0 686 -32 215 -96 431 -175
                        587 -29 59 -45 79 -77 97 -49 28 -98 28 -147 2z"/>
                <path d="M780 3292 c-58 -31 -135 -179 -180 -347 -93 -350 -49 -765 110 -1042
                        50 -87 129 -114 210 -73 45 23 80 80 80 131 0 18 -16 63 -35 100 -152 295
                        -152 696 0 999 41 81 43 120 12 174 -40 70 -126 95 -197 58z"/>
                <path d="M4200 3291 c-42 -22 -80 -83 -80 -129 0 -18 16 -64 35 -102 152 -303
                        152 -704 0 -999 -41 -79 -44 -120 -12 -175 61 -107 201 -99 267 17 211 367
                        211 947 0 1314 -49 85 -134 115 -210 74z"/>
            </g>
        </svg>


    </div>
    <div class="feedback_message_container" id="feedbackMessage" onclick="messageHandler()">
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" class="feedback_message_icon"
             width="40" height="40" viewBox="0 0 512.000000 512.000000"
             preserveAspectRatio="xMidYMid meet">
            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
               fill="#000000" stroke="none">
                <path d="M482 5080 c-100 -27 -174 -70 -259 -156 -54 -53 -82 -91 -108 -146 -64 -135 -65 -141 -65 -873 0 -735 1 -741 66 -875 91 -183 308 -319 512 -320 l42 0 0 -202 c0 -192 2 -206 24 -253 28 -61 87 -116 149 -140 57 -22 165 -17 217 10 19 9 130 112 247 228 l212 210 3 -629 3 -629 27 -80 c86 -254 294 -428
                    552 -464 47 -7 273 -11 574 -11 l497 0 340 -339 c221 -220 356 -347 385 -362 37 -20 60 -24 130 -24 73 0 92 4 136 27 28 15 70 48 92 73 67 76 72 104 72 382 l0 243 43 0 c310 2 566 184 665 475 l27 80 0 845 c0 945 3 895 -73 1050
                    -54 111 -178 233 -292 288 -152 75 -120 72 -921 72 l-718 0 -3 533 c-4 516 -4 534 -26 597 -66 197 -228 349 -423 395 -55 13 -203 15 -1059 14 -949 0 -998 -1 -1068 -19z m2130 -247 c71 -32 141 -103 174 -176 l29 -62 0 -515 0 -515
                    -385 -6 c-422 -6 -414 -5 -545 -72 -191 -100 -324 -286 -355 -503 l-12 -81 -283 -283 c-205 -205 -287 -281 -301 -278 -18 3 -19 18 -24 263 -7 347 0 337 -215 346 -135 5 -147 7 -208 37 -76 38 -129 92 -166 171 l-26 56 0 685 c0 639 1 689 18 738 21 58 100 153 151 179 81 42 67 42 1106 40 l995 -2 47 -22z
                    m1970 -1552 c121 -61 213 -181 238 -311 14 -72 14 -1549 0 -1621 -24 -126 -108 -243 -218 -302 -72 -39 -167 -57 -308 -57 -109 0 -124 -2 -149 -22 -52  -41 -55 -62 -55 -379 0 -440 27 -441 -435 22 -193 193 -362 357 -377 365 -22 12 -117 14 -565 14 -587 0 -626 3 -725 57 -110 59 -194 176 -218 302 -14 72
                    -14 1549 0 1621 29 150 139 278 285 331 47 18 112 18 1255 16 l1205 -2 67 -34z"/>
                <path
                    d="M2480 2319 c-94 -38 -130 -161 -75 -255 28 -48 91 -84 146 -84 78 0  160 69 175 146 14 74 -27 153 -97 190 -32 16 -112 18 -149 3z"/>
                <path
                    d="M3230 2323 c-91 -34 -137 -155 -92 -242 9 -19 34 -48 55 -65 34 -27 47 -31 102 -31 55 0 68 4 102 31 136 109 69 315 -102 313 -27 0 -57 -3 -65 -6z"/>
                <path
                    d="M3955 2312 c-127 -80 -124 -244 5 -309 121 -62 250 20 250 159 0 60 -23 105 -73 142 -40 29 -141 34 -182 8z"/>
            </g>
        </svg>

    </div>

    <div class="feedback_call_form " id="feedback_call_form">

        <div class="feedback_call_form_top">
            <p class="feedback_call_form_title">{{trans('labels.request_call')}}</p>
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" onclick="callHandler()"
                 width="25" height="25" fill="#000" viewBox="0 0 492 492"
                 style="enable-background:new 0 0 492 492; cursor: pointer" xml:space="preserve">
                <g>
                    <g>
                        <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052
                            L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116
                            c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                    </g>
                </g>
                </svg>
        </div>
        <div class="feedback_call_form_bottom">
            <img loading="lazy" class="feedback_call_form_image" src="{{asset('images/svg/logo_black.svg')}}" alt="Vitra">
            @if($name == 'client.careers')
                <a href="tel: +37379606 070" target="_blank" class="feedback_call_form_phone">+373 79 606 070</a>
            @else
                <a href="tel: +37322944955" target="_blank" class="feedback_call_form_phone">+373 (22)-944-955</a>
            @endif

            @if($name == 'client.careers')
                <p class="feedback_call_form_name">HR Manager</p>
            @else
                <p class="feedback_call_form_address">str. Uzinelor 4, Chisinau, Moldova</p>
            @endif

        </div>

    </div>

    <div class="feedback_message_form " id="feedbackMessageForm">

        <div class="feedback_message_form_top">
            <p class="feedback_message_form_title">{{trans('labels.request_message')}}</p>
            <div class="feedback_message_form_close" onclick="messageHandler()">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="25" height="25" fill="#fff" viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;"
                     xml:space="preserve">
                <g>
                    <g>
                        <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052
                            L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116
                            c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                    </g>
                </g>
                </svg>
            </div>

        </div>
        <div class="feedback_message_form_bottom">
            <p class="feedback_message_form_description">{{trans('labels.request_message_description')}}</p>
            <div class="feedback_message_industry">
                @foreach($industries as $industry)
                    <button class="feedback_message_industry_block"
                            onclick="chooseIndustry({{$industry->id}}, '{{$industry->color}}')">
                        {{$industry->name}}
                    </button>
                @endforeach
            </div>
        </div>

    </div>

    <div class="feedback_career_form" id="feedbackCareerForm">
        <div class="feedback_career_form_top">
            <p class="feedback_career_form_title">{{trans('labels.feedback_career_title')}}</p>
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" onclick="closeCareerForm()"
                 width="15" height="15" fill="#000" viewBox="0 0 492 492"
                 style="enable-background:new 0 0 492 492; cursor: pointer" xml:space="preserve">
                <g>
                    <g>
                        <path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052
                            L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116
                            c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                    </g>
                </g>
                </svg>
        </div>
        <div class="feedback_career_form_bottom">
            <p class="feedback_career_form_description">
                {{trans('labels.feedback_career_description')}}
            </p>
            <div class="feedback_career_form_container">
                <div class="feedback_career_form-action">
                    <div class="feedback_career_form-select-container">
                        <select class="feedback_career_form-select" name="type" id="feedbackType">
                            <option value="0" class="feedback_career_form-option" disabled selected>Despre</option>
                            <option value="1" class="feedback_career_form-option">Vreau un job</option>
                            <option value="2" class="feedback_career_form-option">Am o propunere</option>
                            <option value="3" class="feedback_career_form-option">Traininguri</option>
                            <option value="4" class="feedback_career_form-option">Formare profesională</option>
                            <option value="5" class="feedback_career_form-option">Salarii și beneficii</option>
                        </select>

                        <svg width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <style>.cls-1 {
                                        fill: none;
                                        stroke: #cdcbcb;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                        stroke-width: 2px;
                                    }</style>
                            </defs>
                            <title></title>
                            <g id="chevron-top">
                                <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5"
                                      style="stroke: rgb(0, 0, 0);"></line>
                                <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5"
                                      style="stroke: rgb(0, 0, 0);"></line>
                            </g>
                        </svg>

                        <p class="text_error" id="vacancy_cv_danger"></p>
                    </div>

                </div>

                <textarea name="message" id="feedbackMessage" cols="30" class="feedback_career_form-message"
                          rows="10"></textarea>

                <div class="feedback_career_form_labels">
                    <label for="name" class="name-label">
                        <input id="name" name="name" type="text" class="input-text"
                               placeholder="{{trans('labels.name')}} {{trans('labels.second_name')}}*" required>
                        <p class="text_error" id="name_danger"></p>
                    </label>
                    <label for="phone" class="name-label">
                        <input id="phone" name="phone" type="text" class="input-text"
                               placeholder="{{trans('labels.phone_number')}}*" required>
                        <p class="text_error" id="phone_danger"></p>
                    </label>
                    <label for="email" class="name-label">
                        <input id="email" name="email" type="text" class="input-text"
                               placeholder="{{trans('labels.email')}}*" required>
                        <p class="text_error" id="email_danger"></p>
                    </label>
                </div>

                <div class="row align-items-center gap-2 gap-md-0 my-0 mx-auto">
                    <p class="feedback_career_form-question">{{trans('labels.feedback_career_question')}}</p>
                    <div class="col-md-9 d-flex gap-3">
                        <label class="checkbox__item">
                            <input type="radio" name="vacancyNotification" value="1" class="checkbox__input">
                            <span class="fake"></span>
                            <span class="checkbox_text">{!! trans('labels.feedback_career_ratio1') !!}</span>
                        </label>
                        <label class="checkbox__item">
                            <input type="radio" name="newsNotification" value="1" class="checkbox__input">
                            <span class="fake"></span>
                            <span class="checkbox_text">{!! trans('labels.feedback_career_ratio2') !!}</span>
                        </label>
                        <label class="checkbox__item">
                            <input type="radio" name="newsNotification" value="1" class="checkbox__input">
                            <span class="fake"></span>
                            <span class="checkbox_text">{!! trans('labels.feedback_career_ratio3') !!}</span>
                        </label>
                    </div>
                    <button type="button" onclick="submitFeedbackCareerForm()"
                            class="col-md-3 feedback_career_form-btn custom-btn">{!! trans('labels.send') !!}</button>
                </div>
            </div>

        </div>
    </div>
</div>


@push('script')
    <script>

        const routeName = '{!! $name !!}';


            let pusher = null;



        // Pusher.logToConsole = true;


        $("#feedback_phone").on("change keyup paste", function () {
            var output;
            var input = $("#feedback_phone").val();
            input = input.replace(/[^0-9]/g, '');
            var area = input.substr(0, 3);
            var pre = input.substr(3, 3);
            var tel = input.substr(6, 5);

            if (area.length < 3) {
                output = "(+" + area;
            } else if (area.length == 3 && pre.length < 3) {
                output = "(+" + area + ")" + " " + pre;
            } else if (area.length == 3 && pre.length == 3) {
                output = "(+" + area + ")" + " " + pre + "-" + tel;
            }
            $("#feedback_phone").val(output);
        });

        function closeBlock(event) {
            console.log('event', event.target.id)
            if (event.target.id !== "feedback_call_form" && event.target.id !== 'feedback_call_icon') {
                document.querySelector('.feedback_call_form').style.display = 'none';
                window.removeEventListener('click', closeBlock)
            }
        }


        function callHandler() {

            if (window.innerWidth >= 450) {
                document.querySelector('.feedback_call_form').classList.toggle('active');
                document.querySelector('.feedback_call_container').classList.toggle('active');


                const messageForm = document.querySelector('.feedback_message_form.active')

                if (messageForm) {
                    messageForm.classList.toggle('active')
                    document.getElementById('feedbackMessage').classList.toggle('active')

                }
                if (routeName === 'client.careers') {
                    const messageCareerForm = document.querySelector('.feedback_career_form.active')

                    if (messageCareerForm) {
                        messageCareerForm.classList.toggle('active')
                        document.getElementById('feedbackMessage').classList.toggle('active')

                    }
                }

                let inputAll = document.querySelectorAll('.feedback_input');

                for (let inputOne of inputAll) {
                    inputOne.addEventListener('focusin', (el) => {
                        // el.target.id = el.target.name
                        if (el.target.placeholder != "") {
                            el.target.insertAdjacentHTML('beforebegin', `
                            <div class="input_placeholder" >${el.target.placeholder}</div>
                        `)
                        }
                        el.target.placeholder = ""
                    })

                }
            } else {
                window.location = 'tel: +37322944955'
            }

        }

        function messageHandler() {
            document.getElementById('feedbackMessage').classList.toggle('active')
            if(document.querySelector('.feedback_message_form.active') && pusher ) {
                pusher.unsubscribe('answer')
            }
            if (routeName === 'client.careers') {
                document.getElementById('feedbackCareerForm').classList.toggle('active')
            } else {
                document.querySelector('.feedback_message_form').classList.toggle('active');

            }

            const callForm = document.querySelector('.feedback_call_form.active')
            if (callForm) {
                callForm.classList.toggle('active')
                document.getElementById('feedbackCall').classList.toggle('active')
            }

            document.querySelector('.header').style.zIndex = '11'
        }

        function closeCareerForm() {
            document.getElementById('feedbackCareerForm').classList.remove('active')
            document.getElementById('feedbackMessage').classList.remove('active')
            document.querySelector('.header').style.zIndex = '55'
        }

        function handleFeedbackSubmit() {
            const name = document.getElementById('feedback_name');
            const nameDanger = document.getElementById('feedback_name_danger');
            const phone = document.getElementById('feedback_phone');
            const phoneDanger = document.getElementById('feedback_phone_danger');


            function checkInputField(input, dangerElement, dangerText) {
                if (input.value === '') {
                    input.style.borderColor = '#f63c3c';
                    dangerElement.style.display = 'block';
                    dangerElement.textContent = dangerText;
                } else {
                    if (dangerElement.textContent !== '') {
                        input.style.borderColor = '#1f1f1f';
                        dangerElement.style.display = 'none';
                    }
                }
            }

            checkInputField(name, nameDanger, '{{trans('labels.form_name_error')}}')

            checkInputField(phone, phoneDanger, '{{trans('labels.form_phone_error')}}')


            if (name.value !== '' && phone.value !== '') {
                document.getElementById('feedback_call_action').submit();
            }

        }

        function chooseIndustry(industryId, color) {

            const messages = localStorage.getItem('VitraUserMessages')
            let messagesParsed = [];
            if (messages) {
                messagesParsed = JSON.parse(messages)
                messagesParsed = messagesParsed.filter(item => item['industry_id'] === industryId)
            }


            // Pusher.logToConsole = true;
            pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});

            const channel = pusher.subscribe('answer');

            const existingUserId = localStorage.getItem('VitraUserId')


            //Receive messages
            channel.bind('chat', function (data) {
                console.log('data', data)
                if (data.userId === existingUserId && data.industryId === industryId) {
                    console.log('yes')
                    $('.feedback_chat_block').append('<div class="feedback_chat_block_first">' + data.message + '</div>');
                    // const messages = localStorage.getItem('VitraUserMessages')

                    if (messages) {
                        const messagesAll = JSON.parse(messages);
                        messagesAll.push({'industry_id': industryId, 'type': 'answer', 'message': data.message})
                        localStorage.setItem('VitraUserMessages', JSON.stringify(messagesAll))
                    }

                }

            });


            document.getElementById('feedbackMessageForm').innerHTML = `
                <div class="feedback_message_form_top" style="background-color: #fff; border-bottom: 2px ${color} solid">
            <div class="d-flex align-items-center">
                <svg onclick="goBack()" width="25px" height="25px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" stroke="#ee2a26" style="transform: rotate(-90deg); cursor: pointer" >
                    <defs>
                        <style>.cls-1{fill:none;stroke:${color};stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
                    </defs>
                    <g id="chevron-top">
                        <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5" style="stroke: ${color};"></line>
                        <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" style="stroke: ${color};"></line>
                    </g>
                </svg>
                <div class="logo_container">
                    <img loading="lazy" src="/images/svg/i.svg" alt="Logo">
                </div>

                <p class="feedback_message_form_title" style="color:${color} ">Hai să discutăm</p>
            </div>

            <div class="feedback_message_form_close" onclick="messageHandler(1)">
                <svg  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="25" height="25" fill="${color}"  viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                <g><g><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052
                            L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116
                            c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                </g></g>
                </svg>
            </div>
        </div>
        <div class="feedback_chat_container">
            <div class="feedback_chat_block">
                <div class="feedback_chat_block_first">
                    <p>Te salută Vitra!</p>
                    <p>Cu ce te putem ajuta?</p>
                </div>
            ${messagesParsed.map(item => {
                if (item['type'] === 'send') {
                    return `<div class="d-flex justify-content-end"><div class="feedback_chat_block_second" style="background-color: ${color}">${item.message}</div></div>`
                } else return `<div class="feedback_chat_block_first">${item.message}</div>`

            }).join('')}

            </div>
            <div class="feedback_message_block">
                <textarea class="feedback_message_block_input" name="message" onkeydown="pressEnter(event, ${industryId})" placeholder="Tastează mesagul tău aici..."  type="text"></textarea>
                <div class="feedback_message_block_btn" onclick="sendMessage(${industryId})" >
                    <img loading="lazy" class="feedback_message_block_icon" src="/images/communication.png" alt="Send icon">
                </div>
            </div>
        </div>
            `
        }

        // Pusher.logToConsole = true;

        function sendMessage(industryId) {
            let input = document.querySelector('.feedback_message_block_input')
            let button = document.querySelector('.feedback_message_block_btn')

            const secondBlockContainer = document.createElement('div')
            secondBlockContainer.style.display = 'flex'
            secondBlockContainer.style.justifyContent = 'flex-end'
            let color = ''
            if (parseInt(industryId) === 1) {
                color = '#f37878';
            } else if (parseInt(industryId) === 2) {
                color = '#8cd1ef';
            } else if (parseInt(industryId) === 3) {
                color = '#5156a1';
            } else if (parseInt(industryId) === 4) {
                color = '#57bf76';
            }

            const message = input.value;
            if (message === '') {
                return;
            }
            button.style.pointerEvents = 'none'

            console.log('message', message)

            secondBlockContainer.innerHTML = `
            <div class="feedback_chat_block_second" style="background-color: ${color}">${input.value}</div>
            `
            document.querySelector('.feedback_chat_block').append(secondBlockContainer)

            function makeid(length) {
                let result = '';
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                const charactersLength = characters.length;
                let counter = 0;
                while (counter < length) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    counter += 1;
                }
                return result;
            }

            let userId = '';
            const existingUserId = localStorage.getItem('VitraUserId')
            const existingMessages = localStorage.getItem('VitraUserMessages')
            if (existingUserId) {
                userId = existingUserId;
                const messages = JSON.parse(existingMessages)
                messages.push({'industry_id': industryId, 'type': 'send', 'message': message})
                localStorage.setItem('VitraUserMessages', JSON.stringify(messages))

            } else {
                userId = makeid(8)
                localStorage.setItem('VitraUserId', userId)
                const messages = [{'industry_id': industryId, 'type': 'send', 'message': message}]
                localStorage.setItem('VitraUserMessages', JSON.stringify(messages))
            }


            // document.getElementById('feedbackSubmitForm').submit();

            const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});
            $.ajax({
                url: "/send-message",
                method: 'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: {
                    _token: '{{csrf_token()}}',
                    userId,
                    industryId,
                    message,
                }
            }).done(function (res) {
                console.log(res)
                button.style.pointerEvents = 'all'
                input.value = ''
            });

        }

        function pressEnter(event, industryId) {
            if (event.key === "Enter") {
                event.preventDefault();
                sendMessage(industryId)
            }
        }

        function goBack() {

            const industries = {!! $industries !!};
            const title = "{!!trans('labels.request_message')  !!}";
            const description = '{{trans('labels.request_message_description')}}';
            document.getElementById('feedbackMessageForm').innerHTML = `
              <div class="feedback_message_form_top">
            <p class="feedback_message_form_title">${title}</p>
            <div class="feedback_message_form_close" onclick="messageHandler()">
                <svg  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="25" height="25" fill="#fff"  viewBox="0 0 492 492" style="enable-background:new 0 0 492 492;" xml:space="preserve">
                <g><g><path d="M300.188,246L484.14,62.04c5.06-5.064,7.852-11.82,7.86-19.024c0-7.208-2.792-13.972-7.86-19.028L468.02,7.872 c-5.068-5.076-11.824-7.856-19.036-7.856c-7.2,0-13.956,2.78-19.024,7.856L246.008,191.82L62.048,7.872 c-5.06-5.076-11.82-7.856-19.028-7.856c-7.2,0-13.96,2.78-19.02,7.856L7.872,23.988c-10.496,10.496-10.496,27.568,0,38.052
                            L191.828,246L7.872,429.952c-5.064,5.072-7.852,11.828-7.852,19.032c0,7.204,2.788,13.96,7.852,19.028l16.124,16.116 c5.06,5.072,11.824,7.856,19.02,7.856c7.208,0,13.968-2.784,19.028-7.856l183.96-183.952l183.952,183.952 c5.068,5.072,11.824,7.856,19.024,7.856h0.008c7.204,0,13.96-2.784,19.028-7.856l16.12-16.116
                            c5.06-5.064,7.852-11.824,7.852-19.028c0-7.204-2.792-13.96-7.852-19.028L300.188,246z"/>
                </g></g>
                </svg>
            </div>
        </div>
        <div class="feedback_message_form_bottom">
            <p class="feedback_message_form_description">${description}</p>
            <div class="feedback_message_industry">
            ${industries.map(item => {
                return `   <button class="feedback_message_industry_block" onclick="chooseIndustry(${item['id']},'${item['color']}')">
                      ${item['name']}
                </button>`
            }).join('')}
            </div>
        </div>
            `
        }


        function submitFeedbackCareerForm() {

        }
    </script>
@endpush
