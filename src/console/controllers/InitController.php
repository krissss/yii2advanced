<?php

namespace console\controllers;

use common\models\Admin;
use yii\console\Controller;

class InitController extends Controller
{
    public function actionInitData()
    {
        $this->initAdmin();
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
}
