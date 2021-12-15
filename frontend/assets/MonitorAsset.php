<?php


namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class MonitorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        YII_DEBUG ? 'js/monitor.js' : 'js/monitor.min.js'
    ];

    public $css = [
        'css/drivers.css',
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}