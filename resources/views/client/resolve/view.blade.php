@extends('layouts.client2')

@section('content')
    <main>
        <section class="custom-container" style="margin-top:120px">

            @include('client.components.breadСrumbs')

          <div class="row resolve-container" id="resolveContainer">
                @foreach($products as $product)
                @include('client.components.productPage.productCard', ['$product'=>$product])
                @endforeach

          </div>

        </section>

        <div class="about-industry-container">
            <h2 class="about-descr__title">{{trans('labels.specialist_in')}}</h2>

            @include('client.components.industryBlock')
        </div>

    </main>

@endsection

@push('script')
    <script>
        const products = {!!json_encode($products)  !!};
        console.log(products)
        function addToBasket(productId) {
            let product = products.find(product =>product.id === productId );
            console.log(product)
            const variant = product['variants']

            const data = {
                'product': product,
                'product_variant': variant[0],
                'quantity': 1
            }
            console.log('data', data)
            const existingProducts = localStorage.getItem('vitraProducts');
            if(existingProducts) {
                const productsParsed = JSON.parse(existingProducts)
                productsParsed.push(data)
                localStorage.setItem('vitraProducts', JSON.stringify(productsParsed) )
                document.getElementById('cartCount').textContent=String(productsParsed.length)

            } else {
                localStorage.setItem('vitraProducts', JSON.stringify([data]) )
                const headerCartCount = document.createElement('div')
                headerCartCount.classList.add('header_cart_count_black')
                headerCartCount.id = 'cartCount'
                headerCartCount.innerHTML='1';
                document.querySelector('.header__wishlist-cart').append(headerCartCount)
            }
            showToast('{{trans('labels.product_added')}}', 'success')
        }


        </script>

@endpush
