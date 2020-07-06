<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.main.css',
        'css/fontawesome-all.min.css',
        'css/lightbox.css',
        'css/owl.carousel.css',
        'css/set1.css',
        'css/style.css',
        'css/mystyle.css',


//        'css/myadmincss.css',
  
    ];
    public $js = [
//        'js/bootstrap.min.js',
//        'js/easing.js',
//        'js/jquery.countup.js',
//        'js/jquery.waypoints.min.js',

//        'js/lightbox-plus-jquery.min.js',
//        'js/move-top.js',
//        'js/owl.carousel.js',
//        'js/myjs.js',
        'bootstrap/js/bootstrap.min.js',
//        'js/jquery-2.2.3.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
