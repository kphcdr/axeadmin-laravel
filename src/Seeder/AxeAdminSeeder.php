<?php

namespace Axe\Seeder;

use Axe\Models\Admin;
use Axe\Models\Group;
use Axe\Models\GroupRole;
use Axe\Models\Menu;
use Axe\Models\OperationLog;
use Axe\Models\Role;
use Illuminate\Database\Seeder;

class AxeAdminSeeder extends Seeder
{
    protected $roleData = [
        [
            "name"  => "权限节点",
            "code"  => "role",
            "rules" => [
                [
                    "method" => "ALL",
                    "url"    => "/role"
                ]
            ]
        ],
        [
            "name"  => "菜单管理",
            "code"  => "role",
            "rules" => [
                [
                    "method" => "ALL",
                    "url"    => "/menu"
                ]
            ]
        ],
        [
            "name"  => "角色管理",
            "code"  => "group",
            "rules" => [
                [
                    "method" => "ALL",
                    "url"    => "/group"
                ]
            ]
        ],
        [
            "name"  => "管理员管理",
            "code"  => "admin",
            "rules" => [
                [
                    "method" => "ALL",
                    "url"    => "/admin"
                ]
            ]
        ],
        [
            "name"  => "操作日志",
            "code"  => "operation_log",
            "rules" => [
                [
                    "method" => "ALL",
                    "url"    => "/operation-log"
                ]
            ]
        ]
    ];
    protected $menuData = [
        [
            "id"        => 1,
            "name"      => "系统管理",
            "url"       => "",
            "type"      => Menu::TYPE_DIR,
            "is_use"    => 1,
            "sort"      => 10,
            "icon"      => "layui-icon-set-fill",
            "parent_id" => 0
        ],
        [
            "name"      => "菜单管理",
            "url"       => "menu",
            "type"      => Menu::TYPE_INNER,
            "is_use"    => 1,
            "sort"      => 9,
            "icon"      => "",
            "parent_id" => 1
        ],
        [
            "name"      => "管理员管理",
            "url"       => "admin",
            "type"      => Menu::TYPE_INNER,
            "is_use"    => 1,
            "sort"      => 10,
            "icon"      => "",
            "parent_id" => 1
        ],
        [
            "name"      => "角色管理",
            "url"       => "group",
            "type"      => Menu::TYPE_INNER,
            "is_use"    => 1,
            "sort"      => 8,
            "icon"      => "",
            "parent_id" => 1
        ],
        [
            "name"      => "权限节点管理",
            "url"       => "role",
            "type"      => Menu::TYPE_INNER,
            "is_use"    => 1,
            "sort"      => 1,
            "icon"      => "",
            "parent_id" => 1
        ],
        [
            "name"      => "操作记录",
            "url"       => "operation-log",
            "type"      => Menu::TYPE_INNER,
            "is_use"    => 1,
            "sort"      => 0,
            "icon"      => "",
            "parent_id" => 1
        ],
        [
            "id"        => 10,
            "name"      => "帮助",
            "type"      => Menu::TYPE_DIR,
            "is_use"    => 1,
            "sort"      => 0,
            "icon"      => "layui-icon-help",
            "parent_id" => 0
        ],
        [
            "name"      => "项目主页",
            "url"       => "https://github.com/kphcdr/axeadmin-laravel",
            "type"      => Menu::TYPE_LINK,
            "is_use"    => 1,
            "sort"      => 0,
            "icon"      => "layui-icon-home",
            "parent_id" => 10
        ],
        [
            "name"      => "常见问题",
            "url"       => "https://github.com/kphcdr/axeadmin-laravel/blob/master/QA.md",
            "type"      => Menu::TYPE_LINK,
            "is_use"    => 1,
            "sort"      => 0,
            "icon"      => "layui-icon-help",
            "parent_id" => 10
        ],
        [
            "name"      => "问题与建议",
            "url"       => "https://github.com/kphcdr/axeadmin-laravel/issues",
            "type"      => Menu::TYPE_LINK,
            "is_use"    => 1,
            "sort"      => 0,
            "icon"      => "layui-icon-help",
            "parent_id" => 10
        ],
        [
            "name"      => "捐赠我们",
            "url"       => "https://github.com/kphcdr/axeadmin-laravel/issues",
            "type"      => Menu::TYPE_LINK,
            "is_use"    => 1,
            "sort"      => 0,
            "icon"      => "layui-icon-help",
            "parent_id" => 10
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::truncate();
        GroupRole::truncate();
        Role::truncate();
        Menu::truncate();
        Admin::truncate();
        OperationLog::truncate();
        $group = Group::create(
            [
                "name" => "SuperUser",
                "desc" => "Default group"
            ]);

        foreach ($this->roleData as $roledata) {
            $role = Role::create($roledata);

            GroupRole::create([
                "group_id" => $group->id,
                "role_id"  => $role->id
            ]);
        }

        Admin::create([
            "name"     => "admin",
            "password" => "admin",
            "group_id" => $group->id
        ]);

        foreach ($this->menuData as $menu) {
            Menu::create($menu);
        }
    }
}
