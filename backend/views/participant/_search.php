<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ParticipantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="participant-search col-sm-10">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_country') ?>

    <?= $form->field($model, 'id_exhibitionn') ?>

    <?= $form->field($model, 'id_room') ?>

    <?= $form->field($model, 'id_company') ?>

    <?php // echo $form->field($model, 'id_activity') ?>

    <?php // echo $form->field($model, 'teaser') ?>

    <?php // echo $form->field($model, 'responsible_name') ?>

    <?php // echo $form->field($model, 'semat') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'site_address') ?>

    <?php // echo $form->field($model, 'telegram') ?>

    <?php // echo $form->field($model, 'instagram') ?>

    <?php // echo $form->field($model, 'shortdescription') ?>

    <?php // echo $form->field($model, 'dsescription') ?>

    <?php // echo $form->field($model, 'buy') ?>

    <?php // echo $form->field($model, 'enable') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
