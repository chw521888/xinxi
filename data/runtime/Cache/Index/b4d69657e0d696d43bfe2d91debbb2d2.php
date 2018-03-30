<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8" />

		<title>体质测试</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no" />

		<link rel="stylesheet" href="/template_m/Index/Common/dati/css/common.css" />

		<link rel="stylesheet" href="/template_m/Index/Common/dati/css/bootstrap.min.css" />

<script type="text/javascript" src="/template_m/Index/Common/dati/js/jquery-1.11.1.min.js" ></script>

<script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>

<script type="text/javascript" src="/template_m/Index/Common/dati/js/exam.js" ></script>

<script type="text/javascript" src="/template_m/Index/Common/dati/js/echarts.common.min.js" ></script>

		



		<div ng-app="exam" ng-controller="myCtrl">

			

			<div ng-show="begin_exam">

			<div class="top">超准中医体质测试</div>

			<!--内容   开始-->

			<div class="mian">

				<div class="section_header_placeholder">

					<div class="section_header"><h2>根据最近三个月的体验和感觉回答</h2></div>

				</div>

				

				<!--问题列表-->

				<div class="question-container" ng-repeat="exam in data">

					<!--第0题-->

					<div class="question" ng-init="q_index=$index" ng-class="{'disabled':(answer_data.length<$index),'active':(answer_data.length==$index),'active h_active':(answer_data.length>$index)}">

						<h3>

							<span class="question-no"><b>{{$index+1}}</b>/{{data.length}}</span>

							<span class="real-title">{{exam.question}}</span>

						</h3>

						<div class="question-options" ng-class="{0:'question-options-more',1:''} [exam.view_show_horizontal]">

							<ul class="row">

								<li  ng-repeat="ans in exam.answer" ng-class="{2:'col-xs-6',5:'col-xs-2-5'} [exam.answer.length]" ng-click="answer_click(q_index,$index)" class="{{ans.s_class}}">{{ans.title}}</li>

							</ul>

						</div>

					</div>

				</div>

				

				<!--提交--> 

				<div class="put_on"><input type="submit" value="提交测试"  ng-click="calculate_score()"/></div>

			</div>

			</div>	





			<div ng-hide="begin_exam">

				

				<div class="tm">

			<div class="top-menu">

			    <a href="javascript:void(0)" ng-click="back_exam();"  class="back"><img src="/template_m/Index/Common/dati/images/top_left.png"></a>

			    <a class="name">测试结果</a>

			</div>

		</div>

		<!--我的体质-->

		<div class="my_bo">

			<div>我的主体质<span ng-repeat="m in exam_res_data['health_category_data']['main']">{{m['1']}}</span></div>

		</div>

		

		<!--数据图--> 

		<div class="s_datagram b_lin w94">

			<h4 ng-show="exam_res_data['health_category_data']['other'].length > 0">兼有:<span ng-repeat="m in exam_res_data['health_category_data']['other']">{{m['1']}}、</span></h4>

			<div id="s_datagram_bx" style="width: 90vw;height:180px; margin-left: auto; margin-right: auto;"></div>

		</div>

		

		<div class="s_feature_box">



			<ul class="s_de_con w94" ng-hide="exam_res_data['health_category_data']['main'].length > 1">

			<li>

				<h4>{{exam_res_data['health_category_data']['main'][1]}}体质特征</h4>

				{{jing_question_category['content_1']}}

			</li>

			<li>

				<h4>起居饮食、运动及心理建议</h4>

				{{jing_question_category['content_2']}}

			</li>

			<li>

				<h4>推荐药膳</h4>

				{{jing_question_category['content_3']}}

			</li>

			<li>

				<h4>易患疾病</h4>

				{{jing_question_category['content_4']}}

			</li>

			<li>

				<div><img src="/template_m/Index/Common/dati/images/s_tj.png" width="34" height="34"><span>根据您的体质 推荐中医调治 </span></div>

				{{jing_question_category['content_5']}}

			</li>

			</ul>



			<div ng-show="exam_res_data['health_category_data']['main'].length > 1">

			<div class="s_feature"  ng-repeat="m in exam_res_data['health_category_data']['main']">

				<div class="s_feat_item"><span></span>{{m['1']}}体质盘中特征 </div>



				<ul class="s_de_con w94 disabled">

					<li>

						<h4>平和质体质特征</h4>

						{{m['2']}}

					</li>

					<li>

						<h4>起居饮食、运动及心理建议</h4>

						{{m['3']}} 

					</li>

					<li>

						<h4>推荐药膳</h4>

						{{m['4']}}

					</li>

					<li>

						<h4>易患疾病</h4>

						{{m['5']}}

					</li>

					<li>

						<div><img src="/template_m/Index/Common/dati/images/s_tj.png" width="34" height="34"><span>根据您的体质 推荐中医调治 </span></div>

						{{m['6']}}

					</li>

				</ul>

			</div>

			</div>







		</div>

		<div class="yyzn_02">

			<div class="s_again"><a href="<?php echo U('index/dati/index');?>">再测一次</a></div>

		</div>

		

		<!--最近五次答案-->

		<div class="s_five_an w94">

			<h4>最近五次答题结果</h4>

			<ul></literal>

			<?php if(is_array($list)): foreach($list as $key=>$v): ?><li><a href="<?php echo U('Index/Dati/index',array('id'=>$v['id']));?>"><?php echo (turn_time($v["time"],1)); ?>   <?php echo (show_dati_title($v["file3"])); ?></a></li><?php endforeach; endif; ?>

			

			</ul>

		</div>

		<div class="yyzn_02">

			<div class="s_again"><a href="http://www.bjtrtwy.com/static/wechat/index.html">自诊问药</a></div>

		</div>

		<div class="s_footer"><img src="/template_m/Index/Common/dati/images/s_w_eq.png" width="110" height="110"></div>



			</div>





		</div>	

		<script type="text/javascript">

			var history_show_res=<?php echo ($result); ?>;

			var history_answer_data=<?php echo ($history_answer_data); ?>;

			var history_answer_category_score={};

			var history_exam_res_data=<?php echo ($filedata); ?>;

		</script>

		

	</body>

</html>