<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Participant */

$this->title = 'ویرایش: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Participants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="participant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,
        'activity' => $activity,
        'images' => $images,
        'img'=>$img,
    ]) ?>

</div>
