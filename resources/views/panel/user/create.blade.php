@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-2">
                    <a href="{{route('user')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
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
                    <form action="{{route('user.store')}}" method="post" class="w-100">
                        @csrf

                        <input type="hidden" class="form-control" name="created_by" value="{{\Illuminate\Support\Facades\Auth::id()}}" >

                        <div class="form_block row mb-4">
                            <div class="form-group col-sm-3">
                                <label class="form_label" for="exampleSelectBorder">{{trans('panel.status')}}</label>
                                <select class="custom-select form-control" name="status" id="exampleSelectBorder" >
                                    <option value="1" selected>{{trans('panel.status_active')}}</option>
                                    <option value="0">{{trans('panel.status_disabled')}}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label class="form_label" for="role" class="">{{trans('panel.role')}}</label>
                                <select class="custom-select form-control" name="role_id" id="role" >
                                    @foreach($roles as $role)
                                    <option value={{$role->id}} >{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                        </div>


                        <div class="form_block row  mb-4">
                            <h4 class="mb-3">{{trans('panel.personal_information')}}</h4>
                            <div class=" form-group col-sm-4">
                                <label class="form_label" for="name">{{trans('panel.name')}}</label>
                                <input type="text" class="form-control " name="name" id="name"  placeholder="{{trans('panel.name')}}" value="{{old('name')}}">
                                @error('name')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                            <div class=" form-group col-sm-4">
                                <label class="form_label" for="login">{{trans('panel.login')}}</label>
                                <input type="text" class="form-control " name="login" id="login" placeholder="{{trans('panel.login')}}" value="{{old('login')}}">
                                @error('login')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>

                            <div class="form-group col-sm-4">
                                <label class="form_label" for="password">{{trans('panel.password')}}</label>
                                <input type="password" class="form-control " name="password" id='password' placeholder="******" value="{{old('password')}}">
                                @error('password')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                            <div class=" form-group col-sm-4">
                                <label class="form_label" for="email">Email</label>
                                <input type="text" class="form-control " name="email" id="email" placeholder="Email" value="{{old('email')}}">
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
