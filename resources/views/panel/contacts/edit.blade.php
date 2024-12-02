@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('contacts')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="form_container">
                    <form action="{{route('contacts.update', $contact->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')


                        @include("panel.components.forms.title",["title" => "Numele", "placeholder" => "Numele", "valueRo" => $contact->title_ro, "valueRu" => $contact->title_ru, "valueEn" => $contact->title_en])

                                <div class="form_block row mb-3">

                                    <div class="form-group col-sm-4">
                                        <label for="" class="">Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Adresa" value="{{$contact->address}}">
                                        @error('address')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label for="" class="">Phone</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{$contact->phone}}">
                                        @error('phone')<p class="text-danger"> {{$message}}</p>@enderror
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="" class="">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Adresa" value="{{$contact->email}}">
                                        @error('email')<p class="text-danger"> {{$message}}</p>@enderror
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


            </script>
    @endpush
