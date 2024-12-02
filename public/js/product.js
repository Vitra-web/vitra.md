var swiper = new Swiper(".galleryThumbs", {
    spaceBetween: 10,
    slidesPerView: 'auto',
    freeMode: true,
    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".gallerySwiper", {
    spaceBetween: 10,
    loop:true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});



const singleProductSwiperMore = new Swiper('.singleProductSwiperMore', {
    slidesPerView: 4,
    spaceBetween: 15,
    loop: true,
    loopAdditionalSlides: 1,
    // pagination: {
    //     el: ".swiper-pagination",
    //     clickable: true,
    // },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 15
        },
        470: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 30
        },
        1080: {
            slidesPerView: 4,
            spaceBetween: 30
        },
        1380: {
            slidesPerView: 5,
            spaceBetween: 30
        },
    },

});



const recentProductSlider = new Swiper('.recentProductSlider', {
    slidesPerView: 6,
    spaceBetween: 20,
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

});

