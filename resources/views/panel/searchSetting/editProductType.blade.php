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
                    <form action="{{route('searchSettings.updateProductType', $searchSetting->id)}}" method="post" class="w-100" >
                        @csrf
                        @method('patch')

                        <div class="form_block row mb-3">

                            <div class="form-group col-lg-2 col-sm-4">
                                <label for="sort_order" class="">Ordinea</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" placeholder="Ordinea" value="{{$searchSetting->sort_order}}">
                                @error('sort_order')<p class="text-danger"> {{$message}}</p>@enderror
                            </div>

                            <div class="form-group col-lg-2 col-sm-4 d-flex" data-select2-id="1">
                                <div>
                                    <label for="name">Nume</label>
                                    <select class="custom-select form-control" name="name" id="selectName" >
                                            <option value="0"  >Dupa produse sau tag</option>
                                            <option value="product" {{$searchSetting->name == 'product'? 'selected': ''}}  >Product</option>
                                            <option value="tag" {{$searchSetting->name == 'tag'? 'selected': ''}}>Tag</option>
                                    </select>
                                    @error('name')<p class="text-danger"> {{$message}}</p>@enderror
                                </div>

                            </div>

                            <div class="col-lg-2 col-sm-4 " id="productBlock">
                               <label for="selectProduct">Produse</label>
                                <select name="item_id" id="selectProduct" class="form-control select2 "  tabindex="-1" >
                                    <option value="0">Select product</option>
                                    @foreach($products as $item)
                                        <option value="{{$item->id}}" {{$searchSetting->item_id == $item->id? 'selected': ''}}>{{$item->name_ro}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 col-sm-4 row" id="tagBlock">
                                <div class="col-lg-4">
                                    <label for="tagRo">Tag Ro</label>
                                    <input type="text" class="form-control" id="tagRo" value="{{$searchSetting->value_ro}}"  name="value_ro" placeholder="Tag Ro" >
                                </div>
                                <div class="col-lg-4">
                                    <label for="tagRu">Tag Ru</label>
                                    <input type="text" class="form-control" id="tagRu" value="{{$searchSetting->value_ru}}"  name="value_ru" placeholder="Tag Ru" >
                                </div>
                                <div class="col-lg-4">
                                    <label for="tagEn">Tag En</label>
                                    <input type="text" class="form-control" id="tagEn" value="{{$searchSetting->value_en}}"  name="value_en" placeholder="Tag En" >
                                </div>

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
                const productBlock =  document.getElementById('productBlock');
                const tagBlock =  document.getElementById('tagBlock');
                const searchSetting = {!! $searchSetting !!};

                console.log(searchSetting)
                $('.select2').select2()

                if(searchSetting['name'] === 'product') {
                    productBlock.style.display = 'block'
                } else if(searchSetting['name'] === 'tag') {
                    tagBlock.style.display = 'flex'
                }

                selectName.addEventListener('change', function(item) {
                   const value = item.target.value
                    if(value === 'product') {
                        tagBlock.style.display = 'none'
                        productBlock.style.display = 'block'
                    } else if(value === 'tag') {
                        productBlock.style.display = 'none';
                        tagBlock.style.display = 'flex'
                    } else {
                        productBlock.style.display = 'none';
                        tagBlock.style.display = 'none'
                    }


                })



            </script>
    @endpush

@section('after_styles')
    <style>

        #productBlock {
            display: none;
        }
        #tagBlock {
            display: none;
        }
    </style>
@endsection
