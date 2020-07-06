<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Marked */

$this->title = 'Create Marked';
$this->params['breadcrumbs'][] = ['label' => 'Markeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marked-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
