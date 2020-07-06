<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

//کد زیر کار نکرد
//$session = Yii::$app->session;
//if (!$session->isActive) {
//    $session->open();
//} else {
//}
//if (isset($_SESSION['error'])) {
//    if ($_SESSION['error'] != null) {
//        echo '<div class="alert alert-danger  session" id="">' . $_SESSION['error'] . '</div>';
//    }
//    $_SESSION['error'] = null;
//}

/* @var $this yii\web\View */
/* @var $model backend\models\Exhibitionn */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Exhibitionns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exhibitionn-view col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ویرایش', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('حذف', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'id_country',
        [
            'attribute'=>'id_country',
            'value'=>function($model){
                $country=\backend\models\Country::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_country])->one();
                $countryX=$country->country_name;
                return $countryX;
            },
            'label'=>'کشور',
        ],
            'title',
            'image',
            'holding_date',
            'holding_date_ir',
            'completion_date',
            'completion_date_ir',
            'holding_time',
            'completion_time',
//            'enable',
        ],
    ]) ?>

</div>
