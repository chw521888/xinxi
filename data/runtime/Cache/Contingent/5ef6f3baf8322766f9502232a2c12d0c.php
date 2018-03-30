<?php if (!defined('THINK_PATH')) exit(); $page_head_info=array( 'title' => $info['show_name'] ); ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="<?php if($page_head_info['keywords'] != ''): else: echo (C("PUBLIC_SEO_KEYWORD")); endif; ?>" />
	<meta name="description" content="<?php if($page_head_info['description'] != ''): else: echo (C("PUBLIC_SEO_DESCRIPTION")); endif; ?>" />
    <title><?php if($page_head_info['title'] != ''): echo ($page_head_info["title"]); else: echo (C("PUBLIC_SEO_TITLE")); endif; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/template_m/Index/Common/css/common.css">
    <link rel="stylesheet" href="/template_m/Index/Common/css/style.css">
    <script type="text/javascript" src="/template_m/Index/Common/js/vote.js"></script>
    <script type="text/javascript" src="/template_m/Index/Common/js/jquery.js"></script>
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
			imgUrl: 'http://jtjk.xinxife.org/test/template_m/Index/NewCommon/images/banner.jpg',
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



<div class="box box_top_ad" style="height: 0px; overflow: hidden;">
          <div>
            <div class="list_sm_plan"><img src="/template_m/Index/Common/images/list_tp.jpg"></div>
          </div>
  </div>
<!--
<script type="text/javascript" src="/template_m/Index/Common/js/jquery.bxslider.js"></script>
<link href="/template_m/Index/Common/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
<div class="slider8">
    <?php $list_g = M('Ggao')->order(' sort asc ')->select(); ?>
    <?php if(is_array($list_g)): foreach($list_g as $key=>$vo): ?><div class="slide"><img src="<?php echo ($vo["pic"]); ?>"></div><?php endforeach; endif; ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
      $('.slider8').bxSlider({ 
        slideWidth:1200,
        auto: true,
        mode: 'horizontal',
        pause:2000,
        adaptiveHeight: true,
        startSlides: 0, 
        slideMargin: 0
      });
    });
</script>

-->
<!------------头部开始------------>
<script> 

function show_ad(){
    var ad_height=$('.box_top_ad img').height();
    $('.box_top_ad').animate({height: ad_height});
    $('.top-menu').animate({top: ad_height});
}
function hide_ad(){
    var ad_height=$('.box_top_ad img').height();
    $('.box_top_ad').animate({height: 0});
    $('.top-menu').animate({top: 0});
}


    $(document).ready(function(){ 
        show_ad();
        var last_scroll_top=0; 
        document.addEventListener('touchmove', function(e) {
              $('.box_top_ad').css({height: 0});
              $('.top-menu').css({top: 0});
        });
        $(window).scroll(function(){      
          var h=$("body").scrollTop();      
          /**
          if (h>1) {
          };
          **/
                if ($(document).scrollTop() <= 0 && last_scroll_top>=2) {
                  /**
                    console.log("滚动条已经到达顶部为0,上一次滚动"+last_scroll_top);
                    $(".top-menu").css('top','20em');       
                    $(".list_sm_plan").show();        
                    $(".count").css("padding-top:","0px");
                    **/
                  //location.reload();
                }
                if ($(document).scrollTop() >10){
                    console.log("离开顶部了");
                    /**
                    $(".top-menu").css("top","0px");
                    //$(".top-menu").animate({top:'0'});        
                    $(".list_sm_plan").hide();        
                    $(".count").css("padding-top","10px");
                    **/
                    hide_ad();
                }

                if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                    //console.log("滚动条已经到达底部为" + $(document).scrollTop());
                }
                last_scroll_top=$(document).scrollTop();

          }); 
    });
</script>
<div class="top-menu" style="clear: both; top:0em; z-index:9999999">
    <a href="javascript:history.go(-1)" class="back"><img src="/template_m/Index/Common/images/top_left.png"></a>
    <a href="#" class="name"><?php echo ($info["show_name"]); ?></a>
    <a class="top-save" style="margin-top: 8px;"><img src="/template_m/Index/Common/images/fsq.png" width="21" height="27"></a>
    </div>
