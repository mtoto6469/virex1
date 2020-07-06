<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$url = Yii::$app->urlManager;
$this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>

<div>
    <div class="header-outs1" id="header1">
        <div class="header-w3layouts">
            <!--//navigation section -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="logo">
                    <h1><a class="navbar-brand" href="#"><img
                                src="<?= Yii::$app->request->hostInfo ?>/frontend/web/images/logo/logo.png"
                                style="height: 50px;width:50px;" alt="logo"></a></h1>
                </div>
                <!--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"">-->
                <!--                    <span class="icon-bar"></span>-->
                <!--                    <span class="icon-bar"></span>-->
                <!--                    <span class="icon-bar"></span>-->
                <!--                </button>-->
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#navbarSupportedContent">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                           
                        </li>
                        <li class="nav-item">
                            <a href="<?= $url->createAbsoluteUrl(['site/about']) ?>" class="nav-link scroll">درباره ما</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $url->createAbsoluteUrl(['site/tariff']) ?>" class="nav-link scroll">تعرفه ها</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $url->createAbsoluteUrl(['site/guide']) ?>" class="nav-link scroll">راهنما</a>
                        </li>
                        <?php
                        if (isset($_SESSION['country3']) && $_SESSION['country3'] != null) {
                            ?>

                            <?php
                        }
                        ?>


                        <li class="nav-item active">
                            <a class="nav-link" href="<?= $url->createAbsoluteUrl(['site/index1']) ?>">صفحه اصلی <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <div class="">
                        <?php
                        if (isset($_SESSION['country3']) && $_SESSION['country3'] != null) {

                            echo '<p id="exhibition" class="fontlg">کشور:' . $_SESSION['country3'] . '</p>';
                        }
                        //
                        ?>
                    </div>
                </div>
                <div class="dropdown pull-left  user-buttem ">
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        $user = \common\models\User::findOne(Yii::$app->user->getId());

                        ?>

                        <buttom href="#" class="dropdown-toggle user" id="userX" data-toggle="dropdown" type="button"><i
                                class="fa fa-user font"></i><br>
                            <div><?= $user->username ?></div>
                        </buttom>
                        <ul class="dropdown-menu">

                            <?php $profile = \frontend\models\Profile::find()->where(['role' => 'booth'])->andWhere(['id_user' => $user->id])->all();
                            if ($profile != null || $profile != 0) {
//                                var_dump($profile);exit;
                                foreach ($profile as $p) {
//

                                   //checked buy
                                        $participant = \frontend\models\Participant::find()->where(['id_company' => $p->id])->andWhere(['buy' => 1])->all();

                                        if ($participant != null) {
//                                          
                                            ?>

                                            <li><a href="<?= $url->createAbsoluteUrl(['category/menu']) ?>">ثبت محصول
                                                    جهت
                                                    تبلیغ</a></li>
                                            <li>
                                                <a href="<?= $url->createAbsoluteUrl(['site/guide']) ?>">راهنما</a>
                                            </li>
                                            <li><a href="<?= $url->createAbsoluteUrl(['participant/index']) ?>">ثبت
                                                    غرفه</a></li>
                                            <?php
                                        }else{?>
                                            <li><a href="<?= $url->createAbsoluteUrl(['participant/create']) ?>">ثبت
                                                    غرفه</a></li>

                                            <?php

                                        }

                                            ?>
                                    <li>
                                                <a href="<?= $url->createAbsoluteUrl(['site/guide']) ?>">راهنما</a>
                                            </li>

                                            <li>
                                                <a href="<?= $url->createAbsoluteUrl(['advertise/advertise']) ?>">ثبت تبلیغات</a>
                                            </li>

                                            <li><a href="<?= $url->createAbsoluteUrl(['']) ?>">اطلاعات من</a></li>
                                            <?php if ($p->company_name_en && $p->company_name_ir) {
                                            } ?>
                                            <li><a href="<?= $url->createAbsoluteUrl(['participant/index']) ?>">غرفه
                                                    من</a>
                                            </li>-->

                                            <li><a class=""
                                                   href="<?= $url->createAbsoluteUrl(['site/logout'], ['data-method' => 'post']) ?>">خروج</a>
                                            </li>
                                            <?php


                                } ?>


                             <?php
                            }


                            ?>

                        </ul>

                        <?php
                    } else {

                        ?>

                        <a href="<?= $url->createAbsoluteUrl(['site/login']) ?>" class="logsign">ورود</a>
                        <a href="#" class="dropdown-toggle  logsign" data-toggle="dropdown">ثبت نام</a>
                        <ul class="dropdown-menu">
                            <!--شما زمانی که در main هستی نمیتونی با postیه چیزی رو به controler بفرستی بلکه باید با متد get اطلاعات را ارسال کنی شکل صحیح ارسال'role'=>'user' میباشد -->
                            <li><a href="<?= $url->createAbsoluteUrl(['site/signup', 'role' => 'user']) ?>">بازدید کننده
                                    هستم</a></li>
                            <li><a href="<?= $url->createAbsoluteUrl(['site/signup', 'role' => 'booth']) ?>">شرکت کننده
                                    هستم</a></li>
                        </ul>

                        <?php
                    }
                    ?>
                </div>
            </nav>
            <!--//navigation section -->
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- //banner -->

</div>

<?= $content ?>

<!--<footer class="footer">-->
<!--  <p>  طراحی شده توسط شرکت طرح ریزان حامی <a href="http://no-et.com/">no-et.com</a></p>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

