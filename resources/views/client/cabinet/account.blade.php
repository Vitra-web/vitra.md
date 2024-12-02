@extends('layouts.cabinet')
@section('content')

<div class="account-block">

 <!-- Cont-->
<h3 class="account-block_title">{{trans('cabinet.cont')}}</h3>

 <!-- Detail profile Facturare si expediere Conectare si securitate -->
<ul class="account-block_nav">
    <li class="account-block_nav_item active" onclick="tabHandler(this)">
        {{trans('cabinet.account_details')}}
    </li>
    <li class="account-block_nav_item" onclick="tabHandler(this)">
        {{trans('cabinet.account_billing')}}
    </li>
    <li class="account-block_nav_item" onclick="tabHandler(this)">
        {{trans('cabinet.account_security')}}
    </li>
</ul>

  <!-- Detaile profile -->
  <div id="detail-info" class="cabinet_block">

  <div class="d-flex justify-content-between">
      <h3 class="account-block_title">
        {{trans('cabinet.personal_information')}}
      </h3>

      <div class="account-block_edit personal-edit_button" onclick="editPersonalInfo(this)">
        <div class="edit_block active">
          <img
            src="/images/cabinet/edit.svg"
            alt="edit-text"
            class="account-block_edit_img"
          />
          <span class="account-block_edit_text">{{trans('cabinet.edit')}}</span>
        </div>
        <div class="save_block">
          <img
            src="/images/cabinet/save.svg"
            alt="edit-text"
            class="account-block_edit_img"
          />
          <span class="account-block_edit_text">{{trans('cabinet.save')}}</span>
        </div>
      </div>

    </div>

    <div class="personal_information_edit_block">
      <div class="edit_block_data active">
        <p class="account-block_label">{{trans('cabinet.name_surname')}}</p>
        <p class="account-block_value" id="userNameText">{{$user->name}}</p>
        <p class="account-block_label">{{trans('cabinet.birthday')}}</p>
        <p class="account-block_value" id="userBirthdayText">
          {{$user->birthday}}
        </p>
      </div>
      <div class="edit_block_form">
        <form
          action="{{route('client.personalInfo')}}"
          method="post"
          id="personalInformationForm"
        >
          @csrf
          <p class="account-block_label">{{trans('cabinet.name_surname')}}</p>
          <label for="">
            <input
              type="text"
              class="account-block_input"
              id="userName"
              value="{{$user->name}}"
            />
          </label>
          <p class="account-block_label">{{trans('cabinet.birthday')}}</p>
          <label for="">
            <input
              type="text"
              class="account-block_input datepicker"
              id="userBirthday"
              data-inputmask-alias="__.__.____"
              data-provide="datepicker"
              placeholder="dd.mm.yyyy"
              value="{{$user->birthday}}"
            />
          </label>
        </form>
      </div>
    </div>

  <div class="d-flex justify-content-between">
    <h3 class="account-block_title">
      {{trans('cabinet.contact')}}
    </h3>

      <div class="account-block_edit contact-edit_button" onclick="editContactInfo(this)">
        <div class="edit_block active">
          <img
            src="/images/cabinet/edit.svg"
            alt="edit-text"
            class="account-block_edit_img"
          />
          <span class="account-block_edit_text">{{trans('cabinet.edit')}}</span>
        </div>
        <div class="save_block">
          <img
            src="/images/cabinet/save.svg"
            alt="edit-text"
            class="account-block_edit_img"
          />
          <span class="account-block_edit_text">{{trans('cabinet.save')}}</span>
        </div>
      </div>
    </div>

    <div class="contact_information_edit_block">
      <div class="edit_block_data active">
        <p class="account-block_label">{{trans('cabinet.email')}}</p>
        <p class="account-block_value" id="userEmailText">{{$user->email}}</p>
        <p class="account-block_label">{{trans('cabinet.phone')}}</p>
        <p class="account-block_value" id="userPhoneText">{{$user->phone}}</p>
        <p class="account-block_label">{{trans('cabinet.addition_phone')}}</p>
        <p class="account-block_value" id="userAddPhoneText">
          {{$user->add_phone}}
        </p>
      </div>
      <div class="edit_block_form">
        <form
          action="{{route('client.contactInfo')}}"
          method="post"
          id="contactInformationForm"
        >
          @csrf
          <p class="account-block_label">{{trans('cabinet.email')}}</p>
          <label for="">
            <input
              type="text"
              class="account-block_input"
              id="userEmail"
              value="{{$user->email}}"
            />
          </label>
          <p class="account-block_label">{{trans('cabinet.phone')}}</p>
          <label for="">
            <input
              type="text"
              class="account-block_input"
              id="userPhone"
              value="{{$user->phone}}"
            />
          </label>
          <p class="account-block_label">{{trans('cabinet.addition_phone')}}</p>
          <label for="">
{{--              <input type="text" class="account-block_input" id="userAdditionPhone" value="{{$user->add_phone}}" />--}}
            <input type="text" name="phone" id="userAdditionPhone" class="account-block_input" id="userAdditionPhone" value="{{$user->add_phone}}" />
          </label>

        </form>
      </div>
    </div>

  </div>

 <!-- Billing Information -->
