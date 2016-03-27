function popDialog() {
    $("#btn_save").show()
    $("#btn_update").hide()
    $("#navi_name").val("")
    $("#fixedurl").val("")
    $("#category").val(0)
    $("#itemDialog").modal();
}

function new_navi() {
    if($("#navi_name").val() == "") {
        alert("导航名称不能为空");
        $("#navi_name").focus();
        return;
    }
    if($("input[name='type']:checked").val() == undefined) {
        alert("请选择类型");
        return;
    }else{
        if($("input[name='type']:checked").val() == "fixedurl") {
            if($("#fixedurl").val() == "") {
                alert("固定链接不能为空");
                $("#fixedurl").focus();
                return;
            }
        }else if($("input[name='type']:checked").val() == "category") {
            if($("select[name='category']").val() == "0") {
                alert("请选择文章类别");
                $("select[name='category']").focus()
                return;
            }
        }
    }

    $.ajax({
        url:"navibar_add",
        type: "post",
        data: $("#navibar_form").serialize(),
        dataType: "json",
        success: function(data) {
            if(data.ret > 0) {
                var tr="<tr id=\""+data.ret+"\">"
                tr = tr+"<td>"+data.name+"</td>"
                tr = tr+"<td>"+data.url+"</td>"
                tr = tr+"<td id=\""+data.ret+"\"><button class=\"btn btn-sm btn-warning\" id=\"btn_edit\">编辑</button> "
                tr = tr+"<button class=\"btn btn-sm btn-danger\" id=\"btn_del\">删除</button></td>"
                tr = tr+"</tr>"
                $("#navi_tbl").append(tr)
                $("#navi_name").val("")
                $("#fixedurl").val("")
                $("#category").val(0)
            }
        },
        error: function() {
            alert("网络通讯异常，请稍后重试");
        }
    });
    $("#itemDialog").modal('hide');
}

function type_change() {
    var type_val = $("input[name='type']:checked").val()
    $("#fixedurl").prop("disabled",true);
    $("#category").prop("disabled",true);
    $("#"+type_val).prop('disabled',false);
    $("#div_fixedurl").hide()
    $("#div_category").hide()
    $("#div_"+type_val).show();
}

function del_navi() {
    if(confirm("确定删除?") == false)
        return

    var navi_id = $(this).closest('tr').attr('id')
    var tr = $(this).closest('tr')
    $.ajax({
        url:"navibar_del",
        data: "id="+navi_id,
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

function edit_navi() {
    var navi_id = $(this).closest('tr').attr('id')
    $("input[name='navi_id']").val(navi_id)
    $("#btn_save").hide()
    $("#btn_update").show()
    $.ajax({
        url: "navibar_detail",
        type:"post",
        data: "id="+navi_id,
        dataType: "json",
        success: function(data) {
            $("#navi_name").val(data.name)
            $("input[name='type']").attr("checked", false)
            $("input[name='type'][value='"+data.type+"']").prop("checked", true)

            $("#fixedurl").prop("disabled",true);
            $("#category").prop("disabled",true);
            $("#"+data.type).prop('disabled',false);
            $("#div_fixedurl").hide()
            $("#div_category").hide()
            $("#div_"+data.type).show();

            if(data.type == 'fixedurl') {
                $("#fixedurl").val(data.url)
            }else{
                $("#category").val(data.category)
            }
            $("#itemDialog").modal();
        },
        error: function() {
            alert("网络通讯异常，请稍后重试");
        }
    })
}

function update_navi() {
    if($("#navi_name").val() == "") {
        alert("导航名称不能为空");
        $("#navi_name").focus();
        return;
    }
    if($("input[name='type']:checked").val() == undefined) {
        alert("请选择类型");
        return;
    }else{
        if($("input[name='type']:checked").val() == "fixedurl") {
            if($("#fixedurl").val() == "") {
                alert("固定链接不能为空");
                $("#fixedurl").focus();
                return;
            }
        }else if($("input[name='type']:checked").val() == "category") {
            if($("select[name='category']").val() == "0") {
                alert("请选择文章类别");
                $("select[name='category']").focus()
                return
            }
        }
    }
    var navi_id = $("input[name='navi_id']").val()
    $.ajax({
        url:"navibar_update",
        type:"post",
        data: $("#navibar_form").serialize(),
        dataType: "json",
        success: function(data) {
            if(data.ret > 0) {
                $("#" + navi_id + " td").eq(0).html(data.name)
                $("#" + navi_id + " td").eq(1).html(data.url)
                $("#itemDialog").modal("hide")
            }
        },
        error: function() {
            alert("网络通讯异常，请稍后重试");
        }
    })
}

$(document).ready(function(){
    $("#newItem").click(popDialog);
    $("#btn_save").click(new_navi);
    $("#btn_update").click(update_navi);
    $("input[name='type']").change(type_change);
});

$(document).on('click', 'button#btn_edit', edit_navi)
$(document).on('click', 'button#btn_del', del_navi)
