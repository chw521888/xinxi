<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php if($page_head_info['keywords'] != ''): else: echo (C("PUBLIC_SEO_KEYWORD")); endif; ?>" />
<meta name="description" content="<?php if($page_head_info['description'] != ''): else: echo (C("PUBLIC_SEO_DESCRIPTION")); endif; ?>" />
<title><?php if($page_head_info['title'] != ''): else: echo (C("PUBLIC_SEO_TITLE")); endif; ?></title>
<link href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/template/Index/NewCommon/css/style.css"/>
</head>
<body>
  
<!--banner    开始-->
        <div class="warp">
            <div class="banner"><img src="/template/Index/NewCommon/images/banner.jpg"/></div>
        </div>
        <!--banner    End-->
        
<script type="text/javascript" src="/template/Index/Common/js/jquery.js"></script>
<!--导航              开始-->
        <div class="menu">
            <ul class="warp" id="nav">
                <li><a href="/">首页</a></li>
                <?php $menu_list=get_menu_channel(array('limit'=>8)); ?>
                <?php if(is_array($menu_list)): foreach($menu_list as $key=>$ml): ?><li><a <?php if($key != 0): ?>href="<?php echo ($ml["url"]); ?>"<?php endif; ?>><?php echo ($ml["typename"]); ?></a>
                    <?php if($key == 0): ?><ul class="second_nav">
                        <?php if(is_array($city_list)): foreach($city_list as $key=>$vo): ?><li>
                                <a href="#this" style="cursor:initial;"><?php echo ($vo["name"]); ?></a>
                                <a <?php if($vo['shequ'] == 1): ?>href="index.php?m=Contingent&c=IndexShow&a=index_shequ&location_id=<?php echo ($vo["id"]); ?>" style="color:red"<?php endif; ?>>推荐赛</a>
                                <a <?php if($vo['is_effect'] == 1): ?>href="index.php?m=Contingent&c=IndexShow&a=index_street&location_id=<?php echo ($vo["id"]); ?>" style="color:red"<?php endif; ?>>初级赛</a>
                                <a <?php if($vo['status'] == 1): ?>href="index.php?m=Contingent&c=IndexShow&a=index_city&location_id=<?php echo ($vo["id"]); ?>" style="color:red"<?php endif; ?>>市级赛</a>
                            </li><?php endforeach; endif; ?>
                            <div><a <?php if(C('IS_START_COUNTRY') == 1): ?>href="<?php echo U('Contingent/IndexShow/index_finals');?>"<?php endif; ?>>总决赛</a></div>
                        </ul><?php endif; ?>
                </li><?php endforeach; endif; ?>
            </ul>
        </div>
        <!--导航              End-->

<div class="city">
    <p class="city-block" data-is-open="0"></p>
    <div>
        <ul>
    <?php if(is_array($city_list)): foreach($city_list as $key=>$vo): $str = "#this"; if($vo['shequ'] == 1){ $str = U('Contingent/IndexShow/index_shequ',array('location_id'=>$vo['id'])); } if($vo['is_effect']==1){ $str = U('Contingent/IndexShow/index_street',array('location_id'=>$vo['id'])); } if($vo['status']==1){ $str = U('Contingent/IndexShow/index_city',array('location_id'=>$vo['id'])); } ?>
        <li><a href="<?php echo ($str); ?>" <?php if(($vo['status']) == "1"): ?>style="color:#ff0000;"<?php endif; ?>><?php echo ($vo["name"]); ?></a><p></p></p></li><?php endforeach; endif; ?>
        </ul>
    </div>
</div>