<div id="billing-info" class="billing_block" style="display: none;">

  <!-- Titlul secțiunii -->
  <div class="d-flex justify-content-between">
    <h3 class="account-block_title">{{trans('cabinet.address')}}</h3>

    <!-- Buton de editare și salvare -->
    <div class="account-block_edit billing-edit_button" onclick="editBillingInfo(this)">
      <div class="edit_block active">
        <img
          src="/images/cabinet/edit.svg"
          alt="edit-text"
          class="account-block_edit_img"
        />
        <span class="account-block_edit_text">{{trans('cabinet.edit')}}</span>
      </div>
      <div class="save_block">
        <img
          src="/images/cabinet/save.svg"
          alt="edit-text"
          class="account-block_edit_img"
        />
        <span class="account-block_edit_text">{{trans('cabinet.save')}}</span>
      </div>
    </div>

  </div>

  <p class="green-text">{{trans('cabinet.billing_address')}}</p>

  <!-- Blocul cu informațiile de facturare -->
  <div class="personal_information_edit_block">

    <!-- Blocul vizual de date (când nu editezi) -->
    <div class="edit_block_data active">
      <p class="addres_pad_top">{{trans('cabinet.adresa')}}</p>

      <p class="account-block_value" id="billingCountryText">{{trans('cabinet.RM_M')}}</p>
      <p class="account-block_value" id="billingStreetText">{{trans('cabinet.strada')}}{{trans('cabinet.md-2026')}}</p>
    </div>

    <!-- Blocul de formular (când editezi) -->
    <div class="edit_block_form">
      <form

        method="post"
        id="billingInformationForm"
      >
        @csrf

        <p class="account-block_label">{{trans('cabinet.RM_M')}}</p>
        <label for="">
          <input
            type="text"
            class="account-block_input"
            id="billingCountry"
            value="{{trans('cabinet.RM_M')}}"
          />
        </label>

        <p class="account-block_label">{{trans('cabinet.adresa')}}</p>
        <label for="">
          <input
            type="text"
            class="account-block_input"
            id="billingStreet"
            value="{{trans('cabinet.strada')}}{{trans('cabinet.md-2026')}}"
          />
        </label>

      </form>
    </div>

  </div>
</div>

