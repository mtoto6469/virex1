<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductSearch */
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
            'title',
//        [
//            'label'=>'نام محصول',
//        ],
//            'id_participant',
            'typePro',
//            'id_img',
            [
                'attribute'=>'id_img',
                'value'=>function($model){
                    $image=\frontend\models\Productmove::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_img])->andWhere(['id_product'=>$model->id])->one();
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
            //'id_category',
//            [
//                'attribute' => 'id_category',
//                'value' => function ($model) {
//                    $category = \frontend\models\Category::find()->where(['id' => $model->id_category])->one();
//                    if ($category) {
//                        return $category->title;
//                    } else {
//                        return null;
//                    }
//                },
//                'label' => 'نام دسته'
//            ],
            //'shortDescription',
            //'description:ntext',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
