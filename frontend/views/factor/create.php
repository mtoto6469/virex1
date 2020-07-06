<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Factor */

$this->title = Yii::t('app', 'Create Factor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Factors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
