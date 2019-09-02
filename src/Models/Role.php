<?php

namespace Axe\Models;


use Axe\Traits\HasNameTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends AxeModel
{
    use SoftDeletes, HasNameTrait;
    protected $table = "axe_roles";

    protected $casts = [
        "rules" => "array"
    ];

    protected $hidden = [
        "deleted_at", "updated_at"
    ];

    protected $fillable = ["name", "code", "rules"];


    public function checkPath($method, $path)
    {
        $method = strtoupper($method);
        foreach ($this->rules as $role) {
            if ($role['method'] == "ALL" || $role['method'] == $method) {
                $fx = '/^' . str_replace("/", "\\/", $role["url"]) . '/i';
                if (preg_match($fx, $path)) {
                    return true;
                }
            }
        }

        return false;
    }
}