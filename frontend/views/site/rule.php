<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'قوانین و مقررات سایت ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="abut_image">
        <span class=" "></span>
    </div>
    <div class="abutme">
        <div class="col-lg-12 col-lg-offset-0  main_con1">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $address =\frontend\models\Myrules ::find()->where(['enable' => 1])->all();
            if ($address) {
                foreach ($address as $a) { ?>
                    <p class="pp"><?= $a->rules ?></p>


                    <?php
                }
            } else {
                ?>

                <?php
            }
            ?>

          
        </div>
    </div>
</div>
