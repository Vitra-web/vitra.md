@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('slider')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$slider->name_ro}}</h1>
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
                                    Common
                                </a>
                                <a class="nav-item nav-link fs-5" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
                                    Images
                                </a>

                            </div>
                        </nav>

                        <div class="tab-content p-3 " style="min-height: 500px" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="common" role="tabpanel" aria-labelledby="common-tab">
                                <div class="form_block row mb-3">
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">Status:</p>
                                        <p class="h5 ">{{$slider->statusTitle}}</p>
                                    </div>
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">Ordinea:</p>
                                        <p class="h5 ">{{$slider->sort_order}}</p>

                                    </div>
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">Link:</p>
                                        <a href="{{$slider->link}}" target="_blank" class="h5 text-blue">{{$slider->link}}</a>
                                    </div>
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">Categorie:</p>
                                        <p class="h5 ">{{$slider->category->name_ro}}</p>

                                    </div>
                                </div>

                                @include("panel.components.forms.nameShow",["title" => "Numele", "valueRo" => $slider->name_ro, "valueRu" => $slider->name_ru, "valueEn" => $slider->name_en])
                                @include("panel.components.forms.descriptionShow",["title" => "Descriere", "valueRo" => $slider->description_ro, "valueRu" => $slider->description_ru, "valueEn" => $slider->description_en])


                            </div>
                            <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form_block row mb-3 ">

                                    <div class="row mb-3">

                                        <div class="col-sm-8 " id="previewImageContainer">
                                            @if($slider->image)
                                                <a href="{{url('storage/'.$slider->image)}}" data-fancybox data-caption="Preview image">
                                                <img id="image_preview" src="{{url('storage/'.$slider->image)}}" alt="Preview slider image" class="added_preview_image " onclick="" style="width: 400px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">

                                        <div class="col-sm-8 ml-3 " id="mainImageContainer">
                                            @if($slider->video)
                                                <a href="{{url('storage/'.$slider->video)}}" data-gallery >
                                                <video src="{{url('storage/'.$slider->video)}}" controls width="300" height="240"></video>
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
                Fancybox.bind("[data-gallery]", {
                    // Your custom options
                });
            </script>
    @endpush
