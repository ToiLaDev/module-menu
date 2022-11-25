<?php

namespace ToiLaDev\Menu;

use ToiLaDev\Traits\ModuleServiceProviderTrait;
use ToiLaDev\Menu\Widgets\Menu;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    use ModuleServiceProviderTrait;

    private $permissions = [
        'view'         => 'View Menu',
        'create'       => 'Create Menu',
        'edit'         => 'Edit Menu',
        'delete'       => 'Delete Menu'
    ];

    private $appendAdminMenus = [
        'content' => [
            'menu' => [
                'title'     => 'Menus',
                'icon'      => 'list',
                'permission'=> 'menu.view',
                'route'     => 'admin.menus.index',
            ]
        ]
    ];

    private $widgets = [
        'menu'   => [Menu::class, 'index'],
    ];

}
