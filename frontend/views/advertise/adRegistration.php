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
/* @var $model frontend\models\Factoradvertise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factoradvertise-form col-sm-10">

    <div class="registration"><p >
            ثبت تبلیغ
        </p></div>


    <?php $form = ActiveForm::begin(); ?>

<?php if ($advertise){
//    if ($advertise->volume != 5){
        $volume=$advertise->volume;
    $price=$advertise->price;
        ?>

       <div class="row">
           <div class="col-sm-6">
               <div class="form-group field-factoradvertise-volume has-success">
                   <label class="control-label" for="factoradvertise-volume">حجم دانلود بر اساس مگابایت</label>
                   <input id="factoradvertise-volume" class="form-control" name="Factoradvertise[volume]" 0="1" aria-invalid="false" type="label" value="<?= $volume ?>">

                   <div class="help-block"></div>
               </div>

           </div>
           <div class="col-sm-6">
               <div class="form-group field-factoradvertise-price has-success">
                   <label class="control-label" for="factoradvertise-price">Price</label>
                   <input id="factoradvertise-price" class="form-control" name="Factoradvertise[price]" 0="1" aria-invalid="false" type="text" value="<?= $price ?>">

                   <div class="help-block"></div>
               </div>
           </div>
       </div>
            <?= $form->field($model, 'file1')->fileInput()->label('دانلود عکس') ?>
            <?= $form->field($model, 'file')->fileInput()->label('دانلود فیلم') ?>

    <?php
}//if $advertise != null
 ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'پرداخت'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



