$(function(){

    $(document).on('click', '.tests__item-more', function() {
        console.log($(this).data('productId'));
        let productId = $(this).data('productId');
        let component = $(this).data('component');
        let page = $(this).data('page');
        loadMoreCars(productId, component, page+1, this);
    });

    function loadMoreCars(productId, component, nextPage, that) {
        $.ajax({
            url: '/experience/car-trial/load-more-cars',
            type: 'GET',
            data: {
                'page': nextPage,
                'productId': productId,
                'component': component
            },
            success: function(response) {
                $(that).closest('.cars-block').find('.tests__item-list').append(response.itemsHtml);
                if (response.isLastPage) {
                    $(that).hide();
                } else {
                    $(that).show();
                    $(that).data('page', nextPage);
                }

            },
            error: function() {
                console.error("Ошибка загрузки данных");
            }
        });
    }
});
