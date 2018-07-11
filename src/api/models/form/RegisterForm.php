<?php

namespace api\models\form;

use common\components\Tools;
use common\models\User;
use kriss\components\CellphoneValidator;
use yii\base\Model;

class RegisterForm extends Model
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
     * 注册
     * @return false|User
     */
    public function register()
    {
        $user = User::find()->where(['cellphone' => $this->cellphone])->one();
        if ($user) {
            $this->addError('cellphone', '手机号已被注册');
            return false;
        }
        $user = new User();
        $user->cellphone = $this->cellphone;
        $user->setPassword($this->password);
        $user->auth_key = Tools::generateRandString();
        $user->name = Tools::generateRandString(8);
        if ($user->validate()) {
            $user->refreshAccessToken(true);
            $user->refresh();
            return $user;
        }
        $this->addError('xxx', Tools::getFirstError($user->errors));
        return false;
    }
}
