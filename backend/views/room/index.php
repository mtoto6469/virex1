<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'غرفه ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-index col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('ایجاد غرفه جدید', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'id_country',
            ['attribute' => 'id_country',
                'value' => function ($model) {
                    $country = \backend\models\Country::find()->where(['id' => $model->id_country])->andWhere(['enable' => 1])->one();
                    if ($country) {
                        return $country->country_name;
                    } else {
                        return null;
                    }
                }//end function
            ],
//            'id_exhibition',
            ['attribute' => 'id_exhibition',
                'value' => function ($model) {
                    $exhibition = \backend\models\Exhibitionn::find()->where(['id' => $model->id_exhibition])->andWhere(['enable' => 1])->one();
                    if ($exhibition) {
                        return $exhibition->title;
                    } else {
                        return null;
                    }
                }//end function
            ],
//            'id_activity',
            'id_img',
            //'price',
            //'description',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
