@extends('admin.layouts.admin')

@section('title','文章列表')

@section('css')
@endsection

@section('content')
    <blockquote class="layui-elem-quote">
        <div class="demoTable">
            搜索ID：
            <div class="layui-inline">
                <input class="layui-input" name="id" id="demoReload" autocomplete="off">
            </div>
            <button class="layui-btn" data-type="reload">搜索</button>
            <button class="layui-btn" data-type="getCheckData">获取选中行数据</button>
            <button class="layui-btn" data-type="getCheckLength">获取选中数目</button>
            <button class="layui-btn" data-type="isAll">验证是否全选</button>
        </div>

    </blockquote>

    <table class="layui-hide" id="LAY_table_article" lay-filter="article"></table>

@endsection

@section('js')
<script>
    layui.use('table', function(){
        var table = layui.table;

        //方法级渲染
        table.render({
            elem: '#LAY_table_article'
            ,id:'idTest'
            ,url: '/demo/table/article.json'
            ,cols: [[
                {checkbox: true, fixed: true}
                ,{field:'id', title: 'ID', width:80, sort: true, fixed: true}
                ,{field:'username', title: '用户名', width:80}
                ,{field:'sex', title: '性别', width:80, sort: true}
                ,{field:'city', title: '城市', width:80}
                ,{field:'sign', title: '签名', width:177}
                ,{field:'experience', title: '积分', sort: true, width:80}
                ,{field:'score', title: '评分', sort: true, width:80}
                ,{field:'classify', title: '职业', width:80}
                ,{field:'wealth', title: '财富', sort: true, width:135}
                ,{fixed: 'right', width:160, align:'center', toolbar: '#barDemo'}
            ]]
            ,id: 'testReload'
            ,page: true
        });

        var $ = layui.$, active = {
            reload: function(){
                var demoReload = $('#demoReload');

                table.reload('testReload', {
                    where: {
                        key: {
                            id: demoReload.val()
                        }
                    }
                });
            }
        };

        //监听工具条
        table.on('tool(article)', function(obj){
            var data = obj.data;
            if(obj.event === 'detail'){
                layer.msg('ID：'+ data.id + ' 的查看操作');
            } else if(obj.event === 'del'){
                layer.confirm('真的删除行么', function(index){
                    obj.del();
                    layer.close(index);
                });
            } else if(obj.event === 'edit'){
                layer.alert('编辑行：<br>'+ JSON.stringify(data))
            }
        });

        var $ = layui.$, active = {
            getCheckData: function(){ //获取选中数据
                var checkStatus = table.checkStatus('idTest')
                    ,data = checkStatus.data;
                layer.alert(JSON.stringify(data));
            }
            ,getCheckLength: function(){ //获取选中数目
                var checkStatus = table.checkStatus('idTest')
                    ,data = checkStatus.data;
                layer.msg('选中了：'+ data.length + ' 个');
            }
            ,isAll: function(){ //验证是否全选
                var checkStatus = table.checkStatus('idTest');
                layer.msg(checkStatus.isAll ? '全选': '未全选')
            }
        };

        $('.demoTable .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
    <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
</script>
@endsection