<!------------内容区域开始-------->
<!---视频---->
<div class="video">
<div style="position:relative; z-index:1">
<?php if($info['video2'] != ''): ?><script type="text/javascript"> var letvcloud_player_conf =  {"uu":"uilcwncrnf","vu":"<?php echo $info['video2']; ?>","pu":"1348d387b0","auto_play":0,"gpcflag":1,"width":'100%',"height":290};</script><script type="text/javascript" src="http://yuntv.letv.com/bcloud.js"></script>
<?php else: ?>
        <video id="hellofitvideo" width="100%" height="290" controls="controls" src="<?php echo ($info["video"]); ?>" poster="<?php echo ($info["pic"]); ?>">
<source src="<?php echo ($info["video"]); ?>" type='video/mp4; codecs="avc1.42E01E,MP4a.40.2"' />
</video><?php endif; ?>
    <p><?php echo ($info["show_name"]); ?></p>
    </div>
</div>
<!---投票---->
<div class="vote">
    <ul>
        <li>
            <p><?php echo (show_l2_name($info["location_id"])); ?></p>
            <p>参赛人数：<?php echo ($info2["num_competition"]); ?>人 </p>
        </li>
        <li class="tp praise" onclick="post_vote(<?php echo ($info["id"]); ?>,1);">我要投票（<?php echo ($info["num_vote_show"]); ?>票）</li>
    </ul>
</div>
<?php if($info2['resume'] != ''){ ?>
<!---团队介绍---->
<div class="team">
    <ul>
        <li>
            <span> 团队介绍</span>
            <p><?php echo (make_textarea($info2["resume"])); ?></p>
        </li>
    </ul>
</div>
<?php } ?>
<!--<div class="team">
    <ul>
        <li>
            <span> 团队人员组成</span>
            <p><?php echo ($info2["content_2"]); ?></p>
        </li>
    </ul>
</div>
<div class="team">
    <ul>
        <li>
            <span> 获得奖项</span>
            <p><?php echo ($info2["content_3"]); ?></p>
        </li>
    </ul>
</div>
<div class="team">
    <ul>
        <li>
            <span> 参加重大活动比赛</span>
            <p><?php echo ($info2["content_4"]); ?></p>
        </li>
    </ul>
</div>
<div class="team">
    <ul>
        <li>
            <span> 节目创作故事</span>
            <p><?php echo ($info2["content_5"]); ?></p>
        </li>
    </ul>
</div>-->

<!----------
<div class="footer">
<?php $info_37 = get_arctype_info(37); ?>
<?php $info_38 = get_arctype_info(38); ?>
	<ul>
        <li><a href="<?php echo ($info_37["url"]); ?>"><?php echo ($info_37["typename"]); ?></a> <a href="<?php echo ($info_38["url"]); ?>"> | <?php echo ($info_38["typename"]); ?></a></li>
    </ul>
    <ul>
        <li><?php echo C('PUBLIC_FOOT_INFO');?></li>
    </ul>
</div>
----------->
 <div style="width:0px; height:0px; overflow:hidden;"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1258506973'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/stat.php%3Fid%3D1258506973' type='text/javascript'%3E%3C/script%3E"));</script></div>

<div class="base">
    <ul style="margin-top: -20px;">
        <li class="base-li1" style="background: #ca192b;"><a><span style="color: #fff;">赛区</span></a> </li>
        <?php if(is_array($city_list)): foreach($city_list as $key=>$vo): ?><li class="base-li2">
            <p><a style="color:#333;"><?php echo ($vo["name"]); ?></a></p>
            <p><a <?php if($vo['shequ'] == 1): ?>href="index.php?m=Contingent&c=IndexShow&a=index_shequ&location_id=<?php echo ($vo["id"]); ?>" style="color:red;font-size:1rem;"<?php endif; ?>>推荐赛</a></p>
            <p><a <?php if($vo['is_effect'] == 1): ?>href="index.php?m=Contingent&c=IndexShow&a=index_street&location_id=<?php echo ($vo["id"]); ?>"style="color:red; font-size:1rem;"<?php endif; ?>>初级赛</a></p>
            <p><a <?php if($vo['status'] == 1): ?>href="index.php?m=Contingent&c=IndexShow&a=index_city&location_id=<?php echo ($vo["id"]); ?>" style="color:red;font-size:1rem;"<?php endif; ?>>城市赛</a></p>
            </li><?php endforeach; endif; ?>
    </ul>
</div>
<div class="mb"></div>
</body>
</html>
<script>
    $(function(){

        $(".top-save").click(function(){
            $(".base").fadeIn(300);
            $(".mb").show();
        });
        $(".mb").click(function(){
            $(".base").hide();
            $(".mb").hide();
        })

    });
</script>