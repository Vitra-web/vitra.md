@extends('layouts.login')

@section('content')

    <div class="login-box h-25">
    {{--    <div class="login-logo">--}}
    {{--        <a href=""><b>Admin</b>Panel</a>--}}
    {{--    </div>--}}
    <!-- /.login-logo -->
        <div class="card">
            @if(Session::has('message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{!! session('message_success') !!}</strong>
                </div>
            @endif
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{trans('panel.login_title')}}</p>

                <form action="{{route('postLogin')}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <div class="input-group ">
                            <input type="text" name="login" class="form-control" placeholder="{{trans('panel.login')}}">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @error('login')<p class="text-danger"> {{$message}}</p>@enderror
                    </div>

                    <div class="mb-5">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="{{trans('labels.password')}}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')<p class="text-danger"> {{$message}}</p>@enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-block"> {{trans('panel.enter')}}</button>
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection


