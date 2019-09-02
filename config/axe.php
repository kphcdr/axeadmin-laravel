<?php
return [
    "name" => "axe后台管理系统",
    "url"  => "axe",
    "ignore_rbac_route" => [
        "","/home"
    ],
    "operation_log"=>[
        "methods"=>["GET","POST","PUT","DELETE"]
    ]
];