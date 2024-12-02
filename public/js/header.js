// let menuBtn = document.querySelector('.menu-btn');
let menuBtn = document.getElementById('menuBtn');
let menuBtnOpen = document.querySelector('.menu-btn__open');
let menuBtnClose = document.querySelector('.menu-btn__close');
let menuText = document.querySelector('.menu-text');
// let menu = document.querySelector('.nav--left');
let menu = document.getElementById('menuContent');
let menuMobile = document.querySelector('.header_mobile');
let menuItem = document.querySelectorAll('.nav__link--left');
let dropLang = document.querySelector('.dropdown');
let dropContent = dropLang.querySelector('.dropdown-content');

let accordionLeftContent = dropLang.querySelector('.accordion__left-content');


dropLang.addEventListener('click', function() {
    dropContent.classList.toggle('active');
});

// menuItem.forEach(function(menuItem) {
//     menuItem.addEventListener('click', function() {
//         menuBtn.classList.toggle('active');
//         menu.classList.toggle('active');
//     })
// })

function closeMenu(event) {
    if (event.target.id.toString() !== "menuBtn" && event.target.id.toString() !== "menuContent" && !event.target.classList.contains('menu-text') && !event.target.classList.contains('bar') && !event.target.classList.contains('menu-btn')) {
        menu.classList.remove('active');
        window.removeEventListener('click', closeMenu);
    }
}

menuBtn.addEventListener('click', function() {
    if (window.innerWidth <= 1024) {
        menuMobile.classList.add('active');
        document.body.style.position = 'fixed';

    } else {
        menu.classList.toggle('active');
        window.addEventListener('click', closeMenu);
    }
});

if(menuBtnClose) {
    menuBtnClose.addEventListener('click', function() {
        menuMobile.classList.toggle('active');
        document.body.style.position = 'static';
    });
}

window.addEventListener('resize', ()=> {
    if (window.innerWidth < 1024 && menu.classList.contains('active')) {
        menu.classList.remove('active');
    }
});
