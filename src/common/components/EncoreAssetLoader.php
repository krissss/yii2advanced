<?php

namespace common\components;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Json;
use yii\web\View;

class EncoreAssetLoader extends BaseObject
{
    public $entryPointFile = '@publicRoot/assets/build/entrypoints.json';

    /**
     * @var array
     */
    protected $entryPoint = [];

    public function init()
    {
        parent::init();
        $this->loadEntryPoints();
    }

    public function getAssetByName(string $name)
    {
        if (!isset($this->entryPoint[$name])) {
            return [
                'js' => [],
                'css' => [],
            ];
        }

        $asset = $this->entryPoint[$name];
        return [
            'js' => $asset['js'] ?? [],
            'css' => $asset['css'] ?? [],
        ];
    }

    public function registerAsset(View $view, $name, $depends = [])
    {
        $asset = $this->getAssetByName($name);
        foreach ($depends as $depend) {
            $view->registerAssetBundle($depend);
        }
        foreach ($asset['js'] as $js) {
            $view->registerJsFile($js);
        }
        foreach ($asset['css'] as $css) {
            $view->registerCssFile($css);
        }
    }

    protected function loadEntryPoints()
    {
        $file = Yii::getAlias($this->entryPointFile);
        if (!file_exists($file)) {
            return;
        }
        $json = file_get_contents($file);
        $data = Json::decode($json, true);
        if (!$data || !isset($data['entrypoints'])) {
            return;
        }

        $this->entryPoint = $data['entrypoints'];
    }
}
