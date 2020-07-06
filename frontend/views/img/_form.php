<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Img */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="img-form">

    <?php $form = ActiveForm::begin(); ?>

    <br>
    <p class="text-info">لطفا نام عکس ها را انگلیسی ذخیره کنید همچنین نام عکس با عکس مرتبط باشد . </p><br>


    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($modelup, 'imageFile')->fileInput() ?>
        <?php
    } else { ?>

        <!--        --><?//= $form->field($modelup, 'imageFile')->fileInput() ?>

        <div>
            <img src="<?= Yii::$app->request->hostInfo ?>/upload/images/<?= $model->title ?>"
            <img src="<?= Yii::$app->request->hostInfo ?>/upload/files/<?= $model->title ?>"
            <img src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $model->title ?>"
                 style="width: 50px;height: 50px;">
        </div>
        <?php
    } ?>

    <?= $form->field($modelup, 'imageFile1')->fileInput() ?>
    <?= $form->field($modelup, 'imageFile2')->fileInput() ?>

<!--    --><?//= $form->field($model, 'fileImg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
