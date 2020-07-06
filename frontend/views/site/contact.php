<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'ارتباط با ما';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact index1">
    <div class="contact_image">
        <span class=" "></span>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>



    <div class="row">
        <div class="col-lg-5 col-sm-offset-3 main_con1">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('نام') ?>

                <?= $form->field($model, 'email')->label('ایمیل') ?>

                <?= $form->field($model, 'subject')->label('موضوع') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('متن') ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('ارسال', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
