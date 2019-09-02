@extends('axe::layout.page')
@section('content')
    <!-- 内容区域 -->
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-header">新建角色</div>
            <div class="layui-card-body" style="padding: 15px;">
                <form class="layui-form" lay-filter="component-form-group">
                    <div class="layui-form-item">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="required" placeholder="请输入名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">描述</label>
                        <div class="layui-input-block">
                            <input type="text" name="desc" placeholder="请输入描述" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">权限节点</label>
                        <div class="layui-input-block">
                            @foreach(\Axe\Models\Role::getAllName() as $id=>$name)
                            <input type="checkbox" name="roles[]" title="{{ $name }}" value="{{ $id }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <div class="layui-footer" style="left: 0;">
                                <button class="layui-btn" lay-submit lay-filter="submit_ajax">立即提交</button>
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
        layui.use(['index', 'form'], function () {
            var $ = layui.$
                , admin = layui.admin
                , form = layui.form;
            //提交表单
            form.on('submit(submit_ajax)', function (data) {
                admin.__AJAX__({
                    url: '{{axe_url("group")}}',
                    type: "POST",
                    data: $('.layui-form').serialize(),
                    dataType: "json",
                    success: function (data) {
                        if (data.ret) {
                            parent.layer.msg(data.message, {time: 500}, function () {
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