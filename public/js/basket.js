//total sum from each block separately depending on the value of the input
document.querySelectorAll(".input-number-increment").forEach(function(item) {
    item.addEventListener("click", function() {
        var input = this.closest(".input-number-group").querySelector(".input-number");
        var val = parseInt(input.value, 10);
        input.value = val + 1;
        updateTotalPrice(this);
    });
});

document.querySelectorAll(".input-number-decrement").forEach(function(item) {
    item.addEventListener("click", function() {
        var input = this.closest(".input-number-group").querySelector(".input-number");
        var val = parseInt(input.value, 10);
        if (val > 1) {
            input.value = val - 1;
            updateTotalPrice(this);
        }
    });
});

function updateTotalPrice(element) {
    console.log('element', element)
    var quantity = parseInt(element.closest(".input-number-group").querySelector(".input-number").value, 10);
    var pricePerUnit = parseInt(element.closest(".form__step-item__price").querySelector(".price-amount").textContent, 10);
    console.log('pricePerUnit', pricePerUnit)
    var totalPriceElement = element.closest(".form__step-item__price").querySelector(".total-price");

    totalPriceElement.textContent =  quantity * pricePerUnit;
}


//total summ from more options
var checkboxes = document.querySelectorAll(".checkbox__input");

checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
        updateMoreOptionsTotalPrice();
    });
});

updateMoreOptionsTotalPrice();

function updateMoreOptionsTotalPrice() {
    var totalPriceElement = document.querySelector(".price-body__nr-total");
    var totalPrice = 0;

    document.querySelectorAll(".checkbox__input:checked").forEach(function(checkbox) {
        var priceElement = checkbox.nextElementSibling.nextElementSibling.nextElementSibling;
        var priceText = priceElement.textContent.trim();
        var priceValue = parseFloat(priceText.replace(/[^\d.-]/g, ''));

        totalPrice += priceValue;
    });
    if(totalPriceElement) {
        totalPriceElement.textContent = totalPrice.toFixed(2) + " " + document.querySelector('.price-body__currency').textContent;
    }

}

//active class
var steps1 = document.querySelectorAll(".step__number");

for (var i = 0; i < steps1.length; i++) {
    steps1[i].addEventListener("click", function() {
        // Remove 'active' class from all steps
        var currentActive = document.querySelector(".step__number.active__number");
        if (currentActive) {
            currentActive.classList.remove("active__number");
        }

        // Add 'active' class to the clicked step
        this.classList.add("active__number");
    });
}

//acordion
function accordion(triggerSelector, activeClass) {
    const triggers = document.querySelectorAll(triggerSelector)
    triggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            trigger.classList.toggle(activeClass);
            const content = trigger.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        })
    })
}
accordion('.coupon-accordion__item-trigger', 'coupon-accordion__item-active')

const productCardsSwiper = new Swiper('.productCardsSwiper', {
    slidesPerView: 'auto',
    spaceBetween: 15,
    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },



});


