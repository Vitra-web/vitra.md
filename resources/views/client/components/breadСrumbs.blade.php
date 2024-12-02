<section class="main-industry-inner">
    <div class="custom-container">
        <ul class="list-reset breadcrumbs main-industry__breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{route('home')}}" class="breadcrumbs__link active">{{trans('labels.mainPage')}}</a>
            </li>
            @if(isset($industryItem))
                <li class="breadcrumbs__item">
                    <a href="{{route('client.industry', $industryItem->slug)}}" class="breadcrumbs__link active">{{$industryItem->name}}</a>
                </li>
                @endif
            @if(isset($categoryItem))
                <li class="breadcrumbs__item">
                    <a href="{{route('client.category', $categoryItem->slug)}}" class="breadcrumbs__link active">{{$language->replace($categoryItem->name_ro, $categoryItem->name_ru,$categoryItem->name_en)}}</a>
                </li>
            @endif
            @if(isset($subcategoryItem) &&$subcategoryItem->slug != 'none' )
                <li class="breadcrumbs__item">
                    <a href="{{route('client.subcategory', $subcategoryItem->slug)}}" class="breadcrumbs__link active">{{$language->replace($subcategoryItem->name_ro, $subcategoryItem->name_ru,$subcategoryItem->name_en)}}</a>
                </li>
            @endif
            @if(isset($parentLink))
                <li class="breadcrumbs__item">
                    <a href="{{route($parentLink['url'])}}" class="breadcrumbs__link active">{{trans($parentLink['transValue'])}}</a>
                </li>
            @endif
            <li class="breadcrumbs__item">
                <a class="breadcrumbs__link">{{$title}}</a>
            </li>
        </ul>
    </div>
</section>
