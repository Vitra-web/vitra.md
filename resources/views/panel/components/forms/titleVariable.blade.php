
<div class="form_block row mb-3 ">
    <h4 class="mb-3">{{$title}}</h4>
    <div class="d-flex form-group col-sm-4">
        <label for="title_ro{{$id}}">
            <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
         </label>
        <input type="text" class="form-control ml-2" name=`title_ro{{$id}}`  id="title_ro{{$id}}" placeholder="{{$placeholder}} Ro" value="{{$valueRo}}">

    </div>
    <div class="d-flex form-group col-sm-4">
        <label for="title_ru{{$id}}">
            <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">
        </label>
        <input type="text" class="form-control ml-2" name="title_ru{{$id}}" id="title_ru{{$id}}" placeholder="{{$placeholder}} Ru" value="{{$valueRu}}">

    </div>

    <div class="d-flex form-group col-sm-4">
        <label for="title_en{{$id}}">
            <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">
        </label>
        <input type="text" class="form-control ml-2" name="title_en{{$id}}" id="title_en{{$id}}" placeholder="{{$placeholder}} En" value="{{$valueEn}}">

    </div>
</div>
