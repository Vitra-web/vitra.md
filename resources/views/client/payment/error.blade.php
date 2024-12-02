@extends('layouts.client2')



@section('content')

<main style="padding-top: 120px">



    @include('client.components.breadСrumbs')



    <section class="custom-container success_section">

        <div class="image_second_container error_image">

            <div class="image_container error_image">

                <img src="{{url('/images/product/closered.png')}}" alt="" class="error_img">



            </div>

        </div>

        <h2 class="success_title">{{trans('labels.payment_error_title')}}</h2>

        <p class="success_text">{{trans('labels.payment_error_description')}}</p>



        <div class="d-flex justify-content-center">

            <a href="/basket" class="custom-btn">{{trans('labels.payment_basket_back')}}</a>

        </div>

    </section>







</main>



@endsection



@push('script')



    <script>



    </script>

@endpush

