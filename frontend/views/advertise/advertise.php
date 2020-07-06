<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 10/14/2018
 * Time: 2:05 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$url=Yii::$app->urlManager;
?>

<div class="col-sm-10">
    <div class="Sections">
        <h2>تبلیغات</h2>

        <table class="table table-bordered">
            <tbody>
            <tr>
                <th><strong>ردیف</strong></th>
                <th><strong>حجم اپلود فایل</strong></th>
                <th><strong>توضیحات</strong></th>
                <th><strong>قیمت</strong></th>
                <th><strong></strong></th>
            </tr>
            </tbody>
            <tbody>
            <?php if ($advertise){
                foreach ($advertise as $ad){
//                    if ($ad->id == 1){?>
                        <tr>
                            <td><?= $ad->id; ?></td>
                            <td><?= $ad->volume; ?></td>
                            <td><?= $ad->description; ?></td>
                            <td><?= $ad->price ?>-تومان</td>


<!--                            --><?php
                            //مین سشن کار نکرد فقط یه آیتم ارسال میشو
//                            $session = Yii::$app->session;
//                            if (!$session->isActive) {
//                                $session->open();
//                            } else {
//                            }
//                            unset($_SESSION['price1']);
//                            $_SESSION['price1']=$ad->id;
//
//                            ?>

                            <td><a href="<?= $url->createAbsoluteUrl(['advertise/sabt','id'=>$ad->id]) ?>"><i class="fa fa-download green"></i>دانلود</a></td>
                        </tr>
                    <?php
//                    }//end if $advertise
//                    else{?>

<!--                    --><?php
//                    }//end else $volume
                }//end foreach
            }//end if $advertise
            else{echo 2;exit;}?>
            </tbody>
        </table>
        <h4 >توجه : مدت زمان هر تبلیغ 30 روز میباشد</h4>
    </div>
</div>
