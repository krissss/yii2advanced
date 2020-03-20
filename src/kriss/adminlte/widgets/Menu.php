<?php

namespace kriss\adminlte\widgets;

class Menu extends \yii\widgets\Menu
{
    public $options = ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget' => 'treeview'];
    public $itemOptions = ['class' => 'nav-item'];
    public $linkTemplate = '<a href="{url}" class="nav-link {active}">{icon} <p>{label} {badge} {rightCert}</p></a>';
    public $labelTemplate = '<p>{label} {rightCert}</p>';
    public $submenuTemplate = "\n<ul class='nav nav-treeview'>\n{items}\n</ul>\n";
    public $activateParents = true;

    public $defaultIconItem = 'far fa-circle';
    public $defaultIconList = 'fas fa-list';
    public $rightCertIcon = 'fas fa-angle-left';

    protected function renderItem($item)
    {
        $content = parent::renderItem($item);

        $strRepArr = [];

        if (strpos($content, '{icon}') !== false) {
            if (isset($item['icon'])) {
                $icon = $item['icon'];
            } else {
                $icon = isset($item['items']) ? $this->defaultIconList : $this->defaultIconItem;
            }
            $strRepArr['{icon}'] = "<i class='nav-icon {$icon}'></i>";
        }

        if (strpos($content, '{rightCert}') !== false) {
            $rightCert = isset($item['items']) ? "<i class='right {$this->rightCertIcon}'></i>" : '';
            $strRepArr['{rightCert}'] = $rightCert;
        }

        if (strpos($content, '{badge}') !== false) {
            $badge = '';
            if (isset($item['badge'])) {
                $badgeType = isset($item['badgeType']) ? $item['badgeType'] : 'primary';
                $badge = "<span class='right badge badge-{$badgeType}'>{$item['badge']}</span>";
            }
            $strRepArr['{badge}'] = $badge;
        }

        if (strpos($content, '{active}') !== false) {
            $strRepArr['{active}'] = $item['active'] ? $this->activeCssClass : '';
        }

        if ($strRepArr) {
            $content = strtr($content, $strRepArr);
        }

        return $content;
    }
}
