<div class="img_point_container" style="top: {{$solutionProduct->percent_y}}%; left: {{$solutionProduct->percent_x}}%; ">
    @if(isset($solutionProduct->product->id))
    <div class="img_point " id="img_point{{$key}}" >
        <div class="img_point__body point__body_left" >
            <div class="img_point__body--info" >
                <h4 class="img_point__body--info-title">
                    <a href="/product/{{$solutionProduct->product->categoryId}}/{{$solutionProduct->product->subcategoryId}}/{{$solutionProduct->product->slug}}"> {{$language->replace($solutionProduct->product->name_ro, $solutionProduct->product->name_ru,$solutionProduct->product->name_en )}}</a>
                </h4>
                <div class="img_point__body--code">
                    <p>{{trans('labels.product_code')}}: </p>
                    <p class="bold">{{$solutionProduct->product->code_1c}}</p>
                    <a href="/product/{{$solutionProduct->product->id}}/{{$solutionProduct->product->subcategoryId}}" class="img_point__more_link">
                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                    </a>
                </div>
                <a class="img_point_price" href="/product/{{$solutionProduct->product->categoryId}}/{{$solutionProduct->product->subcategoryId}}/{{$solutionProduct->product->slug}}" style="color:#333232">{{$solutionProduct->product->price > 100000 ? trans('labels.ascConsultation') : $solutionProduct->product->price.' MDL' }}</a>
            </div>
        </div>
    </div>
     @endif
</div>

{{--{{$solutionProduct->percent_x < 50 ? 'point__body_left': 'point__body_right'}}--}}

{{--{{$solutionProduct->percent_x < 50 ? 'left: 30px': 'left: -150px'}}--}}

{{--<div class="img_point_container" style="top: {{$solutionProduct->percent_y}}%; left: {{$solutionProduct->percent_x}}%">--}}
{{--    <div class="img_point d-flex align-items-center justify-content-center" id="img_point{{$key}}" >--}}
{{--        <div class="img_point__body" style="{{$solutionProduct->percent_x < 50 ? 'left: 92px': 'left: -92px'}}">--}}
{{--            <div class="img_point__body--info" style="">--}}
{{--                <h4 class="img_point__body--info-title">--}}
{{--                    <a href=""> {{$language->replace($solutionProduct->product->name_ro, $solutionProduct->product->name_ru,$solutionProduct->product->name_en )}}</a>--}}
{{--                </h4>--}}
{{--                <div class="img_point__body--code">--}}
{{--                    <p>Cod Produs: </p>--}}
{{--                    <p class="bold">{{$solutionProduct->product->code_1c}}</p>--}}
{{--                </div>--}}
{{--                <a href="" class="img_point__more_link">--}}
{{--                    <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="img_point__body--btn">--}}
{{--                <a href="" style="color:#333232">{{$solutionProduct->product->price > 100000 ? trans('labels.ascConsultation') : $solutionProduct->product->price.' MDL' }}</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
