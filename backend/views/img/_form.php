<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Img */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="img-form">

    <?php $form = ActiveForm::begin(); ?>

    <br>
    <p class="text-info">لطفا نام عکس ها را انگلیسی ذخیره کنید همچنین نام عکس با عکس مرتبط باشد . </p><br>


    <?php if ($model->isNewRecord) { ?>
        <?= $form->field($modelup, 'imageFile')->fileInput()->label('عکس') ?>
        <?= $form->field($modelup, 'imageFile1')->fileInput()->label('فایل pdf') ?>
        <?= $form->field($modelup, 'imageFile2')->fileInput()->label('فیلم') ?>
        <?php
    } else { ?>





        <div class="imgView">
            <div class="view">
                <?= $form->field($modelup, 'imageFile')->fileInput()->label('عکس') ?>
                <img src="<?= Yii::$app->request->hostInfo ?>/upload/images/<?= $model->fileImg ?>" style="width: 300px;height: 100px;" name="<?= $model->fileImg ?>">
            </div>
            <br>
            <div class="view">
                <?= $form->field($modelup, 'imageFile2')->fileInput()->label('فیلم') ?>
                <?php if ($model->fileMove == 'void'){}else{?>
                    <video  width="300" height="100" poster="" controls >
                        <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $model->fileMove ?>" type="video/mp4" title="<?= $model->fileMove ?>">
                        <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $model->fileMove ?>" type="video/gif" title="<?= $model->fileMove ?>">
                        <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $model->fileImg ?>" type="video/mp4" title="<?= $model->fileMove ?>">
                        <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $model->fileImg ?>" type="video/gif" title="<?= $model->fileMove ?>">
                        <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $model->filePdf ?>" type="video/mp4" title="<?= $model->fileMove ?>">
                        <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $model->filePdf ?>" type="video/gif" title="<?= $model->fileMove ?>">
                    </video>
                 <?php
                } ?>

            </div>
            <br>
            <div class="view">
                <?= $form->field($modelup, 'imageFile1')->fileInput()->label('فایل pdf') ?>
                <?php if ($model->filePdf == 'void'){

                } else{?>
                <a href="<?= Yii::$app->request->hostInfo ?>/upload/files/<?= $model->filePdf ?>"><?= $model->filePdf ?></a>
                <?php
                }?>

            </div>
          
            
          
           
        </div>

        <?php
    } ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
