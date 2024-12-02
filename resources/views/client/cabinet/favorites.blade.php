@extends('layouts.cabinet')

@section('content')

    <div class=" ">

        <div class="product-cards__body user_favorites">
            @foreach($favoriteProducts as $product)
                @include('client.components.productPage.productCard', ['$product'=>$product])
            @endforeach
        </div>

    </div>
@endsection

@push('script')


    <script>



    </script>

@endpush
