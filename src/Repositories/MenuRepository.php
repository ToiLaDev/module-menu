<?php

namespace ToiLaDev\Menu\Repositories;

use ToiLaDev\Repositories\Repository;
use ToiLaDev\Menu\Models\Menu;

class MenuRepository extends Repository implements MenuRepositoryImpl
{
    public function __construct(Menu $model) {
        $this->_model = $model;
    }
}