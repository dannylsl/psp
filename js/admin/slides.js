function popDialog() {
    $("#itemDialog").modal();
}

function slide_upload() {
    if($("#slide").val() == "") {
        alert("请选择要上传的图片")
        $("#slide").focus()
        return
    }
    
    if($("input[name='status']:checked").val() == "") {
        alert("请选择图片状态")
        return 
    }
    $("#slide_form").submit();
/*
    if($("#description").val() == "") {
        alert("图片描述不能为空") 
        return
    }
    $.ajax({
        url: "slide_upload",
        data: $("#slide_form").serialize(),
        dateType: "json",
        type: "post",
        success: function(data) {
           console.log(data)  
        },
        error: function() {
            alert("网络通讯异常，请稍后重试");
        }
    })
*/
}

function del_slide() {
    if(confirm("确定删除?") == false)
        return
    
    var slide_id = $(this).closest('tr').attr('id')
    var tr = $(this).closest('tr')
    $.ajax({
        url:"slide_del",
        data: "id="+slide_id,
        dataType: "json",
        type:'post',
        success: function(data) {
            if(data.ret == 0) {
                tr.remove()
            }else{
                alert("删除失败")
            }
        },
        error: function() {
            alert("网络通讯异常，请稍后重试");
        }
    })
}

$(document).ready(function() {
    $("#newItem").click(popDialog);
    $("#btn_save").click(slide_upload);
})


$(document).on('click', 'button#btn_del', del_slide)
