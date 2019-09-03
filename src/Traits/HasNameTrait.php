<?php

namespace Axe\Traits;

trait HasNameTrait
{
    public static function getAllName(): array
    {
        $return = [];
        $all = self::all(['id', 'name']);

        foreach ($all as $a) {
            $return[$a->id] = $a->name;
        }

        return $return;
    }
}
