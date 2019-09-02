<?php

namespace Axe\Http\Controllers;

use Axe\Models\OperationLog;
use Illuminate\Database\Eloquent\Model;

class OperationLogController extends AuthController
{
    protected $viewGroup = "operation_log";

    public function getModel(): Model
    {
        return app(OperationLog::class);
    }
}
