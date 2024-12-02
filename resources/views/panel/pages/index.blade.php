@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">


            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->

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
                            <th>Numele </th>
                            <th>Image</th>
                            <th>Descriere</th>
                            <th>Acțiune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $item)
                            <tr >
                                <td> {{$item->title_ro}}</td>
                                <td>     <img src="{{url('storage/'.$item->image)}}" alt="Page image" width="70px"></td>
                                <td> {!!substr($item->description_ro, 0, 150).'...'!!}</td>

                                <td class="d-flex">

                                    <div class="mr-2">
                                        <a href="{{route('pages.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
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
        $('.select2').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

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

            "columnDefs": [
                { "orderable": false, "targets": [3] }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

@endpush
