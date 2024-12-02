<div class="form_block row mb-3 ">
    <h4 class="mb-3">{{$title}}</h4>
    <div class=" form-group mb-3">
        <label for="description_ro">
            {{trans('panel.lang_ro')}}
        </label>

        <textarea cols="6" rows="6" class="form-control ml-2 description_editor" name="description_ro" id="description_ro"  placeholder="{{$placeholder}} Ro" >{{$valueRo}}</textarea>
        @error('description_ro')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
    <div class="form-group mb-3">
        <label for="description_ru">
            {{trans('panel.lang_ru')}}
        </label>
        <textarea cols="6" rows="6" class="form-control ml-2 description_editor" name="description_ru" id="description_ru"   placeholder="{{$placeholder}} Ru" >{{$valueRu}}</textarea>
        @error('description_ru')<p class="text-danger"> {{$message}}</p>@enderror
    </div>

    <div class=" form-group mb-3">
        <label for="description_en">
            {{trans('panel.lang_en')}}
        </label>
        <textarea cols="6" rows="6" class="form-control ml-2 description_editor" id="description_en" name="description_en"   placeholder="{{$placeholder}} En" >{{$valueEn}}</textarea>
        @error('description_en')<p class="text-danger"> {{$message}}</p>@enderror
    </div>
</div>

@push('script')
<script type="module">

    // import { GeneralHtmlSupport } from '../../../../../node_modules/@ckeditor/ckeditor5-html-support';


    ClassicEditor.create(document.querySelector('#description_ro'), editorConfig)
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#description_ru'), editorConfig)
        .catch(error => {
            console.error(error);
        });
    ClassicEditor.create(document.querySelector('#description_en'), editorConfig)
        .catch(error => {
            console.error(error);
        });

</script>
@endpush
