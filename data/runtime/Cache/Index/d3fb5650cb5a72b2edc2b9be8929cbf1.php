<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="<?php if($page_head_info['keywords'] != ''): else: echo (C("PUBLIC_SEO_KEYWORD")); endif; ?>" />
	<meta name="description" content="<?php if($page_head_info['description'] != ''): else: echo (C("PUBLIC_SEO_DESCRIPTION")); endif; ?>" />
    <title><?php if($page_head_info['title'] != ''): else: echo (C("PUBLIC_SEO_TITLE")); endif; ?></title>
<link rel="stylesheet" href="/template/Index/Common/css/common.css">
<link rel="stylesheet" href="/template/Index/Common/css/style.css">
<link rel="stylesheet" href="/template/Index/../Common/Common/css/pagelist.css">
<script type="text/javascript" src="/template/Index/Common/js/jquery.js"></script>
<script type="text/javascript" src="/template/Index/Common/js/ScrollPic.js"></script>
<script type="text/javascript" src="/template/Index/Common/js/vote.js"></script>
</head>

<body>
	<div class="logo1" style="background: url('/template/Index/NewCommon/images/banner.jpg') center no-repeat; background-size: contain;"></div><!--导航              开始-->
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

<link rel="stylesheet" href="/template/Index/Common/dati/css/common.css"/>
<link rel="stylesheet" href="/template_m/Index/Common/dati/css/bootstrap.min.css"/>
<script type="text/javascript" src="/template/Index/Common/dati/js/jquery-1.11.1.min.js"></script>
<script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
<script type="text/javascript" src="/template/Index/Common/dati/js/exam.js"></script>
<script type="text/javascript" src="/template/Index/Common/dati/js/echarts.common.min.js"></script>
<?php $menu_son_list = get_level_channel(array('typeid'=>14)); ?>
<div class="z-content">
	<div class="z-content-1">
		<ul class="z-nav">
			<?php if(is_array($menu_son_list)): foreach($menu_son_list as $key=>$v): ?><li class="z-nav-l"><a href="<?php echo ($v["url"]); ?>"><?php echo ($v["typename"]); ?></a>
			<p>
			</p>
			</li><?php endforeach; endif; ?>
		</ul>
	</div>
</div>

