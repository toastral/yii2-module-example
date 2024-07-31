<?php

use app\modules\experience\models\CarTest;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\experience\models\CarTestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Car Test');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Create'), ['create'],[
            'class' => 'btn btn-success'
            ]) ?>
        </p>
    </div>

    <div class="card-content">

                            <?= GridView::widget([
            'tableOptions' => ['class' => 'table'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\SerialColumn'],
                        'id',
            'name',
            [
                'label' => 'Марка',
                'attribute' => 'brandName',
                'value' => 'carBrand.name',
            ],
            [
                'label' => 'Модель',
                'attribute' => 'modelName',
                'value' => 'carModel.name',
            ],
            'generation',
             'year',
            [
                'attribute' => 'engine_type',
                'value' => function ($model) {
                    return $model->engine_type?carTest::getEngineTypeOptions()[$model->engine_type]:"-";
                },
                'filter' => CarTest::getEngineTypeOptions(),
            ],
             'region',
            ],
            ]); ?>

    </div>
</div>
