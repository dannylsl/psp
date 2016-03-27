function new_category() {
    if($("#category").val() == "") {
        alert("请输入类别名称");
        $("#category").focus();
        return;
    }
    $.ajax({
        url:"category_add",
        data: $("#category_form").serialize(),
        type: 'post',
        dataType: 'json',
        success:function(data) {
            var obj = data
            var rows_count = Number($("input[name='rows_count']").val())
            if(obj.id > 0) {
                var tr="<tr>"
                //tr = tr+"<td>"+rows_count+"</td>"
                tr = tr+"<td>"+obj.category+"</td>"
                tr = tr+"<td id=\""+obj.id+"\"><button class=\"btn btn-sm btn-warning\" id=\"btn_edit\">编辑</button> "
                tr = tr+"<button class=\"btn btn-sm btn-danger\" id=\"btn_del\">删除</button></td>"
                tr = tr+"</tr>"
                $('#category_tbl').append(tr)
                $("#category").val("");
            }else{
                alert("添加失败")
            }
        },
        error: function() {
            alert("网络通讯异常，请稍后重试");
        }
    })
}

function edit_category() {
    var category_id = $(this).parent().attr('id')
    var category_name = $(this).parent().prev().html()
    $("input[name='category_id']").val(category_id)
    $("input[name='category_name']").val(category_name)
    $("#itemDialog").modal()
}

function del_category() {
    var category_id = $(this).parent().attr('id')
    var closetr = $(this).closest("tr")

    if(true == confirm("确认删除?")) {
        $.ajax({
            url:"category_del",
            data:"id="+category_id,
            type:"post",
            dataType: "json",
            success:function(data) {
                var obj = data
                if(0 == obj.ret) {
                    closetr.remove()
                }else{
                    alert("删除失败")
                }
            },
            error: function() {
                alert("网络通讯异常，请稍后重试");
            }
        });
    }
}

function update_category() {
    if($("input[name='category_name']").val() == "" ) {
        alert("类别不能为空");
        return;
    }
    $.ajax({
        url: "category_update",
        data: $("#category_update_form").serialize(),
        dataType: "json",
        type:'post',
        success: function(data) {
            if(data.id == 0) {
                alert("数据更新失败.");
            }else{
                $("#itemDialog").modal('hide');
                var category_id = $("input[name='category_id']").val()
                $("#"+category_id).prev().html(data.category)
            }
        },
        error: function() {
            alert("网络通讯异常，请稍后重试");
        }
    });
}

$(document).ready(function(){
    $("#btn_new_category").click(new_category);
    $("#btn_update_category").click(update_category);
})

$(document).on('click', 'button#btn_edit', edit_category)
$(document).on('click', 'button#btn_del', del_category)
