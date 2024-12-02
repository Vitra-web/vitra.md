@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2 align-items-start">
                <div class="col-sm-2">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-2 d-flex">
                    <a href="{{route('about.edit', 1)}}" class="btn btn-outline-primary mr-5 px-3 ">
                        <i class="fas fa-edit"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-6">
                    <img src="{{url('storage/'.$item->image)}}" alt="Main image" style="width: 80%">
                </div>
                <div class="col-md-6">
                <h2>{{$item->title_ro}}</h2>
                {!! $item->description_ro !!}
                </div>
            </div>

            <div class="form_block mb-3 ">
                <div class="row mb-2 align-items-start">
                    <div class="col-sm-2">
                        <h1 class="m-0">Beneficii</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-2 d-flex">
                        <a href="{{route('about.createBenefit')}}" class="btn btn-outline-primary mr-5 px-3 ">
                            <i class="fas fa-plus-circle"></i>
                        </a>

                    </div>
                </div><!-- /.row -->

                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover text-nowrap" id="crudTable">
                            <thead>
                            <tr>
                                <th>Ordinea</th>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>Slider image</th>
                                <th>Acțiune</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($benefits as $item)
                                <tr >

                                    <td> {{$item->sort_order}}</td>
                                    <td> {{$item->number}} {{$item->title_ro}}</td>
                                    <td>
                                        <img src="{{url('storage/'.$item->image)}}" alt="Benefit image" width="50px">
                                    </td>
                                    <td>
                                        @if(isset($item->slider_image))
                                        <img src="{{url('storage/'.$item->slider_image)}}" alt="Slider image" width="50px">
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <div class="mr-2">
                                            <a href="{{route('about.editBenefit', $item->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>

                                        <form action="{{route('about.deleteBenefit', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
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
            order: [[0, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": [4]  }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

    @endpush
