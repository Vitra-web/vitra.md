@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
{{--                <div class="col-sm-6 d-flex">--}}
{{--                    <a href="{{route('industry.create')}}" class="btn btn-outline-primary mr-5 px-3 ">--}}
{{--                        <i class="fas fa-plus-circle"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="col-sm-6 justify-content-end">
                    <a href="{{route('industry.categories')}}" class="btn btn-primary">{{trans('panel.category_products')}}</a>
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
                    <table class="table table-hover text-nowrap" id="crudTable">
                        <thead>
                        <tr>
                            <th>{{trans('panel.image')}}</th>
                            <th>{{trans('panel.name')}}</th>
                            <th>{{trans('panel.sort')}}</th>
                            <th>{{trans('panel.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($industries as $item)
                        <tr class="" >
                            <td>
                                <img src="{{url('storage/'.$item->image_preview)}}" alt="Industry image" width="50px">
                            </td>
                            <td> {{$item->name}}</td>
                            <td> {{$item->sort_order}}</td>


                            <td>
                                <div class="d-flex"  style="height: 100%">


{{--                                <div class="mr-2">--}}
{{--                                    <a href="{{route('industry.show', $item->id)}}" class="btn btn-sm btn-info">--}}
{{--                                        <i class="fas fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <div class="mr-2">
                                    <a href="{{route('industry.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

{{--                                <form action="{{route('industry.delete', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">--}}
{{--                                    @csrf--}}
{{--                                    @method(('delete'))--}}
{{--                                    <button type="submit" class="btn btn-sm btn-danger">--}}
{{--                                        <i class="fas fa-trash"></i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
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
        const table = $('#crudTable').DataTable({
            "language": {
                "lengthMenu": "_MENU_  elemente pe pagină",
                "info": "Arătată _START_ pînă la _END_ de la _TOTAL_ elemente",
                "search": "Căutare:",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": ">",
                    "previous": "<"
                }
            },
            order: [[2, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": [3] }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

    @endpush
