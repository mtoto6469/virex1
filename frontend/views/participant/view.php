<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
/* @var $model frontend\models\Participant */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Participants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'id_country',
//            'id_exhibitionn',
            [
                'attribute'=>'id_exhibitionn',
                'value'=>function($model){
                    $exhibition=\frontend\models\Exhibitionn::find()->where(['id'=>$model->id_exhibitionn])->one();
                    if ($exhibition){
                        $send=$exhibition->title;
                        return $send;
                    }//end if $exhibition
                    else{
                        return null;
                    }//end else $exhibition

                },//end value
                'label'=>'نام نمایشگاه',
            ],
            [
                'attribute'=>'id_images',
                'value'=>function($model){
                    $img=\frontend\models\Img::find()->where(['id'=>$model->id_images])->one();
                    if ($img){
//                        $file['fileImg']=$img->fileImg;
//                        $file['fileMove']=$img->fileMove;
//                        $file['filePdf']=$img->filePdf;
//                        $sendFile[]=$file;
                        $sendFile='save files';
                        return $sendFile;
                        
//                        return $sendFile;
                        
                    }//end if $img
                    else{
                        $send='شما هیچ فایلی اپلود نکرده اید';
                        return $send;
                    }//end else $img
                },//end value
                'label'=>'فایل',

            ],
            [
                'attribute'=>'buy',
                'value'=>function($model){
                    $room=\frontend\models\Room::find()->where(['id_exhibition'=>$model->id_exhibitionn])->one();
                    if ($room){
                        $price=$room->price;
                        return $price;
                    }//end if $room
                    else{
                        return null;
                    }//end else $room
                }
            ]
//            'id_room',
//            'id_company',
//            'id_activity',
//            'teaser',
//            'responsible_name:ntext',
//            'semat:ntext',
//            'email:email',
//            'fax:ntext',
//            'site_address',
//            'telegram',
//            'instagram',
//            'shortdescription:ntext',
//            'dsescription:ntext',
//            'buy',
//            'enable',
        ],
    ]) ?>

    <?php if ($model->buy != 1) {?>
    <p class="center"> <?= Html::a('تکمیل ثبت نام', ['buy', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>
    <?php }else{ ?>
        <p class="center"> <a class="btn btn-primary" href="#">ثبت کامل شد</a></p>
    <?php }  ?>

</div>
