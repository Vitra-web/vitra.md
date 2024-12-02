<div class="form_block row mb-3 ">
    <h4 class="mb-3">{{$title}}</h4>
    <div class="d-flex form-group col-sm-4">
        <label for="description_ro">
            <img src="{{asset('images/flags/ro.png')}}" width="20px" alt="Romana">
        </label>
        <textarea cols="6" rows="6" class="form-control ml-2" name="description_ro" id="description_ro"  placeholder="{{$placeholder}} Ro" >{!! $valueRo !!}</textarea>
        @error('description_ro')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
    <div class="d-flex form-group col-sm-4">
        <label for="description_ru">
            <img src="{{asset('images/flags/ru.png')}}" width="20px" alt="Russian">

        </label>
        <textarea cols="6" rows="6" class="form-control ml-2" name="description_ru" id="description_ru"   placeholder="{{$placeholder}} Ru" >{!! $valueRu !!}</textarea>
        @error('description_ru')<p class="text-danger"> {{$message}}</p>@enderror
    </div>

    <div class="d-flex form-group col-sm-4">
        <label for="description_en">
            <img src="{{asset('images/flags/gb.png')}}" width="20px" alt="English">

        </label>
        <textarea cols="6" rows="6" class="form-control ml-2" id="description_en" name="description_en"   placeholder="{{$placeholder}} En" >{!! $valueEn !!}</textarea>
        @error('description_en')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
</div>
