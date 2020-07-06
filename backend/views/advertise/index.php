<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdvertiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'تبلیغات';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertise-index col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('تبلیغ جدبد', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'volume',
            'description',
            'price',
//            'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
