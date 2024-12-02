<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}} ">
       <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/login.min.css')}}">
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/login.css') }}">--}}
    <style>
        {!! Vite::content('resources/sass/style.scss') !!}
    </style>
</head>
<body>

<a href="/" class="login-logo">
    <svg width="20" height="20" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" id="selectArrow">
        <defs>
            <style>.cls-1{fill:none;stroke:#cdcbcb;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
        </defs>
        <title></title>
        <g id="chevron-top">
            <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5" style="stroke: rgb(0, 0, 0);"></line>
            <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" style="stroke: rgb(0, 0, 0);"></line>
        </g>
    </svg>
    <img class="login_img" src="{{url('images/logo-black.png')}}" alt="Vitra">
</a>

<div class="login_page_container">
    @yield('content')
</div>



<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.js')}}"></script>
@stack('script')
</body>
</html>
