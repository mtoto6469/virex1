<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = 'ثبت محصول';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create coi-sm-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
//        'model' => $model,
        'model' => $model,
        'category' => $category,
        
    ]) ?>

</div>
