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
                    <a href="{{route('resolve.create')}}" class="btn btn-outline-primary mr-5 px-3 ">
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

                            <th>Image</th>
                            <th>Numele</th>


                            <th>Acțiune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($resolves as $item)
                        <tr >

                            <td>
                                <img src="{{url('storage/'.$item->image)}}" alt="Solution image" width="50px">
                            </td>

                            <td> {{$item->name_ro}}</td>


                            <td class="d-flex">
{{--                                <div class="mr-2">--}}
{{--                                    <a href="{{route('resolve.show', $item->id)}}" class="btn btn-sm btn-info">--}}
{{--                                        <i class="fas fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <div class="mr-2">
                                    <a href="{{route('resolve.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

                                <form action="{{route('resolve.delete', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
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
            // order: [[5, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": [2] }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

    @endpush
