<?php


namespace Axe\Http\Middleware;


use Illuminate\Http\Request;

class AxeRbacMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        $admin = $request->attributes->get("admin");
        $myRole = $admin->group->roles;

        $prefix = config("axe.url");
        $method = $request->method();
        $path = str_replace_first($prefix, "", $request->path());
        $ignoreListArr = config("axe.ignore_rbac_route");
        //in ignoreList
        if (in_array($path, $ignoreListArr)) {
            return $next($request);
        }

        //has role
        foreach ($myRole as $role) {
            if ($role->checkPath($method, $path)) {
                return $next($request);
            }

        }
        return $this->fail();
    }

    private function fail()
    {
        return abort(405, "权限不足");

    }
}