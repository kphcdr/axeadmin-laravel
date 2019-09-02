@extends('axe.layout.page')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">角色管理</div>
                    <div class="layui-card-body">
                        <div class="layui-form layui-border-box layui-table-view">
                            <div class="layui-table-tool">
                                <div class="layui-table-tool-temp">
                                    <div class="test-table-reload-btn" style="margin-bottom: 10px;">
                                        <button type="button" class="layui-btn axe-create">新建</button>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-table-box">
                                <div class="layui-table-body layui-table-main">
                                    <table class="layui-table" id="layui-table-width-auto">
                                        <thead>
                                        <tr>
                                            <th>
                                                <div class="layui-table-cell">ID</div>
                                            </th>
                                            <th>
                                                <div class="layui-table-cell">名称</div>
                                            </th>
                                            <th>
                                                <div class="layui-table-cell">描述</div>
                                            </th>
                                            <th>
                                                <div class="layui-table-cell">动作组</div>
                                            </th>
                                            <th>
                                                <div class="layui-table-cell">创建时间</div>
                                            </th>
                                            <th>
                                                <div class="layui-table-cell">更新时间</div>
                                            </th>
                                            <th>
                                                <div class="layui-table-cell">操作</div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $a)
                                            <tr class="gradeX" data-id="{{ $a->id }}">
                                                <td>
                                                    <div class="layui-table-cell">{{ $a->id }}</div>
                                                </td>
                                                <td>
                                                    <div class="layui-table-cell">{{ $a->name }}</div>
                                                </td>
                                                <td>
                                                    <div class="layui-table-cell">{{ $a->desc }}</div>
                                                </td>
                                                <td>
                                                    <div class="layui-table-cell">
                                                        @foreach($a->groupRole as $v)
                                                            <li class="intd"><span class="layui-badge layui-bg-gray">{{$v->role->name??"已删除"}}</span></li>
                                                            @endforeach
                                                            </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="layui-table-cell">{{ $a->created_at }}</div>
                                                </td>
                                                <td>
                                                    <div class="layui-table-cell">{{ $a->updated_at }}</div>
                                                </td>

                                                <td>
                                                    <div class="layui-table-cell">
                                                        <a class="axe-edit layui-btn layui-btn-normal layui-btn-xs"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                                                        <a class="axe-delete layui-btn layui-btn-warm layui-btn-xs"><i class="layui-icon layui-icon-delete"></i>删除</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="layui-table-page">
                                {{ $list->links("axe.pagination",request()->all()) }}
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
        layui.use(['index', 'table'], function () {
            var $ = layui.jquery
                , admin = layui.admin

            //create
            $(".axe-create").click(function () {
                admin.openWindows("新建", "{{axe_url('group/create')}}")
            });

            //edit
            $(".axe-edit").click(function (e) {
                var id = $(this).parents("tr").attr("data-id");
                admin.openWindows("编辑", "{{axe_url('group/')}}"+id+"/edit")
            });
            $(".axe-delete").click(function (e) {
                var id = $(this).parents("tr").attr("data-id");
                layer.confirm('确定要删除吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    admin.__AJAX__({
                        "type":"DELETE",
                        "url":"{{axe_url("group")}}/" +id,
                    })
                });
            });
        });
    </script>
@endsection