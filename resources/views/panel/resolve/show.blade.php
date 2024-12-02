@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="mb-3">
                    <a href="{{route('portfolio')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$portfolio->name_ro}}</h1>
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
                            <div class="nav nav-tabs" id="portfolio-tab" role="tablist">
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
                                        <p class="h5 ">{{$portfolio->statusTitle}}</p>
                                    </div>
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">Ordinea:</p>
                                        <p class="h5 ">{{$portfolio->sort_order}}</p>

                                    </div>
                                    <div class="form-group col-sm-3 ">
                                        <p class="fw-bold h5 mr-3">Categorie:</p>
                                        <p class="h5 ">{{$portfolio->category->name_ro}}</p>

                                    </div>

                                </div>

                                @include("panel.components.forms.nameShow",["title" => "Numele portfolio", "valueRo" => $portfolio->name_ro, "valueRu" => $portfolio->name_ru, "valueEn" => $portfolio->name_en])
                                @include("panel.components.forms.editorShow",["title" => "Descriere portfolio", "valueRo" => $portfolio->description_ro, "valueRu" => $portfolio->description_ru, "valueEn" => $portfolio->description_en])


                            </div>
                            <div class="tab-pane fade " id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form_block row mb-3 ">

                                    <div class="row mb-3">

                                        <div class="col-sm-8 mb-3 " id="previewImageContainer">
                                            @if($portfolio->image_preview)
                                                <a href="{{url('storage/'.$portfolio->image_preview)}}" data-fancybox data-caption="Single image">
                                                <img id="image_preview" src="{{url('storage/'.$portfolio->image_preview)}}" alt="Preview portfolio image" class="added_preview_image " style="width: 400px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
{{--                                    <div class="row mb-3">--}}

                                        <div class="mb-3 ml-3 d-flex flex-wrap justify-content-between" id="mainImageContainer">
                                            @if($images)
                                                @foreach($images as $item)
                                                    @if($item->type == 'image')
                                                        <div class="image_block mb-2" style="min-height: 240px">
                                                            <a href="{{url('storage/'.$item->url)}}" data-gallery >
                                                            <img id="image_main" src="{{url('storage/'.$item->url)}}" alt="Preview portfolio image" class=" "  style="width: 300px">
                                                            </a>
                                                        </div>
                                                    @elseif($item->type == 'video')
                                                        <div class="image_block mb-2">
                                                            <a href="{{url('storage/'.$item->url)}}" data-gallery >
                                                            <video src="{{url('storage/'.$item->url)}}" controls width="300" height="240"></video>
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
{{--                                    </div>--}}
                                </div>

                            </div>





                        </div>



                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        @endsection

        @push('script')
            <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

            <script>
                Fancybox.bind("[data-fancybox]", {
                    // Your custom options
                });
                Fancybox.bind("[data-gallery]", {
                    // Your custom options
                });

            </script>
    @endpush
        @section('after_styles')
            <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
            />
            <style>
                .image_block {
                    position: relative;
                    width: 300px;
                }


                .main_view {
                    display: none;
                    position: absolute;
                    top: 10%;
                    left:10%;
                    width: 80vw;
                    height: 80vh;
                    z-index: 10;
                }

                .main_view img {
                    width: 100%;
                    height: 100%;
                    object-fit: contain;

                }
            </style>

@endsection