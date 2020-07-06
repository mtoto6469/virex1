<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Exhibitionn */

$this->title = 'Create Exhibitionn';
$this->params['breadcrumbs'][] = ['label' => 'Exhibitionns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exhibitionn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
