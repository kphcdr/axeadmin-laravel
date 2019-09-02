<?php


namespace Axe\Traits;


use Illuminate\Support\Collection;

trait VendorTreeTrait
{
    public function vendorTree(Collection $collection)
    {
        $tree = [];
        foreach($collection as $menu) {
            if($menu->parent_id == 0) {
                $tree[$menu->id] = [
                    "model"=>$menu,
                    "child"=>[]
                ];
            } else {
                $tree[$menu->parent_id]['child'][] = $menu;
            }
        }

        return Collection::make($tree);
    }
}