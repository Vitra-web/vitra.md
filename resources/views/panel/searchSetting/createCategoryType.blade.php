@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('searchSettings')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="form_container">
                    <form action="{{route('searchSettings.storeCategoryType')}}" method="post" class="w-100" >
                        @csrf


                        <div class="form_block row mb-3">

                            <div class="form-group col-lg-2 col-sm-4">
                                <label for="sort_order" class="">Ordinea</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" placeholder="Ordinea" value="{{count($searchSettings)+1}}">
                                @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>

                            <div class="form-group col-lg-3 col-sm-4 d-flex" data-select2-id="1">
                                <div>
                                    <label for="name">Nume</label>
                                    <select class="custom-select form-control" name="name" id="selectName" >
                                            <option value="0" selected >Dupa categorie sau subcategorie</option>
                                            <option value="category" >Category</option>
                                            <option value="subcategory" >Subcategory</option>
                                    </select>
                                    @error('name')<p class="text-danger"> {{$message}}</p>@enderror
                                </div>

                            </div>

                            <div class="col-lg-3 col-sm-4 " id="categoryBlock">
                               <label for="selectCategory">Category</label>
                                <select name="category_id" id="selectCategory" class="form-control select2 "  tabindex="-1" >
                                    <option value="0">Select Category</option>
                                    @foreach($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name_ro}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-3 col-sm-4 " id="subcategoryBlock">
                                <label for="selectSubcategory">Subcategory</label>
                                <select name="subcategory_id" id="selectSubcategory" class="form-control select2 "  tabindex="-1" >
                                    <option value="0">Select Subcategory</option>
                                    @foreach($subcategories as $item)
                                        <option value="{{$item->id}}">{{$item->name_ro}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>


                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        @endsection

        @push('script')
            <script>
                const selectName =  document.getElementById('selectName');
                const categoryBlock =  document.getElementById('categoryBlock');
                const subcategoryBlock =  document.getElementById('subcategoryBlock');



                $('.select2').select2()


                selectName.addEventListener('change', function(item) {
                   const value = item.target.value
                    if(value === 'category') {
                        subcategoryBlock.style.display = 'none'
                        categoryBlock.style.display = 'block'
                    } else if(value === 'subcategory') {
                        categoryBlock.style.display = 'none';
                        subcategoryBlock.style.display = 'block'
                    } else {
                        categoryBlock.style.display = 'none';
                        subcategoryBlock.style.display = 'none'
                    }


                })



            </script>
    @endpush

@section('after_styles')
    <style>

        #categoryBlock {
            display: none;
        }
        #subcategoryBlock {
            display: none;
        }
    </style>
@endsection
