<?php

namespace frontend\themes\bootstrapmaterial;

use yii\web\AssetBundle;

class BootstrapMaterialAsset extends AssetBundle {

    public $sourcePath = '@frontend/themes/bootstrapmaterial/assets';
    public $css = [
        'css/bootstrap-material-design.min.css',
        'css/ripples.min.css',
        'css/style.css',
    ];
    public $js = [
        'js/material.min.js',
        'js/ripples.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
            //'yii\bootstrap\BootstrapAsset',
    ];

}
