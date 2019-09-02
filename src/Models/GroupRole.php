<?php

namespace Axe\Models;

class GroupRole extends AxeModel
{
    protected $table = "axe_group_roles";

    protected $fillable = ["group_id", "role_id"];

    public function role()
    {
        return $this->belongsTo(Role::class, "role_id", "id");
    }
}