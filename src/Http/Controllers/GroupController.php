<?php

namespace Axe\Http\Controllers;

use Axe\Models\Group;
use Axe\Models\GroupRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GroupController extends AuthController
{
    protected $viewGroup = 'group';

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'desc'  => '',
            'roles' => 'array',
        ]);

        $model = $this->getModel()->create([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
        ]);

        $roles = $request->input('roles', []);
        foreach ($roles as $role) {
            GroupRole::create([
                'group_id' => $model->id,
                'role_id'  => $role,
            ]);
        }

        return $this->vendorJson(true, $model, '操作成功');
    }

    /**
     * @return Group
     */
    public function getModel(): Model
    {
        return app(Group::class);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required',
            'desc'  => '',
            'roles' => 'array',
        ]);
        /** @var Group $model */
        $model = $this->getModel()->findOrFail($id);
        $model->update([
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
        ]);

        $roles = $request->input('roles', []);
        GroupRole::whereGroupId($model->id)->delete();
        foreach ($roles as $role) {
            GroupRole::create([
                'group_id' => $model->id,
                'role_id'  => $role,
            ]);
        }

        return $this->vendorJson(true, $model, '操作成功');
    }

    public function destroy($id)
    {
        $model = $this->getModel()->findOrFail($id);
        if ($model->admin) {
            return $this->vendorJson(false, null, '角色下还有管理员，禁止删除');
        }

        return parent::destroy($id);
    }
}
