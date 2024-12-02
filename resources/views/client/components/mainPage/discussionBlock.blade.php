<div class="custom-container">


        <form action="{{route('client.contactMail')}}" method="post" class="discussion-form row">

            <div class="col-lg-6 row discussion-form_left">
                <div class="col-6 col-md-6 p-0">
                    <h2 class="discussion-form__title">{{trans('labels.discussion_title')}}</h2>
                </div>
                <div class="col-6 col-md-6 p-0 discussion-form-image_container">
                    <img class="discussion-form-image" src="{{url('/images/forms/main_page.jpg')}}" alt="Vitra">
                </div>
            </div>


            <div class="discussion-form_right col-lg-6 ">
                <p class="discussion_title_right">{{trans('labels.discussion_title_right')}}</p>

                <div class="discussion-form_action">
                    <div class="discussion-form_input-block">
                        <label for="name" class="discussion-name-label">
                            <input id="name" name="name" type="text" class="discussion-input-text" value="{{old('name')}}"  placeholder="{{trans('labels.name').', '.trans('labels.second_name')}}*">
                            <p class="text_error" id="name_danger"></p>
                            @error('name')<p class="text-danger" > {{$message}}</p>@enderror
                        </label>

                        <label for="email" class="discussion-name-label">
                            <input id="email" name="email" type="email" class="discussion-input-text"  value="{{old('email')}}" placeholder="{{trans('labels.email')}}*">
                            <p class="text_error" id="email_danger"></p>
                            @error('email')<p class="text-danger"> {{$message}}</p>@enderror
                        </label>

                        <label for="phone" class="discussion-name-label">
                            <input id="phone" name="phone" type="tel" class="discussion-input-text"  value="{{old('phone')}}" >
                            <p class="text_error" id="phone_danger"></p>
                            @error('phone')<p class="text-danger"> {{$message}}</p>@enderror
                        </label>
                    </div>

                    <div class="discussion-form_button-section ">
                        <div>
                            <label class="checkbox__item mb-2">
                                <input type="checkbox"  value="1" class="checkbox__input" id="notificationsCheckbox">
                                <span class="fake"></span>
                                <span class="checkbox_text">{{trans('labels.discussion_checkbox')}}</span>
                            </label>
                            <div>
                                <label class="checkbox__item">
                                    <input type="checkbox" value="1" class="checkbox__input" id="discussionBlockCheckbox">
                                    <span class="fake"></span>
                                    <span class="checkbox_text">{{trans('labels.accept_policy')}} <a href="{{route('client.terms')}}" target="_blank" class="checkbox_link">{{trans('nav.terms')}}</a></span>
                                </label>
                                <p class="text_error" id="policy_danger"></p>
                            </div>
                        </div>

                        <button type="button" onclick="handleSubmit()" class="custom-btn discussion-btn">{{trans('labels.send')}}</button>
                    </div>
                </div>




{{--                <button class="custom-btn discussion-form__action-btn" onclick="handleSubmit()" type="button">{{trans('labels.send_message')}}</button>--}}
            </div>



        </form>


</div>

@push('script')
    <script>

        let discussionInputAll = document.querySelectorAll('.discussion-input-text');
        let itiDiscussion = null;

        $(document).ready(function() {
            itiDiscussion =  phoneCountryHandler('#phone')
        });

        for (let inputOne of discussionInputAll) {

            inputOne.addEventListener('focusin', (el)=>{
                // el.target.id = el.target.name
                if (el.target.placeholder !== "" && el.target.type !=='tel') {
                    el.target.insertAdjacentHTML('beforebegin', `
                            <div class="input_placeholder">${el.target.placeholder}</div>
                        `)
                }
                el.target.placeholder = ""
            })

        }


        function handleSubmit() {
            const name =document.getElementById('name');
            const nameDanger =document.getElementById('name_danger');
            // const surname =document.getElementById('surname');
            // const surnameDanger =document.getElementById('surname_danger');
            const email =document.getElementById('email');
            const emailDanger =document.getElementById('email_danger');
            const phone =document.getElementById('phone');
            const phoneDanger =document.getElementById('phone_danger');
            const policyDanger = document.getElementById('policy_danger');




            checkInputField(name,nameDanger, '{{trans('labels.form_name_error')}}')
            {{--checkInputField(surname,surnameDanger, '{{trans('labels.form_surname_error')}}')--}}
            checkInputField(email,emailDanger, '{{trans('labels.form_email_error')}}')
            checkInputField(phone,phoneDanger, '{{trans('labels.form_phone_error')}}')
            {{--checkInputField(type,typeDanger, '{{trans('labels.form_type_error')}}')--}}




            const checkboxChecked = document.getElementById('discussionBlockCheckbox').checked
            const notificationsChecked = document.getElementById('notificationsCheckbox').checked

            if(!checkboxChecked) {
                policyDanger.style.display = 'block';
                policyDanger.textContent= '{{trans('labels.form_policy_error')}}';
            }

            console.log(phone.value)
            if(name.value !== '' && email.value !== ''  && email.value.includes('@') && phone.value !== '' && checkboxChecked) {

                const data = {
                    'name': name.value,
                    'email': email.value,
                    'phone': itiDiscussion.getNumber(),
                    'newsNotification':notificationsChecked ?  1 : false,
                }
                console.log(data)
                $.ajax({
                    url:     "/main-page-consultation",
                    method:  'POST',
                    data: data,

                }).done(function (res) {
                    console.log(res)
                    if(res.status === 'ok') {
                        showToast('Datele au fost trimise', 'success')
                        name.value = '';
                        email.value = '';
                        phone.value = '';
                        policyDanger.style.display = 'none';
                    } else {
                        showToast('Datele n-au fost trimise', 'danger')
                    }
                });

                // document.querySelector('.discussion-form').submit();
            }

        }

    </script>

@endpush
