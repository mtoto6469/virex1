<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Country */

$this->title = Yii::t('app', 'ثبت کشور');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
