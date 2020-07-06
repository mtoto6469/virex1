
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="picture ">


    <?php $form = ActiveForm::begin(['action'=>'/site/index']); ?>

        <input name="_csrf-backend" value="i1MIb2WBn8bhsNptDkCFns8Zw6ggX3WSZTjSGRU7MmTxFTA9Abf69qPZjVtDeeDOpmj6w1cRFOoQcL96Zm0KDg==" type="hidden">
            <div class="form-group field-country-country_name required">
                <label class="control-label" for="country-country_name"> <p id="country" class="fontlg">لطفا نام کشور مورد نظر برای نماشگاه را انتخاب کنید.</p></label><br>
                <select id="country-country_name  " class="form-control" name="Country[country_name]" aria-required="true" onchange="get1(this.value)">
                    <option value="">کشور مورد نظر</option>
                <?php if($country==null ){
                    echo "در هیچ کشوری نمایشگاهی برگزار نشده است";
                }else{
                   foreach ($country as $c) {?>
                       <option  id="" value="<?=$c->id?>"><?=$c->country_name ?></option>
                    <?php
                   }
                } ?>
                </select>

<!--                <div class="help-block"></div>-->
            </div>
        </div>
<!--        <div class="form-group">-->
<!--            <button id="sendX"  class="btn1 btn-success" value="ppp"type="submit" onclick="send()" >hfhn</button>-->
<!--        </div>-->


<div class="form-group">
    <button type="submit" class="btn btn-success" value="" id="countryXx" name="countryX">ارسال</button>
</div>
<?php ActiveForm::end(); ?>

</div>
<!--<script src="../../web/js/jquery-2.2.3.min.js" type="javascript"></script>-->
<script>
//    //ارسال نام کشور به دکمه
//    function get1(value) {
//
//        var p;
//       p= $('#countryXx').val(value);
////        alert(p);
////        p=document.getElementById(value);
//
//
//    }

//    function get1(value) {
//       var p;
//        p=$('#countryXx').val(value);
//        alert(p);
//    }
</script>