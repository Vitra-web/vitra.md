
<div class="form_block row mb-3 ">
    <h4 class="mb-3">{{$title}}</h4>
    <div class="d-flex form-group col-sm-4">
        <label for="name_ro">
            <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
         </label>
        <input type="text" class="form-control ml-2" name="name_ro"  id="name_ro" placeholder="{{$placeholder}} Ro" value="{{$valueRo}}">
        @error('name_ro')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
    <div class="d-flex form-group col-sm-4">
        <label for="name_ru">
            <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">
        </label>
        <input type="text" class="form-control ml-2" name="name_ru" id="name_ru" placeholder="{{$placeholder}} Ru" value="{{$valueRu}}">
        @error('name_ru')<p class="text-danger"> {{$message}}</p>@enderror
    </div>

    <div class="d-flex form-group col-sm-4">
        <label for="name_en">
            <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">
        </label>
        <input type="text" class="form-control ml-2" name="name_en" id="name_en" placeholder="{{$placeholder}} En" value="{{$valueEn}}">
        @error('name_en')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
</div>
