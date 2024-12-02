@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2 align-items-start">
                <div class="col-sm-4">
                    <h1 class="m-0">Contacts page content</h1>
                </div><!-- /.col -->
                <div class="col-sm-2 d-flex">
                    <a href="{{route('contacts.editPage', $contactsPage->id)}}" class="btn btn-outline-primary mr-5 px-3 ">
                        <i class="fas fa-edit"></i>
                    </a>

                </div>
            </div>



        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class=" mb-3">
                <div class="image_background " style="background-image: url({{url('storage/'.$contactsPage->image)}});">
                    <h1 class="text-center text-uppercase all-titles__title image_background__title">{{$contactsPage->title_ro}}</h1>
                </div>
            </div>

            <div class="row mb-3">

                <div class="col-md-8 my-4 px-3" style="font-size: 18px">
                    {!! $contactsPage->description_ro !!}
                </div>
            </div>

            <div class="form_block mb-3 ">

                <div class="row mb-2">
                    <div class="col-sm-2">
                        <h1 class="m-0">{{$title}}</h1>
                    </div><!-- /.col -->
{{--                    <div class="col-sm-6 d-flex">--}}
{{--                        <a href="{{route('news.create')}}" class="btn btn-outline-primary mr-5 px-3 ">--}}
{{--                            <i class="fas fa-plus-circle"></i>--}}
{{--                        </a>--}}

{{--                    </div>--}}
                </div>

            <div class="row">
                <div class="col-12">
                    <table class="table table-hover text-nowrap" id="crudTable">
                        <thead>
                        <tr>
                            <th>Numele</th>
                            <th>Adresa</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Acțiune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $item)
                        <tr >
                            <td>
                               {{$item->title_ro}}
                            </td>
                            <td>
                                {{$item->address}}
                            </td>
                            <td> {{$item->phone}}</td>

                            <td> {{$item->email}}</td>

                            <td class="d-flex">
{{--                                <div class="mr-2">--}}
{{--                                    <a href="{{route('news.show', $item->id)}}" class="btn btn-sm btn-info">--}}
{{--                                        <i class="fas fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <div class="mr-2">
                                    <a href="{{route('contacts.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

{{--                                <form action="{{route('news.delete', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">--}}
{{--                                    @csrf--}}
{{--                                    @method(('delete'))--}}
{{--                                    <button type="submit" class="btn btn-sm btn-danger">--}}
{{--                                        <i class="fas fa-trash"></i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}

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
            order: [[0, 'desc']],
            "columnDefs": [
                { "orderable": false, "targets": [4] }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

    @endpush

@section('after_styles')
    <style>
        /*table {*/
        /*    display: block;*/
        /*    overflow-x: auto;*/
        /*    white-space: nowrap;*/
        /*}*/

        /*.table td, .table th{*/
        /*    vertical-align: middle !important;*/
        /*}*/
        /*.table td table {*/
        /*    width: 100%;*/
        /*}*/
        /*.table thead {*/
        /*    width: 100%;*/
        /*}*/

    </style>
@endsection
