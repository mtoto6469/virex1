<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Exhibitionn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exhibitionn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_country')->dropDownList($country) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput()->label('آپلود عکس') ?>
    <?php
    if ($model->isNewRecord) {
        echo '<img  src="#" alt="your image" style="width: 550px">';
        echo '<br><br>';
    } else {

//        $img = \backend\models\Img::find()->where(['enable' => 1])->andWhere(['uses' => 'exhibition'])->all();
//        foreach ($img as $i) {
//            if ($i->address != 'void') {?>

        <div>
            <img src="<?= Yii::$app->request->hostInfo ?>/upload/images/<?= $model->image ?>"
                 style="width: 50px;height: 50px;">
        </div>
        <br><br>
        <?php
//            }
//        }
    }
    ?>

    <?= $form->field($model, 'holding_date')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'completion_date')->textInput(['maxlength' => true]) ?>


    <!--    <div class="col-lg-6">-->
    <!--        <div class="form-group field-tbltarget-datefa required ">-->
    <!--            <label class="control-label" for="tbltarget-datefa">    تاریخ این ماه </label>-->
    <!--            <input id="datepicker4" class="form-control" name="TblTarget[datefa]" maxlength="300" aria-required="true" aria-invalid="true" type="text" >-->
    <!--            <div class="hint-block">لطفا تاریخ  ماه جاری را وارد کنید</div>-->
    <!---->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="col-lg-6">-->
    <!---->
    <!--        <div class="form-group field-tbltarget-datefa required ">-->
    <!--            <label class="control-label" for="tbltarget-datefa"> تا  تاریخ </label>-->
    <!--            <input id="datepicker2" class="form-control" name="TblTarget[ta_date_farsi]" maxlength="300" aria-required="true" aria-invalid="true" type="text">-->
    <!--            <div class="hint-block">لطفا تاریخ اعتبار این تارگت را وارد کنید</div>-->
    <!---->
    <!--        </div>-->
    <!--    </div>-->

    <!--<div class="row">-->
    <!---->
    <!--    <div class="col-lg-6">-->
    <!--        <div class="form-group field-exhibitionn-holding_date required">-->
    <!--            <label class="control-label" for="exhibitionn-holding_date">تاریخ برگزاری</label>-->
    <!--            <input id="datepicker4" class="form-control" name="Exhibitionn[holding_date]" aria-required="true" type="text">-->
    <!---->
    <!--            <div class="help-block"></div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!---->
    <!--    <div class="col-lg-6">-->
    <!--        <div class="form-group field-exhibitionn-completion_date required">-->
    <!--            <label class="control-label" for="exhibitionn-completion_date">تاریخ پایان</label>-->
    <!--            <input id="datepicker2" class="form-control" name="Exhibitionn[completion_date]" aria-required="true" type="text">-->
    <!---->
    <!--            <div class="help-block"></div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


    <?= $form->field($model, 'holding_time')->textInput() ?>

    <?= $form->field($model, 'completion_time')->textInput() ?>

    <div class="form-group">

        <?= Html::submitButton('ذخیره', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $(function () {
        $("#exhibitionn-holding_date").persianDatepicker({});
    });
</script>