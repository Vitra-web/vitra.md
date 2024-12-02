@extends('layouts.admin')

@section('content')
    @php
        use Illuminate\Support\Facades\Vite;
    @endphp
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="row mb-2 align-items-start">
                <div class="col-sm-4">
                    <h1 class="m-0">{{$title}}</h1>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content-header -->
    @include('panel.components.flash_message')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            {{--////-------------retail-section -----------------//////////--}}

            <section class="retail-section mb-5">
                <div class="container-custom retail-section__container">
                    <div class="retail-section__body retail ">
                        <a href="{{route('client.industry', $industries[0]->id)}}" class="retail__text">
                            <div  class="industry_name">
                                <p class="industry_name_products">{{trans('labels.products')}}</p>
                                <p class="industry_name_title">RETAIL</p>
                            </div>
                        </a>

                        @foreach($retailSolutions as $index=> $solution)
                            <div class="retail-img retail-img{{$index+1}}">
                                <a href="{{route('solution.edit', $solution->id)}}" class="d-block w-100 h-100">
                                    <img src="{{url('storage/'.$solution->image)}}" alt="Product Image">
                                </a>
                                @foreach($solutionProducts as $key=>$solutionProduct)
                                    @if($solution->id == $solutionProduct->solution_id)

                                        @include('client.components.point', ['solutionProduct'=>$solutionProduct])

                                    @endif
                                @endforeach
                            </div>

                        @endforeach
                        <a href="{{route('client.industry', $industries[0]->id)}}" class="retail-more_container">
                            <div class=" w-100">
                                <p class=" retail-more">{{trans('labels.moreCategory')}}</p>
                                <p class="industry-more_btn">
                                </p>
                            </div>

                        </a>

                    </div>

                </div>

            </section>

            {{--////-------------logistics-section -----------------//////////--}}

            <section class="logistics-section mb-5">
                <div class="logistics-section__container">
                    <div class="logistics-section__body logistics ">
                        <a href="{{route('client.industry', $industries[1]->id)}}" class="logistics__text">
                            <div  class="industry_name">
                                <p class="industry_name_products">{{trans('labels.products')}}</p>
                                <p class="industry_name_title">LOGISTICS</p>
                            </div>

                        </a>

                        @foreach($logisticSolutions as $index=> $solution)
                            <div class="logistics-img logistics-img{{$index+1}}">
                                <a href="{{route('solution.edit', $solution->id)}}" class="d-block w-100 h-100">
                                    <img src="{{url('storage/'.$solution->image)}}" alt="Product Image">
                                </a>
                                @foreach($solutionProducts as $key=>$solutionProduct)
                                    @if($solution->id == $solutionProduct->solution_id)
                                        @include('client.components.point', ['solutionProduct'=>$solutionProduct])
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                        <a href="{{route('client.industry', $industries[1]->id)}}" class="logistics-more-container">
                            <div class=" w-100">
                                <p  class=" logistics-more">{{trans('labels.moreCategory')}}</p>
                                <p class="industry-more_btn">
                                </p>
                            </div>

                        </a>
                    </div>


                </div>

            </section>

            {{--////-------------horeca-section -----------------//////////--}}
            <section class="horeca-section mb-5">
                <div class="container-custom horeca-section__container">
                    <div class="horeca-section__body horeca">
                        <a href="{{route('client.industry', $industries[2]->id)}}" class="horeca__text">
                            <div class="industry_name" >
                                <p class="industry_name_products">{{trans('labels.products')}}</p>
                                <p class="industry_name_title">HORECA</p>
                            </div>

                        </a>

                        @foreach($horecaSolutions as $index=> $solution)
                            <div class="horeca-img horeca-img{{$index+1}}">
                                <a href="{{route('solution.edit', $solution->id)}}" class="d-block w-100 h-100">
                                    <img src="{{url('storage/'.$solution->image)}}" alt="Product Image">
                                </a>
                                @foreach($solutionProducts as $key=>$solutionProduct)
                                    @if($solution->id == $solutionProduct->solution_id)
                                        @include('client.components.point', ['solutionProduct'=>$solutionProduct])
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                        <a href="{{route('client.industry', $industries[2]->id)}}" class="horeca-more-container">
                            <div class="w-100">
                                <p  class=" horeca-more">{{trans('labels.moreCategory')}}</p>
                                <p class="industry-more_btn">
                                </p>
                            </div>

                        </a>

                    </div>


                </div>

            </section>

            {{--////-------------life-section -----------------//////////--}}


            <section class="life-section mb-5">
                <div class="container-custom life-section__container">
                    <div class="life-section__body life">
                        <a href="{{route('client.industry', $industries[3]->id)}}"  class="life__text">
                            <div class="industry_name">
                                <p class="industry_name_products">{{trans('labels.products')}}</p>
                                <p class="industry_name_title">LIFE</p>
                            </div>
                        </a>
                        @foreach($lifeSolutions as $index=> $solution)
                            <div class="life-img life-img{{$index+1}}">
                                <a href="{{route('solution.edit', $solution->id)}}" class="d-block w-100 h-100">
                                    <img src="{{url('storage/'.$solution->image)}}" alt="Product Image">
                                </a>
                                @foreach($solutionProducts as $key=>$solutionProduct)
                                    @if($solution->id == $solutionProduct->solution_id)
                                        @include('client.components.point', ['solutionProduct'=>$solutionProduct])
                                    @endif
                                @endforeach
                            </div>

                        @endforeach

                        <a href="{{route('client.industry', $industries[3]->id)}}" class="life-img life-more-container">
                            <div class="w-100">
                                <p  class=" life-more">{{trans('labels.moreCategory')}}</p>
                                <p class="industry-more_btn">
                                </p>
                            </div>
                        </a>


                    </div>


                </div>


            </section>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@push('script')
  <script>
        function imgHover() {
            document.querySelectorAll('.img_point').forEach(item=>{
                item.addEventListener('mouseover', function() {
                    this.children[0].style.display = 'block'
                })
                item.addEventListener('mouseout', function() {
                    this.children[0].style.display = 'none'
                })
            })

        }
        imgHover()

        function solutionHandler(id){
            const modal = document.getElementById('modal'+id);
            let overlay;
            const body = document.querySelector('body');
            body.append(modal)

            const modalInMain =body.lastElementChild
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
            closeModalBtn.addEventListener('click', function() {
                modalInMain.style.display = 'none';
                modalInMain.style.opacity = '0';
                modalInMain.style.pointerEvents = 'none';
                removeOverlay();
            });

            window.addEventListener('click', function(event) {
                if (event.target == overlay) {
                    modalInMain.style.display = 'none';
                    modalInMain.style.opacity = '0';
                    modalInMain.style.pointerEvents = 'none';
                    removeOverlay();
                }
            });
        }

        const lifeSlider = new Swiper('.lifeSwiper', {

            slidesPerView: "auto",
            spaceBetween: 15,
            pagination: false,

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },

        });

    </script>

@endpush

@section('after_styles')

    <style>
        {!! Vite::content('resources/sass/style.scss') !!}
    </style>
    <style>
        .img_point {
            position: absolute;
            z-index: 50;
            display: block;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            bottom: 20%;
            left: 20%;
            background: #ffffff50;
            transition: .3s ease-in-out;
            border-color: #fff;

        }

        .img_point::after {
            position: absolute;
            display: block;
            content: '';
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #fff;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            transition: .3s ease-in-out;
        }
        .img_point:hover {
            border: 1px solid #fff;

        }
        .img_point:hover::after {
            width: 10px;
            height: 10px;
        }


        .img_point__body {
            position: relative;
            display: none;
            left: 55px;
            /*width: 150px;*/
            background: #ffffff;

        }


        .img_point__body--info {
            position: relative;
            width: 130px;
            padding: 10px;

        }

        .img_point__body--info::before {
            content: '';
            position: absolute;
            width: 1px;
            border: 1px solid #d4d4d4;
            height: 80%;
            top: 10px;
            right: 30px;
        }

        /*.img_point__body--info::after {*/
        /*    position: absolute;*/
        /*    content: '>';*/
        /*    color: #333232;*/
        /*    font-size: 30px;*/
        /*    top: 30%;*/
        /*    right: 5px;*/
        /*}*/
        .img_point__more_link {
            position: absolute;

            color: #333232;
            font-size: 30px;
            top: 30%;
            right: 5px;
        }

        .img_point__body--info-title a {
            font-size: 16px;
            color: #333232;
            max-width: 100px;
        }

        .img_point__body--code {
            margin-top: 20px;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333232;

        }

        .img_point__body--code span {
            font-family: 'GalanoGrotesque-Bold', sans-serif;
        }

        .img_point__body--btn a{

            display: block;
            width: 100%;
            font-family: 'GalanoGrotesque-Medium', sans-serif;
            font-size: 14px;
            color: #000;
            background-color: #e8e8e8;
            text-align: center;
            padding: 15px 10px;

        }

    </style>
@endsection
