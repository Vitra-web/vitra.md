@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

    <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li>
            <span><b>{{trans('panel.role')}}: </b></span>
            <span>{{$user->role->name}}</span>
        </li>

    </ul>

    <ul class="navbar-nav ml-auto " style="align-items:center">
{{--        <li class="nav-item  mr-4 d-flex align-items-center">--}}
{{--            <div class="chat_notification">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#8cd1ef" class="bi bi-chat" id="chat_notification_svg" viewBox="0 0 16 16">--}}
{{--                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>--}}
{{--                </svg>--}}
{{--                <div class="chat_notification_value">{{isset($newChats)? count($newChats) : 0}} </div>--}}
{{--            </div>--}}
{{--        </li>--}}


    <li class="nav-item dropdown ml-auto">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{$user->name}}
        </a>
        <ul class="dropdown-menu p-2 " id="header-dropdown">

            <li class="header_dropdown_item">
                <a href="{{route('user.edit', $user->id)}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span class="mr-2">{{trans('panel.my_profile')}}</span>
                </a>
            </li>
             <li class="p-3">
                 <div class="d-flex justify-content-center">
                    <a href="{{route('logout')}}" class="log_out_btn">
                        {{trans('panel.log_out')}}
    {{--                    <svg xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 512 512">--}}
    {{--                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->--}}
    {{--                        <path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/></svg>--}}
    {{--                    <span class="mr-2">{{trans('panel.exit')}}</span>--}}
                    </a>
                 </div>
            </li>

        </ul>
    </li>

        <li class="dropdown nav-item mr-5 ml-4">
            <button class="dropbtn-lang" onclick="document.querySelector('.dropdown-content').classList.toggle('active')">
                <img src="{{asset('images/language_black.svg')}}" alt="">
                <span class="dropbtn-lang-text text-black">{{ Config::get('languages')[App::getLocale()] }}</span>
            </button>
            <div class="dropdown-content">
                @foreach (Config::get('languages') as $lang => $language)
                    <a class="dropdown-link" href="{{ route('lang.switch', $lang) }}"> {{strtoupper($language)}}</a>
                @endforeach
            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
