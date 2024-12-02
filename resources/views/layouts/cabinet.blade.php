{{--@php--}}

{{--$user = \Illuminate\Support\Facades\Auth::user();--}}

{{--@endphp--}}


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
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('fancybox/fancybox.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

    <style>
        {!! Vite::content('resources/sass/style.scss') !!}
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/notification.css') }}">

    @yield('after_styles')
    {{--    <link rel="stylesheet" href="../../css/app.css">--}}

</head>


<body class="main__body">
@include('client.components.header2')

<main class="cabinet_section">
    <div class="custom-container " >
        @include('client.components.breadСrumbs')
        @include('client.cabinet.components.leftLabel')


        <div class="cabinet_content_container row">

            <div class="col-lg-2">
                @include('client.cabinet.components.sidebar')
            </div>
            <div class="col-lg-10 pt-3 cabinet_right_block">
                @yield('content')
            </div>


        </div>



    </div>



</main>




<!-- /.content-wrapper -->
@include('client.components.footer')

@include('client.components.scrollToTop')

@include('client.components.feedbackBlock')

@include('client.components.modals.downloadPdfModal')
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('fancybox/fancybox.umd.js')}}"></script>


@vite(['resources/js/app.js'])

<script src="{{asset('js/scripts.js')}}"></script>
<script src="{{asset('js/header.js')}}"></script>
<script src="{{asset('js/swipers.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>

{{-- ------------   intlTel    -----------------}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />

<script>
    @if(Session::has('success'))
    showToast("{!! session('success') !!}" , "success",5000);
    @endif
</script>





@stack('script')
</body>
</html>
