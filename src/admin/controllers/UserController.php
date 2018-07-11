<?php

namespace admin\controllers;

use admin\components\AuthWebController;
use admin\models\UserSearch;
use common\models\User;
use kriss\actions\web\crud\CreateAction;
use kriss\actions\web\crud\IndexAction;
use kriss\actions\web\crud\ToggleAction;
use kriss\actions\web\crud\UpdateAction;
use kriss\actions\web\crud\ViewAction;

class UserController extends AuthWebController
{
    public function actions()
    {
        $actions = parent::actions();

        // 列表
        $actions['index'] = [
            'class' => IndexAction::class,
            'searchModel' => UserSearch::class
        ];
        // 新增
        $actions['create'] = [
            'class' => CreateAction::class,
            'modelClass' => User::class,
            'isAjax' => true,
            'view' => '_create_update',
        ];
        // 修改
        $actions['update'] = [
            'class' => UpdateAction::class,
            'modelClass' => User::class,
            'isAjax' => true,
            'view' => '_create_update',
        ];
        // 详情
        $actions['view'] = [
            'class' => ViewAction::class,
            'modelClass' => User::class,
            'isAjax' => true,
            'view' => '_view',
        ];
        // 修改状态
        $actions['change-status'] = [
            'class' => ToggleAction::class,
            'modelClass' => User::class,
            'attribute' => 'status',
            'onValue' => User::STATUS_NORMAL,
            'offValue' => User::STATUS_DISABLE,
        ];

        return $actions;
    }
}
