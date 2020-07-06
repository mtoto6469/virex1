<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Exhibitionn */

$this->title = 'Update Exhibitionn: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Exhibitionns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exhibitionn-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
