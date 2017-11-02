<?php

namespace backend\assets;

use yii\web\AssetBundle;

class IframeLayoutAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/iframe-layout.css',
    ];
    public $js = [
        'js/iframe-layout.js'
    ];
}