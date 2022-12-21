<?php

namespace ToiLaDev\Menu\Forms;

use Illuminate\Contracts\View\View;
use ToiLaDev\Forms\Base\Form;
use ToiLaDev\Forms\Base\Hide;
use ToiLaDev\Forms\Base\Image;
use ToiLaDev\Forms\Base\Select;
use ToiLaDev\Forms\Base\Text;
use ToiLaDev\Forms\Base\Textarea;
use ToiLaDev\Menu\Requests\MenuRequest;
use ToiLaDev\Menu\Services\MenuService;

class MenuForm
{
    private MenuService $menuService;

    public function __construct(MenuService $menuService) {
        $this->menuService = $menuService;
    }

    public function create($menus): View
    {
        $form = new Form('addMenu',
            route: 'admin.menus.store',
            wrap: 'col-12',
            validation: MenuRequest::class
        );
        $form->add('Add New Menu');
        $form->add(new Text('title'));
        $form->add(new Text('url'));
        $form->add(new Select('target', options: ['_blank','_self','_parent','_top'], default: '_____'));
        $form->add(new Select('parent_id', title: 'Parent', options: toSelect($menus->toFlatTree(), title: 'title'), default: '_____'));

        return $form->render();
    }

    public function edit($attrs): View|string
    {
        $menu = $attrs[0];
        $menus = $attrs[1];
        if (is_numeric($menu)) {
            $menu = $this->menuService->find($menu);
        }
        if (empty($menu)) {
            return '';
        } else {
            $form = new Form('editMenu',
                action: route('admin.menus.update', $menu->id),
                wrap: 'col-12',
                method: 'put',
                validation: MenuRequest::class
            );
            $form->add('Edit Menu');
            $form->add(new Text('title', value: $menu->title));
            $form->add(new Text('url', value: $menu->url));
            $form->add(new Select('target', value: $menu->target, options: ['_blank','_self','_parent','_top'], default: '_____'));
            $form->add(new Select('parent_id', title: 'Parent', options: toSelect($menus->toFlatTree(), title: 'title'), value: $menu->parent_id, default: '_____'));

            return $form->render();
        }
    }
}