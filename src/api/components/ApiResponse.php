<?php

namespace api\components;

use yii\web\Response;

class ApiResponse extends Response
{
    /**
     * 是否进行 api 格式化，在特殊的接口上不需要格式化时有用
     * 使用如下:
     * $response = Yii::$app->response;
     * if ($response instance ApiResponse) {
     *     $response->apiFormat = false;
     * }
     *
     * @var bool
     */
    public $apiFormat = true;
}
