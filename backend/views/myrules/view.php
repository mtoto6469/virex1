<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Myrules */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'myrules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="myrules-view col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'address',
            'phone1',
            'phone2',
            'fax',
            'mobile1',
            'mobile2',
            'guide1:ntext',
            'guide2:ntext',
            'rules:ntext',
            'exhibitTariffs:ntext',
            'abouteUs:ntext',
//            'enable',
        ],
    ]) ?>

</div>
