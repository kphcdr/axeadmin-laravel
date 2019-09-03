<?php

namespace Axe\Models;

class OperationLog extends AxeModel
{
    protected $table = 'axe_operation_logs';

    protected $fillable = ['admin_id', 'method', 'extra_data', 'url'];

    protected $casts = [
        'extra_data' => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
