@extends('layouts.client2')

@section('content')
<main style="padding-top: 120px">

    @include('client.components.breadСrumbs')

    <section class="custom-container success_section">
        <div class="image_second_container success_image">
            <div class="image_container success_image">
                <img src="{{url('/images/product/check.png')}}" alt="" class="success_img">

            </div>
        </div>
        @if($order->paymentType ==1)
            <h2 class="success_title">{{trans('labels.payment_success_title1')}}</h2>
            <p class="success_text">{{trans('labels.payment_success_description1')}}</p>
        @else
            <h2 class="success_title">{{trans('labels.payment_success_title2')}}</h2>
            <p class="success_text">{{trans('labels.payment_success_description2')}}</p>
        @endif

        <div class="success_pay_details">
            <p class="pay_details_title">{{trans('labels.payment_details')}}</p>
            <div class="row pay_details_text">
                <div class="col-6">
                    <p>{{trans('labels.payment_sum')}}:</p>
                    <p>{{trans('labels.payment_date')}}:</p>
                    <p>{{trans('labels.payment_number')}}:</p>
                    <p>{{trans('labels.payment_type')}}:</p>
                    <p>{{trans('labels.payment_delivery')}}:</p>
                </div>
                <div class="col-6">
                    <p>{{$order->priceTotal}} MDL</p>
                    <p>{{$order->created_at}}</p>
                    <p>{{$order->order_number}}</p>
                    <p>{{$order->paymentName}}</p>
                    <p>{{$order->deliveryName}}</p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a href="/" class="custom-btn">{{trans('labels.payment_back')}}</a>
        </div>
    </section>



</main>

@endsection

@push('script')

    <script>
        $.cookie('vitraProducts', '');
    </script>
@endpush
