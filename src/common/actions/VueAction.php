<?php

namespace common\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\helpers\Inflector;

class VueAction extends Action
{
    public $entry;
    public $title;
    public $viewPath = __DIR__ . '/views';
    public $view = '@__currentViewPath/vue';

    public function init()
    {
        if (!$this->entry) {
            throw new InvalidConfigException('entry must config');
        }
    }

    public function run()
    {
        Yii::setAlias('@__currentViewPath', $this->viewPath);
        return $this->controller->render($this->view, [
            'entryName' => Inflector::camel2id($this->entry),
            'title' => $this->title,
        ]);
    }
}
