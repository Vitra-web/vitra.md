@php
    $count=1;
@endphp


<section class="category-section">
    <div class="custom-container category-section__container row pt-4">
        <div class="col-md-6 ">
            <h3 class="fs-1 p-4">{{trans('labels.who_we')}}</h3>
            <div class="about_description">

                {!!$language->replace($aboutPage->description_ro, $aboutPage->description_ru,$aboutPage->description_en )!!}
            </div>

        </div>

        <div class="category-counter__cards-body col-md-6 row">
            @foreach($benefits as $benefit)
                <div class="category-counter__cards col-sm-6">
                    <div class="category-counter__cards-img">
                        <img src="{{url('storage/'.$benefit->image)}}" alt="Benefit image">

                    </div>
                    <div class="cards__counter d-flex">
                        <div class="counter ">
                            <div class="counter__number" id="num{{$count}}"></div>
                            <p class="counter__text me-2">{{$benefit->sort_order == 1 ? 'ani': '+'}} </p>
                        </div>
                        <p class="cards__counter-text">{{$language->replace($benefit->title_ro, $benefit->title_ru,$benefit->title_en )}}</p>
                    </div>
                </div>
                @php
                $count++
                 @endphp
            @endforeach


        </div>
    </div>
</section>

@push('script')
    <script>
        const benefits ={!! $benefits !!};


        // Num counter
        function numCounter(selector, number, time, step) {
            const counter = document.querySelector(selector);
            if (counter.innerHTML) return;
            let res = 0;
            const allTime = Math.round(time / (number / step));

            let interval = setInterval(() => {
                res = res + step;

                if (res >= number) {
                    clearInterval(interval);
                    res = number;
                }
                counter.innerHTML = res;
            }, allTime);
        }


        function startCountersWhenVisible() {
            const countersData = [
                { selector: '#num1', number: Number(benefits[0].number), time: 2000, step: 1 },
                { selector: '#num2', number: Number(benefits[1].number), time: 2000, step: 1 },
                { selector: '#num3', number: Number(benefits[2].number), time: 3000, step: 100 },
                { selector: '#num4', number: Number(benefits[3].number), time: 4000, step: 1000 }
            ];

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counterId = entry.target.id;
                        const counterData = countersData.find(data => data.selector === `#${counterId}`);
                        if (counterData) {
                            numCounter(counterData.selector, counterData.number, counterData.time, counterData.step);
                        }
                    }
                });
            });

            countersData.forEach(counterData => {
                const counterElement = document.querySelector(counterData.selector);
                if (counterElement && !counterElement.innerHTML) {
                    observer.observe(counterElement);
                }
            });
        }
        startCountersWhenVisible();




    </script>

@endpush
