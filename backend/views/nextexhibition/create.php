<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Nextexhibition */

$this->title = 'ثبت نام نمایشگاه بعدی';
$this->params['breadcrumbs'][] = ['label' => 'Nextexhibitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nextexhibition-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
