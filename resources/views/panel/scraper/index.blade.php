@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">


            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1 class="m-0">{{$title}}</h1>
                </div>

                @if(\Illuminate\Support\Facades\Auth::user()->role_id == 1)
                <div class="col-sm-2">
                    <a href="{{route('updatePrice1c')}}" class="btn btn-primary" type="button">Update price 1c</a>
                </div>

                @endif
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

                            <th>Descriere</th>
                            <th>Acțiune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($scrapers as $item)
                            <tr >
                                <td> {{$item->name}}</td>
                                <td> {!!substr($item->description, 0, 350)!!}</td>

                                <td class="d-flex">

                                    <div class="mr-2">
                                        <a href="{{route('scraper.show', $item->id)}}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-eye"></i>
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
                { "orderable": false, "targets": [2] }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

@endpush
