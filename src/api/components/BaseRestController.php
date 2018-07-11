<?php

namespace api\components;

use kriss\behaviors\rest\QueryParamAuth;
use Yii;
use yii\base\Model;
use yii\rest\Controller;

class BaseRestController extends Controller
{
    public $serializer = [
        'class' => 'kriss\components\rest\Serializer',
        'paginationTotalCount' => 'total',
        'paginationPageCount' => 'last_page',
        'paginationCurrentPage' => 'current_page',
        'paginationPageSize' => 'per_page',
        'dataProviderInData' => true,
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // 去除不用的
        unset($behaviors['verbFilter'], $behaviors['authenticator'], $behaviors['rateLimiter']);
        // 跨域访问
        $behaviors['corsFilter'] = Cors::class;
        return $behaviors;
    }

    /**
     * 设置 Yii::$app->user->xxx 可用，
     * 在没有继承 AuthRestController 的时候使用
     */
    public function setUserIdentity()
    {
        $authMethod = new QueryParamAuth([
            'tokenParam' => AuthRestController::TOKEN_PARAM
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
