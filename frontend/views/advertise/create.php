<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Advertise */

$this->title = Yii::t('app', 'Create advertise');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Advertises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
