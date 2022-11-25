<?php

namespace ToiLaDev\Menu\Models;

use ToiLaDev\Models\Base;
use ToiLaDev\Traits\CastTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Base {
    use SoftDeletes,  NodeTrait;

    protected $table = 'menus';

    protected $fillable = ['title', 'url', 'target', 'parent_id', '_lft', '_rgt'];

}
