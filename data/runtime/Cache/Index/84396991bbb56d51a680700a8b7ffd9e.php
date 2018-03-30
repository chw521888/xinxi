<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<style>
    .event .map{
        position: relative;
    }
    .event .map .jing_city{
        position: absolute;
        width: 50px;
    }
    .event .map .jing_city a{
        display: block;
        color: #333;
    }
    .event .map .jing_city a:hover{
        color: #333;
    }
    .event .map .jing_city img{
        width: 100%;
    }
    .event .map .jing_city1{
        top: 118px;
        right: 92px;
    }
    .event .map .jing_city2{
        top: 301px;
        right: 247px;
    }
    .event .map .jing_city3{
        top: 171px;
        right: 191px;
    }
    .event .map .jing_city4{
        top: 224px;
        right: 101px;
    }
    .event .map .jing_city5{
        top: 69px;
        right: 88px;
    }
    .event .map .jing_city6{
        top: 180px;
        right: 67px;
    }
    .event .map .jing_city7{
        top: 338px;
        right: 134px;
    }
    .event .map .jing_city8{
        bottom: 73px;
        left: 249px;
    }
    .event .map .jing_city9{
        bottom: 259px;
        left: 434px;
    }
    .event .map .jing_city10{
        bottom: 203px;
        left: 365px;
    }
    .event .map .jing_city span {
        position: absolute;
        display: inline-block;
        width: 54px;
        left: 38px;
        font-size: 14px;
        line-height: 30px;
           margin-top: 6px;
        text-align: center;
    }

    .event .map .jing_city span.cityRed{
        color: #fff;
        background: url(/template/Index/NewCommon/images/bg.png) no-repeat; 
        background-size: 100% 100%;
    }
