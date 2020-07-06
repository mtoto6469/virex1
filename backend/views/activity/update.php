<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Activity */

$this->title = 'ویرایش حوزه فعالیت: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activity-update col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,
    ]) ?>

</div>
