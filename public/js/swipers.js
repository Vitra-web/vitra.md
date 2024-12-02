
const industrySwiper = new Swiper('.industrySwiper', {
    spaceBetween: 15,
    loop: true,
    breakpoints: {
        320: {
            slidesPerView: 1,
        },
        630: {
            slidesPerView: 2,
        },
        992: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 4,
        },
    },

});



let moreIdeas = new Swiper('.moreIdeas', {
    slidesPerView: "auto",
    spaceBetween: 15,
    pagination: false,
    loop:true,
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },

    // Responsive breakpoints
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 15
        },
        450: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        951: {
            slidesPerView: 3,
            spaceBetween: 20
        },
        1351: {
            slidesPerView: 4,
            spaceBetween: 20
        },
    }
});


const productsSwiper = new Swiper('.productsSwiper', {

    // If we need pagination
    slidesPerView: "auto",
    spaceBetween: 15,
    pagination: false,
    loop:true,
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    breakpoints: {
        480: {
            slidesPerView: "auto",
            spaceBetween: 20
        },
        // 768: {
        //     slidesPerView: "auto",
        //     spaceBetween: 20
        // },
    }
});

const recommendsCategorySwiper = new Swiper('.recommendsCategorySwiper', {

    // If we need pagination
    slidesPerView: 4,
    spaceBetween: 15,
    pagination: false,
    loop:true,
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    // Responsive breakpoints
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 15
        },
        450: {
            slidesPerView: 2,
            spaceBetween: 20
        },
        951: {
            slidesPerView: 3,
            spaceBetween: 20
        },
        1351: {
            slidesPerView: 4,
            spaceBetween: 20
        },
    }
});


const clientsSwiper = new Swiper('.clientsSwiper', {

    slidesPerView: 2,
    spaceBetween: 15,
    pagination: false,
    loop:true,
    disableOnInteraction: true,
    pauseOnMouseEnter: true,
    autoplay: {
        delay: 3000,
    },
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 15
        },
        480: {
            slidesPerView: 3,
            spaceBetween: 15
        },
        640: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 50,
        },
    }

});

const clientsMobileSwiper = new Swiper('.clientsMobileSwiper', {

    slidesPerView: 2,
    spaceBetween: 15,
    pagination: false,
    loop:true,
    disableOnInteraction: true,
    pauseOnMouseEnter: true,
    autoplay: {
        delay: 2500,
    },
    navigation: {
        nextEl: '.swiper-button-next-unique',
        prevEl: '.swiper-button-prev-unique',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 15
        },
        480: {
            slidesPerView: 3,
            spaceBetween: 15
        },
        640: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 50,
        },
    }

});
