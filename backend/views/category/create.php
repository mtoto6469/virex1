<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = 'ثبت دسته محصول';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category'=>$category,
        'booth'=>$booth,
    ]) ?>

</div>
