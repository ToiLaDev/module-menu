<?php

namespace ToiLaDev\Menu\Services;

use ToiLaDev\Services\RepositoryService;
use ToiLaDev\Menu\Repositories\MenuRepository;
use Illuminate\Support\Facades\Auth;

class MenuService extends RepositoryService implements MenuServiceImpl
{

    public function __construct(MenuRepository $firstRepo) {
        $this->firstRepo = $firstRepo;
    }

    public function createFromRequest($request)
    {
        $attributes = $request->only(['title', 'url', 'target', 'parent_id']);

        $menu = $this->firstRepo->create($attributes);

        return $menu;
    }

    public function updateFromRequest(int $id, $request)
    {
        $attributes = $request->only(['title', 'url', 'target', 'parent_id']);

        $menu = $this->firstRepo->update($id, $attributes);

        return $menu;
    }

    public function sortFromRequest($request)
    {
        $data = $request->get('sort');

        $this->firstRepo->model()->rebuildTree($data);
    }

    public function allMenus()
    {
        return $this->firstRepo->newQuery()->withDepth()->defaultOrder()->get();
    }

    public function widget($name)
    {
        $menu = $this->firstRepo->newQuery()->whereTitle($name)->first();
        return $menu?$this->firstRepo->newQuery()->defaultOrder()->withDepth()->descendantsOf($menu->id):null;
    }

    public function toTree($menus) {
        return $menus->toTree();
    }

}