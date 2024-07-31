<?php
use app\modules\experience\models\CarTrial;
use app\modules\product\helpers\CategoryHelper;
/* @var $structuredData array */

$count = 0;
foreach($structuredData as $productId => $productAggregator):
    foreach($productAggregator["components"] as $component):
        $carTrialsResult = CarTrial::getByProductAndComponent($productId, $component,1);
        ?>
        <div class="swiper-slide tests__slider-item cars-block">
        <?=$this->render('../_cart/index.php', [
            'src' => $productAggregator["src"],
            'title' => CategoryHelper::getParenthesesPrefix($productAggregator["title"]),
            'subtitle' => CategoryHelper::getParenthesesSuffix($productAggregator["title"]),
            "componentTitle" => CarTrial::getComponentOptions()[$component],
            "carTrials" => $carTrialsResult['records'],
        ]);
        ?>
            <?php if (!$carTrialsResult['isLastPage']):?>
                <div class="tests__item-more" data-product-id="<?=$productId?>" data-page="1" data-component="<?=$component?>">
                    + ЕЩЕ
                </div>
            <?php endif; ?>
        </div>
    <?php
    endforeach;
endforeach;