<!-- Security Information -->
<div id="security-info" class="security_block" style="display: none;">
    <div class="d-flex justify-content-between">
        <h3 class="account-block_title">{{ trans('cabinet.security') }}</h3>

        <!-- Buton de editare și salvare -->
        <div class="account-block_edit security-edit_button" onclick="editSecurityInfo(this)">
            <div class="edit_block active">
                <img src="/images/cabinet/edit.svg" alt="edit-text" class="account-block_edit_img" />
                <span class="account-block_edit_text">{{ trans('cabinet.edit') }}</span>
            </div>
            <div class="save_block">
                <img src="/images/cabinet/save.svg" alt="save" class="account-block_edit_img" />
                <span class="account-block_edit_text">{{ trans('cabinet.save') }}</span>
            </div>
        </div>
    </div>


    <!-- Bloc de date inițial - vizualizare parole -->
        <div class="edit_block_data active">
            <p class="account-block_pass">{{ trans('cabinet.password') }}</p>
        </div>


    <div class="security_information_edit_block">


     <!-- Blocul cu ștergerea contului -->

  <div class="account-block_delete" id="deleteSection">

    <!-- Bloc de editare - câmpuri de parolă -->
        <div class="edit_block_form">
            <form method="post" id="securityInformationForm">
                @csrf
                <p class="account-block_label">{{ trans('cabinet.password_old') }}</p>

                <div class="password-input-container">
                    <input type="password" class="account-block_input" id="userPassword" placeholder="********" />
                    <!-- Buton de vizibilitate -->
                    <div class="password-visibility-toggle" onclick="togglePasswordVisibility('userPassword', this)">
                        <img src="/images/cabinet/hide.png" alt="view" class="password-toggle_img" />
                        <span class="password-toggle_text">{{ trans('cabinet.show') }}</span>
                    </div>
                </div>

                <p class="account-block_label">{{ trans('cabinet.password_new') }}</p>
                <div class="password-input-container">
                    <input type="password" class="account-block_input" id="userConfirmPassword" placeholder="********" />
                    <!-- Buton de vizibilitate -->
                    <div class="password-visibility-toggle" onclick="togglePasswordVisibility('userConfirmPassword', this)">
                        <img src="/images/cabinet/hide.png" alt="view" class="password-toggle_img" />
                        <span class="password-toggle_text">{{ trans('cabinet.show') }}</span>
                    </div>
                </div>
            </form>
        </div>


    <!-- Secțiunea de ștergere -->
    <div class="delete_block" style="display: flex; justify-content: space-between; align-items: center;">
        <p class="account-block_deletecont" style="margin: 0;">{{ trans('cabinet.content_del_cont') }}</p>
        <button class="transparent-button delete-edit_button" onclick="showDeleteConfirmation()">
            <img src="/images/cabinet/delete.svg" alt="delete-account" class="account-block_delete_img" />
        </button>
    </div>


    <!-- Confirmarea ștergerii -->
    <div class="delete_container" id="deleteConfirmation" style="display: none;">
        <p class="account-block_title">{{ trans('cabinet.sure_delete_account') }}</p>
        <p class="account-block_label">{!! trans('cabinet.info1') !!}</p>
        <p class="account-block_label">{!! trans('cabinet.info2') !!}</p>
        <p class="account-block_label">{!! trans('cabinet.info3') !!}</p>

        <p id="userNameText" class="account-block_title">{{ trans('cabinet.continue-break') }} {{$user->name}}</p>

        <div style="margin-bottom: 45px; margin-top: 40px; position: relative;">
            <p style="padding-bottom: 10px;" class="account-block_pass">{{ trans('cabinet.confirm_pass_text') }}</p>
            <div class="password-input-container">
                <input type="password" class="account-block_input" id="confirmPassword" placeholder="********" />
                <div class="password-visibility-toggle" onclick="togglePasswordVisibility('userPassword', this)">
                    <img src="/images/cabinet/hide.png" alt="view" class="password-toggle_img" />
                    <span class="password-toggle_text">{{ trans('cabinet.show') }}</span>
                </div>
            </div>
        </div>

        <div class="confirmation_buttons">
            <button class="account-block_back_btn transparent-button" onclick="cancelDelete()" style="display: flex; align-items: center; gap: 15px;">
                <img src="/images/cabinet/back-arrow.svg" alt="Back" style="height: 25px; width: 25px;" />
                <p class="account-block_title" style="margin: 0;">{!!trans('cabinet.back')!!}</p>
            </button>
            <br>
            <button class="account-block_back_btn transparent-button text-danger" onclick="deleteAccount()" style="display: flex; align-items: center; gap: 15px;">
                <img class="account-block_delete_img" src="/images/cabinet/delete.svg" alt="Delete"/>
                <p class="account-block_title" style="margin: 0;">{{ trans('cabinet.content_del_cont') }}</p>
            </button>
        </div>


    </div>

</div>

    </div>

</div>

@endsection

@push('script')

<script
  type="text/javascript"
  src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"
></script>

        {{--    phone input--}}
        <link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"/>


        <script>
            let phone = document.getElementById("userPhone");
            let addition_phone = document.getElementById("userAdditionPhone");
            window.intlTelInput(phone, {
                // show dial codes too
                separateDialCode: true,
                // If there are some countries you want to show on the top.
                // here we are promoting russia and singapore.
                preferredCountries: ["md"],
                //Default country
                initialCountry:"md",
                // show only these countres, remove all other
                // onlyCountries: ["ru", "cn","pk", "sg", "my", "bd"],

                // If there are some countries you want to execlde.
                // here we are exluding india and israel.

                // excludeCountries: ["in","il"]
            });

            window.intlTelInput(addition_phone, {
                // show dial codes too
                separateDialCode: true,
                // If there are some countries you want to show on the top.
                // here we are promoting russia and singapore.
                preferredCountries: ["md"],
                //Default country
                initialCountry:"md",
                // show only these countres, remove all other
                // onlyCountries: ["ru", "cn","pk", "sg", "my", "bd"],

                // If there are some countries you want to execlde.
                // here we are exluding india and israel.

                // excludeCountries: ["in","il"]
            });
        </script>

        {{--    phone input--}}

