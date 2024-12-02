@extends('layouts.client')

@section('content')


        <section class="main-section">
            @include('client.components.mainPage.slider')
        </section>

        @include('client.components.mainPage.aboutBlock')
        @include('client.components.mainPage.categoryBlock')
        <div class="full_screen_block">
        @include('client.components.clientsBlock')
        @include('client.components.mainPage.discussionBlock')
{{--        @include('client.components.mainPage.bannerBlock')--}}
        </div>
        <div class="full_screen_block footer_block d-flex flex-column flex-nowrap">
        @include('client.components.mainPage.newsBlock')


{{--        @include('client.components.uploadBlock')--}}

{{--            @include('client.components.footer')--}}

{{--            @include('client.components.scrollToTop')--}}
{{--        </div>--}}
    <style>
        @media (min-width: 1500px) {
            main{
                width: 100%;
                height: 100vh;
                overflow: hidden;
            }

            .wrapper{
                height: 100%;
                width: 100%;
                transition: all 1.5s ease;
            }
        }


    </style>
@endsection

@push('script')

    <script src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/Draggable.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/ScrollToPlugin.min.js"></script>


    <script src="{{asset('js/main-page.js')}}"></script>
    <script src="{{asset('js/scrolling.js')}}"></script>
@endpush
