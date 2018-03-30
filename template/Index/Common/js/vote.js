//投票
function post_vote(show_id){
   if(!show_id){alert("参数错误!");return false;}
    $.ajax({
        url: "index.php?m=Contingent&c=IndexShowVote&a=post_vote",
		type:'post',
        data: "ajax=1&show_id="+show_id,
        dataType: "json",
        success: function (obj) {
            //window.location.reload();
			 if (obj.status == 1) {
					alert("操作成功");
					location.reload();
					return true;
                } else {
					if(obj.info!=""){alert(obj.info);}
					         else{alert("系统错误");}
                    
              }
        }
    });	
}



function post_vote_huihua(show_id,is_m){
   if(!show_id){alert("参数错误!");return false;}
    $.ajax({
        url: "index.php?m=Huihua&c=IndexHuihua&a=post_vote",
        type:'post',
        data: "ajax=1&huihua_id="+show_id+"&type="+is_m,
        dataType: "json",
        success: function (obj) {
            //window.location.reload();
             if (obj.status == 1) {
                    alert("操作成功");
                    location.reload();
                    return true;
                } else {
                    if(obj.info!=""){alert(obj.info);}
                             else{alert("系统错误");}
                    
              }
        }
    }); 
}


//投票
function post_xinyuan(x_id){
	if(!x_id){alert("参数错误!");return false;}
    $.ajax({
        url: "index.php?m=Contingent&c=Xinyuan&a=insert_tp",
		type:'get',
        data: "ajax=1&id="+x_id,
        dataType: "json",
        success: function (obj) {
            //window.location.reload();
			 if (obj.status == 1) {
					alert("支持成功");
					return true;
                } else {
					if(obj.info!=""){alert(obj.info);}
					         else{alert("系统错误");}
              }
        }
    });	
}