<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'ورود';
$this->params['breadcrumbs'][] = $this->title;?>
<?php
if(isset($_SESSION['error'])){
    if($_SESSION['error']!=null){
        ?>
        <div class="alert alert-danger text-center"><?=$_SESSION['error']?></div>
        <?php
    }
}
?>
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <fieldset>
        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('نام کاربری') ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput()->label('رمز عبور') ?>
        </div>
        <div class="checkbox">
            <label>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </label>
        </div>
        <!-- Change this to a button or input when using this as a form -->
        <div class="form-group">
            <?= Html::submitButton('ورود', ['class' => 'btn btn-lg btn-success btn-block', 'name' => 'login-button']) ?>
        </div>


    </fieldset>
<?php ActiveForm::end(); ?>