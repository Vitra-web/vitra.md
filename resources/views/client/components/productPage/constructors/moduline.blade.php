<div class="product-descr__dimensions-text">{{trans('labels.dimensions')}} :
    <span class="product-descr__dimensions-selected"></span>
</div>
<div class="product-descr__dimensions">

    @if($product->industry_id == 2)

        <div class="product-descr__dimensions-select select-height_button">
            <p>{{trans('labels.height')}}</p>
            @foreach($product->heightVariants as $height)
                <button class="product-descr__dimensions-button height_button"
                        data-variant="{{$height['height']}}">{{$height['height']}}</button>
            @endforeach
        </div>

        <div class="product-descr__dimensions-select select-width_button">
            <p>{{trans('labels.length')}}</p>
            @foreach($product->productWidth as $index => $width)
                <button class="product-descr__dimensions-button width_button"
                        data-id="{{$index+1}}"
                        data-width="{{$width['width']}}">{{$width['width']}}</button>
            @endforeach
        </div>

        <div class="product-descr__dimensions-select select-deep_button">
            <p>{{trans('labels.depth')}}</p>
            @foreach($product->deepVariants as $index => $deep)
                <button class="product-descr__dimensions-button deep_button" data-id="{{$index+1}}"
                        data-deep="{{$deep['deep']}}">{{$deep['deep']}}</button>
            @endforeach

        </div>

    @else

        {{--                    <div class="product-descr__dimensions-select default">--}}
        {{--                    @foreach(array_unique(array_column($product->productVariants,'dimension')) as $variant)--}}
        {{--                            <button class="product-descr__dimensions-button" data-variant="{{$variant}}">{{$variant}}</button>--}}
        {{--                    @endforeach--}}
        {{--                    </div>--}}

    @endif

</div>

<div class="product-descr__colors"
     style="border-bottom: 1px #38383836 solid;">
    <p class="product-descr__colors-text">{{trans('labels.color')}} <span
            class="product-descr__colors-selected"></span></p>
    @if(isset($product->productVariants[0]['color_name']))
        <p class="product_color_selected">{{$product->productVariants[0]['color_name']}}</p>
    @endif
    <div class="product-descr__colors-img-btns">
        @foreach($product->colorVariants as $color)
            <button class="product-descr__colors-img-btn color" data-id="{{$color->id}}"
                    data-variant="{{$color->color_name}}">
                <img class="w-100 h-100 object-fit-cover" src="{{url('storage/'.$color->image)}}"
                     alt="{{$color['color_name']}}">
            </button>
        @endforeach
    </div>
</div>

<div class="product-descr__colors">
    <div class="product-descr__colors-text">
        <div>
            <span>{{trans('labels.type')}}</span>
            <span class="product-descr__shelf-type-selected"></span>
            <span class="show-more-shelf">{{trans('labels.see_details')}}</span>
        </div>
    </div>
    @if(isset($product->productVariants[0]['type']))
        <p class="product_color_selected">{{$product->productVariants[0]['type']}}</p>
    @endif
    <div class="product-descr__colors-img-btns">
        @foreach($product->typeVariants as $index => $typeVariant)
            <button class="product-descr__shelf-type-btn" data-index="{{ $index }}"
                    data-variant="{{ $typeVariant['name_en'] }}"
                    data-variantro="{{ $typeVariant['name_ro'] }}"
                    data-variantru="{{ $typeVariant['name_ru'] }}">
                <img class="w-100 h-100" src="{{url('storage/'.$typeVariant['image'])}}"
                     alt="{{ $typeVariant['name_en'] }}">
            </button>
        @endforeach
    </div>
    <div class="modal-see-more">
        <div class="modal-see-more__content">
            <div class="swiper modal-more-swiper w-100 h-100">
                <div class="swiper-wrapper modal-see-more__container"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="show-more-shelf close-modal-button">
                <img src="{{asset('images/cross.svg')}}" alt="">
            </div>
        </div>
    </div>
</div>

