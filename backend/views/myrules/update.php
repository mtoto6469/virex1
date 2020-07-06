<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Myrules */

$this->title = 'Update myrules: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'myrules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="myrules-update coi-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
