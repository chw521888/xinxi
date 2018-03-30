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
<div class="wrap jj">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo U('Contingent/Show/index_stage_1');?>">节目管理</a></li>
			<li><a href="<?php echo U('Contingent/Show/add_stage_1');?>">添加节目</a></li>
		</ul>
        <form class="well form-search" method="get" action="/jtjk/index.php">
        
            <input type="hidden" value="<?php echo (MODULE_NAME); ?>" name="m" />
            <input type="hidden" value="<?php echo (CONTROLLER_NAME); ?>" name="c" />
            <input type="hidden" value="<?php echo ACTION_NAME; ?>" name="a" />
            <input type="hidden" value="<?php echo ($channeltype_id); ?>" name="channeltype_id" />
			<div class="search_type cc mb10">
				<div class="mb10">
					<span class="mr20">街道： 
						<select id="" style="" name="location_id" onchange="" ondblclick="" class="" ><?php  foreach($location_array as $key=>$val) { if($_GET['location_id']!=="" && ($_GET['location_id'] == $key || in_array($key,$_GET['location_id']))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
						&nbsp; &nbsp;关键字： 
						<input type="text" name="keywords" style="width: 200px;" value="<?php echo $_GET['keywords'] ?>" placeholder="请输入关键字...">
						<input type="submit" class="btn btn-primary" value="搜索" />
					</span>
				</div>
			</div>
		</form>

		<form method="post" class="J_ajaxForm" action="<?php echo U('Archives/Archives/update_sort');?>">
        <div class="table-actions">
				<!--<button class="btn btn-primary btn-small" type="button" onclick="del();" data-action="<?php echo U('Contingent/Show/delete');?>" data-subcheck="true">删除</button>
        		<button type="submit" class="btn btn-primary btn-small btn_submit J_ajax_submit_btn">排序</button>-->
			</div>

            <!-- Think 系统列表组件开始 -->
<table id="dataTable" class="table table-hover table-bordered table-list  table-hover" cellpadding=0 cellspacing=0 ><thead><tr><th data-field="id"><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index_stage_1')" title="按照ID             <?php echo ($sortType); ?> ">ID             <?php if(($order) == "id"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="location_id"><a href="javascript:sortBy('location_id','<?php echo ($sort); ?>','index_stage_1')" title="按照城市             <?php echo ($sortType); ?> ">城市             <?php if(($order) == "location_id"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="contingent_id"><a href="javascript:sortBy('contingent_id','<?php echo ($sort); ?>','index_stage_1')" title="按照队伍名称             <?php echo ($sortType); ?> ">队伍名称             <?php if(($order) == "contingent_id"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="show_name"><a href="javascript:sortBy('show_name','<?php echo ($sort); ?>','index_stage_1')" title="按照作品名称             <?php echo ($sortType); ?> ">作品名称             <?php if(($order) == "show_name"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="video"><a href="javascript:sortBy('video','<?php echo ($sort); ?>','index_stage_1')" title="按照视频地址             <?php echo ($sortType); ?> ">视频地址             <?php if(($order) == "video"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="pic"><a href="javascript:sortBy('pic','<?php echo ($sort); ?>','index_stage_1')" title="按照缩略图             <?php echo ($sortType); ?> ">缩略图             <?php if(($order) == "pic"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="stage"><a href="javascript:sortBy('stage','<?php echo ($sort); ?>','index_stage_1')" title="按照阶段             <?php echo ($sortType); ?> ">阶段             <?php if(($order) == "stage"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="num_vote"><a href="javascript:sortBy('num_vote','<?php echo ($sort); ?>','index_stage_1')" title="按照实际得票数                 <?php echo ($sortType); ?> ">实际得票数                 <?php if(($order) == "num_vote"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="num_vote_show"><a href="javascript:sortBy('num_vote_show','<?php echo ($sort); ?>','index_stage_1')" title="按照展示票数                 <?php echo ($sortType); ?> ">展示票数                 <?php if(($order) == "num_vote_show"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="is_win"><a href="javascript:sortBy('is_win','<?php echo ($sort); ?>','index_stage_1')" title="按照是否晋级<?php echo ($sortType); ?> ">是否晋级<?php if(($order) == "is_win"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr></thead><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr ><td><?php echo ($list["id"]); ?></td><td><?php echo (show_l1_name($list["location_id"])); ?></td><td><?php echo (show_ca_name2($list["contingent_id"])); ?></td><td><?php echo ($list["show_name"]); ?></td><td><?php echo ($list["video"]); ?></td><td><?php echo (show_img($list["pic"])); ?></td><td><?php echo (show_stage($list["stage"])); ?></td><td><?php echo ($list["num_vote"]); ?></td><td><?php echo ($list["num_vote_show"]); ?></td><td><?php echo (show_is_win1($list["is_win"],$list['id'])); ?></td><td><a href="javascript:edit('<?php echo ($list["id"]); ?>','edit_show_stage_1')"><?php echo check_action_competence("<i class='fa fa-edit'></i>",$list["is_system"],"edit");?></a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tfoot><tr><th data-field="id"><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index_stage_1')" title="按照ID             <?php echo ($sortType); ?> ">ID             <?php if(($order) == "id"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="location_id"><a href="javascript:sortBy('location_id','<?php echo ($sort); ?>','index_stage_1')" title="按照城市             <?php echo ($sortType); ?> ">城市             <?php if(($order) == "location_id"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="contingent_id"><a href="javascript:sortBy('contingent_id','<?php echo ($sort); ?>','index_stage_1')" title="按照队伍名称             <?php echo ($sortType); ?> ">队伍名称             <?php if(($order) == "contingent_id"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="show_name"><a href="javascript:sortBy('show_name','<?php echo ($sort); ?>','index_stage_1')" title="按照作品名称             <?php echo ($sortType); ?> ">作品名称             <?php if(($order) == "show_name"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="video"><a href="javascript:sortBy('video','<?php echo ($sort); ?>','index_stage_1')" title="按照视频地址             <?php echo ($sortType); ?> ">视频地址             <?php if(($order) == "video"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="pic"><a href="javascript:sortBy('pic','<?php echo ($sort); ?>','index_stage_1')" title="按照缩略图             <?php echo ($sortType); ?> ">缩略图             <?php if(($order) == "pic"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="stage"><a href="javascript:sortBy('stage','<?php echo ($sort); ?>','index_stage_1')" title="按照阶段             <?php echo ($sortType); ?> ">阶段             <?php if(($order) == "stage"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="num_vote"><a href="javascript:sortBy('num_vote','<?php echo ($sort); ?>','index_stage_1')" title="按照实际得票数                 <?php echo ($sortType); ?> ">实际得票数                 <?php if(($order) == "num_vote"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="num_vote_show"><a href="javascript:sortBy('num_vote_show','<?php echo ($sort); ?>','index_stage_1')" title="按照展示票数                 <?php echo ($sortType); ?> ">展示票数                 <?php if(($order) == "num_vote_show"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th data-field="is_win"><a href="javascript:sortBy('is_win','<?php echo ($sort); ?>','index_stage_1')" title="按照是否晋级<?php echo ($sortType); ?> ">是否晋级<?php if(($order) == "is_win"): ?><img src="/jtjk/public/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr></tfoot></table>
<!-- Think 系统列表组件结束 -->

        <div class="table-actions">
				<!--<button class="btn btn-primary btn-small" type="button" onclick="foreverdel();" data-action="<?php echo U('Contingent/Show/delete');?>" data-subcheck="true">删除</button>
        		<button type="submit" class="btn btn-primary btn-small btn_submit J_ajax_submit_btn">排序</button>-->
			</div>
            <div class="mypager">
    <div class="btn-group dropdown">
        <button class="btn  btn-default dropdown-toggle" data-toggle="dropdown">
            <?php echo ($listRows); ?>&nbsp;<span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <?php if(is_array($listRowsList)): foreach($listRowsList as $key=>$lrl): ?><li><a  href="javascript:void(0);" onclick="javascript:turm_listRows(<?php echo ($lrl); ?>);"><?php echo ($lrl); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </div>
    <div class="total" style=" float:left;height:52px; line-height:52px; padding-left:10px;">共 <?php echo ($listcount); ?> 条数据</div>
    <div class="pagination"><?php echo ($page); ?></div>
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