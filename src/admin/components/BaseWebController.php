<?php

namespace admin\components;

use common\filters\QueryParamTrimFilter;
use kriss\iframeLayout\filter\IframeLinkFilter;
use kriss\traits\WebControllerTrait;
use yii\web\Controller;

abstract class BaseWebController extends Controller
{
    use WebControllerTrait;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['param_trim_filter'] = [
            'class' => QueryParamTrimFilter::class,
        ];
        $behaviors['iframe_layout'] = [
            'class' => IframeLinkFilter::class,
            'layout' => '@app/views/layouts/main-content',
        ];

        return $behaviors;
    }
}
