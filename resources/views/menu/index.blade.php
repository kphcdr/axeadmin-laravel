@extends('axe::layout.page')
@section('content')
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">菜单管理</div>
                <div class="layui-card-body">
                    <div class="layui-form layui-border-box layui-table-view">
                        <div class="layui-table-tool">
                            <div class="layui-table-tool-temp">
                                <div class="test-table-reload-btn" style="margin-bottom: 10px;">
                                    <button type="button" class="layui-btn axe-create" >新建</button>
                                </div>
                            </div>
                        </div>
                        <div class="layui-table-box">
                            <div class="layui-table-body layui-table-main">
                                <table class="layui-table" id="layui-table-width-auto">
                                    <thead>
                                    <tr>
                                        <th><div class="layui-table-cell">菜单名称</div></th>
                                        <th><div class="layui-table-cell">是否可见</div></th>
                                        <th><div class="layui-table-cell">排序值</div></th>
                                        <th><div class="layui-table-cell">操作</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $a)
                                        <tr class="gradeX" data-id="{{ $a['model']->id }}">
                                            <td><div class="layui-table-cell">{{ $a['model']->name }}</div></td>
                                            <td><div class="layui-table-cell">
                                                    @switch($a['model']->is_use)
                                                        @case(1) <span class="layui-badge layui-bg-gray">可用</span> @break
                                                        @case(0) <span class="layui-badge layui-bg-warn">禁用</span> @break
                                                    @endswitch</div></td>
                                            <td><div class="layui-table-cell">{{ $a['model']->sort }}</div></td>
                                            <td><div class="layui-table-cell"><a class="axe-edit layui-btn layui-btn-normal layui-btn-xs"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                                                    <a class="axe-delete layui-btn layui-btn-warm layui-btn-xs"><i class="layui-icon layui-icon-delete"></i>删除</a>
                                                </div></td>
                                        </tr>
                                        @if($a['child'])
                                            @foreach($a['child'] as $child)
                                            <tr class="gradeX" data-id="{{ $child->id }}">
                                                <td><div class="layui-table-cell"><i class="layui-icon layui-icon-right"></i>{{ $child->name }}</div></td>
                                                <td><div class="layui-table-cell">
                                                        @switch($child->is_use)
                                                            @case(1) <span class="layui-badge layui-bg-gray">可用</span> @break
                                                            @case(0) <span class="layui-badge layui-bg-warn">禁用</span> @break
                                                        @endswitch</div></td>
                                                <td><div class="layui-table-cell">{{ $child->sort }}</div></td>
                                                <td><div class="layui-table-cell"><a class="axe-edit layui-btn layui-btn-normal layui-btn-xs"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                                                        <a class="axe-delete layui-btn layui-btn-warm layui-btn-xs"><i class="layui-icon layui-icon-delete"></i>删除</a>
                                                    </div></td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                <!-- more data -->
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    layui.use(['index', 'table'], function(){
        var $ = layui.jquery
            ,admin = layui.admin;
        $(".axe-create").click(function () {
            admin.openWindows("新建", "{{axe_url('menu/create')}}")
        });

        //edit
        $(".axe-edit").click(function (e) {
            var id = $(this).parents("tr").attr("data-id");
            admin.openWindows("编辑", "{{axe_url('menu/')}}"+id+"/edit")
        });

        $(".axe-delete").click(function (e) {
            var id = $(this).parents("tr").attr("data-id");
            layer.confirm('确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                admin.__AJAX__({
                    "type":"DELETE",
                    "url":"{{axe_url("menu")}}/" +id,
                })
            });
        });
    });
</script>
@endsection