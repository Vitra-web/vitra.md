

@extends('layouts.admin')

@section('content')

    <!-- Main content -->
        <section class="content">
                <div class="container-fluid">

                <form action="" method="GET" class="py-3 mb-3">
                    <div class="row">


                        <div class="col-md-4 row justify-content-between  me-4">
                            <div class="col-6 row align-items-center">
                                <label class="col-3" for="date_from">{{trans('panel.date_from')}}</label>
                                <input  type="date" name="date_from" value="{{request()->get('date_from') }}" id="date_from" class="form-control datapicker col-9  ">
                            </div>
                             <div class="col-6 row align-items-center">
                                 <label class="col-4" for="date_to">{{trans('panel.date_to')}}</label>
                                 <input type="date" name="date_to" value="{{request()->get('date_to')}}" id="date_to" class="form-control datapicker col-8 ">
                             </div>
                        </div>
                        <div class="col-md-2">
                            <select name="status" id="" class="form-select form-control">
                                <option value="">{{trans('panel.choose_status')}}</option>
                                <option value="0" {{request()->get('status') != null && request()->get('status') == '0' ? 'selected':''}}>{{trans('panel.status_new')}}</option>
                                <option value="1" {{request()->get('status') == '1' ? 'selected':''}}>{{trans('panel.status_view')}}</option>
                                <option value="2" {{request()->get('status')== '2' ? 'selected':''}}>{{trans('panel.status_answered')}}</option>


                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="source" id="" class="form-select form-control">
                                <option value="">{{trans('panel.choose_from')}}</option>
                                <option value="1" {{request()->get('source') == '1' ? 'selected':''}}>{{trans('panel.consultation')}}</option>
                                <option value="2" {{request()->get('source') == '2' ? 'selected':''}}>{{trans('panel.contact_page')}}</option>
                                <option value="3" {{request()->get('source')== '3' ? 'selected':''}}>{{trans('panel.feedback')}}</option>
                                <option value="4" {{request()->get('source')== '4' ? 'selected':''}}>{{trans('panel.company_page')}}</option>
                                <option value="5" {{request()->get('source')== '5' ? 'selected':''}}>{{trans('panel.vacancy_cv')}}</option>
                                <option value="6" {{request()->get('source')== '6' ? 'selected':''}}>{{trans('panel.vacancy_without_cv')}}</option>
                                <option value="7" {{request()->get('source')== '7' ? 'selected':''}}>{{trans('panel.vacancy_special')}}</option>

                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </button>
                            <a class="btn btn-outline-dark btn-sm" href="{{url('/panel')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </a>
                        </div>

                    </div>

                </form>


                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <p>{{trans('panel.total_messages')}}</p>
                                <h3>{{count($totalMails)}}</h3>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <p>{{trans('panel.consultation')}}</p>
                                <h3>{{count($consultationMails)}}</h3>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <p>{{trans('panel.contact_page')}}</p>
                                <h3>{{count($contactsMails)}}</h3>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <p>{{trans('panel.vacancy')}} </p>
                                <h3>{{count($vacancyMails)}}</h3>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        @include('panel.components.flash_message')
                        <table class="table table-hover text-nowrap w-100 " id="orderTable" >
                            <thead>
                            <tr>
                                <th>{{trans('panel.status')}}</th>
                                <th>{{trans('panel.action')}}</th>
                                <th>{{trans('panel.source')}}</th>
                                <th>{{trans('panel.name')}}</th>
                                <th>Email</th>
                                <th>{{trans('panel.phone')}}</th>
                                <th>{{trans('panel.date')}}</th>
                                <th>{{trans('panel.message')}}</th>

                                <th>{{trans('panel.vacancy_name')}}</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mails as $mail)
                                <tr  style="background-color: {{$mail->status==0 ? '#bcd5e5': 'white' }} ">

                                    @php
                                    if($mail->status == 0 )
                                        $statusColor = 'text-danger';
                                    elseif($mail->status == 1 )
                                         $statusColor = 'text-primary';
                                     elseif($mail->status == 2 )
                                        $statusColor = 'text-success';

                                    @endphp

                                    <td class="{{$statusColor}}"> {{$mail->statusName}}</td>
                                    <td>
                                        <div class="">
                                            <a href="{{route('statistic.show', $mail->id)}}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td> {{$mail->sourceName}}</td>
                                    <td> {{$mail->name . ' '. $mail->surname}}</td>
                                    <td> {{$mail->email}}</td>
                                    <td> {{$mail->phone}}</td>
                                    <td> {{$mail->created_at}}</td>
                                    <td> {{strlen($mail->message) > 60 ? substr($mail->message, 0, 60).'...' : $mail->message }}</td>
                                    <td> {{$mail->vacancy->name_ro ?? '-'}}</td>



                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div id="bottom_buttons" class="d-print-none text-center text-sm-left mb-4">
                    <div class="pull-left">

                        <ul class="ul-dropdown">
                            <li class="firstli">
                                <i class="la la-download"></i><a href="#">Export</a>
                                <ul class="ul-export">
                                    <li>Export CSV</li>
                                    <li>Export Excel</li>
                                    <li>Export PDF</li>
                                    <li>Print</li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <div class="pull-right">

                        <ul class="ul-dropdown">
                            <li class="secondli">
                                <i class="la la-eye-slash mr-2"></i><a href="#">{{trans('panel.field_visibility')}} </a>
                                <ul class="ul-choose">
                                    <li data-id="0">{{trans('panel.status')}}</li>
                                    <li data-id="1">{{trans('panel.action')}}</li>
                                    <li data-id="2">{{trans('panel.source')}}</li>
                                    <li data-id="3">{{trans('panel.name')}}</li>
                                    <li data-id="4">Email</li>
                                    <li data-id="4">{{trans('panel.phone')}}</li>
                                    <li data-id="5">{{trans('panel.date')}}</li>
                                    <li data-id="6">{{trans('panel.message')}}</li>
                                    <li data-id="7">{{trans('panel.vacancy_name')}}</li>


                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>

            </div><!-- /.container-fluid -->
            {{--@dump($mails)--}}
            {{--@dump($orders['total'])--}}
        </section>

        <!-- /.content -->
        @endsection

        @push('script')



            <script>

                $('.select2').select2()

                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })

                // $('.datapicker').datepicker({
                //     'language': 'en'
                // })
                {{--let orders =JSON.parse({{$orders}})--}}
                //     console.log(orders)
                $(".ul-export li").click(function() {
                    var i = $(this).index() + 1
                    var table = $('#orderTable').DataTable();
                    if (i == 1) {
                        table.button('.buttons-csv').trigger();
                    } else if (i == 2) {
                        table.button('.buttons-excel').trigger();
                    } else if (i == 3) {
                        table.button('.buttons-pdf').trigger();
                    } else if (i == 4) {
                        table.button('.buttons-print').trigger();
                    }
                });
                $(".ul-choose li").click(function() {
                    $( this ).toggleClass( "not-export-col" );
                    const text =  $( this ).text();
                    const id =  $( this ).data( "id" );
                    $('#orderTable thead tr:first').each(function() {

                        $(this).find("th").eq(id).toggleClass( "not-export-col" );

                    });
                    $('#orderTable tbody tr').each(function() {

                        $(this).find("td").eq(id).toggleClass( "not-export-col" );

                    });

                });
                $('#orderTable').DataTable({
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
                    order: [[6, 'desc']],
                    buttons: [
                        {
                            text: 'csv',
                            extend: 'csvHtml5',
                            messageTop: 'Emails',
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        },
                        {
                            text: 'excel',
                            extend: 'excelHtml5',
                            messageTop: 'Emails',
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        },
                        {
                            text: 'pdf',
                            extend: 'pdfHtml5',
                            messageTop: 'Emails',
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        },
                        {
                            text: 'print',
                            extend: 'print',
                            messageTop: 'Emails',
                            exportOptions: {
                                columns: ':visible:not(.not-export-col)'
                            }
                        },
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: 1
                    }]
                });


            </script>

        @endpush
        @section('after_styles')
            <style>
                table {
                    display: block;
                    overflow-x: auto;
                    white-space: nowrap;
                    width: 100%;
                }

                .table td, .table th{
                    vertical-align: middle !important;
                }
                .table td table {
                    width: 100%;
                }
                .table thead {
                    width: 100%;
                }

                tr.may-hide{
                    position: relative;
                }
                tr.may-hide.hidden > td > table{
                    display: none;
                }
                tr.may-hide > td {
                    padding: 0;
                }
                table.lvl:before{
                    content: "";
                    position: absolute;
                    height: 100%;
                    z-index: 1;
                }
                table.lvl-0:before{
                    border-left: 1px solid #7c69ef;
                    left: 20px;
                }

                table.lvl-1:before{
                    border-left: 1px solid #00a65a;
                    left: 40px;
                }

                table.lvl-2:before{
                    border-left: 1px solid #1b2a4e;
                    left: 60px;
                }
                .own.o-lvl-3:before{
                    border-color: #1b2a4e;
                    left: 60px;
                }
                td.controls{
                    position: relative;
                    width: 86px;
                    padding: .75rem 10px;
                }
                td.index{
                    width: 50px;
                }
                td.prof{
                    width: 20%;
                }
                td.employee{
                    width: 10%;
                }
                td.date{
                    width: 120px;
                    text-align: center;
                }
                td.available,
                td.passed{
                    width: 110px;
                    text-align: center;
                }
                .ev-list p{
                    margin: 0
                }
                .ev-list button{
                    float: right;
                }
                td.avg{
                    width: 130px;
                    text-align: center;
                }
                td.res{
                    width: 90px;
                    text-align: center;
                }
                td.supervisor{
                    width: 10%;
                }
                .table-danger > td{
                    background-color: rgba(214, 48, 49, .4) !important;
                }
                .table-warning > td{
                    background-color: rgba(253, 203, 110, .4) !important;
                }
                .table-success > td{
                    background-color: rgba(0, 184, 148, .4) !important;
                }


                /*-------------------------------*/
                .pull-left ul,
                .pull-right ul {
                    list-style: none;
                    margin: 0;
                    padding-left: 0;
                }
                .pull-left a,
                .pull-right a{
                    text-decoration: none;
                    color: #ffffff;
                }
                .pull-left li,
                .pull-right li{
                    color: #ffffff;
                    background-color: #456e9a;
                    border-color: #456e9a;
                    display: block;
                    float: left;
                    position: relative;
                    text-decoration: none;
                    transition-duration: 0.5s;
                    padding: 10px 30px;
                    font-size: .75rem;
                    font-weight: 400;
                    line-height: 1.428571;
                }
                .pull-left li:hover,
                .pull-right li:hover {
                    cursor: pointer;
                    color: #00bb00;
                }
                .pull-left li a:hover,
                .pull-right li a:hover {
                    color: #00bb00;
                }
                .pull-left ul li ul {
                    visibility: hidden;
                    opacity: 0;
                    min-width: 8.2rem;
                    position: absolute;

                    transition: all 0.5s ease;
                    margin-top: 8px;
                    left: 0;
                    bottom: 34px;
                    display: none;
                }
                .pull-right ul li ul {
                    visibility: hidden;
                    opacity: 0;
                    min-width: 10.2rem;
                    position: absolute;
                    z-index: 1000;
                    transition: all 0.5s ease;
                    margin-top: 8px;
                    left: 0;
                    bottom: 34px;
                    display: none;
                }
                .pull-left ul li:hover>ul,
                .pull-left ul li ul:hover,
                .pull-right ul li:hover>ul {
                    visibility: visible;
                    opacity: 1;
                    display: block;
                }
                .pull-left ul li ul li,
                .pull-right ul li ul li  {
                    clear: both;
                    width: 100%;
                    color: #ffffff;
                }

                .ul-choose li.not-export-col {
                    background-color: white;
                    color: #0e111c;
                }
                .ul-dropdown {
                    margin: 0.3125rem 1px !important;
                    outline: 0;
                }
                .firstli {
                    border-radius: 0.2rem;
                    margin-bottom: 20px;
                    margin-right: 25px;
                }
                .firstli i {
                    position: relative;
                    display: inline-block;
                    top: 0;
                    margin-top: -1.1em;
                    margin-bottom: -1em;
                    font-size: 0.8rem;
                    vertical-align: middle;
                    margin-right: 5px;
                }
                .table tr th.not-export-col {
                    display: none;
                }
                .table tr td.not-export-col {
                    display: none;
                }
                .dt-buttons {
                    display: none;
                }

                /* print styles */
                @media print {
                    .evaluations_container {
                        display: flex;
                    }
                    p {
                        margin-right: 10px;

                    }

                }
            </style>
@endsection
