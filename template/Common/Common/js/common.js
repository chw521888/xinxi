//公共的ajax 返回信息处理
function ajax_return(obj){
	if(!obj){alert("系统错误");return false;}
	  if (obj.status == 1) {
					window.location.reload();
                } else {
                    alert(obj.info);
      }
}

