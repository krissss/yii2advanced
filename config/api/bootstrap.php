<?php

use api\components\ApiResponse;
use yii\base\Event;

Event::on(ApiResponse::class, ApiResponse::EVENT_BEFORE_SEND, function ($event) {
    /** @var ApiResponse $response */
    $response = $event->sender;
    if ($response->format == ApiResponse::FORMAT_HTML) {
        // 不处理 html 请求
        return;
    }
    if ($response->apiFormat) {
        // 重新格式化 json 格式的返回形式
        //$response->format = Response::FORMAT_JSON;
        $messageMap = [
            500 => '系统异常，请稍候再试~',
            401 => '登录失效或未登录~',
        ];
        $responseData = [
            'code' => $response->statusCode,
            'message' => $messageMap[$response->statusCode] ?? $response->statusText,
            'data' => $response->data,
        ];
        $response->statusCode = 200;
        $response->data = $responseData;
    }
});
