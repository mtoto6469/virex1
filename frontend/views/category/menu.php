<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$session = Yii::$app->session;
if (!$session->isActive) {
    $session->open();
} else {
}
if (isset($_SESSION['error'])) {
    if ($_SESSION['error'] != null) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    }
    $_SESSION['error'] = null;
}
AppAsset::register($this);
?>
<?php $this->beginPage();
$url = Yii::$app->urlManager;

?>
<div class="nav-side-menu col-lg-2">
    <div class="brand">Brand Logo</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list ">

        <ul id="menu-content" class="menu-content collapse out">
            <li>
                <a href="#">
                     پنل مدیریت تبلیغات غرفه دار
                </a>
            </li>

            
            <li data-toggle="collapse" data-target="#category" class="collapsed">
                <a href="#"><i class="fas fa-address-book fa-lg"></i> ثبت دسته <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="category">
                    <li><a href="<?= $url->createAbsoluteUrl('category/create') ?>"">ثبت دسته جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl('category/index') ?>">مدیریت دسته</a></li>
                </ul>
            </li>

            <li data-toggle="collapse" data-target="#product" class="collapsed">
                <a href="#"><i class="fas fa-address-book fa-lg"></i> ثبت محصول <span class="arrow"></span></a>
                <ul class="sub-menu collapse" id="product">
                    <li><a href="<?= $url->createAbsoluteUrl('product/create') ?>"">ثبت محصول جدید</a></li>
                    <li><a href="<?= $url->createAbsoluteUrl('product/index') ?>">مدیریت محصولات</a></li>
                </ul>
            </li>

            <li class="collapsed"><a href=""><i class="fa fa-car fa-lg"></i>خروج</span></a></li>
        </ul>
    </div>
</div>