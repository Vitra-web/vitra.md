@extends('layouts.client2')

@section('content')
    <main>
        <section class="custom-container" style="margin-top:120px">
            <div class="swiper filerSwiper categoryPortfolioSwiper mb-4 " >
                <div class="swiper-wrapper swiper-tab-nav" id="solution_slider mb-4" >

                        <div class="swiper-slide filter-slide">
                            <button class="filter-slide-btn active" onclick="categoryHandler(this, 0)">{{trans('labels.all')}}</button>
                        </div>
                        @if(isset($solutionCategories))
                        @foreach($solutionCategories as $category)
                            <div class="swiper-slide filter-slide">
                                <button class="filter-slide-btn active"  onclick="categoryHandler(this, {!! $category->id !!})">{{$language->replace($category->name_ro, $category->name_ru,$category->name_en )}}</button>
                            </div>
                        @endforeach
                            @endif

                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <!-- Portfolios -->
            <div class="solutionContainer" id="solutionContainer">
                <div class="solution_grid">
{{--                    @foreach($solutions as $solution)--}}
                    @for($i =0; $i<=11; $i++)
                        <div class="solution_grid_item" >
                            <img class="solution_grid_img" src="{{url('storage/'.$solutions[$i]->image)}}" alt="Product Image"  style='cursor:pointer; width: 100%' onclick="solutionHandler({{$solutions[$i]->id}})">
                            @foreach($solutionProducts as $key=>$solutionProduct)
                                @if($solutions[$i]->id == $solutionProduct->solution_id)
                                    @include('client.components.point', ['solutionProduct'=>$solutionProduct])

                                @endif
                            @endforeach
                        </div>
                    @endfor
{{--                    @endforeach--}}
                </div>

                <div class="solution_btn_container" id="solutionMoreBtn">
                    <button type="button" onclick="seeMoreHandler(12, 24)" class="custom-btn solution_grid_btn">
                        {{trans('labels.more')}}
                    </button>
                </div>
            </div>

            <div class="solutions_modals_block">
                @foreach($solutions as $solution)
                    @include('client.components.modals.solutionModal', ['solution'=>$solution, 'solutionProducts'=>$solutionProducts])
                @endforeach
            </div>
        </section>


    </main>

@endsection

