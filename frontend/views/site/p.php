<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'ثبت نام شرکت کننده ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">


    <p></p>

    <div class="row">
        <div class="col-md-8 col-md-offset-2 login_bac">
            <h1 class="Mysignup"><?= Html::encode($this->title) ?></h1>
            <div class="user_signup">
                <div class="user_signup_left"></div>
                <div class="user_signup_right">

<!--                    --><?php //if ($role != 'user') { ?>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <?= $form->field($model, 'role')->hiddenInput(['value'=>'booth'])->label('') ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('ایمیل - نام کاربری') ?>

                        <?= $form->field($model, 'company_name_en')->textInput(['maxlength' => true])->label('نام شرکت(انگلیسی)') ?>

                        <?= $form->field($model, 'company_name_ir')->textInput(['maxlength' => true])->label('نام شرکت (فارسی)') ?>

                        <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label(' تلفن ') ?>

                        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true])->label('موبایل') ?>

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

<!--                    --><?php //} elseif ($role == 'user') { ?>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


                        <?= $form->field($model, 'role')->hiddenInput(['value'=>'user'])->label('') ?>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('ایمیل - نام کاربری') ?>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(' نام و نام خانوادگی ') ?>

                        <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label(' تلفن ') ?>

                        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true])->label(' موبایل ') ?>

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
                        <?php
//                    }

                    ?>




                </div>
            </div>
        </div>
    </div>
</div>







//layout

<?php $profile = \frontend\models\Profile::find()->where(['role' => 'booth'])->andWhere(['id_user' => $user->id])->all();
if ($profile != null || $profile != 0) {
foreach ($profile as $p) {

    //چک کردن اینکه اولین باره محصول میزاره یا نه
//                                    if ($p->first == 1) {
//                                        ?>
    <!---->
    <!--                                        <li><a href="--><?//= $url->createAbsoluteUrl(['category/menu']) ?><!--">ثبت محصول-->
    <!--                                                جهت-->
    <!--                                                تبلیغ</a></li>-->
    <!--                                        <li><a href="--><?//= $url->createAbsoluteUrl(['participant/create']) ?><!--">ثبت-->
    <!--                                                غرفه</a></li>-->
    <!--                                        <li><a href="--><?//= $url->createAbsoluteUrl(['participant/create']) ?><!--">راهنما</a>-->
    <!--                                        </li>-->
    <!--                                        <li><a href="--><?//= $url->createAbsoluteUrl(['img/create']) ?><!--">آاذلالالالالا</a></li>-->
    <!--                                        <li><a href="--><?//= $url->createAbsoluteUrl(['']) ?><!--">اطلاعات من</a></li>-->
    <!--                                        <li><a href="--><?//= $url->createAbsoluteUrl(['']) ?><!--">دعوت از دوستان</a></li>-->
    <!--                                        <li><a href="--><?//= $url->createAbsoluteUrl(['']) ?><!--">تغییر رمز</a></li>-->
    <!--                                        <li><a class=""-->
    <!--                                               href="--><?//= $url->createAbsoluteUrl(['site/logout'], ['data-method' => 'post']) ?><!--">خروج</a>-->
    <!--                                        </li>-->
    <!--                                        --><?php
//                                    }//end if first
//                                    else {
    //چک کردن اینکه آیا کاربر هزینه غرفه رو پرداخت کرده یا نه
    $participant = \frontend\models\Participant::find()->where(['id_company' => $p->id_user])->andWhere(['buy' => 1])->all();

    if ($participant != null) {
        ?>

        <li><a href="<?= $url->createAbsoluteUrl(['category/menu']) ?>">ثبت محصول
                جهت
                تبلیغ</a></li>
        <li>
            <a href="<?= $url->createAbsoluteUrl(['participant/create']) ?>">راهنما</a>
        </li>
        <li><a href="<?= $url->createAbsoluteUrl(['participant/create']) ?>">ثبت
                غرفه</a></li>
        <li><a href="<?= $url->createAbsoluteUrl(['img/create']) ?>">آاذلالالالالا</a></li>
        <li><a href="<?= $url->createAbsoluteUrl(['']) ?>">اطلاعات من</a></li>
        <li><a href="<?= $url->createAbsoluteUrl(['']) ?>">دعوت از دوستان</a></li>
        <li><a href="<?= $url->createAbsoluteUrl(['']) ?>">تغییر رمز</a></li>
        <li><a class=""
               href="<?= $url->createAbsoluteUrl(['site/logout'], ['data-method' => 'post']) ?>">خروج</a>
        </li>
        <?php
    } else {
        ?>
        <li><a href="<?= $url->createAbsoluteUrl(['participant/create']) ?>">ثبت
                غرفه</a></li>
        <li>
            <a href="<?= $url->createAbsoluteUrl(['participant/create']) ?>">راهنما</a>
        </li>
        <li><a href="<?= $url->createAbsoluteUrl(['']) ?>">اطلاعات من</a></li>
        <?php if ($p->company_name_en && $p->company_name_ir) {
        } ?>
        <li><a href="<?= $url->createAbsoluteUrl(['participant/create']) ?>">غرفه
                من</a>
        </li>-->
        <li><a href="<?= $url->createAbsoluteUrl(['']) ?>">دعوت از دوستان</a></li>
        <li><a href="<?= $url->createAbsoluteUrl(['']) ?>">تغییر رمز</a></li>
        <li><a class=""
               href="<?= $url->createAbsoluteUrl(['site/logout'], ['data-method' => 'post']) ?>">خروج</a>
        </li>
        <?php

    }
} }?>
