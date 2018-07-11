<?php

namespace api\components;

use Yii;
use yii\web\ForbiddenHttpException;

class UserStatusFilter extends \kriss\behaviors\web\UserStatusFilter
{
    public function beforeAction($action)
    {
        $statusParam = $this->statusParam;
        $user = Yii::$app->user->getIdentity();
        if (!$user || in_array($user->$statusParam, $this->notAllowedStatus)) {
            throw new ForbiddenHttpException($this->errorMessage);
        }
        return parent::beforeAction($action);
    }
}
