<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ;
$url=Yii::$app->urlManager;

?>
<!DOCTYPE html>
<html lang=" IR-fa" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<body>

<div class="nav-side-menu col-lg-2">
    <div class="brand">Brand Logo</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list ">

        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard fa-lg"></i> پنل مدیریت
                </a>
            </li>

            <li data-toggle="collapse" data-target="#address" class="collapsed">
                <a href="#"><i class="fas fa-address-book fa-lg"></i> آدرس و تلفن  <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="address">
                    <li><a href="<?= $url->createAbsoluteUrl(['myrules/create']) ?>"">ثبت آدرس جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['myrules/index']) ?>">مدیریت محتوا</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#Background" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> پس رمینه اپلیمیشن <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Background">
                    <li><a href="<?= $url->createAbsoluteUrl(['backgrond/create']) ?>">ثبت عکس جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['backgrond/index']) ?>">مدیریت عکس</a></li>

                </ul>
            </li>

            <li data-toggle="collapse" data-target="#country" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-2x" ></i> کشورها <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="country">
                    <li><a href="<?= $url->createAbsoluteUrl('country/create') ?>">ثبت کشور جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl('country/index') ?>">مدیریت کشورها</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#Exhibition" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> نمایشگاه <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Exhibition">
                    <li><a href="<?= $url->createAbsoluteUrl(['exhibitionn/create']) ?>">ثبت نمایشگاه جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['exhibitionn/index']) ?>">مدیریت نمایشگاه ها</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['exhibitionn/endtime']) ?>">نمایشگاه های تمام شده</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#Activity" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> حوزه فعالیت <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Activity">
                    <li><a href="<?= $url->createAbsoluteUrl(['activity/create']) ?>">ثبت حوزه فعالیت</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['activity/index']) ?>">مدیریت حوزه فعالیت</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#Room" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> تعریف غرفه <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Room">
                    <li><a href="<?= $url->createAbsoluteUrl(['room/create']) ?>">ایجاد غرفه</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['room/index']) ?>">مدیریت غرفه</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#Participant" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> تعریف غرفه شخصی<span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Participant">
                    <li><a href="<?= $url->createAbsoluteUrl(['participant/create']) ?>">ایجاد غرفه</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['participant/index']) ?>">مدیریت غرفه</a></li>
                </ul>
            </li>


            <li data-toggle="collapse" data-target="#Category" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> تعریف دسته بندی محصول<span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Category">
                    <li><a href="<?= $url->createAbsoluteUrl(['category/create']) ?>">ایجاد دسته</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['category/index']) ?>">مدیریت دسته</a></li>
                </ul>
            </li>


            <li data-toggle="collapse" data-target="#Product" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> تعریف محصول<span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Product">
                    <li><a href="<?= $url->createAbsoluteUrl(['product/create']) ?>">ایجاد محصول</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['product/index']) ?>">مدیریت محصولات</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#Users" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> کاربران <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Users">
                    <li><a href="<?= $url->createAbsoluteUrl(['site/signup']) ?>">ثبت کاربر جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['profile/index']) ?>">مدیریت تمام کاربران</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['profile/create']) ?>">مدیریت تمام کاربران</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#Images" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i> فایل ها تصویری<span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Images">
                    <li><a href="<?= $url->createAbsoluteUrl(['img/create']) ?>">ثبت فایل جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['img/index']) ?>">مدیریت فایل ها</a></li>
                </ul>
            </li>

            <li class="collapsed"><a href="<?= $url->createAbsoluteUrl(['participant/index']) ?>">غرفه های رزرو شده</a></li>

            <li data-toggle="collapse" data-target="#Advertise" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i>تبلیغات فایل ها تصویری<span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Advertise">
                    <li><a href="<?= $url->createAbsoluteUrl(['advertise/create']) ?>">ثبت قیمت جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['advertise/index']) ?>">مدیریت تبلیغات</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#Nextex" class="collapsed">
                <a href="#"><i class="fa fa-globe fa-lg"></i>نمایشگاه بعدی <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Nextex">
                    <li><a href="<?= $url->createAbsoluteUrl(['nextexhibition/create']) ?>">ثبت نمایشگاه</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['nextrxhibition/index']) ?>">مدیریت نمایشگاه</a></li>
                </ul>
            </li>

            <li class="collapsed" data-target="#Factors" data-toggle="collapse">
                <a href="#"><i class="fa fa-car fa-lg"></i>فاکتورها<span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="Factors">
                    <li><a href="<?= $url->createAbsoluteUrl(['factor/index','visible'=>0,'print'=>0]) ?>">فاکتور های جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['factor/index','visible'=>1,'print'=>1]) ?>">فاکتور های در انتظار تایید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl(['factor/index','visible'=>1,'print'=>1]) ?>">فاکتور های تایید شده</a></li>
                </ul>
            </li>

            <li class="collapsed"><a href="<?= $url->createAbsoluteUrl(['site/logout','type'=>1]) ?>"><i class="fa fa-car fa-lg"></i>خروج</span></a></li>
        </ul>
    </div>
</div>
<?= $content?>
</body>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
