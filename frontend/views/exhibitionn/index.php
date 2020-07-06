<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ExhibitionnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exhibitionns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exhibitionn-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Exhibitionn', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_country',
            'title',
            'image',
            'holding_date',
            //'holding_date_ir',
            //'completion_date',
            //'completion_date_ir',
            //'holding_time',
            //'completion_time',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
