<div class="row align-items-center w-100">
    <label for="{{$name}}" class="full-form-photo-label col-md-4 ">
        {{$label}}
    </label>
    <div class="col-md-8 p-0">
        <input id="{{$name}}" name="{{$name}}" type="text" class="full-form_input col-6 " {{$required ==1 ? 'required': ''}} placeholder="{{$placeholder}}" >
        <p class="text_error" id="{{$name}}_danger"></p>
    </div>
</div>
