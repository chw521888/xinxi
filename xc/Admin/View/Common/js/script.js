

//全选
function CheckAll(table_id){
	var input_checked;
	input_checked=$('#dataTable').find('input[type=checkbox]').prop("checked");
	var len = $('#dataTable').find('input[type=checkbox]');
	
	len.each(function(index, element){
		if(index > 0 && index!=(len.length-1)){
		   $(this).prop("checked",input_checked);
		}
	});
	//$('#dataTable').find('input[type=checkbox]').prop('checked', $(checkbox).prop('checked'));
}




//公共的ajax 返回信息处理
function ajax_return(obj){
	//if(!obj || !obj.status){alert("错误","系统传输错误");}
	  if (obj.status == 1) {
					window.location.reload();
                } else {
                    alert(obj.info);
      }
}


