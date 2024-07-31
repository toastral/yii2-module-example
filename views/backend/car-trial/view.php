<?php

use app\modules\experience\models\CarTrial;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\experience\models\CarTrial */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Car Trial'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-header">
        <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
    </div>

    <div class="card-header">
        <p>
            <?= Html::a(Yii::t('system', 'Update'), ['update', 'id' => $model->id], [
                'class' => 'btn btn-primary']) ?>
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
            'options' => ['class' => 'table'],
            'model' => $model,
            'attributes' => [
                'id',
                'productId',
                [
                    'attribute' => 'carTestId',
                    'value' => $model->carTestRelation->name,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'component',
                    'value' => function ($model) {
                        $componentNames = CarTrial::getComponentOptions();
                        return $componentNames[$model->component];
                    },
                ],
                'componentName',
                'operatingTime:ntext',
                'engineProtection:ntext',
                [
                    'attribute' => CarTrial::ATTRIBUTE_SRC_1,
                    'value' => $model->src1 ? Html::img($model->getPreviewSrc1Url(),
                        ['width' => 400]) : null,
                    'format' => 'raw',
                ],
                'metalPropertiesStock:ntext',
                [
                    'attribute' => CarTrial::ATTRIBUTE_SRC_2,
                    'value' => $model->src2 ? Html::img($model->getPreviewSrc2Url(),
                        ['width' => 400]) : null,
                    'format' => 'raw',
                ],
                [
                    'attribute' => 'hidden',
                    'value' => $model->hidden ? "Да" : "Нет"
                ],
                [
                    'attribute' => 'srcGallery',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $files = $model->getFilesData('srcGallery');
                        if ($files) {
                            $result = [];

                            foreach ($files as $data) {
                                $result[] = Html::a($data['title'], $data['src'], ['class' => '', 'download' => '']);
                            }
                            return Html::ul($result, ['encode' => false]);
                        }
                        return 'Нет файла';
                    },
                ],
            ],
        ]) ?>
</div>
