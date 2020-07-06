<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Factoradvertise */

$this->title = 'Create Factoradvertise';
$this->params['breadcrumbs'][] = ['label' => 'Factoradvertises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factoradvertise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
