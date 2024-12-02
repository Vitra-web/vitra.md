@extends('layouts.login')

@section('content')

    <div class="type_box ">

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body type_card_body">

                <form action="{{route('client.chooseTypePost')}}" class="type-form__action" method="post">
                    @csrf
                    <input type="hidden" name="user_id" id="userInput">
                    <input type="hidden" name="type" id="typeInput">

                    <p class="type_title">
                        {{trans('labels.type_form_title')}}
                    </p>

                    <div class="type_block_container">
                        <div class="type_block active" data-type="1" onclick="changeType(this)">
                            <p class="type_block_title">{{trans('labels.type_form_name1')}}</p>
                            <p class="type_block_description">{{trans('labels.type_form_description1')}}</p>
                        </div>
                        <div class="type_block" data-type="2" onclick="changeType(this)">
                            <p class="type_block_title">{{trans('labels.type_form_name2')}}</p>
                            <p class="type_block_description">{{trans('labels.type_form_description2')}}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="button" onclick="handleSubmit()" class="type_block_btn">{{trans('labels.type_form_btn')}}</button>
                    </div>

                </form>



            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection


@push('script')
    <script>

        const userId = '{!! $user->id !!}';

        function changeType(el) {
            document.querySelectorAll('.type_block').forEach(item =>{
                item.classList.remove('active')
            })
            el.classList.toggle('active')
        }


        function handleSubmit() {

            document.getElementById('typeInput').value =  document.querySelector('.type_block.active').dataset.type;
            document.getElementById('userInput').value =  userId;

            document.querySelector('.type-form__action').submit();

        }
    </script>
@endpush
