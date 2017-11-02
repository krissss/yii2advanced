<?php

namespace frontend\components;

use common\models\base\ConfigString;
use kriss\behaviors\web\OperateLog;
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