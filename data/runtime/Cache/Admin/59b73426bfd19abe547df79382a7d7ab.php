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
			<!-- <li><a href="#A1" data-toggle="tab">系统设置</a></li>
			<li><a href="#A2" data-toggle="tab">邮件设置</a></li> -->
			<li class="active"><a href="#A3" data-toggle="tab">前台设置</a></li>
			<li><a href="#A4" data-toggle="tab">微信设置</a></li>
			<li><a href="#A5" data-toggle="tab">短信设置</a></li>
		</ul>

		<form class="form-horizontal J_ajaxForms" name="myform" id="myform"	action="<?php echo U('Conf/conf_update');?>" method="post">
			<fieldset>
				<div class="tabbable">
					<div class="tab-content">
                    
                    <?php if(is_array($list)): foreach($list as $key=>$lt): ?><div class="tab-pane <?php if($key == 3): ?>active<?php endif; ?>" id="A<?php echo ($key); ?>">
							<fieldset>
                            <?php if(is_array($lt)): foreach($lt as $k=>$l): ?><div class="control-group">
									<label class="control-label" style="width:360px;"><?php echo ($l["caption"]); if($l['is_array'] == 1): ?>(用|隔开)<?php endif; ?>：</label>
									<div class="controls">
										<?php if($l['input_type'] == 2): ?><textarea name="<?php echo ($l["name"]); ?>" class="conf_input" style="height:100px;"><?php echo ($l["value"]); ?></textarea>
                                           <?php elseif($l['input_type'] == 3): ?>
                                           
