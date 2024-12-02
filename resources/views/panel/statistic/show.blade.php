@extends('layouts.admin')

@php
    if($mail->status == 0 )
        $statusColor = 'btn-outline-danger';
    elseif($mail->status == 1 )
         $statusColor = 'btn-outline-primary';
     elseif($mail->status == 2 )
        $statusColor = 'btn-outline-success';
@endphp
@section('content')
           <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('statistic')}}" class="btn btn-secondary" >
                        <i class="fas fa-backward mr-2"></i>
                    </a>

                </div>
                <div class="d-flex mb-2">
                    <div class="me-4">
                        @if($mail->name)
                        <h1 class="m-0">De la {{$mail->name.' '.$mail->surname}}</h1>
                        @endif
                    </div>
                    <div class="position-relative">
                        <button class="btn {{$statusColor}}" id="status_btn">{{$mail->statusName}}</button>
                        <div class="status_block">
                            <div>
                                    <a href="{{route('statistic.changeStatus', [$mail->id, 0] )}}" class="status_link {{$mail->status == 0 ? 'active': ''}}">
                                        <img class="status_image" src="{{asset('images/admin-panel/mail.png')}}" alt="new message">
                                        <span class="text-danger">{{trans('panel.status_new')}}</span>
                                    </a>


                                    <a href="{{route('statistic.changeStatus', [$mail->id, 1] )}}" class="status_link {{$mail->status == 1 ? 'active': ''}}">
                                        <img class="status_image" src="{{asset('images/admin-panel/view.png')}}" alt="new message">
                                        <span class="text-primary">{{trans('panel.status_view')}}</span>
                                    </a>

                                    <a href="{{route('statistic.changeStatus', [$mail->id, 2] )}}" class="status_link {{$mail->status == 2 ? 'active': ''}}">
                                        <img class="status_image" src="{{asset('images/admin-panel/resend.png')}}" alt="new message">
                                        <span class="text-success">{{trans('panel.status_answered')}}</span>
                                    </a>

                            </div>

                        </div>
                    </div>

                    <div class="form-group ms-3 col-sm-3">

                        <select class="custom-select form-control" name="manager_id" id="industry" >
                            <option value="" >Managerii</option>
                            @foreach($managers as $item)
                                <option value="{{$item->id}}" {{$mail->manager_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    <!-- Main content -->

        <section class="content">
            <div class="container-fluid ml-4">
                <div class="row ">


                    <div class="form_block row mb-3">
                        @if($mail->email)
                        <div class="form-group col-sm-3">
                            <span class="fw-bold h5 mr-3">Email:</span>
                            <span class="h5">{{$mail->email}}</span>
                        </div>
                        @endif
                        @if($mail->phone)
                        <div class="form-group col-sm-3">
                            <span class="fw-bold h5 mr-3">{{trans('panel.phone')}}:</span>
                            <span class="h5">{{$mail->phone}}</span>

                        </div>
                       @endif
                        <div class="form-group col-sm-3">
                            <span class="fw-bold h5 mr-3">{{trans('panel.source')}}:</span>
                            <span class="h5">{{$mail->sourceName}}</span>
                        </div>

                            @if($mail->specialisation)
                                <div class="form-group col-sm-3">
                                    <span class="fw-bold h5 mr-3">{{trans('panel.specialisation')}}:</span>
                                    <span class="h5">{{$mail->specialisation}}</span>
                                </div>
                            @endif
                        @if($mail->vacancy_id && $mail->vacancy )
                            <div class="form-group col-sm-3">
                                <span class="fw-bold h5 mr-3">{{trans('panel.vacancy_name')}}:</span>
                                <span class="h5">{{$mail->vacancy->name_ro}}</span>
                            </div>
                        @endif
                    </div>


                    <div class="form_block row mb-3 ">
                        @if($mail->message)
                        <div class="col-md-6">
                            <p class="fw-bold h5">{{trans('panel.message')}}:</p>
                            <p class="h6">{{$mail->message}}</p>
                        </div>
                        @endif
                            @if($mail->file)
                                <div class="col-md-6 d-flex align-items-center gap-3">
                                    <p class="fw-bold h5">CV file:</p>
                                  <p class="h6">
                                      <a href="{{url('storage/'.$mail->file)}}" class=" h6" download>
                                          <svg width="25" height="25" viewBox="0 0 24 24" fill="white" class="download_modal_svg"
                                               xmlns="http://www.w3.org/2000/svg">
                                              <rect width="24" height="24" fill="white" />
                                              <path d="M5 12V18C5 18.5523 5.44772 19 6 19H18C18.5523 19 19 18.5523 19 18V12"
                                                    stroke="#000000" stroke-linecap="round" stroke-linejoin="round" />
                                              <path d="M12 3L12 15M12 15L16 11M12 15L8 11" stroke="#000000" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                          </svg>
                                         <span>Download</span>

                                      </a>
                                  </p>
                                </div>
                            @endif

                        @if($mail->product)

                                <div class="col-md-6">
                                    <p class="fw-bold h5">{{trans('panel.product_seen')}}:</p>
                                    <a class="text-blue" href="{{route('client.product', [$mail->product->categoryId, $mail->product->subcategoryId, $mail->product->slug ])}}" target="_blank" class="h6">{{$mail->product->name_ro}}</a>
                                </div>

                            @elseif($mail->source == 1 && !$mail->product && $mail->user_path)
                                <div class="col-md-6">
                                    <p class="fw-bold h5">{{trans('panel.page_seen')}}:</p>
                                    <a class="text-blue" href="{{json_decode($mail->user_path)[0]->url}}" target="_blank" class="h6">{{json_decode($mail->user_path)[0]->url}}</a>

                                </div>

                            @endif

                            <div class="col-md-6">
                                @if($mail->user_path)
                                <p class="fw-bold h5">{{trans('panel.user_path')}}:</p>
                                @foreach(json_decode($mail->user_path) as $item)
                                    <div>
                                        <a class="text-blue" href="{{$item->url}}" target="_blank" class="h6">{{$item->url}}</a>
                                    </div>

                                @endforeach
                                    @endif
                            </div>
                    </div>








                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        @endsection

        @push('script')
            <script>

                const statusBtn = document.getElementById('status_btn');
                statusBtn.addEventListener('click', evt =>{
                    document.querySelector('.status_block').classList.toggle('active')
                    document.addEventListener('click',closeStatusModal )
                })

                function closeStatusModal(e) {
                    console.log(e.target.id)
                    if(e.target.id !== 'status_btn' && document.querySelector('.status_block').classList.contains('active')) {
                        document.querySelector('.status_block').classList.remove('active')
                        document.removeEventListener('click',closeStatusModal )
                    }
                }

            </script>
    @endpush

@section('after_styles')

    <style>
        .status_block {
            display: none;
            position: absolute;
            top: -10px;
            left: 70px;
            border-radius: 10px;
            background-color: #efeaea;
            overflow: hidden;
            z-index: 10;
        }
        .status_block.active {
            display:block;
        }

        .status_link {
            display: flex;
            padding: 8px;
            overflow: hidden;
        }
        .status_link.active {
            background-color: #dbd8d8;
        }
        .status_link.active img {
            transform: scale(1.2);
            margin-right: 10px;
        }
        .status_link.active span {
            transform: scale(1.2);
        }
        .status_link:hover {
            background-color: #c9c7c7;
        }
        .status_image {
            width: 25px;
            margin-right: 6px;
        }
    </style>

@endsection
