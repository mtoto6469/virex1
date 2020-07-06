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
        echo '<div class="alert alert-danger  session center-session" id="">' . $_SESSION['error'] . '</div>';
    }
    $_SESSION['error'] = null;
}

/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-lg-6">
            <div class="form-group field-activity-id_country required has-success countryName">
                <label class="control-label" for="room-id_country">کد کشور</label>
                <select id="room-id_country" class="form-control" name="Room[id_country]" aria-required="true"
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
            <div class="exhibitionName">
                <div id="exhibitionX"></div>
            </div>
        </div>
    </div>
<?php if($model->isNewRecord){ ?>
    <?= $form->field($model, 'file')->fileInput()->label('آپلود عکس') ?>
    <?php
}else { ?>
    <?= $form->field($model, 'file')->fileInput()->label('آپلود عکس') ?>
    <div class="exhibitionImg">  <img src="<?= Yii::$app->request->hostInfo ?>/upload/images/<?= $model->id_img ?>"
                                      style="width: 100px;height: 100px;"> </div>
<?php } ?>


    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('ذخیره', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

    function chengcountryName() {
        $('.countryNamep ').css('display', 'block');
        $('.countryName').css('display', 'none');

    }

    function chengtexhibitionName() {
        $('.exhibitionName1').css('display', 'block');
        $('.exhibitionName').css('display', 'none');

    }


    function Mycountry() {

        var id_country = $('#room-id_country').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::$app->getUrlManager()->createUrl('room/findcountry')?>',
            data: {id_country: id_country},
            success: function (data) {
                $('#exhibitionX').html(data);
//            $('#activity-id_exhibition').css('display','none');
            }
        });
    }


</script>
