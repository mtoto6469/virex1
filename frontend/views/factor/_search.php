<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FactorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_exhibition') ?>

    <?= $form->field($model, 'id_room') ?>

    <?= $form->field($model, 'id_company') ?>

    <?= $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_participant') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'id_advertise') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'date_ir') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'time_ir') ?>

    <?php // echo $form->field($model, 'atu') ?>

    <?php // echo $form->field($model, 'ref') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'print') ?>

    <?php // echo $form->field($model, 'endPrice') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <?php // echo $form->field($model, 'buyAdvertise') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
