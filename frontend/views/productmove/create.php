<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Productmove */

$this->title = Yii::t('app', 'Create Productmove');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productmoves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productmove-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
