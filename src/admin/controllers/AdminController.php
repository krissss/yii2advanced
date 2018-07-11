<?php

namespace admin\controllers;

use admin\components\AuthWebController;
use common\models\Admin;
use kriss\actions\web\crud\CreateAction;
use kriss\actions\web\crud\IndexAction;
use kriss\actions\web\crud\ToggleAction;
use kriss\actions\web\crud\UpdateAction;
use kriss\modules\auth\actions\UserRoleUpdateAction;
use Yii;
use yii\web\ForbiddenHttpException;

class AdminController extends AuthWebController
{
    public function actions()
    {
        $actions = parent::actions();

        // 列表
        $actions['index'] = [
            'class' => IndexAction::class,
            'dataProvider' => [
                'query' => Admin::find(),
                'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                        'id' => SORT_DESC,
                    ]
                ]
            ],
        ];
        // 创建
        $actions['create'] = [
            'class' => CreateAction::class,
            'modelClass' => Admin::class,
            'beforeValidateCallback' => function (Admin $model) {
                $model->generateAuthKey();
                $model->setPassword($model->password_hash);
            },
        ];
        // 修改
        $actions['update'] = [
            'class' => UpdateAction::class,
            'modelClass' => Admin::class,
        ];
        // 重置密码
        $actions['reset-password'] = [
            'class' => UpdateAction::class,
            'modelClass' => Admin::class,
            'operateMsg' => '重置密码',
            'view' => '_reset_password',
            'beforeRunCallback' => function ($id) {
                if ($id == Admin::SUPER_ADMIN_ID) {
                    throw new ForbiddenHttpException('不能修改超级管理员信息');
                }
            },
            'beforeValidateCallback' => function (Admin $model) {
                $model->setPassword($model->password_hash);
            }
        ];
        // 修改状态
        $actions['change-status'] = [
            'class' => ToggleAction::class,
            'modelClass' => Admin::class,
            'attribute' => 'status',
            'onValue' => Admin::STATUS_NORMAL,
            'offValue' => Admin::STATUS_DISABLE,
            'beforeRunCallback' => function ($id) {
                if ($id == Admin::SUPER_ADMIN_ID) {
                    throw new ForbiddenHttpException('不能修改超级管理员信息');
                }
            },
        ];
        // 更新角色
        $actions['update-role'] = [
            'class' => UserRoleUpdateAction::class,
            //'permissionName' => Auth::ADMIN_UPDATE_ROLE,
            'isRenderAjax' => true,
            //'view' => '_update_role',
            'successCallback' => function ($action, $result) {
                /** @var $action UserRoleUpdateAction */
                if ($result['type'] == 'success') {
                    Yii::$app->session->setFlash('success', '授权成功');
                } else {
                    Yii::$app->session->setFlash('error', '授权失败：' . $result['msg']);
                }
                /** @var self $controller */
                $controller = $action->controller;
                return $controller->actionPreviousRedirect();
            }
        ];

        return $actions;
    }
}
