<?php
/**
 * @var yii\web\View $this
 * @var string $content
 */

use dmstr\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$hideBreadcrumbs = true;
if (!$hideBreadcrumbs) {
    $breadcrumbs = Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'homeLink' => [
            'label' => '首页',
            'url' => ['/home'],
        ],
    ]);
    echo Html::tag('section', $breadcrumbs, ['class' => 'content-header']);
}
?>
<section class="content">
    <?= Alert::widget() ?>
    <?= $content ?>
</section>
