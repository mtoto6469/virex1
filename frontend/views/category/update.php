<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Category */

$this->title = 'ویرایش دسته: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category'=>$category,
        'img'=>$img
//        'images'=>$images,
    ]) ?>

</div>
