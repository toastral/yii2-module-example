<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\modules\experience\models\CarModel */

use app\modules\experience\models\CarBrand;
use yii\helpers\ArrayHelper;

?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'car_brand_id')->dropDownList(
        ArrayHelper::map(CarBrand::find()->all(), 'id', 'name'),
        ['prompt' => 'Выберите марку']
    ) ?>

    <?= $form->field($model, 'start')->textInput() ?>

    <?= $form->field($model, 'end')->textInput() ?>

