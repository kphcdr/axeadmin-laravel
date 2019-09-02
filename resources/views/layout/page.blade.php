<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ asset("axestatic/layui/css/layui.css") }}" media="all">
    <link rel="stylesheet" href="{{ asset("axestatic/style/admin.css") }}" media="all">
</head>
<body>
@yield('content')
<script src="/axestatic/layui/layui.js"></script>
<script>
    layui.config({
        base: '/axestatic/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    });
</script>
@yield('script')
</body>
</html>