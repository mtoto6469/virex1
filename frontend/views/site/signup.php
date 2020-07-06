<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$session=Yii::$app->session;
if(!$session->isActive){
    $session->open();
}else{}
if(isset($_SESSION['error'])){
    if ($_SESSION['error']!=null){
        echo'<div class="alert alert-danger">'. $_SESSION['error'].'</div>';
    }$_SESSION['error']=null;
}


$this->title = 'ثبت نام ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup index1">


    <p></p>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 login_bac">
            <h1 class="Mysignup"><?= Html::encode($this->title) ?></h1>
            <div class="user_signup">
                <div class="user_signup_left"></div>
                <div class="user_signup_right">

                    <?php if ($role != 'user') { ?>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                        <p>شرکت کننده ها</p>
                        <?= $form->field($model, 'role')->hiddenInput(['value'=>'booth'])->label('') ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('ایمیل - نام کاربری') ?>

                        <?= $form->field($model, 'company_name_en')->textInput(['maxlength' => true])->label('نام شرکت(انگلیسی)') ?>

                        <?= $form->field($model, 'company_name_ir')->textInput(['maxlength' => true])->label('نام شرکت (فارسی)') ?>
<!--                        <div class="form-group field-signupform-company_name_ir required">-->
<!--                            <label class="control-label" for="signupform-company_name_ir">نام شرکت (فارسی)</label>-->
<!--                            <input id="signupform-company_name_ir" class="form-control " onkeypress="country(vvv)" name="SignupForm[company_name_ir]" value="" aria-required="true" type="text">-->
<!---->
<!--                            <p class="help-block help-block-error"></p>-->
<!--                        </div>-->

                        <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label(' تلفن ') ?>

                        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true])->label('موبایل') ?>

                        <?= $form->field($model, 'password')->passwordInput()->label('رمز ورود') ?>

                        <?= $form->field($model, 'rules')->checkbox()->label('') ?>
                        <a href="#">قوانین و مقررات</a><p class="rules1"> سایت ویرکس را مطالعه نموده و با کلیه موارد آن موافقم.</p>

                        <div class="form-group">
                            <?= Html::submitButton('ثبت', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                        
                    <?php } elseif ($role == 'user') { ?>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <p>بازدید کننده ها</p>
                        <?= $form->field($model, 'company_name_en')->hiddenInput(['value' => 'void'])->label('') ?>

                        <?= $form->field($model, 'company_name_ir')->hiddenInput(['value' => 'void']) ->label('')?>


                        <?= $form->field($model, 'role')->hiddenInput(['value'=>'user'])->label('') ?>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('ایمیل - نام کاربری') ?>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(' نام و نام خانوادگی ') ?>

                        <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label(' تلفن ') ?>

                        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true])->label(' موبایل ') ?>

                        <!--            --><? //= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'password')->passwordInput()->label('رمز ورود') ?>

                        <?= $form->field($model, 'rules')->checkbox()->label('') ?>
                       <a href="#">قوانین و مقررات</a><p class="rules1"> سایت ویوکس را مطالعه نموده و با کلیه موارد آن موافقم.</p>

                        <div class="form-group">
                            <?= Html::submitButton('ثبت', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

//    $('#signupform-company_name_ir').bind('click', function(event){
//
//        if(event.ctrlKey) {
//            if (event.ctrlLeft) {
//                console.log('ctrl-left');
//            }
//            else {
//                console.log('ctrl-right');
//            }
//        }
//        if(event.altKey) {
//            if (event.altLeft) {
//                console.log('alt-left');
//            }
//            else {
//                console.log('alt-right');
//            }
//        }
//        if(event.shiftKey) {
//            if (event.shiftLeft) {
//                console.log('shift-left');
//            }
//            else
//            {
//                console.log('shift-right');
//            }
//        }
//    });
//



    //    function country(event) {
//var p=/@"^([\u0600-\u06FF]+\s?)+$"/;
//        var x=/^[پچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژؤإأءًٌٍَُِّ\s]+$/;
//        if (!vvv.match(x))
//            alert('ggggg')







//        $('#signupform-company_name_ir').keypress(function(event){
////            if($p.test(str)){
////                alert('not');
////            }
////        }
//
//            var keycode = (event.keyCode ? event.keyCode : event.which);
//            if(keycode == '/^[\u0600-\u06FF\s]+s/'){
//                alert('You pressed a "enter" key in textbox');
//            }
//            event.stopPropagation();
//        });
//
//        $(document).keypress(function(event){
//
//            var keycode = (event.keyCode ? event.keyCode : event.which);
//            if(keycode == [\u0600-\u0605 ؐ-ؚ\u061Cـ ۖ-\u06DD ۟-ۤ ۧ ۨ ۪-ۭ ً-ٕ ٟ ٖ-ٞ ٰ ، ؍ ٫ ٬ ؛ ؞ ؟ ۔ ٭ ٪ ؉ ؊ ؈ ؎ ؏
//            ۞ ۩ ؆ ؇ ؋ ٠۰ ١۱ ٢۲ ٣۳ ٤۴ ٥۵ ٦۶ ٧۷ ٨۸ ٩۹ ءٴ۽ آ أ ٲ ٱ ؤ إ ٳ ئ ا ٵ ٮ ب ٻ پ ڀ
//            ة-ث ٹ ٺ ټ ٽ ٿ ج ڃ ڄ چ ڿ ڇ ح خ ځ ڂ څ د ذ ڈ-ڐ ۮ ر ز ڑ-ڙ ۯ س ش ښ-ڜ ۺ ص ض ڝ ڞ
//            ۻ ط ظ ڟ ع غ ڠ ۼ ف ڡ-ڦ ٯ ق ڧ ڨ ك ک-ڴ ػ ؼ ل ڵ-ڸ م۾ ن ں-ڽ ڹ ه ھ ہ-ۃ ۿ ەۀ وۥ ٶ
//            ۄ-ۇ ٷ ۈ-ۋ ۏ ى يۦ ٸ ی-ێ ې ۑ ؽ-ؿ ؠ ے ۓ \u061D]){
//                alert('You pressed a "enter" key in somewhere');
//            }
//
//        });


 //  }

//    $(function(){
//        $(".justpersian").bind('input propertychange',function(){
//            if(!/^[پچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژؤإأءًٌٍَُِّ\s\n\r\t\d\(\)\[\]\{\}.,،;\-؛]+$/.test($(this).val())){
//                alert("فقط حروف فارسی مورد قبول است");
//                $(this).val("");
//            }
//        });
//    });
</script>