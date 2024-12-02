@if (collect($product->variants)->pluck('dimension')->filter()->isNotEmpty())
    <div class="product-descr__dimensions-text d-flex justify-content-between">
        <div class="d-flex align-items-center justify-content-center">
            <span>{{trans('labels.product_code')}}: &nbsp;</span>
            <span class="product-descr__dimensions-selected"></span>
        </div>
        @if(isset($product['variants'][0]['size_table']))
            <span class="product-descr__size-table">
                {{trans('labels.size_table')}}
                <i class="arrow-down"></i>
            </span>
        @endif
    </div>

    @if (collect($product->variants)->pluck('type_en')->filter()->isNotEmpty())
        <div class="product-descr__dimensions-select default">
            @foreach(collect($product->variants)->unique('type_en') as $variant)
                <button class="product-descr__dimensions-button default"
                        data-variant="{{ $variant['type_en'] }}">
                    {{ $language->replace($variant['type_ro'], $variant['type_ru'], $variant['type_en']) }}
                </button>
            @endforeach
        </div>
    @endif
@endif

@if (collect($product->variants)->pluck('color')->filter()->isNotEmpty())
    <div class="product-descr__colors-btns">
        <p class="product-descr__dimensions-text">{{trans('labels.color')}}<span class="product-descr__colors-selected"></span></p>
        <div class="product-descr__colors-select default">

            @foreach(collect($product->variants)->pluck('color', 'color_name')->unique() as $color_name => $color)
                <button class="product-descr__colors-btn" data-variant="{{ $color_name }}" style="background-color: {{ $color }};"></button>
            @endforeach
        </div>
    </div>
@endif


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
        console.log('product', product)
        let modulinePrice = 0;
        const userLoginProduct = '{!! isset($currentUser) ? $currentUser->id : '' !!}';
        const productsFavorite = window.localStorage.getItem('vitraFavorite');
        const similarProducts = {!! json_encode($similarProducts) !!};


        (function handleDimensionColorSelect() {
            let quantity = document.getElementById('productQuantity');
            let dimensionButtons = document.querySelectorAll('.product-descr__dimensions-button');
            let colorButtons = document.querySelectorAll('.product-descr__colors-btn');
            let elements = {
                colorName: document.querySelector('.product_color_name'),
                colorSelected: document.querySelector('.product_color_selected'),
                model: document.querySelector('.product_model'),
                maxLoad: document.querySelector('.product_max_load'),
                extensionLength: document.querySelector('.product_extension_length'),
                dimension: document.querySelector('.product_dimension'),
                price: document.querySelector('.price-body__nr'),
                code: document.querySelector('.product_code'),
                code_top: document.querySelector('.product-descr__dimensions-selected'),
                weight: document.querySelector('.product_weight')
            };

            function clearActiveClass(buttons) {
                buttons.forEach(btn => btn.classList.remove("active"));
            }

            function updateUI(selectedVariant) {
                if (!selectedVariant) return;
                if (elements.price) {
                    elements.price.textContent = `${parseInt(selectedVariant['price']) * parseInt(quantity.value)}`;
                    modulinePrice = selectedVariant['price'];
                }
                if (elements.colorName) elements.colorName.textContent = selectedVariant['color_name'];
                if (elements.colorSelected) elements.colorSelected.textContent = selectedVariant['color_name'];
                if (elements.model) elements.model.textContent = selectedVariant['model'];
                if (elements.maxLoad) elements.maxLoad.textContent = selectedVariant['max_load'];
                if (elements.extensionLength) elements.extensionLength.textContent = selectedVariant['extension_length'];
                if (elements.dimension) elements.dimension.textContent = selectedVariant['dimension'];
                if (elements.code) elements.code.textContent = selectedVariant['code'];
                if (elements.code_top) elements.code_top.textContent = selectedVariant['code'];
                if (elements.weight) elements.weight.textContent = selectedVariant['weight'];
            }

            function getSelectedVariant(type, color = null) {
                return product['variants']?.find(variant =>
                    (variant['type_en']?.trim() === type.trim() && (!color || variant['color_name']?.trim() === color.trim())))
                    || null;
            }

            function handleDimensionClick(e) {
                clearActiveClass(dimensionButtons);
                e.target.classList.add('active');

                const selectedColor = document.querySelector('.product-descr__colors-btn.active');
                const selectedVariant = getSelectedVariant(e.target.dataset.variant, selectedColor?.dataset.variant);
                data['product_variant'] = selectedVariant;
                updateUI(selectedVariant);
            }

            function handleColorClick(e) {
                let selectedDimension = document.querySelector('.product-descr__dimensions-button.active');
                let selectedVariant;
                clearActiveClass(colorButtons);
                e.target.classList.add('active');

                const selectedColor = languageReplace(lang, e.target.dataset.variant, e.target.dataset.variant, e.target.dataset.variant);
                document.querySelector('.product-descr__colors-selected').innerHTML = ': ' + selectedColor;

                if (selectedDimension) {
                    selectedVariant = getSelectedVariant(selectedDimension.dataset.variant, e.target.dataset.variant);
                    data['product_variant'] = selectedVariant;
                }
                updateUI(selectedVariant);
            }

            dimensionButtons.forEach(btn => btn.addEventListener('click', handleDimensionClick));
            setTimeout(() => {
                if (dimensionButtons[0]) dimensionButtons[0].click()
            }, 0);

            if (colorButtons && colorButtons.length > 0) {
                colorButtons.forEach(btn => btn.addEventListener('click', handleColorClick));

                colorButtons.forEach(btn => btn.addEventListener('mouseover', () => {
                    let selectedVariantColor = product['variants'].find(item => item.color_name === btn.dataset.variant);
                    let colorNameValue = languageReplace(lang, selectedVariantColor['color_name'], selectedVariantColor['color_name'], selectedVariantColor['color_name']) || '';
                    document.querySelector('.product-descr__colors-selected').innerHTML = ': ' + colorNameValue;
                }))
                colorButtons.forEach(btn => btn.addEventListener('mouseleave', () => {
                    let selectedVariantColor = product['variants'].find(item => item.color_name === document.querySelector('.product-descr__colors-btn.active').dataset.variant
                                                                    || item.color_name_en === document.querySelector('.product-descr__colors-btn.active').dataset.variant) || '';
                    let colorNameValue = languageReplace(lang, selectedVariantColor['color_name'], selectedVariantColor['color_name'], selectedVariantColor['color_name'])
                    document.querySelector('.product-descr__colors-selected').innerHTML = ': ' + colorNameValue;
                }))

                setTimeout(() => {
                    if (colorButtons[0]) colorButtons[0].click()
                }, 0);
            }
        })();

        let openModalTable = document.querySelector('.product-descr__size-table')
        if (openModalTable) {

            openModalTable.addEventListener('click', () => {
                document.querySelector('.modal__wrapper-table').style.display = 'flex';
            })
            document.querySelector('.modal__close-table').addEventListener('click', () => {
                document.querySelector('.modal__wrapper-table').style.display = 'none';
            })
        }

    </script>
@endpush
