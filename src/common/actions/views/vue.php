<?php
/**
 * @var \yii\web\View $this
 * @var string $title
 * @var string $entryName
 */

use common\components\Component;
use yii\helpers\Html;

Component::encoreAssetLoader()->registerAsset($this, $entryName);

if ($title) {
    $this->title = $title;
}

echo Html::tag('div', '', ['id' => 'app']);
