<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\export\widgets\ExportFilesWidget;
use app\modules\export\widgets\ExportWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\experience\models\CarModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Car Model');
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
        <p>
            <?= ExportWidget::widget([
                'format' => [ExportWidget::FORMAT_XLS, ExportWidget::FORMAT_XLSX],
                'buttonLabel' => 'Экспорт',
                'downloadUrl' => 'export',
                'hint' => 'Внимание! Данные в выгрузке будут сформированы <br> с учетом выставленных в списке фильтров.',
            ]) ?>
        </p>
    </div>
    <?= ExportFilesWidget::widget([
        'storage' => Yii::getAlias("@runtime/client-export"),
        'getFileUrl' => Url::to(['get-export-files'])
    ]) ?>

    <div class="card-content">

                            <?= GridView::widget([
            'tableOptions' => ['class' => 'table'],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],
            'id',
            'name',
            [
                'attribute' => 'brandName',
                'label' => 'Марка авто',
                'value' => 'carBrand.name',
            ],
            ],
            ]); ?>

    </div>
</div>
