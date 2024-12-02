@extends('layouts.admin')
@php

    $industryId = request()->get('industry');
    $categoryId = request()->get('category');
    $subcategoryId = request()->get('subcategory');

@endphp
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <form action="" method="GET" class="py-3">
                <div class="row w-75">


                    <div class="col-md-3 ">

                        <select name="industry" id="industry" class="form-control select2 " style="width: 100%;" tabindex="-1" >
                            <option value="">{{trans('panel.choose_industry')}}</option>
                            @foreach($industriesAll as $item)
                                <option value="{{$item->id}}" {{$industryId == $item->id ? 'selected': ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 ">
                        <select name="category" id="category" class="form-control select2 " style="width: 100%;"  tabindex="-1" >
                            <option value="">{{trans('panel.choose_category')}}</option>
                            @foreach($categoriesAll as $item)
                                <option value="{{$item->id}}" {{$categoryId == $item->id ? 'selected': ''}}>{{$item->name_ro}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 ">
                        <select name="subcategory" id="subcategory" class="form-control select2 " style="width: 100%;"  tabindex="-1" >
                            <option value="">{{trans('panel.choose_subcategory')}}</option>
                            @foreach($subcategories as $item)
                                <option value="{{$item->id}}" {{$subcategoryId == $item->id ? 'selected': ''}}>{{$item->name_ro}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                        <a class="btn btn-outline-dark " href="{{url('/panel/product')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </a>
                    </div>

                </div>

            </form>

            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1 class="m-0">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-2 d-flex">
                    <a href="{{route('type.create')}}" class="btn btn-outline-primary mr-5 px-3 ">
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
                            <th>{{trans('panel.sort')}}</th>
                            <th>{{trans('panel.image')}}</th>
                            <th>{{trans('panel.name')}}</th>
                            <th>{{trans('panel.industry_name')}}</th>
                            <th>{{trans('panel.category_name')}}</th>
                            <th>{{trans('panel.subcategory_name')}}</th>
                            <th>{{trans('panel.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($types as $item)
                        <tr >
                            <td>
                                <button class="btn btn-sm {{$item->status == '1' ? 'btn-success' : 'btn-danger'}}">{{$item->statusTitle}}</button>
                            </td>
                            <td> {{$item->sort_order}}</td>
                            <td>
                                <img src="{{url('storage/'.$item->image_preview)}}" alt="Product image" width="50px">
                            </td>
                            <td> {{$item->title_ro}}</td>
                            <td> {{  $item->industry->name}}</td>
                            <td> {{$language->replace($item->category->name_ro, $item->category->name_ru, $item->category->name_en) }}</td>
                            <td> {{$language->replace($item->subcategory->name_ro, $item->subcategory->name_ru, $item->subcategory->name_en)  }}</td>


                            <td class="d-flex">
{{--                                <div class="mr-2">--}}
{{--                                    <a href="{{route('type.show', $item->id)}}" class="btn btn-sm btn-info">--}}
{{--                                        <i class="fas fa-eye"></i>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
                                <div class="mr-2">
                                    <a href="{{route('type.edit', [$item->id, 'industry'=>$industryId, 'category'=>$categoryId, 'subcategory'=>$subcategoryId])}}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>

                                <form action="{{route('type.delete', $item->id)}}" method="post" onsubmit="return confirm('{{trans('panel.accept_delete')}}');">
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
        const category = document.getElementById('category');
        const subcategory = document.getElementById('subcategory');


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
            order: [[1, 'asc']],
            "columnDefs": [
                { "orderable": false, "targets": [7] }
            ]
        });
        table.buttons( '.export' ).remove();

        function selectCategory() {
            subcategory.innerHTML = null
            let industryId = $('#industry').find(":selected").val();

            let industries = {!! json_encode($industriesAll) !!};

            let IndustryList = industries.find(item => item.id === Number(industryId))

            const CategoryList = IndustryList.categories

            if(CategoryList) {
                let options = "";
                options+= `<option value="">Select category</option>`
                CategoryList.forEach(category=> {

                    options += `<option value="${category.id}" >${category.name_ro}</option>`;
                })

                category.innerHTML = options;

            }

            let categories = {!! json_encode($categoriesAll) !!};

            let categoryList = categories.find(item => item.industry_id === Number(industryId))

            const subCategoryList = categoryList.subcategories

            if(subCategoryList) {
                let options = "";
                options+= `<option value="">Select subcategory</option>`
                subCategoryList.forEach(category=> {
                    options += `<option value="${category.id}" >${category.name_ro}</option>`;
                })

                subcategory.innerHTML = options;
            }
            // selectSubcategory()
        }

        function selectSubcategory() {
            let categoryId = $('#category').find(":selected").val();

            let categories = {!! json_encode($categoriesAll) !!};

            let categoryList = categories.find(item => item.id === Number(categoryId))
            const CategoryList = categoryList.subcategories

            if(CategoryList) {
                let options = "";
                options+= `<option value="">Select subcategory</option>`
                CategoryList.forEach(category=> {
                    options += `<option value="${category.id}" >${category.name_ro}</option>`;
                })

                subcategory.innerHTML = options;
            }
        }

        $('#industry').on('change', event=>{
            selectCategory()
        })

        $('#category').on('change', event=>{
            selectSubcategory()

        })



    </script>

    @endpush
