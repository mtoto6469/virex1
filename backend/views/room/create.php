<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Room */

$this->title = 'ایجاد غرفه';
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,
    ]) ?>

</div>
