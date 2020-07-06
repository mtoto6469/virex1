<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FactoradvertiseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factoradvertise-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'volume') ?>

    <?= $form->field($model, 'advertise') ?>

    <?= $form->field($model, 'id_participant') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'atu') ?>

    <?php // echo $form->field($model, 'ref') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'print') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'date_ir') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'confirm') ?>

    <?php // echo $form->field($model, 'endPrice') ?>

    <?php // echo $form->field($model, 'addressOfCentralOffice') ?>

    <?php // echo $form->field($model, 'factoryAddress') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
