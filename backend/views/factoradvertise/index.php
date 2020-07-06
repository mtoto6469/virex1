<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FactoradvertiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Factoradvertises';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factoradvertise-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Factoradvertise', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'volume',
            'advertise',
            'id_participant',
            'price',
            //'atu',
            //'ref',
            //'visible',
            //'print',
            //'date',
            //'date_ir',
            //'time',
            //'confirm',
            //'endPrice',
            //'addressOfCentralOffice',
            //'factoryAddress',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
