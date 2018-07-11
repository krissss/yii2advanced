<?php

namespace api\models\form;

use common\models\User;
use kriss\components\CellphoneValidator;
use yii\base\Model;

class LoginForm extends Model
{
    public $cellphone;
    public $password;

    public function rules()
    {
        return [
            [['cellphone', 'password'], 'required'],
            ['cellphone', CellphoneValidator::class],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cellphone' => '手机号',
            'password' => '密码',
        ];
    }

    /**
     * 登录
     * @return false|User
     */
    public function login()
    {
        $user = User::find()->where(['cellphone' => $this->cellphone])->one();
        if (!$user) {
            $this->addError('cellphone', '手机号不存在');
            return false;
        }
        if (!$user->validatePassword($this->password)) {
            $this->addError('password', '手机号或密码不正确');
            return false;
        }
        $user->refreshAccessToken(true);
        return $user;
    }
}
