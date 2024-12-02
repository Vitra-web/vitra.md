<div class="custom-container">
    <h2 class="about-form__title">{{trans('labels.about_title')}}</h2>
        <form action="{{route('client.aboutMail')}}" method="post" class="about-form row" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="phone" id="aboutFormPhone">
           <div class="about-form-image_container col-md-4 col-lg-3 p-0">
               <img  class="about-form-image" src="{{url('/images/forms/about_page.jpg')}}" alt="About page">
           </div>
            <div class="about-form_center col-md-8 col-lg-6">
                  <div class="about-form_action">
                    <div class="about-form_input-block">
                        <label for="name" class="about-name-label">
                            <input id="name" name="name" type="text" class="about-input-text" value="{{old('name')}}"  placeholder="{{trans('labels.name').', '.trans('labels.second_name')}}*">
                            <p class="text_error" id="name_danger"></p>
                            @error('name')<p class="text-danger" > {{$message}}</p>@enderror
                        </label>

                        <label for="email" class="about-name-label">
                            <input id="email" name="email" type="email" class="about-input-text"  value="{{old('email')}}" placeholder="{{trans('labels.email')}}*">
                            <p class="text_error" id="email_danger"></p>
                            @error('email')<p class="text-danger"> {{$message}}</p>@enderror
                        </label>

                        <label for="phone" class="about-name-label">
                            <input id="phone" type="tel" class="about-input-text"  value="{{old('phone')}}" >
                            <p class="text_error" id="phone_danger"></p>
                            @error('phone')<p class="text-danger"> {{$message}}</p>@enderror
                        </label>
                    </div>
                    <div class="about-form_button-section ">

                        <label for="cv" class="about-name-label about-upload-label  position-relative">
                            <input name="file" type="file" id="docpicker" class="about-input-text about-input-upload transparent-color" placeholder="" accept=".pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <p class="fake-placeholder" id="cv-label">{{trans('labels.upload_cv')}}</p>
                            <p class="text_error" id="file_danger"></p>
                        </label>
                        <div class="checkbox_about_container">
                            <label class="checkbox__item ps-3">
                                <input type="checkbox"  value="1" class="checkbox__input" id="aboutCheckbox">
                                <span class="fake"></span>
                                <span class="checkbox_text">{{trans('labels.accept_policy')}} <a href="{{route('client.terms')}}" target="_blank" class="checkbox_link">{{trans('nav.terms')}}</a></span>
                            </label>
                            <p class="text_error" id="policy_about_danger"></p>
                        </div>
                        <button type="button" onclick="handleSubmit()" class="custom-btn about-btn" style="width: calc(33% -  10px);">{{trans('labels.send')}}</button>
                    </div>
                </div>
            </div>

            <div class="about-form_right col-md-12 col-lg-3">

                <p class="about-form_right_title">{{trans('labels.if_no_cv')}}  </p>

                <p> <a class="about-form_right_link" href="{{route('client.careers')}}" class="fw-bold text-decoration-underline">{{trans('labels.click_here')}}</a></p>

            </div>
        </form>
</div>

@push('script')

    <script>
        let aboutInputAll = document.querySelectorAll('.about-input-text');
        let itiAboutPhone = null;
        $(document).ready(function() {
            itiAboutPhone = phoneCountryHandler('#phone')
            const success = '{{ isset($success) ? true : '' }}';
            if(success) {
                showToast('Datele au fost trimise', 'success')
            }
        });

        for (let inputOne of aboutInputAll) {
            inputOne.addEventListener('focusin', (el)=>{
                // el.target.id = el.target.name
                if (el.target.placeholder !== "" && el.target.type !== 'tel') {
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
            const email =document.getElementById('email');
            const emailDanger =document.getElementById('email_danger');
            const phone =document.getElementById('phone');
            const phoneDanger =document.getElementById('phone_danger');
            const file =document.getElementById('docpicker');
            const fileDanger =document.getElementById('file_danger');
            const policyDanger =document.getElementById('policy_about_danger');

            function checkInputField(input, dangerElement, dangerText ) {
                if(input.type === 'email' && !input.value.includes('@')) {
                    input.style.borderColor = '#f63c3c';
                    dangerElement.style.display = 'block';
                    dangerElement.textContent= 'Enter a valid email';
                }
                if(input.value === '') {
                    input.style.borderColor = '#f63c3c';
                    dangerElement.style.display = 'block';
                    dangerElement.textContent= dangerText;
                } else {
                    if(dangerElement.textContent !== '') {
                        input.style.borderColor = '#1f1f1f';
                        dangerElement.style.display = 'none';
                    }
                    if(input.type === 'email' && !input.value.includes('@')) {
                        input.style.borderColor = '#f63c3c';
                        dangerElement.style.display = 'block';
                        dangerElement.textContent= 'Enter a valid email';
                    }
                }
            }

            checkInputField(name,nameDanger, '{{trans('labels.form_name_error')}}')
            {{--checkInputField(surname,surnameDanger, '{{trans('labels.form_surname_error')}}')--}}
            checkInputField(file,fileDanger, '{{trans('labels.form_file_error')}}')
            checkInputField(phone,phoneDanger, '{{trans('labels.form_phone_error')}}')
            {{--checkInputField(type,typeDanger, '{{trans('labels.form_type_error')}}')--}}
            let checkboxChecked = document.getElementById('aboutCheckbox').checked;

            if(!checkboxChecked) {
                policyDanger.style.display = 'block';
                policyDanger.textContent= '{{trans('labels.form_policy_error')}}';
            }

            if(name.value !== '' && file.value !== ''  && phone.value!== '' && checkboxChecked) {
                document.getElementById('aboutFormPhone').value = itiAboutPhone.getNumber()
                document.querySelector('.about-form').submit();
            }

        }

        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('docpicker');
            // const uploadInput = document.querySelector('.input-text-upload');
            if (fileInput) { // Check if the element exists before adding event listener
                fileInput.addEventListener('change', function() {
                    if (fileInput.files.length > 0) {
                        fileInput.classList.remove('transparent-color');
                        document.getElementById('cv-label').classList.add('transparent-color');
                    } else {
                        fileInput.classList.add('transparent-color');
                        document.getElementById('cv-label').classList.remove('transparent-color');
                    }
                });
            } else {
                console.error("Element with ID 'docpicker' not found");
            }
        });
    </script>
@endpush

