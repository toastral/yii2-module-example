$(function(){

    const typeSearchProduct = 1;
    const typeSearchBrand = 2;
    let showBtn = $('.tests__search-tab-show');


    $('#carModelSelect').select2({
        language: 'car-trial-ru',
        minimumResultsForSearch: -1 // Отключает поле поиска
    });

    loadProducts(1, typeSearchProduct, 0, 0, 0, 0);
    showBtn.attr('disabled', 'disabled');

    $('.tests__tab').on('click', function(e) {
        let typeSearch = $(this).data('tab');
        clearMoreData();
        clearSelect();
        $('#nextButton').data('type-search', typeSearch);
        loadProducts(1, typeSearch, 0, 0, 0, 0);
        showBtn.attr('disabled', 'disabled');
    });

    $('#carBrandSelect').change(function() {
        var carBrandId = $(this).val();
        $('#searchButton2').removeAttr('disabled');
        $.ajax({
            url: '/experience/car-trial/get-car-models',
            type: 'GET',
            data: { carBrandId: carBrandId },
            success: function(response) {
                $('#carModelSelect').empty();
                $('#carModelSelect').append('<option value=""></option>');
                $.each(response.modelOptions, function(id, name) {
                    $('#carModelSelect').append('<option value="' + id + '">' + name + '</option>');
                });
            },
            error: function() {
                alert('Ошибка загрузки моделей автомобилей');
            }
        });
    });

    $('#carModelSelect').change(function() {
        $('#searchButton2').removeAttr('disabled');
    });

    $('.clearFilter').on('click', function() {
        clearSelect();
        clearMoreData();
        let typeSearch =  $(this).closest('.tests__search-tab').data('tab');
        loadProducts(1, typeSearch, 0, 0, 0, 0);
        $('.tests__search-tab-show').attr('disabled', 'disabled');
    });

    $('#specificationSelect').change(function() {
        var specificationId = $(this).val();
        $('#searchButton1').removeAttr('disabled');
        $('#nextButton').data('specification-id', specificationId);
        $.ajax({
            url: '/experience/car-trial/get-products-by-specification',
            type: 'GET',
            data: { specificationId: specificationId },
            success: function(response) {
                $('#productSelect').empty();
                $('#productSelect').append('<option></option>'); // Пустой option для плейсхолдера
                $.each(response.productOptions, function(key, value) {
                    $('#productSelect').append($('<option></option>').attr('value', key).text(value));
                });
            },
            error: function() {
                console.error('Не удалось загрузить продукты');
            }
        });
    });

    $('#productSelect').change(function() {
        $('#searchButton1').removeAttr('disabled');
    });

    $(document).on('click', '#nextButton', function(e) {
        e.preventDefault();
        var _this = $(this);
        var currentPage = _this.data('page');
        var nextPage = parseInt(currentPage) + 1;
        loadProducts(nextPage,
            _this.data('typeSearch'),
            _this.data('specificationId'),
            _this.data('productId'),
            _this.data('modelId'),
            _this.data('brandId'));
    });

    $('#searchButton1').on('click', function(e) {
        e.preventDefault();
        clearMoreData();
        var productId = $('#productSelect').val();

        if (!productId) {
            productId=0;
        }
        var specificationId = $('#specificationSelect').val();
        if (!specificationId) {
            specificationId=0;
        }
        $('#nextButton')
            .data('product-id', productId)
            .data('specification-id', specificationId)
            .data('type-search', typeSearchProduct);

        loadProducts(1, typeSearchProduct, specificationId, productId, 0, 0);
    });

    $('#searchButton2').on('click', function(e) {
        e.preventDefault();
        clearMoreData();
        var carBrandId = $('#carBrandSelect').val();
        var carModelId = $('#carModelSelect').val();

        if (!carBrandId) {
            $('#ajaxContainer').html('<p>Пожалуйста, выберите бренд автомобиля.</p>');
            return;
        }
        if (!carModelId) {
            carModelId=0;
        }

        $('#nextButton')
            .data('brand-id', carBrandId)
            .data('model-id', carModelId)
            .data('type-search', typeSearchBrand);

        loadProducts(1, typeSearchBrand, 0, 0, carModelId, carBrandId);
    });

    function loadProducts(nextPage, typeSearch, specificationId, productId, modelId, brandId) {
        $('#ajaxContainer').removeClass('animate-contaniner');
        $.ajax({
            url: '/experience/car-trial/load-more-data',
            type: 'GET',
            data: {
                'page': nextPage,
                'CarTrialProductSearch[specificationId]': specificationId,
                'CarTrialProductSearch[productId]': productId,
                'CarTrialProductSearch[modelId]': modelId,
                'CarTrialProductSearch[brandId]': brandId,
                'CarTrialProductSearch[typeSearch]': typeSearch
            },
            success: function(response) {
                $('#ajaxContainer').append(response.itemsHtml);
                $('#ajaxContainer').addClass('animate-contaniner');

                if (response.isLastPage) {
                    $('#nextButton').hide();
                } else {
                    $('#nextButton').show();
                    $('#nextButton').data('page', nextPage);
                }
            },
            error: function() {
                console.error("Ошибка загрузки данных");
                $('#ajaxContainer').addClass('animate-contaniner');
            }
        });
    }

    function clearSelect() {
        $('#specificationSelect').val(null).trigger('change');
        $('#carBrandSelect').val(null).trigger('change');
    }

    function clearMoreData() {
        $('#ajaxContainer').empty();
        $('#nextButton')
            .data('page', 1)
            .data('specification-id', 0)
            .data('product-id', 0)
            .data('model-id', 0)
            .data('brand-id', 0)
            .data('type-search', 0)
            .hide();
    }

});
