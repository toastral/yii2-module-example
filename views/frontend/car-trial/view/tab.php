<?php

use app\modules\experience\models\CarTrial;
use app\modules\product\helpers\CategoryHelper;
use app\modules\product\helpers\ServiceLineHelper;
use app\modules\product\widgets\ProductMarkWidget;
use yii\helpers\Url;

/* @var $isActive bool */
/* @var $component int */
/* @var $carTrial CarTrial */

?>

<div class="conclusion__content-tab <?=$isActive?"active":""?>" data-tab="<?=$component?>">
    <div class="container">
        <div class="conclusion__in">
            <div class="area-1">
                <div class="conclusion__product">
                    <div class="conclusion__product-headline">
                        <div class="conclusion__product-title">
                            <span>
                                <?=$carTrial->productRelation->serviceLine->title ?? $carTrial->productRelation->brandRelation->title?>
                            </span>
                            <?php if ($carTrial->productRelation->description): ?>
                                <div class="select-block__inf-icon"
                                    data-toggle="tooltip"
                                    data-placement="bottom"
                                    title="<?=$carTrial->productRelation->serviceLine->title ?? ''?>">
                                    i
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="conclusion__product-logo">

                            <?=\app\modules\product\widgets\ProductServiceLineMarkWidget::widget([
                                'marks' => $carTrial->productRelation->serviceLine->marks ?? [],
                                'template' => 'car-trial'
                            ]);?>

                            <?= ProductMarkWidget::widget(['mark' => $carTrial->productRelation->mark]); ?>

                        </div>
                    </div>
                    <div class="conclusion__product-content">
                        <div class="conclusion__product-content-top">
                            <div class="conclusion__product-content-headline">
                                <div class="conclusion__product-content-title">
                                    <?= CategoryHelper::getParenthesesPrefix($carTrial->productRelation->title) ?>
                                </div>
                                <div class="conclusion__product-content-subtitle">
                                    <?= CategoryHelper::getParenthesesSuffix($carTrial->productRelation->title); ?>
                                </div>
                            </div>
                            <div class="conclusion__product-content-picture">
                                <img src="<?=$carTrial->productRelation->src?>" alt="">
                            </div>
                        </div>
                        <div class="conclusion__product-content-bottom">
                            <div class="conclusion__product-content-text">
                                <?=$carTrial->productRelation->announce?>
                            </div>
                        </div>
                    </div>
                    <a href="<?=Url::to([ '/product/product/view',  'productAlias' => $carTrial->productRelation->alias, 'alias' => "all"], false); ?>" class="conclusion__product-more btn--border btn--round">
                        Подробнее о продукте
                    </a>
                </div>
                <div class="conclusion__product-descr">
                    <?php if($carTrial->componentName): ?><p>Наименование узла: <?=$carTrial->componentName?></p><?php endif;?>
                    <p>Наработка: <?=$carTrial->operatingTime?></p>
                </div>
            </div>
            <div class="area-2">
                <div class="conclusion__protocols">
                    <div class="conclusion__protocols-title">
                        <?php
                        $carTrialReports = $carTrial->getFilesData(CarTrial::ATTRIBUTE_DOC_GALLERY);
                        if (count($carTrialReports)): ?>
                        Протоколы исследований в независимой лаборатории
                        <?php endif; ?>
                    </div>
                    <div class="conclusion__protocols-list">
                        <?php
                        foreach ($carTrialReports as $data) {
                        ?>
                        <a href="<?=$data['src']?>" class="conclusion__protocols-list-item">
                            <div class="conclusion__protocols-list-item-ico">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 2H20C20.6 2 21 2.5 21 3V21C21 21.5 20.6 22 20 22H4C3.4 22 3 21.5 3 21V8L9 2ZM5.8 8H9V4.8L5.8 8ZM11 4V9C11 9.6 10.6 10 10 10H5V20H19V4H11Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="conclusion__protocols-list-item-descr">
                                <div class="conclusion__protocols-list-item-title">
                                    <?=$data['title']?>
                                </div>
                                <div class="conclusion__protocols-list-item-info">
                                    PDF
                                </div>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="area-3">
                <div class="conclusion__descr">
                    <div class="conclusion__descr-title">
                        Заключение
                    </div>
                    <div class="conclusion__descr-info">
                        <div class="conclusion__descr-info-title">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.298 8.288L17.702 9.713L11.909 15.42C11.522 15.807 11.013 16 10.502 16C9.991 16 9.477 15.805 9.086 15.415L6.304 12.719L7.697 11.282L10.49 13.989L16.298 8.288ZM24 12C24 18.617 18.617 24 12 24C5.383 24 0 18.617 0 12C0 5.383 5.383 0 12 0C18.617 0 24 5.383 24 12ZM22 12C22 6.486 17.514 2 12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12Z" fill="#36B555"/>
                            </svg>
                            <span>Защита двигателя от износа</span>
                        </div>
                        <div class="conclusion__descr-info-text">
                            <?=$carTrial->engineProtection?>
                        </div>
                    </div>
                    <div class="conclusion__descr-graph">
                        <img class="conclusion__descr-graph-img" src="<?=$carTrial->getSrc1()?>" alt="">
                    </div>
                    <div class="conclusion__descr-info">
                        <div class="conclusion__descr-info-title">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.298 8.288L17.702 9.713L11.909 15.42C11.522 15.807 11.013 16 10.502 16C9.991 16 9.477 15.805 9.086 15.415L6.304 12.719L7.697 11.282L10.49 13.989L16.298 8.288ZM24 12C24 18.617 18.617 24 12 24C5.383 24 0 18.617 0 12C0 5.383 5.383 0 12 0C18.617 0 24 5.383 24 12ZM22 12C22 6.486 17.514 2 12 2C6.486 2 2 6.486 2 12C2 17.514 6.486 22 12 22C17.514 22 22 17.514 22 12Z" fill="#36B555"/>
                            </svg>
                            <span>Запас свойств масла</span>
                        </div>
                        <div class="conclusion__descr-info-text">
                            <?=$carTrial->metalPropertiesStock?>
                        </div>
                    </div>
                    <div class="conclusion__descr-graph">
                        <img src="<?=$carTrial->getSrc2()?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
