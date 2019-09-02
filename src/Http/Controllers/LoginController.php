<?php

namespace Axe\Http\Controllers;

use Axe\Events\AdminLoginSuccessEvent;
use Axe\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends BaseController
{
    public function getLogin()
    {
        return $this->vendorView("login");
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,[
            "name"=>"required",
            "password"=>"required",
        ]);
        $admin = Admin::whereName($request->input("name"))->first();
        if($admin) {
            if($admin->checkPassword($request->input("password"))) {
                if($admin->is_use == 0) {
                    return $this->vendorJson(false,null,"账号已禁用");
                }
                AdminLoginSuccessEvent::dispatch($admin);

                return $this->vendorJson(true,null,"登录成功");
            } else {
                return $this->vendorJson(false, null, "账号密码错误");
            }
        }
        return $this->vendorJson(false, null, "登录失败");
    }

    public function getLogout()
    {
        Session::flush();

        return redirect(axe_url("login"));
    }
}