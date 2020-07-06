<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Myrules */

$this->title = 'Update myrules: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'myrules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="myrules-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
