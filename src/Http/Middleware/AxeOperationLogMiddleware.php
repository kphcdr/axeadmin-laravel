<?php


namespace Axe\Http\Middleware;


use Axe\Models\OperationLog;
use Closure;
use Illuminate\Http\Request;

class AxeOperationLogMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $admin = $request->attributes->get("admin");
        $method = $request->method();
        $operationMethodArr = config('axe.operation_log.methods');
        if (in_array($method, $operationMethodArr)) {
            OperationLog::create([
                "admin_id"   => $admin->id,
                "url"        => $request->fullUrl(),
                "method"     => $method,
                "extra_data" => $request->all()
            ]);
        }

        return $next($request);
    }
}