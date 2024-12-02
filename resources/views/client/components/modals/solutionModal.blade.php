
<div class="modal-view__descr modal" id="modal{{$solution->id}}">
    <div class="modal-title__body">
        <h4 class="modal-title">
            {{trans('labels.solution_modal_title')}}
        </h4>
        <button id="close__dialog" class="close__dialog">

            <svg width="800px" height="800px" viewBox="-0.5 0 25 25" fill="black" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 21.32L21 3.32001" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3 3.32001L21 21.32" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg></button>
    </div>
    <div class="modal-body row">
        <div class="col-lg-6 position-relative">
            <img src="{{url('storage/'.$solution->image)}}" alt="Solution Image" class="modal-body__img">
            @foreach($solutionProducts as $key=>$solutionProduct)
                @if($solution->id == $solutionProduct->solution_id)

                    @include('client.components.point', ['solutionProduct'=>$solutionProduct])

                @endif
            @endforeach

        </div>

        <div class="modal-body__items col-lg-6">
            @foreach($solutionProducts as $solutionProduct)
                @if($solution->id == $solutionProduct->solution_id && isset($solutionProduct->product->id))
            <div class="modal-body__items-item modal-item row">
                <div class="col-4">
                    <img src="{{url('storage/'.$solutionProduct->product->image_preview)}}" alt="Product image" class="modal-item__img">
                </div>

                <div class="modal-item__descr col-4">
                    <h3 class="modal-item__descr-title">{{$language->replace($solutionProduct->product->name_ro, $solutionProduct->product->name_ru,$solutionProduct->product->name_en )}}</h3>
{{--                    <p class="modal-item__decr-text">Lorem, ipsum.</p>--}}
                    <p class="modal-item__descr-price"><strong>{{$solutionProduct->product->price}}</strong> <span class="modal-item__descr-price-currency">lei</span></p>
                </div>
                <div class="modal-item__actions col-4">
                    <button class="modal-item__actions-like">
                        <img  src="/images/heart.png" alt="favorite icon">
{{--                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon pip-btn__icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.4372 4h3.1244l.2922.4801 3.3574 5.517h5.0694l-.3104 1.2425L21.5303 13h-2.0615l.2506-1.0029H4.2808l1.3106 5.2426a1 1 0 0 0 .9702.7574H15v2H6.5616c-1.3766 0-2.5766-.9369-2.9105-2.2724L2.03 11.2397l-.3107-1.2426H6.788l3.357-5.517L10.4372 4zm2.0003 2L14.87 9.9971H9.1291L11.5614 6h.8761zm5.5586 10v-2h2v2h2v2h-2v2h-2v-2h-2v-2h2z"></path></svg>--}}
                    </button>

                    <button class="product-card__price-cart" onclick="addToBasket({{$solutionProduct->product->id}})">
                        <img src="/images/cart_black.svg" alt="cart">
                    </button>


{{--                    <button class="modal-item__actions-cart">--}}
{{--                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon pip-btn__icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.205 5.599c.9541.954 1.4145 2.2788 1.4191 3.6137 0 3.0657-2.2028 5.7259-4.1367 7.5015-1.2156 1.1161-2.5544 2.1393-3.9813 2.9729L12 20.001l-.501-.3088c-.9745-.5626-1.8878-1.2273-2.7655-1.9296-1.1393-.9117-2.4592-2.1279-3.5017-3.5531-1.0375-1.4183-1.8594-3.1249-1.8597-4.9957-.0025-1.2512.3936-2.5894 1.419-3.6149 1.8976-1.8975 4.974-1.8975 6.8716 0l.3347.3347.336-.3347c1.8728-1.8722 4.9989-1.8727 6.8716 0zm-7.2069 12.0516c.6695-.43 1.9102-1.2835 3.1366-2.4096 1.8786-1.7247 3.4884-3.8702 3.4894-6.0264-.0037-.849-.2644-1.6326-.8333-2.2015-1.1036-1.1035-2.9413-1.0999-4.0445.0014l-1.7517 1.7448-1.7461-1.7462c-1.1165-1.1164-2.9267-1.1164-4.0431 0-1.6837 1.6837-.5313 4.4136.6406 6.0156.8996 1.2298 2.0728 2.3207 3.137 3.1722a24.3826 24.3826 0 0 0 2.0151 1.4497z"></path></svg>--}}
{{--                    </button>--}}
                </div>
            </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

