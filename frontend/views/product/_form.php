<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */


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

?>
<div class="product-form my-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($category != null) { ?>
        <div class="form-group field-category-id_parent">
            <label class="control-label" for="category-id_parent">دسته مورد نظر را انتخاب کنید</label>
            <select id="category-id_parent" class="form-control" name=" Product[id_Category]">
                <option value="0">انتخاب دسته محصول</option>
                <?php foreach ($category as $cat) { ?>

                    <option value="<?= $cat->id ?>"><?= $cat->title ?></option>
                    <?php
                }
                ?>

            </select>

            <div class="help-block"></div>
        </div>
        <?php
    } else { ?>


        <?php
    } ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'typePro')->textInput(['maxlength' => true]) ?>


    <div class="row">
        <div class="view"><span> برای آپلود چندین فیلم لطفا بعد از انتخاب فیلم اول کلید shift در کیبرد کامپیوتر را نگه داشته و بقیه فیلم ها را انتخاب کنید</span></div>
        <?php if ($model->isNewRecord) { ?>
            <div
                class="col-md-3"><?= $form->field($model, 'fileMove1[]')->fileInput(['multiple' => true, 'accept' => 'movie/*'])->label('آپلود قیلم(به صورت چتد تا همزمان)'); ?></div>
            <div
                class="col-md-3"><?= $form->field($model, 'fileMove2')->fileInput()->label('کاتالوگ محصول (pdf)'); ?></div>
            <div
                class="col-md-3"><?= $form->field($model, 'fileMove3')->fileInput()->label('عکس محصول (اجباری)'); ?></div>

            <?php
        } else {

            if ($sendFull != null) { ?>
                <?php $i = 0;
                foreach ($sendFull as $img) { ?>
                    <div class="col-md-4">

                        <?= $form->field($model, 'fileMove1[]')->fileInput(['multiple' => true, 'accept' => 'movie/*'])->label('آپلود قیلم(به صورت چتد تا همزمان)'); ?>

                        <div>
                            <div class="view">
                                <video width="150" height="50" poster="" controls>
                                    <source src="<? Yii::$app->request->hostInfo ?>/upload/video/<? $img->move1 ?>"
                                            type="video/mp4" title="<? $img->move1 ?>">
                                    <source src="<? Yii::$app->request->hostInfo ?>/upload/video/<? $img->move1 ?>"
                                            type="video/gif" title="<? $img->move1 ?>">
                                    <source src="<? Yii::$app->request->hostInfo ?>/upload/video/<? $img->move1 ?>"
                                            type="video/mp4" title="<? $img->move1 ?>">
                                    <source src="<? Yii::$app->request->hostInfo ?>/upload/video/<? $img->move1 ?>"
                                            type="video/gif" title="<? $img->move1 ?>">
                                    <source src="<? Yii::$app->request->hostInfo ?>/upload/video/<? $img->move1 ?>"
                                            type="video/mp4" title="<? $img->move1 ?>">
                                    <source src="<? Yii::$app->request->hostInfo ?>/upload/video/<? $img->move1 ?>"
                                            type="video/gif" title="<? $img->move1 ?>">
                                </video>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div
                            class=""><?= $form->field($model, 'fileMove2')->fileInput()->label('کاتالوگ محصول (pdf)'); ?>
                        </div>

                        <div class="view">
                            <a href="<?= Yii::$app->request->hostInfo ?>/upload/files/<?= $move->move2; ?>"><?= $move->move2 ?></a>
                        </div>

                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'fileMove3')->fileInput()->label('عکس محصول'); ?>
                        <div>
                            <div class="view">
                                <img src="<?= Yii::$app->request->hostInfo ?>/upload/images/<?= $move->move3 ?>"
                                     style="width: 300px;height: 100px;" name="<?= $move->move3 ?>">
                            </div>
                        </div>
                    </div>
                <?php }
            }
        } ?>
    </div>


    <?php


    ?>


    <?= $form->field($model, 'shortDescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('ذخیره', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
