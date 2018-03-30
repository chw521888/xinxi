/*
 * JS
 */

//右侧区域加载
function loadPage(url) {
    $("#main-content", window.top.window.document).html('<iframe id="secFrame" name="secFrame" src="' + url + '" style="width:' + ($(window.top.window.document).width() - 95) + 'px;height:' + ($(window.top.window.document).height() - 55) + "px" + ';border:none;"></iframe>');
}









/*
 * 错误提示信息 参数均为html
 * title 标题
 * content 提示内容
 * btn modal底部按钮
 * timeout 自动关闭间隔 ms
 */
function showErrorModal(content,title) {
	var btn='';
	var timeout=3000;
	if(!title || title==''){title='错误';}
    $("#tipModal .modal-title", window.top.window.document).html(title);
    $("#tipModal .modal-body", window.top.window.document).html(content);

    var btnInfo = '<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>';
    if (btn) {
        btnInfo += btn;
    }
    $("#tipModal .modal-footer", window.top.window.document).html(btnInfo);
    $("#tipModal", window.top.window.document).modal('show');

    if (timeout) {
        setTimeout(function () {
            $("#tipModal", window.top.window.document).modal('hide');
        }, timeout);
    }
}








/*
 * 提示信息 参数均为html
 * title 标题
 * content 提示内容
 * btn modal底部按钮
 * timeout 自动关闭间隔 ms
 */
function showTipModal(title, content, btn, timeout) {
    $("#tipModal .modal-title", window.top.window.document).html(title);
    $("#tipModal .modal-body", window.top.window.document).html(content);

    var btnInfo = '<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>';
    if (btn) {
        btnInfo += btn;
    }
    $("#tipModal .modal-footer", window.top.window.document).html(btnInfo);
    $("#tipModal", window.top.window.document).modal('show');

    if (timeout) {
        setTimeout(function () {
            $("#tipModal", window.top.window.document).modal('hide');
        }, timeout);
    }
}







/*
 * 成功提示框
 * content html 成功显示内容
 * timeout ms 自动关闭间隔时间
 */
function showSuccessModal(content, timeout) {
    $("#successModal .modal-body", window.top.window.document).html(content);
    $("#successModal", window.top.window.document).modal("show");

    if (!timeout) {
        timeout = 1000;
    }

    setTimeout(function () {
        $("#successModal", window.top.window.document).modal('hide');
        //刷新页面
        window.top.frames['secFrame'].location.reload();
    }, timeout);
}


//全选反选
function chkAll() {
    $("#chkAll").click(function () {
        if ($(this).prop("checked")) {
            //$(this).attr("checked", false);
            $("#dataTable input[type='checkbox']").prop("checked", true);
        } else {
            $("#dataTable input[type='checkbox']").prop("checked", false);
        }
    });

    $("#dataTable tbody input[type='checkbox']").click(function () {
        if ($(this).prop("checked")) {
            var flag = true;
            $("#dataTable tbody input[type='checkbox']").each(function () {
                if (!$(this).prop("checked")) {
                    flag = false;
                    return false;
                }
            });

            if (flag) {
                $("#chkAll").prop("checked", true);
            }
        } else {
            $("#chkAll").prop("checked", false);
        }
    });
}

/*
 * iframe弹出框
 * url 页面地址
 * title 标题
 */
function showIframeModal(url, title) {
    $("#iframeModal .modal-body", window.top.window.document).html('<iframe src="' + url + '" style="height: 100%; width: 100%; border: none;"></iframe>');
    $("#iframeModal .modal-title", window.top.window.document).html('').html(title);
    $("#iframeModal .modal-body", window.top.window.document).css("height", $(document).height() * 0.8 + "px");
    $("#iframeModal", window.top.window.document).modal("show");
    $("#iframeModal", window.top.window.document).css("display", "block");
}

//关闭iframe弹出框 
//BUG TO FIX 子页面hide
function closeIframeModal() {
    //$("#iframeModal").modal("hide");

    $("#iframeModal", window.top.window.document).css("display", "none");
    //$(".modal-backdrop", window.top.window.document).css("display", "none").css("background-color", "#fff");
    //$(".in", window.top.window.document).css("display", "none").css("background-color", "#fff");
    //$("#iframeModal", window.top.window.document).removeClass("modal-backdrop");
    //console.log($("#iframeModal .modal-backdrop"));
}