<div class="w1000">
	<div ng-app="exam" ng-controller="myCtrl">
		<div ng-show="begin_exam">
			<div class="top">
				超准中医体质测试
			</div>
			<!--内容   开始-->
			<div class="mian">
				<div class="section_header_placeholder">
					<div class="section_header">
						<h2>根据最近三个月的体验和感觉回答</h2>
					</div>
				</div>
				<!--问题列表-->
				<div class="question-container" ng-repeat="exam in data">
					<!--第0题-->
					<div class="question" ng-init="q_index=$index" ng-class="{'disabled':(answer_data.length<$index),'active':(answer_data.length==$index),'active h_active':(answer_data.length>
						$index)}">
						<h3><span class="question-no"><b>{{$index+1}}</b>/{{data.length}}</span><span class="real-title">{{exam.question}}</span></h3>
						<div class="question-options" ng-class="{0:'question-options-more',1:''} [exam.view_show_horizontal]">
							<ul class="row">
								<li ng-repeat="ans in exam.answer" ng-class="{2:'col-xs-6',5:'col-xs-2-5'} [exam.answer.length]" ng-click="answer_click(q_index,$index)" class="{{ans.s_class}}">{{ans.title}}</li>
							</ul>
						</div>
					</div>
				</div>
				<!--提交-->
				<div class="put_on">
					<input type="submit" value="提交测试" ng-click="calculate_score()"/>
				</div>
			</div>
		</div>
		<div ng-hide="begin_exam">
			<div class="tm">
				<div class="top-menu">
					<a href="javascript:void(0)" ng-click="back_exam();" class="back"><img src="/template_m/Index/Common/dati/images/top_left.png"></a><a class="name">测试结果</a>
				</div>
			</div>
			<!--我的体质-->
			<div class="my_bo">
				<div>
					我的主体质<span ng-repeat="m in exam_res_data['health_category_data']['main']">{{m['1']}}</span>
				</div>
			</div>
			<!--数据图-->
			<div class="s_datagram b_lin w94">
				<h4 ng-show="exam_res_data['health_category_data']['other'].length> 0">兼有:<span ng-repeat="m in exam_res_data['health_category_data']['other']">{{m['1']}}、</span></h4>
				<div id="s_datagram_bx" style="width: 1000px;height:360px; margin-left: auto; margin-right: auto;">
				</div>
			</div>
			<div class="s_feature_box">
				<ul class="s_de_con w94" ng-hide="exam_res_data['health_category_data']['main'].length>
					 1">
					<li>
					<h4>{{exam_res_data['health_category_data']['main'][1]}}体质特征</h4>
									{{jing_question_category['content_1']}} 			</li>
					<li>
					<h4>起居饮食、运动及心理建议</h4>
									{{jing_question_category['content_2']}} 			</li>
					<li>
					<h4>推荐药膳</h4>
									{{jing_question_category['content_3']}} 			</li>
					<li>
					<h4>易患疾病</h4>
									{{jing_question_category['content_4']}} 			</li>
					<li>
					<div>
						<img src="/template_m/Index/Common/dati/images/s_tj.png" width="34" height="34"><span>根据您的体质 推荐中医调治 </span>
					</div>
									{{jing_question_category['content_5']}} 			</li>
				</ul>
				<div ng-show="exam_res_data['health_category_data']['main'].length>
					 1">
					<div class="s_feature" ng-repeat="m in exam_res_data['health_category_data']['main']">
						<div class="s_feat_item">
							<span></span>{{m['1']}}体质盘中特征
						</div>
						<ul class="s_de_con w94 disabled">
							<li>
							<h4>平和质体质特征</h4>
													{{m['2']}}					</li>
							<li>
							<h4>起居饮食、运动及心理建议</h4>
													{{m['3']}} 					</li>
							<li>
							<h4>推荐药膳</h4>
													{{m['4']}}					</li>
							<li>
							<h4>易患疾病</h4>
													{{m['5']}}					</li>
							<li>
							<div>
								<img src="/template_m/Index/Common/dati/images/s_tj.png" width="34" height="34"><span>根据您的体质 推荐中医调治 </span>
							</div>
													{{m['6']}}					</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="yyzn_02">
				<div class="s_again">
					<a href="<?php echo U('index');?>">再测一次</a>
				</div>
			</div>
			<!--最近五次答案-->
			<div class="s_five_an w94">
				<h4></h4>
				<div class="save_near_answer" style="text-align: center;">
					<img src="/template/Index/Common/images/ewmhh.jpg">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">			var history_show_res=<?php echo ($result); ?>;			var history_answer_data=<?php echo ($history_answer_data); ?>;			var history_answer_category_score={};			var history_exam_res_data=<?php echo ($filedata); ?>;		</script>
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
        
<div class="theme-popover-mask"></div>
<div class="mb1"></div>


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
        <div class="tips-del">
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
        </div>
        </div>
        <!--比赛规则-->
        <div class="theme-popover1">
         <div class="ruler-del">
         <?php $info_37 = get_arctype_info(37); ?>
	 		<img src="/template/Index/Common/images/gb.jpg" width="30" height="30" class="error1"/>
			<h1><?php echo ($info_37["typename"]); ?></h1>
			<ul>
    			<li><?php echo (htmlspecialchars_decode($info_37["content"])); ?></li>
    		</ul>
		</div>
		</div>
        <!--比赛规则结束-->
    <!--投票规则-->
        <div class="theme-popover2">
            <div class="ruler-del">
                <?php $info_37 = get_arctype_info(38); ?>
                <img src="/template/Index/Common/images/gb.jpg" width="30" height="30" class="error3"/>
                <h1><?php echo ($info_38["typename"]); ?></h1>
                <ul>
                    <li><?php echo (htmlspecialchars_decode($info_38["content"])); ?></li>
                </ul>
            </div>
        </div>
        <!--投票规则结束-->
        <div class="tp-secces">
        	<img src="/template/Index/Common/images/gb-2_03.jpg" width="17" height="17" class="error2"/>
			<ul>
    			<li><span>提示<br/>您已投票成功</span></li>
    		</ul>
		</div>
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
	<img src="/template/Index/Common/images/eq.jpg" width="114" height="114" />	<span>关闭</span>
