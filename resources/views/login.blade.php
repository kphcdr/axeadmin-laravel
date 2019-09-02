<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config("axe.name") }}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset("axestatic/layui/css/layui.css") }}" media="all">
    <link rel="stylesheet" href="{{ asset("axestatic/style/admin.css") }}" media="all">
    <link rel="stylesheet" href="{{ asset("axestatic/style/login.css") }}" media="all">
</head>
<body>
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>{{ config("axe.name") }}</h2>
        </div>
        <form class="am-form tpl-form-border-form" id="am-form" data-am-validator onsubmit="return false;">
            <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-username" for="LAY-user-login-username"></label>
                    <input type="text" name="name" id="LAY-user-login-name" lay-verify="required" placeholder="用户名" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="layadmin-user-login-icon layui-icon layui-icon-password" for="LAY-user-login-password"></label>
                    <input type="password" name="password" id="LAY-user-login-password" lay-verify="required" placeholder="密码" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
                </div>
            </div>
        </form>
    </div>
    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2019 <a href="http://www.layui.com/" target="_blank">layui.com</a></p>
    </div>
</div>
<script src="{{ asset("axestatic/layui/layui.js") }}"></script>
<script>
    layui.config({
        base: '/axestatic/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'user'], function(){
        var $ = layui.$
            ,admin = layui.admin
            ,form = layui.form;
        form.render();
        //提交
        form.on('submit(LAY-user-login-submit)', function(obj){
            admin.__AJAX__({
                type:"post",
                url:"{{axe_url("login")}}",
                data:$('#am-form').serialize(),
                dataType:"json",
                success:function(data){
                    if (data.ret) {
                        layer.msg(data.message, {
                            icon: 1,
                            time: 2000
                        });
                        if(window != top) {
                            top.location.href = "{{ axe_url() }}";
                        } else {
                            window.location.href = "{{ axe_url() }}"
                        }
                    } else {
                        layer.msg(data.message, {
                            icon: 2,
                            time: 2000
                        });
                    }
                }
            });
        });
    });
</script>
</body>
</html>