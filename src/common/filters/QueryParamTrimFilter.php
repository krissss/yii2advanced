<?php

namespace common\filters;

use Yii;
use yii\base\ActionFilter;

class QueryParamTrimFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        $request = Yii::$app->request;
        $this->trimValue($request->queryParams, $res);
        $request->setQueryParams($res ?: []);

        return parent::beforeAction($action);
    }

    protected function trimValue($value, &$res)
    {
        foreach ($value as $k => $v) {
            if (is_array($v)) {
                $this->trimValue($v, $res[$k]);
            } else {
                $res[$k] = trim($v);
            }
        }
    }
}
