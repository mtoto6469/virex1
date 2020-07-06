<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FactoradvertiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Factoradvertises');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factoradvertise-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Factoradvertise'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'volume',
            'advertise',
            'id_user',
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
