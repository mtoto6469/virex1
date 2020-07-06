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
/* @var $model frontend\models\Backgrond */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backgrond-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'alt')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
