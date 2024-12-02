@extends('layouts.client')
@php
if(isset($item->image_main)) {
    $imageLink = $item->image_main;
} else {
     $imageLink = $item->image_preview;
}
@endphp
@section('content')
    <main>


        <section class="mainindustry-section">
            <div class=" main_slider_block" style="background-image: url({{url('storage/'.$imageLink)}});">
                <h1 class=" text-uppercase mainindustry-section__title">{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</h1>
            </div>
        </section>


        @include('client.components.breadСrumbs')

        @if(isset($item->description_ro) && $item->description_ro !='<p>&nbsp;</p>')
        <section class="custom-container description_section pt-5 pb-5">
            {!! $language->replace($item->description_ro, $item->description_ru,$item->description_en) !!}
        </section>
        @endif

        <section class="custom-container pb-5 mt-4">


            <div class="portfolio_image_container row">
                @foreach($images as $image)
                    @if($image->type == 'image')
                        <div class=" col-lg-4 mb-4">
                            <a href="{{url('storage/'.$image->url)}}" data-fslightbox="gallery" >
                                <img id="image_main" src="{{url('storage/'.$image->url)}}"  alt="portfolio image" class="portfolio_image" >
                            </a>
                        </div>
                    @elseif($image->type == 'video')
                        <div class=" col-lg-4 mb-4">
                            <a href="{{url('storage/'.$image->url)}}" data-fslightbox="gallery" >
                                <video src="{{url('storage/'.$image->url)}}" controls width="400" height="300" class="portfolio_image"></video>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

        </section>

    </main>

@endsection

@push('script')
    <script src="{{asset('js/fslightbox.js')}}"></script>

@endpush
@section('after_styles')
    <style>
        .main_image_section {
            padding-top: 110px;

        }

        @media (max-width: 480px) {
            .main_image_section {
                padding-top: 140px;
                padding-bottom: 100px;
            }

        }
        .main_image_section h1 {
            position: relative;
            z-index: 2;
            color: #fff;
        }
        .main_image_section h1::after {
            content: '';
            position: absolute;
            z-index: -1;
            top: -80px;
            left: 0;
            width: 100%;
            height: 150px;

        }

        .main_image_block{
            position: relative;
            padding-top: 220px;
            padding-bottom: 160px;
            mix-blend-mode: hard-light;
            object-fit: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 50% 50%;
            font-family: GalanoGrotesque-Light, sans-serif;
            text-align: center;
            font-size: 90px;
            color: #fff;

        }
        .main_image_block::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            background-color: #000000ad;

        }
        .description_section {
            font-family: GalanoGrotesque-Light, sans-serif;
            font-size: 20px;
            line-height: 25px;
        }
        .portfolio_image {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        @media (min-width: 992px) {
            .portfolio_image {
                height: 425px;
            }
        }


    </style>
@endsection
