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


    function priceConstructorOld() {
        let colorName = document.querySelector('.product_color_name');
        let colorSelected = document.querySelector('.product_color_selected');
        let model = document.querySelector('.product_model');
        let maxLoad = document.querySelector('.product_max_load')
        let extensionLength = document.querySelector('.product_extension_length')
        let dimension = document.querySelector('.product_dimension')

        data['product_variant'] = product;

        if (document.querySelector('.price-body__nr')) {
            document.querySelector('.price-body__nr').textContent = product['price'];
        }
        document.querySelector('.product_code').textContent = product['code_1c'];

        if (colorSelected) colorSelected.textContent = product['color_name'];
        if (colorName) colorName.textContent = product['color_name'];
        if (model) model.textContent = product['model'];
        if (maxLoad) maxLoad.textContent = product['max_load'];
        if (extensionLength) extensionLength.textContent = product['extension_length'];
        if (dimension) dimension.textContent = product['dimension'];
    }

    priceConstructorOld();

    function buttonsOld() {
        let dimensions = '';
        let btnImageColors = document.querySelectorAll('.product-descr__colors-img-btn')
        if (btnImageColors[0]) {
            setTimeout(() => {
                btnImageColors[0].click();
            }, 0)
        }
        let dimensionsContainer = document.querySelector('.product-descr__dimensions')

        Array.from(btnImageColors).forEach(btn => {

            btn.addEventListener('click', (e) => {
                document.querySelectorAll('.product-descr__colors-img-btn').forEach(item => {
                    item.classList.remove("active");
                })

                let selectedVariantColor = product['colorVariants'].find(item => item.color_name === btn.dataset.variant)
                let colorNameValue = languageReplace(lang, selectedVariantColor['color_name'], selectedVariantColor['color_name'], selectedVariantColor['color_name'])

                document.querySelector('.product-descr__colors-selected').innerHTML = ': ' + colorNameValue;

                let colorName = document.querySelector('.product_color_name');
                let colorSelected = document.querySelector('.product_color_selected');
                let model = document.querySelector('.product_model');
                let maxLoad = document.querySelector('.product_max_load')
                let extensionLength = document.querySelector('.product_extension_length')
                let dimension = document.querySelector('.product_dimension')
                let selectedType = dimensions;
                let selectedVariant = product['colorVariants'].find(variant =>
                    variant.color_name.trim() === btn.dataset.variant.trim()
                ) || null;

                if (!selectedVariant) {
                    selectedVariant = product['colorVariants'].find(variant => variant.dimension.trim() === selectedType.trim())
                }
                data['product_variant'] = selectedVariant;

                if (selectedVariant) {
                    if (document.querySelector('.price-body__nr')) {
                        document.querySelector('.price-body__nr').textContent = selectedVariant['price'];
                    }
                    document.querySelector('.product_code').textContent = selectedVariant['code_1c'];

                    if (colorSelected) colorSelected.textContent = selectedVariant['color_name'];
                    if (colorName) colorName.textContent = selectedVariant['color_name'];
                    if (model) model.textContent = selectedVariant['model'];
                    if (maxLoad) maxLoad.textContent = selectedVariant['max_load'];
                    if (extensionLength) extensionLength.textContent = selectedVariant['extension_length'];
                    if (dimension) dimension.textContent = selectedVariant['dimension'];
                }

                btn.classList.add('active')

            })
        })
    }

</script>
@endpush
