<?php

use yii\helpers\Url;

/* @var $carTrials array */

foreach($carTrials as $carTrial):
?>
    <a href="<?=Url::to([ '/experience/car-trial/view',  'id' => $carTrial->carTestRelation->id], false); ?>">
        <div class="tests__item-list-target">
            <div class="tests__item-list-target-title">
                <?=$carTrial->carTestRelation->carBrand->name?>
            </div>
            <div class="tests__item-list-target-subtitle">
                <?=$carTrial->carTestRelation->carModel->name?>
            </div>
            <div class="tests__item-list-target-text">
                Год выпуска <?=$carTrial->carTestRelation->year?>
            </div>
            <div class="tests__item-list-target-ico">
                <img src="/static/default/img/tests/time-ico.png" alt="">
            </div>
        </div>
    </a>
<?php endforeach; ?>
