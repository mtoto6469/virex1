<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Activity */

$this->title = 'ایجاد';
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,

    ]) ?>

</div>
