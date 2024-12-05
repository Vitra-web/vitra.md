@extends('layouts.admin')

@php
  $currentUser =  \Illuminate\Support\Facades\Auth::user();
@endphp
@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                @if($currentUser->role_id == 1 || $currentUser->role_id == 2 )
                <div class="mb-2">
                    <a href="{{route('user')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                @endif
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="form_container">
                    <form action="{{route('user.update', $user->id)}}" method="post" class="w-100">
                        @csrf
                        @method('patch')

                        @if($currentUser->role_id == 1 || $currentUser->role_id == 2 )
                        <div class="form_block row mb-4">
                            <div class="form-group col-sm-3">
                                <label class="form_label" for="exampleSelectBorder">{{trans('panel.status')}}</label>
                                <select class="custom-select form-control" name="status" id="exampleSelectBorder" >
                                    <option value="1" {{$user->status == 1 ? 'selected' : ''}}>{{trans('panel.status_active')}}</option>
                                    <option value="0" {{$user->status == 0 ? 'selected' : ''}}>{{trans('panel.status_disabled')}}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="form_label" for="role" class="">{{trans('panel.role')}}</label>
                                <select class="custom-select form-control" name="role_id" id="role" >
                                    @foreach($roles as $role)
                                    <option value={{$role->id}} {{$user->role_id == $role->id ? 'selected' : ''}} >{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                        </div>
                        @endif

                        <div class="form_block row  mb-4">
                            <h4 class="mb-3">{{trans('panel.personal_information')}}</h4>
                            <div class=" form-group col-sm-4">
                                <label class="form_label" for="name">{{trans('panel.name')}}</label>
                                <input type="text" class="form-control " name="name" id="name"  placeholder="Numele" value="{{$user->name}}">
                                @error('name')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                            <div class=" form-group col-sm-4">
                                <label class="form_label" for="login">{{trans('panel.login')}}</label>
                                <input type="text" class="form-control " name="login" id="login" placeholder="Login" value="{{$user->login}}">
                                @error('login')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>

                            <div class="form-group col-sm-4">
                                <label class="form_label" for="password">{{trans('panel.password')}}</label>
                                <input type="password" class="form-control" name="password" id='password' placeholder="******" value="">
                                @error('password')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                            <div class=" form-group col-sm-4">
                                <label class="form_label" for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{$user->email}}">
                                @error('email')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                        </div>



                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="{{trans('panel.save')}}">
                        </div>
                    </form>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        @endsection

        @push('script')
            <script>


            </script>
    @endpush
