<?php

namespace frontend\components;

use kriss\traits\WebControllerTrait;
use yii\web\Controller;

abstract class BaseWebController extends Controller
{
    use WebControllerTrait;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        /*$behaviors['param_trim_filter'] = [
            'class' => QueryParamTrimFilter::class,
        ];*/

        return $behaviors;
    }
}
