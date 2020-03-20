<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use kriss\adminlte\widgets\FlashMessageAlert;
use yii\bootstrap4\Breadcrumbs;

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $this->title ?></h1>
            </div>
            <div class="col-sm-6">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'homeLink' => [
                        'label' => '首页',
                        'url' => ['/home'],
                    ],
                    'options' => ['class' => 'float-sm-right']
                ]) ?>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <?= FlashMessageAlert::widget() ?>
    <?= $content ?>
</section>
