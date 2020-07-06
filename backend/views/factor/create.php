<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Factor */

$this->title = 'Create Factor';
$this->params['breadcrumbs'][] = ['label' => 'Factors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
