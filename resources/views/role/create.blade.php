@extends('axe::layout.page')
@section('content')
    <!-- 内容区域 -->
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-header">编辑权限组</div>
            <div class="layui-card-body" style="padding: 15px;">
                <form class="layui-form" lay-filter="component-form-group">
                    <div class="layui-form-item">
                        <label class="layui-form-label">名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" lay-verify="required" placeholder="请输入名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">标识</label>
                        <div class="layui-input-block">
                            <input type="text" name="code" lay-verify="required" placeholder="请输入标识" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item" id="add-line-box">
                        <label class="layui-form-label">权限</label>
                        <div class="layui-input-block layui-col-space10">
                            <div class="layui-col-md2">
                                <select name="method[]" >
                                    <option selected>ALL</option>
                                    <option>GET</option>
                                    <option>POST</option>
                                    <option>PUT</option>
                                    <option>DELETE</option>
                                </select>
                            </div>
                            <div class="layui-col-md7">
                                <input type="text" name="url[]" placeholder="链接地址" class="layui-input">
                            </div>
                            <div class="layui-col-md1 layui-btn-container layui-col-md-offset1">
                                <button type="button" class="layui-btn layui-btn-normal add-line"><i class="layui-icon layui-icon-add-1"></i>增加一行</button>
                            </div>
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
                , element = layui.element
                , layer = layui.layer
                , laydate = layui.laydate
                , upload = layui.upload
                , form = layui.form;
            //提交表单
            form.on('submit(submit_ajax)', function (data) {
                admin.__AJAX__({
                    url: '{{axe_url("role")}}',
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

            $(".add-line").click(function(){
                var html = '<div class="layui-input-block layui-col-space10">'
                    +'<div class="layui-col-md2">'
                    +'<select name="method[]" >'
                    +'<option selected>ALL</option>'
                    +'<option>GET</option>'
                    +'<option>POST</option>'
                    +'<option>PUT</option>'
                    +'<option>DELETE</option>'
                    +'</select>'
                    +'</div>'
                    +'<div class="layui-col-md10">'
                    +'<input type="text" name="url[]" placeholder="链接地址" class="layui-input">'
                    +'</div>'
                    +'</div>';
                $("#add-line-box").append(html);
                form.render();
            })

        });
    </script>
@endsection