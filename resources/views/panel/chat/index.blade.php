@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <form action="" method="GET" class="py-3">
                <div class="row">


                    <div class="col-md-3 ">
{{--                        <label for="industry">Industrie</label>--}}
                        <select name="industry" id="industry" class="form-control  " style="width: 100%;"  tabindex="-1" >
                            <option value="">{{trans('panel.choose_industry')}}</option>
                            @foreach($industries as $item)
                                <option value="{{$item->id}}" {{request()->get('industry') == $item->id ? 'selected':''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 ">

                        <select name="checked" id="checked" class="form-control  " style="width: 100%;"  tabindex="-1" >
                            <option value="" >{{trans('panel.choose_status')}}</option>
                             <option value="0" {{ request()->get('checked') != null && request()->get('checked') == 0 ? 'selected':''}} >{{trans('panel.status_new')}}</option>
                             <option value="1" {{request()->get('checked') == 1 ? 'selected':''}}>{{trans('panel.status_view')}}</option>
                             <option value="2" {{request()->get('checked') == 2 ? 'selected':''}}>{{trans('panel.status_answered')}}</option>

                        </select>
                    </div>


                    <div class="col-md-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                        <a class="btn btn-outline-dark " href="{{url('/panel/chat')}}">
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
                </div>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover text-nowrap" id="crudTable">
                        <thead>
                        <tr>
                            <th>{{trans('panel.status')}}</th>
                            <th>{{trans('panel.action')}}</th>
                            <th>{{trans('panel.date')}}</th>
                            <th>{{trans('panel.industry_name')}}</th>
{{--                            <th>User ID</th>--}}
                            <th>{{trans('panel.messages')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($chats as $item)
                        <tr style="background-color: {{$item->checked==0 ? '#bcd5e5': 'white' }} " >
                            <td>
                               <span class="{{$item->checked==0 ?'text-danger': 'text-primary'}}">{{$item->statusTitle}}</span>
                            </td>
                            <td >
                                <div class="">
                                    <a href="{{route('chat.show', $item->id)}}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                            <td> {{$item->created_at}}</td>
                            <td> {{$item->industry->name}}</td>
{{--                            <td> {{$item->user_id}}</td>--}}
                            <td >
                                <div class="d-flex flex-wrap">
                                @foreach($item->messages as $message)
                                    <div class="message_item" style="background-color: {{$message->type == 'send' ? 'rgba(189, 187, 187, 0.2)': '#8cd1ef'}}">
                                        {{strlen($message->message) > 150 ? substr($message->message, 0, 150).'...' : $message->message  }}</div>
                                @endforeach
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
            order: [[2, 'desc']],
            "columnDefs": [
                { "orderable": false, "targets": [1] }
            ]
        });
        table.buttons( '.export' ).remove();

    </script>

    @endpush

@section('after_styles')
    <style>

        .message_item {
            padding: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            background-color: rgba(189, 187, 187, 0.2);
            /*max-width: 800px;*/

        }
    </style>
@endsection
