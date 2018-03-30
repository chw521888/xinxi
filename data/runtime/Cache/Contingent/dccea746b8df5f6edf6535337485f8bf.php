<?php if (!defined('THINK_PATH')) exit(); $page_head_info=array( 'title' => show_street_name($s_id,$location_id) ); ?>
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

    <!--组件依赖 begin-->
    <link rel="stylesheet" type="text/css" href="/template_m/Index/Common/lead/reset.css" />
    <link rel="stylesheet" type="text/css" href="/template_m/Index/Common/lead/navigator.css" />
    <link rel="stylesheet" type="text/css" href="/template_m/Index/Common/lead/navigator.iscroll.css" />
    <link rel="stylesheet" type="text/css" href="/template_m/Index/Common/lead/navigator.default.css" /><!--皮肤文件，若不使用该皮肤，可以不加载-->
    <link rel="stylesheet" type="text/css" href="/template_m/Index/Common/lead/navigator.iscroll.default.css" /><!--皮肤文件，若不使用该皮肤，可以不加载-->

    <script type="text/javascript" src="/template_m/Index/Common/lead/zepto.js"></script>
    <script type="text/javascript" src="/template_m/Index/Common/lead/zepto.extend.js"></script>
    <script type="text/javascript" src="/template_m/Index/Common/lead/zepto.ui.js"></script>
    <script type="text/javascript" src="/template_m/Index/Common/lead/zepto.iscroll.js"></script>
    <script type="text/javascript" src="/template_m/Index/Common/lead/navigator.js"></script>
    <script type="text/javascript" src="/template_m/Index/Common/lead/navigator.iscroll.js"></script>
    <!--组件依赖 end-->

<style type="text/css">
  .top-menu{    position: fixed;    top: 20em;    left: 0;  } 
  .count>ul{    padding-top: 0;  }
  /*.count>ul{    padding-top: 9em !important;  }*/
  .roll-nav{
    margin-top: 54px;
  }
</style>

<script type="text/javascript" src="/template_m/Index/Common/js/jquery.bxslider.js"></script>
<link href="/template_m/Index/Common/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/template_m/Index/Common/js/touche.js"></script>
<script type="text/javascript" src="/template_m/Index/Common/js/p-pull-refresh.js"></script>


<!--头部开始-->
  <div class="loading-warp">
<div class="box box_top_ad" style="height: 0px; overflow: hidden;">
          <div>
            <div class="list_sm_plan"><img src="/template_m/Index/Common/images/list_tp.jpg"></div>
          </div>
  </div>
  <div class="content">
    
  
<div class="top-menu" style="clear: both; top:0em; z-index:9999999">
       <a href="javascript:history.go(-1)" class="back" style="top:0.3em;"><img src="/template_m/Index/Common/images/top_left.png"></a>        <a href="#" class="name" style="margin-bottom: 0px; height: 44px; line-height: 44px; margin-top: 0px;"><?php echo (show_street_name($s_id,$location_id)); ?></a>     
        <!-- <a class="top-save"><img src="/template_m/Index/Common/images/fsq.png" width="21" height="27"> -->
        <a class="top-save">赛区&gt</a> 
  </div>
  <!--导航开始--> 
  <div class="roll-nav" style="float: left;"> 
      <div class="nav-none">  
          <table> 
              <tr>  
                    <td><a href="index.php?m=Contingent&c=IndexShow&a=index_street&location_id=<?php echo ($info_list["0"]["location_id"]); ?>&s_id=<?php echo ($info_list["0"]["id"]); ?>&street_id=99">儿童组</a></td>
                  <?php if(is_array($info_list)): foreach($info_list as $k=>$vo): ?><td><a href="index.php?m=Contingent&c=IndexShow&a=index_street&location_id=<?php echo ($vo["location_id"]); ?>&s_id=<?php echo ($vo["id"]); ?>&street_id=<?php echo ($k); ?>"><?php echo ($vo["name"]); ?></a></td>
			<?php if($k == 1 or $k == 3): ?></tr>
				<tr><?php endif; endforeach; endif; ?>  
              </tr>
          </table>  
      </div>  
  </div>  
  <!--导航结束--></div>
