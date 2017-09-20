<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
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
  {{--@include('admin.layouts.footer')--}}

</div>
{{--<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>--}}
{{--<script src="https://cdn.bootcss.com/jquery.form/4.2.2/jquery.form.min.js"></script>--}}
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery.form.min.js')}}"></script>
<script src="{{asset('js/layer/layer.js')}}"></script>
<script src="{{asset('layui/layui.js')}}"></script>
<script src="{{asset('js/common.js')}}"></script>
@yield('js')
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});

</script>

</body>
</html>