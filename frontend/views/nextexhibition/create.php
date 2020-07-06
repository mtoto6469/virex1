<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Nextexhibition */

$this->title = Yii::t('app', 'Create Nextexhibition');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nextexhibitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nextexhibition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
