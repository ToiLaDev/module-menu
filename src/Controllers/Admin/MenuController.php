<?php

namespace ToiLaDev\Menu\Controllers\Admin;


use ToiLaDev\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use ToiLaDev\Menu\Requests\MenuRequest;
use ToiLaDev\Menu\Services\MenuService;

class MenuController extends Controller
{
    public $permissions = [
        'menu.view' => ['index'],
        'menu.create' => ['create', 'store'],
        'menu.edit' => ['edit', 'update'],
        'menu.delete' => ['destroy']
    ];

    public $breadcrumbs = [
        ['name' => 'Content Manager']
    ];

    public string $mainRouteName = 'admin.menus.index';

    public $menuService;

    public function __construct(MenuService $menuService)
    {
        parent::__construct();
        $this->menuService = $menuService;
    }

    public function index(Request $request)
    {
        $this->breadcrumb();

        $menus = $this->menuService->allMenus();

        return moduleAdminView('list', [
            'sortable' => $this->menuService->toTree($menus),
            'menus' => $menus,
        ]);
    }

    public function store(Request $request) {

        $menu = $this->menuService->createFromRequest($request);

        return $this->storeResponse($menu);
    }

    public function edit(int $id, Request $request)
    {
        $this->breadcrumb('Menus')->withButtonMain();

        $menu = $this->menuService->find($id);
        $menus = $this->menuService->allMenus();

        return moduleAdminView('edit', [
            'sortable' => $this->menuService->toTree($menus),
            'menus' => $menus,
            'menu' => $menu
        ]);
    }

    public function update(int $id, Request $request) {
        $menu = $this->menuService->updateFromRequest($id, $request);

        return $this->updateResponse($menu);
    }

    public function destroy(int $id, Request $request) {

        $this->menuService->delete($id);

        return $this->deleteResponse();
    }

    public function sort(Request $request) {
        $this->menuService->sortFromRequest($request);

        return $this->updateResponse();
    }

}
