@php
    use Illuminate\Support\Facades\Auth;
    $current_route = request()->route()->getName();
    $user = Auth::user();
@endphp

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
                    <a href="{{route('user.create')}}" class="btn btn-outline-primary mr-5 px-3 ">
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
                            <th>{{trans('panel.status')}}</th>
                            <th>{{trans('panel.name')}}</th>
                            <th>{{trans('panel.role')}}</th>
                            <th>Login</th>
                            <th>{{trans('panel.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                        <tr >
                            <td>
                                <button class="btn btn-sm {{$item->status == '1' ? 'btn-success' : 'btn-danger'}}">{{$item->statusTitle}}</button>
                            </td>
                            <td> {{$item->name}}</td>
                            <td> {{$item->role->name}}</td>
                            <td> {{$item->login}}</td>

                            <td class="d-flex">
                                <div class="mr-2">
                                    <a href="{{route('user.show', $item->id)}}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>

                                @if($user->role->name == 'admin' || $user->id == $item->id)
                                <div class="mr-2">
                                    <a href="{{route('user.edit', $item->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                                @endif
                                @if($user->role->name == 'admin')
                                <form action="{{route('user.delete', $item->id)}}" method="post" onsubmit="return confirm('{{trans('panel.accept_delete')}}');">
                                    @csrf
                                    @method(('delete'))
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
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
