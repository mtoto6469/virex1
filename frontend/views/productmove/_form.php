<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Productmove */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productmove-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_product')->textInput() ?>

    <?= $form->field($model, 'move1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'move2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'move3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'move4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enable')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
