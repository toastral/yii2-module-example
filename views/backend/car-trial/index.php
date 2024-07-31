<?php

use app\modules\experience\models\CarTrial;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\experience\models\CarTrialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Car Trial');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Create'), ['create'], [
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
                'id',
                [
                    'attribute' => 'productName',
                    'value' => 'productRelation.title',
                ],
                [
                    'attribute' => 'carTestName',
                    'value' => 'carTestRelation.name',
                ],
                [
                    'attribute' => 'component',
                    'value' => function ($model) {
                        return CarTrial::getComponentOptions()[$model->component];
                    },
                    'filter' => CarTrial::getComponentOptions(),
                ],
                'componentName',
            ],
        ]); ?>

    </div>
</div>
