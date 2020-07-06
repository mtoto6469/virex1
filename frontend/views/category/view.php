<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view col-sm-10 index1">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('حذف', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title:ntext',

            //چون ما زیردسته نداریم همه کد id_parent کامنت شده
//            'id_parent',
//        [
//            'attribute'=>'id_parent',
//            function($model1){
//                $category=\frontend\models\Category::find()->where(['enable'=>1])->andWhere(['id'=>$model1])->andWhere(['id'=>$model1])->one();
//                $x=$category->title;
//                $id=$category->id;
//                $category1=\frontend\models\Category::find()->where(['enable'=>1])->andWhere(['id'=>$id])->one();
////                $model1= $category;
//                if ($category){
//                    return $category1->title;
//
//                }else{ return null;}
//            },
//        ],

//            'id_img',
            [
                'attribute'=>'id_img',
                'value'=>function($model){
                    $img=\frontend\models\Img::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_img])->one();
                    if ($img){
                        $img=$img->fileImg;
                        return $img;
                    }else{
                        $img='عکس ثبت نشده';
                        return $img;
                    }
                }
            ],
            
//            'id_participant',
            [
                'attribute'=>'id_participant',

                'value'=>function($model){
                    $participant=\frontend\models\Participant::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_participant])->one();
                    $profile=\backend\models\Profile::find()->where(['enable'=>1])->andWhere(['id'=>$participant->id_company])->one();
                    $a='';
                    $a.='شرکت : ';
                    $a.=$profile->company_name_en;
                    return $a;
                },
                'label'=>'غرفه دار'
            ],
            //کد پایین کد غرفه دار رو چاپ میکرد
//            [
//            'attribute'=>'id_participant',
//            function($model){
//                $user=\common\models\User::findOne(Yii::$app->user->getId());
//                $participant = \frontend\models\Participant::find()->where(['enable' => 1])->andWhere(['id_company' => $user->id])->one();
//                $booth = $participant->id;
//                $category=\frontend\models\Category::find()->where(['id_participant'=>$booth]);
//                if ($category){
//                    return $model;
//                }
//            }
//        ],
//            'enable',
        ],
    ]) ?>

</div>
