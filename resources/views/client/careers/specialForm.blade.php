
<div class="career-form special-form">
    <form action="{{route('client.vacancySpecial')}}" method="post" id="specialForm" class="row align-items-center" enctype="multipart/form-data">
        @csrf
         <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                    <h2 class="special-form__title">{{trans('labels.special_form_title')}}</h2>
         </div>
         <div class="w-100 h-100">
                <div class="special-form-image_container ">
                    <img class="special-form_image" src="{{url('/images/forms/career_page.jpg')}}" alt="Career image">
                </div>
         </div>

         <div class="special-form_right">
            <div class="special-form_action">
                <div class="d-flex flex-column-reverse flex-xxl-row gap-3">
                    <div class="d-flex flex-column w-100 gap-3">
                        <label for="specialisation" class="name-label">
                            <input name="specialisation" type="text" id="specialisationSpecial" class="input-text" placeholder="{{trans('labels.specialisation')}}" value="{{old('specialisation')}}" >

                            <p class="text_error" id="specialisation_special_danger"></p>
                        </label>
                        <label for="docpicker2" class="name-label">
                            <input name="file" type="file" id="docpicker2" class="input-text input-text-upload transparent-color"
                                   accept=".pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <label for="" class="test" id="special-cv-label">{{trans('labels.upload_cv')}}</label>
                            <p class="text_error" id="file_cv_danger"></p>
                        </label>
                    </div>
                    <div class="">
                        <p class="special-form_description">{{trans('labels.special_form_description')}}</p>
                    </div>
                </div>
                 <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-end gap-3">
                     <div class="w-100">
                         <label for="specialMessage" class="name-label">
                             <textarea name="message" type="text" id="specialMessage" class="input-text" placeholder="{{trans('labels.special_form_message_placeholder')}}" ></textarea>
                             <p class="text_error" id="special_message_danger"></p>
                         </label>
                     </div>
                     <div class="">
                         <button type="button" onclick="specialFormSubmit()" class="custom-btn special-form-btn">{{trans('labels.send')}}</button>
                     </div>
                 </div>

                <div>
                    <label class="checkbox__item ">
                        <input type="checkbox"  value="1" class="checkbox__input" id="specialCheckbox">
                        <span class="fake"></span>
                        <span class="checkbox_text">{{trans('labels.accept_policy')}} <a href="{{route('client.terms')}}" target="_blank" class="checkbox_link">{{trans('nav.terms')}}</a></span>
                    </label>
                    <p class="text_error" id="policy_special_danger"></p>
                </div>


            </div>
         </div>

    </form>
</div>
