@extends('layouts.cabinet')

@section('content')

  <!-- Orders Information -->
<div id="orders-info" class="cabinet_block">


<!-- Titlul secțiunii -->
  <div class="d-flex justify-content-between">
    <h3 class="account-block_title">
      {{trans('cabinet.order_command')}}
    </h3>
  </div>

  <!-- Blocul cu informațiile despre comenzi -->
  <div class="order_information_edit_block">
    <!-- Blocul vizual de date (când nu editezi) -->
    <div class="edit_block_data active">
      <p class="account-block_label">{{trans('cabinet.order_status')}}</p>
      <p class="account-block_value" id="orderStatusText"> </p>
    </div>
  </div>

  <!-- Buton Începe Cumpărăturile -->
   <div class="button-orders">
  <div class="start-shopping-btn">


                


    <button class="button-shop">
      <img src="/images/cabinet/shopping-cart.png" alt="edit-text" class="icon-shop" />
     
     <b> {{trans('cabinet.start_shopping')}}</b>
    </button>
  </div>
</div>



</div>



@endsection

@push('script')


    <script>

function editOrderInfo(button) {
    const block = document.querySelector('#orders-info');
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
    } else {
      editBlockData.classList.add('active');
      editBlockForm.classList.remove('active');
      editButton.classList.add('active');
      saveButton.classList.remove('active');
    }
  }
</script>


    </script>

@endpush
