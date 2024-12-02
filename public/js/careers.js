// Аccordion
function accordion() {
    const items = document.querySelectorAll('.vacancy-accordion__item-trigger')
    items.forEach(item => {
        item.addEventListener('click', () => {
            const parent = item.parentNode
            if (parent.classList.contains('vacancy-accordion__item-active')) {
                parent.classList.remove('vacancy-accordion__item-active')
            } else {
                document
                    .querySelectorAll('.vacancy-accordion__item')
                    .forEach(child => child.classList.remove('vacancy-accordion__item-active'))
                parent.classList.add('vacancy-accordion__item-active')
            }
        })
    })
}
accordion()


// Step Form
function stepForm() {
    const steps = document.querySelectorAll('.form__step')
    const prevBrn = document.querySelector('.prev__step')
    const nextBrn = document.querySelector('.next__step')
    // const form = document.querySelector('.steps__form')
    const stepNumbers = document.querySelectorAll('.step__number')
    const progress = document.querySelector('.progress__success')

    // form.addEventListener('submit', (e) => e.preventDefault())

    let formSteps = 0

    if(nextBrn) {
        nextBrn.addEventListener('click', () => {
            if (formSteps === steps.length) {
                formSteps = steps.length - 1
            }
            formSteps++

            updadeFormSteps()
        })
    }

    if(prevBrn) {
        prevBrn.addEventListener('click', () => {
            formSteps--
            stepNumbers[formSteps + 1].classList.remove('active__number')
            updadeFormSteps()
        })
    }


    function updadeFormSteps() {
        steps.forEach((step) => {
            step.classList.contains('active') && step.classList.remove('active')
        })

        stepNumbers[formSteps].classList.add('active__number')
        steps[formSteps].classList.add('active')

        if (formSteps === 0) {
            prevBrn.disabled = true
        } else {
            prevBrn.disabled = false
        }

        if (formSteps === steps.length - 1) {
            nextBrn.disabled = true
        } else {
            nextBrn.disabled = false
        }

        const actives = document.querySelectorAll('.active__number')
        const percent = ((actives.length - 1) / (stepNumbers.length - 1)) * 100 + '%'

        progress.style.width = percent
    }

    updadeFormSteps()
}
// stepForm()
