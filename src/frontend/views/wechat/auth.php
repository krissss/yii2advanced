<?php
/**
 * @var yii\web\View $this
 * @var string $token
 * @var string $backUrl
 */

use yii\web\View;

$this->title = '微信网页授权';

$js = <<<JS
window.localStorage.setItem('ACCESS_TOKEN', '{$token}');
window.location.href = '{$backUrl}';
JS;
$this->registerJs($js, View::POS_HEAD);
