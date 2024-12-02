@extends('layouts.cabinet')

@section('content')

        <div class="" >
            <div class="welcome_block cabinet_block">
                <p class="welcome_block_title">
                    <span>{{trans('cabinet.welcome')}}</span>
                    <span>{{$user->name}}!</span>
                </p>
                <div class="welcome_block_description">
                    <p>{{trans('cabinet.welcome_text1')}}</p>
                    <p>{{trans('cabinet.welcome_text2')}}</p>
                </div>

            </div>
            <div class="status_block cabinet_block">
                <p class="status_block_title">
                   {{$user->type ==1 ? trans('cabinet.status_individual'): trans('cabinet.status_juridic')}}
                </p>

                <p class="status_block_description">
                    {{trans('cabinet.status_description')}}
                </p>
                <ul class="status_block_list row">
                    <li class="status_block_item col-sm-4">
                        <div class="d-flex justify-content-center">
                            <img src="{{url('/images/cabinet/order.png')}}" alt="" class="status_block_image">
                        </div>
                        <p class="status_block_item_title">{{trans('cabinet.status_item_title1')}}</p>
                        <p class="status_block_item_description">{{trans('cabinet.status_item_description1')}}</p>
                    </li>
                    <li class="status_block_item col-sm-4">
                        <div class="d-flex justify-content-center">
                            <img src="{{url('/images/cabinet/cont.png')}}" alt="" class="status_block_image">
                        </div>
                        <p class="status_block_item_title">{{trans('cabinet.status_item_title2')}}</p>
                        <p class="status_block_item_description">{{trans('cabinet.status_item_description2')}}</p>
                    </li>
                    <li class="status_block_item col-sm-4">
                        <div class="d-flex justify-content-center">
                            <img src="{{url('/images/cabinet/favorite.png')}}" alt="" class="status_block_image">
                        </div>
                        <p class="status_block_item_title">{{trans('cabinet.status_item_title3')}}</p>
                        <p class="status_block_item_description">{{trans('cabinet.status_item_description3')}}</p>
                    </li>
                </ul>

            </div>

        </div>





@endsection

@push('script')

    <script>



    </script>

@endpush
