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
<style>
	.match {
	    padding: 0 0.26rem;
	    background-color: #fff;
	    padding-top: 0.3rem;
	}
	.match li {
    font-size: 0.32rem;
    background-color: #e6e6e6;
    float: left;
    margin-right: 0.2rem;
    margin-bottom: 0.3rem;
    padding: 0 0.3rem;
    border-radius: 0.3rem;
    line-height: 0.6rem;
	}
	.match li.active{
		background-color: #c72f56;
	}
	.match li a,.match li a:hover{
		display: block;
		color: #333;
	}
	.match li.active a,.match li.active a:hover{
		color: #fff;
	}
	.post_vote_huihua{
		line-height: 0.7rem;
    background-color: #ca192b;
    text-align: center;
    color: #fff;
    border-radius: 0.1rem;
    font-size: 0.38rem;
	}
	.brand-list .brand-bd {
	    position: relative;
	    margin-top: 0.2rem;
	}
	.item input.search_btn_m{
		background: transparent;
    width: 0.5rem;
    position: absolute;
    right: 3rem;
    border: none;
	}
</style>
		<!-- 内容     开始-->
		<div class="warp">
			
			<div class="item">
				<div class="item_name">儿童绘画赛</div>
				<form action="?" method="get">
				<input type="hidden" value="<?php echo (MODULE_NAME); ?>" name="m" />
	            <input type="hidden" value="<?php echo (CONTROLLER_NAME); ?>" name="c" />
	            <input type="hidden" value="<?php echo ACTION_NAME; ?>" name="a" />
	            <input type="hidden" value="<?php echo ($_GET['stage']); ?>" name="stage" />
							<input type="text" name="keywords" placeholder="请搜索ID、昵称">
							<input type="submit" class="search_btn_m">
				</form>
			</div>

			<div class="list">
				<ul class="match clearfix">
					<?php if($huihua_type >= 7): ?><li <?php if($stage == 4): ?>class="active"<?php endif; ?>><a href="<?php echo U('Huihua/IndexHuihua/index',array('stage'=>4));?>">绘画总决赛</a></li><?php endif; ?>
					<?php if($huihua_type >= 5): ?><li <?php if($stage == 3): ?>class="active"<?php endif; ?>><a href="<?php echo U('Huihua/IndexHuihua/index',array('stage'=>3));?>">第三阶段赛</a></li><?php endif; ?>
					<?php if($huihua_type >= 3): ?><li <?php if($stage == 2): ?>class="active"<?php endif; ?>><a href="<?php echo U('Huihua/IndexHuihua/index',array('stage'=>2));?>">第二阶段赛</a></li><?php endif; ?>
					<?php if($huihua_type >= 1): ?><li <?php if($stage == 1): ?>class="active"<?php endif; ?>><a href="<?php echo U('Huihua/IndexHuihua/index',array('stage'=>1));?>">第一阶段赛</a></li><?php endif; ?>
						<li><a href="<?php echo U('archives/index_arctype/index',array('t_id'=>74));?>">获奖作品公布</a></li>
						<li><a href="<?php echo U('archives/index_arctype/index',array('t_id'=>75));?>">绘画比赛规则</a></li>
				</ul>
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
	                  	<!-- <i class="n"> <img src="/template_m/Index/NewCommon/images/zan.png" alt=""> <?php echo ($v["num_view"]); ?></i> -->
                  	</div>
                  	<a class="capt" href="<?php echo U('show',array('id'=>$v['id']));?>"><?php echo ($v["title"]); ?></a>
                  	<div class="post_vote_huihua" onclick="post_vote_huihua(<?php echo ($v["id"]); ?>,1);">投票(<?php echo ($v["num_view"]); ?>)</div>
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
		<div class="upload"><a href="<?php echo U('Huihua/IndexHuihua/up',array('id'=>$id,'stage'=>$stage_num));?>"><img src="/template_m/Index/NewCommon/images/m_etzcy_icon_3.png" alt=""><?php if($id == 0): ?>上 传<?php else: ?>修改<?php endif; ?></a></div>
		<!-- 上传      End -->
	</body>
</html>
<script>
			var post_vote_huihua=function(huihua_id,type){
				var post_data={"huihua_id":huihua_id,"type":type};
				//ajax 提交form
		    $.ajax({
		        url : "<?php echo U('Huihua/IndexHuihua/post_vote');?>",
		        type : "POST",
		        data : "huihua_id="+huihua_id+"&type="+type,
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