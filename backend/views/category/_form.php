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
        echo '<div class="alert alert-danger  session" id="">' . $_SESSION['error'] . '</div>';
    }
    $_SESSION['error'] = null;
}

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($category != null) { ?>

        <?php

        if ($model->isNewRecord) { ?>
            <?= $form->field($model, 'file')->fileInput() ?>
            <?php
        }//if isNewRecord
        else { ?>
            <?= $form->field($model, 'file')->fileInput() ?>
            <?php
            if ($img) {
                ?>
                <div class="exhibitionImg"><img
                        src="<?= Yii::$app->request->hostInfo ?>/upload/images/<?= $img->fileImg ?>"
                        style="width: 100px;height: 100px;"></div>
                <?php
            } else {
            }
            ?>
            <?php

        }//else isNewRecord
        ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]);

    }//if $category
    else {
        ?>
        <?= $form->field($model, 'file')->fileInput(); ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
        <?php
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
