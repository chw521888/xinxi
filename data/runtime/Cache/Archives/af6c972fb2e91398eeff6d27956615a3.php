<?php if (!defined('THINK_PATH')) exit();?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
	<link href="/jtjk/public/template/statics/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
    <link href="/jtjk/public/template/statics/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/jtjk/public/template/statics/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/jtjk/public/template/statics/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">

    
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="css/font-awesome-ie7.min.css">
	<![endif]-->

<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>

    <script src="/jtjk/public/template/statics/js/jquery.js"></script>
</head>
<body class="J_scroll_fixed">

				<script type="text/javascript" charset="utf-8" src="/jtjk/public/ueditor/ueditor.config.js"></script>
                <script type="text/javascript" charset="utf-8" src="/jtjk/public/ueditor/ueditor.all.min.js"> </script>
				<script type="text/javascript" charset="utf-8" src="/jtjk/public/ueditor/lang/zh-cn/zh-cn.js"></script>
				 
<div class="wrap J_check_wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#base" data-toggle="tab">基本信息</a></li>
			<li><a href="#seo" data-toggle="tab">SEO设置</a></li>
			<li><a href="#template" data-toggle="tab">模板页面</a></li>
			<li><a href="#content" data-toggle="tab">详细内容</a></li>
	    </ul>
		<form class="form-horizontal" name="myform" id="myform" action="<?php echo U('Arctype/update');?>" method="post">
        <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" /><input name="back_url" type="hidden" value="<?php echo (urlencode($_SERVER["HTTP_REFERER"])); ?>" />
			<div class="tabbable">
		        <div class="tab-content">
		          <div class="tab-pane active" id="base">
		          		<table cellpadding="2" cellspacing="2" width="100%">
							<tbody>
								<tr>
									<td width="150">上级分类:</td>
								  <td><select id="" style="" name="reid" onchange="" ondblclick="" class="" ><?php  foreach($arctype_list as $key=>$val) { if($info['reid']!=="" && ($info['reid'] == $key || in_array($key,$info['reid']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select></td>
							  </tr>
								<tr>
									<td width="150">分类名称:</td>
								  <td><input type="text" class="input" name="typename" value="<?php echo ($info["typename"]); ?>" /><span class="must_red">*</span></td>
							  </tr>
								<tr>
									<td width="150">英文分类名称:</td>
								  <td><input type="text" class="input" name="typename_en" value="<?php echo ($info["typename_en"]); ?>" /></td>
							  </tr>
								<tr>
									<td width="150">首页图片:</td>
								    <td>
<script>
      //实例化编辑器
	  var up_image_input="";
      var o_ueditorupload_pic = UE.getEditor("j_ueditorupload_pic",
      {
        autoHeightEnabled:false
      });
      o_ueditorupload_pic.ready(function ()
      {
	 
	   o_ueditorupload_pic.hide();//隐藏编辑器
	   o_ueditorupload_pic.execCommand("serverparam",{
         "upload_type": 'other',
         "upload_path_son": ''
      });
	
	//监听图片上传
	o_ueditorupload_pic.addListener("beforeInsertImage", function (t,arg)
	{
          //alert("这是图片地址："+arg[0].src);
		  document.getElementById(up_image_input).value=arg[0].src;
	});
	
      });
      
      //弹出图片上传的对话框
      function upImage(input_name)
      {
	    up_image_input = input_name;
        var myImage = o_ueditorupload_pic.getDialog("insertimage");
        myImage.open();
      }
    </script>
	<script type="text/plain" id="j_ueditorupload_pic" style="height:5px;display:none;" ></script>
	<input type="text" name="pic" id="pic" value="<?php echo ($info["pic"]); ?>" style="" /><button type="button" onClick="upImage('pic')">上传图片</button>
		</td>
							  </tr>
								<!-- <tr>
									<td width="150">顶部banner图:</td>
								    <td>
<script>
      //实例化编辑器
	  var up_image_input="";
      var o_ueditorupload_banner = UE.getEditor("j_ueditorupload_banner",
      {
        autoHeightEnabled:false
      });
      o_ueditorupload_banner.ready(function ()
      {
	 
	   o_ueditorupload_banner.hide();//隐藏编辑器
	   o_ueditorupload_banner.execCommand("serverparam",{
         "upload_type": 'other',
         "upload_path_son": ''
      });
	
	//监听图片上传
	o_ueditorupload_banner.addListener("beforeInsertImage", function (t,arg)
	{
          //alert("这是图片地址："+arg[0].src);
		  document.getElementById(up_image_input).value=arg[0].src;
	});
	
      });
      
      //弹出图片上传的对话框
      function upImage(input_name)
      {
	    up_image_input = input_name;
        var myImage = o_ueditorupload_banner.getDialog("insertimage");
        myImage.open();
      }
    </script>
	<script type="text/plain" id="j_ueditorupload_banner" style="height:5px;display:none;" ></script>
	<input type="text" name="banner" id="banner" value="<?php echo ($info["banner"]); ?>" style="" /><button type="button" onClick="upImage('banner')">上传图片</button>
		</td>
							  </tr> -->
								<tr>
									<td width="150">模型:<?php $INITIALIZE_MODEL=C('INITIALIZE_MODEL'); ?></td>
								  <td><select id="" style="" name="channeltype_id" onchange="select_feild();" ondblclick="" class="" ><?php  foreach($model_list as $key=>$val) { if($info['channeltype_id']!=="" && ($info['channeltype_id'] == $key || in_array($key,$info['channeltype_id']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select></td>
							    </tr>
                                <tr>
									<td width="150">分页数量:</td>
								  <td><input type="text" class="input" name="list_rows" value="<?php echo ($info["list_rows"]); ?>"/></td>
							    </tr>
								<tr>
									<td width="150">描述:</td>
								  <td><textarea name="resume" cols="45" rows="5"><?php echo ($info["resume"]); ?></textarea></td>
							    </tr>
                               <tr>
									<td width="150">栏目属性:<?php $ARCTYPE_PART_TYPE=C('ARCTYPE_PART_TYPE'); ?></td>
								  <td><select id="" style="" name="is_part" onchange="" ondblclick="" class="" ><?php  foreach($ARCTYPE_PART_TYPE as $key=>$val) { if($info['is_part']!=="" && ($info['is_part'] == $key || in_array($key,$info['is_part']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select></td>
							    </tr>
                                <tr>
									<td width="150">链接地址:</td>
								  <td><input type="text" class="input" name="url" value="<?php echo ($info["url"]); ?>" placeholder="栏目属性为外部链接并填写网址" /></td>
							    </tr>
                                
                                 <tr>
									<td width="150">是否为顶部导航:</td>
							    <td>
                                  <input type="radio" name="is_menu_top" value="1" <?php if($info['is_menu_top'] == 1): ?>checked="checked"<?php endif; ?> />&nbsp;是&nbsp;&nbsp;
                                  <input name="is_menu_top" type="radio" value="0" <?php if($info['is_menu_top'] == 0): ?>checked="checked"<?php endif; ?> />&nbsp;否                               
                                  </td>
						      </tr>
                               <tr>
									<td width="150">是否为底部栏目:</td>
							    <td>
                                  <input type="radio" name="is_menu_foot" value="1"  <?php if($info['is_menu_foot'] == 1): ?>checked="checked"<?php endif; ?> />&nbsp;是&nbsp;&nbsp;
                                  <input name="is_menu_foot" type="radio" value="0"  <?php if($info['is_menu_foot'] == 0): ?>checked="checked"<?php endif; ?> />&nbsp;否                               
                                  </td>
						      </tr>
                              <?php if(C('SYSTEM_DEBUG') == true): ?><tr>
									<td width="150">是否为系统栏目:</td>
							    <td>
                                  <input type="radio" name="is_system" value="1" <?php if($info['is_system'] == 1): ?>checked="checked"<?php endif; ?>/>&nbsp;是&nbsp;&nbsp;
                                  <input name="is_system" type="radio" value="0"  <?php if($info['is_system'] == 0): ?>checked="checked"<?php endif; ?> />&nbsp;否                               
                                  </td>
						      </tr><?php endif; ?>
                              <tr>
									<td width="150">是否显示:</td>
							    <td>
                                  <input type="radio" name="is_effect" value="1" <?php if($info['is_effect'] == 1): ?>checked="checked"<?php endif; ?>/>&nbsp;是&nbsp;&nbsp;
                                  <input name="is_effect" type="radio" value="0"  <?php if($info['is_effect'] == 0): ?>checked="checked"<?php endif; ?> />&nbsp;否                               
                                  </td>
						      </tr>
                        
							</tbody>
						</table>
		          </div>
                   <div class="tab-pane" id="seo">
		          		<table cellpadding="2" cellspacing="2" width="100%">
							<tbody>
								<tr>
									<td width="150">SEO标题:</td>
								  <td><input type="text" class="input" name="seo_title" value="<?php echo ($info["seo_title"]); ?>" /></td>
							  </tr>
								<tr>
									<td width="150">SEO关键字:</td>
								  <td><input type="text" class="input" name="seo_keywords" value="<?php echo ($info["seo_keywords"]); ?>" /></td>
							  </tr>
								<tr>
									<td width="150">SEO描述:</td>
								    <td><textarea name="seo_description" cols="45" rows="5"><?php echo ($info["seo_description"]); ?></textarea></td>
							  </tr>
                              
							</tbody>
						</table>
		          </div>
                  
                  <div class="tab-pane" id="template">
		          		<table cellpadding="2" cellspacing="2" width="100%">
							<tbody>
								<tr>
									<td width="150">首页模板:</td>
								  <td><?php echo C('FOLDER_TEMPLET'); echo C('FOLDER_TEMPLET_ARCHIVES_INDEX');?><input type="text" class="input" name="template_index" value="<?php echo ($info["template_index"]); ?>" /></td>
							  </tr>
								<tr>
									<td width="150">列表模板:</td>
								  <td><?php echo C('FOLDER_TEMPLET'); echo C('FOLDER_TEMPLET_ARCHIVES_LIST');?><input type="text" class="input" name="template_list" value="<?php echo ($info["template_list"]); ?>" /></td>
							  </tr>
								<tr>
							       <td width="150">详细页模板:</td>
								  <td><?php echo C('FOLDER_TEMPLET'); echo C('FOLDER_TEMPLET_ARCHIVES_ARTICLE');?><input type="text" class="input" name="template_article" value="<?php echo ($info["template_article"]); ?>" /></td>
							  </tr>
								<tr>
							       <td width="150">子栏目是否继承模板路径:</td>
								  <td>
                                  <input type="checkbox" name="checkbox" id="checkbox" /></td>
							  </tr>
							</tbody>
						</table>
		          </div>
                  
                  
                  <div class="tab-pane" id="content">
		          		<table cellpadding="2" cellspacing="2" width="100%">
							<tbody>
                                  <tr>
              <th>相册图集 </th>
              <td>
				<fieldset class="blue pad-10">
                 <?php $value_array=json_decode($info['pic_list'],true); ?>
				 
	
	<script>
      //实例化编辑器
	  var up_image_input="";
      var o_ueditorupload_8357 = UE.getEditor("j_ueditorupload_8357",
      {
        autoHeightEnabled:false
      });
      o_ueditorupload_8357.ready(function ()
      {
	 
	   o_ueditorupload_8357.hide();//隐藏编辑器
	   o_ueditorupload_8357.execCommand("serverparam",{
         "upload_type": 'other',
         "upload_path_son": ''
      });
	
	//监听图片上传
	o_ueditorupload_8357.addListener("beforeInsertImage", function (t,arg)
	{
          //alert("这是图片地址："+arg[0].src);
		 //document.getElementById(up_image_input).value=arg[0].src;
		  
		  var arg_html=$("#j_file_8357").html();
		  for(var i=0;i<arg.length;i++){
			  var url_hz=arg[i].src.split(".");
			  var p=i+1;
			  
			  arg_html+="<li id=\"image"+p+"\"><input title=\"双击查看\" type=\"text\" name=\"pic_list_url[]\" value=\""+arg[i].src+"\" style=\"width:310px;\" ondblclick=\"image_priview(this.value);\" class=\"input\"> <input type=\"text\" name=\"pic_list_name[]\" placeholder=\"文件名\" value=\"\" style=\"width:160px;\" class=\"input\" onfocus=\"if(this.value == this.defaultValue) this.value = ''\" onblur=\"if(this.value.replace(' ','') == '') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div('image"+p+"')\"  onclick=\"$(this).parent().remove();\">移除</a> </li>";
			  
			  
			  //arg_html+="<div class=\"fileMultiDiv_div\"><li class=\"fileMultiDiv_filename\"><a href=\""+arg[i].src+"\" target=\"_blank\">"+p+"."+url_hz[1]+"文件</a></li><li class=\"fileMultiDiv_input\"><input type=\"hidden\" name=\"upload_file_url[]\" value=\""+arg[i].url+"\" /><input type=\"text\" name=\"upload_file_name[]\" id=\"textfield\" placeholder=\"文件名\" /></li><li class=\"fileMultiDiv_del\" onclick=\"$(this).parent().remove();\">删除</li></div>";
		  }
		  $("#j_file_8357").html(arg_html);
	   });
	
      });
      
      //弹出图片上传的对话框
      function upImage_8357(input_name)
      {
	    up_image_input = input_name;
        var myImage = o_ueditorupload_8357.getDialog("insertimage");
        myImage.open();
      }
    </script>
<script type="text/plain" id="j_ueditorupload_8357" style="height:5px;display:none;" ></script>
<legend>图片列表</legend>
<ul id="j_file_8357"  class="picList unstyled">
<?php
 if(is_array($value_array)){ $p=1; foreach($value_array as $p=>$sv){ echo "<li id=\"image".$p."\"><input title=\"双击查看\" type=\"text\" name=\"pic_list_url[]\" value=\"".$sv["url"]."\" style=\"width:310px;\" ondblclick=\"image_priview(this.value);\" class=\"input\"> <input type=\"text\" name=\"pic_list_name[]\" placeholder=\"文件名\" value=\"".$sv["name"]."\" style=\"width:160px;\" class=\"input\" onfocus=\"if(this.value == this.defaultValue) this.value = ''\" onblur=\"if(this.value.replace(' ','') == '') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div('image".$p."')\"  onclick=\"$(this).parent().remove();\">移除</a> </li>"; $p++; } } ?>
</ul>
<button type="button" onClick="upImage_8357('8357')">上传图片</button>

				</fieldset>
			  </td>
            </tr>
								<tr>
									<td width="150">电脑端内容:</td>
								  <td>
                                     
				<script  id="arctype_content" type="text/plain" style="width:100%; height:300px;" name="content" ><?php echo (htmlspecialchars_decode($info["content"])); ?></script>
				  <script type="text/javascript">
			       var ue_arctype_content = UE.getEditor("arctype_content");
		          </script>
				  
                                  </td>
							  </tr>
								<tr>
									<td width="150">手机端内容:</td>
								  <td>
                                     
				<script  id="arctype_content_m" type="text/plain" style="width:100%; height:300px;" name="content_m" ><?php echo (htmlspecialchars_decode($info["content_m"])); ?></script>
				  <script type="text/javascript">
			       var ue_arctype_content_m = UE.getEditor("arctype_content_m");
		          </script>
				  
                                  </td>
							  </tr>
							</tbody>
						</table>
		          </div>
                  
                  
                  
                   <script language="javascript">
						<!--
						var temp_list=<?php echo (json_encode($temp_list)); ?>;
						function select_feild(){
							var model_id=$('select[name=channeltype_id]').val();
							$('input[name=template_index]').val(temp_list[model_id]['0']);
							$('input[name=template_list]').val(temp_list[model_id]['1']);
							$('input[name=template_article]').val(temp_list[model_id]['2']);
						}
						$(document).ready(function(e) {
                              //select_feild();
                        });
						-->
						</script>
		          
		        </div>
		    </div>
		     <div class="form-actions">
		           <button class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit">提交</button>
		      		<a class="btn" href="<?php if($url != 0): echo U('Archives/dy_index'); else: echo U('Arctype/index'); endif; ?>">返回</a>
		      </div>
		</form>
	</div>

    <script type="text/javascript">
 	var VAR_MODULE = "<?php echo conf("VAR_MODULE");?>";
 	var VAR_CONTROLLER = "<?php echo conf("VAR_CONTROLLER");?>";
	var VAR_ACTION = "<?php echo conf("VAR_ACTION");?>";
	
	
	var MODULE_NAME	=	'<?php echo (MODULE_NAME); ?>';
	var CONTROLLER_NAME	=	'<?php echo (CONTROLLER_NAME); ?>';
	var ACTION_NAME	=	'<?php echo ACTION_NAME; ?>';
	var ROOT = '/jtjk/index.php';
	var ROOT_PATH = '<?php echo APP_ROOT; ?>';
	var CURRENT_URL = '<?php echo trim($_SERVER['REQUEST_URI']);?>';
	var INPUT_KEY_PLEASE = "{%INPUT_KEY_PLEASE}";
	var TMPL = '/jtjk/xc/Admin/View/';
	var APP_ROOT = '<?php echo APP_ROOT; ?>';
	
	//alert(CURRENT_URL);
	
	
</script>
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "",
	JS_ROOT: "/jtjk/public/template/statics/js/",//js版本号
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/jtjk/public/template/statics/js/wind.js"></script>
    <script src="/jtjk/public/template/statics/simpleboot/bootstrap/js/bootstrap.min.js"></script>


<script src="/jtjk/public/template/statics/js/common.js"></script>


<script src="/jtjk/xc/Admin/View/Common/js/script.js"></script>
<script src="/jtjk/xc/Admin/View/Common/js/script_array.js"></script>
<script src="/jtjk/xc/Admin/View/Common/js/script_form.js"></script>
<script src="/jtjk/xc/Admin/View/Common/js/script_url.js"></script>
</body>
</html>