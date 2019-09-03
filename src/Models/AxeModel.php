<?php

namespace Axe\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AxeModel extends Model
{
    protected $guarded = [];
    protected $perPage = 20;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('default-orderBy', function (Builder $builder) {
            $builder->orderBy('id', 'desc');
        });
    }
}