<!--头部结束-->
<div class="clear"></div>

<!--内容区域开始-->
<div class="count">
    <ul>
    <?php if(is_array($child_list)): foreach($child_list as $key=>$v): if(($street_id) == "99"): ?><li> <a href="<?php echo U('IndexShow/index_show',array('id'=>$v['id']));?>"><img src="<?php echo ($v["pic"]); ?>" width="100%" height="150px"></a>
                    <p class="mb1"><?php echo ($v["show_name"]); ?></p>
                    <a onclick="post_vote(<?php echo ($v["id"]); ?>,1);">
                        <p><img src="/template_m/Index/Common/images/praise.png" width="17" height="17"><span>投票（<?php echo ($v["num_vote_show"]); ?>票）</span></p>
                    </a>
                </li><?php endif; endforeach; endif; ?>
    <?php if(is_array($info_list)): foreach($info_list as $k=>$vo): if(is_array($vo["value"])): foreach($vo["value"] as $key=>$v): if(($k) == $street_id): ?><li> <a href="<?php echo U('IndexShow/index_show',array('id'=>$v['id']));?>"><img src="<?php echo ($v["pic"]); ?>" width="100%" height="150px"></a>
                    <p class="mb1"><?php echo ($v["show_name"]); ?></p>
                    <a onclick="post_vote(<?php echo ($v["id"]); ?>,1);">
                        <p><img src="/template_m/Index/Common/images/praise.png" width="17" height="17"><span>投票（<?php echo ($v["num_vote_show"]); ?>票）</span></p>
                    </a>
                </li><?php endif; endforeach; endif; endforeach; endif; ?>
    </ul>
</div>
</div>

</div>
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

function getTopDistance() {
            return document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
}
    $(document).ready(function(){ 
        show_ad();
        var last_scroll_top=0;  
        document.addEventListener('touchmove', function(e) {
              $('.box_top_ad').css({height: 0});
              $('.top-menu').css({top: 0});
        });
        document.addEventListener('touchmove', function(e) {
          if (getTopDistance() <= -10) {
              location.reload();
          }
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
                  hide_ad();
                }

                if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                    //console.log("滚动条已经到达底部为" + $(document).scrollTop());
                }
                last_scroll_top=$(document).scrollTop();

          }); 
    });
</script>
<script> 
    var startTop=0;
    var endTop=0;
     /**$(document).ready(function(){ 
     
     $(window).touchstart(function(){  
        startTop=$("body").clientX();  
        console.log('aaa');
      });

     $(window).touchend(function(){  
        endTop=$("body").clientY();  
        console.log(endTop);
     });
     
     $(window).scroll(function(){      
      var h=$("body").scrollTop();  
      //console.log(h);
      if (h<0) {
          console.log('aaaaa');
              $(".top-menu").animate({top:'20em'});        
              $(".list_sm_plan").show();        
              $(".count").css("padding-top:","0px")                               
        };    
      });
     });
    **/
</script>
<script type="text/javascript">
  /**
  var $statu = $('.loading-warp .text');

  console.log( $statu);
  var pullRefresh = $('.count').pPullRefresh({
    $el: $('body'),
    $loadingEl: $('.loading-warp'),
    sendData: null,
    url: 'http://89.jingchengidea.com/index.php?m=Contingent&c=IndexShow&a=index_street&location_id=1',
    autoHide: true,
    callbacks: {
      pullStart: function(){
        location.reload(true);  
        console.log('松开开始刷新');
        // $statu.text('松开开始刷新');
      },
      start: function(){
        console.log('数据刷新中···');
        // $statu.text('数据刷新中···');
      },
      success: function(response){
        console.log('数据刷新成功！');
        // $statu.text('数据刷新成功！');
      },
      end: function(){
        console.log('下拉刷新结束');
        // $statu.text('下拉刷新结束');
      },
      error: function(){
        console.log('找不到请求地址,数据刷新失败');
        // $statu.text('找不到请求地址,数据刷新失败');
      }
    }
  });
  **/
</script>
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