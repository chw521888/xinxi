

function down_file(file_id){
	$.ajax({
            url: 'index.php?m=Index&c=index&a=down_file',
            data: "ajax=1&id="+file_id,
            dataType: "json",
			type:'post',
            success: function (obj) {
            }
      });
}