<?php

namespace admin\controllers;

use admin\components\AuthWebController;

class HomeController extends AuthWebController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
