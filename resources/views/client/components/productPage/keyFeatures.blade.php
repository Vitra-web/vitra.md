@if(count($productFeatures) >0)
<section class="product-key-features__section features-section">
    <div class="custom-container">
        <h2 class="features-section__title">{!! trans('labels.key_features') !!}</h2>
        <div class="features-section__body">


                @foreach($productFeatures as $feature)
                <div class="features-section__item">
                    <img src="{{url('storage/'.$feature->image)}}" alt="" class="features-section__item-img">
                    <h3 class="features-section__item-title">{!! $language->replace($feature->title_ro, $feature->title_ru,$feature->title_en ) !!}</h3>
                    <p class="features-section__item-text">{!! $language->replace($feature->description_ro, $feature->description_ru,$feature->description_en ) !!}</p>
                </div>
                @endforeach
        </div>
    </div>
</section>
@endif
