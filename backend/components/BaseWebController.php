<?php

namespace backend\components;

use kriss\iframeLayout\IframeLinkFilter;
use kriss\traits\WebControllerTrait;
use yii\web\Controller;

class BaseWebController extends Controller
{
    use WebControllerTrait;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['iframe_layout'] = [
            'class' => IframeLinkFilter::className(),
            'layout' => '@app/views/layouts/main-content'
        ];

        return $behaviors;
    }
}