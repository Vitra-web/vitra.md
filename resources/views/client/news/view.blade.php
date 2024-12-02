@extends('layouts.client')

@section('content')
    <main>
        <section class="mainindustry-section">
            <div class="main_slider_block " style="background-image: url({{url('storage/'.$item->image)}})">
{{--                <h1 class="mainindustry-section__title text-uppercase">{{$title}}</h1>--}}
            </div>
        </section>
{{--        @include('client.components.breadСrumbs')--}}

        <section class="custom-container news_container">
            <h2 class="news_title">{{$title}}</h2>
            <div>
                {!! $language->replace($item->description_ro, $item->description_ru,$item->description_en ) !!}
            </div>
        </section>



    </main>

@endsection

@section('after_styles')

    <style>
        .news_container {
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .news_title {
            font-size: 35px;
            text-align: center;
            margin-bottom: 25px;
        }
    </style>
@endsection
