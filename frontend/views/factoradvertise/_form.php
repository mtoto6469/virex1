<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Factoradvertise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factoradvertise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'volume')->textInput() ?>

    <?= $form->field($model, 'advertise')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>
    
    <?= $form->field($model, 'id_participant')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'atu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visible')->textInput() ?>

    <?= $form->field($model, 'print')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'date_ir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'confirm')->textInput() ?>

    <?= $form->field($model, 'endPrice')->textInput() ?>

    <?= $form->field($model, 'addressOfCentralOffice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'factoryAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enable')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
