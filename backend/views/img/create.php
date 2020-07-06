<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Img */

$this->title = 'آپلود فایل';
$this->params['breadcrumbs'][] = ['label' => 'Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="img-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelup' => $modelup,
    ]) ?>

</div>
