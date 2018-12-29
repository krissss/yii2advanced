<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use dmstr\widgets\Alert;
use yii\widgets\Breadcrumbs;

?>
<section class="content-header">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'homeLink' => [
            'label' => '首页',
            'url' => ['/home']
        ],
    ]) ?>
</section>

<section class="content">
    <?= Alert::widget() ?>
    <?= $content ?>
</section>
