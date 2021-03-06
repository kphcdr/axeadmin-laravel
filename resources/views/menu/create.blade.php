@extends('axe.layout.page')
@section('content')
    <!-- 内容区域 -->
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-header">创建顶级菜单</div>
            <div class="layui-card-body" style="padding: 15px;">
                <form class="layui-form" id="am-form" method="post" action="" lay-filter="component-form-group">
                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单类别</label>
                        <div class="layui-input-block">
                            <select name="type">
                                <option value="{{ \Axe\Models\Menu::TYPE_DIR }}">目录</option>
                                <option value="{{ \Axe\Models\Menu::TYPE_INNER }}">链接</option>
                                <option value="{{ \Axe\Models\Menu::TYPE_LINK }}">外链</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单名称</label>
                        <div class="layui-input-block">
                                <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入所属模块" value="" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">地址</label>
                        <div class="layui-input-block">
                            <input type="text" name="url" placeholder="链接地址" value="" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">icon</label>
                        <div class="layui-input-block">
                            <input type="text" name="icon" placeholder="请输入排序值" class="layui-input">
                            <span class="input-help">支持的icon,请<a href="https://www.layui.com/doc/element/icon.html" target="_blank">点击查看</a></span>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">排序值</label>
                        <div class="layui-input-block">
                            <input type="text" name="sort" lay-verify="required" placeholder="请输入排序值" value="10" class="layui-input">
                            <span class="input-help">排序值越大越靠前</span>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">是否可用</label>
                        <div class="layui-input-block">
                            <select name="is_use" >
                                <option value="1">可用</option>
                                <option value="0">禁用</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <div class="layui-footer">
                                <button class="layui-btn" lay-submit  lay-filter="submit_ajax">立即提交</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        layui.use(['index', 'form', 'laydate'], function(){
            var $ = layui.$
                ,admin = layui.admin
                ,form = layui.form;

            //提交表单
            form.on('submit(submit_ajax)', function(data){
                admin.__AJAX__({
                    url:'{{axe_url("menu")}}',
                    type: "POST",
                    data: $('#am-form').serialize(),
                    dataType: "json",
                    success: function (data) {
                        if (data.ret) {
                            parent.layer.msg(data.message, {time: 1200},function(){
                                window.parent.location.reload();
                            })
                        } else {
                            parent.layer.alert(data.message);
                        }
                    },
                    error: function () {
                        parent.layer.msg('网络错误，请稍后再试');
                    }
                })

                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

        });
    </script>
@endsection