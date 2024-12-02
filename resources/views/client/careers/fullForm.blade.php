<div class="">
    <p class="career-form__more">{{trans('labels.if_no_cv_we_help')}} </p>
    <div class="add_form_btn_container ">
        <button type="button" onclick="showFullForm()"
                class="custom-btn career-form-btn">{{trans('labels.make_cv')}}</button>
    </div>

    <div class="career-form full-form" id="makeCvForm">
        <form action="{{route('client.vacancyFullMail')}}" method="post" id="vacancyFullForm"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="sex" id="sexInput">
            <input type="hidden" name="phone" id="fullFormPhone">
            <input type="hidden" name="addition_phone" id="fullFormAddPhone">
            <input type="hidden" name="studies" id="fullFormStudies">
            <input type="hidden" name="experiences" id="fullFormExperiences">
            <input type="hidden" name="languages" id="fullFormLanguages">
            <div class="full-form__action">
                <div class="mx-auto mx-sm-0 w-100" style="margin-bottom: 50px;">
                    <div class="full-form-top-container">
                        <div class="">
                            <p class="full-form-photo-label ">{{trans('labels.upload_photo')}}</p>
                            <p class="full-form-photo-limit ">{{trans('labels.photo_limit')}}</p>
                        </div>


                        <div class="full-form-photo-container col-md-6 p-0">
                            <input name="user_photo" type="file" id="upload_photo"
                                   class=" upload_photo transparent-color" required
                                   accept=".png,.jpeg,.webp">
                            <img class="user_photo" src="{{url('images/upload_photo.png')}}" alt="user_photo">
                            <p class="text_error" id="upload_photo_danger"></p>
                        </div>
                    </div>
                </div>


                <div class="row w-100 flex-wrap flex-md-nowrap gap-0 gap-md-3">
                    <div class="col-md-6 p-0">
                        <div class="d-flex flex-column gap-3 align-items-center">

                            @php
                                $vacancyArray = [];

                                foreach ($vacancy as $item) {
                                    $arrayItem = [];
                                    $arrayItem['value']=$item->id;
                                    $arrayItem['text']=$language->replace($item->name_ro, $item->name_ru,$item->name_en );
                                    $vacancyArray[]=$arrayItem;
                                    }
                            @endphp

                            @include('client.components.formElements.select', ['label'=>trans('labels.vacancy').'*', 'name'=>'vacancy_id', 'placeholder'=>trans('labels.choose_vacancy'), 'array'=>$vacancyArray])

                            @include('client.components.formElements.text', ['label'=>trans('labels.name').'*', 'name'=>'name', 'required'=>1, 'placeholder'=>trans('labels.name'), 'margin'=>1])
                            @include('client.components.formElements.text', ['label'=>trans('labels.second_name').'*', 'name'=>'surname', 'required'=>1, 'placeholder'=>trans('labels.second_name'), 'margin'=>1])


                            <div class="row align-items-center w-100">
                                <label for="birthday" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.birthday')}}*
                                </label>
                                <div class="col-md-8 p-0">
                                    <input name="birthday" class="full-form_input col-6 datepicker" id="birthday"
                                           type="text" data-inputmask-alias="dd.mm.yyyy"
                                           value="{{old('birthday')}}"
                                           data-provide="datepicker" placeholder="dd.mm.yyyy">
                                    <p class="text_error" id="birthday_danger"></p>
                                </div>

                            </div>

                            @include('client.components.formElements.text', ['label'=>trans('labels.location').'*', 'name'=>'location', 'required'=>1, 'placeholder'=>trans('labels.city'), 'margin'=>1])


                            <div class="row align-items-center w-100">
                                    <span class="full-form-photo-label col-md-4 ">
                                        {{trans('labels.sex')}}*
                                    </span>
                                <div class="col-md-8 px-0 d-flex justify-content-between">
                                    <button class="custom-btn full-form-btn active" data-sex="1" type="button"
                                            onclick="handleSexButton(this)">
                                        {{trans('labels.man')}}
                                    </button>
                                    <button class="custom-btn full-form-btn" data-sex="2" type="button"
                                            onclick="handleSexButton(this)">
                                        {{trans('labels.woman')}}
                                    </button>
                                </div>
                            </div>

                            @include('client.components.formElements.text', ['label'=>trans('labels.nation').'*', 'name'=>'nation', 'required'=>1, 'placeholder'=>trans('labels.nation'), 'margin'=>1])

                            @include('client.components.formElements.text', ['label'=>' E-mail*', 'name'=>'email', 'required'=>1, 'placeholder'=>trans('labels.email'), 'margin'=>1])


                            <div class="row align-items-center w-100">
                                <label for="user_phone" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.phone')}}*
                                </label>
                                <div class="col-md-8 p-0 position-relative">
                                    <input id="user_phone" type="tel" class="full-form_input col-6 " required>
                                    <p class="text_error" id="user_phone_danger"></p>
                                </div>
                            </div>
                            <div class="addition-phone row align-items-center w-100">
                                <label for="addition_phone" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.phone')}}-2
                                </label>
                                <div class="col-md-8 p-0">
                                    <input id="addition_phone" type="tel" class="full-form_input col-6 ">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <p class="col-sm-6 add_phone" onclick="addPhone()">{{trans('labels.add_phone')}}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-3 align-items-center mt-3">
                            <p class="block_title">{{trans('labels.studies')}}</p>

                            <div class="row align-items-center w-100">
                                <label for="study" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.education')}}
                                </label>
                                <div class="full-form_select-container  col-md-8 p-0">
                                    <select class="full-form_input full-form_select full-form_select_study" id="study">
                                        <option value="0" class="career-form__action-option" disabled
                                                selected>{{trans('labels.choose_education')}}</option>
                                        <option value="Medii"
                                                class="career-form__action-option">{{trans('labels.meedii')}}</option>
                                        <option value="Medii de specialitate"
                                                class="career-form__action-option">{{trans('labels.meedii_specialitate')}}</option>
                                        <option value="Medii incomplete"
                                                class="career-form__action-option">{{trans('labels.meedii_incomplete')}}</option>
                                        <option value="Superioare"
                                                class="career-form__action-option">{{trans('labels.superioare')}}</option>
                                        <option value="Masterat"
                                                class="career-form__action-option">{{trans('labels.masterat')}}</option>
                                    </select>
                                    <p class="text_error" id="study_danger"></p>
                                    <svg width="20px" height="20px" viewBox="0 0 32 32"
                                         xmlns="http://www.w3.org/2000/svg">
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
                                            <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5"
                                                  style="stroke: rgb(0, 0, 0);"></line>
                                        </g>
                                    </svg>
                                </div>
                            </div>

                            <div class="row align-items-center w-100">
                                <label for="country" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.country')}}
                                </label>
                                <div class="col-md-8 p-0">
                                    <input id="country" type="text" class="full-form_input col-6 full-form_country"
                                           placeholder="">
                                    <p class="text_error" id="country_danger"></p>
                                </div>
                            </div>

                            <div class="row align-items-center w-100">
                                <label for="university" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.university')}}
                                </label>
                                <div class="col-md-8 p-0">
                                    <input id="university" type="text"
                                           class="full-form_input col-6 full-form_university" placeholder="">
                                    <p class="text_error" id="university_danger"></p>
                                </div>
                            </div>

                            <div class="row align-items-center w-100">
                                <label for="faculty" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.faculty')}}
                                </label>
                                <div class="col-md-8 p-0">
                                    <input id="faculty" type="text" class="full-form_input col-6 full-form_faculty"
                                           placeholder="">
                                    <p class="text_error" id="faculty_danger"></p>
                                </div>
                            </div>

                            <div class="row align-items-center w-100">
                                <label for="specialisation" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.specialisation')}}
                                </label>
                                <div class="col-md-8 p-0">
                                    <input id="specialisation" type="text"
                                           class="full-form_input col-6 full-form_specialisation" placeholder="">
                                    <p class="text_error" id="specialisation_danger"></p>
                                </div>
                            </div>

                            <div class="row align-items-center w-100">
                                <label for="studyFrom" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.study_period')}}
                                </label>
                                <div class="col-md-8 p-0 d-flex justify-content-between gap-3">
                                    <div>
                                        <input class="full-form_input col-6 studyFrom" id="studyFrom" type="text"
                                               value="{{old('studyFrom')}}"
                                               placeholder="mm.yyyy">
                                        <p class="text_error" id="studyFrom_danger"></p>
                                    </div>
                                    <div>
                                        <input class="full-form_input col-6 studyTill" id="studyTill" type="text"
                                               data-inputmask-alias="mm.yyyy"
                                               value="{{old('studyTill')}}"
                                               data-provide="datepicker" placeholder="mm.yyyy">
                                        <p class="text_error" id="studyTill_danger"></p>
                                    </div>
                                </div>
                            </div>

                            <div id="additionEducation" class="d-flex flex-column gap-3 mt-3">
                            </div>

                            <div class="row">
                                <div class="col-sm-4"></div>
                                <p class="col-sm-6 add_phone" onclick="addStudy()">{{trans('labels.add_study')}}</p>
                            </div>

                        </div>


                    </div>
                    <div class="d-flex flex-column p-0 gap-3 col-md-6 full-form-right position-relative align-items-center">
                        <p class="block_title">{{trans('labels.personal_experience')}}</p>


                        <div class="row align-items-center w-100">
                            <label for="experience" class="full-form-photo-label col-md-4 ">
                                {{trans('labels.experience')}}*
                            </label>
                            <div class="full-form_select-container  col-md-8 p-0">
                                <select class="full-form_input full-form_select full-form_select_experience"
                                        id="experience">
                                    <option value="0" class="career-form__action-option" disabled
                                            selected>{{trans('labels.choose_experience')}}</option>
                                    <option value="Fără"
                                            class="career-form__action-option">{{trans('labels.experience1')}}</option>
                                    <option value="1-3 ani"
                                            class="career-form__action-option">{{trans('labels.experience2')}}</option>
                                    <option value="3-7 ani"
                                            class="career-form__action-option">{{trans('labels.experience3')}}</option>
                                    <option value="7 +"
                                            class="career-form__action-option">{{trans('labels.experience4')}}</option>
                                </select>
                                <p class="text_error" id="experience_danger"></p>
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
                                        <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5"
                                              style="stroke: rgb(0, 0, 0);"></line>
                                    </g>
                                </svg>
                            </div>
                        </div>

                        <div class="row align-items-center w-100">
                            <label for="position" class="full-form-photo-label col-md-4 ">
                                {{trans('labels.position')}}
                            </label>
                            <div class="col-md-8 p-0">
                                <input id="position" type="text" class="full-form_input col-6 full-form_position"
                                       placeholder="">
                            </div>
                        </div>

                        <div class="row align-items-center w-100">
                            <label for="company" class="full-form-photo-label col-md-4 ">
                                {{trans('labels.company')}}
                            </label>
                            <div class="col-md-8 p-0">
                                <input id="company" type="text" class="full-form_input col-6 full-form_company"
                                       placeholder="">
                            </div>
                        </div>
                        <div class="row align-items-center w-100">
                            <label for="activity" class="full-form-photo-label col-md-4 ">
                                {{trans('labels.activity')}}
                            </label>
                            <div class="col-md-8 p-0">
                                <input id="activity" type="text" class="full-form_input col-6 full-form_activity"
                                       placeholder="">
                            </div>
                        </div>


                        <div class="row align-items-center w-100">
                            <label for="ref_name" class="full-form-photo-label col-md-4 ">
                                {{trans('labels.name').' '.trans('labels.second_name')}}
                            </label>
                            <div class="col-md-8 p-0">
                                <input id="ref_name" type="text" class="full-form_input col-6 ref_name">
                            </div>
                        </div>

                        <div class="row align-items-center w-100">
                            <label for="ref_phone" class="full-form-photo-label col-md-4 ">
                                {{trans('labels.ref_phone')}}
                            </label>
                            <div class="col-md-8 p-0 position-relative">
                                <input id="ref_phone" type="tel" class="full-form_input col-6 ref_phone">
                            </div>
                        </div>

                        <div class="row align-items-center w-100">
                            <label for="experience_description" class="full-form-photo-label pt-2 col-md-4 ">
                                {{trans('labels.description')}}
                            </label>
                            <div class="col-md-8 p-0 position-relative">
                                <textarea id="experience_description"
                                          class="full-form_description col-6 experience_description"
                                          placeholder="{{trans('labels.skills_performance')}}" cols="30"
                                          rows="10"></textarea>

                            </div>
                        </div>
                        <div class="addition_experience d-flex flex-column gap-3 w-100" id="additionExperience">
                        </div>
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <p class="col-sm-6 add_phone"
                               onclick="addExperience()">{{trans('labels.add_experience')}}</p>
                        </div>


                        <div class="skills_block">
                            <p class="block_title">{{trans('labels.skills')}}</p>

                            @include('client.components.formElements.text', ['label'=>trans('labels.skills'), 'name'=>'skills', 'required'=>0, 'placeholder'=>'', 'margin'=>1])

                            <div class="row align-items-center w-100">
                                <label for="language1" class="full-form-photo-label col-md-4">
                                    {{trans('labels.languages')}}
                                </label>
                                <div class="col-md-8 p-0 d-flex justify-content-between gap-3">
                                    <div class=" full-form_select-container w-100">
                                        <select class="full-form_input full-form_select select_language" id="language1">
                                            <option value="0" class="career-form__action-option" disabled
                                                    selected>{{trans('labels.language')}}</option>
                                            @foreach($languages as $item)
                                                <option value="{{$item->name_ro}}"
                                                        class="career-form__action-option">{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</option>
                                            @endforeach

                                        </select>
                                        <p class="text_error" id="language_danger"></p>
                                        <svg>
                                            <use href="/images/svg/select-arrow.svg#selectArrow"></use>
                                        </svg>
                                    </div>
                                    <div class=" full-form_select-container w-100">
                                        <select class="full-form_input full-form_select select_level" id="level1">
                                            <option value="0" class="career-form__action-option" disabled
                                                    selected>{{trans('labels.level')}}</option>
                                            <option value="Începător" class="career-form__action-option">{{trans('labels.entry')}}</option>
                                            <option value="Mediu" class="career-form__action-option">{{trans('labels.middle')}}</option>
                                            <option value="Avansat" class="career-form__action-option">{{trans('labels.advanced')}}</option>
                                            <option value="Nativ" class="career-form__action-option">{{trans('labels.native')}}</option>
                                        </select>
                                        <p class="text_error" id="level_danger"></p>
                                        <svg>
                                            <use href="/images/svg/select-arrow.svg#selectArrow"></use>
                                        </svg>
                                    </div>
                                </div>


                            </div>
                            <div id="addLanguages" class="d-flex flex-column align-items-center w-100 gap-3">

                            </div>
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <p class="col-sm-6 add_phone"
                                   onclick="addLanguage()">{{trans('labels.add_language')}}</p>
                            </div>


                            @include('client.components.formElements.text', ['label'=>trans('labels.curse'), 'name'=>'curse', 'required'=>0, 'placeholder'=>'', 'margin'=>0])

                            {{--                            <div id="addCourses">--}}
                            {{--                            </div>--}}

                            {{--                            <div class="row">--}}
                            {{--                                <div class="col-sm-4"></div>--}}
                            {{--                                <p class="col-sm-6 add_phone" onclick="addCourse()">{{trans('labels.add_curse')}}</p>--}}
                            {{--                            </div>--}}



                            @include('client.components.formElements.text', ['label'=>trans('labels.hobby'), 'name'=>'hobby', 'required'=>0, 'placeholder'=>'', 'margin'=>1])

                            <div class="row align-items-center w-100">
                                <label for="language" class="full-form-photo-label col-md-4 ">
                                    {{trans('labels.permis')}}
                                </label>
                                <div class="col-md-8 p-0 full-form_select-container form-group">

                                    <select class="full-form_input full-form_select select2 form-control" id="license"
                                            multiple="multiple" name="license[]">
                                        <option value="Cat. A" class="career-form__action-option">Cat. A</option>
                                        <option value="Cat. B" class="career-form__action-option">Cat. B</option>
                                        <option value="Cat. C" class="career-form__action-option">Cat. C</option>
                                        <option value="Cat. D" class="career-form__action-option">Cat. D</option>
                                        <option value="Cat. E" class="career-form__action-option">Cat. E</option>
                                        <option value="Cat. F" class="career-form__action-option">Cat. F</option>
                                    </select>
                                    <p class="text_error" id="license_danger"></p>
                                    <svg>
                                        <use href="/images/svg/select-arrow.svg#selectArrow"></use>
                                    </svg>


                                </div>

                            </div>

                            <div class="row align-items-center w-100">
                                <label for="skills_description" class="full-form-photo-label pt-2 col-md-4 ">
                                    {{trans('labels.description')}}
                                </label>
                                <div class="col-md-8 p-0 position-relative">
                                    <textarea name="skills_description" id="skills_description"
                                              class="full-form_description col-6 " placeholder="" cols="30"
                                              rows="10"></textarea>

                                    <p class="text_error" id="ref_phone_danger"></p>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>

            <div>
                <div>
                    <div class=" mb-2">
                        <div class=" policy_text">
                            <p>{{trans('labels.full_form_notification')}}</p>
                            <span>{{trans('labels.full_form_notification2')}}</span>
                            <a class="full-form-policy" href="">{{trans('labels.policy')}}</a>
                        </div>

                    </div>


                    <div class="row align-items-center w-100">
                        <div class="career-form__radio col-md-9">
                            <div class="career-form__radio-body">
                                <div>
                                    <label class="checkbox__item ">
                                        <input type="checkbox" name="vacancyNotification" value="1"
                                               class="checkbox__input" id="aboutCheckbox">
                                        <span class="fake"></span>
                                        <span class="checkbox_text">{{trans('labels.accept_policy')}} <a
                                                href="{{route('client.terms')}}" target="_blank"
                                                class="checkbox_link">{{trans('nav.terms')}}</a></span>
                                    </label>
                                    <p class="text_error" id="policy_full_danger"></p>
                                </div>
                                <label class="checkbox__item">
                                    <input type="checkbox" name="vacancyNotification" value="1" class="checkbox__input">
                                    <span class="fake"></span>
                                    <span
                                        class="checkbox_text">{!! trans('labels.want_notifications_vacancy') !!}</span>
                                </label>

                                <label class="checkbox__item">
                                    <input type="checkbox" name="newsNotification" value="1" class="checkbox__input">
                                    <span class="fake"></span>
                                    <span class="checkbox_text">{!! trans('labels.want_notifications_news') !!}</span>
                                </label>

                            </div>

                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <button type="button" onclick="submitFullForm()"
                                    class="career-form-btn custom-btn">{!! trans('labels.send_data') !!}</button>
                        </div>

                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
