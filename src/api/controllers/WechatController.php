<?php

namespace api\controllers;

use api\components\BaseApiController;
use common\components\Component;
use Yii;

class WechatController extends BaseApiController
{
    public function actionJssdk()
    {
        $jssdk = Component::wechat()->app->jssdk;
        $jssdk->setUrl(Yii::$app->request->post('url'));
        return $jssdk->buildConfig(Yii::$app->request->post('jsApiList'), false, false, false);
    }
}
