<form action="{{route('solution.update', $solution->id)}}" method="post" class="w-100" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <input name="items" id='items{{$solution->id}}' type="hidden">

<div class="modal-view__descr modal" id="modal{{$solution->id}}">
    <div class="modal-title__body justify-content-end">

        <button id="close__dialog" class="close__dialog">
            <svg width="800px" height="800px" viewBox="-0.5 0 25 25" fill="black" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 21.32L21 3.32001" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3 3.32001L21 21.32" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg></button>
    </div>
    <div class="modal-body row">
        <div class="col-sm-6">
            <div style="width: 580px; position: relative" id="previewImageContainer{{$solution->id}}">
            <img src="{{url('storage/'.$solution->image)}}" alt="Solution Image" class="modal-body__img">
            </div>
            @foreach($solutionProducts as $key=>$solutionProduct)
                @if($solution->id == $solutionProduct->solution_id)
                    <div class="modal_point d-flex align-items-center justify-content-center" id="modal_point{{$key}}" style="top: {{$solutionProduct->percent_y}}%; left: {{$solutionProduct->percent_x}}%">
                        <span class="text-black " style="z-index: 50">{{$key+1}}</span>
                    </div>
                @endif
            @endforeach
            <div class="row justify-content-end mt-4">
                <div class="col-4">
                    <button type="submit" class="btn btn-primary" onclick="submitHandler()" name="update" value="Save">Save</button>
                </div>
                {{--                        <div class="col-4">--}}
                {{--                            <button class="btn btn-secondary" onclick="submitHandler()" >Save</button>--}}
                {{--                        </div>--}}
            </div>
        </div>

        <div class="modal-body__items col-sm-6">
            @foreach($solutionProducts as $solutionProduct)
                @if($solution->id == $solutionProduct->solution_id)
            <div class="modal-body__items-item modal-item row">
                <div class="col-4">
                    <img src="{{url('storage/'.$solutionProduct->product->image_preview)}}" alt="Product image" class="modal-item__img">

                </div>

                <div class="modal-item__descr col-4">
                    <h3 class="modal-item__descr-title">{{$language->replace($solutionProduct->product->name_ro, $solutionProduct->product->name_ru,$solutionProduct->product->name_en )}}</h3>

                </div>
                <div class="modal-item__actions col-4">
                        <button type="submit" name="delete" value="{{$solutionProduct->product_id}}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                </div>
            </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
</form>

@push('script')
    <script>

        {{--const itemsInput = document.getElementById('items{{$solution->id}}')--}}

        function mousedownEvent( item, j) {
            item.addEventListener('mousedown', (event)=>{
                const el = item;

                var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

                function dragMouseDown(e) {
                    e.preventDefault();
                    pos3 = e.clientX;
                    pos4 = e.clientY;
                    console.log(document.getElementById('previewImageContainer{{$solution->id}}'))
                    document.getElementById('previewImageContainer{{$solution->id}}').onmouseup = closeDragElement;
                    document.getElementById('previewImageContainer{{$solution->id}}').onmousemove = elementDrag;
                }
                dragMouseDown(event)

                function elementDrag(e) {
                   e.preventDefault();
                    // calculate the new cursor position:
                    pos1 = pos3 - e.clientX;
                    pos2 = pos4 - e.clientY;
                    pos3 = e.clientX;
                    pos4 = e.clientY;

                    // set the element's new position:
                    el.style.top = (el.offsetTop - pos2) + "px";
                    el.style.left = (el.offsetLeft - pos1) + "px";
                }

                function closeDragElement() {
                    /* stop moving when mouse button is released:*/

                    const top = el.style.top.replace('px', '')
                    const left = el.style.left.replace('px', '')
                    console.log(top)
                    console.log(left)
                    console.log(el.parentElement.clientHeight)
                    console.log(el.parentElement.clientWidth)

                    items[j]['percent_x'] = Math.round((left *100)/el.parentElement.clientWidth);
                    items[j]['percent_y'] = Math.round((top *100)/el.parentElement.clientHeight);
                    console.log(items)

                    // items[j]['percent_x'] =calcPercentX
                    document.getElementById('previewImageContainer{{$solution->id}}').onmouseup = null;
                    document.getElementById('previewImageContainer{{$solution->id}}').onmousemove = null;
                }
            })

        }

        document.querySelectorAll('.modal_point').forEach((item, key)=>{

            // itemsInput.value = JSON.stringify(mousedownEvent(items, item, key))
            mousedownEvent( item, key)

        })

        function submitHandler() {
            document.getElementById('items{{$solution->id}}').value = JSON.stringify(items)
        }

    </script>
@endpush


@section('after_styles')

    <style>
        {!! Vite::content('resources/sass/style.scss') !!}
    </style>
    <style>

        .modal_point {
            position: absolute;
            display: block;
            cursor: move;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            top: 10%;
            left: 10%;
            background: #ffffff50;
            border-color: #fff;

        }

        .modal_point::after {
            position: absolute;
            display: block;
            content: '';
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #fff;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: .3s ease-in-out;
        }
        .modal_point:hover {
            border: 1px solid #fff;

        }
        .modal_point:hover::after {
            width: 10px;
            height: 10px;
        }


        .modal_point__body {
            position: relative;
            display: none;
            left: 55px;
            /*width: 150px;*/
            background: #ffffff;

        }


        .modal_point__body--info {
            position: relative;
            width: 130px;
            padding: 10px;

        }

        .modal_point__body--info::before {
            content: '';
            position: absolute;
            width: 1px;
            border: 1px solid #d4d4d4;
            height: 80%;
            top: 10px;
            right: 30px;
        }

        /*.modal_point__body--info::after {*/
        /*    position: absolute;*/
        /*    content: '>';*/
        /*    color: #333232;*/
        /*    font-size: 30px;*/
        /*    top: 30%;*/
        /*    right: 5px;*/
        /*}*/
        .modal_point__more_link {
            position: absolute;

            color: #333232;
            font-size: 30px;
            top: 30%;
            right: 5px;
        }

        .modal_point__body--info-title a {
            font-size: 16px;
            color: #333232;
            max-width: 100px;
        }

        .modal_point__body--code {
            margin-top: 20px;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333232;

        }

        .modal_point__body--code span {
            font-family: 'GalanoGrotesque-Bold', sans-serif;
        }

        .modal_point__body--btn a{

            display: block;
            width: 100%;
            font-family: 'GalanoGrotesque-Medium', sans-serif;
            font-size: 14px;
            color: #000;
            background-color: #e8e8e8;
            text-align: center;
            padding: 15px 10px;

        }
    </style>
@endsection
