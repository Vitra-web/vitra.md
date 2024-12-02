@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-3">
                <a href="{{route('industry')}}" class="btn btn-secondary" >
                    <i class="fas fa-backward mr-2"></i>
                </a>
            </div>

            <div class="row mb-2 align-items-start">

                <div class="col-sm-3">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-4 d-flex">
                    <a href="{{route('industry.createCategory')}}" class="btn btn-outline-primary mr-5 px-3 ">
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
                    <table class="table table-hover text-nowrap" id="crudTable">
                        <thead>
                        <tr>
                            <th>{{trans('panel.industry')}}</th>
                            <th>{{trans('panel.category_name')}}</th>
{{--                            <th>Ordinea</th>--}}
                            <th>{{trans('panel.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($industryCategories as $item)
                        <tr >
                            <td> {{$item->industry->name}}</td>
                            <td> {{$item->name_ro}}</td>

{{--                            <td> {{$item->sort_order}}</td>--}}

                            <td class="d-flex">

                                <div class="mr-2">
                                    <a href="{{route('industry.editCategory', $item->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

                                <form action="{{route('industry.deleteCategory', $item->id)}}" method="post" onsubmit="return confirm('{{trans('panel.accept_delete')}}');">
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

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection



    @push('script')

    <script>

        $('.select2').select2()



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
            // order: [[4, 'asc']],
            // "columnDefs": [
            //     { "orderable": false, "targets": [5] }
            // ]
        });
        table.buttons( '.export' ).remove();

    </script>

    @endpush
