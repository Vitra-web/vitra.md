@php
    $name = $language->replace($category->name_ro, $category->name_ru,$category->name_en );
       if(strlen($name) > 150){
          $nameText = substr($name, 0, 150).'...';
       }  else $nameText = $name;
@endphp

@if(isset($category->slug))
<a href="{{route($route, [$category->slug])}}" class="category-items__card">
    <img src="{{url('storage/'.$category->image_preview)}}" alt="" class="category-items__img" style="height: 300px; object-fit: cover">
    <div class="category-items__card-text">
        <h2 class="category-items__title">{{$name}}</h2>
        <img src="{{url('images/category-arrow.png')}}" alt="" class="category-items__arrow">
    </div>
</a>
@endif
