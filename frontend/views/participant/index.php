<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'غرفه ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('ویرایش غرفه', ['update'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute'=>'id',
//                'value'=>function($model){
//                    $user=\common\models\User::findOne(Yii::$app->user->getId());
//                    $profile = \frontend\models\Profile::find()->where(['enable' => 1])->andWhere(['id_user' => $user->id])->one();
//                    $participant = \frontend\models\Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $profile->id])->one();
////                    $booth=$participant->id;
//                    if ($participant != null){
//                        return $model;
//                    }
//                }
            ],
//            'id_country',
            [
                'attribute'=>'id_country',
                'value'=>function($model){
                    $country=\frontend\models\Country::find()->where(['id'=>$model->id_country])->one();
                    if ($country){
                        $country=$country->country_name;
                        return $country;
                    }//end if $exhibition
                    else{
                        return null;
                    }//end else $exhibition

                },//end value
                'label'=>'نام کشور',
            ],
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
            'id_room',
//            'id_company',
            [
                'attribute'=>'id_company',
                'value'=>function($model){
                    $profile=\frontend\models\Profile::find()->where(['id'=>$model->id_company])->one();
                    if ($profile){
                        $profile1=$profile->username;
                        //میخاستم به صورت آرایه دوتا فیلد رو چاپ کنم که خطا داد و نشد
//                        $profile1['company_name_en']=$profile->company_name_en;

                        return $profile1;
                    }//end if $exhibition
                    else{
                        return null;
                    }//end else $exhibition

                },//end value
                'label'=>'نام کاربری',
            ],
            [
                'attribute'=>'id_company',
                'value'=>function($model){
                    $profile=\frontend\models\Profile::find()->where(['id'=>$model->id_company])->one();
                    if ($profile){
                        $profile=$profile->company_name_en;
                        //میخاستم به صورت آرایه دوتا فیلد رو چاپ کنم که خطا داد و نشد
//                        $profile1['company_name_en']=$profile->company_name_en;

                        return $profile;
                    }//end if $exhibition
                    else{
                        return null;
                    }//end else $exhibition

                },//end value
                'label'=>'نام شرکت',
            ],
            //'id_activity',
            //'teaser',
            //'responsible_name:ntext',
            //'semat:ntext',
            //'email:email',
            //'fax:ntext',
            //'site_address',
            //'telegram',
            //'instagram',
            //'shortdescription:ntext',
            //'dsescription:ntext',
            //'buy',
            [
                'attribute'=>'buy',
                'value'=>function($model){
                    $buy='ثبت نهایی شد';
                    $buy1='ثبت نهایی نشد';
                    if ($model->buy==1){

                        return $buy;
                    }else{
                        return $buy1;
                    }
                }
            ],
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
