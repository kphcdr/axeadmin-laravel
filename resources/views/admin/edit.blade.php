@extends('axe.layout.page')
@section('content')
    <!-- 内容区域 -->
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-header">修改管理员</div>
            <div class="layui-card-body" style="padding: 15px;">
                <form class="layui-form" lay-filter="component-form-group">
                    <div class="layui-form-item">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入名称" class="layui-input" value=" {{ $data->name }}" readonly>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">密码</label>
                        <div class="layui-input-block">
                            <input type="password" name="password" placeholder="不修改密码请留空" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">所属角色</label>
                        <div class="layui-input-block">
                            <select name="group_id" >
                                @foreach(\Axe\Models\Group::getAllName() as  $id => $name)
                                <option value="{{ $id }}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">是否可用</label>
                        <div class="layui-input-block">
                            <select name="is_use" >
                                    <option @if($data->is_use == 1) selected @endif value="1">可用</option>
                                    <option @if($data->is_use == 0) selected @endif value="0">禁用</option>
                            </select>
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
                , form = layui.form
                , id = {{ $data->id }};
            //提交表单
            form.on('submit(submit_ajax)', function (data) {
                admin.__AJAX__({
                    url: '{{axe_url("admin/")}}' + id ,
                    type: "PUT",
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