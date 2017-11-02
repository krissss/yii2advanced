<?php

namespace frontend\components;

use kriss\traits\WebControllerTrait;
use yii\web\Controller;

class BaseWebController extends Controller
{
    use WebControllerTrait;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        return $behaviors;
    }
}