</style>
<?php $list_69 = get_article(array('arctype_id'=>'69','limit'=>'3,10')); $list_2_69 = get_article(array('arctype_id'=>'69','limit'=>'0,3')); $list_10 = get_article(array('arctype_id'=>'10','limit'=>'1,5')); $list_2_10 = get_article(array('arctype_id'=>'10','where'=>'Archives.pic!=""','limit'=>'1')); $list_68 = get_article(array('arctype_id'=>'68','limit'=>'9')); $list_54 = get_article(array('arctype_id'=>'54','limit'=>'1,3')); $list_2_54 = get_article(array('arctype_id'=>'54','where'=>'Archives.pic!=""','limit'=>'1')); $list_70 = get_article(array('arctype_id'=>'70','limit'=>'5')); ?>
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
            <!--赛事公告          开始-->
            <div class="event clearfix">
                <div class="map pull-left">
                    <img src="/template/Index/NewCommon/images/map.gif"/>
                    <?php if(is_array($city_list)): foreach($city_list as $key=>$v): if($key < 11): $href = "#this"; $yx_num = 0; if($v['shequ'] == 1){ $href = U('Contingent/IndexShow/index_shequ',array('location_id'=>$v['id'])); $yx_num = 1; } if($v['is_effect'] == 1){ $href = U('Contingent/IndexShow/index_street',array('location_id'=>$v['id'])); $yx_num = 1; } if($v['status'] == 1){ $href = U('Contingent/IndexShow/index_city',array('location_id'=>$v['id'])); $yx_num = 1; } ?>
                    <div class="jing_city jing_city<?php echo ($key+1); ?>">
                        <a href="<?php echo ($href); ?>">
                        <img src="/template/Index/NewCommon/images/yaoxiang<?php echo ($yx_num); ?>.gif" alt=""><span <?php if($yx_num > 0): ?>class="cityRed"<?php endif; ?>><?php echo ($v["name"]); ?></span>
                        </a>
                    </div><?php endif; endforeach; endif; ?>
                </div>
                
                <div class="notice pull-right">
                    
                    <!--栏目标题       开始-->
                    <div class="ind_title">
                        <span>赛事公告</span> /
                        <i>Event announcement</i>
                        <a href="<?php echo U('archives/index_arctype/index',array('t_id'=>69));?>">更多&gt;&gt;</a>
                    </div>
                    <!--栏目标题       End-->
                    
                    <!--通知公告       开始-->
                    <div class="newsticker">
                        <ul class="newsticker-list">
                        <?php if(is_array($list_2_69)): foreach($list_2_69 as $key=>$vo): ?><li class="newsticker-item">
                                <a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a>
                            </li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                    <!--通知公告       End-->
                    
                    <ul class="news_style">
                        <?php if(is_array($list_69)): foreach($list_69 as $key=>$vo): ?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                </div>
            </div>
            <!--赛事公告          End-->
            
            <?php $map3['id'] = array('in',array(2,3,5)); $list_gg_3 = M('Ggao')->where($map3)->select(); ?>
            <!--广告位               开始-->
            <div class="ad">
                <div class="bx_slider_1">
                <?php if(is_array($list_gg_3)): foreach($list_gg_3 as $key=>$v): ?><a href="<?php echo ($v["url"]); ?>"><img src="<?php echo ($v["pic"]); ?>" alt="" /></a><?php endforeach; endif; ?>
                </div>
            </div>
            <!--广告位               End-->
            
            
            <!--新闻资讯           开始-->
            <div class="ind_news_box clearfix">
                
                <div class="ind_news pull-left">
                    
                    <!--栏目标题       开始-->
                    <div class="ind_title">
                        <span>新闻资讯</span> /
                        <i>News</i>
                        <a href="<?php echo U('archives/index_arctype/index',array('t_id'=>10));?>">更多&gt;&gt;</a>
                    </div>
                    <!--栏目标题       End-->
                    
                    <div class="news_recommend clearfix">
                        <div class="thumb pull-left"><a href="<?php echo ($list_2_10["0"]["url"]); ?>"><img src="<?php echo ($list_2_10["0"]["pic"]); ?>"/></a></div>
                        <dl class="pull-right">
                            <dt><a href="<?php echo ($list_2_10["0"]["url"]); ?>"><?php echo ($list_2_10["0"]["title"]); ?></a></dt>
                            <dd><?php echo ($list_2_10["0"]["jianjie"]); ?></dd>
                        </dl>
                    </div>
                    
                    <ul class="news_style">
                    <?php if(is_array($list_10)): foreach($list_10 as $key=>$vo): ?><li><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["pubdate"]); ?></span> <div><?php echo ($vo["title"]); ?></div></a></li><?php endforeach; endif; ?>
                    </ul>
                </div>
                
                
                <!--中医药小故事         开始-->
                <div class="story pull-right">
                    <div class="ind_lt">中医药<span>小故事</span></div>
                    <ul>
                    <?php if(is_array($list_68)): foreach($list_68 as $key=>$vo): ?><li>
                            <a href="<?php echo ($vo["url"]); ?>">
                                <div><img src="<?php echo ($vo["pic"]); ?>" alt="" /></div>
                                <p><?php echo ($vo["title"]); ?></p>
                            </a>
                        </li><?php endforeach; endif; ?>
                    </ul>
                </div>
                <!--中医药小故事         End-->
            </div>
            <!--新闻资讯           End-->
            
            
            <!--养生知识            开始-->
            <div class="ind_health clearfix">
                
                <div class="ind_news pull-left">
                    
                    <!--栏目标题       开始-->
                    <div class="ind_title">
                        <span>养生知识</span> /
                        <i>Health knowledge</i>
                        <a href="<?php echo U('archives/index_arctype/index',array('t_id'=>54));?>">更多&gt;&gt;</a>
                    </div>
                    <!--栏目标题       End-->
                    
                    <div class="news_recommend clearfix">
                        <div class="thumb pull-left"><a href="<?php echo ($list_2_54["0"]["url"]); ?>"><img src="<?php echo ($list_2_54["0"]["pic"]); ?>"/></a></div>
                        <dl class="pull-right">
                            <dt><a href="<?php echo ($list_2_54["0"]["url"]); ?>"><?php echo ($list_2_54["0"]["title"]); ?></a></dt>
                            <dd><?php echo ($list_2_54["0"]["jianjie"]); ?></dd>
                        </dl>
                    </div>
                    
                    <ul class="news_style">
                    <?php if(is_array($list_54)): foreach($list_54 as $key=>$vo): ?><li><a href="<?php echo ($vo["url"]); ?>"><span><?php echo ($vo["pubdate"]); ?></span> <div><?php echo ($vo["title"]); ?></div></a></li><?php endforeach; endif; ?>
                    </ul>
                </div>
                
                
                <!--中医体质测试         开始-->
                <div class="test pull-right">
                    <div class="ind_lt">中医体质<span>测试</span></div>
                    
                    <ul class="test_news clearfix">
                        <li class="thumb pull-left"><a href="<?php echo U('Index/Dati/index');?>"><img src="/template/Index/NewCommon/images/index_img_9.jpg"/></a></li>
                        <li class="txt pull-right"><a href="<?php echo U('Index/Dati/index');?>">在北京的昌平区、朝阳区、丰台区……连续5天，都有演员们身着华丽服饰、画着精致妆容，在舞台上大秀才艺。</a></li>
                    </ul>
                    
                    
                    <ul class="news_style">
                    <?php if(is_array($list_70)): foreach($list_70 as $key=>$vo): ?><li><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                    
                </div>
                <!--中医体质测试         End-->
            </div>
            <!--养生知识            End-->
            
            <?php $map4['id'] = array('in',array(6,7,8)); $list_gg_4 = M('Ggao')->where($map4)->select(); ?>
            <!--广告位               开始-->
            <div class="ad">
                <div class="bx_slider">
                <?php if(is_array($list_gg_4)): foreach($list_gg_4 as $key=>$v): ?><a href="<?php echo ($v["url"]); ?>"><img src="<?php echo ($v["pic"]); ?>" alt="" /></a><?php endforeach; endif; ?>
                </div>
            </div>
            <!--广告位               End-->
            
            
            <div class="show_area clearfix">
                <!--秀场专区             开始-->
                <div class="show_box pull-left">
                    
                    <div class="show_city">
                        <?php $info_67 = get_arctype_info(67); $info_66 = get_arctype_info(66); $info_71 = get_arctype_info(71); ?>
                        <!--栏目标题       开始-->
                        <div class="ind_title">
                            <span>秀场专区</span> /
                            <i>Show area</i>
                            <a href="<?php echo ($info_67["url"]); ?>">更多&gt;&gt;</a>
                        </div>
                        <!--栏目标题       End-->
                        
                        
                        <ul class="show_tab clearfix">
                            <li class="active"><?php echo ($info_67["typename"]); ?></li>
                            <li><?php echo ($info_66["typename"]); ?></li>
                            <li><?php echo ($info_71["typename"]); ?></li>
                        </ul>
                        
                        <div class="show_city_content">
                            <ul class="show_city_list clearfix">
                                <li><a href="<?php echo ($info_67["url"]); ?>"><img src="<?php echo ($info_67["pic"]); ?>" alt="" /></a></li>
                            </ul>
                            <ul class="show_city_list clearfix">
                                <li><a href="<?php echo ($info_66["url"]); ?>"><img src="<?php echo ($info_66["pic"]); ?>" alt="" /></a></li>
                                
                            </ul>
                            <ul class="show_city_list clearfix">
                                <li><a href="<?php echo ($info_71["url"]); ?>"><img src="<?php echo ($info_71["pic"]); ?>" alt="" /></a></li>
                            </ul>
                        </div>
                    </div>
                    
                    
                                            
                        
                    <div  class="intro_box">
                        <div class="intro">
                        <?php $info_29 = get_arctype_info(29); ?>
                            <h4>主办方介绍</h4>
                            <a href="/jtjk/index.php?m=archives&c=index_arctype&a=index&t_id=29"><img src="<?php echo ($info_29["pic"]); ?>" width="340" height="92" alt="" /></a>
                            <p><?php echo ($info_29["resume"]); ?>...<a style="font-weight: bold;" href="/jtjk/index.php?m=archives&c=index_arctype&a=index&t_id=29">【了解详情】</a></p>
                        </div>
                        <div class="intro">
                        <?php $info_33 = get_arctype_info(33); ?>
                            <h4>项目介绍</h4>
                            <a href="/jtjk/index.php?m=archives&c=index_arctype&a=index&t_id=33"><img src="<?php echo ($info_33["pic"]); ?>" width="340" height="92" alt="" /></a>
                            <p><?php echo ($info_33["resume"]); ?>...<a style="font-weight: bold;" href="/jtjk/index.php?m=archives&c=index_arctype&a=index&t_id=33">【了解详情】</a></p>
                        </div>
                    </div>
                    
                    
                </div>
                <!--秀场专区             End-->
                <?php $map2['location_id'] = 0; $location_list = M('Location2')->where($map2)->select(); $location_ids = implode(',',make_one_array($location_list,'id')); $map['location_id'] = array('in',$location_ids.",".$location_id); $show_2017 = D('Show2')->where($map)->limit(6)->select(); ?>
                <!--往期回顾             开始-->
                <div class="review pull-right">
                    
                    <div class="title"><img src="/template/Index/NewCommon/images/index_img_3.png"/></div>
                    
                    <div class="year"><a href="<?php echo U('Index/Huigu/huigu2');?>">更多&gt;&gt;</a>2017年精彩视频</div>
                    
                    <ul class="clearfix">
                    <?php if(is_array($show_2017)): foreach($show_2017 as $key=>$v): ?><li>
                            <a href="<?php echo U('Index/Huigu/show2',array('id'=>$v['id']));?>">
                                <div><img src="<?php echo ($v["pic"]); ?>" alt="" /></div>
                                <p><?php echo ($v["show_name"]); ?></p>
                            </a>
                        </li><?php endforeach; endif; ?>
                    </ul>
                    
                    <?php $map2['location_id'] = 0; $location_list = M('Location1')->where($map2)->select(); $location_ids = implode(',',make_one_array($location_list,'id')); $map['location_id'] = array('in',$location_ids.",".$location_id); $show_2016 = D('Show1')->where($map)->limit(6)->select(); ?>
                    <div class="year"><a href="<?php echo U('Index/Huigu/huigu');?>">更多&gt;&gt;</a>2016年精彩视频</div>
                    
                    <ul class="clearfix">
                        <?php if(is_array($show_2016)): foreach($show_2016 as $key=>$v): ?><li>
                            <a href="<?php echo U('Index/Huigu/show',array('id'=>$v['id']));?>">
                                <div><img src="<?php echo ($v["pic"]); ?>" alt="" /></div>
                                <p><?php echo ($v["show_name"]); ?></p>
                            </a>
                        </li><?php endforeach; endif; ?>
                    </ul>
                </div>
                <!--往期回顾             End-->
                
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
<script type="text/javascript" src="/template/Index/NewCommon/js/jquery.bxslider.min.js" ></script>

<script>
    $(".show_tab li").hover(function(){
        $(this).addClass("active").siblings().removeClass("active");
        $(".show_city_list").hide();
        $(".show_city_list").eq($(this).index()).show();
        
    })
</script>
<script>
    $("#nav li").hover(function(){
        $(this).find(".second_nav").slideToggle();
    })

    $(".bx_slider , .bx_slider_1").bxSlider({
        auto: true,
        infiniteLoop: true
    });
</script>