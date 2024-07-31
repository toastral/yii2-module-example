<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\experience\models\CarTest */


use app\components\helpers\KartikFileInputHelper;
use app\modules\experience\models\CarBrand;
use app\modules\experience\models\CarTest;
use kartik\select2\Select2;
use krok\editor\EditorWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

use app\modules\experience\assets\backend\CarTestAsset;
CarTestAsset::register($this);
?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'car_brand_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CarBrand::find()->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Выберите марку', 'id' => 'car_brand_id'],
    'pluginOptions' => [
        'allowClear' => true
    ],]);
?>

<?= $form->field($model, 'car_model_id')->widget(Select2::classname(), [
    'data' => [],
    'options' => [
        'placeholder' => 'Выберите модель',
        'id' => 'car_model_id'
    ],
]);
?>

    <?= $form->field($model, 'generation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'engine_type')->dropDownList(CarTest::getEngineTypeOptions(), ['prompt' => 'Выберите тип двигателя']) ?>

    <?= $form->field($model, 'gearbox')->dropDownList(CarTest::getGearboxOptions(), ['prompt' => 'Выберите тип КПП']) ?>

    <?= $form->field($model, 'engine_model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mileage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'features')->widget(EditorWidget::class, [
        'clientOptions' =>  ['height' => 200],
    ]) ?>
<hr>

<div id="kartik">
<?= $form->field($model, 'srcGallery[]')
    ->hint('Изображения должно быть в формате jpg и иметь размер 1200х700px')
    ->widget(\kartik\file\FileInput::class, [
    'language' => 'ru',
    'options' => [
        'multiple' => true,
        'accept' => 'image/*',
        'value' => '',
    ],
    'pluginOptions' => ArrayHelper::merge(
        KartikFileInputHelper::imagePluginOptions(),
        [
            'initialPreview' => $model->getFilePreview(CarTest::ATTRIBUTE_SRC_GALLERY, ['p' => 'backend']),
            'initialPreviewConfig' => $model->getFilePreviewConfig(CarTest::ATTRIBUTE_SRC_GALLERY),
            'msgFileRequired' => 'Необходимо загрузить файл',
            'allowedFileExtensions' => CarTest::EXTENSIONS,
            'maxFileCount' => 100,
            'overwriteInitial' => false,
        ]),

]); ?>
</div>


<hr>

<h3>Данные владельца</h3>

    <?= $form->field($model, 'owner_name')->textInput(['maxlength' => true]) ?>

<?php

if ($image = $model->getPreview()): ?>
    <div class="form-group">
        <?= Html::a(
            Html::img($image) .
            '<span class="close-icon">&times;&nbsp;</span>',
            Url::to(['delete-image', 'id' => $model->id, 'attribute' => CarTest::ATTRIBUTE_SRC]),
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
endif;

?>

    <?= $form->field($model, CarTest::ATTRIBUTE_SRC)->fileInput(['accept' => 'image/*']) ?>

    <?= $form->field($model, 'owner_age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner_review_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner_review')->textarea(['rows' => 6]) ?>

<hr>

<?= $form->field($model, 'hidden')->dropDownList($model::getHiddenList()) ?>

<?= Html::hiddenInput('getModelUrl', Url::to(['/experience/car-model/get-models']), ['id' => 'get-model-url']); ?>





