<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'حوزه فعالیت';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
////            'id_country',
//        [
//            'attribute'=>'id_country',
//            'value'=>'idcountry.country_name',
//            'label'=>'کشور',
//        ],
//            'id_exhibition',
//            [
//                'attribute'=>'id_exhibition',
//                'value'=>'idechibition.title',
//                'label'=>'کشور',
//            ],
            'activity',
//            'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
