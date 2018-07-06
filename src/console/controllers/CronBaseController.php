<?php

namespace console\controllers;

use common\components\Logger;
use common\components\Tools;
use yii\console\Controller;

abstract class CronBaseController extends Controller
{
    public function actionIndex()
    {
        $sleep = $this->getSleepTime();
        $name = $this->getName();
        while (true) {
            echo date('Y-m-d H:i:s') . ' ' . $name . '-轮询' . PHP_EOL;
            Tools::runYiiConsoleInBackground($this->id . '/do');

            sleep($sleep);
        }
    }

    public function actionDo()
    {
        $name = $this->getName();
        Logger::queueJob($name . '-开始');
        $this->service();
        Logger::queueJob($name . '-结束');
    }

    /**
     * @return int
     */
    abstract public function getSleepTime();

    /**
     * 业务名称
     * @return string
     */
    abstract public function getName();

    /**
     * 实际需要轮询的业务
     * @throws \Exception
     */
    abstract public function service();
}
