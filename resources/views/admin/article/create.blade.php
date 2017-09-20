@extends('admin.layouts.admin')

@section('title',$isNew ? '创建文章':'修改文章')

@section('css')
@endsection

@section('content')
    <form class="layui-form article-form" action="{{url('admin/ajax/'.$item->id)}}?_model=Articles" method="{{$isNew ? 'POST':'PUT'}}" data-message="{{$isNew ? '创建':'修改'}}">
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
                <img src="{{$item->imgsrv}}" alt="" class="layui-pic">
                {{--<div  >--}}
                    {{--<i class="layui-icon"></i>--}}
                <a href="#" id="remove-article-pic">移除</a>
                <a href="#" id="upload-article-pic">点击上传</a>
                    {{--<p id="upload-article-pic">点击上传</p>--}}
                {{--</div>--}}
                <input type="hidden" name="pic_id" autocomplete="off" value="{{$item->pic_id}}" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">文章作者</label>
            <div class="layui-input-block">
                <input type="text" name="author" value="{{$item->author}}" lay-verify="required" placeholder="请输入文章作者" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">发布时间</label>
            <div class="layui-input-inline">
                <input type="text" name="created_at" value="{{$item->created_at}}" id="date" lay-verify="datetime" placeholder="请选择发布时间" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">文章来源</label>
            <div class="layui-input-block">
                <input type="text" name="src" value="{{$item->src}}" placeholder="请输入文章来源" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">文章类型</label>
            <div class="layui-input-block">
                <select name="cate_id" lay-verify="required" lay-search="">
                    <option value="">请选择文章类型</option>
                    @foreach($item->categories as $category)
                        <option value="{{$category->id}}" {{$item->cate_id==$category->id ? 'selected=""':''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item" pane="">
            <label class="layui-form-label">是否推荐</label>
            <div class="layui-input-block">
                <input type="checkbox" name="recom" {{$item->recom=="ON" ? 'checked':''}} lay-skin="switch" lay-text="ON|OFF" lay-filter="switchTest">
            </div>
        </div>

        <div class="layui-form-item" pane="">
            <label class="layui-form-label">是否置顶</label>
            <div class="layui-input-block">
                <input type="checkbox" name="top" {{$item->top=="ON" ? 'checked':''}} lay-skin="switch" lay-text="ON|OFF" lay-filter="switchTest">
            </div>
        </div>

        <div class="layui-form-item" pane="">
            <label class="layui-form-label">是否发布</label>
            <div class="layui-input-block">
                {{--<input type="checkbox" name="status" {{$item->status=="publish" ? 'checked':''}} lay-skin="switch" lay-text="ON|OFF" lay-filter="switchTest">--}}
                <input type="radio" name="status" value="draft" title="草稿" {{$item->status=="draft" ? 'checked':''}}>
                <input type="radio" name="status" value="publish"  title="发布" {{$item->status=="publish" ? 'checked':''}}>
                <input type="radio" name="status" value="suspend"  title="停用" {{$item->status=="suspend" ? 'checked':''}}>
                <input type="radio" name="status" value="delete"  title="删除" {{$item->status=="delete" ? 'checked':''}}>

            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文章描述</label>
            <div class="layui-input-block">
                <textarea name="desc" placeholder="请输入文章描述" class="layui-textarea">{{$item->desc}}</textarea>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文章内容</label>
            <div class="layui-input-block">
                <textarea class="layui-textarea layui-hide"  name="content" lay-verify="content" id="LAY_demo_editor">{{$item->content}}</textarea>
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