<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class ToolsController extends Controller
{
    // 在执行 migrate 后特殊情况会导致 schema 还是缓存中的
    // 解决该问题，缓存必须使用的是全局性的，比如 redis 的缓存
    // php yii tools/clear-db-cache wb_hb_account
    public function actionClearDbCache($name)
    {
        Yii::$app->db->getSchema()->refreshTableSchema($name);
    }
}
