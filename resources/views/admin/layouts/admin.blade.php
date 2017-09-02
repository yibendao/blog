<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>BLOG后台管理 - @yield('title')</title>
<link rel="stylesheet" href="{{asset('layui/css/layui.css')}}">
<link rel="stylesheet" href="{{asset('dist/css/css.css')}}">
<link rel="stylesheet" href="{{asset('css/common.css')}}">
  @yield('css')
</head>
<body>
<div class="layui-layout layui-layout-admin">
  {{--头部--}}
  @include('admin.layouts.header')

  {{--侧边导航菜单--}}
  @include('admin.layouts.sider')

  {{--内容区--}}
  @include('admin.layouts.main')

  {{--尾部区--}}
  @include('admin.layouts.footer')

</div>
<script src="{{asset('layui/layui.js')}}"></script>
@yield('js')
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});

</script>

</body>
</html>