<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Exhibitionn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exhibitionn-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <?= $form->field($model, 'id_country')->dropDownList($country) ?>
            </div>

            <div class="col-lg-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>

        </div>
    </div>

    <?php
    if ($model->isNewRecord) {?>
        <?= $form->field($model, 'file')->fileInput()->label('آپلود عکس') ?>
       <?php
    } else { ?>
        <?= $form->field($model, 'file')->fileInput()->label(' آپلود عکس جدید') ?>
        <!--show image on database-->

            
            <?php $img=\backend\models\Img::find()->where(['enable'=>1])->andWhere(['id'=>$model->image])->one();
            if ($img){?>
                <div class="exhibitionImg">  <img src="<?= Yii::$app->request->hostInfo ?>/upload/images/<?= $img->fileImg ?>"
                     style="width: 100px;height: 100px;"> </div>
           <?php
            }else{}
            ?>



        <br><br>
        <?php
    }
    ?>

    <div class="row">
        <?php if ($model->isNewRecord) { ?>
            <div class="col-lg-6">
                <div class="form-group field-exhibitionn-holding_date required">
                    <label class="control-label" for="exhibitionn-holding_date">تاریخ برگزاری</label>
                    <input id="datepicker4" class="form-control" name="Exhibitionn[holding_date]" aria-required="true"
                           type="text" value="">

                    <div class="help-block"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group field-exhibitionn-completion_date required">
                    <label class="control-label" for="exhibitionn-completion_date">تاریخ پایان</label>
                    <input id="datepicker2" class="form-control" name="Exhibitionn[completion_date]"
                           aria-required="true"
                           type="text" value="">

                    <div class="help-block"></div>
                </div>
            </div>
            <?php
        } else { ?>

            <div class="col-lg-6">
                <div class="form-group field-exhibitionn-holding_date required">
                    <label class="control-label" for="exhibitionn-holding_date">تاریخ برگزاری</label>
                    <input id="datepicker4" class="form-control" name="Exhibitionn[holding_date]" aria-required="true"
                           type="text" value="<?= $model->holding_date ?>">

                    <div class="help-block"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group field-exhibitionn-completion_date required">
                    <label class="control-label" for="exhibitionn-completion_date">تاریخ پایان</label>
                    <input id="datepicker2" class="form-control" name="Exhibitionn[completion_date]"
                           aria-required="true"
                           type="text" value="<?= $model->completion_date; ?>">

                    <div class="help-block"></div>
                </div>
            </div>
            <?php
        } ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'ثبت') : Yii::t('app', 'ویرایش'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
