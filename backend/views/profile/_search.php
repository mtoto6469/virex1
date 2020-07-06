<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search col-lg-10">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'id') ?>

    <?= $form->field($model, 'role') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'telephone') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'company_name_en') ?>

    <?php // echo $form->field($model, 'company_name_ir') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'date_ir') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <?php // echo $form->field($model, 'date_update_ir') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'id_img') ?>

    <?php // echo $form->field($model, 'rules') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
