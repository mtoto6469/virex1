<?php

use yii\helpers\Html;
use yii\grid\GridView;

$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
} else {
}
if (isset($_SESSION['error'])) {
    if ($_SESSION['error'] != null) {
        echo '<div class="alert alert-danger  session" id="">' . $_SESSION['error'] . '</div>';
    }
    $_SESSION['error'] = null;
}

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExhibitionnSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'نمایشگاه';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exhibitionn-index col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('ایجاد نمایشگاه جدید', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'id_country',
            [
                'attribute' => 'id_country',
                'value' => 'idcountry.country_name',
                'label' => 'کشور',
            ],
            'title',
            'image',
            'holding_date',
            //'holding_date_ir',
            'completion_date',
    [
        'value'=>function($model){
            
        }
    ],
            //'completion_date_ir',
            //'holding_time',
            //'completion_time',
            //'enable',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
