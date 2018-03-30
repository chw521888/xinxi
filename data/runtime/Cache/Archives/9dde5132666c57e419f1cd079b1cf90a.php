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
			<li><a href="#feild" data-toggle="tab">字段信息</a></li>
			<li><a href="#feild_add" data-toggle="tab">添加字段</a></li>
	    </ul>
		
			<div class="tabbable">
		        <div class="tab-content">
                
		          <div class="tab-pane active" id="base">
                  <form class="form-horizontal J_ajaxForm" name="myform" id="myform" action="<?php echo u('ArctypeChannel/update');?>" method="post">
                     <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" />
		          		<table cellpadding="2" cellspacing="2" width="100%">
							<tbody>
								<tr>
									<td width="150">模型名称:</td>
								  <td><?php echo ($info["name"]); ?></td>
							  </tr>
								<tr>
									<td>模型表:</td>
									<td><?php echo C('DB_PREFIX');?>archives_<?php echo ($info["channel_table"]); ?></td>
								</tr>
								<tr>
									<td>默认栏目封面模板:</td>
									<td><?php echo C('FOLDER_TEMPLET'); echo C('FOLDER_TEMPLET_ARCHIVES_INDEX');?><input name="template_index" type="text" value="<?php echo ($info["template_index"]); ?>"  /></td>
								</tr>
								<tr>
									<td>默认栏目列表模板:</td>
									<td><?php echo C('FOLDER_TEMPLET'); echo C('FOLDER_TEMPLET_ARCHIVES_LIST');?><input name="template_list" type="text" value="<?php echo ($info["template_list"]); ?>"  /></td>
								</tr>
								<tr>
									<td>默认栏目文章模板:</td>
									<td><?php echo C('FOLDER_TEMPLET'); echo C('FOLDER_TEMPLET_ARCHIVES_ARTICLE');?><input name="template_article" type="text" value="<?php echo ($info["template_article"]); ?>"  /></td>
								</tr>
							</tbody>
						</table>
                        <div class="form-actions">
		                      <button class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit">提交</button>
		      		          <a class="btn" href="<?php echo U('ArctypeChannel/index');?>">返回</a>
		                </div>
                   </form>
		          </div>
                  
                  <div class="tab-pane" id="feild">
                  <form class="form-horizontal J_ajaxForm" name="myform" id="myform" action="<?php echo u('ArctypeChannel/update_sort');?>" method="post">
                     <input name="id" type="hidden" value="<?php echo ($info["id"]); ?>" />
		          		<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th>排序</th>
						<th>字段中文名称</th>
						<th>字段名称</th>
						<th>字段类型</th>
						<th>数据库字段类型</th>
						<th>数据库字段长度</th>
						<th>值域</th>
					</tr>
				</thead>
				<tbody>
					<?php $list=json_decode($info['channel_field'],true); ?>
					<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
						<td><?php echo (set_sort_input($key)); ?></td>
						<td><?php echo ($vo["field_chinese_name"]); ?></td>
						<td><?php echo ($vo["field_name"]); ?></td>
						<td><?php echo (get_array_key_value($vo["field_type"],C('FEILD_ADD_ARRAY'))); ?></td>
						<td><?php echo ($vo["field_char"]); ?></td>
						<td><?php echo ($vo["field_char_num"]); ?></td>
						<td><?php echo ($vo["field_select"]); ?></td>
					</tr><?php endforeach; endif; ?>
				</tbody>
			</table>
                        <div class="form-actions">
		                      <button class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit">提交</button>
		      		          <a class="btn" href="<?php echo U('ArctypeChannel/index');?>">返回</a>
		                </div>
                        </form>
		          </div>
                  
                   <div class="tab-pane" id="feild_add">
                      <form class="form-horizontal J_ajaxForm" name="myform" id="myform2" action="<?php echo u('ArctypeChannel/insert_field');?>" method="post">
                       <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
<table cellpadding="2" cellspacing="2" width="100%">
			  <tbody>
								<tr>
									<td width="150">字段中文名称:</td>
								  <td><input type="text" class="input" name="field_chinese_name" value="" /><span class="must_red">*</span></td>
							  </tr>
								<tr>
									<td>字段数据表名称:</td>
									<td><input type="text" class="input" name="field_name" value="" /><span class="must_red">*</span></td>
								</tr>
								<tr>
									<td>字段类型:</td>
									<td><select id="" style="" name="field_type" onchange="select_feild();" ondblclick="" class="" ><?php  foreach($FEILD_ADD_ARRAY as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select></td>
								</tr>
								<tr>
									<td>数据库字段类型:</td>
									<td><input name="field_char" type="text" value=""  /></td>
								</tr>
								<tr>
									<td>数据库字段长度:</td>
									<td><input name="field_char_num" type="text" value=""  /></td>
								</tr>
								<tr>
									<td>值域:</td>
									<td><textarea name="field_select"></textarea>当为类型选择框时可以添加选择值,用|隔开</td>
								</tr>
							</tbody>
						</table>
                        <script language="javascript">
						<!--
						var FEILD_ADD_CHAR=<?php echo (json_encode($FEILD_ADD_CHAR)); ?>;
						var FEILD_ADD_CHAR_NUM=<?php echo (json_encode($FEILD_ADD_CHAR_NUM)); ?>;
						function select_feild(){
						   var feild_value=$('select[name=field_type]').val();
						   $('input[name=field_char]').val(FEILD_ADD_CHAR[feild_value]);
						   $('input[name=field_char_num]').val(FEILD_ADD_CHAR_NUM[feild_value]);	
						}
						$(document).ready(function(e) {
                              select_feild();
                        });
						-->
						</script>
                        <div class="form-actions">
		                      <button class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit">提交</button>
		      		          <a class="btn" href="<?php echo U('ArctypeChannel/index');?>">返回</a>
		                </div>
                     </form>
		          </div>
		          
		        </div>
		    </div>
		     
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