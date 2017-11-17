<?php

namespace backend\controllers;

use backend\components\AuthWebController;
use backend\components\MessageAlert;
use backend\models\UserSearch;
use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class UserController extends AuthWebController
{
    // 列表
    public function actionIndex()
    {
        $this->rememberUrl();

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    // 修改状态
    public function actionChangeStatus($id, $status)
    {
        $model = $this->findModel($id);
        if (
            ($model->status == User::STATUS_NORMAL && $status == User::STATUS_DISABLE)
            || ($model->status == User::STATUS_DISABLE && $status == User::STATUS_NORMAL)
        ) {
            $model->status = $status;
            $model->save(false);
            MessageAlert::set(['success' => '操作成功']);
        } else {
            MessageAlert::set(['error' => '当前状态下操作失败']);
        }
        return $this->actionPreviousRedirect();
    }

    /**
     * @param $id
     * @return User
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $model = User::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $model;
    }
}
