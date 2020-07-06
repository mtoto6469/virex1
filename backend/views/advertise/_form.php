<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
} else {
}
if (isset($_SESSION['error'])) {
    if ($_SESSION['error'] != null) {
        echo '<div class="alert alert-danger session" id="">' . $_SESSION['error'] . '</div>';
    }
    $_SESSION['error'] = null;
}

/* @var $this yii\web\View */
/* @var $model backend\models\Advertise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advertise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'volume')->textInput()->label('مقدار حجم آپلود بر اساس مگ') ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label('توضیحات') ?>

    <?= $form->field($model, 'price')->textInput()->label('قیمت') ?>

    <div class="form-group">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
