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
		<div class="warp direct">
			
			<div class="item">
				<div class="item_name"><a href="<?php echo U('Archives/IndexArctype/index',array('t_id'=>76));?>">少儿直通车 [更多]</a></div>
			</div>
			<?php $list = get_article(array('arctype_id'=>76,'limit'=>10)); ?>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><ul class="direct_list">
				<li><a href="<?php echo ($v["url"]); ?>"><img src="<?php echo ($v["pic"]); ?>" alt=""></a></li>
				<li class="t"><a href="#"><?php echo ($v["title"]); ?></a></li>
				<li>表演者：<?php echo ($v["resume"]); ?></li>
			</ul><?php endforeach; endif; ?>

			<div class="item">
				<div class="item_name"><a href="<?php echo U('Archives/IndexArctype/index',array('t_id'=>77));?>">成人直通车 [更多]</a></div>
			</div>
			<?php $list = get_article(array('arctype_id'=>77,'limit'=>10)); ?>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><ul class="direct_list">
				<li><a href="<?php echo ($v["url"]); ?>"><img src="<?php echo ($v["pic"]); ?>" alt=""></a></li>
				<li class="t"><a href="#"><?php echo ($v["title"]); ?></a></li>
				<li>表演者：<?php echo ($v["resume"]); ?></li>
			</ul><?php endforeach; endif; ?>
			
			<!-- 内容     End-->
		

		<!-- <div class="public_pagination_154">
		  <div class="m_pagination">
		   <div class="fenye"><?php echo ($page_m); ?></div>
		  </div> 
		</div> -->

	</body>
</html>

<script src="http://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/template_m/Index/NewCommon/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="/template_m/Index/NewCommon/js/jquery.newsticker.js" ></script>
<script src="/template_m/Index/NewCommon/js/jquery.newsticker.js"></script>
<script src="/template_m/Index/NewCommon/js/cascade.js"></script>
<script src="/template_m/Index/NewCommon/js/page.js"></script>