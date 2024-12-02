@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
{{--                <div class="mb-3">--}}
{{--                    <a href="{{route('news')}}" class="btn btn-secondary" >--}}
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
                    <form action="{{route('news.storeCategory')}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf


                        @include("panel.components.forms.name",["title" => "Numele categoriei", "placeholder" => "Numele categoriei", "valueRo" => old('name_ro'), "valueRu" => old('name_ru'), "valueEn" => old('name_en')])



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
