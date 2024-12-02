<div class="row align-items-center w-100">
    <label for="{{$name}}" class="full-form-photo-label col-md-4 ">
        {{$label}}
    </label>
    <div class="full-form_select-container  col-md-8 p-0">
        <select class="full-form_input full-form_select" id="{{$name}}" name="{{$name}}">
            <option value="0" class="career-form__action-option" disabled selected>{{$placeholder}}</option>
            @foreach($array as $item)
            <option value="{{$item['value']}}" class="career-form__action-option" >{{$item['text']}}</option>
            @endforeach

        </select>
        <p class="text_error" id="{{$name}}_danger"></p>
        <svg width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <style>.cls-1{fill:none;stroke:#cdcbcb;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style>
            </defs>
            <title></title>
            <g id="chevron-top">
                <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5" style="stroke: rgb(0, 0, 0);"></line>
                <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" style="stroke: rgb(0, 0, 0);"></line>
            </g>
        </svg>
    </div>
</div>
