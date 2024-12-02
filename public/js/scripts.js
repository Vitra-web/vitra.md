if (window.innerWidth >= 768) {
    window.addEventListener('scroll', function (event) {
        var scrollPosition = window.scrollY || window.pageYOffset;

        if (scrollPosition >= 35) {

            document.querySelector('.header').classList.add('scrolled');
            document.querySelector('.header__container').classList.add('scrolled');
            document.querySelector('.header').style.top = '0';

        } else {
            document.querySelector('.header').classList.remove('scrolled');
            document.querySelector('.header__container').classList.remove('scrolled');
            document.querySelector('.header').style.top = '';

            if (scrollPosition <= 35) {
                document.querySelector('.nav--left').style.top = '';

            }
        }
    });
} else {
    let lastScrollTop = 0;

    window.addEventListener("scroll", function () {
        const st = window.pageYOffset || document.documentElement.scrollTop;
        if (st > lastScrollTop) {
            // downscroll code
            document.querySelector('.header').classList.remove('scrolled');
            document.querySelector('.header__container').classList.remove('scrolled');
            document.querySelector('.header').style.top = '';

        } else if (st < lastScrollTop) {
            // upscroll code
            document.querySelector('.header').classList.add('scrolled');
            document.querySelector('.header__container').classList.add('scrolled');
            document.querySelector('.header').style.top = '0';

            if (window.pageYOffset < 100) {
                document.querySelector('.header__container').classList.remove('scrolled');
            }
        }
        lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
    }, false);


    // window.addEventListener('scroll', function(event) {
    //     // console.log(event.deltaY )
    //     console.log(this.oldScroll > this.scrollY);
    //     if(event.deltaY <0 ) {
    //         document.querySelector('.header').classList.add('scrolled');
    //         document.querySelector('.header__container').classList.add('scrolled');
    //         document.querySelector('.header').style.top = '0';
    //     }else {
    //         document.querySelector('.header').classList.remove('scrolled');
    //         document.querySelector('.header__container').classList.remove('scrolled');
    //         document.querySelector('.header').style.top = '';
    //
    //     }
    // })
    // $(document).on('touchmove', function() { //touchmove works for iOS, I don't know if Android supports it
    //     $(document).trigger('wheel');
    // });
}


document.addEventListener("DOMContentLoaded", function () {
    const btnScrollToTop = document.querySelector('.btnScrollToTop');
    const footer = document.querySelector('footer');
    const svgIcons = btnScrollToTop.querySelectorAll('.cls-1');

    function toggleScrollToTopButton() {
        const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        const windowHeight = window.innerHeight;
        const documentHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight, document.documentElement.clientHeight, document.documentElement.scrollHeight, document.documentElement.offsetHeight);
        const scrollThreshold = documentHeight * 0.1; // 20% of the document height


        if (scrollPosition >= scrollThreshold) {
            btnScrollToTop.style.display = 'block';

            btnScrollToTop.style.backgroundColor = '#000';
            svgIcons.forEach(icon => icon.style.stroke = '#fff');
        } else {
            btnScrollToTop.style.display = 'none';

        }

        if (scrollPosition + windowHeight >= footer.offsetTop) {
            btnScrollToTop.style.backgroundColor = '#fff';
            svgIcons.forEach(icon => icon.style.stroke = '#000');
        }
    }

    window.addEventListener('scroll', toggleScrollToTopButton);
    btnScrollToTop.addEventListener('click', () => {
        window.scrollTo({top: 0, behavior: 'smooth'});
    })
    toggleScrollToTopButton();


});


function accordion() {
    const items = document.querySelectorAll('.accordion__item-trigger')
    items.forEach(item => {
        item.addEventListener('click', () => {
            const parent = item.parentNode
            if (parent.classList.contains('accordion__item-active')) {
                parent.classList.remove('accordion__item-active')
            } else {
                document
                    .querySelectorAll('.accordion__item')
                    .forEach(child => child.classList.remove('accordion__item-active'))
                parent.classList.add('accordion__item-active')
            }
        })
    })
}

accordion()

function accordionFooter() {
    const items = document.querySelectorAll('.footer-accordion__item-trigger')
    items.forEach(item => {
        item.addEventListener('click', () => {
            const parent = item.parentNode
            if (parent.classList.contains('footer-accordion__item-active')) {
                parent.classList.remove('footer-accordion__item-active')
            } else {
                document
                    .querySelectorAll('.footer-accordion__item')
                    .forEach(child => child.classList.remove('footer-accordion__item-active'))
                parent.classList.add('footer-accordion__item-active')
            }
        })
    })
}

accordionFooter()

let overlay;

function createOverlay() {
    overlay = document.createElement('div');
    overlay.classList.add('overlay-block');
    document.querySelector('main').appendChild(overlay);
}

function removeOverlay() {
    if (overlay) {
        overlay.remove();
        overlay = null;
    }
}


