<div class="career-form ">
    <div class=" career-form__container">
        <form action="{{route('client.vacancyMail')}}" method="post" id="careerFormCv" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="phone" id="cvFormPhone">

            <div class="career-form__action">
                <div class="career-form__radio">

                    <div class="career-form__action-select-container">
                        <select class="career-form__action-select" name="vacancy_id" id="vacancyCv">
                            <option value="0" class="career-form__action-option" disabled
                                    selected>{{trans('labels.choose_vacancy')}}</option>
                            @foreach($vacancy as $item)
                                <option value="{{$item->id}}"
                                        class="career-form__action-option">{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</option>
                            @endforeach
                        </select>

                        <svg width="20px" height="20px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <style>.cls-1 {
                                        fill: none;
                                        stroke: #cdcbcb;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                        stroke-width: 2px;
                                    }</style>
                            </defs>
                            <title></title>
                            <g id="chevron-top">
                                <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5"
                                      style="stroke: rgb(0, 0, 0);"></line>
                                <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5" style="stroke: rgb(0, 0, 0);"></line>
                            </g>
                        </svg>
                        <p class="text_error" id="vacancy_cv_danger"></p>
                    </div>

                    <label for="name" class="name-label">
                        <input id="name" name="name" type="text" class="input-text"
                               placeholder="{{trans('labels.name')}} {{trans('labels.second_name')}}*">
                        <p class="text_error" id="name_danger"></p>
                    </label>

                    <div class="career-form__radio-body">
                        <div>
                            <label class="checkbox__item ">
                                <input type="checkbox" value="1" class="checkbox__input" id="cvFormCheckbox">
                                <span class="fake"></span>
                                <span class="checkbox_text">{{trans('labels.accept_policy')}} <a
                                        href="{{route('client.terms')}}" target="_blank"
                                        class="checkbox_link">{{trans('nav.terms')}}</a></span>
                            </label>
                            <p class="text_error" id="policy_cv_danger"></p>
                        </div>
                        <label class="checkbox__item">
                            <input type="checkbox" name="vacancyNotification" value="1" class="checkbox__input" id="vacancyCvCheckbox">
                            <span class="fake"></span>
                            <span class="checkbox_text">{!! trans('labels.want_notifications_vacancy') !!}</span>
                        </label>
                        <label class="checkbox__item">
                            <input type="checkbox" name="newsNotification" value="1" class="checkbox__input" id="newsCvCheckbox">
                            <span class="fake"></span>
                            <span class="checkbox_text">{!! trans('labels.want_notifications_news') !!}</span>
                        </label>
                    </div>

                </div>
            </div>

            <div class="career-form__action">

                <label for="phone" class="name-label">
                    <input id="phone" type="tel" class="input-text">
                    <p class="text_error" id="phone_danger"></p>
                </label>
                <label for="email" class="name-label">
                    <input id="email" name="email" type="text" class="input-text"
                           placeholder="{{trans('labels.email')}}*">
                    <p class="text_error" id="email_danger"></p>
                </label>
                {{--                <div class="career-upload-btn-container">--}}
                <label for="cv" class="name-label">
                    <input name="file" type="file" id="docpicker" class="input-text input-text-upload transparent-color"
                           accept=".pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    <label for="" class="test" id="cv-label">{{trans('labels.upload_cv')}}</label>
                    <p class="text_error" id="file_danger"></p>
                </label>

                {{--                </div>--}}

            </div>

            <div class="career-form__action cv_form_btn">
                <span class="career-form__action_text">{!! trans('labels.search_talent') !!}</span>
                <button type="button" onclick="submitCVForm()" class="career-form-btn custom-btn">{!! trans('labels.send_data') !!}</button>
            </div>

            <div class="career-form__action cv_form_img">
                <img class="special-form_image" src="{{url('/images/forms/CVform.svg')}}" alt="Career image">
            </div>
        </form>

    </div>
</div>
