@php
    $user = \Illuminate\Support\Facades\Auth::user();
 if(isset($user)) {
     $userId = $user->id;
 } else {
     $userId = '';
 }
 @endphp

<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{isset($title)? $title : 'Vitra' }}</title>

    <!-- Google Font: Source Sans Pro -->
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">--}}
<!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}} ">
{{--    <link rel="stylesheet" href="{{asset('fontawesome-free-5.10/css/all.min.css')}} ">--}}
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('fancybox/fancybox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/notification.css') }}">


{{--    @if($routeName != 'client.services' && $routeName != 'client.terms' && $routeName != 'client.delivery' && $routeName != 'client.policy')--}}
{{--        <link rel="stylesheet" type="text/css" href="{{ asset('css/client/reset.css') }}">--}}
{{--    @endif--}}
    <style>
        {!! Vite::content('resources/sass/style.scss') !!}
    </style>

{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.0/build/css/intlTelInput.css">--}}

    @yield('after_styles')
    {{--    <link rel="stylesheet" href="../../css/app.css">--}}

</head>


<body class="main__body">

@include('client.components.header')

<main>
    <div id="main" class="wrapper">

{{--<div class="wrapper">--}}

    @yield('content')


        @include('client.components.footer')

        @include('client.components.scrollToTop')

        @include('client.components.feedbackBlock')

        @include('client.components.modals.consultationModal')

        @if(Route::currentRouteName() == 'home')
    </div>
    @endif



    </div>
</main>
@include('client.components.modals.downloadPdfModal')
@include('client.components.modals.beforeDownloadPdfModal')


<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="{{asset('js/library/jquery-cookie/jquery.cookie.js')}}"></script>
{{--<script src="{{asset('fontawesome-free-5.10/js/all.min.js')}}"></script>--}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('fancybox/fancybox.umd.js')}}"></script>

@vite(['resources/js/app.js'])
<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/header.js')}}"></script>
<script src="{{asset('js/swipers.js')}}"></script>
{{--<script src="{{asset('js/main.js')}}"></script>--}}
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

{{-- ------------   lazy load    -----------------}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- ------------   intlTel    -----------------}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />


<script src="{{ asset('js/share.js') }}"></script>
<script src="{{ asset('js/userPath.js') }}"></script>

{{----------  Google analitics   -------------}}
<script async src="https://www.googletagmanager.com/gtag/js?id={{env('GOOGLE_ANALYTICS_KEY')}}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{env('GOOGLE_ANALYTICS_KEY')}}');
</script>

<script>
    @if(Session::has('success'))
    showToast("{!! session('success') !!}" , "success",4000);
    @elseif(Session::has('error'))
    showToast("{!! session('error') !!}" , "danger",4000);
    @endif

    $(document).ready(function() {
            $('img').lazyload();

        const userId = '{{$userId}}';
        let quantity = null;
        if(userId) {
            quantity = '{{$basketProducts}}';
        } else {
            const productsLocale = $.cookie('vitraProducts')
            if(productsLocale) {
                quantity = JSON.parse(productsLocale).length
            }
        }

        if(quantity && quantity >0) {
            const headerCartCount = document.createElement('div')
            headerCartCount.classList.add('header_cart_count')
            headerCartCount.id = 'cartCount'
            headerCartCount.innerHTML=quantity;
            document.querySelector('.header__wishlist-cart').append(headerCartCount)
        }
    })



</script>




@stack('script')
</body>
</html>
