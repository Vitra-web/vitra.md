@extends('layouts.client')

@section('content')
    <main>
        <section class="mainindustry-section">
            <div class=" main_slider_block "
                 style="background-position: center; background-image: url({{url('storage/'.$careersPage->image)}});">
                <h1 class="mainindustry-section__title text-uppercase ">{{$title}}</h1>
            </div>
        </section>
        @include('client.components.breadСrumbs')
        <section class="career-descr">
            <div class="custom-container career-descr__container">
                <div class="career-descr__body career-body row">
                    <div class="career-body__description-block col-md-5">
                        <h3 class="career-body__title">{{$language->replace($careersPage->description_title_ro, $careersPage->description_title_ru,$careersPage->description_title_en )}}</h3>
                        <div
                            class="career-body__description">{!! $language->replace($careersPage->description_ro, $careersPage->description_ru,$careersPage->description_en ) !!} </div>
                    </div>
                    <div class="career-body__img col-md-7">
                        <img src="{{url('storage/'.$careersPage->image_second)}}" alt="Vitra"
                             class="career-body__img-img">
                    </div>
                </div>
            </div>
        </section>

        {{--    <section class="career-join__section career-join">--}}
        {{--        <div class="custom-container career-join__container">--}}
        {{--            <h3 class="career-join__title career-body__title">{!! $language->replace($careersPage->title_second_ro, $careersPage->title_second_ru,$careersPage->title_second_en ) !!}</h3>--}}
        {{--            <div class="career-join__descr career-body__text">{!! $language->replace($careersPage->description_title_second_ro, $careersPage->description_title_second_ru,$careersPage->description_title_second_en ) !!}</div>--}}
        {{--        </div>--}}
        {{--    </section>--}}
        <section class="career-benefits__section career-benefits">
            <div class="custom-container career-benefits__container">
                <h3 class="career-benefits__title career-body__title">{{trans('labels.benefits')}}</h3>
                <div class="career-benefits__body career-items">
                    @foreach($benefits as $benefit)
                        <div class="career-items__block">
                            <img src="{{url('storage/'.$benefit->image)}}" alt="" class="career-items__block-img">
                            <h4 class="career-items__block-title">{{$language->replace($benefit->title_ro, $benefit->title_ru,$benefit->title_en )}}</h4>
                            <p class="career-items__block-descr">{{$language->replace($benefit->description_ro, $benefit->description_ru,$benefit->description_en )}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        <section class="career-vacancy__section vacancy-section">
            <div class="custom-container vacancy-section__container">
                <h3 class="vacancy-section__title career-body__title">{{trans('labels.vacancy_title')}}</h3>
                <div class="vacancy-section__body">


                    <div class="vacancy-table">
                        <div class="vacancy-table-header">

                            <div class="vacancy-table-header_item">{{trans('labels.profession')}}</div>
                            <div class="vacancy-table-header_item">{{trans('labels.place')}}</div>
                            <div class="vacancy-table-header_item">{{trans('labels.department')}}</div>
                            <div class="vacancy-table-header_item">{{trans('labels.working_hours')}}</div>

                        </div>
                        <div class="vacancy-table-body">
                            @foreach($vacancy as $item)
                                <div class="vacancy-table-row">
                                    <div class="vacancy-table-body_item" onclick="handleVacancy(this)">
                                        <div class="vacancy-accordion__item">

                                            <div class="trigger__img">
                                                <svg class="trigger_svg" width="25px" height="25px" viewBox="0 0 32 32"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <defs>
                                                        <style>
                                                            .cls-1 {
                                                                fill: none;
                                                                stroke: #5E5E5E;
                                                                stroke-linecap: round;
                                                                stroke-linejoin: round;
                                                                stroke-width: 2px;
                                                            }
                                                        </style>
                                                    </defs>
                                                    <title/>
                                                    <g id="chevron-top">
                                                        <line class="cls-1" x1="16" x2="25" y1="11.5" y2="20.5"/>
                                                        <line class="cls-1" x1="7" x2="16" y1="20.5" y2="11.5"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div
                                                class="trigger__text">{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</div>


                                        </div>

                                    </div>
                                    <div class="vacancy-table-body_item" onclick="handleVacancy(this)">
                                        {{$language->replace($item->location_ro, $item->location_ru,$item->location_en )}}
                                    </div>
                                    <div class="vacancy-table-body_item" onclick="handleVacancy(this)">
                                        {{$language->replace($item->department_ro, $item->department_ru,$item->department_en )}}
                                    </div>
                                    <div class="vacancy-table-body_item" onclick="handleVacancy(this)">
                                        Full-time 9:00-18:00
                                    </div>
                                    <div class="vacancy-table-body_item">
                                        <button class="custom-btn vacancy-table-btn"
                                                onclick="applyVacancy({{$item->id}})">
                                            <span>{{trans('labels.apply')}}</span></button>
                                    </div>
                                </div>
                                <div class="vacancy-table-description">
                                    {!! $language->replace($item->description_ro, $item->description_ru,$item->description_en ) !!}
                                </div>

                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="custom-container" id="careerForm">
            <h2 class="career-body__title">{{trans('labels.send_your_cv')}}</h2>

            @include('client.careers.cvForm')

            @include('client.careers.fullForm', ['languages'=>$languages])


            @include('client.careers.specialForm')
        </section>


    </main>

@endsection

@push('script')
    <script type='text/javascript'
            src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    {{--    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.8.0/build/js/intlTelInput.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>--}}

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

    <!-- Select2 -->
    <script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('js/careers.js')}}"></script>

    <script>

        const languages = {!! $languages !!};
        const lang = '{{App::getLocale()}}';
        const policyFullDanger = document.getElementById('policy_full_danger');
        const policySpecialDanger = document.getElementById('policy_special_danger');

        const labels = {
            'languages': "{!! trans('labels.languages') !!}",
            'language': "{!! trans('labels.language') !!}",
            'level': "{!! trans('labels.level') !!}",
            'entry' : "{!! trans('labels.entry') !!}",
            'middle' : "{!! trans('labels.middle') !!}",
            'advanced' : "{!! trans('labels.advanced') !!}",
            'native' : "{!! trans('labels.native') !!}",
            'skills_performance' : "{!! trans('labels.skills_performance') !!}",
            'course': "{!! trans('labels.curse') !!}",
            'education': "{!! trans('labels.education') !!}",
            'choose_education': "{!! trans('labels.choose_education') !!}",
            'meedii': "{!! trans('labels.meedii') !!}",
            'meedii_specialitate': "{!! trans('labels.meedii_specialitate') !!}",
            'meedii_incomplete': "{!! trans('labels.meedii_incomplete') !!}",
            'superioare': "{!! trans('labels.superioare') !!}",
            'masterat': "{!! trans('labels.masterat') !!}",
            'country': "{!! trans('labels.country') !!}",
            'university': "{!! trans('labels.university') !!}",
            'faculty': "{!! trans('labels.faculty') !!}",
            'specialisation': "{!! trans('labels.specialisation') !!}",
            'study_period': "{!! trans('labels.study_period') !!}",
            'study': "{!! trans('labels.study') !!}",
            'personal_experience': "{!! trans('labels.personal_experience') !!}",
            'experience': "{!! trans('labels.experience') !!}",
            'choose_experience': "{!! trans('labels.choose_experience') !!}",
            'experience1': "{!! trans('labels.experience1') !!}",
            'experience2': "{!! trans('labels.experience2') !!}",
            'experience3': "{!! trans('labels.experience3') !!}",
            'experience4': "{!! trans('labels.experience4') !!}",
            'position': "{!! trans('labels.position') !!}",
            'company': "{!! trans('labels.company') !!}",
            'activity': "{!! trans('labels.activity') !!}",
            'ref_name': "{!! trans('labels.ref_name') !!}",
            'name': "{!! trans('labels.name') !!}",
            'second_name': "{!! trans('labels.second_name') !!}",
            'ref_phone': "{!! trans('labels.ref_phone') !!}",
            'description': "{!! trans('labels.description') !!}"
        }
        let languageCounter = 1;
        let courseCounter = 1;
        let studyCounter = 1;
        let experienceCounter = 1;
        let itiPhoneCv = null;
        let itiPhoneFull = null;
        let itiPhoneRef = null;
        let itiPhoneAdd = null;
        $(document).ready(function () {
            itiPhoneCv = phoneCountryHandler('#phone')
            itiPhoneFull = phoneCountryHandler('#user_phone')
            itiPhoneRef = phoneCountryHandler('#ref_phone')

            const success = '{{ isset($success) ? true : '' }}';
            if (success) {
                showToast('Datele au fost trimise', 'success')
            }
        });


        function onVacancyItem(id) {
            const modal = document.getElementById('vacancyModal' + id);
            // console.log(modal)
            let overlay;
            const main = document.getElementById('main');
            // main.append(modal)

            // const modalInMain =main.lastElementChild
            modal.style.opacity = '1';
            modal.style.pointerEvents = 'auto';
            createOverlay();
            setTimeout(() => {
                document.querySelector('.overlay').append(modal)
                // modal.style.display = 'block';
            }, 50);

            const closeModalBtn = modal.querySelector('.close__dialog');
            closeModalBtn.addEventListener('click', function () {
                // modal.style.display = 'none';
                modal.style.opacity = '0';
                modal.style.pointerEvents = 'none';
                removeOverlay();
                document.querySelector('.vacancy-section__body').append(modal)
            });


        }


        document.addEventListener('DOMContentLoaded', function () {

            const inputmask_options =
                {
                    mask: "99.99.9999",
                    alias: "date",
                    insertMode: false
                }

            const study_mask_options = {
                mask: "99.9999",
                dateFormat: 'mm.yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                alias: "date",
                insertMode: false,
                onClose: function (dateText, inst) {
                    if (!dateText) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();

                        $(this).datepicker('setDate', new Date(year, month, 1));
                    }
                },
            }

            const bday_mask_options = {
                mask: "99.99.9999",
                dateFormat: 'dd.mm.yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                alias: "date",
                insertMode: false,
                onClose: function (dateText, inst) {
                    if (!dateText) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();

                        $(this).datepicker('setDate', new Date(year, month, 1));
                    }
                },
            }


            $(".datepicker").datepicker(bday_mask_options).mask("99.99.9999");

            $("#birthday").datepicker(bday_mask_options).mask("99.99.9999");

            $(".studyFrom").datepicker(study_mask_options).mask("99.9999");

            $(".studyTill").datepicker(study_mask_options).mask("99.9999");


            $('.select2').select2()


            const fileInput = document.getElementById('docpicker');
            const fileInput2 = document.getElementById('docpicker2');
            // const uploadInput = document.querySelector('.input-text-upload');


            if (fileInput) { // Check if the element exists before adding event listener
                fileInput.addEventListener('change', function () {
                    if (fileInput.files.length > 0) {
                        fileInput.classList.remove('transparent-color');
                        document.getElementById('cv-label').classList.add('transparent-color');
                    } else {
                        fileInput.classList.add('transparent-color');
                        document.getElementById('cv-label').classList.remove('transparent-color');
                    }
                });
            } else {
                console.error("Element with ID 'docpicker' not found");
            }


            if (fileInput2) { // Check if the element exists before adding event listener
                fileInput2.addEventListener('change', function () {
                    if (fileInput2.files.length > 0) {
                        fileInput2.classList.remove('transparent-color');
                        document.getElementById('special-cv-label').classList.add('transparent-color');
                    } else {
                        fileInput2.classList.add('transparent-color');
                        document.getElementById('special-cv-label').classList.remove('transparent-color');
                    }
                });
            } else {
                console.error("Element with ID 'docpicker' not found");
            }

        });

        function fileUploadHandler(el, id) {
            if (el.files.length > 0) {
                el.classList.remove('transparent-color');
                document.getElementById('cv-label' + id).classList.add('transparent-color');
            } else {
                el.classList.add('transparent-color');
                document.getElementById('cv-label' + id).classList.remove('transparent-color');
            }
        }

        function handleVacancy(el) {
            const sameElement = el.parentElement.nextElementSibling.classList.contains('active')

            if (sameElement) {
                console.log('same')
                el.parentElement.nextElementSibling.classList.remove('active')
                console.log(el.parentElement, 'el.parentElement')
                el.parentElement.classList.remove('active')
            } else {

                document.querySelectorAll('.vacancy-table-description').forEach(item => item.classList.remove('active'))
                el.parentElement.nextElementSibling.classList.add('active')

                document.querySelectorAll('.vacancy-table-btn').forEach(item => {
                    item.classList.remove('active')
                })

                document.querySelectorAll('.vacancy-table-row').forEach(item => {
                    item.classList.remove('active')
                })

                el.parentElement.classList.add('active')


                document.querySelectorAll('.trigger_svg').forEach(item => {
                    item.classList.remove('close')
                })

            }

            el.parentElement.querySelector('.trigger_svg').classList.toggle('close');

            el.parentElement.querySelector('.vacancy-table-btn').classList.toggle('active');

        }

        function applyVacancy(vacancyId) {

            document.getElementById('vacancyCv').value = vacancyId;
            document.getElementById("careerForm").scrollIntoView();
            // location.hash = "#careerForm";

        }

        document.getElementById('upload_photo').addEventListener('change', (element) => {

            const userPhoto = document.querySelector('.user_photo')
            const files = element.target.files;

            console.log(files)
            for (let i = 0; i < files.length; i++) {
                if (files[i].type === 'image/jpeg' || files[i].type === 'image/png' || files[i].type === 'image/webp') {
                    userPhoto.src = URL.createObjectURL(files[i]);
                }
            }
        })

        function handleSexButton(el) {
            if (!el.classList.contains('active')) {
                document.querySelectorAll('.full-form-btn').forEach(item => {
                    item.classList.remove('active')
                })
                el.classList.add('active')
            }

        }

        function showFullForm() {
            document.getElementById('makeCvForm').classList.toggle('active')
        }

        function addPhone() {
            document.querySelector('.addition-phone').classList.toggle('active')

            itiPhoneAdd = phoneCountryHandler('#addition_phone')
        }

        function addStudy() {
            studyCounter += 1;

            const markup = `
                <div id="stydyItem${studyCounter}" class="position-relative d-flex flex-column gap-3 mt-3" >
                  <p class="block_title mb-4">${labels.study + ' - ' + studyCounter}</p>

                <div class="w-100 row align-items-center" style="position: relative">
            <label for="study${studyCounter}" class="full-form-photo-label col-md-4 ">
                ${labels.education}
            </label>
            <div class="full-form_select-container col-md-8 p-0">
            <select class="full-form_input full-form_select full-form_select_study" id="study${studyCounter}" >
                <option value="0" class="career-form__action-option" disabled selected>${labels.choose_education}</option>
                <option value="Medii" class="career-form__action-option" >${labels.meedii}</option>
                <option value="Medii de specialitate" class="career-form__action-option" >${labels.meedii_specialitate}</option>
                <option value="Medii incomplete" class="career-form__action-option" >${labels.meedii_incomplete}</option>
                <option value="Superioare" class="career-form__action-option" >${labels.superioare}</option>
                <option value="Masterat" class="career-form__action-option" >${labels.masterat}</option>
            </select>
            <p class="text_error" id="study${studyCounter}_danger"></p>
        <svg width="20px" height="20px" >
            <use xlink:href="/images/svg/select-arrow.svg#selectArrow"></use>
        </svg>
        <div class="remove_btn" onclick="removeStudy(${studyCounter})">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#5E5E5E" class="bi bi-x-lg" viewBox="0 0 16 16" style="top:20%; right:20%">
                  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
                </div>
            </div>
        </div>
                <div class="row align-items-center w-100">
                <label for="country${studyCounter}" class="full-form-photo-label col-md-4 ">
                    ${labels.country}
                        </label>
                        <div class="col-md-8 p-0">
                            <input id="country${studyCounter}"  type="text" class="full-form_input col-6 full-form_country " >
                    <p class="text_error" id="country${studyCounter}_danger"></p>
                </div>
            </div>

            <div class="row align-items-center w-100">
                <label for="university${studyCounter}" class="full-form-photo-label col-md-4 ">
                    ${labels.university}
                        </label>
                        <div class="col-md-8 p-0">
                            <input id="university${studyCounter}" type="text" class="full-form_input col-6 full-form_university" >
                    <p class="text_error" id="university${studyCounter}_danger"></p>
                </div>
            </div>
            <div class="row align-items-center w-100">
                <label for="faculty${studyCounter}" class="full-form-photo-label col-md-4 ">
                    ${labels.faculty}
                        </label>
                        <div class="col-md-8 p-0">
                            <input id="faculty${studyCounter}"  type="text" class="full-form_input col-6 full-form_faculty" >
                    <p class="text_error" id="faculty${studyCounter}_danger"></p>
                </div>
            </div>
          <div class="row align-items-center w-100">
                <label for="specialisation${studyCounter}" class="full-form-photo-label col-md-4 ">
                    ${labels.specialisation}
                        </label>
                        <div class="col-md-8 p-0">
                            <input id="specialisation${studyCounter}" type="text" class="full-form_input col-6 full-form_specialisation" >
                    <p class="text_error" id="specialisation${studyCounter}_danger"></p>
                </div>
            </div>
            <div class="row align-items-center w-100">
                                <label for="studyFrom${studyCounter}" class="full-form-photo-label col-md-4 ">
                                    ${labels.study_period}
                                </label>
                                <div class="col-md-8 p-0 d-flex justify-content-between gap-3">
                                    <div>
                                        <input class="full-form_input col-6 studyFrom" id="studyFrom${studyCounter}" type="text"
                                                placeholder="mm.yyyy">
                                        <p class="text_error" id="studyFrom${studyCounter}_danger"></p>
                                    </div>
                                    <div>
                                        <input class="full-form_input col-6 studyTill" id="studyTill${studyCounter}" type="text" data-inputmask-alias="mm.yyyy"
                                               data-provide="datepicker" placeholder="mm.yyyy">
                                        <p class="text_error" id="studyTill_danger"></p>
                                    </div>
                                </div>
                            </div>

          </div>
            `
            document.getElementById('additionEducation').insertAdjacentHTML(
                'beforeend',
                markup
            );
            const study_mask_options = {
                mask: "99.99.9999",
                dateFormat: 'dd.mm.yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                alias: "date",
                insertMode: false,
                onClose: function (dateText, inst) {
                    if (!dateText) {
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();

                        $(this).datepicker('setDate', new Date(year, month, 1));
                    }
                },
            }
            $(`#studyFrom${studyCounter}`).datepicker(study_mask_options).mask("99.9999");

            $(`#studyTill${studyCounter}`).datepicker(study_mask_options).mask("99.9999");
        }

        function removeStudy(id) {
            $('#stydyItem' + id).remove();
            studyCounter -= 1;
        }

        function addExperience() {
            experienceCounter += 1;
            const markup = `
            <div id="experienceItem${experienceCounter}" class="d-flex flex-column align-items-center gap-3">
                  <p class="block_title mb-4">${labels.personal_experience + ' - ' + experienceCounter}</p>
            <div class="w-100 row align-items-center" style="position: relative">
                <label for="experience${experienceCounter}" class="full-form-photo-label col-md-4 ">
                    ${labels.experience}
                </label>
                <div class="full-form_select-container col-md-8 p-0">
                    <select class="full-form_input full-form_select full-form_select_experience" id="experience${experienceCounter}" name="experience${experienceCounter}">
                        <option value="0" class="career-form__action-option" disabled selected>${labels.choose_experience}</option>
                        <option value="Fără" class="career-form__action-option" >${labels.experience1}</option>
                        <option value="1-3 ani" class="career-form__action-option" >${labels.experience2}</option>
                        <option value="3-7 ani" class="career-form__action-option" >${labels.experience3}</option>
                        <option value="7 +" class="career-form__action-option" >${labels.experience4}</option>

                    </select>
                <svg width="20px" height="20px" >
                    <use xlink:href="/images/svg/select-arrow.svg#selectArrow"></use>
                </svg>
                <div class="remove_btn" onclick="removeExperience(${experienceCounter})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#5E5E5E" class="bi bi-x-lg" viewBox="0 0 16 16" style="top:20%; right:20%">
                          <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                        </svg>
                </div>
            </div>
</div>


            <div class="row align-items-center w-100">
                <label for="position${experienceCounter}" class="full-form-photo-label col-md-4 ">
                    ${labels.position}
                        </label>
                        <div class="col-md-8 p-0">
                            <input id="position${experienceCounter}" name="position${experienceCounter}" type="text" class="full-form_input col-6 " >
                </div>
            </div>

            <div class="row align-items-center w-100">
                <label for="company${experienceCounter}" class="full-form-photo-label col-md-4 ">
                    ${labels.company}
                        </label>
                    <div class="col-md-8 p-0">
                            <input id="company${experienceCounter}" name="company${experienceCounter}" type="text" class="full-form_input col-6 " >
                    </div>
            </div>
            <div class="row align-items-center w-100">
                <label for="activity${experienceCounter}" class="full-form-photo-label col-md-4 ">
                    ${labels.activity}
                        </label>
                    <div class="col-md-8 p-0">
                            <input id="activity${experienceCounter}" name="activity${experienceCounter}" type="text" class="full-form_input col-6 " >
                    </div>
            </div>
            <div class="row align-items-center w-100">
                <label for="ref_name${experienceCounter}" class="full-form-photo-label col-md-4 ">
                  <p>${labels.name + ' ' + labels.second_name}</p>
                   <p class="full-form-label_description">${labels.ref_name}</p>
                   </label>
                    <div class="col-md-8 p-0">
                            <input id="ref_name${experienceCounter}" name="ref_name${experienceCounter}" type="text" class="full-form_input col-6 " >
                    </div>
            </div>

            <div class="row align-items-center w-100">
                <label for="ref_phone${experienceCounter}" class="full-form-photo-label col-md-4 ">
                   ${labels.ref_phone}
                 </label>
            <div class="col-md-8 p-0 position-relative">
                <input id="ref_phone${experienceCounter}" name="ref_phone${experienceCounter}" type="tel" class="full-form_input col-6 ">

            </div>
        </div>
            <div class="row align-items-center w-100">
                <label for="experience_description${experienceCounter}" class="full-form-photo-label pt-2 col-md-4 ">
                    ${labels.description}
            </label>
            <div class="col-md-8 p-0 position-relative">
                <textarea name="experience_description${experienceCounter}" id="experience_description${experienceCounter}" class="full-form_description col-6 " placeholder="${labels.skills_performance}" cols="30" rows="10"></textarea>
            </div>
        </div>
</div>

`;
            document.getElementById('additionExperience').insertAdjacentHTML(
                'beforeend',
                markup
            );
            phoneCountryHandler('#ref_phone' + experienceCounter)
        }

        function removeExperience(id) {
            $('#experienceItem' + id).remove();
            experienceCounter -= 1;
        }

        function addLanguage() {
            languageCounter += 1;
            const markup = `
    <div class="row align-items-center w-100" id="languageItem${languageCounter}">
         <label for="language${languageCounter}" class="full-form-photo-label col-md-4 "></label>
            <div class="col-md-8 p-0 d-flex justify-content-between position-relative gap-3">
                <div class="full-form_select-container w-100">
                    <select class="full-form_input full-form_select select_language" id="language${languageCounter}" >
                        <option value="0" class="career-form__action-option" disabled selected>${labels['language']}</option>
                        ${languages.map(item => {
                            return `<option value="${item['name_ro']}" class="career-form__action-option" >${languageReplace(lang, item['name_ro'], item['name_ru'], item['name_en'])}</option>`
                        }).join('')}
                    </select>
                    <p class="text_error" id="language${languageCounter}_danger"></p>
                     <svg>
                         <use href="/images/svg/select-arrow.svg#selectArrow"></use>
                     </svg>
                </div>
            <div class="full-form_select-container w-100" >
                <select class="full-form_input full-form_select select_level" id="level${languageCounter}" >
                    <option value="0" class="career-form__action-option" disabled selected>${labels['level']}</option>
                    <option value="Începător" class="career-form__action-option" >${labels['entry']}</option>
                    <option value="Mediu" class="career-form__action-option" >${labels['middle']}</option>
                    <option value="Avansat" class="career-form__action-option" >${labels['advanced']}</option>
                    <option value="Nativ" class="career-form__action-option" >${labels['native']}</option>
                </select>
                <p class="text_error" id="level${languageCounter}_danger"></p>
                <svg>
                    <use href="/images/svg/select-arrow.svg#selectArrow"></use>
                </svg>
                </div>
                <div class="remove_btn" onclick="removeLanguage(${languageCounter})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#5E5E5E" class="bi bi-x-lg" viewBox="0 0 16 16">
                      <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </div>
            </div>
       </div>
            `

            document.getElementById('addLanguages').insertAdjacentHTML(
                'beforeend',
                markup
            );
        }

        function removeLanguage(id) {
            $('#languageItem' + id).remove();
            languageCounter -= 1;
        }

        function addCourse() {

            courseCounter += 1;
            const markup = `
                      <div class="row align-items-center mb-3 " id="courseItem${courseCounter}">
                                <label for="course${courseCounter}" class="full-form-photo-label col-md-4 ">
                                     ${labels['course']}-${courseCounter}
                                </label>
                                <div class="col-md-6 p-0 position-relative">
                                    <input id="course${courseCounter}" type="text" class="full-form_input col-6 ">
                                    <p class="text_error" id="course${courseCounter}_danger"></p>
                                    <div class="remove_btn" onclick="removeCourse(${courseCounter})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#5E5E5E" class="bi bi-x-lg" viewBox="0 0 16 16">
                                      <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                    </svg>
                                    </div>
                                </div>

                            </div>
            `
            document.getElementById('addCourses').insertAdjacentHTML(
                'beforeend',
                markup
            );
        }

        function removeCourse(id) {
            $('#courseItem' + id).remove();
            courseCounter -= 1;
        }


        function submitCVForm() {
            const vacancy = document.getElementById('vacancyCv');
            const vacancyDanger = document.getElementById('vacancy_cv_danger');
            const name = document.getElementById('name');
            const nameDanger = document.getElementById('name_danger');
            const phone = document.getElementById('phone');
            const phoneDanger = document.getElementById('phone_danger');
            const email = document.getElementById('email');
            const emailDanger = document.getElementById('email_danger');
            const file = document.getElementById('docpicker');
            const fileDanger = document.getElementById('file_danger');
            const policyCvDanger = document.getElementById('policy_cv_danger');
            const cvLabel = document.getElementById('cv-label');


            checkInputField(vacancy, vacancyDanger, '{{trans('labels.form_vacancy_error')}}')
            checkInputField(name, nameDanger, '{{trans('labels.form_name_error')}}')
            checkInputField(phone, phoneDanger, '{{trans('labels.form_phone_error')}}')
            {{--checkInputField(email,emailDanger, '{{trans('labels.form_email_error')}}')--}}
            checkInputField(file, fileDanger, '{{trans('labels.form_file_error')}}')

            let checkboxChecked = document.getElementById('cvFormCheckbox').checked;

            if (!checkboxChecked) {
                policyCvDanger.style.display = 'block';
                policyCvDanger.textContent = '{{trans('labels.form_policy_error')}}';
            }

            if (name.value !== '' && vacancy.value !== '0' && phone.value !== '' && file.value !== '' && checkboxChecked) {
                document.getElementById('cvFormPhone').value = itiPhoneCv.getNumber()


                // console.log(document.getElementById('cvFormPhone').value)
                document.getElementById('careerFormCv').submit();
                // const data = {
                //     'name': name.value,
                //     'email': email.value,
                //     'vacancy_id': vacancy.value,
                //     'phone': itiPhoneCv.getNumber(),
                //     'file': file.files[0],
                //     'vacancyNotification':vacancyCvChecked ? 1: 0,
                //     'newsNotification':newsCvChecked ? 1: 0,
                //
                // }
                // console.log(data)
                // $.ajax({
                //     url:     "/vacancy-mail",
                //     method:  'POST',
                //     data: data,
                //     contentType: "multipart/form-data",
                //
                // }).done(function (res) {
                //     console.log(res)
                //     if(res.status === 'ok') {
                //         showToast('Datele au fost trimise', 'success')
                //         name.value = '';
                //         email.value = '';
                //         phone.value = '';
                //         file.value = '';
                //         document.getElementById('cvFormCheckbox').checked = false;
                //         document.getElementById('vacancyCvCheckbox').checked = false;
                //         document.getElementById('newsCvCheckbox').checked = false;
                //         policyCvDanger.style.display = 'none';
                //     } else {
                //         showToast('Datele n-au fost trimise', 'danger')
                //     }
                // });
            }

        }


        function submitFullForm() {
            const form = document.getElementById('vacancyFullForm');
            const photo = document.getElementById('upload_photo');
            const photoDanger = document.getElementById('upload_photo_danger');
            const vacancy = form.querySelector('#vacancy_id');
            const vacancyDanger = form.querySelector('#vacancy_id_danger');
            const name = form.querySelector('#name');
            const nameDanger = form.querySelector('#name_danger');
            const secondName = document.getElementById('surname');
            const secondNameDanger = document.getElementById('surname_danger');
            const birthday = document.getElementById('birthday');
            const location = document.getElementById('location');
            const nation = document.getElementById('nation');
            const email = form.querySelector('#email');
            const phone = document.getElementById('user_phone');
            const experience = document.getElementById('experience');
            const birthdayDanger = document.getElementById('birthday_danger');
            const locationDanger = document.getElementById('location_danger');
            const nationDanger = document.getElementById('nation_danger');
            const emailDanger = form.querySelector('#email_danger');
            const phoneDanger = document.getElementById('user_phone_danger');
            const experienceDanger = document.getElementById('experience_danger');


            checkInputField(photo, photoDanger, '{{trans('labels.form_photo_error')}}')
            checkInputField(vacancy, vacancyDanger, '{{trans('labels.form_vacancy_error')}}')
            checkInputField(name, nameDanger, '{{trans('labels.form_name_error')}}')
            checkInputField(secondName, secondNameDanger, '{{trans('labels.form_surname_error')}}')
            checkInputField(birthday, birthdayDanger, '{{trans('labels.form_birthday_error')}}')
            checkInputField(location, locationDanger, '{{trans('labels.form_location_error')}}')
            checkInputField(nation, nationDanger, '{{trans('labels.form_nation_error')}}')
            checkInputField(email, emailDanger, '{{trans('labels.form_email_error')}}')
            checkInputField(phone, phoneDanger, '{{trans('labels.form_phone_error')}}')
            checkInputField(experience, experienceDanger, '{{trans('labels.form_experience_error')}}')

            function setData(selector, name, arr) {
                document.querySelectorAll(selector).forEach((item, key) => {
                    arr[key][name] = item.value;
                })
            }

            document.getElementById('sexInput').value = document.querySelector('.full-form-btn.active').dataset.sex

            if (name.value !== '' && vacancy.value !== '0' && email.value !== '' && phone.value !== '' && secondName.value !== '' && birthday.value !== ''
                && location.value !== '' && nation.value !== '' && email.value.includes('@')) {

                const studies = [];
                const experiences = [];
                const languages = [];
                const languagesLength = document.querySelectorAll('.select_language').length;
                const studyLength = document.querySelectorAll('.full-form_select_study').length;
                const experienceLength = document.querySelectorAll('.full-form_select_experience').length;

                for (let i = 0; i < languagesLength; i++) {
                    const newObject = {'language': 1, 'level': 1};
                    languages.push(newObject);
                }
                for (let i = 0; i < studyLength; i++) {
                    const newObject = {
                        'type': 1,
                        'country': '',
                        'university': '',
                        'faculty': '',
                        'specialisation': '',
                        'study_from': '',
                        'study_till': '',
                    };
                    studies.push(newObject);
                }
                for (let i = 0; i < experienceLength; i++) {
                    const newObject = {
                        'experience': 1,
                        'position': '',
                        'company': '',
                        'activity': '',
                        'ref_name': '',
                        'ref_phone': '',
                        'experience_description': '',
                    };
                    experiences.push(newObject);
                }

                setData('.full-form_select_study', 'type', studies);
                setData('.full-form_country', 'country', studies);
                setData('.full-form_university', 'university', studies);
                setData('.full-form_faculty', 'faculty', studies);
                setData('.full-form_specialisation', 'specialisation', studies);
                setData('.studyFrom', 'study_from', studies);
                setData('.studyTill', 'study_till', studies);


                setData('.select_language', 'language', languages);
                setData('.select_level', 'level', languages);


                setData('.full-form_select_experience', 'experience', experiences);
                setData('.full-form_position', 'position', experiences);
                setData('.full-form_company', 'company', experiences);
                setData('.full-form_activity', 'activity', experiences);
                setData('.ref_name', 'ref_name', experiences);
                setData('.ref_phone', 'ref_phone', experiences);
                setData('.experience_description', 'experience_description', experiences);


                document.getElementById('fullFormStudies').value = JSON.stringify(studies)
                document.getElementById('fullFormExperiences').value = JSON.stringify(experiences)
                document.getElementById('fullFormLanguages').value = JSON.stringify(languages)
                document.getElementById('fullFormPhone').value = itiPhoneFull.getNumber()
                if (itiPhoneAdd) {
                    document.getElementById('fullFormAddPhone').value = itiPhoneAdd.getNumber()
                }

                // showToast('Datele au fost trimise', 'success')
                document.getElementById('vacancyFullForm').submit();
            }

        }


        function specialFormSubmit() {
            const file = document.getElementById('docpicker2');
            const specialisation = document.getElementById('specialisationSpecial');
            const specialMessage = document.getElementById('specialMessage');
            const fileDanger = document.getElementById('file_cv_danger');
            const specialisationDanger = document.getElementById('specialisation_special_danger');
            const specialMessageDanger = document.getElementById('special_message_danger');
            const policySpecialDanger = document.getElementById('policy_special_danger');

            checkInputField(specialisation, specialisationDanger, '{{trans('labels.form_specialisation_error')}}')
            checkInputField(file, fileDanger, '{{trans('labels.form_file_error')}}')
            checkInputField(specialMessage, specialMessageDanger, '{{trans('labels.form_message_error')}}')

            let checkboxChecked = document.getElementById('specialCheckbox').checked;
            if (!checkboxChecked) {
                policySpecialDanger.style.display = 'block';
                policySpecialDanger.textContent = '{{trans('labels.form_policy_error')}}';
            }

            if (file.value !== '' && specialisation.value !== '0' && specialMessage.value !== '' && checkboxChecked) {
                document.getElementById('specialForm').submit();
                // const data = {
                //     'specialisation': specialisation.value,
                //     'file': file.files[0],
                //     'message':specialMessage.value,
                //
                // }

                // $.ajax({
                //     url:     "/vacancy-special",
                //     method:  'POST',
                //     contentType: "multipart/form-data",
                //     dataType: "json",
                //     data: data,
                //     headers: {
                //         "Accept": "application/json"
                //     }
                //
                // }).done(function (res) {
                //     console.log(res)
                //     if(res.status === 'ok') {
                //         showToast('Datele au fost trimise', 'success')
                //         specialisation.value = '';
                //         specialMessage.value = '';
                //         file.value = '';
                //         policySpecialDanger.style.display = 'none';
                //         document.getElementById('specialCheckbox').checked =false;
                //     } else {
                //         showToast('Datele n-au fost trimise', 'danger')
                //     }
                // }).catch(() =>{
                //     showToast('Datele n-au fost trimise', 'danger')
                // });
            }


        }


    </script>

@endpush
