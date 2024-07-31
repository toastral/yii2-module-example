<?php

use app\components\helpers\KartikFileInputHelper;
use app\modules\experience\assets\backend\CarTrialAsset;
use app\modules\experience\models\CarTest;
use app\modules\experience\models\CarTrial;
use app\modules\product\models\Product;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\experience\models\CarTrial */
CarTrialAsset::register($this);
?>

<?= $form->field($model, 'productId')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Product::find()->active()->all(), 'id', 'title'),
    'options' => ['placeholder' => 'Выберите продукт', 'id' => 'productId'],
    'pluginOptions' => [
        'allowClear' => true
    ],]);
?>

<?= $form->field($model, 'carTestId')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CarTest::find()->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Выберите автомобиль', 'id' => 'carTestId'],
    'pluginOptions' => [
        'allowClear' => true
    ],]);
?>

<?= $form->field($model, 'component')->dropDownList(CarTrial::getComponentOptions(), ['prompt' => 'Выберите узел']) ?>

<?= $form->field($model, 'componentName')->textInput() ?>

<?= $form->field($model, 'operatingTime')->textInput() ?>
<hr>
<h2>Заключение</h2>
<h3>Защита двигателя</h3>
<?= $form->field($model, 'engineProtection')->textarea(['rows' => 6])->label(false) ?>
<?php
if ($image = $model->getPreviewSrc1Url()): ?>
    <div class="form-group">
        <?= Html::a(Html::img($image, ['title' => Html::encode($model->getSrc1()->getTitle())]) .
            '<span class="close-icon">&times;&nbsp;</span>',
            Url::to(['delete-image', 'id' => $model->id, 'attribute' => CarTrial::ATTRIBUTE_SRC_1]),
            [
                'class' => 'previewImg',
                'data' => [
                    'confirm' => Yii::t('system', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]
        ); ?>
    </div>
<?php
endif; ?>
<?= $form->field($model, CarTrial::ATTRIBUTE_SRC_1)->fileInput(['accept' => 'image/*']) ?>


<h3>Запас свойств металла</h3>
<?= $form->field($model, 'metalPropertiesStock')->textarea(['rows' => 6])->label(false) ?>
<?php
if ($image = $model->getPreviewSrc2Url()): ?>
    <div class="form-group">
        <?= Html::a(Html::img($image, []) .
            '<span class="close-icon">&times;&nbsp;</span>',
            Url::to(['delete-image', 'id' => $model->id, 'attribute' => CarTrial::ATTRIBUTE_SRC_2]),
            [
                'class' => 'previewImg',
                'data' => [
                    'confirm' => Yii::t('system', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]
        ); ?>
    </div>
<?php
endif; ?>
<?= $form->field($model, CarTrial::ATTRIBUTE_SRC_2)->fileInput(['accept' => 'image/*']) ?>
<hr>


<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>

<?= $form->field($model, 'docGallery[]')->widget(FileInput::class, [
    'language' => 'ru',
    'options' => [
        'multiple' => true,
        'accept' => 'application/pdf',
        'value' => '',
    ],
    'pluginOptions' => ArrayHelper::merge(KartikFileInputHelper::filePluginOptions(), [
        'initialPreview' => $model->getFileDownload(CarTrial::ATTRIBUTE_DOC_GALLERY),
        'initialPreviewConfig' => $model->getFilePreviewConfig(CarTrial::ATTRIBUTE_DOC_GALLERY),
        'initialPreviewDownloadUrl' => $model->getFileDownload(CarTrial::ATTRIBUTE_DOC_GALLERY),
        'allowedFileExtensions' => ['pdf'],
        'maxFileCount' => 100,
        'preferIconicPreview' => true, // this will force thumbnails to display icons for following file extensions
        'previewFileIcon' => '<i class="fa fa-file-text-o" aria-hidden="true"></i>',
        'previewFileIconSettings' => [ // configure your icon file extensions
        'pdf' => '<i class="fa fa-file-pdf-o " aria-hidden="true"></i>',
        'PDF' => '<i class="fa fa-file-pdf-o " aria-hidden="true"></i>',
        ],
    ])
]);
    ?>

