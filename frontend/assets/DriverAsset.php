<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class DriverAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/drivers.css'
    ];
}