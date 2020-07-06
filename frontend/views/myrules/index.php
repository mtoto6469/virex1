<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MyrulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'myrules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="myrules-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create myrules', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'address',
            'phone1',
            'phone2',
            'fax',
            //'mobile1',
            //'mobile2',
            //'guide1:ntext',
            //'guide2:ntext',
            //'rules:ntext',
            //'exhibitTariffs:ntext',
            //'abouteUs:ntext',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
