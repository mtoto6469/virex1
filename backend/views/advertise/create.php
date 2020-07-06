<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Advertise */

$this->title = 'تبلیغات';
$this->params['breadcrumbs'][] = ['label' => 'Advertises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertise-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
