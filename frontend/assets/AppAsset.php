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
        'lte/font-awesome/css/font-awesome.min.css',
        'lte/ionicons/css/ionicons.css',
        'lte/css/AdminLTE.css',
        'lte/skins/_all-skins.css',
        'lte/iCheck/square/blue.css',
    ];
    public $js = [
        'lte/jquery-slimscroll/jquery.slimscroll.min.js',
        'lte/fastclick/lib/fastclick.js',
        'js/adminlte.min.js',
        'js/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
