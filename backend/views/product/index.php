<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'محصولات';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('ثبت محصول', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'title',
        [
            'attribute'=>'title',
            'label'=>'عنوان محصول',
        ],
//            'id_participant',
            [
                'attribute'=>'id_participant',
                'value'=>function($model){
                    $participant=\backend\models\Participant::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_participant])->one();
                    $profile=\backend\models\Profile::find()->where(['enable'=>1])->andWhere(['id'=>$participant->id_company])->one();
                    $a='';
                    $a.='شرکت : ';
                    $a.=$profile->company_name_en;

                    return $a;

                },
                'label'=>'غرفه دار'
            ],
//            'typePro',
        [
            'attribute'=>'typePro',
            'label'=>'نوع محصول',
        ],
//            'id_img',
            [
                'attribute'=>'id_img',
                'value'=>function($model){
                    $image=\backend\models\Productmove::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_img])->andWhere(['id_product'=>$model->id])->one();
                    if ($image){

                        $img='فایل ها ثبت شده اند';
                        return $img;
                    }else{
                        $img='فایل ها ثبت نشده اند';
                        return $img;
                    }
                },
                'label'=>'فیلم و عکس '
            ],
//            'id_Category',
            [
                'attribute'=>'id_Category',
                'value'=>function($model){
                    $category=\backend\models\Category::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_Category])->one();
                    if ($category){
                        $category=$category->title;
                        return $category;
                    }
                },
                'label'=>'عنوان دسته'
            ],
            //'shortDescription',
            //'description',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
