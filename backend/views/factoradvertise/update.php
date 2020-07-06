<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Factoradvertise */

$this->title = 'Update Factoradvertise: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Factoradvertises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="factoradvertise-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
