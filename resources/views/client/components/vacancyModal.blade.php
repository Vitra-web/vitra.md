
<div class="modal-view__descr modal" id="vacancyModal{{$vacancyItem->id}}" style="max-width: 950px">
    <div class="modal-title__body">
        <h4 class="modal-title">
            {{trans('labels.send_your_cv')}}
        </h4>
        <button id="close__dialog" class="close__dialog">

            <svg width="800px" height="800px" viewBox="-0.5 0 25 25" fill="black" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 21.32L21 3.32001" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M3 3.32001L21 21.32" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg></button>
    </div>
    <div class="modal-body">
        <form action="{{route('client.vacancyMail')}}" method="post" enctype="multipart/form-data">
            <input id="name" name="vacancy_id" value="{{$vacancyItem->id}}" type="hidden" >
            <div class="about-form__action">
                <label for="vacancy" id="name-label" class="name-label">
                    <input id="vacancy" type="text" class="input-text" readonly value="{{$language->replace($vacancyItem->name_ro, $vacancyItem->name_ru,$vacancyItem->name_en )}}" required>
                </label>
                <label for="name" id="name-label" class="name-label">
                    <input id="name" name="name" type="text" class="input-text" placeholder="{{trans('labels.name')}}*" required>
                </label>
                <label for="surname" id="name-label" class="name-label">
                    <input id="surname" name="surname" type="text" class="input-text" placeholder="{{trans('labels.second_name')}}*" required>
                </label>
                <label for="phone" id="name-label" class="name-label">
                    <input id="phone" name="phone" type="text" class="input-text" placeholder="{{trans('labels.phone_number')}}*" required>
                </label>
                <label for="email" id="name-label" class="name-label">
                    <input id="email" name="email" type="text" class="input-text" placeholder="{{trans('labels.email')}}*" required>
                </label>
                <label for="file" class="name-label">
                    <input name="file" type="file" id="input-upload{{$vacancyItem->id}}" onchange="fileUploadHandler(this, {{$vacancyItem->id}})" class="input-text input-text-upload transparent-color" required
                           accept=".pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    <label for="" class="test" id="cv-label{{$vacancyItem->id}}">Incarca CV-ul*</label>
                </label>
            </div>
            <div class="d-flex justify-content-end mt-3 mb-3">
                <p class="about-form__more">{{trans('labels.if_no_cv')}} <a href="" class="fw-bold text-decoration-underline">{{trans('labels.click_here')}}</a> </p>
            </div>
            <div class="about-form__radio">
                <div class="about-form__radio-body">
                    <label class="checkbox__item">
                        <input type="checkbox" name="vacancyNotification" value="1" class="checkbox__input">
                        <span class="fake"></span>
                        <span class="checkbox_text">{!! trans('labels.want_notifications_vacancy') !!}</span>
                    </label>
                    <label class="checkbox__item">
                        <input type="checkbox" name="newsNotification" value="1" class="checkbox__input">
                        <span class="fake"></span>
                        <span class="checkbox_text">{!! trans('labels.want_notifications_news') !!}</span>
                    </label>
                </div>
                <button type="submit" class="about-form__radio-btn custom-btn">{!! trans('labels.send_data') !!}</button>
            </div>
        </form>
    </div>
</div>

