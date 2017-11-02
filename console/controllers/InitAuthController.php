<?php

namespace console\controllers;

class InitAuthController extends \kriss\modules\auth\console\controllers\InitAuthController
{
    public $adminClass = 'common\models\Admin';

    public $superAdminId = 1;

    public $authRoleAttribute = 'auth_role';

    public $authClass = 'common\models\base\Auth';
}