<script>
  document.addEventListener("DOMContentLoaded", function () {});

  const cabinetNav = document.querySelector('.account-block_nav');

  function editPersonalInfo(el) {
    const personalBlock = document.querySelector(
      ".personal_information_edit_block",
    );
    const contactEditButton = document.querySelector('.contact-edit_button');

    if (el.querySelector(".edit_block.active")) {
      el.querySelector(".edit_block").classList.remove("active");
      el.querySelector(".save_block").classList.add("active");

      contactEditButton.classList.add("off");
      cabinetNav.classList.add("off");

      personalBlock
        .querySelector(".edit_block_data")
        .classList.remove("active");
      personalBlock.querySelector(".edit_block_form").classList.add("active");

      const inputmask_options = {
        mask: "99.99.9999",
        alias: "date",
        insertMode: false,
      };

        $( function() {
            $( ".datepicker" ).datepicker({
                dateFormat: "dd.mm.yy",
                alias: "date",
                insertMode: false,
                changeMonth: true,
                changeYear: true,
                yearRange: "1920:+10",
            }).datepicker().inputmask("99.99.9999", inputmask_options);
        } );
    } else {
      el.querySelector(".save_block").classList.remove("active");
      el.querySelector(".edit_block").classList.add("active");

      const name = document.getElementById("userName");
      const birthday = document.getElementById("userBirthday");

      const data = {
        user_id: "{{$user->id}}",
        name: name.value,
        birthday: birthday.value,
        _token: "{{ csrf_token() }}",
      };
      console.log(data);
      $.ajax({
        url: "/personal-info",
        method: "POST",
        data: data,
      }).done(function (res) {
        console.log(res);
        if (res.status === "ok") {
          document.getElementById("userNameText").textContent = res.data.name;
          document.getElementById("userBirthdayText").textContent =
            res.data.birthday;

          showToast("Datele au fost modificate", "success");
        } else {
          showToast("Datele n-au fost trimise", "error");
        }
      });
      personalBlock
        .querySelector(".edit_block_data")
        .classList.add("active");
      personalBlock.querySelector(".edit_block_form").classList.remove("active");

        contactEditButton.classList.remove("off");
        cabinetNav.classList.remove("off");
    }
  }

  function editContactInfo(el) {
    const contactEditButton = document.querySelector(".contact_information_edit_block");

      const personalEditButton = document.querySelector('.personal-edit_button');

    if (el.querySelector(".edit_block.active")) {
      el.querySelector(".edit_block").classList.remove("active");
      el.querySelector(".save_block").classList.add("active");

        personalEditButton.classList.add("off");
        cabinetNav.classList.add("off");

      contactEditButton.querySelector(".edit_block_data").classList.remove("active");
      contactEditButton.querySelector(".edit_block_form").classList.add("active");

    } else {
      el.querySelector(".save_block").classList.remove("active");
      el.querySelector(".edit_block").classList.add("active");

      const email = document.getElementById("userEmail");
      const phone = document.getElementById("userPhone");
      const addition_phone = document.getElementById("userAdditionPhone");

      const data = {
        user_id: "{{$user->id}}",
        email: email.value,
        phone: phone.value,
        addition_phone: addition_phone.value,
        _token: "{{ csrf_token() }}",
      };
      console.log(data);
      $.ajax({
        url: "/contact-info",
        method: "POST",
        data: data,
      }).done(function (res) {
        console.log(res);
        if (res.status === "ok") {
          document.getElementById("userEmailText").textContent = res.data.email;
          document.getElementById("userPhoneText").textContent = res.data.phone;
          document.getElementById("userAddPhoneText").textContent = res.data.addition_phone;

          showToast("Datele au fost modificate", "success");
        } else {
          showToast("Datele n-au fost trimise", "error");
        }
      });
      contactEditButton.querySelector(".edit_block_data").classList.add("active");
      contactEditButton.querySelector(".edit_block_form").classList.remove("active");

        personalEditButton.classList.remove("off");
        cabinetNav.classList.remove("off");
    }
  }

  function editBillingInfo(button) {
    const block = document.querySelector('#billing-info');
    const editBlockData = block.querySelector('.edit_block_data');
    const editBlockForm = block.querySelector('.edit_block_form');
    const editButton = block.querySelector('.edit_block');
    const saveButton = block.querySelector('.save_block');

    // Afișează/ascunde secțiunile corespunzătoare la click
    if (editBlockData.classList.contains('active')) {
      editBlockData.classList.remove('active');
      editBlockForm.classList.add('active');
      editButton.classList.remove('active');
      saveButton.classList.add('active');

        cabinetNav.classList.add("off");
    } else {
      editBlockData.classList.add('active');
      editBlockForm.classList.remove('active');
      editButton.classList.add('active');
      saveButton.classList.remove('active');

        cabinetNav.classList.remove("off");
    }
  }

  function editSecurityInfo(button) {
        const block = document.querySelector('#security-info');
        const editBlockData = block.querySelector('.edit_block_data');
        const editBlockForm = block.querySelector('.edit_block_form');
        const editButton = block.querySelector('.edit_block');
        const saveButton = block.querySelector('.save_block');

        const deleteEditButton = document.querySelector('.delete-edit_button');

        // Comută între modurile de vizualizare și editare
        if (editBlockData.classList.contains('active')) {
            editBlockData.classList.remove('active');
            editBlockForm.classList.add('active');
            editButton.classList.remove('active');
            saveButton.classList.add('active');

            deleteEditButton.classList.add('off')
            cabinetNav.classList.add("off");
        } else {
            editBlockData.classList.add('active');
            editBlockForm.classList.remove('active');
            editButton.classList.add('active');
            saveButton.classList.remove('active');

            cabinetNav.classList.remove("off");
            deleteEditButton.classList.remove('off')
        }
    }

  function togglePasswordVisibility(fieldId, toggleButton) {
    const passwordField = document.getElementById(fieldId);
    const isPasswordHidden = passwordField.type === "password";

    // Schimbă tipul câmpului între 'text' și 'password'
    passwordField.type = isPasswordHidden ? "text" : "password";

    // Actualizează textul și imaginea butonului
    const img = toggleButton.querySelector('img');
    const text = toggleButton.querySelector('span');

    if (isPasswordHidden) {
        img.src = "/images/cabinet/eye-visible.png"; // Imagine pentru ascundere
        text.innerText = "{{ trans('cabinet.hide') }}";
    } else {
        img.src = "/images/cabinet/hide.png"; // Imagine pentru afișare
        text.innerText = "{{ trans('cabinet.show') }}";
    }
}

  function tabHandler(el) {
    const tabItems = document.querySelectorAll(".account-block_nav_item");
    const billingBlock = document.getElementById("billing-info");
    const detailBlock = document.getElementById("detail-info");
    const securityBlock = document.getElementById("security-info");

    // Ascunde toate secțiunile
    billingBlock.style.display = "none";
    detailBlock.style.display = "none";
    securityBlock.style.display = "none";

    // Îndepărtează clasa activă de la toate tab-urile
    tabItems.forEach((item) => {
        item.classList.remove("active");
    });

    // Adaugă clasa activă tab-ului selectat
    el.classList.add("active");

    // Afișează secțiunea corespunzătoare
    if (el.innerText === "{{trans('cabinet.account_billing')}}") {
        billingBlock.style.display = "block";
    } else if (el.innerText === "{{trans('cabinet.account_details')}}") {
        detailBlock.style.display = "block";
    } else if (el.innerText === "{{trans('cabinet.account_security')}}") {
        securityBlock.style.display = "block";
    }
}

