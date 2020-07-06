<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Activity */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view col-lg-10">

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
            'id',
//            'id_country',
        [
            'attribute'=>'id_country',
            'value'=>function($model){
        $country=\backend\models\Country::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_country])->one();
                $countryX=$country->country_name;
                return $countryX;
    }
        ],
//            'id_exhibition',
        [
            'attribute'=>'id_exhibition',
            'value'=>function($model){
                $exhibition=\backend\models\Exhibitionn::find()->where(['enable'=>1])->andWhere(['id'=>$model->id_exhibition])->one();
                $exhibitionX=$exhibition->title;
                return $exhibitionX;
            }
        ],
            'activity',
//            'enable',
        ],
    ]) ?>

</div>
