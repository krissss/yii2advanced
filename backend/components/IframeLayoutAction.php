<?php

namespace backend\components;

use Yii;
use yii\base\ActionFilter;

class IframeLayoutAction extends ActionFilter
{
    /**
     * @var string
     */
    public $queryTargetParam = 'target';
    /**
     * @var array
     */
    public $queryTargetValues = ['iframe'];
    /**
     * layout name
     * @var string
     */
    public $layout = '@app/views/layouts/main-content';

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $target = $request->post($this->queryTargetParam);
        } else {
            $target = $request->get($this->queryTargetParam);
        }
        if (in_array($target, $this->queryTargetValues)) {
            $action->controller->layout = $this->layout;
        }
        return parent::beforeAction($action);
    }
}