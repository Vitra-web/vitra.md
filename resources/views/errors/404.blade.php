@extends('layouts.login')



@section('content')



    <div class="custom-container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5">
                <h2 class="error_title ">
                   404
                </h2>
                <div class="error_description">
                    <p >Ne pare rău, această pagină nu a fost găsită.</p>
                    <p>
                        Dar nu-ți face griji! Poți descoperi o mulțime de alte lucruri interesante pe <a class="text-blue" href="{{route('home')}}">pagina principală.</a>
                    </p>
                </div>

            </div>

        </div>


    </div>

    <!-- /.login-box -->

@endsection


{{--#bcd5e5--}}


@push('script')

    <script>



    </script>

@endpush

<style>
    .error_title {
        font-size: 80px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;

    }
    .error_description {
        font-size: 20px;
        text-align: center;
    }

    @media(max-width: 620px) {
        .error_title {
            font-size: 35px;
        }
        .error_description {
            font-size: 16px;

        }
    }
</style>

