<?php

namespace console\controllers;

use common\models\Admin;
use common\models\User;
use yii\console\Controller;

class InitController extends Controller
{
    public function actionInitData()
    {
        $this->initAdmin();
        $this->initUser();
    }

    protected function initAdmin()
    {
        $model = new Admin();
        $model->id = Admin::SUPER_ADMIN_ID;
        $model->username = 'admin';
        $model->setPassword(123456);
        $model->generateAuthKey();
        $model->name = '超级管理员';
        $model->save();
    }

    protected function initUser()
    {
        $model = new User();
        $model->cellphone = '12345678910';
        $model->setPassword(123456);
        $model->generateAuthKey();
        $model->name = '测试人员';
        $model->save();
    }
}