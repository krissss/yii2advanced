<?php

namespace backend\components;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Url;

class MenuHelper extends BaseObject
{
    /**
     * @var bool
     */
    public $cacheEnable = false;
    /**
     * @var int
     */
    public $cacheTime = 60;
    /**
     * @var string|array
     */
    public $cacheKey;

    private $currentAction;
    private $controllerRoute;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $currentRoute = Yii::$app->controller->route;
        $this->currentAction = Yii::$app->controller->action->id;
        $routes = explode('/', $currentRoute);
        if (count($routes) > 2) {
            $controllerRoute = $routes[0] . '/' . $routes[1];
        } else {
            $controllerRoute = $routes[0];
        }
        $this->controllerRoute = '/' . $controllerRoute . '/';
    }

    /**
     * Change Active With Cache Or Not.
     * @param array $menu
     * @return array
     */
    public function changeActive($menu)
    {
        if ($this->cacheEnable) {
            $cache = Yii::$app->cache;
            $cacheKey = [__CLASS__, __FUNCTION__, 'cache-menu-active', $this->controllerRoute, $this->currentAction];
            if ($this->cacheKey) {
                $cacheKey = array_merge($cacheKey, (array)$this->cacheKey);
            }
            return $cache->getOrSet($cacheKey, function () use ($menu) {
                return $this->doChangeActive($menu);
            }, $this->cacheTime);
        }
        return $this->doChangeActive($menu);
    }

    /**
     * Do Change Active.
     * @param array $menu
     * @return array
     */
    public function doChangeActive($menu)
    {
        foreach ($menu as &$item) {
            $this->changeItemActive($item);
        }
        return $menu;
    }

    /**
     * Change Item Active.
     * @param $item
     */
    public function changeItemActive(&$item)
    {
        if (isset($item['items'])) {
            foreach ($item['items'] as &$subItem) {
                $this->changeItemActive($subItem);
            }
        } else {
            $item['active'] = (boolean)strpos('/' . ltrim(Url::to($item['url']), '/') . '/', $this->controllerRoute);
        }

        if (!isset($item['active'])) {
            if ($this->hasActiveChild($item)) {
                $item['active'] = true;
            }
        }
    }

    /**
     * Check is child has Active.
     * @param $item
     * @return bool
     */
    protected function hasActiveChild($item)
    {
        if (isset($item['items'])) {
            foreach ($item['items'] as &$subItem) {
                if (isset($subItem['items'])) {
                    $hasActive = $this->hasActiveChild($subItem);
                } else {
                    $hasActive = isset($item['active']) ? $item['active'] : false;
                }
                if ($hasActive == true) {
                    return true;
                }
            }
        }
        return false;
    }
}