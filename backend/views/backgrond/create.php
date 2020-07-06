<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Backgrond */

$this->title = Yii::t('app', 'Create Backgrond');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Backgronds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backgrond-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
