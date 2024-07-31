<?php

use app\modules\experience\assets\frontend\CarTrialAsset;
use app\modules\experience\models\CarTrialSelect;
use yii\helpers\Url;

$this->title = "Опыт эксплуатации";
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Car Trial'), 'url' => ['index']];

CarTrialAsset::register($this);
?>

<!-- первая страница с испытаниями -->
<div class="base-page contact__page tests">
    <div class="container">
        <?= $this->render('//parts/common/breadcrumbs'); ?>
        <div class="tests__in">
            <div class="tests__headline">
                <h1 class="tests__title page-title">
                    Список испытаний
                </h1>
                <div class="tests__tabs">
                    <div class="tests__tab active" data-tab="1">
                        поиск по продукту
                    </div>
                    <div class="tests__tab" data-tab="2">
                        Марке/Модели<span>&nbsp;автомобиля</span>
                    </div>
                </div>
            </div>
            <div class="tests__search">
                <div class="tests__search-tabs">
                    <!-- блок tests__search-tab можно сделать form если нужно -->
                    <div class="tests__search-tab active" data-tab="1">
                        <div class="tests__search-tab-headline">
                            <div class="tests__search-tab-title">
                                Поиск испытаний
                            </div>
                        </div>
                        <div class="tests__search-tab-content">
                            <div class="tests__search-tab-content-item">
                                <select id="specificationSelect" class="tests__search-tab-content-select" name="productSpecification" data-placeholder="Тип продукта">'
                                <option value=""></option>';
                                <?php
                                $specificationOptions = CarTrialSelect::getProductSpecificationsOptions();
                                foreach ($specificationOptions as $specification):
                                ?>
                                    <option value="<?=htmlspecialchars($specification['id'])?>"><?=htmlspecialchars($specification['title'])?></option>
                                <?php
                                endforeach;
                                ?>
                                </select>
                                <div class="tests__search-tab-content-parent">
                                </div>
                            </div>
                            <div class="tests__search-tab-content-item">
                                <select id="productSelect" class="tests__search-tab-content-select" name="product" data-placeholder="Выберите продукт">
                                    <option></option>
                                    <?php
                                        $productOptions = CarTrialSelect::getProductOptions();
                                    ?>
                                    <?php foreach ($productOptions as $id => $title): ?>
                                        <option value="<?=$id?>"><?= htmlspecialchars($title) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="tests__search-tab-content-parent">

                                </div>
                            </div>
                        </div>
                        <div class="tests__search-tab-footer">
                            <div class="tests__search-tab-footer-writeus">
                                <span>Не нашли испытания для своего авто?</span>
                                <a href="<?=Url::to(['/feedback'])?>">Напишите нам</a>
                            </div>
                            <a id="searchButton1" href="#" class="tests__search-tab-show btn--prime btn--round">
                                Показать
                            </a>
                        </div>
                        <div class="tests__search-tab-clear clearFilter">
                            <span>Очистить фильтр</span>
                        </div>
                    </div>
                    <!-- блок tests__search-tab можно сделать form если нужно -->
                    <div class="tests__search-tab" data-tab="2">
                        <div class="tests__search-tab-headline">
                            <div class="tests__search-tab-title">
                                Поиск испытаний (Вкладка 2)
                            </div>
                        </div>
                        <div class="tests__search-tab-content">
                            <div class="tests__search-tab-content-item">
                                <?php
                                $carBrandOptions = CarTrialSelect::getCarBrandOptions();
                                ?>
                                <select id="carBrandSelect" class="tests__search-tab-content-select" name="carModel" data-placeholder="Марка">
                                    <option></option>
                                    <?php foreach ($carBrandOptions as $id => $name): ?>
                                        <option value="<?= $id ?>"><?= htmlspecialchars($name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="tests__search-tab-content-parent">
                                </div>
                            </div>
                            <div class="tests__search-tab-content-item">
                                <select id="carModelSelect" class="tests__search-tab-content-select" name="state" data-placeholder="Модель">
                                    <option></option>
                                </select>
                                <div class="tests__search-tab-content-parent">
                                </div>
                            </div>
                        </div>
                        <div class="tests__search-tab-footer">
                            <div class="tests__search-tab-footer-writeus">
                                <span>Не нашли испытания для своего авто?</span>
                                <a href="<?=Url::to(['/feedback'])?>">Напишите нам</a>
                            </div>
                            <a id="searchButton2" href="#" class="tests__search-tab-show btn--prime btn--round">
                                Показать
                            </a>
                        </div>
                        <div class="tests__search-tab-clear clearFilter">
                            <span>Очистить фильтр</span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ajaxContainer" class="tests__list">
            </div>

            <div class="tests__loadmore">
                <a id="nextButton" href="#" data-page="1"
                   data-type-search="0"
                   data-specification-id="0"
                   data-product-id="0"
                   data-model-id="0"
                   data-brand-id="0"
                   class="next-button tests__loadmore-btn"
                   style="display: none;"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 4.4C7.3 2.9 9.6 2 12 2C17.5 2 22 6.5 22 12C22 14.1 21.3 16.1 20.2 17.7L17 12H20C20 7.6 16.4 4 12 4C9.9 4 7.9 4.8 6.5 6.2L5.5 4.4ZM18.5 19.6C16.7 21.1 14.4 22 12 22C6.5 22 2 17.5 2 12C2 9.9 2.7 7.9 3.8 6.3L7 12H4C4 16.4 7.6 20 12 20C14.1 20 16.1 19.2 17.5 17.8L18.5 19.6Z" fill="currentColor"/>
                    </svg>
                    <span>Загрузить еще</span>
                </a>
            </div>
        </div>
    </div>
</div>




