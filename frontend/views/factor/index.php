<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FactorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Factors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Factor'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_exhibition',
            'id_room',
            'id_company',
            'id_user',
            //'id_participant',
            //'volume',
            //'id_advertise',
            //'price',
            //'date',
            //'date_ir',
            //'time',
            //'time_ir',
            //'atu',
            //'ref',
            //'visible',
            //'print',
            //'endPrice',
            //'enable',
            //'buyAdvertise',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
