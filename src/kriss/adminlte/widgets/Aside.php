<?php

namespace kriss\adminlte\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Aside extends Widget
{
    public $options = ['class' => 'main-sidebar sidebar-dark-primary elevation-4'];

    private $rootTag = 'nav';

    public function init()
    {
        $this->rootTag = ArrayHelper::remove($this->options, 'tag', $this->rootTag);

        echo Html::beginTag($this->rootTag, $this->options) . "\n";
    }

    public function run()
    {
        echo Html::endTag($this->rootTag);
    }
}
