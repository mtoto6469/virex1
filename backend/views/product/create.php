<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = 'ثبت محصول';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create col-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category'=>$category,
    ]) ?>

</div>
