@extends('admin.layouts.admin')

@section('title','文章列表')

@section('css')
@endsection

@section('content')
    <blockquote class="layui-elem-quote">
        <div class="articleTable">
            搜索ID：
            <div class="layui-inline">
                <input class="layui-input" name="q" id="articleReload" autocomplete="off">
            </div>
            <button class="layui-btn" data-type="reload">搜索</button>
            <button class="layui-btn" data-type="getCheckData">获取选中行数据</button>
            <button class="layui-btn" data-type="getCheckLength">获取选中数目</button>
            <button class="layui-btn" data-type="isAll">验证是否全选</button>
        </div>

    </blockquote>
    <div class="layui-form">
        <table class="layui-table" id="LAY_table_article" lay-filter="article"></table>
    </div>
@endsection

@section('js')
<script>
    layui.use(['table','form'], function(){
        var token = document.head.querySelector('meta[name="csrf-token"]').content;

        var table = layui.table;
        var form = layui.form;
        //方法级渲染
        var tableIns = table.render({
            elem: '#LAY_table_article'
            ,id:'article-list'
            ,url: '{{url("admin/ajax?_model=Articles")}}'
            ,cols: [[
                {checkbox: true, fixed: true}
                ,{field:'id', title: 'ID', width:50, sort: true, fixed: true}
                ,{field:'title', title: '标题', width:200}
                ,{field:'author', title: '作者', width:100, sort: true}
//                ,{field:'src', title: '来源', sort: true, width:160}
                ,{field:'recom', title: '是否推荐', width:100,templet:'#recomSwitch'}
                ,{field:'top', title: '是否置顶', width:100,templet:'#topSwitch'}
                ,{field:'status', title: '状态', sort: true, width:80}
                ,{field:'created_at', title: '创建时间', width:160}
                ,{fixed: 'right', width:160, align:'center', toolbar: '#barDemo'}
            ]]
            ,page: true
        });

        //排序
        table.on('sort(article)',function (obj) {
            tableIns.reload({
                initSort:obj,
                where:{
                    sort:obj.field,
                    order:obj.type
                }
            });
        });

        //监听工具条
        table.on('tool(article)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.msg('ID：'+ data.id + ' 的查看操作');
            } else if(obj.event === 'del'){
                layer.confirm('确认删除？', function(index){
                    var id = obj.data.id;
                    $.ajax({
                        type:"DELETE",
                        url:"{{url('admin/ajax')}}/"+id+"?_model=Articles",
                        data:"_token="+token,
                        error:function () {
                            layer.msg("网络异常！");
                        },
                        success:function (resp) {
                            if(resp.success) {
                                layer.msg("删除成功！");
                                setTimeout(function () {
                                    tableIns.reload();
                                },1000);
                            } else {
                                layer.msg("删除失败！");
                            }
                        }
                    });
                });
            } else if(obj.event === 'edit'){
                layer.alert('编辑行：<br>'+ JSON.stringify(data))
            } else if(obj.event() === 'clo') {
                layer.msg('ID：'+ data.id + ' 的开关操作');
            }
        });


        var $ = layui.$, active = {
            reload:function () {
                var articleReload = $('#articleReload');
                tableIns.reload({
                    where: {
                        q: articleReload.val()
                    }
                });
            },
            getCheckData: function(){ //获取选中数据
                var checkStatus = table.checkStatus('article-list')
                    ,data = checkStatus.data;
                layer.alert(JSON.stringify(data));
            }
            ,getCheckLength: function(){ //获取选中数目
                var checkStatus = table.checkStatus('article-list')
                    ,data = checkStatus.data;
                layer.msg('选中了：'+ data.length + ' 个');
            }
            ,isAll: function(){ //验证是否全选
                var checkStatus = table.checkStatus('article-list');
                layer.msg(checkStatus.isAll ? '全选': '未全选')
            }
        };

        $('.layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        //是否展示
        form.on('switch(changeSwitch)', function(data){
            var type = $(this).attr('name');
            var status = data.elem.checked ? 'ON':'OFF';
            var id = $(this).data('id');
            $.ajax({
                type:"PUT",
                url:"{{url('admin/ajax')}}/"+ id +"?_model=Articles",
                data:"_token="+token+"&"+type+"="+status,
                beforeSend:function () {
                    layer.msg('修改中，请稍候',{icon: 16,time:false,shade:0.8});
                },
                error:function () {
                    layer.msg("网络异常！");
                },
                success:function (resp) {
                    if(resp.success) {
                        layer.msg("状态修改成功！");
                    } else {
                        layer.msg("状态修改失败！");
                    }
                }
            });
        });
    });
</script>
<script type="text/html" id="recomSwitch">
    <div class="layui-switch">
        <input type="checkbox" name="recom" lay-skin="switch" data-id="@{{ d.id }}" lay-filter="changeSwitch" lay-text="ON|OFF" @{{# if(d.recom=='ON') { }}checked@{{# } }}>
    </div>
</script>
<script type="text/html" id="topSwitch">
    <div class="layui-switch ">
        <input type="checkbox" name="top" lay-skin="switch" data-id="@{{ d.id }}" lay-filter="changeSwitch" lay-text="ON|OFF" @{{# if(d.top=='ON') { }}checked@{{# } }}>
    </div>
</script>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-mini" href="{{url('admin/article-edit')}}/@{{ d.id }}">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
</script>
@endsection