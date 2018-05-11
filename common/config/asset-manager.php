<?php

return [
    'appendTimestamp' => true,
    'hashCallback' => function ($path) {
        return hash('md4', $path);
    },
    // 使用外部静态资源加速的项目
    // 如果 cdn 挂了可以直接全部注释掉
    // 所以请在原 XXXAsset 下写上本项目中存在的资源
    // 默认关闭使用，为了避免 cdn 挂了导致所有项目挂掉，需要的自行开启
    'bundles' => true || YII_DEBUG ? [] : [
        'yii\web\JqueryAsset' => [
            'sourcePath' => null,
            'js' => ['//cdn.staticfile.org/jquery/2.1.4/jquery.min.js']
        ],
        'yii\bootstrap\BootstrapPluginAsset' => [
            'sourcePath' => null,
            'js' => ['//cdn.staticfile.org/twitter-bootstrap/3.3.6/js/bootstrap.min.js']
        ],
        'yii\bootstrap\BootstrapAsset' => [
            'sourcePath' => null,
            'css' => ['//cdn.staticfile.org/twitter-bootstrap/3.3.6/css/bootstrap.min.css']
        ],
        'rmrevin\yii\fontawesome\AssetBundle' => [
            'sourcePath' => null,
            'css' => ['//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css']
        ],
        'yii\widgets\PjaxAsset' => [
            'sourcePath' => null,
            'js' => ['//cdn.staticfile.org/jquery.pjax/1.9.6/jquery.pjax.min.js']
        ],
        'frontend\assets\VueAsset' => [
            'sourcePath' => null,
            'js' => ['//cdn.staticfile.org/vue/2.2.6/vue.min.js']
        ],
        'frontend\assets\EchartsAsset' => [
            'sourcePath' => null,
            'js' => ['//cdn.staticfile.org/echarts/3.5.0/echarts.min.js']
        ],
        'frontend\assets\MomentAsset' => [
            'sourcePath' => null,
            'js' => ['//cdn.staticfile.org/moment.js/2.18.1/moment.min.js']
        ],
        'dosamigos\ckeditor\CKEditorAsset' => [
            'sourcePath' => null,
            'js' => ['//cdn.staticfile.org/ckeditor/4.6.2/ckeditor.js']
        ],
    ],
];