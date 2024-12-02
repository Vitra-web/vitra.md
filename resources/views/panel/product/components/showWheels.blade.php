@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('product.components')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <h1 class="m-0">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6 d-flex">
                        <a href="{{route('product.wheelCreate')}}" class="btn btn-outline-primary mr-5 px-3 ">
                            <i class="fas fa-plus-circle"></i>
                        </a>

                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover text-nowrap" >
                            <thead>
                            <tr>
                                <th>Ordinea</th>
                                <th>Image</th>
                                <th>Numele</th>
                                <th>Acțiune</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wheels as $item)
                                <tr >
                                    <td> {{$item->sort_order}}</td>
                                    <td>
                                        <img src="{{url('storage/'.$item->image)}}" alt="Product image" width="50px">
                                    </td>
                                    <td> {{$item->name_ro}}</td>


                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <a href="{{route('product.wheelEdit', $item->id)}}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <form action="{{route('product.wheelDelete', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
                                                @csrf
                                                @method(('delete'))
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>





                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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
