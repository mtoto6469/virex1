<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MyrulesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="myrules-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'phone1') ?>

    <?= $form->field($model, 'phone2') ?>

    <?= $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'mobile1') ?>

    <?php // echo $form->field($model, 'mobile2') ?>

    <?php // echo $form->field($model, 'guide1') ?>

    <?php // echo $form->field($model, 'guide2') ?>

    <?php // echo $form->field($model, 'rules') ?>

    <?php // echo $form->field($model, 'exhibitTariffs') ?>

    <?php // echo $form->field($model, 'abouteUs') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
