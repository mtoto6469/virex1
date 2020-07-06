<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm1 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'ثبت نام بازدید کننده ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup1">
    

    <p></p>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 login_bac">
            <h1 class="Mysignup"><?= Html::encode($this->title) ?></h1>
            <div class="user_signup">
                <div class="user_signup_left"></div>
                <div class="user_signup_right">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('ایمیل - نام کاربری') ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(' نام و نام خانوادگی ') ?>

                    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label(' تلفن ') ?>

                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ->label(' موبایل ')?>

                    <!--            --><? //= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput()->label('رمز ورود') ?>

                    <div class="col-md-12 col-sm-12 form-group">
                        <div class="col-md-12 col-sm-12 text-center">
                            <input id="chk-rules" name="chk-rules" type="checkbox"><span class="fontlg">
                        <a href="#" target="_blank">قوانین و مقررات</a> سایت ویوکس را مطالعه نموده و با کلیه موارد آن موافقم.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('ثبت', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
