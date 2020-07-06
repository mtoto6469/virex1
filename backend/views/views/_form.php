<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Views */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="views-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_participant')->textInput() ?>

    <?= $form->field($model, 'visits')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
