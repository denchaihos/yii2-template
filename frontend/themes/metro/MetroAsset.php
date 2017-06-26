<?php
namespace frontend\themes\metro;

use yii\web\AssetBundle;

class MetroAsset extends AssetBundle{
    public $sourcePath = '@frontend/themes/metro/assets';
    
    public $css = [
        'css/metro.css',
      
    ];
    public $js = [
        'js/jquery.plugins.min.js',
        'js/metro.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}