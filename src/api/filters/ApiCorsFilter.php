<?php

namespace api\filters;

use yii\filters\Cors;

class ApiCorsFilter extends Cors
{
    public function init()
    {
        parent::init();
        $this->cors = [
            'Origin' => ['*'],
            'Access-Control-Request-Method' => ['GET', 'POST'],
            'Access-Control-Request-Headers' => ['*'],
            'Access-Control-Allow-Credentials' => null,
            'Access-Control-Max-Age' => 86400,
            'Access-Control-Expose-Headers' => [],
        ];
    }
}