function deleteAccount(button) {
    const block = button.closest('.delete_account_container');
    const deleteBlock = block.querySelector('.delete_block');
    const confirmBlock = block.querySelector('.confirm_block');

    // Afișează/ascunde secțiunile corespunzătoare la click
    if (deleteBlock.classList.contains('active')) {
        deleteBlock.classList.remove('active');
        confirmBlock.classList.add('active');
    } else {
        deleteBlock.classList.add('active');
        confirmBlock.classList.remove('active');
    }
}






function showDeleteConfirmation() {
    // Ascunde secțiunea originală și arată secțiunea de confirmare
    document.getElementById('deleteSection').querySelector('.delete_block').style.display = 'none';
    document.getElementById('deleteConfirmation').style.display = 'block';

    const securityEditButton = document.querySelector('.security-edit_button');
    securityEditButton.classList.toggle('off')
    cabinetNav.classList.toggle("off");
  }

  function cancelDelete() {
    // Revenire la secțiunea originală
    document.getElementById('deleteConfirmation').style.display = 'none';
    document.getElementById('deleteSection').querySelector('.delete_block').style.display = 'flex';
      const securityEditButton = document.querySelector('.security-edit_button');
      securityEditButton.classList.toggle('off')
      cabinetNav.classList.toggle("off");
  }

  function deleteAccount() {
    let password = document.getElementById('confirmPassword').value;
    const securityEditButton = document.querySelector('.security-edit_button');

    securityEditButton.classList.toggle('off');
    cabinetNav.classList.toggle("off");
    if (password) {
      // Logica pentru a șterge contul
      alert('Contul a fost șters!'); // Înlocuiește cu logica ta
    } else {
      alert('Te rog introdu parola pentru a continua.'); // Mesaj de eroare
    }
  }


</script>

@endpush
