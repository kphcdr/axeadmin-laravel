<?php


namespace Axe\Http\Middleware;


use Axe\Models\Axe;
use Illuminate\Http\Request;

class AxeAuthMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        if ($axeId = session("axe_id")) {
            $axe = Axe::findOrFail($axeId);
            $request->attributes->set("admin",$axe);
            return $next($request);
        } else {
            return redirect(axe_url("login"));
        }
    }
}