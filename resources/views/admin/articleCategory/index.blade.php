@extends('admin.layouts.admin')

@section('title','文章分类列表')

@section('css')
@endsection

@section('content')
    <blockquote class="layui-elem-quote">
        <div class="articleTable">
            <div class="layui-inline">
                <input class="layui-input" name="q" id="search" autocomplete="off">
            </div>
            <button class="layui-btn" data-type="search"><i class="layui-icon">&#xe615;</i> 搜索</button>
            <button class="layui-btn  layui-btn-danger" data-type="delAll"><i class="layui-icon">&#xe640;</i> 删除选中行</button>
            <button class="layui-btn" data-type="add"><i class="layui-icon">&#xe654;</i> 新增分类</button>
        </div>

    </blockquote>
    <div class="layui-form">
        <table class="layui-table" id="LAY_table_article_categories" lay-filter="articleCategories"></table>
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
                elem: '#LAY_table_article_categories'
                ,id:'article-categories-list'
                ,url: '{{url("admin/ajax?_model=ArticleCategories")}}'
                ,cols: [[
                    {checkbox: true, fixed: true}
                    ,{field:'id', title: 'ID', width:100, sort: true, fixed: true}
                    ,{field:'name', title: '分类名称', width:300}
                    ,{field:'created_at', title: '创建时间',sort: true, width:200}
                    ,{fixed: 'right', width:200, align:'center', toolbar: '#barDemo'}
                ]]
                ,page: true
            });

            //排序
            table.on('sort(articleCategories)',function (obj) {
                tableIns.reload({
                    initSort:obj,
                    where:{
                        sort:obj.field,
                        order:obj.type
                    }
                });
            });

            //监听工具条
            table.on('tool(articleCategories)', function(obj){
                var data = obj.data;
                if(obj.event === 'del'){
                    layer.confirm('确认删除？', function(index){
                        var id = obj.data.id;
                        $.ajax({
                            type:"DELETE",
                            url:"{{url('admin/ajax')}}/"+id+"?_model=ArticleCategories",
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
                search:function () { //搜索
                    var articleReload = $('#search');
                    tableIns.reload({
                        where: {
                            q: articleReload.val()
                        }
                    });
                },
                delAll: function(){ //删除选中数据
                    layer.confirm('确认删除？',function () {
                        var checkStatus = table.checkStatus('article-categories-list')
                            ,data = checkStatus.data;
                        var ids = getIdFromTable(data);
                        ajaxDel("{{url('admin/ajax/destroyAll?_model=ArticleCategories')}}",{_token:token,ids:ids},"POST");
                        table.reload('article-categories-list');
                    });
                },
                add:function () {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['420px', '240px'], //宽高
                        content: 'html内容'
                    });
                }
            };

            $('.layui-btn').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });

        });
    </script>

    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-mini" href="{{url('admin/article-edit')}}/@{{ d.id }}">编辑</a>
        <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
    </script>
@endsection