// Модальное окно
function bindModal(trigger, modal, close) {
    trigger = document.querySelector(trigger),
        modal = document.querySelector(modal),
        close = document.querySelector(close)

    const body = document.body

    trigger.addEventListener('click', e => {
        e.preventDefault()
        modal.style.display = 'flex'
        body.classList.add('locked')
    });
    close.addEventListener('click', () => {
        modal.style.display = 'none'
        body.classList.remove('locked')
    });

    modal.addEventListener('click', e => {
        if (e.target === modal) {
            modal.style.display = 'none'
            body.classList.remove('locked')
        }
    })
}

// ПЕРВЫЙ аргумент - класс кнопки, при клике на которую будет открываться модальное окно.
// ВТОРОЙ аргумент - класс самого модального окна.
// ТРЕТИЙ аргумент - класс кнопки, при клике на которую будет закрываться модальное окно.
bindModal('.open_download_modal', '.modal__wrapper-download_pdf', '.close__download_modal')


let icon = {
    success:
        '<span class="material-symbols-outlined">task_alt</span>',
    danger:
        '<span class="material-symbols-outlined">error</span>',
    warning:
        '<span class="material-symbols-outlined">warning</span>',
    info:
        '<span class="material-symbols-outlined">info</span>',
};

const showToast = (
    message = "Sample Message",
    toastType = "info",
    duration = 5000) => {
    if (
        !Object.keys(icon).includes(toastType))
        toastType = "info";

    let box = document.createElement("div");
    box.classList.add(
        "toast", "show", `toast-${toastType}`);
    box.innerHTML = ` <div class="toast-content-wrapper">
                      <div class="toast-icon">
                      ${icon[toastType]}
                      </div>
                      <div class="toast-message">${message}</div>
                      <div class="toast-progress"></div>
                      </div>`;
    duration = duration || 5000;
    box.querySelector(".toast-progress").style.animationDuration =
        `${duration / 1000}s`;

    box.addEventListener("click", function () {
        setTimeout(() => {
            box.style.animationDuration = `${duration / 1000}s`;
            box.remove();
        }, 300);
    })

    document.body.appendChild(box)
    setTimeout(() => {
        box.remove();
    }, 5000);
};

function phoneCountryHandler(phoneInputID) {

    var input = document.querySelector(phoneInputID);
    var iti = window.intlTelInput(input, {
        allowDropdown: true,
        // autoHideDialCode: false,
        autoPlaceholder: "polite",
        // dropdownContainer: document.body,
        excludeCountries: ["pm", "mf"],
        formatOnDisplay: true,
        formatAsYouType: true,
        geoIpLookup: callback => {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
        },
        // hiddenInput: "full_number",
        initialCountry: "md",
        separateDialCode: true,
        // customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
        //     console.log('selectedCountryData', selectedCountryData)
        //     console.log('selectedCountryPlaceholder', selectedCountryPlaceholder)
        //     if(selectedCountryData.iso2 ==='md'){
        //         return selectedCountryPlaceholder.slice(1);
        //     } else return selectedCountryPlaceholder
        //
        // },
        // localizedCountries: { 'de': 'Deutschland' },
        nationalMode: true,
        strictMode: false,
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        placeholderNumberType: "MOBILE",
        validationNumberType: "MOBILE",
        preferredCountries: ['md', 'ro', 'ru'],
        // separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
    });


    $(phoneInputID).on("countrychange", function (event) {

        // Get the selected country data to know which country is selected.
        var selectedCountryData = iti.getSelectedCountryData();

        // Get an example number for the selected country to use as placeholder.
        newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

            // Reset the phone number input.
            iti.setNumber("");
        // Convert placeholder as exploitable mask by replacing all 1-9 numbers with 0s
        mask = newPlaceholder.replace(/[1-9]/g, "0");


        // Apply the new mask for the input
        $(this).mask(mask);
    });


    // When the plugin loads for the first time, we have to trigger the "countrychange" event manually,
    // but after making sure that the plugin is fully loaded by associating handler to the promise of the
    // plugin instance.

    iti.promise.then(function () {
        $(phoneInputID).trigger("countrychange");
    });
    return iti;
}

function checkInputField(input, dangerElement, dangerText) {
    if (input.type === 'email' && !input.value.includes('@')) {
        input.style.borderColor = '#f63c3c';
        dangerElement.style.display = 'block';
        dangerElement.textContent = 'Enter a valid email';
    }
    if (input.value === '') {
        input.style.borderColor = '#f63c3c';
        dangerElement.style.display = 'block';
        dangerElement.textContent = dangerText;
    } else {
        if (dangerElement.textContent !== '') {
            input.style.borderColor = '#1f1f1f';
            dangerElement.style.display = 'none';
        }
        if (input.type === 'email' && !input.value.includes('@')) {
            input.style.borderColor = '#f63c3c';
            dangerElement.style.display = 'block';
            dangerElement.textContent = 'Enter a valid email';
        }
    }
}

