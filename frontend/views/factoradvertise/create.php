<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Factoradvertise */

$this->title = Yii::t('app', 'Create Factoradvertise');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Factoradvertises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factoradvertise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
