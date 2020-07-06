<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Views */

$this->title = Yii::t('app', 'Create Views');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Views'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="views-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