@push('script')
    <script>

        let solutions = {!! $solutions !!};
        const solutionProducts = {!! $solutionProducts !!};
        const solutionContainer = document.getElementById('solutionContainer');
        const labels = {
            'product_code': '{{trans(('labels.product_code'))}}',
            'ascConsultation': '{{trans(('labels.ascConsultation'))}}',
        }

        console.log('solutions',solutions)
        console.log('solutionProducts',solutionProducts)

        const categoryPortfolioSlider = new Swiper('.categoryPortfolioSwiper', {

            slidesPerView: 'auto',
            spaceBetween: 0,
            pagination: false,

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            // scrollbar: {
            //     el: '.swiper-scrollbar',
            // },

        });

        //

        // console.log(sol2.length)
        // console.log(sol3.length)
        function imgHover() {
            document.querySelectorAll('.img_point_container').forEach(item=>{
                item.addEventListener('mouseover', function() {
                    this.children[0].children[0].style.display = 'block'
                    this.children[0].children[0].style.zIndex = 100
                })
                item.addEventListener('mouseout', function() {
                    this.children[0].children[0].style.display = 'none'
                    this.children[0].children[0].style.zIndex = 0
                })
            })

        }
        imgHover()

        function seeMoreHandler(from, till) {

            const moreBlock =  document.querySelector('.solution_grid');

            const markup =  solutions.map((item, index) =>{
                console.log('item',item)
                if(index >= from && index < till) {
                    const url = window.location.origin+'/storage/' + item['image'];
                    const solutionProduct = solutionProducts.find(prod=>prod['solution_id'] === item['id'])
                    console.log('product', solutionProduct)

                    if(solutionProduct) {
                        return ` <div class="solution_grid_item" >
                    <img class="solution_grid_img" src="${url}" alt="Product Image"  style='cursor:pointer; width: 100%' onclick="solutionHandler(${item['id']})">
                    <div class="img_point_container" style="top: ${solutionProduct['percent_y']}%; left: ${solutionProduct['percent_x']}%; ">
                        <div class="img_point " id="img_point${index+from}" >
                            <div class="img_point__body point__body_left" >
                                <div class="img_point__body--info" >
                                    <h4 class="img_point__body--info-title">
                                        <a href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}"> ${solutionProduct['product']['name_ro']}</a>
                                    </h4>
                                    <div class="img_point__body--code">
                                        <p>${labels['product_code']}: </p>
                                        <p class="bold">${solutionProduct['product']['code_1c']}</p>
                                        <a href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}" class="img_point__more_link">
                                            <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                        </a>
                                    </div>
                                    <a class="img_point_price" href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}" style="color:#333232">${solutionProduct['product']['price'] > 100000 ? labels['ascConsultation'] : solutionProduct['product']['price']+' MDL' }</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>`
                    } else {
                        return ` <div class="solution_grid_item" >
                    <img class="solution_grid_img" src="${url}" alt="Product Image"  style='cursor:pointer; width: 100%' onclick="solutionHandler(${item['id']})">
                    </div>`
                    }

                }
            }).join('');

            moreBlock.insertAdjacentHTML('beforeend',markup )
            imgHover()
            if( solutions.length <= till) {
                document.getElementById('solutionMoreBtn').style.display = 'none'
                {{--from +=12;--}}
                {{--till+=12;--}}
                {{--let text = '{!! trans('labels.more') !!}';--}}
                {{--const moreBtn = document.createElement('div');--}}
                {{--moreBtn.classList.add('see_more_container')--}}
                {{--moreBtn.innerHTML=` <div class="see_more_container">--}}
                {{--            <button class="custom-btn" onclick="seeMoreHandler(${from}, ${till})">${text}</button>--}}
                {{--        </div>`--}}
                {{--moreBlock.append(moreBtn)--}}
            }
        }



        function categoryHandler(el, categoryId) {
            document.querySelectorAll('.filter-slide-btn').forEach(item => {
                item.classList.remove('active')
            })
            el.parentElement.parentElement.querySelectorAll('.swiper-slide').forEach(item=>{
                item.classList.remove('swiper-slide-active')
            })
            el.classList.add('active')
            el.parentElement.classList.add('swiper-slide-active')

            if(categoryId === 0) {
                const solutionsList = solutions.map((item, index) =>{
                    const url = window.location.origin+'/storage/' + item['image'];
                    const solutionProduct = solutionProducts.find(prod=>prod['solution_id'] === item['id'])
                    if(solutionProduct) {
                        return ` <div class="solution_grid_item" >
                    <img class="solution_grid_img" src="${url}" alt="Product Image"  style='cursor:pointer; width: 100%' onclick="solutionHandler(${item['id']})">
                    <div class="img_point_container" style="top: ${solutionProduct['percent_y']}%; left: ${solutionProduct['percent_x']}%; ">
                        <div class="img_point " id="img_point${index}" >
                            <div class="img_point__body point__body_left" >
                                <div class="img_point__body--info" >
                                    <h4 class="img_point__body--info-title">
                                        <a href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}"> ${solutionProduct['product']['name_ro']}</a>
                                    </h4>
                                    <div class="img_point__body--code">
                                        <p>${labels['product_code']}: </p>
                                        <p class="bold">${solutionProduct['product']['code_1c']}</p>
                                        <a href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}" class="img_point__more_link">
                                            <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                        </a>
                                    </div>
                                    <a class="img_point_price" href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}" style="color:#333232">${solutionProduct['product']['price'] > 100000 ? labels['ascConsultation'] : solutionProduct['product']['price']+' MDL' }</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>`
                    } else {
                        return ` <div class="solution_grid_item" >
                    <img class="solution_grid_img" src="${url}" alt="Product Image"  style='cursor:pointer; width: 100%' onclick="solutionHandler(${item['id']})">
                    </div>`
                    }

                }).join('')
                solutionContainer.innerHTML = `<div class="solution_grid">
                ${solutionsList}
                </div>`

                if( solutions.length > 12) {

                }

            } else {
                const solutionsList = solutions.map((item, index) =>{
                    if(item['category_id'] === categoryId) {
                        const url = window.location.origin+'/storage/' + item['image'];
                        const solutionProduct = solutionProducts.find(prod=>prod['solution_id'] === item['id'])
                        if(solutionProduct) {
                            return ` <div class="solution_grid_item" >
                    <img class="solution_grid_img" src="${url}" alt="Product Image"  style='cursor:pointer; width: 100%' onclick="solutionHandler(${item['id']})">
                    <div class="img_point_container" style="top: ${solutionProduct['percent_y']}%; left: ${solutionProduct['percent_x']}%; ">
                        <div class="img_point " id="img_point${index}" >
                            <div class="img_point__body point__body_left" >
                                <div class="img_point__body--info" >
                                    <h4 class="img_point__body--info-title">
                                        <a href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}"> ${solutionProduct['product']['name_ro']}</a>
                                    </h4>
                                    <div class="img_point__body--code">
                                        <p>${labels['product_code']}: </p>
                                        <p class="bold">${solutionProduct['product']['code_1c']}</p>
                                        <a href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}" class="img_point__more_link">
                                            <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                        </a>
                                    </div>
                                    <a class="img_point_price" href="/product/${solutionProduct['product']['id']}/${solutionProduct['product']['subcategoryId']}" style="color:#333232">${solutionProduct['product']['price'] > 100000 ? labels['ascConsultation'] : solutionProduct['product']['price']+' MDL' }</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>`
                        } else {
                            return ` <div class="solution_grid_item" >
                    <img class="solution_grid_img" src="${url}" alt="Product Image"  style='cursor:pointer; width: 100%' onclick="solutionHandler(${item['id']})">
                    </div>`
                        }


                    }


                }).join('')
                solutionContainer.innerHTML = `<div class="solution_grid">
                ${solutionsList}
                </div>`


            }
        }


        function solutionHandler(id) {
            const modal = document.getElementById('modal' + id);
            console.log(modal)
            let overlay;
            const main = document.querySelector('.main__body');
            main.append(modal)

            const modalInMain = main.lastElementChild
            modalInMain.style.opacity = '1';
            modalInMain.style.pointerEvents = 'auto';
            createOverlay();
            setTimeout(() => {
                modalInMain.style.display = 'block';
            }, 50);


            function createOverlay() {
                overlay = document.createElement('div');
                overlay.classList.add('overlay');
                document.body.appendChild(overlay);
            }

            function removeOverlay() {
                if (overlay) {
                    overlay.remove();
                    overlay = null;
                }
            }

            const closeModalBtn = modal.querySelector('.close__dialog');
            closeModalBtn.addEventListener('click', function () {
                modalInMain.style.display = 'none';
                modalInMain.style.opacity = '0';
                modalInMain.style.pointerEvents = 'none';
                removeOverlay();
            });

            window.addEventListener('click', function (event) {
                if (event.target == overlay) {
                    modalInMain.style.display = 'none';
                    modalInMain.style.opacity = '0';
                    modalInMain.style.pointerEvents = 'none';
                    removeOverlay();
                }
            });

        }





    </script>

@endpush
@section('after_styles')
    <style>

        .overlay {
         position: fixed;
            z-index: 60;
        }


    </style>
@endsection
