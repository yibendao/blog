<div class="layui-body">
    <div class="layui-row">
        <span class="layui-breadcrumb">
          <a href="">首页</a>
          @yield('breadcrumb')
          <a><cite>@yield('title')</cite></a>
        </span>
    </div>
    <!-- 内容主体区域 -->
    <div class="content">
    @yield('content')
    </div>
</div>
