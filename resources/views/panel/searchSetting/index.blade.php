@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">


            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 d-flex">
                    <a href="{{route('searchSettings.createProductType')}}" class="btn btn-outline-primary mr-5 px-3 ">
                        <i class="fas fa-plus-circle"></i>
                    </a>

                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover text-nowrap" >
                        <thead>
                        <tr>
                            <th>Ordinea</th>
                            <th>Numele</th>
                            <th>Produse</th>
                            <th>Valoare</th>
                            <th>Acțiune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productTypes as $productType)
                        <tr >
                            <td>
                                {{$productType->sort_order}}
                            </td>
                            <td>
                                {{$productType->name}}
                            </td>
                            <td>
                                {{$productType->productName}}
                            </td>

                            <td> {{$productType->value_ro}}</td>
                            <td class="d-flex">

                                <div class="mr-2">
                                    <a href="{{route('searchSettings.editProductType', $productType->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

                                <form action="{{route('searchSettings.delete', $productType->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
                                    @csrf
                                    @method(('delete'))
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="separate_line"></div>
            <div class="  ">
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <h2 class="m-0">{{$title2}}</h2>
                    </div><!-- /.col -->
                    <div class="col-sm-6 d-flex">
                        <a href="{{route('searchSettings.createCategoryType')}}" class="btn btn-outline-primary mr-5 px-3 ">
                            <i class="fas fa-plus-circle"></i>
                        </a>

                    </div>
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover text-nowrap" >
                            <thead>
                            <tr>
                                <th>Ordinea</th>
                                <th>Numele</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Acțiune</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categoryTypes as $categoryType)
                                <tr >
                                    <td>
                                        {{$categoryType->sort_order}}
                                    </td>
                                    <td>
                                        {{$categoryType->name}}
                                    </td>
                                    <td>
                                        {{$categoryType->categoryName}}
                                    </td>

                                    <td> {{$categoryType->subcategoryName}}</td>
                                    <td class="d-flex">

                                        <div class="mr-2">
                                            <a href="{{route('searchSettings.editCategoryType', $categoryType->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>

                                        <form action="{{route('searchSettings.delete', $categoryType->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
                                            @csrf
                                            @method(('delete'))
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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

@section('after_styles')
    <style>

  .separate_line {
      margin-top:20px;
      margin-bottom: 20px;
      width: 100%;
      height: 2px;
      background-color: #848282;
  }
    </style>
@endsection