</div>

<!--二维码 右边--><div class="ri_gb" title="扫码体质测试"></div>
<div class="right_eq">
	<h4>中医体质测试 </h4>
	<img src="/template/Index/Common/images/tzcs.png" width="114" height="114" />
	<span>关闭</span>
</div>
<script>
	
    $(function(){
        <!--我要报名-->
        $('.tips').click(function(){
            $('.theme-popover-mask').fadeIn(100);
            $('.theme-popover').slideDown(200);
        });
        $('.theme-popover-mask').click(function(){
            $('.theme-popover-mask').fadeOut(100);
            $('.theme-popover').slideUp(200);
        });
        $(".error").click(function(){
            $(".theme-popover-mask").hide();
            $(".theme-popover").slideUp(200);
        });
    });
    <!--我要报名结束-->
    <!--比赛规则-->
    $(function(){
        $('.ruler').click(function(){
            $('.theme-popover-mask').fadeIn(100);
            $('.theme-popover1').slideDown(200);
        });
        $('.theme-popover-mask').click(function(){
            $('.theme-popover-mask').fadeOut(100);
            $('.theme-popover1').slideUp(200);
        });
        $(".error1").click(function(){
            $(".theme-popover-mask").hide();
            $(".theme-popover1").slideUp(200);
        });
    });
    <!--比赛规则结束-->
    <!--投票规则-->
    $(function(){
        $('.vote-ruler').click(function(){
            $('.theme-popover-mask').fadeIn(100);
            $('.theme-popover2').slideDown(200);
        });
        $('.theme-popover-mask').click(function(){
            $('.theme-popover-mask').fadeOut(100);
            $('.theme-popover2').slideUp(200);
        });
        $(".error3").click(function(){
            $(".theme-popover-mask").hide();
            $(".theme-popover2").slideUp(200);
        });
    });
    <!--投票规则结束-->
        $(window).scroll(function(){
            var v=$("body").scrollTop();
            if(v>700){
                $(".city").show();
            }
        });

    $(function(){
        $(".city>p").click(function(){
            var is_open=$(this).attr('data-is-open');
            if(is_open==0){
                $(this).removeClass("city-block");
                $(this).addClass("city-none");
                $(".city").animate({left:"0px"}).show();
                $(this).attr('data-is-open',1);
            }
           else{
                $(this).removeClass("city-none");
                $(this).addClass("city-block");
                $(".city").animate({left:"-200px"}).show();
                $(this).attr('data-is-open',0);
           }
        });
    });


   $(function(){

       $(".red-ewm").hover(function() {
           $(".mb1").css({display: "block",zindex:"1100"});
           $(".click-ewm").show();
       },function(){
           $(".mb1").css({display: "block",zindex:"1100"});
           $(".click-ewm").hide();
       });

           $(".mb1").click(function(){
               $(this).hide();
               $(".click-ewm").hide();
           });
           $(".click-ewm").click(function(){
               $(this).hide();
               $(".click-ewm").hide();
           });
   });


function gotoTop(min_height){ 

$("#gotoTop").click(//定义返回顶部点击向上滚动的动画 
function(){$('html,body').animate({scrollTop:0},900);
})
}
gotoTop(); 
</script>
<script>		$(".left_eq span").click(function(){            $(".left_eq").hide();        });        $(".le_gb").hover(function(){            $(".left_eq").show();        });		
        $(".right_eq span").click(function(){
            $(".right_eq").hide();
        });        $(".ri_gb").hover(function(){            $(".right_eq").show();        });        
    </script>
</body>
</html>


<script>
	$("#nav li").hover(function(){
		$(this).find(".second_nav").slideToggle();
	})
	
</script>