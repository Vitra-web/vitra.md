@extends('layouts.admin')

@section('content')
           <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('careers')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$vacancy->name_ro}}</h1>
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
                                        <span class="h5">{{$vacancy->statusTitle}}</span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <span class="fw-bold h5 mr-3">Ordinea:</span>
                                        <span class="h5">{{$vacancy->sort_order}}</span>

                                    </div>

                                </div>

                    @include("panel.components.forms.nameShow",["title" => "Numele postului", "valueRo" => $vacancy->name_ro, "valueRu" => $vacancy->name_ru, "valueEn" => $vacancy->name_en])
                    @include("panel.components.forms.descriptionShow",["title" => "Descriere postului", "valueRo" => $vacancy->description_ro, "valueRu" => $vacancy->description_ru, "valueEn" => $vacancy->description_en])



                                <div class="form_block row mb-3 ">

                                        <div class="col-sm-8 " id="previewImageContainer">
                                            @if($vacancy->image)
                                                <img id="image_preview" src="{{url('storage/'.$vacancy->image)}}" alt="Preview vacancy image" class="added_preview_image " onclick="" style="width: 200px">

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


            </script>
    @endpush
