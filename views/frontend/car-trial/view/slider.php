<?php
/* @var $model app\modules\experience\models\CarTest */

use app\modules\experience\models\CarTest;

$images = $model->getFilePreview(CarTest::ATTRIBUTE_SRC_GALLERY, ['p' => 'car-crop-full']);
?>
<div class="experience__content-slider area-3">
    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper experience__photo">
        <div class="swiper-wrapper">
            <?php foreach ($images as $src):

                ?>
            <a class="swiper-slide"
               data-fancybox="experience"
               data-src="<?=$src?>">
                <img src="<?=$src?>" />
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div thumbsSlider="" class="swiper experience__photo-thumb">
        <div class="swiper-wrapper">
            <?php foreach ($images as $src): ?>
            <div class="swiper-slide">
                <img src="<?=$src?>" />
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="swiper-pagination experience__photo-pagination"></div>
</div>
