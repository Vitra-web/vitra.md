@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('industry.edit', $industry->id)}}" class="btn btn-secondary" >
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
                    <form action="{{route('industry.updateCategoryProducts', $industryCategory->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input name="industry_id" value="{{$industry->id}}" type="hidden">
                        <div class="form_block row mb-3 ">
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="category_id">{{trans('panel.category')}}</label>
                                <select class="custom-select form-control" id="category_id" name="industry_category_id" >
                                    @foreach($industryCategories as $item)
                                        <option {{$industryCategory->id == $item->id ? 'selected' : ''}}  value="{{$item->id}}" >{{$item->name_ro}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-sm-6">
                                <label for="products">{{trans('panel.products')}}</label>
                                <select class="custom-select select2 form-control" id="products" multiple="multiple" name="products[]" >
                                    @foreach($products as $item)
                                        <option {{isset($item['selected']) ? 'selected' : '' }} value="{{$item->id}}" >{{$item->name_ro}}</option>
                                    @endforeach
                                </select>
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
