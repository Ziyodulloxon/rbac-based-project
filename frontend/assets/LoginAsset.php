<?php


namespace frontend\assets;


use yii\web\AssetBundle;

/**
 * Login page asset bundle.
 */
class LoginAsset extends AssetBundle
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
        'lte/iCheck/icheck.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}