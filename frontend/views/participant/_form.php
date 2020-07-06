<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
} else {
}
if (isset($_SESSION['error-factor'])) {
    if ($_SESSION['error-factor'] != null) {
        echo '<div class="alert alert-danger  session" id="">' . $_SESSION['error-factor'] . '</div>';
    }
    $_SESSION['error-factor'] = null;
}

/* @var $this yii\web\View */
/* @var $model frontend\models\Participant */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="participant-form">

        <?php $form = ActiveForm::begin(); ?>


        <div class="row">
            <div class="col-lg-6">
                <div class="form-group field-activity-id_country required has-success countryName">
                    <label class="control-label" for="activity-id_country">کد کشور</label>
                    <select id="participant-id_country" class="form-control" name="Participant[id_country]"
                            aria-required="true"
                            onchange="Mycountry(this.value)">
                        <option value="0">کشور مورد نظر</option>

                        <?php

                        if ($country == null) {
                            echo "در هیچ کشوری نمایشگاهی برگزار نشده است";
                        } else {
                            foreach ($country as $c) {
                                ?>
                                <option id="idCountry" value="<?= $c->id ?>"><?= $c->country_name ?></option>
                                <?php
                            }
                        }

                        ?>
                    </select>

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <!--            <div class="activityName">-->
                <!--                <div id="activityX"></div>-->
                <!--            --><? //= $form->field($model, 'teaser')->dropDownList([1 => 'بله', 2 => 'خیر']) ?>
                <div class="form-group field-participant-teaser has-success teaserName">
                    <label class="control-label" for="participant-teaser">تیزر تبلیغاتی</label>
                    <select id="participant-teaser" class="form-control" name="Participant[teaser]" aria-required="true"
                            onchange="Myteaser(this.value)">
                        <option value="0">تیزر تبلیغاتی</option>
                        <option value="1">بله</option>
                        <option value="2">خیر</option>
                    </select>

                    <div class="help-block"></div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6">
                <div class="exhibitionName">
                    <div id="exhibitionX"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="roomName">
                    <div id="roomX"></div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6"><?= $form->field($model, 'responsible_name')->textInput() ?></div>
            <div class="col-lg-6"><?= $form->field($model, 'semat')->textInput() ?></div>
            <div class="col-lg-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
            <div class="col-lg-6"><?= $form->field($model, 'fax')->textInput() ?></div>
        </div>

        <div class="row">
            <div class="col-lg-6">  <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?></div>
            <div class="col-lg-6"><?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?></div>
        </div>

        <div class="row">
            <?php if ($model->isNewRecord) { ?>
                <div class="col-md-4"><?= $form->field($model, 'file')->fileInput()->label('لوگو شرکت') ?></div>

                <div class="col-md-4">
                    <div class="teaserGifName">
                        <div id="teaserGifX"></div>
                    </div>
                </div>

                <div class="col-md-4"><?= $form->field($model, 'file1')->fileInput()->label('کاتالوگ شرکت') ?></div>
                <div class="col-md-4"><?= $form->field($model, 'file2')->fileInput()->label('تیزر تبلیغاتی شرکت') ?></div>
                <?php
            } else {

                if ($images != null) {
                    foreach ($images as $img) ?>

                        <div class="col-md-4">
                    <?= $form->field($model, 'file')->fileInput()->label('لوگو شرکت') ?>
                    <?php
                    if ($img){?>
                        <div class="exhibitionImg">  <img src="<?= Yii::$app->request->hostInfo ?>/upload/images/<?= $img->fileImg ?>"
                                                          style="width: 100px;height: 100px;"> </div>
                        <?php
                    }else{}
                    ?>
<!--                    <div>-->
<!--                        <input value="--><?//= $img->fileImg ?><!--" name="Participant[img]">-->
<!--                    </div>-->
                            </div>


                    <div class="col-md-4">
                        <?= $form->field($model, 'file1')->fileInput()->label('کاتالوگ شرکت') ?>
                        <?php
                        if ($img){?>
                            <?php if ($img->filePdf == 'void'){

                            } else{?>
                                <a href="<?= Yii::$app->request->hostInfo ?>/upload/files/<?= $img->filePdf ?>"><?= $img->filePdf ?></a>
                                <?php
                            }?>

                            <?php
                        }else{}
                        ?>
                    </div>


                    <div class="col-md-4">
                        <?= $form->field($model, 'file2')->fileInput()->label('تیزر تبلیغاتی') ?>
                        <?php
                        if ($img){?>
                            <?php if ($img->fileMove == 'void'){}else{?>
                                <video  width="300" height="100" poster="" controls >
                                    <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $img->fileMove ?>" type="video/mp4" title="<?= $img->fileMove ?>">
                                    <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $img->fileMove ?>" type="video/gif" title="<?= $img->fileMove ?>">
                                    <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $img->fileImg ?>" type="video/mp4" title="<?= $img->fileMove ?>">
                                    <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $img->fileImg ?>" type="video/gif" title="<?= $img->fileMove ?>">
                                    <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $img->filePdf ?>" type="video/mp4" title="<?= $img->fileMove ?>">
                                    <source src="<?= Yii::$app->request->hostInfo ?>/upload/video/<?= $img->filePdf ?>" type="video/gif" title="<?= $img->fileMove ?>">
                                </video>
                                <?php
                            } ?>

                            <?php
                        }else{}
                        ?>
<!--                        <div>-->
<!--                            <input value="--><?//= $img->fileMove ?><!--" name="Participant[move]">-->
<!--                        </div>-->
                    </div>

                    <?php
                }
            }
            ?>
        </div>

        <?= $form->field($model, 'site_address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'shortdescription')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'dsescription')->textarea(['rows' => 6]) ?>


        <div class="form-group">
            <?= Html::submitButton('ذخیره', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <script>


        /*******************************************************/
        function chengexhibitionName() {
            $('.exhibitionNamep ').css('display', 'block');
            $('.exhibitionName').css('display', 'none');

        }

        function chengtroomName() {
            $('.roomName1').css('display', 'block');
            $('.roomName').css('display', 'none');

        }

        function Myexhibition() {
            var id_exhibition = $('#participant-id_exhibition').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::$app->getUrlManager()->createUrl('participant/findexhibition')?>',
                data: {id_exhibition: id_exhibition},
                success: function (data) {
                    $('#roomX').html(data);
//            $('#activity-id_exhibition').css('display','none');
                }
            });
        }
        /**************************************************************/
        function chengcountryName() {
            $('.countryNamep ').css('display', 'block');
            $('.countryName').css('display', 'none');

        }

        function chengtexhibitionName() {
            $('.exhibitionName1').css('display', 'block');
            $('.exhibitionName').css('display', 'none');

        }


        function Mycountry() {
            var id_country = $('#participant-id_country').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::$app->getUrlManager()->createUrl('participant/findcountry1')?>',
                data: {id_country: id_country},
                success: function (data) {
                    $('#exhibitionX').html(data);
//            $('#activity-id_exhibition').css('display','none');
                }
            });
        }
        /*************************************************************************************/

    </script>
