<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'نمایشگاه مجازی virex ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="contact_image">
        <span class=" "></span>
    </div>
    <div class="abutme">
        <div class="col-lg-12 col-lg-offset-0  main_con1">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php $address =\frontend\models\Myrules ::find()->where(['enable' => 1])->all();
            if ($address) {
                foreach ($address as $a) { ?>
                    <p class="pp"><?= $a->abouteUs ?></p>
                    <p class="pp">موبایل : <?= $a->mobile1 ?></p>
                    <p class="pp">موبایل : <?= $a->mobile2 ?></p>
                    <p class="pp">تلفن : <?= $a->phone1 ?></p>
                    <p class="pp">دفتر مرکزی: <?= $a->phone2 ?></p>
                    <p class="pp">فکس: <?= $a->fax ?></p>

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
