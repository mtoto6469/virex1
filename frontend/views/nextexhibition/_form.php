<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Nextexhibition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nextexhibition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nextExhibition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enable')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
