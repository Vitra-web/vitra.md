@extends('layouts.client2')

@section('content')
    <main>



<div style="margin-top:140px;">
    @include('client.components.breadСrumbs')
</div>
        @include('client.components.productPage.mainSection')
        @include('client.components.productPage.keyFeatures')
        @include('client.components.productPage.categoryProducts')
    </main>
@endsection

@push('script')
    <script src="{{asset('js/product.js')}}"></script>
    <script src="{{asset('js/fslightbox.js')}}"></script>
    <script>
        Fancybox.bind("[data-fancybox]", {
            closeClick  : true,
            openEffect  : 'none',
            // closeEffect : 'none',
        });
    </script>

@endpush
