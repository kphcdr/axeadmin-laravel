<?php

namespace Axe\Http\Controllers;

use Axe\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RoleController extends AuthController
{
    protected $viewGroup = "role";

    public function store(Request $request)
    {
        $this->validate($request, [
            "name"   => "required",
            "code"   => "required",
            "method" => "required|array",
            "url"    => "required|array"
        ]);
        $method = $request->input("method");
        $url = $request->input("url");
        $rules = [];
        foreach ($method as $k => $m) {
            if ($url[$k]) {
                $rules[] = [
                    "method" => $m,
                    "url"    => $url[$k]
                ];
            }
        }

        $model = $this->getModel()->create([
            "name"  => $request->input("name"),
            "code"  => $request->input("code"),
            "rules" => $rules
        ]);

        return $this->vendorJson(true, $model, "操作成功");
    }

    public function getModel(): Model
    {
        return app(Role::class);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name"   => "required",
            "code"   => "required",
            "method" => "required|array",
            "url"    => "required|array"
        ]);
        $method = $request->input("method");
        $url = $request->input("url");
        $rules = [];
        foreach ($method as $k => $m) {
            if ($url[$k]) {
                $rules[] = [
                    "method" => $m,
                    "url"    => $url[$k]
                ];
            }
        }
        $model = $this->getModel()->findOrFail($id);
        $model->update([
            "name"  => $request->input("name"),
            "code"  => $request->input("code"),
            "rules" => $rules
        ]);

        return $this->vendorJson(true, $model, "操作成功");
    }
}