<div class="product-descr__colors">
    <p class="product-descr__colors-text">{{trans('labels.color_shelf')}}<span
            class="product-descr__shelf-colors-selected"></span></p>
    @if(isset($product->productVariants[0]['color_name']))
        <p class="product_color_selected">{{$product->productVariants[0]['color_name']}}</p>
    @endif
    <div class="product-descr__colors-btns">

        @foreach($product->typeVariants as $index => $typeVariant)
            <div class="shelf-colors" id="shelf-colors-{{ $index }}" data-parent-id="{{ $index }}"
                 style="display: none;">
                @foreach(collect($typeVariant['shelves'])->unique('color_name') as $shelfColor)
                    <button class="product-descr__colors-btn shelf-color"
                            data-id="{{ $shelfColor['id'] }}"
                            data-child-id="{{ $index }}"
                            data-variant="{{ $shelfColor['color_name'] }}"
                            style="background-color: {{$shelfColor['color']}};">
                    </button>
                @endforeach
            </div>
        @endforeach

    </div>
</div>

<div class="product-descr__colors" style="margin: 0; padding: 0;">
    <p class="product-descr__colors-text">{{trans('labels.shelf_quantity')}}<span
            class="product-descr__shelf-quantity-selected"></span></p>
    <div class="product-descr__dimensions-select">

        @foreach(collect($product->heightVariants)->flatMap(function ($quantity) {
                                                    return $quantity['shelvesVariants'];
                                                })->unique('number') as $variant)
            <button class="product-descr__quantity-button"
                    data-variant="{{$variant['number']}}">{{$variant['number']}}</button>
        @endforeach

    </div>
</div>