<div class="floating-window">
    <ul>
        <div class="theme-popover">
        <!-- <div class="tips-del">
            <img src="/template/Index/Common/images/gb.jpg" width="30" height="30" class="error"/>
            <h1>我要报名</h1>
            <ul>
            <form id="form1" name="form1" method="post" action="<?php echo U('Index/Index/insert_bm');?>">
                <li>
                    姓　　名:
                    <input type="text" name="name" value=""/>
                </li>
                <li>
                    年　　龄:
                    <input type="text" name="age" value=""/>
                </li>
                <li>
                    联系方式:
                    <input type="text" name="tel" value=""/>
                </li>
                <li>
                    家庭住址:
                    <input type="text" name="address" value=""/>
                </li>
                <li>
                    报名人数:
                    <input type="text" name="bm_num" value=""/>
                </li>
                <input name="提交" type="submit" value="提交报名"/>
            </form>
            </ul>
        </div> -->
        </div>
        <!--比赛规则-->
        <!-- <div class="theme-popover1">
         <div class="ruler-del">
         <?php $info_37 = get_arctype_info(37); ?>
            <img src="/template/Index/Common/images/gb.jpg" width="30" height="30" class="error1"/>
            <h1><?php echo ($info_37["typename"]); ?></h1>
            <ul>
                <li><?php echo (htmlspecialchars_decode($info_37["content"])); ?></li>
            </ul>
        </div>
        </div> -->
        <!--比赛规则结束-->
    <!--投票规则-->
        <!-- <div class="theme-popover2">
            <div class="ruler-del">
                <?php $info_37 = get_arctype_info(38); ?>
                <img src="/template/Index/Common/images/gb.jpg" width="30" height="30" class="error3"/>
                <h1><?php echo ($info_38["typename"]); ?></h1>
                <ul>
                    <li><?php echo (htmlspecialchars_decode($info_38["content"])); ?></li>
                </ul>
            </div>
        </div> -->
        <!--投票规则结束-->
        <!-- <div class="tp-secces">
            <img src="/template/Index/Common/images/gb-2_03.jpg" width="17" height="17" class="error2"/>
            <ul>
                <li><span>提示<br/>您已投票成功</span></li>
            </ul>
        </div> -->
        <li><p class="return" id="gotoTop">返回顶部</p></li>
        <!-- <li><p class="tips">我要报名</p></li>
        <li><a href="index.php?m=Archives&c=IndexArctype&a=index&t_id=14"><p class="download">资料下载</p></a></li>
        <li><p class="ruler">比赛规则</p></li>
        <li><p class="vote-ruler">投票规则</p></li>
        <li><p class="red-ewm" data-is-open="0">二维码</p></li>
       <p class="click-ewm"><img src="/template/Index/Common/images/click-ewm.png" alt=""/></p> -->
    </ul>
</div>
<!--二维码 左边--><div class="le_gb" title="扫码关注微信"></div>
<div class="left_eq">
    <div>手机扫码关注微信每天可以投2票哦</div>
    <img src="/template/Index/Common/images/eq.jpg" width="114" height="114" />    <span>关闭</span>
</div>

<!--二维码 右边--><div class="ri_gb" title="扫码体质测试"></div>
<div class="right_eq">
    <h4>中医体质测试 </h4>
    <img src="/template/Index/Common/images/tzcs.png" width="114" height="114" />
    <span>关闭</span>
</div>
<script>
    
   //  $(function(){
   //      <!--我要报名-->
   //      $('.tips').click(function(){
   //          $('.theme-popover-mask').fadeIn(100);
   //          $('.theme-popover').slideDown(200);
   //      });
   //      $('.theme-popover-mask').click(function(){
   //          $('.theme-popover-mask').fadeOut(100);
   //          $('.theme-popover').slideUp(200);
   //      });
   //      $(".error").click(function(){
   //          $(".theme-popover-mask").hide();
   //          $(".theme-popover").slideUp(200);
   //      });
   //  });
   //  <!--我要报名结束-->
   //  <!--比赛规则-->
   //  $(function(){
   //      $('.ruler').click(function(){
   //          $('.theme-popover-mask').fadeIn(100);
   //          $('.theme-popover1').slideDown(200);
   //      });
   //      $('.theme-popover-mask').click(function(){
   //          $('.theme-popover-mask').fadeOut(100);
   //          $('.theme-popover1').slideUp(200);
   //      });
   //      $(".error1").click(function(){
   //          $(".theme-popover-mask").hide();
   //          $(".theme-popover1").slideUp(200);
   //      });
   //  });
   //  <!--比赛规则结束-->
   //  <!--投票规则-->
   //  $(function(){
   //      $('.vote-ruler').click(function(){
   //          $('.theme-popover-mask').fadeIn(100);
   //          $('.theme-popover2').slideDown(200);
   //      });
   //      $('.theme-popover-mask').click(function(){
   //          $('.theme-popover-mask').fadeOut(100);
   //          $('.theme-popover2').slideUp(200);
   //      });
   //      $(".error3").click(function(){
   //          $(".theme-popover-mask").hide();
   //          $(".theme-popover2").slideUp(200);
   //      });
   //  });
   //  <!--投票规则结束-->
   //      $(window).scroll(function(){
   //          var v=$("body").scrollTop();
   //          if(v>700){
   //              $(".city").show();
   //          }
   //      });

    $(function(){
        $(".city>p").click(function(){
            var is_open=$(this).attr('data-is-open');
            if(is_open==0){
                $(this).removeClass("city-block");
                $(this).addClass("city-none");
                $(".city").animate({left:"0px"}).show();
                $(this).attr('data-is-open',1);
                // $(".left_eq").animate({left:'248px'},400);
            }
           else{
                $(this).removeClass("city-none");
                $(this).addClass("city-block");
                $(".city").animate({left:"-200px"}).show();
                $(this).attr('data-is-open',0);
                // $(".left_eq").animate({left:'48px'},400);
           }
        });
    });


   // $(function(){

   //     $(".red-ewm").hover(function() {
   //         $(".mb1").css({display: "block",zindex:"1100"});
   //         $(".click-ewm").show();
   //     },function(){
   //         $(".mb1").css({display: "block",zindex:"1100"});
   //         $(".click-ewm").hide();
   //     });

   //         $(".mb1").click(function(){
   //             $(this).hide();
   //             $(".click-ewm").hide();
   //         });
   //         $(".click-ewm").click(function(){
   //             $(this).hide();
   //             $(".click-ewm").hide();
   //         });
   // });


