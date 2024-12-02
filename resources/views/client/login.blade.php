@extends('layouts.login')

@section('content')

    <div class="login-box ">

    <!-- /.login-logo -->
        <div class="card">

            @if(Session::has('message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('message_success') !!}</strong>
                </div>
            @endif
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{trans('labels.login_form_title')}}</p>

                <form action="{{route('client.postLogin')}}" class="login-form__action" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <label for="email" class="login-label">
                            <input type="text" id="email" name="email" class="login-input" placeholder="E-mail">
                            @error('email')<p class="text-danger"> {{$message}}</p>@enderror
                            <p class="text_error" id="email_danger"></p>
                        </label>
{{--                        <div class="input-group-append">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <span class="fas fa-user"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="input-group mb-3">
                        <label for="password" class="login-label">
                        <input type="password" name="password" id="password" class="login-input" placeholder="{{trans('labels.password')}}">
                        @error('password')<p class="text-danger"> {{$message}}</p>@enderror
                        <p class="text_error" id="password_danger"></p>
                        </label>
{{--                        <div class="input-group-append">--}}
{{--                            <div class="input-group-text">--}}
{{--                                <span class="fas fa-lock"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>


{{--                    <div class="d-flex justify-content-center">--}}
                        <button type="button" onclick="handleSubmit()" class="connect_btn">{{trans('labels.login_btn')}}</button>
{{--                    </div>--}}
                    <div class="social_auth_block">
                        <p class="social_text">{{trans('labels.social_text')}}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('twitter.redirect') }}" type="button" class="social_btn">
                                <img class="social_img" src="/images/loginPage/twitter.png" alt="twitter">
                            </a>
                            <a href="{{ route('facebook.redirect') }}" type="button" class="social_btn">
                                <img class="social_img" src="/images/loginPage/facebook.png" alt="facebook">
                            </a>
                            <a href="{{ route('google.redirect') }}"  class="social_btn">
                                <img class="social_img" src="/images/loginPage/google.png" alt="google">
                            </a>
                            <a href="{{ route('linkedin.redirect') }}" type="button" class="social_btn">
                                <img class="social_img" src="/images/loginPage/linkedin.png" alt="linkedin">
                            </a>
                        </div>
                    </div>
                </form>

                <div class="d-flex align-items-center justify-content-center ">
                    <span>{{trans('labels.not_account')}}</span>
                    <a href="{{route('client.signup')}}" class="signup_btn ">{{trans('labels.signup_btn')}}</a>
                </div>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection


@push('script')
    <script>
        let contactInputAll = document.querySelectorAll('.login-input');

        for (let inputOne of contactInputAll) {

            inputOne.addEventListener('focusin', (el)=>{
                // el.target.id = el.target.name
                if (el.target.placeholder !== "") {
                    el.target.insertAdjacentHTML('beforebegin', `
                            <div class="input_placeholder">${el.target.placeholder}</div>
                        `)
                }
                el.target.placeholder = ""
            })

        }

        function handleSubmit() {
            const email = document.getElementById('email');
            const emailDanger = document.getElementById('email_danger');
            const password = document.getElementById('password');
            const passwordDanger = document.getElementById('password_danger');

            function checkInputField(input, dangerElement, dangerText ) {
                if(input.value === '') {
                    input.style.borderColor = '#f63c3c';
                    dangerElement.style.display = 'block';
                    dangerElement.textContent= dangerText;
                } else {
                    if(dangerElement.textContent !== '') {
                        input.style.borderColor = '#1f1f1f';
                        dangerElement.style.display = 'none';
                    }
                }

                if(input.type === 'email' && !input.value.includes('@')) {
                    input.style.borderColor = '#f63c3c';
                    dangerElement.style.display = 'block';
                    dangerElement.textContent= 'Enter a valid email';

                }
            }

            checkInputField(email,emailDanger, '{{trans('labels.form_email_error')}}')
            checkInputField(password,passwordDanger, '{{trans('labels.form_message_password')}}')

            if( email.value !== '' && email.value.includes('@') && password.value !== '') {
                document.querySelector('.login-form__action').submit();
            }
        }
    </script>
@endpush
