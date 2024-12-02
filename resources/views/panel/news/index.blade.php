@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2 align-items-start">
                <div class="col-sm-4">
                    <h1 class="m-0">News page content</h1>
                </div><!-- /.col -->
                <div class="col-sm-2 d-flex">
                    <a href="{{route('news.editPage', $newsPage->id)}}" class="btn btn-outline-primary mr-5 px-3 ">
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
                <div class="image_background " style="background-image: url({{url('storage/'.$newsPage->image)}});">
                    <h1 class="text-center text-uppercase all-titles__title image_background__title">{{$newsPage->title_ro}}</h1>
                </div>
            </div>

{{--            <div class="row mb-3">--}}
{{--                <div class="col-md-8">--}}
{{--                    <img src="{{url('storage/'.$newsPage->image)}}" alt="Main image" style="width: 100%">--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <h2>{{$newsPage->title_ro}}</h2>--}}
{{--                    {!! $item->description_ro !!}--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="form_block mb-3 ">
                <form action="" method="GET" class="py-3">
                    <div class="row justify-content-start">


                        <div class="col-md-3 ">
                            {{--                        <label for="industry">Industrie</label>--}}
                            <select name="industry" id="industry" class="form-control select2 " style="width: 100%;"  tabindex="-1" >
                                <option value="">Select categorie</option>
                                @foreach($newsCategories as $item)
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
                            <a class="btn btn-outline-dark " href="{{url('/panel/news')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </a>
                        </div>

                    </div>

                </form>

                <div class="row mb-2 align-items-center">
                    <div class="col-sm-2">
                        <h1 class="m-0">{{$title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6 d-flex">
                        <a href="{{route('news.create')}}" class="btn btn-outline-primary mr-5 px-3 ">
                            <i class="fas fa-plus-circle"></i>
                        </a>

                    </div>
                </div>

            <div class="row">
                <div class="col-12">
                    <table class="table table-hover text-nowrap" id="crudTable">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Numele Categoriei</th>
                            <th>Numele</th>
                            <th>Ordinea</th>
                            <th>Acțiune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $item)
                        <tr >
                            <td>
                                <button class="btn btn-sm {{$item->status == '1' ? 'btn-success' : 'btn-danger'}}">{{$item->statusTitle}}</button>
                            </td>
                            <td>
                                <img src="{{url('storage/'.$item->image)}}" alt="News image" width="50px">
                            </td>
                            <td> {{$item->category->name_ro}}</td>
                            <td>
                               @php if(strlen($item->name_ro) > 50){
                                $nameText = substr($item->name_ro, 0, 50).'...';
                                }  else $nameText = $item->name_ro;
                                @endphp
                                {{$nameText}}</td>
                            <td> {{$item->sort_order}}</td>

                            <td class="d-flex">
                                <div class="mr-2">
                                    <a href="{{route('news.show', $item->id)}}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                <div class="mr-2">
                                    <a href="{{route('news.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

                                <form action="{{route('news.delete', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
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
            order: [[4, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": [5] }
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
