<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Exhibitionn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exhibitionn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_country')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput()->label('آپلود عکس') ?>

    <?= $form->field($model, 'holding_date')->textInput() ?>

    <?= $form->field($model, 'holding_date_ir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'completion_date')->textInput() ?>

    <?= $form->field($model, 'completion_date_ir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'holding_time')->textInput() ?>

    <?= $form->field($model, 'completion_time')->textInput() ?>

    <?= $form->field($model, 'enable')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
