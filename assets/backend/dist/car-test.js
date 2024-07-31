$(document).ready(function () {
    var brandSelect = $('#car_brand_id');
    var brandId = brandSelect.val();
    if (brandId.length) {
        loadCarModelSelect(brandId, $('#car_model_id').val());
    }
    brandSelect.on('change', function () {
        loadCarModelSelect($(this).val());
    });

    function loadCarModelSelect(brandId, modelId = 0) {
        var getModelUrl = $('#get-model-url');
        $.get(getModelUrl.val(), {id: brandId}, function (data) {
            var modelSelect = $('#car_model_id');
            modelSelect.html(data).trigger('change');
            if (modelId) {
                modelSelect.val(modelId);
                modelSelect.trigger('change');
            }
        });
    }
});
