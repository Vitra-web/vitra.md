//Swipers


const missionSwiper = new Swiper('.missionSwiper', {
    slidesPerView: 1,
    spaceBetween: 30,
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
            slidesPerView: 1,
            spaceBetween: 30
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 70
        },
    },

});


const retailSwiper = new Swiper('.retailSwiper', {

    // If we need pagination
    slidesPerView: "auto",
    spaceBetween: 15,
    pagination: false,
    loop: true,

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    // breakpoints: {
    //     768: {
    //         slidesPerView: "auto",
    //         spaceBetween: 23
    //     },
    // }
});

const logisticsSwiper = new Swiper('.logisticsSwiper', {

    // If we need pagination
    slidesPerView: "auto",
    spaceBetween: 15,
    pagination: false,
    loop: true,
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
        768: {
            slidesPerView: "auto",
            spaceBetween: 23
        },
    }

});

const horecaSlider = new Swiper('.horecaSlider', {

    // If we need pagination
    slidesPerView: "auto",
    spaceBetween: 15,
    pagination: false,
    loop: true,
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
        768: {
            slidesPerView: "auto",
            spaceBetween: 23
        },
    }
});

const lifeSlider = new Swiper('.lifeSwiper', {

    slidesPerView: "auto",
    spaceBetween: 15,
    pagination: false,
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    breakpoints: {
        768: {
            slidesPerView: "auto",
            spaceBetween: 23
        },
    }

});

const lifeFilterSwiper = new Swiper('.lifeFilerSwiper', {
    slidesPerView: "auto",
    spaceBetween: 0,
    pagination: false,
    // scrollbar: {
    //     el: '.swiper-scrollbar',
    // },
    breakpoints: {
        768: {
            spaceBetween: 0
        },
    }

});


