@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
{{--                <div class="mb-3">--}}
{{--                    <a href="{{route('slider')}}" class="btn btn-secondary" >--}}
{{--                        <i class="fas fa-backward mr-2"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
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
                    <form action="{{route('slider.storeCategory')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf



                        <div class="form_block row mb-3 ">
                            <h4 class="mb-3">Numele categoriei</h4>
                            <div class="d-flex form-group col-sm-4">
                                <label for="">
                                    <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
                                 </label>
                                <input type="text" class="form-control ml-2" name="name_ro"   placeholder="Numele categoriei Ro" value="{{old('name_ro')}}">
                                @error('name_ro')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                            <div class="d-flex form-group col-sm-4">
                                <label for="">
                                    <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">

                                </label>
                                <input type="text" class="form-control ml-2" name="name_ru" placeholder="Numele categoriei Ru" value="{{old('name_ru')}}">
                                @error('name_ru')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>

                            <div class="d-flex form-group col-sm-4">
                                <label for="">
                                    <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">

                                </label>
                                <input type="text" class="form-control ml-2" name="name_en" placeholder="Numele categoriei En" value="{{old('name_en')}}">
                                @error('name_en')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>
                        </div>


                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Save">
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
