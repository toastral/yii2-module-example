<?php

use yii\helpers\Url;

/* @var $src string */
/* @var $title string */
/* @var $subtitle string */
/* @var $componentTitle string */
/* @var $carTrials array */

?>
<div class="tests__item-headline">
    <div class="tests__item-picture">
        <img src="<?=$src?>" alt="">
    </div>
    <div class="tests__item-descr">
        <div class="tests__item-title">
            <?=$title?>
        </div>
        <div class="tests__item-subtitle">
            <?=$subtitle?>
        </div>
        <div class="tests__item-text">
            <?=$componentTitle?>
        </div>
    </div>
</div>
<div class="tests__item-list">
    <?=$this->render("cars", ['carTrials' => $carTrials]);?>
</div>

