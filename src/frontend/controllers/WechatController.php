<?php

namespace frontend\controllers;

use common\components\Component;
use common\models\base\WechatUserInterface;
use Exception;
use Overtrue\Socialite\User;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;

class WechatController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionAuth()
    {
        $backUrl = Yii::$app->request->referrer;
        if (!$backUrl || strpos($backUrl, 'wechat/auth') !== false) {
            $backUrl = Url::to('/site/index');
        }
        /** @var WechatUserInterface|string|ActiveRecord $wechatUserClass */
        $wechatUserClass = Yii::$app->user->identityClass;
        if (!is_a($wechatUserClass, WechatUserInterface::class, true)) {
            throw new Exception("{$wechatUserClass} 必须实现 WechatUserInterface 接口");
        }
        if (Yii::$app->params['wechatMpMockLogin'] ?? false) {
            $user = $wechatUserClass::findOne(Yii::$app->params['wechatMpMockLoginId']);
        } else {
            $wechat = Component::wechat();
            if (!$wechat->getIsWechat()) {
                return '请在微信打开';
            }
            if (!$wechat->isAuthorized()) {
                $wechat->authorizeRequired()->send();
                return '';
            }
            // 获取信息进行登录
            $info = Yii::$app->session->get($wechat->sessionParam);
            $user = $wechatUserClass::bindByWechat(new User(Json::decode($info)));
        }

        // 登录
        $token = $user->updateAccessToken();
        Yii::$app->user->login($user);
        return $this->render('auth', [
            'token' => $token,
            'backUrl' => $backUrl
        ]);
    }
}
