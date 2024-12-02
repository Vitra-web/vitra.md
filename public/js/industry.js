const categoryFilterSwiper = new Swiper('.categoryFilerSwiper', {
    slidesPerView: "auto",
    spaceBetween: 0,
    pagination: false,
    // scrollbar: {
    //     el: '.swiper-scrollbar',
    // },

});

const categorySlider = new Swiper('.cardImgSlider', {
    slidesPerView: 1,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

