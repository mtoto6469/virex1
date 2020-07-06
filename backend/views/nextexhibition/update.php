<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nextexhibition */

$this->title = 'ویرایش نام نمایشگاه بعدی: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nextexhibitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nextexhibition-update col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
