<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Exhibitionn */

$this->title = 'به روزرسانی نمایشگاه: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Exhibitionns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exhibitionn-update col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,
        'images' => $images,
        
//        'exhibition' =>$exhibition,
    ]) ?>

</div>
