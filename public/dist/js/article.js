layui.use(['form', 'layedit', 'laydate', 'upload', 'layer'], function(){
    var $ = layui.jquery
        ,upload = layui.upload
        ,form = layui.form
        ,layer = layui.layer
        ,layedit = layui.layedit
        ,laydate = layui.laydate;

    var token = document.head.querySelector('meta[name="csrf-token"]').content;
    //日期
    laydate.render({
        elem: '#date'
    });
    laydate.render({
        elem: '#date1'
    });

    //创建一个编辑器
    var editIndex = layedit.build('LAY_demo_editor');

    //自定义验证规则
    form.verify({
        title: function(value){
            if(value.length < 5){
                return '标题至少得5个字符啊';
            }
        }
        ,pass: [/(.+){6,12}$/, '密码必须6到12位']
        ,content: function(value){
            layedit.sync(editIndex);
        }
    });

    //拖拽上传
    var uploadInst = upload.render({
        elem: '#upload-article-pic'
        ,url: '/resource-upload'
        ,data:{_token:token}
        ,done: function(res){
            if(res.success) {
                $(".layui-pic").attr("src",res.data.imgsrv);
                $("input[name='pic_id']").attr('value',res.data.id);
                $('#remove-article-pic').show();
                layer.msg('上传成功');
            } else {
                layer.msg('上传失败');
            }
        }
    });
    $("#remove-article-pic").on("click",function () {
        $(".layui-pic").attr("src"," ");
        $("input[name='pic_id']").attr('value'," ");
        $('#upload-article-pic').text('点击上传');
        $(this).hide();
    });

    form.on('submit(article)',function (data) {
        submitArticleForm();
        return false;
    });

    function submitArticleForm() {
        $("form").ajaxSubmit({
            success: function (resp) {
                if(resp.success) {
                    layer.msg('创建成功');
                    setTimeout(function () {
                        $(location).attr('href',resp.redirect)
                    },1000);
                } else {
                    layer.msg('创建失败');
                    console.log(resp);
                }
            }
        });
    }



});

