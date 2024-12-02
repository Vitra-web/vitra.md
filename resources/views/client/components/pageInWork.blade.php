@extends('layouts.client2')

@section('content')
    <main  style="margin-top:145px">

        <section class="d-flex flex-column align-items-center justify-content-center gap-3">
            <h2 class="text-center" style="font-weight: bold; font-size: 1.5rem">{!! trans('labels.under_development') !!}</h2>
            <img class="w-100" style="object-fit: contain; max-width: 300px" src="{{asset('images/resolve.svg')}}" alt="">
            <h2 class="text-center" style="font-weight: bold; font-size: 1.8rem">{{trans('labels.be_back')}}</h2>

        </section>

        <section class="custom-container" style="margin-top:120px">
            <div class="about-industry-container">
                <h2 class="about-descr__title">{{trans('labels.specialist_in')}}</h2>

                @include('client.components.industryBlock')
            </div>
        </section>

    </main>

@endsection
