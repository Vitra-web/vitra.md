@extends('layouts.client')

@section('content')
<main>

    <section class="mainindustry-section">
        <div class=" main_slider_block" style="background-image: url({{url('storage/'.$page->image)}});">
            <h1 class="mainindustry-section__title text-uppercase">{{$title}}</h1>
        </div>
    </section>
    @include('client.components.breadСrumbs')



    <section class="custom-container">

       <div class="page-content">
           {!! $language->replace($page->description_ro, $page->description_ru,$page->description_en ) !!}
       </div>


    </section>


</main>

@endsection

@push('script')

    <script>

    </script>
@endpush

@section('after_styles')
    <style>
        .page-content {
            padding-top: 50px;
            padding-bottom: 50px
        }
        .page-content ul {
            padding-left: 15px;
            margin-bottom: 15px;
        }
        .page-content ul li {
            list-style-type: initial;
            /*margin-bottom: 10px;*/
        }
        .page-content li {
            margin-bottom: 10px;
        }
        .page-content p {
            margin-bottom: 10px;
        }
        .page-content h4 {
            font-size: 1.17em;
            margin-bottom: .7rem;
            font-weight: bold;
            line-height: 1.2;
        }
        .page-content h3 {
            font-size: 1.5rem;
            margin-bottom: .7rem;
            line-height: 1.3;
        }
        .page-content table {
            border-collapse: collapse;
            border: 1px #000 solid;
            width: 100%;
            max-width: 1100px;
            background-color: rgba(217, 217, 217, 0.3);
        }
        .page-content table thead {
            border: 1px #000 solid;
        }
        .page-content table thead th {
            padding: 15px 40px;
            background-color: rgba(217, 217, 217, 0.3);
            font-size: 20px;
            font-family: 'GalanoGrotesque-SemiBold', sans-serif;

        }
        .page-content table tbody td {
            padding: 15px 40px;
            background-color: rgba(217, 217, 217, 0.3);
            font-size: 15px;
        }
    </style>
@endsection