<script>
      //实例化编辑器
	  var up_image_input="";
      var o_ueditorupload_fileField_<?php echo ($l["name"]); ?> = UE.getEditor("j_ueditorupload_fileField_<?php echo ($l["name"]); ?>",
      {
        autoHeightEnabled:false
      });
      o_ueditorupload_fileField_<?php echo ($l["name"]); ?>.ready(function ()
      {
	 
	   o_ueditorupload_fileField_<?php echo ($l["name"]); ?>.hide();//隐藏编辑器
	   o_ueditorupload_fileField_<?php echo ($l["name"]); ?>.execCommand("serverparam",{
         "upload_type": 'other',
         "upload_path_son": ''
      });
	
	//监听图片上传
	o_ueditorupload_fileField_<?php echo ($l["name"]); ?>.addListener("beforeInsertImage", function (t,arg)
	{
          //alert("这是图片地址："+arg[0].src);
		  document.getElementById(up_image_input).value=arg[0].src;
	});
	
      });
      
      //弹出图片上传的对话框
      function upImage(input_name)
      {
	    up_image_input = input_name;
        var myImage = o_ueditorupload_fileField_<?php echo ($l["name"]); ?>.getDialog("insertimage");
        myImage.open();
      }
    </script>
	<script type="text/plain" id="j_ueditorupload_fileField_<?php echo ($l["name"]); ?>" style="height:5px;display:none;" ></script>
	<input type="text" name="<?php echo ($l["name"]); ?>" id="fileField_<?php echo ($l["name"]); ?>" value="<?php echo ($l["value"]); ?>" style="width:50%; height:30px;" /><button type="button" onClick="upImage('fileField_<?php echo ($l["name"]); ?>')">上传图片</button>
		
                                           <?php elseif($l['input_type'] == 1): ?>
                                           <select name="<?php echo ($l["name"]); ?>">
                                             <option value="0" <?php if(($l['value']) == "0"): ?>selected="selected"<?php endif; ?>>否</option>
                                             <option value="1" <?php if(($l['value']) == "1"): ?>selected="selected"<?php endif; ?>>是</option>
                                          </select>
                                          <?php elseif($l['input_type'] == 8): ?>
                                           <select name="<?php echo ($l["name"]); ?>">
                                             <option value="0" <?php if(($l['value']) == "0"): ?>selected="selected"<?php endif; ?>>未开始</option>
                                             <option value="1" <?php if(($l['value']) == "1"): ?>selected="selected"<?php endif; ?>>第一阶段投票开始</option>
                                             <option value="2" <?php if(($l['value']) == "2"): ?>selected="selected"<?php endif; ?>>第一阶段投票结束</option>
                                             <option value="3" <?php if(($l['value']) == "3"): ?>selected="selected"<?php endif; ?>>第二阶段投票开始</option>
                                             <option value="4" <?php if(($l['value']) == "4"): ?>selected="selected"<?php endif; ?>>第二阶段投票结束</option>
                                             <option value="5" <?php if(($l['value']) == "5"): ?>selected="selected"<?php endif; ?>>第三阶段投票开始</option>
                                             <option value="6" <?php if(($l['value']) == "6"): ?>selected="selected"<?php endif; ?>>第三阶段投票结束</option>
                                             <option value="7" <?php if(($l['value']) == "7"): ?>selected="selected"<?php endif; ?>>总决赛投票开始</option>
                                             <option value="8" <?php if(($l['value']) == "8"): ?>selected="selected"<?php endif; ?>>总决赛投票结束</option>
                                          </select>
											<?php else: ?>
                                           <input type="text" name="<?php echo ($l["name"]); ?>" value="<?php echo ($l["value"]); ?>" class="conf_input" /><?php endif; ?>
    <span class="must_red">* <?php echo ($l["name"]); ?></span>
										<input type="hidden" class="input" name="option_id" value="<?php echo ($option_id); ?>">
									</div>
								</div><?php endforeach; endif; ?>
							</fieldset>
						</div><?php endforeach; endif; ?>
					</div>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-primary btn_submit  J_ajax_submit_btn">提交</button>
				</div>
			</fieldset>
		</form>

	</div>
	<script type="text/javascript" src="js/common.js"></script>
	<script>
		/////---------------------
		$(function(){
			$("#urlmode-select").change(function(){
				if($(this).val()==1){
					alert("更改后，若发现前台链接不能正常访问，可能是您的服务器不支持PATHINFO，请先修改data/conf/config.php文件的URL_MODEL为0保证网站正常运行,在配置服务器PATHINFO功能后再更新为PATHINFO模式！");
				}
				
				if($(this).val()==2){
					alert("更改后，若发现前台链接不能正常访问，可能是您的服务器不支持REWRITE，请先修改data/conf/config.php文件的URL_MODEL为0保证网站正常运行，在开启服务器REWRITE功能后再更新为REWRITE模式！");
				}
			});
		});
		Wind.use('validate', 'ajaxForm', 'artDialog', function() {
			//javascript
			var form = $('form.J_ajaxForms');
			//ie处理placeholder提交问题
			if ($.browser.msie) {
				form.find('[placeholder]').each(function() {
					var input = $(this);
					if (input.val() == input.attr('placeholder')) {
						input.val('');
					}
				});
			}
			//表单验证开始
			form.validate({
				//是否在获取焦点时验证
				onfocusout : false,
				//是否在敲击键盘时验证
				onkeyup : false,
				//当鼠标掉级时验证
				onclick : false,
				//验证错误
				showErrors : function(errorMap, errorArr) {
					//errorMap {'name':'错误信息'}
					//errorArr [{'message':'错误信息',element:({})}]
					try {
						$(errorArr[0].element).focus();
						art.dialog({
							id : 'error',
							icon : 'error',
							lock : true,
							fixed : true,
							background : "#CCCCCC",
							opacity : 0,
							content : errorArr[0].message,
							cancelVal : '确定',
							cancel : function() {
								$(errorArr[0].element).focus();
							}
						});
					} catch (err) {
					}
				},
				//验证规则
				rules : {
					'options[site_name]' : {
						required : 1
					},
					'options[site_host]' : {
						required : 1
					},
					'options[site_root]' : {
						required : 1
					}
				},
				//验证未通过提示消息
				messages : {
					'options[site_name]' : {
						required : '请输入网站名称！'
					},
					'options[site_host]' : {
						required : '请输入网站域名！'
					},
					'options[site_root]' : {
						required : '请输入安装路径！'
					}
				},
				//给未通过验证的元素加效果,闪烁等
				highlight : false,
				//是否在获取焦点时验证
				onfocusout : false,
				//验证通过，提交表单
				submitHandler : function(forms) {
					$(forms).ajaxSubmit({
						url : form.attr('action'), //按钮上是否自定义提交地址(多按钮情况)
						dataType : 'json',
						beforeSubmit : function(arr, $form, options) {

						},
						success : function(data, statusText, xhr, $form) {
							if (data.status) {
								setCookie("refersh_time", 1);
								//添加成功
								Wind.use("artDialog", function() {
									art.dialog({
										id : "succeed",
										icon : "succeed",
										fixed : true,
										lock : true,
										background : "#CCCCCC",
										opacity : 0,
										content : data.info,
										button : [ {
											name : '确定',
											callback : function() {
												return true;
											},
											focus : true
										}, {
											name : '关闭',
											callback : function() {
												return true;
											}
										} ]
									});
								});
							} else {
								alert(data.info);
							}
						}
					});
				}
			});
		});
		////-------------------------
	</script>
    
    



<!-- Think 系统列表组件结束 -->
 

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