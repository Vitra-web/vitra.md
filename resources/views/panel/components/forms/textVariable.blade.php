
<div class="form_block row mb-3 ">
    <h4 class="mb-3">{{$title}}</h4>
    <div class="d-flex form-group col-sm-4">
        <label for="{{$name}}_ro">
            <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
         </label>
        <input type="text" class="form-control ml-2" name="{{$name}}_ro"  id="{{$name}}_ro" placeholder="{{$placeholder}} Ro" value="{{$valueRo}}">
        @error($name.'_ro')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
    <div class="d-flex form-group col-sm-4">
        <label for="{{$name}}_ru">
            <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">
        </label>
        <input type="text" class="form-control ml-2" name="{{$name}}_ru" id="{{$name}}_ru" placeholder="{{$placeholder}} Ru" value="{{$valueRu}}">
        @error($name.'_ru')<p class="text-danger"> {{$message}}</p>@enderror
    </div>

    <div class="d-flex form-group col-sm-4">
        <label for="{{$name}}_en">
            <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">
        </label>
        <input type="text" class="form-control ml-2" name="{{$name}}_en" id="{{$name}}_en" placeholder="{{$placeholder}} En" value="{{$valueEn}}">
        @error($name.'_en')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
</div>
