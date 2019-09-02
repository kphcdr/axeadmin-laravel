<?php

namespace Axe\Models;

use Axe\Traits\HasNameTrait;

class Group extends AxeModel
{
    use HasNameTrait;
    protected $table = "axe_groups";

    protected $fillable=["name","desc"];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function groupRole()
    {
        return $this->hasMany(GroupRole::class);
    }

    public function getRoleIdArr():array
    {
        return $this->groupRole->pluck("role_id")->toArray();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,"axe_group_roles");
    }
}