const newsSwiper = new Swiper('.newsSwiper', {
    slidesPerView: 4,
    spaceBetween: 15,
    loop: true,
    loopAdditionalSlides: 1,
    // pagination: {
    //     el: ".swiper-pagination",
    //     clickable: true,
    // },
    // navigation: {
    //     nextEl: ".swiper-button-next",
    //     prevEl: ".swiper-button-prev",
    // },
    breakpoints: {
        320: {
            slidesPerView: 1,
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
    },

});


let scrolling = 0;
let scrollFlag = 1;

function scrollEvent(event) {

    if (document.querySelector('.iti__country-list.iti__hide')) {
        if (event.deltaY < 0) {
            if (scrolling !== 0  && !document.querySelector('.main__body.active')) {
                const btnScrollToTop = document.querySelector('.btnScrollToTop');
                const svgIcons = btnScrollToTop.querySelectorAll('.cls-1');
                // const header =document.querySelector('.header')
                const headerContainer = document.querySelector('.header__container')
                // const feedbackBlock = document.querySelector('.feedback_block');
                scrolling += 100;

                btnScrollToTop.style.backgroundColor = '#000';
                svgIcons.forEach(icon => icon.style.stroke = '#fff');
                btnScrollToTop.style.transform = `translateY(${-scrolling}vh)`;
                // header.style.transform = `translateY(${-scrolling}vh)`;
                // headerContainer.style.transform = `translateY(${-scrolling}vh)`;
                // feedbackBlock.style.transform = `translateY(${-scrolling}vh)`;
                document.getElementById(
                    "main"
                ).style.transform = `translateY(${scrolling}vh)`;

                btnScrollToTop.addEventListener('click', () => {
                    scrolling = 0;
                    document.getElementById(
                        "main"
                    ).style.transform = `translateY(${scrolling}vh)`;
                    btnScrollToTop.style.display = 'none';
                })
                if (scrolling === 0) {
                    btnScrollToTop.style.display = 'none';
                    // feedbackBlock.style.display = 'none';
                    // header.classList.remove('scrolled');
                    headerContainer.classList.remove('scrolled');
                    // header.style.top = '';
                }
            }
        } else if (event.deltaY > 0 && !document.querySelector('.main__body.active')) {
                const btnScrollToTop = document.querySelector('.btnScrollToTop');
                const svgIcons = btnScrollToTop.querySelectorAll('.cls-1');
                // const header =document.querySelector('.header')
                const headerContainer = document.querySelector('.header__container')
                // const feedbackBlock = document.querySelector('.feedback_block');
                btnScrollToTop.style.display = 'block';
                // feedbackBlock.style.display = 'block';
                btnScrollToTop.style.backgroundColor = '#000';
                svgIcons.forEach(icon => icon.style.stroke = '#fff');

                // header.classList.add('scrolled');
                headerContainer.classList.add('scrolled');
                headerContainer.style.top = '0';
                if (scrolling > -800) {
                    scrolling -= 100;
                    btnScrollToTop.style.transform = `translateY(${-scrolling}vh)`;
                    // header.style.transform = `translateY(${-scrolling}vh)`;
                    // feedbackBlock.style.transform = `translateY(${-scrolling}vh)`;
                    document.getElementById(
                        "main"
                    ).style.transform = `translateY(${scrolling}vh)`;

                }
                if (scrolling === -800) {
                    btnScrollToTop.style.backgroundColor = '#fff';
                    svgIcons.forEach(icon => icon.style.stroke = '#000');
                }
                btnScrollToTop.addEventListener('click', () => {
                    scrolling = 0;
                    document.getElementById("main").style.transform = `translateY(${scrolling}vh)`;
                    btnScrollToTop.style.display = 'none';
                })
        }
    }


}

function wheelHandler(event) {
    if (scrollFlag === 1) {
        setTimeout(() => {
            scrollEvent(event)
            scrollFlag = 1;
        }, 50)
        scrollFlag = 0;
    }
}

function checkWidth() {
    if (window.innerWidth >= 1500) {
        document.getElementById("main").style.transform = `translateY(${scrolling}vh)`;
        window.addEventListener("wheel", wheelHandler);

    } else {
        scrolling = 0;
        document.getElementById("main").style.transform = 'unset';
        window.removeEventListener("wheel", wheelHandler, false);
    }
}

// Initial check
checkWidth();

// Add event listener for resize to monitor width changes
window.addEventListener("resize", checkWidth);



/**
 * Only call a function after all selected images have loaded.  Images parameter can be anything
 * acceptable by jQuery().
 */
// function imagesLoaded(images, fn) {
//     var $imgs = $(images),
//         i     = 0,
//         exec  = () => {++i >= $imgs.length && fn(); };
//
//     typeof fn == 'function' && $imgs.each(function(index, el) {
//         if (this.complete) {
//             exec();
//         } else {
//             this.addEventListener('load', exec);
//             this.addEventListener('error', exec);
//         }
//     });
// }
//
//
// // Scrollbar
// $(function () {
//     let opts = {
//         className: 'os-custom',
//         callbacks: {
//             onInitialized: initDrag
//         }
//     };
//
//     $('.gallery-carousel').each(function(index, el){
//         var $this = $(this);
//         imagesLoaded($this.find('img'), () => {
//             $this.data('os', OverlayScrollbars(el, opts));
//         });
//     });
// });
//
//
// initDrag = function () {
//     let $this = $('.gallery-carousel'),
//         el        = $this[0],
//         isDown    = false,
//         mult      = 3, // speed
//         startX, scrollLeft;
//
//     $this.on('mousedown', e => {
//         isDown     = true;
//         startX     = e.pageX - el.offsetLeft;
//         scrollLeft = $this.data('os').scroll().position.x;
//
//     }).on('mouseleave mouseup', e => {
//         isDown = false;
//
//     }).on('mousemove', e => {
//         if(isDown) {
//             e.preventDefault();
//
//             let x    = e.pageX - el.offsetLeft,
//                 walk = (x - startX) * -mult;
//
//             $this.data('os').scroll({x: (scrollLeft+walk)+'px'}, 0);
//         }
//     });
// }
//

