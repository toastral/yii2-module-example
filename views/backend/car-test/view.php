<?php

use app\modules\experience\assets\backend\CarTestAsset;
use app\modules\experience\models\CarTest;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\experience\models\CarTest */


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Car Test'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

CarTestAsset::register($this);
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Update'), ['update', 'id' => $model->id], [
            'class' =>'btn btn-primary']) ?>
            <?= Html::a(Yii::t('system', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
            'confirm' => Yii::t('system', 'Are you sure you want to delete this item?'),
            'method' => 'post',
            ],
            ]) ?>
        </p>
    </div>

    <div class="card-content">

        <?= DetailView::widget([
        'options' => ['class' => 'table',

        ],
        'model' => $model,
        'attributes' => [
                    'id',
            'name',
            'car_brand_id',
            'car_model_id',
            'generation',
            'modification',
            'year',
            [
                'attribute' => 'engine_type',
                'value' => function ($model) {
                    $engineTypes = CarTest::getEngineTypeOptions();
                    return isset($engineTypes[$model->engine_type]) ? $engineTypes[$model->engine_type] : 'Не указано';
                },
            ],
            [
                'attribute' => 'gearbox',
                'value' => function ($model) {
                    $engineTypes = CarTest::getGearboxOptions();
                    return isset($engineTypes[$model->gearbox]) ? $engineTypes[$model->gearbox] : 'Не указано';
                },
            ],
            'engine_model',
            'mode',
            'region',
            'mileage',
            'features',
        ],
        ]) ?>

        <?= DetailView::widget([
            'options' => ['class' => 'table'],
            'model' => $model,
            'attributes' => [
                'owner_name',

                [
                    'attribute' => CarTest::ATTRIBUTE_SRC,
                    'value' => $model->getSrc() ? Html::img($model->getIcon(CarTest::ATTRIBUTE_SRC),
                        ['width' => 100]) : null,
                    'format' => 'raw',
                ],
                'owner_age',
                'owner_city',
                'owner_review_title',
                'owner_review:ntext',
                [
                    'attribute' => 'hidden',
                    'value' => $model->hidden ? "Да" : "Нет"
                ],
                [
                    'attribute' => CarTest::ATTRIBUTE_SRC_GALLERY,
                    'format' => 'raw',
                    'value' => function (CarTest $model) {
                        $images = $model->getFilePreview(CarTest::ATTRIBUTE_SRC_GALLERY, ['p' => 'car-crop-middle']);
                        if ($images) {
                            $result = [];
                            foreach ($images as $src) {
                                $result[] = Html::img($src, ['style' => 'padding: 3px']);
                            }

                            return implode('<br>', $result);
                        }

                        return null;
                    },
                ],
            ],
        ]) ?>

</div>
