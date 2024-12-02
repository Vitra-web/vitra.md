
<input id="description_ro" type="hidden" name="description_ro">
<input id="description_ru" type="hidden" name="description_ru">
<input id="description_en" type="hidden" name="description_en">
<div class="form_block mb-3 ">
    <h4 class="mb-3">{{$title}}</h4>
    <div class=" form-group mb-4">
        <label for="editor_ro">
            {{trans('panel.lang_ro')}}
        </label>
        <trix-editor input="description_ro">{!! $valueRo !!}</trix-editor>
{{--        <textarea cols="6" rows="6" class="form-control editor ml-2 mt-2" name="description_ro" id="editor_ro"  placeholder="{{$placeholder}} Ro" >{{$valueRo}}</textarea>--}}
        @error('description_ro')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
    <div class=" form-group mb-4">
        <label for="editor_ru">
            {{trans('panel.lang_ru')}}
        </label>
        <trix-editor input="description_ru">{!! $valueRu !!}</trix-editor>
{{--        <textarea cols="6" rows="6" class="form-control editor ml-2 mt-2" name="description_ru" id="editor_ru"   placeholder="{{$placeholder}} Ru" >{{$valueRu}}</textarea>--}}
        @error('description_ru')<p class="text-danger"> {{$message}}</p>@enderror
    </div>

    <div class=" form-group ">
        <label for="editor_en">
            {{trans('panel.lang_en')}}
        </label>
        <trix-editor input="description_en">{!! $valueEn !!}</trix-editor>
{{--        <textarea cols="6" rows="6" class="form-control editor ml-2 mt-2" id="editor_en" name="description_en"   placeholder="{{$placeholder}} En" >{{$valueEn}}</textarea>--}}
        @error('description_en')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
</div>
