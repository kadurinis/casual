<?php


namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class DriverAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/drivers.css'
    ];

    public $js = [
        'js/create.order.js'
    ];

    public $depends = [
        JqueryAsset::class,
    ];
}