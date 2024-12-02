@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('portfolio.categories')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$portfolioCategory->name_ro}}</h1>
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
                    <form action="{{route('portfolio.updateCategory', $portfolioCategory->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="form_block mb-3 row">
                            <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                                <label for="industry">Industrie</label>
                                <select class="custom-select select2 form-control" name="industry_id" id="industry" >
                                    @foreach($industries as $item)
                                        <option {{$portfolioCategory->industry_id == $item->id ? 'selected': ''}} value="{{$item->id}}" >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @include("panel.components.forms.name",["title" => "Numele categoriei", "placeholder" => "Numele categoriei", "valueRo" => $portfolioCategory->name_ro, "valueRu" => $portfolioCategory->name_ru, "valueEn" =>$portfolioCategory->name_en])



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