function addToFavorite(el, productId, token, addText = 'Product a adaugat la favoride', userId = null) {
    const img = el.querySelector('.favorite_icon')
    // const storageFavorite = window.localStorage.getItem('vitraFavorite');
    const storageFavorite = $.cookie('vitraFavorite');
    if (img.dataset.selected === '0') {
        img.src = '/images/product/heart-red-full.png';
        img.dataset.selected = '1';
        if (!userId) {
            if (storageFavorite) {
                const productsFavorite = JSON.parse(storageFavorite);
                productsFavorite.push({'product_id': productId})
                $.cookie('vitraFavorite', JSON.stringify(productsFavorite), {path: '/'});
                // window.localStorage.setItem('vitraFavorite', JSON.stringify(productsFavorite))

            } else {
                $.cookie('vitraFavorite', JSON.stringify([{'product_id': productId}]), {path: '/'});
                // window.localStorage.setItem('vitraFavorite', JSON.stringify([{'product_id': productId}]))
            }
            showToast(addText, 'success')
        } else {
            const data = {
                'user_id': userId,
                'product_id': productId,
                'action': 'add',
                "_token": token,
            }
            console.log(data)

            $.ajax({
                url: "/toggle-favorite",
                method: 'POST',
                data: data,

            }).done(function (res) {
                console.log(res)
                if (res.status === 'ok') {
                    showToast(addText, 'success')
                } else {
                    showToast('Datele n-au fost trimise', 'danger')
                }
            });

        }
    } else {
        img.src = '/images/product/heart-red.png';
        img.dataset.selected = '0';
        if (!userId) {
            const productsFavorite = JSON.parse(storageFavorite);
            const newProducts = productsFavorite.filter(item => item.product_id !== productId)
            $.cookie('vitraFavorite', JSON.stringify(newProducts), {path: '/'});
        } else {
            const data = {
                'user_id': userId,
                'product_id': productId,
                'action': 'remove',
                "_token": token,
            }
            console.log(data)

            $.ajax({
                url: "/toggle-favorite",
                method: 'POST',
                data: data,
            }).done(function (res) {
                console.log(res)
                if (res.status === 'ok') {
                } else {
                    showToast('Datele n-au fost trimise', 'danger')
                }
            });
        }
    }
}

function addQuantityToBasket(quantity) {
    if (document.getElementById('cartCount')) {
        document.getElementById('cartCount').textContent = String(quantity)
    } else {

        const headerCartCount = document.createElement('div')
        if (document.getElementById('basketHeaderWhiteImage')) {
            headerCartCount.classList.add('header_cart_count_black')
        } else {
            headerCartCount.classList.add('header_cart_count')
        }

        headerCartCount.id = 'cartCount'
        headerCartCount.innerHTML = quantity;
        document.querySelector('.header__wishlist-cart').append(headerCartCount)

    }
}

function addToBasket(productId, token, addText = 'Adăugat în coș', userId = null) {
    const storageBasket = $.cookie('vitraProducts');
    let quantity = 0;

    let productWithVariant = false;
    try {
        productWithVariant = categoryProducts[0]['code_1c'];
    } catch (e) {
        console.log(e)
    }
    if (!userId) {

        let productsFavorite = storageBasket ? JSON.parse(storageBasket) : [];
        const existingProduct = productsFavorite.find(product => product.product_id === productId);

        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            productsFavorite.push({'product_id': productId,
                                    'quantity': 1,
                                    'product_variant': productWithVariant ? productWithVariant : '',
                                    'product_moduline': '',
            });
        }
        console.log(productsFavorite,'productsFavorite')

        quantity = productsFavorite.reduce((sum, product) => sum + product.quantity, 0);
        $.cookie('vitraProducts', JSON.stringify(productsFavorite), {path: '/'});
        addQuantityToBasket(productsFavorite.length);
        showToast(addText, 'success');

    } else {
        const data = {
            'user_id': userId,
            'product_id': productId,
            'product_variant': productWithVariant ? productWithVariant : '',
            'product_moduline': '',
            'quantity': 1,
            "_token": token,
        }
        console.log(data)

        $.ajax({
            url: "/add-basket",
            method: 'POST',
            data: data,

        }).done(function (res) {
            console.log(res)
            if (res.status === 'ok') {
                quantity = res.data.quantity;
                addQuantityToBasket(quantity)
                showToast(addText, 'success')
            } else {
                showToast('Datele n-au fost trimise', 'danger')
            }
        });

    }


}

function languageReplace(lang, nameRo, nameRu, nameEn) {
    let name = '';
    switch (lang) {
        case 'ro':
            name = nameRo;
            break;
        case 'ru':
            name = nameRu;
            break;
        case 'en':
            name = nameEn;
            break;
        default:
            name = '';

    }
    return name;
}
