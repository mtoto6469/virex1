<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Factor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_exhibition')->textInput() ?>

    <?= $form->field($model, 'id_room')->textInput() ?>

    <?= $form->field($model, 'id_company')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'date_ir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'time_ir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'atu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visible')->textInput() ?>

    <?= $form->field($model, 'print')->textInput() ?>

    <?= $form->field($model, 'enable')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
