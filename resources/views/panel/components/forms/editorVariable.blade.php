<div class="form_block row mb-3 ">
    <h4 class="mb-3">{{$title}}</h4>
    <div class="row">
        <div class=" col-md-4 form-group mb-3">
            <label for="{{$name}}_ro">
                {{trans('panel.lang_ro')}}
            </label>
            <textarea cols="4" rows="4" class="form-control ml-2 description_editor" name="{{$name}}_ro" id="{{$name}}_ro"  placeholder="{{$placeholder}} Ro" >{!! $valueRo !!}</textarea>

        </div>
        <div class="col-md-4 form-group mb-3">
            <label for="{{$name}}_ru">
                {{trans('panel.lang_ru')}}
            </label>
            <textarea cols="4" rows="4" class="form-control ml-2 description_editor" name="{{$name}}_ru" id="{{$name}}_ru"   placeholder="{{$placeholder}} Ru" >{!! $valueRu !!}</textarea>

        </div>
        <div class="col-md-4 form-group mb-3">
            <label for="{{$name}}_en">
                {{trans('panel.lang_en')}}
            </label>
            <textarea cols="4" rows="4" class="form-control ml-2 description_editor" id="{{$name}}_en" name="{{$name}}_en"   placeholder="{{$placeholder}} En" >{!! $valueEn !!}</textarea>
        </div>
    </div>

</div>

@push('script')
    <script>
        {{--const editorConfig2 = {--}}

        {{--    ckfinder: {--}}
        {{--        uploadUrl: '{{route('ckeditor.upload', ['_token'=>csrf_token()])}}',--}}
        {{--    },--}}
        {{--}--}}
        ClassicEditor.create(document.querySelector('#{{$name}}_ro'), editorConfig)
            .catch(error => {
                console.error(error);
            });
        ClassicEditor.create(document.querySelector('#{{$name}}_ru'), editorConfig)
            .catch(error => {
                console.error(error);
            });
        ClassicEditor.create(document.querySelector('#{{$name}}_en'), editorConfig)
            .catch(error => {
                console.error(error);
            });

    </script>
@endpush
