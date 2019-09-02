<?php

namespace Axe\Http\Controllers;

use Axe\Models\Admin;
use Axe\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AdminController extends AuthController
{
    protected $viewGroup = "admin";

    public function store(Request $request)
    {
        $this->validate($request, [
            "name"     => "required",
            "password" => "required",
            "is_use"   => "required",
            "group_id" => "required"
        ]);

        if ($this->getModel()->whereName($request->input("name"))->exists()) {
            return $this->vendorJson(false, null, "已经存在相同名称的管理员");
        }

        return parent::store($request); // TODO: Change the autogenerated stub
    }

    /**
     * @return Group
     */
    public function getModel(): Model
    {
        return app(Admin::class);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name"     => "required",
            "password" => "",
            "is_use"   => "required",
            "group_id" => "required"
        ]);

        $model = $this->getModel()->findOrFail($id);

        $data = $request->all();

        if (empty($data['password'])) {
            unset($data['password']);
        }
        $model->fill($data)->save();

        return $this->vendorJson(true, $model, "操作成功");
    }

    public function destroy($id)
    {
        $admin = $this->getAdmin();

        if ($id == $admin->id) {
            return $this->vendorJson(false, null, "你不能删除自己的账号");
        }
        return parent::destroy($id);
    }
}
