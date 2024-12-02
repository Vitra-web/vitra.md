@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('product.componentEdit', 2)}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="form_container">
                    <form action="{{route('product.colorStore')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{$component}}" name="component">

                        @include("panel.components.forms.name",["title" => "Numele culoarei", "placeholder" => "Numele culoarei", "valueRo" => old('name_ro'), "valueRu" => old('name_ru'), "valueEn" => old('name_en')])

                        <div class="form_block row mb-3 ">
                            <div class="form-group col-lg-3 col-sm-6">

                                <div class="d-flex">
                                    <label for="code">Code</label>
                                    <div class="color_box" id="color_box" ></div>
                                </div>
                                <input type="text" class="form-control" id="code" name="code" onfocusout="colorProductHandler(this)" placeholder="Codul culoarei" >
                                @error('code')<p class="text-danger"> {{$message}}</p>@enderror
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
                function colorProductHandler(el) {
                    document.querySelector('#color_box').style.backgroundColor = el.value
                }

            </script>
    @endpush
