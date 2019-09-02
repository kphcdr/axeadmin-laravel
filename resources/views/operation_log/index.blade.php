@extends('axe::layout.page')
@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">操作记录</div>
                    <div class="layui-card-body">
                        <div class="layui-form layui-border-box layui-table-view">
                            <div class="layui-table-box">
                                <div class="layui-table-body layui-table-main">
                                    <table class="layui-table" id="layui-table-width-auto">
                                        <thead>
                                        <tr>
                                            <th><div class="layui-table-cell">操作时间</div></th>
                                            <th><div class="layui-table-cell">操作管理员</div></th>
                                            <th><div class="layui-table-cell">地址</div></th>
                                            <th><div class="layui-table-cell">数据</div></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $a)
                                            <tr class="gradeX" data-id="{{ $a->id }}">
                                                <td><div class="layui-table-cell">{{ $a->created_at }}</div></td>
                                                <td><div class="layui-table-cell">{{ $a->admin->name??"已删除管理员" }}</div></td>
                                                <td><div class="layui-table-cell"><span class="layui-badge layui-bg-gray">{{$a->method}}</span>{{ $a->url }}</div></td>
                                                <td><div class="layui-table-cell">{{ json_encode($a->extra_data) }}</div></td>
                                            </tr>
                                        @endforeach
                                        <!-- more data -->
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="layui-table-page">
                                {{ $list->links("axe::pagination",request()->all()) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection