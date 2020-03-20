<?php

namespace kriss\adminlte\assets;

use kartik\base\BaseAssetBundle;

class AdminLteAsset extends BaseAssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';

    public $css = [
        'css/adminlte.min.css',
    ];

    public $js = [
        'js/adminlte.min.js',
    ];

    public $depends = [
        'rmrevin\yii\fontawesome\NpmFreeAssetBundle',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
}
