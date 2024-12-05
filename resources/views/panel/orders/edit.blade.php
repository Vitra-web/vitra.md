@extends('layouts.admin')

@section('content')

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a href="{{route('orders')}}" class="btn btn-secondary" >
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
                    <form action="{{route('order.update', $order->id)}}" method="post" class="w-100" enctype="multipart/form-data">
                        @csrf
                        @method('patch')


                                <div class="form_block row mb-3">
                                    <div class="form-group col-6 col-sm-2">
                                        <label class="pl-3" for="status">{{trans('panel.status')}}</label>
                                        <select class="custom-select form-control" name="status" id="status" >
                                            <option value="viewed" {{$order->status == 'viewed' ? 'selected' : ''}}>{{trans('panel.status_view')}}</option>
                                            <option value="work" {{$order->status == 'work' ? 'selected' : ''}}>{{trans('panel.status_work')}}</option>
                                            <option value="offer" {{$order->status == 'offer' ? 'selected' : ''}}>{{trans('panel.status_offer')}}</option>
                                            <option value="won" {{$order->status == 'won' ? 'selected' : ''}}>{{trans('panel.status_won')}}</option>
                                            <option value="visit" {{$order->status == 'visit' ? 'selected' : ''}}>{{trans('panel.status_visit')}}</option>
                                            <option value="lost" {{$order->status == 'lost' ? 'selected' : ''}}>{{trans('panel.status_lost')}}</option>
                                        </select>
                                    </div>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role_id != 3)
                                        <div class="form-group ms-3 col-6 col-sm-3">
                                            <label class="pl-3" for="manager_id">{{trans('panel.managers')}}</label>
                                            <select class="custom-select form-control" name="manager_id" id="manager_id" >
                                                <option value="" >{{trans('panel.select_manager')}}</option>
                                                @foreach($managers as $item)
                                                    <option value="{{$item->id}}" {{$order->manager_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group col-6 col-sm-3">
                                        <label class="pl-3" for="paymentType">{{trans('panel.payment_type')}}</label>
                                        <select class="custom-select form-control" name="paymentType" id="paymentType" >
                                            <option value="1" {{$order->paymentType == 1 ? 'selected' : ''}}>{{trans('panel.payment_card')}}</option>
                                            <option value="2" {{$order->paymentType == 2 ? 'selected' : ''}}>{{trans('panel.payment_transfer')}}</option>
                                            <option value="3" {{$order->paymentType == 3 ? 'selected' : ''}}>{{trans('panel.payment_cash')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6 col-sm-3">
                                        <label class="pl-3" for="deliveryType">{{trans('panel.delivery_type')}}</label>
                                        <select class="custom-select form-control" name="deliveryType" id="deliveryType" >
                                            <option value="1" {{$order->deliveryType == 1 ? 'selected' : ''}}>{{trans('panel.delivery_vitra')}}</option>
                                            <option value="2" {{$order->deliveryType == 2 ? 'selected' : ''}}>{{trans('panel.delivery_nova')}}</option>
                                            <option value="3" {{$order->deliveryType == 3 ? 'selected' : ''}}>{{trans('panel.delivery_pickup')}}</option>
                                        </select>
                                    </div>
                                    @if($order->paymentType == 1)
                                    <div class="col-sm-3 d-flex align-items-center justify-content-between">
                                        <a href="{{route('order.check', $order->id)}}" class="btn btn-outline-primary">{{trans('panel.check_payment')}}</a>
{{--                                        <a href="{{route('order.return', $order->id)}}" onclick="return confirm('Вы действительно хотите осуществить возврат?');" class="btn btn-outline-danger">Return achitare</a>--}}
                                    </div>
                                    @endif
                                </div>

                        <div class="form_block mb-3 ">
                            <h3>{{trans('panel.personal_data')}}</h3>
                            <div class="mb-4 row">
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">{{trans('panel.name')}}</p>
                                    <p class="h5">{{$order->name.' '.$order->surname}}</p>
                                </div>
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">Email</p>
                                    <p class="h5">{{$order->email}}</p>
                                </div>
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">{{trans('panel.phone')}}</p>
                                    <p class="h5">{{$order->phone}}</p>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">{{trans('panel.location')}}</p>
                                    <p class="h5">{{$order->location}}</p>
                                </div>
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">{{trans('panel.address')}}</p>
                                    <p class="h5">{{$order->address}}</p>
                                </div>
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">{{trans('panel.comment')}}</p>
                                    <p class="h5">{{$order->comment}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="form_block mb-3 ">
                            <h3>{{trans('panel.order_data')}}</h3>
                            <div class="mb-4 row">
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">{{trans('panel.products_price')}}</p>
                                    <p class="h5">{{$order->priceProducts}} MDL</p>
                                </div>
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">{{trans('panel.delivery_price')}}</p>
                                    <p class="h5">{{$order->priceDelivery}} MDL</p>
                                </div>
                                <div class="form-group col-sm-3">
                                    <p class="fw-bold h5 mr-3">{{trans('panel.order_total')}}</p>
                                    <p class="h5">{{$order->priceTotal}} MDL</p>
                                </div>
                            </div>

                            @if($order->paymentType == 2)
                                <div class="mb-4 row">
                                    <div class="form-group col-sm-3">
                                        <p class="fw-bold h5 mr-3">Tip personă juridică</p>
                                        <p class="h5">{{$order->juridic_type == 1 ? 'Nu este plătitor TVA': 'Este plătitor TVA'}} </p>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <p class="fw-bold h5 mr-3">Nume firmă</p>
                                        <p class="h5">{{$order->company_name}}</p>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <p class="fw-bold h5 mr-3">Adresă juridică</p>
                                        <p class="h5">{{$order->juridic_address}} </p>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <p class="fw-bold h5 mr-3">Adresă fizică</p>
                                        <p class="h5">{{$order->phisical_address}}</p>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <p class="fw-bold h5 mr-3">Cod fiscal</p>
                                        <p class="h5">{{$order->fiscal_code }} </p>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <p class="fw-bold h5 mr-3">Denumirea băncii</p>
                                        <p class="h5">{{$order->bank_name}}</p>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <p class="fw-bold h5 mr-3">Codul băncii</p>
                                        <p class="h5">{{$order->bank_code}} </p>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <p class="fw-bold h5 mr-3">IBAN</p>
                                        <p class="h5">{{$order->iban}}</p>
                                    </div>
                                </div>
                                @endif

                            <table class="table table-hover text-nowrap w-100 " id="productsTable" >
                                <thead>
                                <tr>
                                    <th>{{trans('panel.image')}}</th>
                                    <th>{{trans('panel.name')}}</th>
                                    <th>{{trans('panel.code')}} </th>
                                    <th>{{trans('panel.dimensions')}} </th>
                                    <th>{{trans('panel.product_variant')}} </th>
                                    <th>{{trans('panel.quantity')}} </th>
                                    <th>{{trans('panel.price')}}</th>
                                    <th>{{trans('panel.total_price')}}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $item)



                                    <tr>
                                        <td>
                                            <img src="{{url('storage/'.$item->product->image_preview) }}" width="70px" alt="">
                                        </td>
                                        <td>
                                            <a href=" {{route('client.product', [$item->product->categoryId, $item->product->subcategoryId, $item->product->slug ])}}" target="_blank">{{$item->product->name_ro }}</a>
                                            </td>
                                        <td> {{ $item->product->code_1c}}</td>
                                        <td> {{ $item->product->dimension}}</td>
                                        <td>
                                        @if(isset($item->product_moduline) && isset($item->product_variant))
                                        @if($item->product_moduline)
                                                <div class="item__text">
                                                    <p class="item__label ">{{trans('labels.dimensions')}}: </p>
                                                    <p class="item__value">{{$item->product_moduline->travers_height.'x'.$item->product_moduline->travers_width.'x'.$item->product_moduline->travers_depth}}</p>
                                                </div>

                                                <div
                                                    class="item__text">
                                                    <p class="item__label ">{{trans('labels.color')}}: </p>
                                                    <p class="item__value"> {{$item->product_moduline->travers_color}}</p>
                                                </div>

                                                <div
                                                    class="item__text">
                                                    <p class="item__label ">{{trans('labels.type')}}: </p>
                                                    <p class="item__value"> {!! $language->replace($item->product_moduline->shelves_type_ro, $item->product_moduline->shelves_type_ru,$item->product_moduline->shelves_type_en ) !!}</p>
                                                </div>

                                                <div
                                                    class="item__text">
                                                    <p class="item__label ">{{trans('labels.color_shelf')}}: </p>
                                                    <p class="item__value"> {{$item->product_moduline->shelves_color}}</p>
                                                </div>

                                                <div
                                                    class="item__text">
                                                    <p class="item__label ">{{trans('labels.shelf_quantity')}}: </p>
                                                    <p class="item__value"> {{$item->product_moduline->shelves_number}}</p>
                                                </div>

                                            @elseif($item->product_variant)
                                                <div class="item__text">
                                                    <p class="item__label ">{{trans('labels.type')}}: </p>
                                                    <p class="item__value"> {!! $language->replace($item->product_variant->type_ro, $item->product_variant->type_ru,$item->product_variant->type_en ) !!}</p>
                                                </div>
                                                <div class="item__text">
                                                    <p class="item__label ">{{trans('labels.color')}}: </p>
                                                    <p class="item__value"> {!! $item->product_variant->color_name !!}</p>
{{--                                                    <p class="item__value"> {!! $language->replace($item->product_variant->color_name_ro, $item->product_variant->color_name_ru,$item->product_variant->color_name_en ) !!}</p>--}}
                                                </div>
                                            @endif
                                           @endif
                                        </td>
                                        <td> {{$item->quantity}}</td>
                                        <td> {{$item->product->price}}</td>
                                        <td> {{$item->product->price * $item->quantity}}</td>




                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>


                        <div class="form-group text-center">
                            <input type="submit" class="btn btn-primary" value="{{trans('panel.save')}}">
                        </div>
                    </form>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        @endsection

        @push('script')

            <style>
                .item__text {
                    display: flex;
                }
                .item__label {
                    font-weight: bold;
                    margin-right: 4px;
                }


            </style>
    @endpush


@section('after_styles')

    <style>

    </style>

@endsection
