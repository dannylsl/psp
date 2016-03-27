function validate() {
    var title = $("input[name='title']").val()
    if(title == "") {
        alert("文章标题不能为空");
        $("input[name='title']").focus()
        return false;
    }

    if($("#category").val() == 0) {
        alert("请选择类别名称");
        $("#category").focus();
        return false;
    }

    return true
}

function article_save() {

    if( false == validate()) {
        return
    }

    $.ajax({
        url:"article_save",
        type: "post",
        dataType: 'json',
        data: $("#article_form").serialize(),
        success: function(data) {
            alert("文章保存成功");
        },
        error: function() {
            alert("网络通讯异常，请稍后重试");
        }
    })

    return
}

function article_preview() {

    return
}

function article_publish() {

    return
}

$(document).ready(function(){
    $("#btn_save").click(article_save);
    $("#btn_preview").click(article_preview);
    $("#btn_publish").click(article_publish);
})
