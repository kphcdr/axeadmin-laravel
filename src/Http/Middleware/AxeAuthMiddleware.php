<?php


namespace Axe\Http\Middleware;


use Axe\Models\Admin;
use Closure;
use Illuminate\Http\Request;

class AxeAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($axeId = session("axe_id")) {
            $axe = Admin::findOrFail($axeId);
            $request->attributes->set("admin", $axe);
            return $next($request);
        } else {
            return redirect(axe_url("login"));
        }
    }
}