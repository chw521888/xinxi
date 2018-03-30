<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="keywords" content="<?php if($page_head_info['keywords'] != ''): else: echo (C("PUBLIC_SEO_KEYWORD")); endif; ?>" />
		<meta name="description" content="<?php if($page_head_info['description'] != ''): else: echo (C("PUBLIC_SEO_DESCRIPTION")); endif; ?>" />
	    <title><?php if($page_head_info['title'] != ''): echo ($page_head_info["title"]); else: echo (C("PUBLIC_SEO_TITLE")); endif; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />
		<link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/template_m/Index/NewCommon/css/style.css"/>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php $jssdk = new \Common\ORG\Util\JSSDK(C('WECHAT_APPID'),C('WECHAT_APPSECRET')); $signPackage = $jssdk->GetSignPackage(); ?>
	<script>
	wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"]; ?>',
    timestamp: <?php echo $signPackage["timestamp"]; ?>,
    nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
    signature: '<?php echo $signPackage["signature"]; ?>',
    jsApiList: [
  		'checkJsApi',
		'onMenuShareTimeline',
		'onMenuShareAppMessage'
		]
  });
  	wx.ready(function () {
		var shareData = {
			title: '中国梦 健康家 家庭药箱进万家',
			desc: '北京同仁堂六味七星杯第二届全国才艺大赛',
			link: window.location.href,
			imgUrl: 'http://jtjk.xinxife.org/test/template/Index/Common/images/banner.jpg',
			success: function () {
					$.ajax({ 
						type: "post", 
						url: "index.php?m=Index&c=Index&a=share_set",
						data: "id=1",
						beforeSend: function(XMLHttpRequest){ 
						 }, 
						success: function(data,textStatus){
							if(data){
									//成功
								}else{
									//失败
								}
						 }
					});
			},
		    cancel: function () { 
		        //alert(0);
		    }
		};
		wx.onMenuShareAppMessage(shareData);
		wx.onMenuShareTimeline(shareData);
	});
	wx.error(function (res) {
	  //alert(res.errMsg);
	});
</script>
	</head>
	<body>



<style>
	.item input.search_btn_m{
		background: transparent;
    width: 0.5rem;
    position: absolute;
    right: 3rem;
    border: none;
	}
</style>
			<!-- 头部     开始 -->
		<div class="top">
			<div class="logo"><a href="#"><img src="/template_m/Index/NewCommon/images/logo.png" alt=""></a></div>
		</div>
		<!-- 头部     End -->

		<!--banner    开始-->
		<div class="warp">
			<div class="banner"><img src="/template_m/Index/Common/images/banner.jpg"/></div>
		</div>
		<!--banner    End-->

		<!-- 内容     开始-->
		<div class="warp">
			
			<div class="item">
				<div class="item_name">赛场风姿</div>
				<form action="?" method="get">
				<input type="hidden" value="<?php echo (MODULE_NAME); ?>" name="m" />
	            <input type="hidden" value="<?php echo (CONTROLLER_NAME); ?>" name="c" />
	            <input type="hidden" value="<?php echo ACTION_NAME; ?>" name="a" />
	            <input type="hidden" value="<?php echo ($_GET['stage']); ?>" name="stage" />
							<input type="text" name="keywords" placeholder="请搜索ID、昵称">
							<input type="submit" class="search_btn_m">
				</form>
			</div>
			
			
			<div class="public_index_204">
				<div id="wrapper">
					<!-- 儿童绘画赛列表开始 -->
					<div class="brand-list clearfix">
						<div class="brand-bd cle" id="brand-waterfall" style="height: 732px;">
						<?php if(is_array($list)): foreach($list as $key=>$v): ?><!-- 循环字母模块 item -->
							<div class="item" id="brand-a">
			                    <div class="brand_img"><a href="<?php echo U('show',array('id'=>$v['id']));?>"><img src="<?php echo ($v["pic"]); ?>" style="width:100%;"></a></div>
			                    <div class="brand_txt">
			                    	<div class="num_z">
			                    		<i>ID:<?php echo ($v["id"]); ?></i> 
			                    		<i class="n  post_zan_fengzi"  onclick="post_zan_fengzi(<?php echo ($v["id"]); ?>);"> <img src="/template_m/Index/NewCommon/images/zan.png" alt=""> <?php echo ($v["num_view"]); ?></i>
			                    	</div>
			                    	<a class="capt" href="<?php echo U('show',array('id'=>$v['id']));?>"><?php echo ($v["title"]); ?></a>
			                    	<div class="data">
			                    		<img src="<?php echo ($v["pic"]); ?>" style="border-radius:18px;">
			                    		<i class="id"><?php echo ($v["user_name"]); ?></i>
			                    	</div>
			                    </div>
			                </div><?php endforeach; endif; ?>
						</div>
						<!-- 儿童绘画赛列表 end -->
					</div>
				</div>
			</div>
			<!-- 内容     End-->
		

		<div class="public_pagination_154">
		  <!--Mbolie 分页 -->
		  <div class="m_pagination">
		   <div class="fenye"><?php echo ($page_m); ?></div>
		  </div> 
		</div>


		<!--底部         开始--> 
		<div class="footer">
			@2016-2017 中国梦 家庭药箱进万家 版权所有 <br /> 技术支持：<a href="http://www.jc2006.com/">京橙科技</a>
		</div>
		<!--底部         End-->


		<!-- 上传      开始 -->
		<div class="upload"><a href="<?php echo U('Fengzi/IndexFengzi/up',array('id'=>$id));?>"><img src="/template_m/Index/NewCommon/images/m_etzcy_icon_3.png" alt=""><?php if($id == 0): ?>上 传<?php else: ?>修改<?php endif; ?></a></div>
		<!-- 上传      End -->
	</body>
</html>
<script>
	var post_zan_fengzi=function(fengzi_id){
				var post_data={"fengzi_id":fengzi_id};
				//ajax 提交form
		    $.ajax({
		        url : "<?php echo U('Fengzi/IndexFengzi/post_vote');?>",
		        type : "POST",
		        data : "fengzi_id="+fengzi_id,
		        success:function(data){
		        	alert(data.info);
		        	location.reload();

		        },
		        error:function(data){
		        	alert("error!");
		        }
		        
		    });
			}
</script>

<script src="http://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/template_m/Index/NewCommon/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="/template_m/Index/NewCommon/js/jquery.newsticker.js" ></script>
<script src="/template_m/Index/NewCommon/js/jquery.newsticker.js"></script>
<script src="/template_m/Index/NewCommon/js/cascade.js"></script>
<script src="/template_m/Index/NewCommon/js/page.js"></script>