function gotoTop(min_height){ 

    $("#gotoTop").click(//定义返回顶部点击向上滚动的动画 
        function(){$('html,body').animate({scrollTop:0},900);
    })
}
gotoTop(); 
</script>
<script>        
$(".left_eq span").click(function(){            
    $(".left_eq").hide();        
});        
$(".le_gb").hover(function(){            
    $(".left_eq").show();        
});       
        
$(".right_eq span").click(function(){
        $(".right_eq").hide();
 });        
$(".ri_gb").hover(function(){            
    $(".right_eq").show();        
});        
    </script>

		
		
		<div class="warp">
			
			<div class="list_item_box">
				<div class="list_city_ti"><?php echo ($info["typename"]); ?></div>
			</div>
			
			<div class="z-new clearfix">
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><ul class="z-new-l">
					<li>
						<a href="<?php echo ($v["url"]); ?>"><img src="<?php echo ($v["pic"]); ?>" width="165" height="115"></a>
						<a href="<?php echo ($v["url"]); ?>">
						<p>
							<?php echo ($v["title"]); ?>
						</p>
						<span><?php echo ($v["resume"]); ?></span>
						<p class="date"><?php echo (turn_time($v["time"],1)); ?></p>
						</a>
					</li>
				</ul><?php endforeach; endif; ?>
			</div>
			
			
			<div class="public_pagination_154">
		        <!-- PC 分页  -->
		        <div class="pagination_pc"><?php echo ($page); ?></div>
		    </div>
			
		</div>
		<div class="footer">
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?9b8347022dae9d1a4eca1465cfbb8e4b";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?38825a55bac0509dba506948cd6314bb";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>



    <div class="footer1"></div>
    <div class="footer2">
        <ul class="footer-logo">
            <li>全国社区健康舞大赛</li>
        </ul>
        <ul class="footer-list">
            <li>
                <?php $info_36 = get_arctype_info(36); ?>
                <?php $info_37 = get_arctype_info(37); ?>
                <?php $info_38 = get_arctype_info(38); ?>
                <p><a href="<?php echo ($info_36["url"]); ?>"><?php echo ($info_36["typename"]); ?></a></p>
                <p><a href="<?php echo ($info_37["url"]); ?>"><?php echo ($info_37["typename"]); ?></a></p>
                <p><a href="<?php echo ($info_38["url"]); ?>"><?php echo ($info_38["typename"]); ?></a></p>
            </li>
            <li>
               <img src="/template/Index/Common/images/line1.png" alt=""/>
            </li>
            <li>
                <?php $info_28 = get_arctype_info(28); ?>
                <?php $info_29 = get_arctype_info(29); ?>
                <?php $info_34 = get_arctype_info(34); ?>
                <p><a href="<?php echo ($info_28["url"]); ?>"><?php echo ($info_28["typename"]); ?></a></p>
                <p><a href="<?php echo ($info_29["url"]); ?>"><?php echo ($info_29["typename"]); ?></a></p>
                <p><a href="<?php echo ($info_34["url"]); ?>"><?php echo ($info_34["typename"]); ?></a></p>
            </li>
            <li>
                <img src="/template/Index/Common/images/line1.png" alt=""/>
            </li>
            <li>
                <?php $info_39 = get_arctype_info(39); ?>
                <?php $info_40 = get_arctype_info(40); ?>
                <?php $info_41 = get_arctype_info(41); ?>
                <p><a href="<?php echo ($info_39["url"]); ?>"><?php echo ($info_39["typename"]); ?></a></p>
                <p><a href="<?php echo ($info_40["url"]); ?>"><?php echo ($info_40["typename"]); ?></a></p>
                <p><a href="<?php echo ($info_41["url"]); ?>"><?php echo ($info_41["typename"]); ?></a></p>
            </li>
            <li class="copyright"><?php echo C('PUBLIC_FOOT_INFO');?> <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1258506973'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/stat.php%3Fid%3D1258506973' type='text/javascript'%3E%3C/script%3E"));</script></li>
        </ul>
        <ul class="footer-ewm">
            <li>官方微信</li>
        </ul>
    </div>
</div>
 <script>
 $(function(){

    $(".fsq").hover(function(){
        $(".drop-down").stop(true,true).slideDown();
    },
    function(){
        $(".drop-down").stop(true,true).slideUp();
    });
});    
</script>
        

	</body>
</html>

<script src="http://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/template/Index/NewCommon/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="/template/Index/NewCommon/js/jquery.newsticker.js" ></script>
<script>
  $("#nav li").hover(function(){
    $(this).find(".second_nav").slideToggle();
  })
  
</script>