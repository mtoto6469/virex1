<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ExhibitionnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exhibitionn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_country') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'holding_date') ?>

    <?php // echo $form->field($model, 'holding_date_ir') ?>

    <?php // echo $form->field($model, 'completion_date') ?>

    <?php // echo $form->field($model, 'completion_date_ir') ?>

    <?php // echo $form->field($model, 'holding_time') ?>

    <?php // echo $form->field($model, 'completion_time') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
