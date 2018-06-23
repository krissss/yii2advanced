<?php

namespace backend\controllers;

use backend\components\AuthWebController;

class HomeController extends AuthWebController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}