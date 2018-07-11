<?php

namespace admin\components;

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
            'class' => IframeLinkFilter::class,
            'layout' => '@app/views/layouts/main-content'
        ];

        return $behaviors;
    }
}
