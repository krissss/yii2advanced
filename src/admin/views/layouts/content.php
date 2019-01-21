<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use dmstr\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$hideBreadcrumbs = true;
$breadcrumbs = Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    'homeLink' => [
        'label' => '首页',
        'url' => ['/home'],
    ],
]);
if (!$hideBreadcrumbs) {
    echo Html::tag('section', $breadcrumbs, ['class' => 'content-header']);
}
?>
<section class="content">
    <?= Alert::widget() ?>
    <?= $content ?>
</section>