//dropdown选择
function dropdownFn() {
    $("#content .dropdown li").click(function () {
        $(this).parent().parent().find(".dropdown-toggle").html($(this).text() + '<span class="caret"></span>').attr("value", $(this).find("a").attr("data-val"));
        //$(this).parent().css("display", "none");
    });

    //$("#content .dropdown").hover(function () {
    //    $(this).find(".dropdown-menu").css("display", "block");
    //});
}

//选择应用
function toggleApp() {
    $(".myapp a", window.top.window.document).click(function () {
        $("#sidebar .sidebar-menu .show", window.top.window.document).removeClass("show");
        $("#sidebar .sidebar-menu li[data-type='" + $(this).attr("data-id") + "']", window.top.window.document).addClass("show");

        loadPage($("#sidebar .sidebar-menu .show", window.top.window.document).eq(1).find("a:first").attr("data-href"));
    });
}

//ajax提交表单
function ajaxSubmit() {
    $("#Submit").click(function () {
		         //检查check_form();是否存在
				   try{  
                       if(typeof(eval(check_form))=="function"){
                          if(check_form()==false){return false;}
                       }
                   }catch(e){}  
				
		
        $("#Form").ajaxSubmit({
            data: { 'ajax': 1 },
            beforeSerialize: function () {
                //添加checkbox值
				/**
                $("#Form input[type='checkbox']").each(function () {
                    $("#Form input[name='" + $(this).find(".dropdown-toggle").attr('name') + "']").remove();
                    var cv = 0;
                    if ($(this).prop("checked")) {
                        cv = 1;
                    }
                    $("#Form").append('<input type="hidden" name="' + $(this).attr('name') + '" value="' + cv + '" />');
                });
                  **/
                //添加dropdown值
                $("#Form .dropdown").each(function () {
                    $("#Form input[name='" + $(this).find(".dropdown-toggle").attr('name') + "']").remove();
                    $("#Form").append('<input type="hidden" name="' + $(this).find(".dropdown-toggle").attr('name') + '" value="' + $(this).find(".dropdown-toggle").attr('value') + '" />');
                });

            },
            beforeSubmit: function () {
                var flag = true;
                //验证不可为空
                $("#Form input:required").each(function () {
                    if ($.trim($(this).val()).length < 1) {
                        $(this).css("border", "1px solid red").focus();
                        $(this).next(".help-line").text('不可为空');
                        flag = false;
                    }
                });
				
				
				 

                //遮罩层
                if (flag) {
                    $("#Form").append('<div class="loading"></div>');
                }

                return flag;
            },
            dataType: 'json',
            success: function (data, status) {
                if (data.status == 1) {
                    showSuccessModal('操作成功');
                    closeIframeModal();
                } else {
                    showTipModal("错误", data.info, '', 3000);
                    $(".loading").remove();
                }
            }
        });
    });
}

//表单验证
function validate() {
    $("#Form input[type='text']").each(function () {
        $(this).on('change', function () {
            var enabled = false;
            //required
            if ($(this).is(":required")) {
                if ($.trim($(this).val()).length < 1) {
                    $(this).css("border", "1px solid red").focus();
                    $(this).next(".help-line").text('不可为空');

                    enabled = false;
                } else {
                    $(this).css("border", "1px solid #ccc").next(".help-line").text('');

                    enabled = true;
                }
            }

            //same
            var same = $(this).attr("data-same");
            if (same) {
                if ($(this).val() != $("#Form input[type='text'][name='" + same + "']").val()) {

                }
            }

        });
    });
}

function choose() {

}

//删除表格行
function delTr() {
    $("#dataTable .delTr", window.top.frames['secFrame']).click(function () {
        $(this).parent().parent().remove();
    });
}

$(function () {
    //dataTable checkbox选择事件
    chkAll();

    //页面内下拉选择
    dropdownFn();

    //模块选择
    toggleApp();

    //ajax提交表单
    ajaxSubmit();

    //删除表格行
    delTr();
});
