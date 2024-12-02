<div class="modal__wrapper-download_pdf">
    <div class="download_pdf_modal" id="download_pdf_modal">
        <div class="download_modal-top">
            <button id="closeDownloadModal" class="close__download_modal">
                <img src="{{url('images/cancel.svg')}}" alt="cancel" width="15px" height="15px">

            </button>
        </div>
        <div class="download_modal_bottom">
            <ul class="download_modal_list">
            @foreach($industries as $industry)
                <li class="download_modal_item row">
                    <div class="download_modal_img_block col-2">
                        <img class="download_modal_img" src="{{url('images/1.png')}}"  alt="Industry image">
                    </div>
                    <div class="download_modal_text col-4">
                        <span class="download_modal_descr">Catalog</span>
                        <span class="download_modal_title">{{$industry->name}}</span>

                    </div>
                    <div class="download_modal_size col-3">
                        <p>{{$industry->pdf_size}} MB</p>
                    </div>
                    <div class="download_modal_icon col-3">
                        <a href="{{url('storage/'.$industry->pdf)}}" class="" download hidden id="industryLink{{$industry->id}}">
                        </a>
                        <button class="download_modal_download" type="button" onclick="downloadIndustryCatalog({{$industry->id}})">
                            <svg width="25" height="25" viewBox="0 0 24 24" fill="white" class="download_modal_svg"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="24" fill="white" />
                                <path d="M5 12V18C5 18.5523 5.44772 19 6 19H18C18.5523 19 19 18.5523 19 18V12"
                                      stroke="#000000" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 3L12 15M12 15L16 11M12 15L8 11" stroke="#000000" stroke-linecap="round"
                                      stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>

</div>

@push('script')
    <script>
        const userLogin ='{{$user}}';
        console.log(userLogin, 'userLogin')
        function openFeedbackModal(link) {

            const modal = document.getElementById('feedbackModal');
            const close = document.getElementById('feedbackClose');
            const submitBtn = document.getElementById('feedbackSubmitBtn');
            const body = document.body
            document.querySelector('.modal__wrapper-download_pdf').style.display = 'none'
            modal.style.display= 'flex';


            close.addEventListener('click', () => {
                modal.style.display = 'none'
                body.classList.remove('locked')
            });

            modal.addEventListener('click', e => {
                if (e.target === modal) {
                    modal.style.display = 'none'
                    body.classList.remove('locked')
                }
            })

            submitBtn.addEventListener('click', ()=>{
                const name =document.getElementById('feedbackName');
                const nameDanger =document.getElementById('feedback_name_danger');
                const email =document.getElementById('feedbackEmail');
                const emailDanger =document.getElementById('feedback_email_danger');
                checkInputField(name,nameDanger, '{{trans('labels.form_name_error')}}')
                checkInputField(email,emailDanger, '{{trans('labels.form_email_error')}}')

                if(name.value !== '' && email.value !== '' ) {
                    const data = {
                        'name': name.value,
                        'email': email.value,
                    }

                    $.ajax({
                        url: "/feedback-mail",
                        method:  'POST',
                        data: data,

                    }).done(function (res) {
                        if(res.status === 'ok') {
                            showToast('Datele au fost trimise', 'success')
                            name.value = '';
                            email.value = '';
                            document.getElementById('feedbackModal').style.display = 'none'
                            body.classList.remove('locked')
                            document.getElementById(link).click();
                            window.localStorage.setItem('VitraSentData', '1')
                        } else {
                            showToast('Datele n-au fost trimise', 'danger')
                        }


                    });
                }
            })

        }

        function downloadIndustryCatalog(industryId) {
            const sent = window.localStorage.getItem('VitraSentData')
            if(userLogin || sent) {
                document.getElementById('industryLink'+industryId).click();
            } else {
                openFeedbackModal('industryLink'+industryId)
            }
        }

    </script>
@endpush
