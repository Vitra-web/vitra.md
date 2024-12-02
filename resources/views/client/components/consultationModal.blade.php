<div class="modal__wrapper-offer">
    <form action="{{route('client.consultation')}}" method="post" class="d-flex justify-content-center">
    <div class="modal-offer">
        <div class="modal__close-offer"> <img src="{{asset('images/cancel.svg')}}" alt="cancel" width="15px" height="15px"></div>
        <div class="modal__title-offer text-uppercase">{{trans('labels.requestConsultation')}}</div>
        <div class="modal__body-offer">
                <input type="text" name="name" placeholder="{{trans('labels.name')}}/{{trans('labels.second_name')}}" required class="input-offer__form">
                <input type="tel" name="phone"  placeholder="{{trans('labels.phone_number')}}" required class="input-offer__form">
                <input type="text" name="email"  placeholder="{{trans('labels.email')}}" required class="input-offer__form">
                <textarea id="Message" name="message"  placeholder="{{trans('labels.message')}}" class="input-offer__form"></textarea>
                <button type="submit" class="btn custom-btn input-offer__btn">{{trans('labels.send')}}</button>
        </div>
    </div>
    </form>
</div>
