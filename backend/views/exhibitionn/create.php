<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Exhibitionn */

$this->title = 'ایجاد نمایشگاه';
$this->params['breadcrumbs'][] = ['label' => 'Exhibitionns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exhibitionn-create col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'country' => $country,
        'images' => $images,
    ]) ?>

</div>
