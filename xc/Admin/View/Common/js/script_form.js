
//设置排序文本框
function set_sort(id, sort, domobj) {
    $(domobj).html("<input type='text' value='" + sort + "' id='set_sort' class='require'  />");
    $("#set_sort").select();
    $("#set_sort").focus();
    $("#set_sort").bind("blur", function () {
        var newsort = $(this).val();
        $.ajax({
            url: ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_ACTION + "=set_sort&id=" + id + "&sort=" + newsort,
            data: "ajax=1",
            dataType: "json",
            success: function (obj) {
                if (obj.status) {
                    $(domobj).html(newsort);
                }
                else {
                    $(domobj).html(sort);
                }
                $("#info").html(obj.info);

            }
        });
    });
}

var action_obj;
function select_obj(obj){
	action_obj=obj;
}

//弹出确认选择框
function alert_confirm(content,ok_f){
	 art.dialog({
                    title: false,
                    icon: 'question',
                    follow: action_obj,
                    content: content,
                    close: function () {
                    },
                    ok: ok_f,
                    cancelVal: '关闭',
                    cancel: true
                });
}





//审核是否有效
function do_check_effect(id, effect, table) {
    //alert(effect+'|'+id+'|'+actionname);
	if(!table || table==''){table=MODULE_NAME;}
    $.ajax({
        url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "="+MODULE_NAME+"&" + VAR_ACTION + "=do_check_effect&id=" + id + "&effect=" + effect + '&module_name=' + table,
        data: "ajax=1",
        dataType: "json",
        success: function (obj) {
            //alert(obj.data.info);
            window.location.reload();
        }
    });
}

//街道比赛是否晋级
function show_is_win2(id, is_win, table) {
    //alert(effect+'|'+id+'|'+actionname);
	if(!table || table==''){table=MODULE_NAME;}
    $.ajax({
        url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "="+MODULE_NAME+"&" + VAR_ACTION + "=show_is_win2&id=" + id + "&is_win=" + is_win + '&module_name=' + table,
		type:'post',
        data: "ajax=1",
        dataType: "json",
        success: function (obj) {
            ajax_return(obj);
            //window.location.reload();
        }
    });
}
//城市比赛是否晋级
function show_is_win1(id, is_win, table) {
    //alert(effect+'|'+id+'|'+actionname);
	if(!table || table==''){table=MODULE_NAME;}
    $.ajax({
        url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "="+MODULE_NAME+"&" + VAR_ACTION + "=show_is_win1&id=" + id + "&is_win=" + is_win + '&module_name=' + table,
		type:'post',
        data: "ajax=1",
        dataType: "json",
        success: function (obj) {
            ajax_return(obj);
            //window.location.reload();
        }
    });
}









//设置表单字段
function set_field(id, vl, field, domobj, allow_empty) {
    $(domobj).html("<input type='text' value='" + vl + "' name='" + field + "' id='set_" + field + "_" + id + "' class='require'  />");
    $("#set_" + field + "_" + id + "").select();
    $("#set_" + field + "_" + id + "").focus();
    $("#set_" + field + "_" + id + "").bind("blur", function () {

        var newsort = $(this).val();
        if (allow_empty == 1) { if (newsort == '') { alert('请输入内容'); $(this).offset(); return false; } }
        $.ajax({
            url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "=index&" + VAR_ACTION + "=set_field_post",
            type: 'POST',
            data: "ajax=1&id=" + id + "&field=" + field + "&value=" + newsort + '&module_name=' + MODULE_NAME,
            success: function (obj) {
                if (obj.status) {
                    $(domobj).html(newsort);
                }
                else {
                    $(domobj).html(field);
                }

            }
        });
    });
}


//设置表单字段
function set_category_field(id, vl, field, domobj, allow_empty) {
    $(domobj).html("<input type='text' value='" + vl + "' name='" + field + "' id='set_" + field + "_" + id + "' class='require'  />");
    $("#set_" + field + "_" + id + "").select();
    $("#set_" + field + "_" + id + "").focus();
    $("#set_" + field + "_" + id + "").bind("blur", function () {

        var newsort = $(this).val();
        if (allow_empty == 1) { if (newsort == '') { alert('请输入内容'); $(this).offset(); return false; } }
        $.ajax({
            url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME +'&'+ VAR_MODULE + "="+MODULE_NAME+"&" + VAR_ACTION + "=set_category_field_post",
            type: 'POST',
            data: "ajax=1&id=" + id + "&field=" + field + "&value=" + newsort + '&module_name=' + MODULE_NAME,
            success: function (obj) {
                if (obj.status) {
                    $(domobj).html(newsort);
                }
                else {
                    $(domobj).html(field);
                }

            }
        });
    });
}





