/**
 * Created by yuehuai on 2017/9/19.
 */
function getIdFromTable(data) {
    var arr = [];

    if(isArray(data)) {
        for (var i=0;i<data.length;i++) {
            arr.push(data[i].id);
        }
    }
    return arr;
}
function isArray(o) {
    return Object.prototype.toString.call(o) == '[object Array]';
}

function ajaxDel(url,data,type) {
    $.ajax({
        url:url,
        type:type,
        data:data,
        beforeSend:function () {
            layer.msg('&nbsp;执行中,请稍等...',{icon: 16,time:false,shade:0.8});
        },
        success:function (resp) {
            if(resp.success) {
                layer.msg(resp.msg);
            } else {
                layer.msg(resp.msg);
            }
        },
        error:function () {
            layer.msg("网络异常！");
        }
    });
    return false;
}