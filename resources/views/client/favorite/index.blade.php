@extends('layouts.client2')

@section('content')
    <main>
        <section class="custom-container favorite" style="margin-top:120px">

            @include('client.components.breadСrumbs')

          <div class="resolve-container favorite-container" id="favoriteContainer">
              @if(count($products) > 0)
                @foreach($products as $product)
                    @include('client.components.productPage.productCard', ['$product'=>$product])
                @endforeach

              @endif
          </div>
            @if(count($products) == 0)
                    <div class="empty_basket">
                        <img class="empty_basket_img" src="/images/cabinet/favorite.png" alt="favorite">
                        <div class="empty_basket_description_block">
                            <p class="empty_basket_text">{{trans('labels.nothing_in_favorite')}}</p>
                            <p class="empty_basket_description">{{trans('labels.empty_basket_description')}}</p>
                            <a href="{{url('/')}}" class="custom-btn empty_basket_btn">{{trans('labels.add_favorite')}}</a>
                        </div>
                    </div>
            @endif

        </section>


    </main>

@endsection

@push('script')
    <script>



        </script>

@endpush