@push('script')
    <script>
        const product = {!! $product !!};
        const lang = '{{App::getLocale()}}';
        let data = {
            'product': product,
            'product_variant': product[0],
            'product_moduline': '',
            'quantity': 1
        };
        const productImg = {!! $productImages !!};
        console.log('product', product);
        let modulinePrice = 0;
        const userLoginProduct = '{!! isset($currentUser) ? $currentUser->id : '' !!}';
        const productsFavorite = window.localStorage.getItem('vitraFavorite');
        const similarProducts = {!! json_encode($similarProducts) !!};


        function setProductModuline() {
            let rng = Date.now().toString(36) + Math.random().toString(36).substr(2);

            if ({!! $product->constructor_id == 3 !!}) {
                let selectedWidth = document.querySelector('.width_button.active');
                let selectedDepth = document.querySelector('.deep_button.active');
                let selectedHeight = document.querySelector('.height_button.active');
                let selectedMontantColor = document.querySelector('.product-descr__colors-img-btn.color.active');

                let selectedShelfType = document.querySelector('.product-descr__shelf-type-btn.good.active');
                let selectedShelfColor = document.querySelector('.product-descr__colors-btn.shelf-color.good.active');
                let selectedShelfNumber = document.querySelector('.product-descr__quantity-button.good.active');

                let selectedProduct = {
                    'travers_width': selectedWidth.dataset.width,
                    'travers_depth': selectedDepth.dataset.deep,
                    'travers_height': selectedHeight.dataset.variant,
                    'travers_color': selectedMontantColor.dataset.variant,
                    'shelves_type_en': selectedShelfType.dataset.variant,
                    'shelves_type_ro': selectedShelfType.dataset.variantro,
                    'shelves_type_ru': selectedShelfType.dataset.variantru,
                    'shelves_color': selectedShelfColor.dataset.variant,
                    'shelves_number': selectedShelfNumber.dataset.variant,
                    'unique_id': rng.toString(),
                    'price': parseInt(modulinePrice),
                };
                return JSON.stringify(selectedProduct);
            } else return '';
        }


        function setShelfColors() {
            try {
                setTimeout(() => {
                    let activeGoodShelfType = document.querySelector('.product-descr__shelf-type-btn.good.active') || document.querySelector('.product-descr__shelf-type-btn.active');
                    let activeDepth = document.querySelector('.deep_button.active');
                    let activeLength = document.querySelector('.width_button.active');
                    let allColors = document.querySelectorAll('.product-descr__colors-btn');
                    let firstGoodBtn = null;

                    let matchingShelves = product['typeVariants']
                        .filter(variant => variant.name_en.trim() === activeGoodShelfType.dataset.variant.trim())
                        .flatMap(variant => variant.shelves)
                        .filter(shelf => parseInt(shelf.product_deep_id) === parseInt(activeDepth.dataset.id))
                        .filter(shelf => parseInt(shelf.product_width_id) === parseInt(activeLength.dataset.id));

                    allColors.forEach(e => {
                        let matched = false;
                        matchingShelves.forEach(shelf => {
                            if (e.dataset.variant.trim() === shelf.color_name.trim()) {
                                matched = true;
                            }
                        });

                        matched ? e.classList.add('good') : e.classList.remove('good');
                    });

                    setTimeout(() => {
                        let activeGoodColor = document.querySelector('.shelf-color.good.active');

                        if (!activeGoodColor) {
                            firstGoodBtn = document.querySelector('.product-descr__colors-btn.good');
                            firstGoodBtn?.classList.add('active');
                            firstGoodBtn?.click();
                        }
                    }, 0)
                }, 0)
            } catch (e) {
                alert(`{!! trans('labels.product_error') !!} 'Shelf Color'`)
                location.reload();
            }
        }

        (function handleDimensionSelect() {
            let widthButton = document.querySelectorAll('.width_button');
            let depthButton = document.querySelectorAll('.deep_button');
            let heightButton = document.querySelectorAll('.height_button');

            function onclickSelectDimensions(buttons) {
                Array.from(buttons).forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        buttons.forEach(item => {
                            item.classList.remove('active')
                        })

                        e.target.classList.add('active')

                        let widthElem = document.querySelector('.width_button.active');
                        let depthElem = document.querySelector('.deep_button.active');
                        let heightElem = document.querySelector('.height_button.active');

                        if (widthElem && depthElem && heightElem) {
                            document.querySelector('.product-descr__dimensions-selected').innerHTML =
                                `{{trans('labels.height')}} : ${heightElem.innerHTML} |
                                     {{trans('labels.length')}} : ${widthElem.innerHTML} |
                                     {{trans('labels.depth')}} : ${depthElem.innerHTML}`;
                        }

                        if (buttons === widthButton || buttons === depthButton) {
                            let firstGoodBtn
                            setTimeout(() => {
                                const shelfTypeMatchesWidthDepth = product['typeVariants']
                                    .filter(item => item.shelves.some(shelf =>
                                        (parseInt(shelf.product_width_id) === parseInt(widthElem?.dataset.id)
                                            && parseInt(shelf.product_deep_id) === parseInt(depthElem?.dataset.id))))
                                    .map(item => item.name_en.trim());

                                document.querySelectorAll('.product-descr__shelf-type-btn').forEach(e => {
                                    e.classList.toggle('good', shelfTypeMatchesWidthDepth.includes(e.dataset.variant.trim() || parseInt(e.dataset.id)));
                                });

                                if (shelfTypeMatchesWidthDepth.length === 0) {
                                    btn.style.pointerEvents = 'none'
                                    if (buttons === widthButton) {
                                        widthButton[0].click();

                                    } else if (buttons === depthButton) {
                                        depthButton[0].click();
                                    }
                                }

                                if (!document.querySelector('.product-descr__shelf-type-btn.good.active')) {
                                    firstGoodBtn = document.querySelector('.product-descr__shelf-type-btn.good');

                                    firstGoodBtn?.classList.add('active');
                                    firstGoodBtn?.click();
                                }
                            }, 0)
                            setTimeout(() => {
                                setShelfColors()
                            }, 0)

                        }

                        if (buttons === heightButton) {
                            const height = parseInt(btn.dataset.variant);
                            const shelfMatchesCountHeight = product['heightVariants']
                                .find(item => parseInt(item['height']) === parseInt(height))?.shelvesVariants
                                ?.map(shelf => parseInt(shelf.number)) || [];

                            document.querySelectorAll('.product-descr__quantity-button').forEach(e => {
                                e.classList.toggle('good', shelfMatchesCountHeight.includes(parseInt(e.dataset.variant)));
                            });

                            const activeGoodButton = document.querySelector('.product-descr__quantity-button.good.active');
                            if (!activeGoodButton) {
                                const inactiveActiveButton = document.querySelector('.product-descr__quantity-button.active:not(.good)');
                                inactiveActiveButton?.classList.remove('active');

                                const firstGoodButton = document.querySelector('.product-descr__quantity-button.good');
                                if (firstGoodButton) {
                                    firstGoodButton.classList.add('active');
                                    firstGoodButton.click();
                                }
                            }

                        }

                        constructorTotalPrice()
                    })
                })
            }

            onclickSelectDimensions(widthButton);
            onclickSelectDimensions(depthButton);
            onclickSelectDimensions(heightButton);

            if (widthButton[0]) {
                setTimeout(() => {
                    widthButton[0].click();
                    depthButton[0].click();
                    heightButton[0].click();
                }, 0)
            }

        })();

        let btnImageColors = document.querySelectorAll('.product-descr__colors-img-btn')

        Array.from(btnImageColors).forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.product-descr__colors-img-btn').forEach(item => {
                    item.classList.remove("active");
                })
                let selectedVariantColor = product['colorVariants'].find(item => item.color_name === btn.dataset.variant)
                let colorNameValue = languageReplace(lang, selectedVariantColor['color_name'], selectedVariantColor['color_name'], selectedVariantColor['color_name'])
                document.querySelector('.product-descr__colors-selected').innerHTML = ': ' + colorNameValue;
                btn.classList.add('active')

                constructorTotalPrice()
            })
            btn.addEventListener('mouseover', () => {
                let selectedVariantColor = product['colorVariants'].find(item => item.color_name === btn.dataset.variant)
                let colorNameValue = languageReplace(lang, selectedVariantColor['color_name'], selectedVariantColor['color_name'], selectedVariantColor['color_name'])
                document.querySelector('.product-descr__colors-selected').innerHTML = ': ' + colorNameValue;
            })
            btn.addEventListener('mouseleave', () => {
                try {
                    let selectedVariantColor = product['colorVariants'].find(item => item.color_name === document.querySelector('.product-descr__colors-img-btn.active')?.dataset.variant)
                    let colorNameValue = languageReplace(lang, selectedVariantColor['color_name'], selectedVariantColor['color_name'], selectedVariantColor['color_name'])
                    document.querySelector('.product-descr__colors-selected').innerHTML = ': ' + colorNameValue;
                } catch (e) {
                    alert(`{!! trans('labels.product_error') !!} 'Montant Color'`)
                    location.reload();
                }
            })

        });
        if (btnImageColors[0]) {
            setTimeout(() => {
                btnImageColors[0].click();
            }, 0)
        }

        function setModalSeeMoreImgs() {
            let modalSeeMoreContainer = document.querySelector('.modal-see-more__container');
            modalSeeMoreContainer.innerHTML = '';

            let matchingShelvesModalImgs = product['typeVariants']
                .filter(variant => variant.name_en.trim() === document.querySelector('.product-descr__shelf-type-btn.good.active').dataset.variant.trim())
                .flatMap(variant => variant.images)

            modalMoreSwiper.slideTo(0);
            matchingShelvesModalImgs.forEach(img => {
                if (window.innerWidth < 980 && img.image_mobile !== null && img.image_mobile !== '') {
                    modalSeeMoreContainer.innerHTML += `
                            <div class="swiper-slide modal_table_slide">
                                <picture>
                                    <source media="(max-width: 979px)" srcset="/storage/${img.image_mobile || img.image}"/>
                                    <img class="modal_table_img w-100" src="/storage/${img.image}" alt="" loading="lazy">
                                </picture>
                            </div>`
                }
                if (window.innerWidth >= 980) {
                    modalSeeMoreContainer.innerHTML += `
                            <div class="swiper-slide modal_table_slide">
                                <picture>
                                    <source media="(max-width: 979px)" srcset="/storage/${img.image_mobile || img.image}"/>
                                    <img class="modal_table_img w-100" src="/storage/${img.image}" alt="" loading="lazy">
                                </picture>
                            </div>`
                }
            })

        }

        let shelfTypeBtns = document.querySelectorAll('.product-descr__shelf-type-btn')
        let shelfColorBtns = document.querySelectorAll('.product-descr__colors-btn')

        Array.from(shelfTypeBtns).forEach(btn => {

            btn.addEventListener('click', (e) => {

                shelfColorBtns.forEach(item => {
                    item.classList.remove("active");
                })

                shelfTypeBtns.forEach(item => {
                    item.classList.remove("active");
                })
                let selectedVariantShelfs = product['typeVariants'].find(item => item['name_en'].trim() === btn.dataset.variant.trim())
                let shelfTypeNameValue = languageReplace(lang, selectedVariantShelfs['name_ro'], selectedVariantShelfs['name_ru'], selectedVariantShelfs['name_en'])

                document.querySelector('.product-descr__shelf-type-selected').innerHTML = ': ' + shelfTypeNameValue;

                //show/hide colors
                const index = btn.getAttribute('data-index');
                document.querySelectorAll('.shelf-colors').forEach(shelfDiv => {
                    shelfDiv.style.display = 'none';
                });
                document.getElementById('shelf-colors-' + index).style.display = 'grid';
                setTimeout(() => {
                    document.getElementById('shelf-colors-' + index).firstElementChild.click();
                }, 0)

                function getUniqueIds(product, variantType, key, datasetVariant) {
                    return [...new Set(
                        product[variantType]
                            .filter(shelf => shelf['name_en'].trim() === datasetVariant.trim())
                            .flatMap(shelf => shelf.shelves.map(s => parseInt(s[key]))))
                    ];
                }

                function updateButtons(buttonClass, uniqueIds) {
                    document.querySelectorAll(buttonClass).forEach(e => {
                        if (uniqueIds.includes(parseInt(e.dataset.id))) {
                            e.classList.add('good');
                        }
                    });

                    const activeGoodButton = document.querySelector(`${buttonClass}.good.active`);
                    if (!activeGoodButton) {
                        const activeButton = document.querySelector(`${buttonClass}.active:not(.good)`);
                        const firstGoodButton = document.querySelector(`${buttonClass}.good`);
                        activeButton?.classList.remove('active');
                        firstGoodButton?.classList.add('active');
                        firstGoodButton?.click();
                    }
                }

                const datasetVariant = btn.dataset.variant.trim();

                const uniqueProductWidthIds = getUniqueIds(product, 'typeVariants', 'product_width_id', datasetVariant);
                const uniqueProductDeepIds = getUniqueIds(product, 'typeVariants', 'product_deep_id', datasetVariant);

                btn.classList.add('active')

                updateButtons('.width_button', uniqueProductWidthIds);
                updateButtons('.deep_button', uniqueProductDeepIds);

                setTimeout(() => {
                    setShelfColors()
                    setModalSeeMoreImgs()
                    constructorTotalPrice();
                }, 0)
            })

            btn.addEventListener('mouseover', () => {
                let selectedVariantShelfs = product['typeVariants'].find(item => item['name_en'].trim() === btn.dataset.variant.trim())
                let shelfTypeNameValue = languageReplace(lang, selectedVariantShelfs['name_ro'], selectedVariantShelfs['name_ru'], selectedVariantShelfs['name_en'])
                document.querySelector('.product-descr__shelf-type-selected').innerHTML = ': ' + shelfTypeNameValue;
            })
            btn.addEventListener('mouseleave', () => {
                try {
                    let selectedVariantShelfs = product['typeVariants'].find(item => item['name_en'].trim() === document.querySelector('.product-descr__shelf-type-btn.good.active').dataset.variant.trim())
                    let shelfTypeNameValue = languageReplace(lang, selectedVariantShelfs['name_ro'], selectedVariantShelfs['name_ru'], selectedVariantShelfs['name_en'])
                    document.querySelector('.product-descr__shelf-type-selected').innerHTML = ': ' + shelfTypeNameValue;
                } catch (e) {
                    alert(`{!! trans('labels.product_error') !!} 'Shelf Type'`)
                    location.reload();
                }
            })

        })
        if (shelfTypeBtns[0]) {
            setTimeout(() => {
                shelfTypeBtns[0].click();
            }, 0)
        }

        Array.from(shelfColorBtns).forEach(btn => {

            btn.addEventListener('click', (e) => {
                shelfColorBtns.forEach(item => {
                    item.classList.remove("active");
                })
                document.querySelector('.product-descr__shelf-colors-selected').innerHTML = ': ' + btn.dataset.variant;
                btn.classList.add('active')
                constructorTotalPrice()
            })

            btn.addEventListener('mouseover', () => {
                document.querySelector('.product-descr__shelf-colors-selected').innerHTML = ': ' + btn.dataset.variant;
            })
            btn.addEventListener('mouseleave', () => {
                try {
                    document.querySelector('.product-descr__shelf-colors-selected').innerHTML = ': ' + document.querySelector('.product-descr__colors-btn.shelf-color.good.active').dataset.variant.trim();
                } catch (e) {
                    alert(`{!! trans('labels.product_error') !!}  'Shelf Color'`)
                    location.reload();
                }
            })

        })
        setTimeout(() => {
            if (shelfColorBtns.length > 0) shelfColorBtns[0].click();
        }, 0)

        let shelfQuantityBtns = document.querySelectorAll('.product-descr__quantity-button')
        Array.from(shelfQuantityBtns).forEach(btn => {
            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.product-descr__quantity-button').forEach(item => {
                    item.classList.remove("active");
                })
                document.querySelector('.product-descr__shelf-quantity-selected').innerHTML = ': ' + btn.dataset.variant;

                btn.classList.add('active')
                constructorTotalPrice()
            })
        })
        if (shelfQuantityBtns[0]) {
            setTimeout(() => {
                shelfQuantityBtns[0].click();
            }, 0)
        }

        //create price start
        function constructorTotalPrice() {
            setTimeout(() => {
                let width = document.querySelector('.width_button.active')
                let deep = document.querySelector('.deep_button.active')
                let height = document.querySelector('.height_button.active')
                let color = document.querySelector('.product-descr__colors-img-btn.active')

                let shelfType = document.querySelector('.product-descr__shelf-type-btn.good.active')
                let shelfColor = document.querySelector('.product-descr__colors-btn.good.active')
                let shelfNumber = document.querySelector('.product-descr__quantity-button.good.active')

                let showPrice = document.querySelector('.price-body__nr.price-body__nr');

                let montant = null;
                let shelvesAmount = shelfNumber ? parseInt(shelfNumber.dataset.variant) : null;
                let shelvesType = null;
                let traversaDeep = null;
                let traversaWidth = null;

                let pricePerUnit = 0;
                let actualQuantity;

                let widthPrice = 0;
                let depthPrice = 0;
                let heightPrice = 0;

                let matchingShelves;

                try {
                } catch (e) {
                    alert(`{!! trans('labels.product_error') !!} 'Price'`)
                    location.reload();
                }

                if (width && color) {
                    try {
                    widthPrice = (product['widthVariants'].find(variant =>
                        parseInt(variant.width) === parseInt(width.dataset.width)) || {}).traversWidthVariants?.find(variant =>
                        parseInt(variant.product_color_id) === parseInt(color.dataset.id));
                    } catch (e) {
                        alert(`{!! trans('labels.product_error') !!} 'Price'`)
                        location.reload();
                    }
                    traversaWidth = parseInt(widthPrice['price'])
                }

                if (deep && color) {
                    try {
                    depthPrice = (product['deepVariants'].find(variant =>
                            parseInt(variant.deep) === parseInt(deep.dataset.deep))
                            || {}).traversDeepVariants?.find(variant =>
                            parseInt(variant.product_color_id) === parseInt(color.dataset.id));
                    } catch (e) {
                        alert(`{!! trans('labels.product_error') !!} 'Price'`)
                        location.reload();
                    }
                    traversaDeep = parseInt(depthPrice['price'])
                }

                if (height && color) {
                    try {
                    heightPrice = (product['heightVariants'].find(variant =>
                            parseInt(variant.height) === parseInt(height.dataset.variant))
                            || {}).traversHeightVariants?.find(variant =>
                            parseInt(variant.product_color_id) === parseInt(color.dataset.id));
                    } catch (e) {
                        alert(`{!! trans('labels.product_error') !!} 'Price'`)
                        location.reload();
                    }
                    montant = parseInt(heightPrice['price'])
                }

                if (shelfType && shelfColor && deep && width) {
                    try {
                    matchingShelves = product['typeVariants']
                        .filter(variant => variant.name_en.trim() === shelfType.dataset.variant.trim())
                        .flatMap(variant => variant.shelves)
                        .filter(shelf => shelf.color_name.trim() === shelfColor.dataset.variant.trim())
                        .filter(shelf => parseInt(shelf.product_deep_id) === parseInt(deep.dataset.id))
                        .filter(shelf => parseInt(shelf.product_width_id) === parseInt(width.dataset.id));
                    } catch (e) {
                        alert(`{!! trans('labels.product_error') !!} 'Price'`)
                        location.reload();
                    }

                    if (matchingShelves.length > 0) {
                        shelvesType = parseInt(matchingShelves[0]['price'])
                    }
                }

                if (montant && shelvesAmount && shelvesType && traversaDeep && traversaWidth) {
                    pricePerUnit = montant * 4 + shelvesAmount * (traversaDeep + traversaWidth) + (shelvesAmount * shelvesType) + 60;
                    actualQuantity = document.querySelector('#productQuantity').value
                }

                if (isNaN(pricePerUnit) || parseInt(pricePerUnit) === 0) {
                    modulinePrice = 0;
                    showPrice.innerHTML = `0`;
                } else {
                    modulinePrice = pricePerUnit;
                    showPrice.innerHTML = `${pricePerUnit * parseInt(actualQuantity)}`
                }
            }, 0)
        }

        setTimeout(() => {
            constructorTotalPrice();
        }, 0)

        function waitActiveShelfType(selector, callback) {
            const observer = new MutationObserver((mutationsList, observer) => {
                if (document.querySelector(selector)) {
                    callback();
                    observer.disconnect();
                }
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }

        waitActiveShelfType('.product-descr__shelf-type-btn.good.active', () => {
            setModalSeeMoreImgs();
        });


    </script>
@endpush
