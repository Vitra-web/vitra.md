@extends('layouts.client2')

@section('content')
    <main>
        <section class="custom-container" style="margin-top:145px">

            @include('client.components.breadСrumbs')

            <div class="row resolve-container" id="resolveContainer">
                @foreach($resolves as $key=>$item)

                    <a href="{{route('client.resolveView', $item->id)}}" class=" col-md-6 col-lg-3">
                        <div class="resolve-block">
                            <div class="resolve-block_img">
                                <img src="{{url('storage/'.$item->image)}}" alt="">
                            </div>
                            <div class="text_block">
                                <p class="resolve-block__text">{{$language->replace($item->name_ro, $item->name_ru,$item->name_en )}}</p>
                                <div class="resolve-block_next"></div>
                            </div>

                        </div>
                    </a>
                @endforeach

                <div class="more_block row m-0 p-0">
                    @if(count($resolves) > 12)
                        <div class="see_more_container">
                            <button class="custom-btn"
                                    onclick="seeMoreHandler(12, 24)">{{trans('labels.more')}}</button>
                        </div>
                    @endif
                </div>
            </div>

        </section>

        <section class="d-flex flex-column align-items-center justify-content-center gap-3">
            <h2 class="text-center" style="font-weight: bold; font-size: 1.5rem">{!! trans('labels.under_development') !!}</h2>
            <img class="w-100" style="object-fit: contain; max-width: 300px" src="{{asset('images/resolve.svg')}}" alt="">
            <h2 class="text-center" style="font-weight: bold; font-size: 1.8rem">{{trans('labels.be_back')}}</h2>

        </section>

        <section class="custom-container" style="margin-top:120px">
            <div class="about-industry-container">
                <h2 class="about-descr__title">{{trans('labels.specialist_in')}}</h2>

                @include('client.components.industryBlock')
            </div>
        </section>

    </main>

@endsection

@push('script')
    <script>

        const resolves = {!! $resolves !!};


        function seeMoreHandler(from, till) {
            console.log(from)
            console.log(till)

            const moreBlock = document.querySelector('.more_block');

            moreBlock.innerHTML = resolves.map((resolve, index) => {

                if (index >= from && index < till) {
                    const url = window.location.origin + '/resolve/' + resolve['id'];
                    return `<a href="${url}" class=" col-md-6 col-lg-3">
                            <div class="resolve-block " >
                                <div class="resolve-block_img">
                                <img src="/storage/${resolve['image_preview']}" alt="${resolve['name_ro']}">
                               </div>
                                <p class="resolve-block__text">${resolve['name_ro']}</p>
                            </div>
                        </a>`
                }
            }).join('')

            if (resolves.length > till) {
                from += 12;
                till += 12;
                let text = '{!! trans('labels.more') !!}';
                const moreBtn = document.createElement('div');
                moreBtn.classList.add('more_block')
                moreBtn.classList.add('row')
                moreBtn.classList.add('p-0')
                moreBtn.classList.add('m-0')
                moreBtn.innerHTML = ` <div class="see_more_container">
                            <button class="custom-btn" onclick="seeMoreHandler(${from}, ${till})">${text}</button>
                        </div>`
                moreBlock.append(moreBtn)
            }
        }

    </script>

@endpush
