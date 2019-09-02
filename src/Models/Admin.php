<?php

namespace Axe\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Admin extends AxeModel
{
    use SoftDeletes;
    protected $table = "axe_admins";
    protected $fillable = ["name","password","is_use","group_id"];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function doLoginSuccess()
    {
        session([
            "axe_id"=>$this->id,
            "axe_name"=>$this->name
        ]);
    }
}
