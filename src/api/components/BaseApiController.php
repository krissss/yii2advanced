<?php

namespace api\components;

use api\filters\ApiCorsFilter;
use kriss\behaviors\rest\PostVerbFilter;
use kriss\behaviors\rest\QueryParamAuth;
use Yii;
use yii\base\Model;
use yii\rest\Controller;

abstract class BaseApiController extends Controller
{
    public $serializer = ApiSerializer::class;
    public $postVerbActions = [];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // 去除不用的
        unset($behaviors['authenticator'], $behaviors['rateLimiter']);
        // 跨域访问
        $behaviors['corsFilter'] = ApiCorsFilter::class;
        // 必须是 post 请求的action
        $behaviors['postVerbFilter'] = [
            'class' => PostVerbFilter::class,
            'actions' => $this->postVerbActions,
        ];

        return $behaviors;
    }

    /**
     * 设置 Yii::$app->user->xxx 可用，
     * 在没有继承 AuthRestController 的时候使用
     */
    public function setUserIdentity()
    {
        $authMethod = new QueryParamAuth([
            'tokenParam' => AuthApiController::TOKEN_PARAM,
        ]);
        $authMethod->authenticate(Yii::$app->user, Yii::$app->request, Yii::$app->response);
    }

    /**
     * 校验失败返回
     * @param $msg
     * @return Model
     */
    public function validateError($msg)
    {
        $model = new Model();
        $model->addError('xxx', $msg);
        return $model;
    }
}
