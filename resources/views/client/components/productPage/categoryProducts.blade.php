@if(count($similarProducts)>0)

<section class="singleslider-product__more mb-5">
    <div class="custom-container">
        <h2 class="features-section__title">{!! trans('labels.more_from') !!}</h2>

        <div class="swiper singleProductSwiperMore product-more__swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper product-more__swiper-wrapper">
                <!-- Slides -->
                @foreach($similarProducts as $product)

                    @include('client.components.productPage.productCard', ['$product'=>$product])

                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </div>
</section>
@endif

@push('script')
    <script>
        if(productsFavorite && similarProducts.length > 0) {
            const favoritesParsed = JSON.parse(productsFavorite)

            if(similarProducts.length>0) {
                similarProducts.forEach(item => {
                    favoritesParsed.forEach(favorite => {
                        if(favorite.product_id === item.id) {
                            const productCard = document.getElementById('productCard'+item.id);
                            const favoriteImage = productCard.querySelector('.favorite_icon')
                            favoriteImage.src='/images/product/heart-red-full.png';
                            favoriteImage.dataset.selected='1';
                        }
                    })
                })
            }
        }
        //
        // const singleProductSwiperMore = new Swiper('.singleProductSwiperMore', {
        //     slidesPerView: 4,
        //     spaceBetween: 15,
        //     loop: true,
        //     loopAdditionalSlides: 1,
        //     // pagination: {
        //     //     el: ".swiper-pagination",
        //     //     clickable: true,
        //     // },
        //     navigation: {
        //         nextEl: ".swiper-button-next",
        //         prevEl: ".swiper-button-prev",
        //     },
        //     breakpoints: {
        //         320: {
        //             slidesPerView: 1,
        //             spaceBetween: 15
        //         },
        //         470: {
        //             slidesPerView: 2,
        //             spaceBetween: 20
        //         },
        //         768: {
        //             slidesPerView: 3,
        //             spaceBetween: 30
        //         },
        //         1080: {
        //             slidesPerView: 4,
        //             spaceBetween: 30
        //         },
        //     },
        //
        // });
    </script>
    @endpush
