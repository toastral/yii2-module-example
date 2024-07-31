<?php

use app\modules\experience\assets\frontend\CarTrialViewAsset;
use app\modules\experience\models\CarTest;
use app\modules\experience\models\CarTrial;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\experience\models\CarTest */
/* @var $carTrialsGrouped array */
/* @var $aComponents array */

$this->title = "Опыт эксплуатации";
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Car Trial'), 'url' => ['index']];

CarTrialViewAsset::register($this);
?>
<div class="base-page contact__page experience">
    <div class="container">
        <?= $this->render('//parts/common/breadcrumbs'); ?>
        <div class="experience__in">
            <div class="experience__headline">
                <h1 class="experience__title page-title">
                    <?=$model->name?>
                </h1>
            </div>
            <div class="experience__card">
                <div class="experience__info">
                    <?php $engine = CarTest::getEngineTypeOptions()[$model->engine_type] ?? false; ?>
                    <?php if ($engine): ?>
                    <div class="experience__info-item">
                        <div class="experience__info-item-picture">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_135_5630)">
                                    <path d="M21.5 9H21V8.5C21 7.122 19.878 6 18.5 6H16V3H19C19.552 3 20 2.552 20 2C20 1.448 19.552 1 19 1H11C10.448 1 10 1.448 10 2C10 2.552 10.448 3 11 3H14V6H11.437C10.544 6 9.704 6.394 9.133 7.08L7.532 9H7.5C6.122 9 5 10.122 5 11.5V13H2V10C2 9.448 1.552 9 1 9C0.448 9 0 9.448 0 10V18C0 18.552 0.448 19 1 19C1.552 19 2 18.552 2 18V15H5V17.171C5 17.972 5.312 18.726 5.879 19.293L7.707 21.121C8.273 21.688 9.027 22 9.829 22H18.5C19.708 22 20.717 21.14 20.95 20H21.5C22.878 20 24 18.878 24 17.5V11.5C24 10.122 22.878 9 21.5 9ZM22 17.5C22 17.776 21.776 18 21.5 18H20C19.448 18 19 18.448 19 19V19.5C19 19.776 18.776 20 18.5 20H9.829C9.562 20 9.31 19.896 9.121 19.707L7.293 17.879C7.104 17.69 7 17.439 7 17.171V11.5C7 11.224 7.224 11 7.5 11H8C8.297 11 8.578 10.868 8.768 10.64L10.669 8.36C10.859 8.131 11.139 8 11.437 8H18.5C18.776 8 19 8.224 19 8.5V10C19 10.552 19.448 11 20 11H21.5C21.776 11 22 11.224 22 11.5V17.5Z" fill="#E35205"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_135_5630">
                                        <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="experience__info-item-text">
                            <div class="experience__info-item-title">
                                Двигатель
                            </div>
                            <div class="experience__info-item-subtitle">
                                <?=$engine?>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if ($model->mode): ?>
                    <div class="experience__info-item">
                        <div class="experience__info-item-picture">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_135_5637)">
                                    <path d="M24.5 13C24.5036 14.5735 24.1954 16.1322 23.5933 17.5859C22.9912 19.0397 22.1071 20.3598 20.992 21.47C20.4532 22.0121 19.7297 22.3312 18.9661 22.3634C18.2024 22.3957 17.4546 22.1388 16.872 21.644L15.846 20.757C15.7466 20.6711 15.6651 20.5665 15.6061 20.4491C15.5471 20.3317 15.5118 20.2039 15.5023 20.0728C15.483 19.8082 15.5695 19.5468 15.743 19.346C15.8289 19.2466 15.9335 19.1651 16.0509 19.1061C16.1683 19.0471 16.2961 19.0118 16.4272 19.0023C16.6918 18.983 16.9532 19.0695 17.154 19.243L18.181 20.131C18.3788 20.2997 18.6339 20.386 18.8935 20.3721C19.1531 20.3581 19.3974 20.245 19.576 20.056C20.5296 19.0907 21.2776 17.9422 21.7751 16.6798C22.2726 15.4174 22.5091 14.0673 22.4704 12.711C22.4317 11.3547 22.1186 10.0203 21.55 8.78833C20.9814 7.55636 20.169 6.45237 19.162 5.543C18.111 4.59466 16.8689 3.88275 15.5193 3.45528C14.1698 3.02781 12.7443 2.89472 11.339 3.065C9.46877 3.28172 7.69783 4.02243 6.23023 5.20177C4.76263 6.38112 3.65808 7.9511 3.04387 9.73083C2.42965 11.5106 2.33076 13.4276 2.75858 15.2611C3.18641 17.0946 4.12354 18.7699 5.462 20.094C5.64192 20.2699 5.88154 20.3715 6.13306 20.3785C6.38458 20.3856 6.62951 20.2976 6.819 20.132L7.846 19.243C8.04677 19.0695 8.30822 18.983 8.57283 19.0023C8.83744 19.0216 9.08355 19.1452 9.257 19.346C9.43045 19.5468 9.51704 19.8082 9.49772 20.0728C9.47841 20.3374 9.35477 20.5835 9.154 20.757L8.128 21.645C7.55596 22.1368 6.8204 22.3963 6.06642 22.3724C5.31243 22.3485 4.59477 22.043 4.055 21.516C2.651 20.1252 1.61222 18.4093 1.0309 16.5205C0.449594 14.6317 0.343754 12.6286 0.722786 10.6891C1.10182 8.74954 1.95399 6.93365 3.20361 5.40268C4.45322 3.87171 6.0616 2.67305 7.88589 1.91318C9.71017 1.15331 11.6939 0.855739 13.6608 1.04691C15.6278 1.23808 17.5171 1.91207 19.1609 3.00901C20.8047 4.10595 22.1522 5.59189 23.0836 7.33483C24.015 9.07778 24.5015 11.0238 24.5 13ZM18.207 8.707C18.3892 8.5184 18.49 8.26579 18.4877 8.0036C18.4854 7.7414 18.3802 7.49059 18.1948 7.30518C18.0094 7.11977 17.7586 7.0146 17.4964 7.01232C17.2342 7.01005 16.9816 7.11084 16.793 7.293L13.018 11.068C12.5927 10.954 12.1417 10.9835 11.7349 11.152C11.3282 11.3205 10.9883 11.6184 10.7682 11.9997C10.548 12.381 10.4598 12.8243 10.5173 13.2608C10.5748 13.6973 10.7746 14.1027 11.086 14.414C11.3973 14.7253 11.8027 14.9252 12.2392 14.9827C12.6757 15.0402 13.119 14.952 13.5003 14.7318C13.8816 14.5117 14.1795 14.1718 14.348 13.7651C14.5165 13.3583 14.546 12.9073 14.432 12.482L18.207 8.707Z" fill="#E35205"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_135_5637">
                                        <rect width="24" height="24" fill="white" transform="translate(0.5)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="experience__info-item-text">
                            <div class="experience__info-item-title">
                                Режим эксплуатации
                            </div>
                            <div class="experience__info-item-subtitle">
                                <?=$model->mode?>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if ($model->region): ?>
                    <div class="experience__info-item">
                        <div class="experience__info-item-picture">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_135_5647)">
                                    <path d="M11.9582 24.008L11.2611 23.4105C10.3001 22.6058 1.90918 15.3591 1.90918 10.0583C1.90918 4.50839 6.40829 0.00928116 11.9582 0.00928116C17.5081 0.00928116 22.0072 4.50839 22.0072 10.0583C22.0072 15.3592 13.6163 22.6059 12.6593 23.4145L11.9582 24.008ZM11.9582 2.18217C7.6104 2.18709 4.08704 5.71045 4.08212 10.0583C4.08212 13.3883 9.24455 18.7081 11.9582 21.1429C14.6719 18.7071 19.8343 13.3843 19.8343 10.0583C19.8294 5.71045 16.306 2.18714 11.9582 2.18217Z" fill="#E35205"/>
                                    <path d="M11.958 14.0416C9.75802 14.0416 7.97461 12.2582 7.97461 10.0583C7.97461 7.85836 9.75802 6.07495 11.958 6.07495C14.1579 6.07495 15.9413 7.85836 15.9413 10.0583C15.9413 12.2582 14.1579 14.0416 11.958 14.0416ZM11.958 8.06658C10.858 8.06658 9.96628 8.95828 9.96628 10.0583C9.96628 11.1582 10.858 12.0499 11.958 12.0499C13.0579 12.0499 13.9496 11.1582 13.9496 10.0583C13.9496 8.95828 13.058 8.06658 11.958 8.06658Z" fill="#E35205"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_135_5647">
                                        <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="experience__info-item-text">
                            <div class="experience__info-item-title">
                                Регион
                            </div>
                            <div class="experience__info-item-subtitle">
                                <?=$model->region?>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if ($model->mileage): ?>
                    <div class="experience__info-item">
                        <div class="experience__info-item-picture">
                            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_135_5656)">
                                    <path d="M5.50513 24.006C4.95713 24.006 4.40813 23.808 3.98113 23.41L1.99113 21.561C0.0151256 19.586 0.0151255 16.414 1.96513 14.465C2.91013 13.521 4.16613 13.001 5.50113 13.001C6.83613 13.001 8.09213 13.521 9.03613 14.465C9.98113 15.409 10.5011 16.665 10.5011 18.001C10.5011 19.337 9.98113 20.592 9.03613 21.536L7.03513 23.407C6.60713 23.807 6.05713 24.007 5.50713 24.007L5.50513 24.006ZM5.50013 15C4.69913 15 3.94513 15.312 3.37813 15.879C2.20913 17.048 2.20913 18.951 3.37813 20.121L5.34213 21.945C5.43413 22.03 5.57613 22.03 5.66813 21.945L7.64513 20.098C8.18713 19.555 8.49913 18.802 8.49913 18C8.49913 17.198 8.18713 16.445 7.62013 15.878C7.05413 15.312 6.30113 15 5.50013 15ZM19.5051 11.006C18.9571 11.006 18.4081 10.807 17.9811 10.41L15.9911 8.561C14.0151 6.586 14.0151 3.414 15.9651 1.465C16.9091 0.520999 18.1651 0.000999451 19.5011 0.000999451C20.8371 0.000999451 22.0911 0.520999 23.0361 1.465C24.9861 3.415 24.9861 6.587 23.0361 8.536L21.0351 10.407C20.6071 10.807 20.0561 11.007 19.5061 11.007L19.5051 11.006ZM19.5001 2C18.6981 2 17.9451 2.312 17.3781 2.878C16.2091 4.048 16.2091 5.951 17.3781 7.121L19.3411 8.945C19.4341 9.031 19.5771 9.029 19.6681 8.945L21.6451 7.098C22.7901 5.952 22.7901 4.049 21.6211 2.879C21.0541 2.312 20.3011 2 19.5001 2ZM24.5001 20C24.5001 17.794 22.7061 16 20.5001 16H15.5001C14.3971 16 13.5001 15.103 13.5001 14C13.5001 13.153 14.0361 12.396 14.8331 12.114C15.3541 11.93 15.6271 11.359 15.4431 10.838C15.2591 10.317 14.6891 10.043 14.1671 10.228C12.5721 10.791 11.5001 12.308 11.5001 14C11.5001 16.206 13.2941 18 15.5001 18H20.5001C21.6031 18 22.5001 18.897 22.5001 20C22.5001 21.103 21.6031 22 20.5001 22H11.5001C10.9481 22 10.5001 22.448 10.5001 23C10.5001 23.552 10.9481 24 11.5001 24H20.5001C22.7061 24 24.5001 22.206 24.5001 20Z" fill="#E35205"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_135_5656">
                                        <rect width="24" height="24" fill="white" transform="translate(0.5)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="experience__info-item-text">
                            <div class="experience__info-item-title">
                                Пробег
                            </div>
                            <div class="experience__info-item-subtitle">
                                <?=$model->mileage?> км
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <div class="experience__content">
                    <div class="experience__content-descr area-1">
                        <div class="experience__content-descr-title">
                            Особенности автомобиля
                        </div>
                        <div class="experience__content-descr-text">
                            <p>Марка: <?=$model->carBrand->name?></p>
                            <p>Модель: <?=$model->carModel->name?></p>
                            <?php if($model->generation): ?><p>Поколение: <?=$model->generation?></p>  <?php endif; ?>
                            <?php if($model->modification): ?><p>Модификация: <?=$model->modification?></p> <?php endif; ?>
                            <?php if($model->year): ?> <p>Год выпуска: <?=$model->year?></p> <?php endif; ?>
                            <?php if($model->engine_type): ?> <p>Двигатель тип: <?=CarTest::getEngineTypeOptions()[$model->engine_type] ?? "-"?></p> <?php endif; ?>
                            <?php if($model->gearbox): ?> <p>КПП тип: <?=CarTest::getGearboxOptions()[$model->gearbox] ?? "-"?></p> <?php endif; ?>
                            <?php if($model->engine_model): ?> <p>Двигатель модель: <?=$model->engine_model?></p> <?php endif; ?>
                            <?php if($model->mode): ?> <p>Режим эксплуатации: <?=$model->mode?></p> <?php endif; ?>
                            <?php if($model->region): ?> <p>Регион эксплуатации: <?=$model->region?></p> <?php endif; ?>
                            <?php if($model->mileage): ?> <p>Текущий пробег: <?=$model->mileage?></p> <?php endif; ?>
                            <?php if($model->features): ?> <p>Особенности автомобиля: <?= strip_tags($model->features)?></p> <?php endif; ?>
                        </div>
                    </div>
                    <?php if (!empty($model->owner_review)): ?>
                        <div class="experience__content-callback area-2">
                            <div class="experience__content-callback-header">
                                <div class="experience__content-callback-picture">
                                    <?php if ($model->getSrc()):?>
                                    <img src="<?=$model->getIcon()?>" alt="">
                                    <?php endif;?>
                                </div>
                                <div class="experience__content-callback-headline">
                                    <div class="experience__content-callback-title">
                                        <?=$model->owner_name?>
                                    </div>
                                    <div class="experience__content-callback-subtitle">
                                        <?=$model->owner_age?>, <?=$model->owner_city?>
                                    </div>
                                </div>
                            </div>
                            <div class="experience__content-callback-content">
                                <div class="experience__content-callback-content-title">
                                    <?=$model->owner_review_title?>
                                </div>
                                <div class="experience__content-callback-content-text">
                                    <?=$model->owner_review?>
                                </div>
                            </div>
                            <div class="experience__content-showhide">
                                <span>Читать далее</span>
                                <span>Скрыть</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                    if (count($model->srcGallery)): ?>
                        <?= $this->render("slider", ["model" => $model]) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="conclusion">
    <div class="conclusion__tabs">
        <div class="container">
            <div class="conclusion__tabs-in">
                <?php
                $isActive = true;
                foreach($aComponents as $i => $component):
                    ?>
                    <div class="conclusion__tab <?=$isActive?"active":""?>" data-tab="<?=$component?>">
                        <?=CarTrial::getComponentOptions()[$component]?>
                    </div>
                <?php
                    $isActive = false;
                endforeach;
                ?>
            </div>
        </div>
    </div>
    <div class="conclusion__content-tabs">
        <?php
        $isActive = true;
        foreach($aComponents as $i => $component):
            ?>
            <!-- вкладка <?=$component?> -->
            <?=$this->render('tab.php', [
            'component' => $component,
            'isActive' => $isActive,
            'carTrial' => array_pop($carTrialsGrouped[$component])
        ]);
            $isActive = false;
            ?>
        <?php
        endforeach;
        ?>
    </div>
    <div class="conclusion__nav">
        <div class="container">
            <div class="conclusion__nav-in">
                <a href="<?=Url::to(['/experience/car-trial'])?>" class="conclusion__nav-back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_83_1574)">
                            <path d="M5.59322 18L7.11864 16.7293L3.45763 12.5263L24 12.5263L24 10.5714L3.45763 10.5714L7.11864 6.27068L5.59322 5L-1.34337e-06 11.5489L5.59322 18Z" fill="currentColor"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_83_1574">
                                <rect width="24" height="24" fill="white" transform="translate(24 24) rotate(-180)"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <span>
                        Вернуться назад
                    </span>
                </a>
                <div class="conclusion__nav-socials">
                    <span>
                        Рекомендовать в социальных сетях
                    </span>
                    <div class="conclusion__nav-socials-list">
                        <a href="#" class="conclusion__nav-socials-list-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_135_5867)">
                                    <path d="M12.875 19C6.0625 19 2.1875 14.125 2 6H5.4375C5.5625 11.98 8.0625 14.45 10.0625 14.97V6H13.3125V11.135C15.25 10.94 17.3125 8.6 18.0625 6H21.3125C20.75 9.185 18.5 11.525 16.9375 12.5C18.5625 13.28 21.125 15.295 22.0625 19H18.5C17.75 16.53 15.8125 14.645 13.3125 14.385V19H12.875Z" fill="currentColor"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_135_5867">
                                        <rect width="20" height="13" fill="currentColor" transform="translate(2 6)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="#" class="conclusion__nav-socials-list-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_135_5871)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0184 16.0217C9.49111 15.913 8.07292 15.4782 6.87292 14.5C6.76383 14.3913 6.54565 14.2826 6.43656 14.1739C5.89111 13.6304 5.89111 13.0869 6.32747 12.5434C6.65474 12 7.30929 11.8913 7.85474 12.2174C7.96383 12.2174 8.07292 12.3261 8.18202 12.4348C10.4729 13.9565 13.5275 13.9565 15.7093 12.4348C15.9275 12.2174 16.1457 12.1087 16.4729 12.1087C17.0184 12 17.4547 12.2174 17.782 12.6521C18.1093 13.1956 18.1093 13.7391 17.6729 14.1739C17.0184 14.8261 16.2547 15.2608 15.4911 15.5869C14.7275 15.913 13.8547 16.0217 12.982 16.1304C13.0911 16.2391 13.2002 16.3478 13.2002 16.4565C14.4002 17.6521 15.4911 18.7391 16.6911 19.9348C17.1275 20.3695 17.1275 20.8043 16.9093 21.2391C16.6911 21.7826 16.1457 22.1087 15.6002 22C15.2729 22 15.0547 21.7826 14.8366 21.5652C13.9638 20.6956 13.0911 19.8261 12.2184 18.9565C12.0002 18.7391 11.8911 18.7391 11.6729 18.9565C10.8002 19.8261 9.92747 20.6956 9.05474 21.6739C8.61838 22.1087 8.18202 22.1087 7.74565 21.8913C7.2002 21.6739 6.98202 21.1304 6.98202 20.5869C6.98202 20.2608 7.2002 19.9348 7.41838 19.7174C8.50929 18.6304 9.70929 17.4348 10.8002 16.3478C10.8002 16.2391 10.9093 16.2391 11.0184 16.0217Z" fill="currentColor"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0006 12.1087C9.27333 12.1087 6.98242 9.82609 6.98242 7C6.98242 4.28261 9.27333 2 12.0006 2C14.837 2 17.0188 4.28261 17.0188 7.1087C17.1279 9.93478 14.837 12.1087 12.0006 12.1087ZM14.5097 7C14.5097 5.58696 13.4188 4.5 12.0006 4.5C10.5824 4.5 9.49151 5.58696 9.49151 7C9.49151 8.41304 10.5824 9.5 12.0006 9.5C13.4188 9.5 14.5097 8.41304 14.5097 7Z" fill="currentColor"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_135_5871">
                                        <rect width="12" height="20" fill="white" transform="translate(6 2)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                        <a href="#" class="conclusion__nav-socials-list-item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.24543 10.9623L15.1787 6.18953C16.4055 5.64717 20.3089 4.12856 20.3089 4.12856C20.3089 4.12856 22.2048 3.47773 21.9818 5.10481C21.9818 5.75564 21.5357 8.2505 21.0896 10.8538L19.7512 18.6638C19.7512 18.6638 19.6397 19.857 18.7475 19.9655C17.8553 20.1824 16.4055 19.3146 16.1824 19.0977C15.9594 18.9892 12.279 16.7113 11.0522 15.6266C10.7177 15.3012 10.2716 14.7588 11.0522 13.9995C12.9482 12.3724 15.0672 10.3115 16.4055 9.0098C17.0746 8.35897 17.6323 7.0573 15.0672 8.68438L8.04104 13.4572C8.04104 13.4572 7.26035 13.9995 5.69899 13.4572C4.13763 12.9148 2.35322 12.3724 2.35322 12.3724C2.35322 12.3724 1.12644 11.7216 3.24543 10.9623Z" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tests__slider">
    <div class="container">
        <div class="tests__slider-in">
            <div class="tests__slider-headline">
                <h1 class="page-title">
                    Другие испытания
                </h1>
                <div class="swiper-navigation">
                    <div class="swiper-navigation__arrows">
                        <div class="swiper-navigation__arrows-prev">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_83_1574)">
                                    <path d="M5.59322 18L7.11864 16.7293L3.45763 12.5263L24 12.5263L24 10.5714L3.45763 10.5714L7.11864 6.27068L5.59322 5L-1.34337e-06 11.5489L5.59322 18Z" fill="currentColor"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_83_1574">
                                        <rect width="24" height="24" fill="white" transform="translate(24 24) rotate(-180)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="swiper-navigation__arrows-next">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.4068 6L16.8814 7.27068L20.5424 11.4737H0V13.4286H20.5424L16.8814 17.7293L18.4068 19L24 12.4511L18.4068 6Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper tests__slider-swiper">
                <div id="ajaxContainer" class="swiper-wrapper" data-test-id="<?=$model->id?>">
                </div>
            </div>
            <div class="swiper-pagination tests__slider-pagination"></div>
        </div>
    </div>
</div>
