@extends('layouts.admin')

@section('content')
           <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('news')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$news->name_ro}}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="form_container">

                                <div class="form_block row mb-3">
                                    <div class="form-group col-sm-3">
                                        <span class="fw-bold h5 mr-3">Status:</span>
                                        <span class="h5">{{$news->statusTitle}}</span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <span class="fw-bold h5 mr-3">Ordinea:</span>
                                        <span class="h5">{{$news->sort_order}}</span>

                                    </div>
                                    <div class="form-group col-sm-3">
                                        <span class="fw-bold h5 mr-3">Categorie:</span>
                                        <span class="h5">{{$news->category->name_ro}}</span>
                                    </div>
                                </div>

                    @include("panel.components.forms.nameShow",["title" => "Numele noutații", "valueRo" => $news->name_ro, "valueRu" => $news->name_ru, "valueEn" => $news->name_en])
                    @include("panel.components.forms.descriptionShow",["title" => "Descriere noutații", "valueRo" => $news->description_ro, "valueRu" => $news->description_ru, "valueEn" => $news->description_en])



                                <div class="form_block row mb-3 ">

                                        <div class="col-sm-8 " id="previewImageContainer">
                                            @if($news->image)
                                                <a href="{{url('storage/'.$news->image)}}" data-fancybox data-caption="Single image">
                                                <img id="image_preview" src="{{url('storage/'.$news->image)}}" alt="Preview news image" class="added_preview_image " onclick="" style="width: 400px">
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                            </div>





                        </div>


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
