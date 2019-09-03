<?php

namespace Axe\Models;

use Axe\Traits\VendorTreeTrait;

class Menu extends AxeModel
{
    use VendorTreeTrait;
    const TYPE_DIR = 1;
    const TYPE_INNER = 2;
    const TYPE_LINK = 3;

    protected $table = 'axe_menus';

    protected $fillable = ['name', 'icon', 'type', 'url', 'sort', 'is_use'];

    public function getAllTree()
    {
        $menuCollection = self::orderBy('parent_id', 'asc')->orderBy('sort', 'desc')->get();

        return $this->vendorTree($menuCollection);
    }

    public function getCanUseTree()
    {
        $menuCollection = self::whereIsUse(1)->orderBy('parent_id', 'asc')->orderBy('sort', 'desc')->get();

        return $this->vendorTree($menuCollection);
    }

    public function hasChild()
    {
        return $this->whereParentId($this->id)->count() > 0;
    }
}
