<div class="modal__wrapper-offer">

    <form action="{{route('client.consultation')}}" method="post" id="consultationModal" class="d-flex justify-content-center">

        @csrf

        <input type="hidden" name="phone" id="consultationPhoneInput">
        <input type="hidden" name="product_id" id="consultationProductId">

    <div class="modal-offer">

        <div class="modal__close-offer"> <img src="{{asset('images/cancel.svg')}}" alt="cancel" width="15px" height="15px"></div>

        <div class="modal__title-offer text-uppercase">{{trans('labels.requestConsultation')}}</div>

        <div class="modal__body-offer">

            <label for="name" class="consultation_modal_label">

                <input type="text" name="name" placeholder="{{trans('labels.name')}}/{{trans('labels.second_name')}}" id="consultationName" class="consultation_modal_input">

                <p class="text_error" id="consultation_name_danger"></p>

            </label>

            <label class="consultation_modal_label">

                <input type="tel"  id="consultationPhone"  class="consultation_modal_input" >

                <p class="text_error" id="consultation_phone_danger"></p>

            </label>

            <label class="consultation_modal_label">

                <input type="text" name="email"  placeholder="{{trans('labels.email')}}"  class="consultation_modal_input" >

                <p class="text_error" id="consultation_email_danger"></p>

            </label>



            <label class="consultation_modal_label">

                 <textarea id="Message" name="message"  placeholder="{{trans('labels.message')}}" class="consultation_modal_input consultation_modal_description"></textarea>

                <p class="text_error" id="consultation_description_danger"></p>

            </label>

            <div class="d-flex justify-content-center">

                <button type="button" onclick="consultationSubmit()" class="btn custom-btn input-offer__btn">{{trans('labels.send')}}</button>

            </div>



        </div>

    </div>

    </form>

</div>



@push('script')

    <script>

        let iti = null;



        $(document).ready(function() {

            iti = phoneCountryHandler('#consultationPhone')



            const success = '{{ isset($success) ? true : '' }}';

            if(success) {

                showToast('Datele au fost trimise', 'success')

            }



        });



        function consultationSubmit() {

            const name =document.getElementById('consultationName');

            const nameDanger =document.getElementById('consultation_name_danger');

            const phone =document.getElementById('consultationPhone');

            const phoneDanger =document.getElementById('consultation_phone_danger');



            checkInputField(name,nameDanger, '{{trans('labels.form_name_error')}}')

            checkInputField(phone,phoneDanger, '{{trans('labels.form_phone_error')}}')



            if(name.value !== '' && phone.value !== '' ) {

                document.getElementById('consultationPhoneInput').value = iti.getNumber()





                // console.log(document.getElementById('cvFormPhone').value)

                document.getElementById('consultationModal').submit();

            }

        }

    </script>

@endpush

