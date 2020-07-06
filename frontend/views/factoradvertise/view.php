<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Factoradvertise */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Factoradvertises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factoradvertise-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'volume',
            'advertise',
            'id_user',
            'id_participant',
            'price',
            'atu',
            'ref',
            'visible',
            'print',
            'date',
            'date_ir',
            'time',
            'confirm',
            'endPrice',
            'addressOfCentralOffice',
            'factoryAddress',
            'enable',
        ],
    ]) ?>

</div>
