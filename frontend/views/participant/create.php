<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Participant */

$this->title = 'ایجاد غرفه';
$this->params['breadcrumbs'][] = ['label' => 'Participants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-create col-sm-10 offset-sm-1">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,
        'activity' => $activity,
    ]) ?>

</div>
