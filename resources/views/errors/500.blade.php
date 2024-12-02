@extends('layouts.login')



@section('content')



    <div class="custom-container ">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5">
                <h2 class="error_title ">
                    {{trans('labels.error_page_title')}}
                </h2>
                <p class="error_description ">{{trans('labels.error_page_description')}}</p>
            </div>
            <div class="col-lg-5">
                <img class="w-100" style="object-fit: contain; " src="{{asset('images/resolve.svg')}}" alt="we are working">
            </div>
        </div>

        @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->id == 1)
            @dump($exception)
            @endif
    </div>

    <!-- /.login-box -->

@endsection





@push('script')

    <script>




    </script>

@endpush



    <style>
       .error_title {
           font-size: 30px;
           font-weight: bold;
           margin-bottom: 30px;

       }
       .error_description {
           font-size: 16px;
       }
    </style>


