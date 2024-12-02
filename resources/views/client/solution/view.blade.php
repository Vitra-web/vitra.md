@extends('layouts.client')

@section('content')
    <main>
<h2>{{trans('labels.news_title')}}</h2>

<p>{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</p>
    </main>

@endsection
