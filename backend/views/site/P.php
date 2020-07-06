<?php
//
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//
///* @var $this yii\web\View */
///* @var $model backend\models\Product */
///* @var $form yii\widgets\ActiveForm */
//?>
<!---->
<!--<div class="product-form col-sm-10">-->
<!---->
<!--    --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--    --><?php //$form = ActiveForm::begin(); ?>
<!--    --><?php //if ($category != null) { ?>
<!--        <div class="form-group field-category-id_parent">-->
<!--            <label class="control-label" for="category-id_parent">دسته مورد نظر را انتخاب کنید</label>-->
<!--            <select id="category-id_parent" class="form-control" name=" Product[id_category]">-->
<!--                --><?php //foreach ($category as $cat) { ?>
<!---->
<!--                    <option value="--><?//= $cat->id ?><!--">--><?//= $cat->title ?><!--</option>-->
<!--                    --><?php
//                }
//                ?>
<!---->
<!--            </select>-->
<!---->
<!--            <div class="help-block"></div>-->
<!--        </div>-->
<!--        --><?php
//    } else { ?>
<!---->
<!--        --><?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<!--        --><?php
//    } ?>
<!---->
<!--    --><?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'typePro')->textInput(['maxlength' => true]) ?>
<!---->
<!---->
<!--    <!--    -->--><?php ////if ($model->isNewRecord) { ?>
<!--    <!--        -->--><?////= $form->field($model, 'fileMove1')->fileInput() ?>
<!--    <!--        -->--><?////= $form->field($model, 'fileMove2')->fileInput() ?>
<!--    <!--        -->--><?////= $form->field($model, 'fileMove3')->fileInput() ?>
<!--    <!--        -->--><?////= $form->field($model, 'fileMove4')->fileInput() ?>
<!--    <!--        -->--><?php
//    //    } else { ?>
<!--    <!--        -->--><?////= $form->field($model, 'file')->fileInput() ?>
<!--    <!---->-->
<!--    <!--        <div class="form-group field-category-id_img">-->-->
<!--    <!--            <label class="control-label" for="product-id_img">دسته مورد نظر را انتخاب کنید</label>-->-->
<!--    <!--            <select id="product-id_img" class="form-control" name=" Product[id_img]">-->-->
<!--    <!--                <option value="0">انتخاب عکس</option>-->-->
<!--    <!--                -->--><?php ////foreach ($category as $cat) { ?>
<!--    <!--                    -->--><?php ////if ($cat->id_img != 'void') { ?>
<!--    <!--                        <option value="-->--><?////= $cat->id ?><!--<!--">-->--><?////= $cat->id_img ?><!--<!--</option>-->-->
<!--    <!--                        -->--><?php
//    //                    }
//    //                }
//    //                ?>
<!--    <!--            </select>-->-->
<!--    <!---->-->
<!--    <!--            <div class="help-block"></div>-->-->
<!--    <!--        </div>-->-->
<!--    <!--        -->--><?php
//    //    } ?>
<!---->
<!--    --><?//= $form->field($model, 'shortDescription')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
<!---->
<!--    <div class="form-group">-->
<!--        --><?//= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<!--    </div>-->
<!---->
<!--    --><?php //ActiveForm::end(); ?>
<!---->
<!--</div>-->
