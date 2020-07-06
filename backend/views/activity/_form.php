<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>


   <div class="row">
       <div class="col-lg-6">
           <div class="form-group field-activity-id_country required has-success countryName">
               <label class="control-label" for="activity-id_country">کد کشور</label>
               <select id="activity-id_country" class="form-control" name="Activity[id_country]" aria-required="true"
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


    <?= $form->field($model, 'activity')->textInput(['maxlength' => true]) ?>

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

        var id_country = $('#activity-id_country').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::$app->getUrlManager()->createUrl('activity/findcountry')?>',
            data: {id_country: id_country},
            success: function (data) {
                $('#exhibitionX').html(data);
//            $('#activity-id_exhibition').css('display','none');
            }
        });
    }


</script>
