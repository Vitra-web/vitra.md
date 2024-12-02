<div class="modal__wrapper-offer" id="feedbackModal">
    <form action="{{route('client.feedbackMail')}}" method="post" id="feedbackForm" class="d-flex justify-content-center">
        @csrf
        <div class="modal-offer">
            <div class="modal__close-offer" id="feedbackClose"> <img src="{{asset('images/cancel.svg')}}" alt="cancel" width="15px" height="15px"></div>
            <div class="modal__title-offer text-uppercase">{{trans('labels.feedback_modal_title')}}</div>
            <div class="modal__body-offer">
                <label for="name" class="consultation_modal_label">
                    <input type="text" name="name" placeholder="{{trans('labels.name')}}/{{trans('labels.second_name')}}" id="feedbackName" class="consultation_modal_input">
                    <p class="text_error" id="feedback_name_danger"></p>
                </label>

                <label class="consultation_modal_label">
                    <input type="text" name="email"  placeholder="{{trans('labels.email')}}"  class="consultation_modal_input" id="feedbackEmail">
                    <p class="text_error" id="feedback_email_danger"></p>
                </label>

                <div class="d-flex justify-content-center">
                    <button type="button" id="feedbackSubmitBtn" class="btn custom-btn input-offer__btn">{{trans('labels.send')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('script')
    <script>

    </script>

@endpush
