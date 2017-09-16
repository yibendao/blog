@extends('admin.layouts.admin')

@section('title','创建文章')

@section('css')
@endsection

@section('content')
    <form class="layui-form" action="{{url('admin/article-store')}}" method="post">
        {{csrf_field()}}
        <div class="layui-form-item">
            <label class="layui-form-label">文章标题</label>
            <div class="layui-input-block">
                <input type="text" name="title" value="{{$item->title}}" lay-verify="title" autocomplete="off" placeholder="请输入文章标题" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item ">
            <label class="layui-form-label">文章封面</label>
            <div class="layui-input-block">
                <img src="" alt="" class="layui-pic">
                {{--<div  >--}}
                    {{--<i class="layui-icon"></i>--}}
                <a href="#" id="remove-article-pic">移除</a>
                <a href="#" id="upload-article-pic">点击上传</a>
                    {{--<p id="upload-article-pic">点击上传</p>--}}
                {{--</div>--}}
                <input type="hidden" name="pic_id" autocomplete="off" value="" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">文章作者</label>
            <div class="layui-input-block">
                <input type="text" name="author" lay-verify="required" placeholder="请输入文章作者" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">发布时间</label>
            <div class="layui-input-inline">
                <input type="text" name="created_at" id="date" lay-verify="date" placeholder="请选择发布时间" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">文章来源</label>
            <div class="layui-input-block">
                <input type="text" name="src" placeholder="请输入文章来源" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">文章类型</label>
            <div class="layui-input-block">
                <select name="category_id" lay-verify="required" lay-search="">
                    <option value="">请选择文章类型</option>
                    <option value="1">layer</option>
                    <option value="2">form</option>
                    <option value="3">layim</option>
                    <option value="4">element</option>
                    <option value="5">laytpl</option>
                    <option value="6">upload</option>
                    <option value="7">laydate</option>
                    <option value="8">laypage</option>
                    <option value="9">flow</option>
                    <option value="10">util</option>
                    <option value="11">code</option>
                    <option value="12">tree</option>
                    <option value="13">layedit</option>
                    <option value="14">nav</option>
                    <option value="15">tab</option>
                    <option value="16">table</option>
                    <option value="17">select</option>
                    <option value="18">checkbox</option>
                    <option value="19">switch</option>
                    <option value="20">radio</option>
                </select>
            </div>
        </div>

        {{--<div class="layui-form-item">--}}
            {{--<label class="layui-form-label">文章标签</label>--}}
            {{--<div class="layui-input-block">--}}
                {{--<input type="checkbox" name="like[write]" title="写作">--}}
                {{--<input type="checkbox" name="like[read]" title="阅读" checked="">--}}
                {{--<input type="checkbox" name="like[game]" title="游戏">--}}
            {{--</div>--}}
        {{--</div>--}}



        <div class="layui-form-item" pane="">
            <label class="layui-form-label">是否推荐</label>
            <div class="layui-input-block">
                <input type="checkbox" name="recom" lay-skin="switch" lay-text="ON|OFF" lay-filter="switchTest">
            </div>
        </div>

        <div class="layui-form-item" pane="">
            <label class="layui-form-label">是否置顶</label>
            <div class="layui-input-block">
                <input type="checkbox" name="top" lay-skin="switch" lay-text="ON|OFF" lay-filter="switchTest">
            </div>
        </div>

        <div class="layui-form-item" pane="">
            <label class="layui-form-label">是否发布</label>
            <div class="layui-input-block">
                <input type="checkbox" name="status" lay-skin="switch" lay-text="ON|OFF" lay-filter="switchTest">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文章描述</label>
            <div class="layui-input-block">
                <textarea name="desc" placeholder="请输入文章描述" class="layui-textarea"></textarea>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文章内容</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide"  name="content" lay-verify="content" id="LAY_demo_editor"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn article-submit" lay-submit lay-filter="article">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection

@section('js')
<script src="{{asset('dist/js/article.js')}}"></script>
@endsection