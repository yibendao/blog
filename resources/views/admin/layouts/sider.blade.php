<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            <li class="layui-nav-item"><a href="{{url('admin')}}"><i class="layui-icon" style="font-size: 17px;margin-right: 5px;">&#xe68e;</i>后台首页</a></li>
            <li class="layui-nav-item">
                <a class="" href="javascript:;"><i class="layui-icon" style="font-size: 18px;margin-right: 5px;">&#xe60a;</i>文章管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/article-list')}}">文章列表</a></dd>
                    <dd><a href="{{url('admin/article-create')}}">发布文章</a></dd>
                    <dd><a href="{{url('admin/article-category-list')}}">文章分类</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"><i class="layui-icon" style="font-size: 12px;margin-right: 5px;">&#xe613;</i>用户管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/member-list')}}">会员列表</a></dd>
                    <dd><a href="{{url('admin/member-vip-list')}}">用户列表</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="{{url('admin/site-manage')}}"><i class="layui-icon" style="font-size: 17px;margin-right: 5px;">&#xe620;</i>系统管理</a></li>
        </ul>
    </div>
</div>
