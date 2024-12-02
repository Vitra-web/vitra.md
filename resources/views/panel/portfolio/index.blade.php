@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <form action="" method="GET" class="py-3">
                <div class="row w-75">

                    <div class="col-md-3 ">
                        {{--                        <label for="industry">Industrie</label>--}}
                        <select name="industry" id="industry" class="form-control select2 " style="width: 100%;" tabindex="-1" >
                            <option value="">Select industrie</option>
                            @foreach($industries as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 ">
                        {{--                                                <label for="industry">Category</label>--}}
                        <select name="category" id="category" class="form-control select2 " style="width: 100%;"  tabindex="-1" >
                            <option value="">Select category</option>
                            @foreach($portfolioCategories as $item)
                                <option value="{{$item->id}}">{{$item->name_ro}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                        <a class="btn btn-outline-dark " href="{{url('/panel/portfolio')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </a>
                    </div>



                </div>

            </form>

            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 d-flex">
                    <a href="{{route('portfolio.create')}}" class="btn btn-outline-primary mr-5 px-3 ">
                        <i class="fas fa-plus-circle"></i>
                    </a>

                </div>
                <div class="col-sm-3">
                    <a href="{{route('portfolio.categories')}}" class="btn btn-primary">Portfolio categorii</a>
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
                            <th>Image</th>
                            <th>Numele</th>
                            <th>Numele Industriei</th>
                            <th>Numele Categoriei</th>
                            <th>Date</th>
                            <th>Acțiune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($portfolios as $item)
                            <tr >
                                <td>
                                    <button class="btn btn-sm {{$item->status == '1' ? 'btn-success' : 'btn-danger'}}">{{$item->statusTitle}}</button>
                                </td>
                                <td>
                                    <img src="{{url('storage/'.$item->image_preview)}}" alt="Product image" width="50px">
                                </td>
                                <td> {{$item->name_ro}}</td>
                                <td> {{$item->industry->name}}</td>
                                <td> {{$item->category->name_ro ?? '-'}}</td>
                                <td> {{$item->date}}</td>

                                <td class="d-flex">
                                    <div class="mr-2">
                                        <a href="{{route('portfolio.show', $item->id)}}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="mr-2">
                                        <a href="{{route('portfolio.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>

                                    <form action="{{route('portfolio.delete', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
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
            order: [[5, 'desc']],
            "columnDefs": [
                { "orderable": false, "targets": [6] }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

@endpush