//普通删除
function del(id,actname) {
    //$("#deleteModal", window.top.window.document).modal('show');

	if(!actname){actname="delete";}
    if (!id) {
        idBox = $(".key:checked");
        if (idBox.length == 0) {
            alert("请选择要删除的对象！");
            return;
        }
        idArray = new Array();
        $.each(idBox, function (i, n) {
            idArray.push($(n).val());
        });
        id = idArray.join(",");
    }

    alert_confirm("确定删除？", function () {
		  $.ajax({
            url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_ACTION + "="+actname+"&id=" + id,
            data: "ajax=1",
            dataType: "json",
            success: function (obj) {
                ajax_return(obj);
            }
          });
    });

}



//完全删除
function foreverdel(id,actname,controller_action){
	if(!actname){actname="foreverdelete";}
	if(!controller_action){controller_action="";}
    if (!id) {
        idBox = $(".key:checked");
        if (idBox.length == 0) {
            alert('请选择要删除的对象');
            return;
        }
        idArray = new Array();
        $.each(idBox, function (i, n) {
            idArray.push($(n).val());
        });
        id = idArray.join(",");
    }
	
    alert_confirm("确定删除？", function () {
		  $.ajax({
            url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_ACTION + "="+actname+"&id=" + id,
            data: "ajax=1&controller_name="+controller_action,
            dataType: "json",
            success: function (obj) {
                ajax_return(obj);
            }
          });
    });
}


//完全删除
function set_effect_ok(id,actname){
    if(!actname){actname="set_effect";}
    if (!id) {
        idBox = $(".key:checked");
        if (idBox.length == 0) {
            alert('请选择要审核的对象');
            return;
        }
        idArray = new Array();
        $.each(idBox, function (i, n) {
            idArray.push($(n).val());
        });
        id = idArray.join(",");
    }
    
    alert_confirm("确定要通过审核所选项目？", function () {
          $.ajax({
            url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_ACTION + "="+actname+"&id=" + id,
            data: "ajax=1",
            dataType: "json",
            success: function (obj) {
                ajax_return(obj);
            }
          });
    });
}

//完全删除
function redel(id,actname,controller_action){
	if(!actname){actname="re_delete";}
	if(!controller_action){controller_action="";}
    if (!id) {
        idBox = $(".key:checked");
        if (idBox.length == 0) {
            alert('请选择要恢复的对象');
            return;
        }
        idArray = new Array();
        $.each(idBox, function (i, n) {
            idArray.push($(n).val());
        });
        id = idArray.join(",");
    }
	
    alert_confirm("确定恢复？", function () {
		  $.ajax({
            url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_ACTION + "="+actname+"&id=" + id,
            data: "ajax=1&controller_name="+controller_action,
            dataType: "json",
            success: function (obj) {
                ajax_return(obj);
            }
          });
    });
}



//完全删除
function category_foreverdel(id,actname,controller_action){
	if(!actname){actname="foreverdelete";}
	if(!controller_action){controller_action="Category";}
    if (!id) {
        idBox = $(".key:checked");
        if (idBox.length == 0) {
            alert(LANG['DELETE_EMPTY_WARNING']);
            return;
        }
        idArray = new Array();
        $.each(idBox, function (i, n) {
            idArray.push($(n).val());
        });
        id = idArray.join(",");
    }
	
    alert_confirm("确定删除？", function () {
		  $.ajax({
            url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_ACTION + "="+actname+"&id=" + id,
            data: "ajax=1&controller_name="+controller_action,
            dataType: "json",
            success: function (obj) {
                ajax_return(obj);
            }
          });
    });
}




//恢复
function restore(id) {
    if (!id) {
        idBox = $(".key:checked");
        if (idBox.length == 0) {
            alert(LANG['RESTORE_EMPTY_WARNING']);
            return;
        }
        idArray = new Array();
        $.each(idBox, function (i, n) {
            idArray.push($(n).val());
        });
        id = idArray.join(",");
    }
    if (confirm(LANG['CONFIRM_RESTORE']))
        $.ajax({
            url: ROOT + "?" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_ACTION + "=restore&id=" + id,
            data: "ajax=1",
            dataType: "json",
            success: function (obj) {
                $("#info").html(obj.info);
                if (obj.status == 1)
					window.location.reload();
            }
        });
}



