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
                    <a href="{{route('slider.create')}}" class="btn btn-outline-primary mr-5 px-3 ">
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
                            <th>Status</th>
                            <th>Image </th>
                            <th>Numele</th>
                            <th>Ordinea</th>
                            <th>Acțiune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $item)
                        <tr >
                            <td>
                                <button class="btn btn-sm {{$item->status == '1' ? 'btn-success' : 'btn-danger'}}">{{$item->statusTitle}}</button>
                            </td>
                            <td>
                                @if(isset($item->image))
                                <img src="{{url('storage/'.$item->image)}}" alt="Industry image" width="50px">
                                @elseif(isset($item->video))
                                    <a href="{{url('storage/'.$item->video)}}" data-gallery >
                                    <video src="{{url('storage/'.$item->video)}}" class="added_video" width="50" height="50"></video>
                                    </a>
                                @else -
                                @endif
                            </td>
                            <td> {{$item->name_ro}}</td>
                            <td> {{$item->sort_order}}</td>
                            <td class="d-flex">
                                <div class="mr-2">
                                    <a href="{{route('slider.show', $item->id)}}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                <div class="mr-2">
                                    <a href="{{route('slider.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

                                <form action="{{route('slider.delete', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
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

        Fancybox.bind("[data-gallery]", {
            // Your custom options
        });


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
            order: [[3, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": [4] }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

    @endpush
