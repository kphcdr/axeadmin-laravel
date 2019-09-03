<?php

return [
    //显示在登录页面,web title 的文字
    'name'              => 'axe管理后台',
    //网址后的url, 如 xxx.com/axe
    'url'               => 'axe',
    //忽略rbac控制的地址
    'ignore_rbac_route' => [
        '', '/home',
    ],
    //自动记录操作
    'operation_log'     => [
        //只会记录以下的method方法
        'methods' => ['POST', 'PUT', 'DELETE'],
    ],
];
