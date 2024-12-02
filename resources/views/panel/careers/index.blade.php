@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <nav class="w-100">
                <div class="nav nav-tabs" id="portfolio-tab" role="tablist">
                    <a class="nav-item nav-link active fs-5" id="common-tab" data-toggle="tab" href="#common" role="tab" aria-controls="common" aria-selected="true">
                        Common
                    </a>
                    <a class="nav-item nav-link fs-5" id="benefits-tab" data-toggle="tab" href="#benefits" role="tab" aria-controls="benefits" aria-selected="false">
                        Beneficii
                    </a>
                    <a class="nav-item nav-link fs-5" id="vacancy-tab" data-toggle="tab" href="#vacancy" role="tab" aria-controls="vacancy" aria-selected="false">
                        Posturi vacante
                    </a>
                </div>
            </nav>




        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
{{----------------                Comon Tab  -------------------}}
                <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">

                    <div class="row mb-2 align-items-start">
                        <div class="col-sm-4">
                            <h1 class="m-0">Careers page content</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-2 d-flex">
                            <a href="{{route('careers.editPage', $careersPage->id)}}" class="btn btn-outline-primary mr-5 px-3 ">
                                <i class="fas fa-edit"></i>
                            </a>

                        </div>
                    </div>

                    <div class=" mb-3">
                        <div class="image_background " style="background-image: url({{url('storage/'.$careersPage->image)}});">
                            <h1 class="text-center text-uppercase all-titles__title image_background__title">{{$careersPage->title_ro}}</h1>
                        </div>
                    </div>


                    <div class="form_block row mb-3 ">
                        <h4 class="mb-3">Descriere Cariere title</h4>
                        <div class="d-flex form-group col-sm-4">
                            <span >
                                <img src="{{asset('images/flags/ro.png')}}" width="24px" alt="Romana">
                            </span>
                            <span class="ml-3 fs-4"><strong>{{$careersPage->description_title_ro}}</strong> </span>

                        </div>
                        <div class="d-flex form-group col-sm-4">
                            <span>
                                <img src="{{asset('images/flags/ru.png')}}" width="24px" alt="Russian">
                            </span>
                            <span class="ml-3 fs-4"><strong>{{$careersPage->description_title_ru}}</strong> </span>

                        </div>

                        <div class="d-flex form-group col-sm-4">
                            <span >
                                <img src="{{asset('images/flags/gb.png')}}" width="24px" alt="English">
                            </span>
                            <span class="ml-3 fs-4"><strong>{{$careersPage->description_title_en}}</strong> </span>
                        </div>
                    </div>

                    @include("panel.components.forms.editorShow",["title" => "Descriere Cariere", "placeholder" => "Descriere Cariere", "valueRo" => $careersPage->description_ro, "valueRu" => $careersPage->description_ru, "valueEn" => $careersPage->description_en])

                </div>

                {{----------------                benefits Tab  -------------------}}

                <div class="tab-pane fade " id="benefits" role="tabpanel" aria-labelledby="benefits-tab">
                    <div class="row mb-4 align-items-start">
                        <div class="col-sm-3">
                            <h1 class="m-0">Beneficii</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-2 d-flex">
                            <a href="{{route('careers.createBenefit')}}" class="btn btn-outline-primary mr-5 px-3 ">
                                <i class="fas fa-plus-circle"></i>
                            </a>

                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-hover text-nowrap" id="benefitsTable">
                                <thead>
                                <tr>

                                    <th>Image</th>
                                    <th>Numele</th>
                                    <th>Ordinea</th>
                                    <th>Acțiune</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($benefits as $item)
                                    <tr >
                                        <td>
                                            <img src="{{url('storage/'.$item->image)}}" alt="News image" width="50px">
                                        </td>
                                        <td> {{$item->title_ro}}</td>
                                        <td> {{$item->sort_order}}</td>

                                        <td class="d-flex">
{{--                                            <div class="mr-2">--}}
{{--                                                <a href="{{route('careers.show', $item->id)}}" class="btn btn-sm btn-info">--}}
{{--                                                    <i class="fas fa-eye"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
                                            <div class="mr-2">
                                                <a href="{{route('careers.editBenefit', $item->id)}}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <form action="{{route('careers.deleteBenefit', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
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

                {{----------------                vacancy Tab  -------------------}}

                <div class="tab-pane fade " id="vacancy" role="tabpanel" aria-labelledby="vacancy-tab">

                    <div class="row mb-4 align-items-start">
                        <div class="col-sm-3">
                            <h1 class="m-0">Posturi vacante</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-2 d-flex">
                            <a href="{{route('careers.create')}}" class="btn btn-outline-primary mr-5 px-3 ">
                                <i class="fas fa-plus-circle"></i>
                            </a>

                        </div>
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-hover text-nowrap" id="vacancyTable">
                                <thead>
                                <tr>
                                    <th>Status</th>
{{--                                    <th>Image</th>--}}
                                    <th>Numele</th>
                                    <th>Ordinea</th>
                                    <th>Acțiune</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($vacancy as $item)
                                    <tr >
                                        <td>
                                            <button class="btn btn-sm {{$item->status == '1' ? 'btn-success' : 'btn-danger'}}">{{$item->statusTitle}}</button>
                                        </td>
{{--                                        <td>--}}
{{--                                            <img src="{{url('storage/'.$item->image)}}" alt="News image" width="50px">--}}
{{--                                        </td>--}}
                                        <td> {{$item->name_ro}}</td>
                                        <td> {{$item->sort_order}}</td>

                                        <td class="d-flex">
                                            <div class="mr-2">
                                                <a href="{{route('careers.show', $item->id)}}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <div class="mr-2">
                                                <a href="{{route('careers.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>

                                            <form action="{{route('careers.delete', $item->id)}}" method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
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

        const tableBenefit = $('#benefitsTable').DataTable({
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
        tableBenefit.buttons( '.export' ).remove();

        const tableVacancy = $('#vacancyTable').DataTable({
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
        tableVacancy.buttons( '.export' ).remove();
    </script>

    @endpush
