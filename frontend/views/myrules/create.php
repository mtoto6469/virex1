<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Myrules */

$this->title = 'Create myrules';
$this->params['breadcrumbs'][] = ['label' => 'myrules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="myrules-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
