<?php

namespace backend\controllers;

use backend\components\AuthWebController;
use backend\models\form\ModifyPasswordForm;
use Yii;
use yii\helpers\Url;

class AccountController extends AuthWebController
{
    public function actionModifyPassword(){
        $modifyPasswordForm = new ModifyPasswordForm();
        if ($modifyPasswordForm->load(Yii::$app->request->post()) && $modifyPasswordForm->validate()) {
            $modifyPasswordForm->modifyPassword();
            return $this->redirect(Url::to(['/site/login']));
        }
        return $this->render('modify-password', [
            'model' => $modifyPasswordForm
        ]);
    }
}