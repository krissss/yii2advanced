<?php
/**
 * @var $this View
 * @var $token string
 * @var $backUrl string
 */

use yii\web\View;

$this->title = '微信网页授权';

$js = <<<JS
window.localStorage.setItem('ACCESS_TOKEN', '{$token}');
window.location.href = '{$backUrl}';
JS;
$this->registerJs($js, View::POS_HEAD);
