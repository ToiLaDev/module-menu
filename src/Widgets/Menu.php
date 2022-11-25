<?php

namespace ToiLaDev\Menu\Widgets;

use ToiLaDev\Menu\Services\MenuService;

class Menu
{
    public static function index($name) {
        $menuService = app()->make(MenuService::class);
        $menus = $menuService->widget($name);
        if (empty($menus)) {
            return alert('Menu not found!', 'Widget Menu');
        }
        return widgetView('menu', [
            'menus'    => $menuService->toTree($menus)
        ], $name);
    }
}