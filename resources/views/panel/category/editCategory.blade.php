@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('category.categories')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$categoryIdea->name_ro}}</h1>
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
                    <form action="{{route('industry.updateCategory', $categoryIdea->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="form_block row mb-3">
                            <div class="form-group col-lg-3 col-sm-6" data-select2-id="1">
                                <label for="industry">{{trans('panel.industry')}}</label>
                                <select class="custom-select  form-control" name="industry_id" id="industry" >
                                    @foreach($industries as $item)
                                        <option {{$categoryIdea->industry_id == $item->id ? 'selected': ''}} value="{{$item->id}}" >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @include("panel.components.forms.name",["title" => trans('panel.category_name'), "placeholder" => trans('panel.category_name'), "valueRo" => $categoryIdea->name_ro, "valueRu" => $categoryIdea->name_ru, "valueEn" =>$categoryIdea->name_en])



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
