<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Participant */

$this->title = 'Create Participant';
$this->params['breadcrumbs'][] = ['label' => 'Participants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,
        'activity' => $activity,
    ]) ?>

</div>
