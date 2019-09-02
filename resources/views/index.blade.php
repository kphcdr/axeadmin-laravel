<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config("axe.name") }}</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ asset("axestatic/layui/css/layui.css") }}" media="all">
    <link rel="stylesheet" href="{{ asset("axestatic/style/admin.css") }}" media="all">
    <script>
        /^http(s*):\/\//.test(location.href) || alert('请先部署到 localhost 下再访问');
    </script>
</head>
<body class="layui-layout-body">
<div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- 头部区域 -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item layadmin-flexible" >
                    <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                        <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                    </a>
                </li>
                <li class="layui-nav-item" >
                    <a href="javascript:;" layadmin-event="refresh" title="刷新">
                        <i class="layui-icon layui-icon-refresh-3"></i>
                    </a>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
                <li class="layui-nav-item layui-hide-xs" >
                    <a href="javascript:;" layadmin-event="note">
                        <i class="layui-icon layui-icon-note"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" >
                    <a href="javascript:;" layadmin-event="fullscreen">
                        <i class="layui-icon layui-icon-screen-full"></i>
                    </a>
                </li>
                <li class="layui-nav-item" style="margin-right: 10px;">
                    <a href="javascript:;">
                        <cite>{{ session("axe_name")}}</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd style="text-align: center;"><a href="{{ axe_url("logout") }}">退出登录</a></dd>
                    </dl>
                </li>
            </ul>
        </div>

        <!-- 侧边菜单 -->
        <div class="layui-side layui-side-menu">
            <div class="layui-side-scroll">
                <div class="layui-logo" lay-href="home/console.html">
                    <span>{{ config("axe.name") }}</span>
                </div>

                <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
                    lay-filter="layadmin-system-side-menu">
                    <li data-name="index" class="layui-nav-item layui-this">
                            <a lay-href="{{ axe_url("index") }}" >
                                <i class="layui-icon layui-icon-home"></i>
                                <cite>首页</cite>
                            </a>
                    </li>
                    {{ $menus = app(\Axe\Models\Menu::class)->getCanUseTree() }}
                    @foreach($menus as $menu)
                        <li data-name="{{ $menu['model']->id }}" class="layui-nav-item">
                            @switch($menu['model']->type)
                                @case(\Axe\Models\Menu::TYPE_DIR)
                                <a href="javascript:;" >
                                    <i class="layui-icon {{ $menu['model']->icon }}"></i>
                                    <cite>{{ $menu['model']->name }}</cite>
                                </a>
                                @break
                                @case(\Axe\Models\Menu::TYPE_INNER)
                                <a lay-href="{{ axe_url($menu['model']->url) }}" >
                                    <i class="layui-icon {{ $menu['model']->icon }}"></i>
                                    <cite>{{ $menu['model']->name }}</cite>
                                </a>
                                @break
                                @case(\Axe\Models\Menu::TYPE_LINK)
                                <a href="{{ $menu['model']->url }}" target="_blank">
                                    <i class="layui-icon {{ $menu['model']->icon }}"></i>
                                    <cite>{{ $menu['model']->name }}</cite>
                                </a>
                                @break
                            @endswitch

                            @if($menu['child'])
                                <dl class="layui-nav-child">
                                    @foreach($menu['child'] as $child)
                                        <dd data-name="{{ $child->url }}">
                                            @switch($child->type)
                                                @case(\Axe\Models\Menu::TYPE_INNER)
                                                <a lay-href="{{ axe_url($child->url) }}">{{ $child->name }}</a>
                                                @break
                                                @case(\Axe\Models\Menu::TYPE_LINK)
                                                <a href="{{ $child->url }}" target="_blank">{{ $child->name }}</a>
                                                @break
                                            @endswitch
                                        </dd>
                                    @endforeach
                                </dl>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- 页面标签 -->
        <div class="layadmin-pagetabs" id="LAY_app_tabs">
            <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-down">
                <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
                    <li class="layui-nav-item" >
                        <a href="javascript:;"></a>
                        <dl class="layui-nav-child layui-anim-fadein">
                            <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                            <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                            <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                <ul class="layui-tab-title" id="LAY_app_tabsheader">
                    <li lay-id="/axe/index" lay-attr="{{ axe_url("home") }}" class="layui-this"><i
                                class="layui-icon layui-icon-home"></i></li>
                </ul>
            </div>
        </div>


        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body">
            <div class="layadmin-tabsbody-item layui-show">
                <iframe src="{{ axe_url("home") }}" frameborder="0" class="layadmin-iframe"></iframe>
            </div>
        </div>

        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
</div>

<script src="{{asset("axestatic/layui/layui.js")}}"></script>
<script>
    layui.config({
        base: '../axestatic/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use('index');
</script>

</body>
</html>