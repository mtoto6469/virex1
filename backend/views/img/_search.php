<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ImgSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="img-search col-sm-10">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'alt') ?>

    <?= $form->field($model, 'id_participant') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <div class="form-group">
        <?= Html::submitButton('جستجو', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
