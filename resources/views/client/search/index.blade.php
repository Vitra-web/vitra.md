@extends('layouts.client2')

@section('content')
<main>
    <div class="custom-container" style="margin-top:120px;">
        @include('client.components.breadСrumbs')

        @if($products->total() >0 || count($searchCategories) + count($searchSubcategories) >0 || count($searchSolutions) >0 || count($news) >0)
        <h2 class="search_page_title">{{trans('labels.results_for')}} <b>"{{$value}}"</b></h2>
        @else
            <h2 class="search_page_title">{{trans('labels.no_results')}} <b>"{{$value}}"</b></h2>
        @endif


{{--        <div >--}}
{{--            <form action="{{route('client.searchMore')}}" method="post" class="search_page_input_container">--}}
{{--            <input type="text" name="search_value" class="search_page_input" value="{{$value}}">--}}
{{--            <button type="submit" class="search_page_btn">{{trans('labels.search')}}</button>--}}

{{--            </form>--}}
{{--        </div>--}}


        <div class="custom-container">
            <nav class="w-100">
                <div class="search_nav_tabs" id="product-tab" role="tablist">
                    @if($products->total() >0)
                    <a class="search_nav_link" >
                        {{$products->total(). ' '. trans('labels.burger_label')}}
                    </a>
                    @endif
                    @if(count($searchCategories) + count($searchSubcategories) >0)
                    <a class="search_nav_link" id="categories-tab"  href="#categories" >
                        {{count($searchCategories) + count($searchSubcategories).' '. trans('labels.categories')}}
                    </a>
                    @endif
                     @if(count($searchSolutions) >0)
                    <a class="search_nav_link" id="solutions-tab" href="#solutions" >
                        {{ count($searchSolutions). ' '. trans('nav.solution')}}
                    </a>
                      @endif
                        @if(count($news) >0)
                    <a class="search_nav_link" id="news-tab" href="#news" >
                        {{ count($news). ' '. trans('labels.news')}}
                    </a>
                        @endif
                </div>
            </nav>

            <div class="nav_tab_content "  id="nav-tabContent">
                @if($products->total() >0)
                <div class="product_items_cards" id="products" >
                    <div class=" product-more__swiper-wrapper row">
                        @foreach($products as $product)
                            @if($product->status == 1)
                            @include('client.components.productPage.productCard', ['$product'=>$product])
                            @endif
                        @endforeach
                    </div>
                    <div class="pagination-container">
                        {{ $products->appends(request()->query())->links('client.vendor.pagination.custom') }}
                    </div>
                </div>
                @endif
                @if(count($searchCategories) + count($searchSubcategories) >0)
                <div class="" id="categories" >
                    <p class="tab_item_title">{{trans('labels.see_categories')}} </p>
                    <div class="category-items__cards">
                        @foreach($searchCategories as $category)
                            @if($category->status == 1)
                            @include('client.components.blocks.categoryCard', ['category'=>$category, 'route'=>'client.category'])
                            @endif
                        @endforeach
                            @foreach($searchSubcategories as $subcategory)
                                @if($subcategory->status == 1)
                                @include('client.components.blocks.categoryCard', ['category'=>$subcategory, 'route'=>'client.subcategory'])
                                @endif
                            @endforeach
                    </div>
                </div>

                @elseif(count($recommendSubcategories) > 0 )
                        <div class="" id="categories" >
                            <p class="tab_item_title">{!! trans('labels.categoryRecommend') !!} </p>
                            <div class="category-items__cards">

                                @foreach($recommendSubcategories as $subcategory)
                                    @include('client.components.blocks.categoryCard', ['category'=>$subcategory, 'route'=>'client.subcategory'])
                                @endforeach
                            </div>
                        </div>
                @endif
                @if(count($searchSolutions) >0)
                <div class="resolve-container" id="solutions">
                    <p class="tab_item_title">{{trans('labels.see_solutions')}} </p>
                    <div class="category-items__cards">
                        @foreach($searchSolutions as $item)
                            <a href="{{route('client.resolveView', $item->id)}}" class="category-items__card">
                                <img src="{{url('storage/'.$item->image)}}"  alt="{{$item->name_ro}}" class="category-items__img" style="height: 300px; object-fit: cover">
                                <div class="category-items__card-text">
                                    <h2 class="category-items__title">{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</h2>
                                    <img src="{{url('images/category-arrow.png')}}" alt="" class="category-items__arrow">
                                </div>
                            </a>

                        @endforeach

                    </div>
                </div>
                @endif
                @if(count($news) >0)
                <div class="resolve-container" id="news">
                    <p class="tab_item_title">{{trans('labels.see_news')}} </p>
                    <div class="category-items__cards" >
                        @foreach($news as $item)
                            <a href="{{route('client.newsView', $item->id)}}" class="category-items__card">
                                <img src="{{url('storage/'.$item->image)}}"  alt="{{$item->name_ro}}" class="category-items__img" style="height: 300px; object-fit: cover">
                                <div class="category-items__card-text">
                                    <h2 class="category-items__title">{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</h2>
                                    <img src="{{url('images/category-arrow.png')}}" alt="" class="category-items__arrow">
                                </div>
                            </a>

                        @endforeach
                    </div>
                </div>
                @endif
                    @if(count($seeMoreCategories) >0 ||count($seeMoreSubcategories) >0  )
                    <div class="pb-4" >
                        <p class="tab_item_title">{{trans('labels.discover_also')}}: </p>
                        <div class="category-items__cards">
                            @if(count($seeMoreCategories) >0   )
                            @foreach($seeMoreCategories as $categoryItem)
                               @include('client.components.blocks.categoryCard', ['category'=>$categoryItem, 'route'=>'client.category'])
                            @endforeach
                             @endif
                            @if(count($seeMoreSubcategories) >0   )
                                @foreach($seeMoreSubcategories as $subcategoryItem)
                                        @include('client.components.blocks.categoryCard', ['category'=>$subcategoryItem, 'route'=>'client.subcategory'])
                                @endforeach
                            @endif


                        </div>
                    </div>
                    @endif

                @if(count($similarSearch) >0)
                        <div class="" >
                            <p class="tab_item_title">{{trans('labels.similar_search')}}: </p>
                            <div class="similar_search_wrap">
                                @foreach($similarSearch as $search)
                                    @if($value != $search['tag'])
                                    <a href="{{route('client.searchPage', $search['tag'])}}" class="similar_search_link"> <strong class="">{{$search['tag']}}</strong> <span>({{$search['count']}})</span></a>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    @endif

            </div>
        </div>
        <div class="about-industry-container">
            <h2 class="about-descr__title">{{trans('labels.specialist_in')}}</h2>

            @include('client.components.industryBlock')
        </div>


    </div>



</main>

@endsection

@push('script')
    <script>

    </script>
@endpush

@section('after_styles')

    <style>
        .search_page_title {
            font-size: 45px;
            margin-top: 50px;
            margin-bottom: 60px;
        }
        .search_nav_tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 60px;
        }
        .search_nav_link {
            display:block;
            padding: 10px 20px;
            border-radius: 20px;
            background-color: #EEEAEA;
            cursor: pointer;
        }
        .search_nav_link:hover {
            background-color: #bdbcbc;
        }

        .search_nav_link.active {
            background-color: #0a0a0a;
            color: #fff;
        }
        .nav_tab_content {
            margin-bottom: 60px;
        }
        .product_items_cards {
            margin-bottom: 40px;
        }
        .pagination-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .similar_search_wrap {
            display:flex;
            flex-wrap:wrap;
            gap: 25px;
        }
        .similar_search_link {
            font-size: 21px;
            text-decoration: underline;
        }
        .similar_search_link:hover {
            text-decoration: underline;
            transform: scale(1.1);
            /*font-weight: bold;*/
        }

        .tab_item_title {
            font-size: 45px;
            /*margin-top: 40px;*/
            margin-bottom: 40px;
        }



        /* ------------pagination ----------------*/

        .flex.justify-between.flex-1 {
            display: none;
        }

        .text-sm.text-gray-700.leading-5 {
            margin-bottom: 15px;
        }
        .pagination-next, .pagination-prev {
            width: fit-content;
            height: 35px;
            border-radius: 25px;
            padding: 0 1rem;
            white-space: nowrap;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 3px;
            transition: background-color 0.3s ease;
        }

        .pagination-next:hover, .pagination-prev:hover {
            background-color: rgba(196, 196, 196, 0.5);
        }

        .pagination-next {
            margin-left: 5px;
        }

        .pagination-prev {
            margin-right: 5px;
        }

        @media (max-width: 576px) {
            .pagination-next, .pagination-prev {
                display: none;
            }
        }

        .page {
            width: 35px;
            height: auto;
            aspect-ratio: 1;
            background-color: transparent;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
            cursor: pointer;
            font-size: 18px;
            font-family: "GalanoGrotesque", sans-serif;
            font-weight: 500;
            user-select: none;
        }

        .page:hover {
            background-color: rgba(196, 196, 196, 0.5);
        }

        .page.active {
            background-color: #C4C4C4;
            cursor: default;
        }

        .page.ellipsis {
            pointer-events: none;
        }
        @media (max-width: 600px) {
            .search_page_title {
                font-size: 25px;
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .similar_search_link {
                font-size:18px;
            }

            .tab_item_title {
                font-size: 25px;
            }

            . .similar_search_wrap {
                gap: 10px;
            }
        }

/* ---------------end pagination ---------------*/



        .product-more__swiper-wrapper {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        @media (max-width: 1350px) {
            .product-more__swiper-wrapper {
            grid-template-columns: repeat(5, 1fr);
        }
        @media (max-width: 1230px) {
            .product-more__swiper-wrapper {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        @media (max-width: 1000px) {
            .product-more__swiper-wrapper {
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
        }

        }
        @media (max-width: 750px) {
            .product-more__swiper-wrapper {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
        }

        }
        @media (max-width: 600px) {
            .product-more__swiper-wrapper {
                gap: 6px;
            }
        }
    </style>

@endsection
