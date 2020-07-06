<?php
/**
 * Created by PhpStorm.
 * User: maryam
 * Date: 8/24/2018
 * Time: 4:01 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class AppAssetLogin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'bootstrap/css/bootstrap.min.css',
        'bootstrap/css/bootstrap-theme.min.css',
        'bootstrap/css/bootstrap-rtl.min.css',
        'font/font-awesome.min.css',
        'font/font-awesome1.min.css',
        'font/font-awesome1.css',
        'datePicker/kamadatepicker.min.css',
        'datePicker/kamadatepicker.css',
        'datePicker/datepicker.css',
        'css/myadmincss.css',
    ];
    public $js = [
        'datePicker/bootstrap-datepicker.fa.min.js',
        'datePicker/bootstrap-datepicker.min.js',
        'datePicker/datepicker.js',
        'bootstrap/js/bootstrap.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}