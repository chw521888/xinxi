$(function(){ 
    var options = {  
        beforeSubmit:  check_form,  //提交前处理 
        success:       return_form,  //处理完成 
        resetForm: true,
		type:     'post',
        dataType:  'json'  
    };  
  
    $('#form_ajax').submit(function() {  
        $(this).ajaxSubmit(options);  
        return false; 
    });  
}); 



function submit_form(){
	 var options = {  
        beforeSubmit:  check_form,  //提交前处理 
        success:       return_form,  //处理完成 
        resetForm: true,
		type:     'post',
        dataType:  'json'  
    };  
    $('#form_ajax').ajaxSubmit(options);
}
 
 
 
function check_form(formData, jqForm, options){
    return true;  
}  
  
function return_form(responseText, statusText){  
      //console.log(responseText);
	  ajax_return(responseText);
} 