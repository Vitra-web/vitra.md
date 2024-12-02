@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('subcategory')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$subcategory->name_ro}}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="form_container">



                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active fs-5" id="common-tab" data-toggle="tab" href="#common" role="tab" aria-controls="common" aria-selected="true">
                                    {{trans('panel.common')}}
                                </a>
                                <a class="nav-item nav-link fs-5" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
                                    {{trans('panel.images')}}
                                </a>

                            </div>
                        </nav>

                        <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">
                                <div class="form_block row mb-3">
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">{{trans('panel.status')}}:</p>
                                        <p class="h5 ">{{$subcategory->statusTitle}}</p>
                                    </div>
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">{{trans('panel.sort')}}:</p>
                                        <p class="h5 ">{{$subcategory->sort_order}}</p>

                                    </div>
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">{{trans('panel.industry')}}:</p>
                                        <p class="h5 ">{{$subcategory->industry->name}}</p>
                                    </div>
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">{{trans('panel.category')}}:</p>
                                        <p class="h5 ">{{$subcategory->category->name_ro}}</p>

                                    </div>
                                </div>

                                @include("panel.components.forms.nameShow",["title" => trans('panel.subcategory_name'), "valueRo" => $subcategory->name_ro, "valueRu" => $subcategory->name_ru, "valueEn" => $subcategory->name_en])
                                @include("panel.components.forms.descriptionShow",["title" => trans('panel.subcategory_description'), "valueRo" => $subcategory->description_ro, "valueRu" => $subcategory->description_ru, "valueEn" => $subcategory->description_en])


                            </div>
                            <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form_block row mb-3 ">

                                    <div class="row mb-3">

                                        <div class="col-sm-8 " id="previewImageContainer">
                                            @if($subcategory->image_preview)
                                                <a href="{{url('storage/'.$subcategory->image_preview)}}" data-fancybox >
                                                <img id="image_preview" src="{{url('storage/'.$subcategory->image_preview)}}" alt="Preview subcategory image" class="added_preview_image " onclick="" style="width: 400px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">

                                        <div class="col-sm-8 ml-3 " id="mainImageContainer">
                                            @if($subcategory->image_main)
                                                <a href="{{url('storage/'.$subcategory->image_main)}}" data-fancybox >
                                                <img id="image_main" src="{{url('storage/'.$subcategory->image_main)}}" alt="Preview subcategory image" class="added_main_image " onclick="" style="width: 400px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
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
                Fancybox.bind("[data-fancybox]", {
                    // Your custom options
                });

            </script>
    @endpush
