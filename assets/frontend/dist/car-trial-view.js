$(function(){
    loadProductsByCarTest(1, $("#ajaxContainer").data('testId'));
});

function loadProductsByCarTest(nextPage, carTestId){
    $.ajax({
        url: '/experience/car-trial/load-more-data',
        type: 'GET',
        data: {
            'page': nextPage,
            'CarTrialProductSearch[carTestId]':carTestId,
            'CarTrialProductSearch[typeSearch]': 3 // Search by test car
        },
        success: function(response) {
            $('#ajaxContainer').append(response.itemsHtml);
            if (window.testsSwiper) {
                window.testsSwiper.update(); // Обновляем слайдер
            }
        },
        error: function() {
            console.error("Ошибка загрузки данных");
        }
    });
}
