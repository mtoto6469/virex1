<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FactorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'فاکتورها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factor-index col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'id_exhibition',
            'id_room',
            'id_company',
            'id_user',
            'price',
            'date',
            //'date_ir',
            //'time',
            //'time_ir',
            //'atu',
            //'ref',
            //'visible',
            //'print',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
