<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Myrules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="myrules-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'guide1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'guide2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rules')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'exhibitTariffs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'abouteUs')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
