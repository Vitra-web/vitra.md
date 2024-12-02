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
                        <h1 class="m-0">{{$user->name}}</h1>
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


                        <div class="form_block row mb-4">
                            <div class="form-group col-sm-3">
                                <span>Status:</span>
                                <span class="fw-bold ml-3">{{$user->statusTitle}}</span>
                            </div>
                            <div class="form-group col-sm-3">
                                <span>Role:</span>
                                <span class="fw-bold ml-3">{{$user->role->name}}</span>

                            </div>
                        </div>


                        <div class="form_block row  mb-4">
                            <h4 class="mb-3">Personal information</h4>
                            <div class=" form-group col-sm-4">
                                <span>Numele:</span>
                                <span class="fw-bold ml-3">{{$user->name}}</span>

                            </div>
                            <div class=" form-group col-sm-4">
                                <span>Login:</span>
                                <span class="fw-bold ml-3">{{$user->login}}</span>

                            </div>


                            <div class=" form-group col-sm-4">
                                <span>Email:</span>
                                <span class="fw-bold ml-3">{{$user->email}}</span>

                            </div>
                        </div>



                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        @endsection

        @push('script')
            <script>


            </script>
    @endpush
