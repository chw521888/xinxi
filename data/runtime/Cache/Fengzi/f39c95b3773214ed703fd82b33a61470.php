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




<link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/0.3.0/weui.css" />
<style>
	.img_del_box{
		display: none;
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background-color: rgba(0,0,0,0.6);
	}
	.img_del_box .img_del{
		width: 200px;
		height: 200px;
		position: absolute;
		top: 50%;
		left:50%;
		margin-left: -100px;
		margin-top: -100px;
		background-repeat: no-repeat;
    background-size: 100%;
	}
	.img_del_box .del,.img_del_box .close{
		position: absolute;
		top: 0;
		width: 50px;
		height: 50px;
		background-color: #fff;
		margin: 10px 5px;
		opacity: 1;
	}
	.img_del_box .del{
		right:50px;
		background: url(/template_m/Index/Common/images/del.png) center center no-repeat;
		background-size: 38px 38px;
	}
	.img_del_box .close{
		right:0px;
		background: url(/template_m/Index/Common/images/close.png) center center no-repeat;
		background-size: 38px 38px;
	}
	.in_txt input{
		width: 5.4rem;
	}
	.in_txt label {
	  width: 1.5rem;
	}
	#get_codes_m{
		float: right;
    width: 1.84rem;
    height: 0.7rem;
    text-align: center;
    line-height: 0.7rem;
    font-size: 0.24rem;
    color: #d62103;
    border: 0.02rem solid #d62103;
    border-radius: 0.06rem;
    background: transparent;
    outline: none;
	}
</style>
		<!-- 头部     开始 -->
		<div class="top">
			赛场风姿上传
		</div>
		<!-- 头部     End -->

		<!-- 内容     开始-->
		<div class="warp" style="padding-top:0.3rem;">
			<form action="<?php echo U('Fengzi/IndexFengzi/shangchuan');?>" method="post" id="up_form" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
				<ul class="white_bg in_txt">
					<li><label>标题：</label><input name="title" type="text" placeholder="最多只能输入20字符" value="<?php echo ($info["title"]); ?>"></li>
					<li><label>昵称：</label><input name="user_name" type="text" placeholder="最多只能输入20字符" value="<?php echo ($info["user_name"]); ?>"></li>
					<li><label>电话：</label><input name="user_phone" type="text" placeholder="请输入获奖联系电话" value="<?php echo ($info["user_phone"]); ?>"></li>
					<li><label>验证码：</label>
					<button id="get_codes_m" value="获取验证码" type="button">获取验证码</button>
					<input name="code" style="width: 3.2rem;" type="text" placeholder="请输入验证码">
					</li>
				</ul>

			<!-- 	<div  class="white_bg file">
				<p>请上传作品(2M之内)</p>
				<div class="file_bg">
					<input type="file" name="pic" value="">
				</div>
				<div class="file_bg">
					<input type="file" name="pic2" value="">
				</div>
				
			</div> -->

				<div class="img_up">
			    <div class="weui_cells weui_cells_form">
			      <div class="weui_cell">
			        <div class="weui_cell_bd weui_cell_primary">
			          <div class="weui_uploader">
			            <div class="weui_uploader_hd weui_cell">
			              <div class="weui_cell_bd weui_cell_primary">请上传作品(2M之内)</div>
			            </div>
			            <div class="weui_uploader_bd">
			              <ul class="weui_uploader_files">
			                <!-- 预览图插入到这 --> </ul>
			              <div class="weui_uploader_input_wrp">
			                <input class="weui_uploader_input js_file"  type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple="" ></div>
			            </div>
			          </div>
			        </div>
			      </div>
			    </div>
			  </div>
			  <div class="weui_dialog_alert" style="display: none;">
			    <div class="weui_mask"></div>
			    <div class="weui_dialog">
			      <div class="weui_dialog_hd"> <strong class="weui_dialog_title">警告</strong>
			      </div>
			      <div class="weui_dialog_bd">弹窗内容，告知当前页面信息等</div>
			      <div class="weui_dialog_ft">
			        <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
			      </div>
			    </div>
			  </div>

			  <div class="img_del_box">
			  	<div class="img_del"></div>
			  	<div class="del"></div>
			  	<div class="close"></div>
			  </div>
				
				<script src="https://cdn.bootcss.com/zepto/1.1.6/zepto.min.js"></script>
				<script> 
				  
				  $(function () {  


					  $.weui = {};  
					  $.weui.alert = function(options){  
					    options = $.extend({title: '警告', text: '警告内容'}, options);  
					    var $alert = $('.weui_dialog_alert');  
					    $alert.find('.weui_dialog_title').text(options.title);  
					    $alert.find('.weui_dialog_bd').text(options.text);  
					    $alert.on('touchend click', '.weui_btn_dialog', function(){  
					      $alert.hide();  
					    });  
					    $alert.show();  
					  };  

				    // 允许上传的图片类型  
				    var allowTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];  
				    // 1024KB，也就是 1MB  
				    var maxSize = 1024 * 1024;  
				    // 图片最大宽度  
				    var maxWidth = 300;  
				    // 最大上传图片数量  
				    var maxCount = 2;  
				    var filearr = [];  
				    $('.js_file').on('change', function (event) {  
				      var files = event.target.files;  

				        // 如果没有选中文件，直接返回  
				        if (files.length === 0) {  
				          return;  
				        }  

				        for (var i = 0, len = files.length; i < len; i++) {  

				          var file = files[i]; 
				          var reader = new FileReader();  

			            // 如果类型不在允许的类型范围内  
			            if (allowTypes.indexOf(file.type) === -1) {  
			              $.weui.alert({text: '该类型不允许上传'});  
			              continue;  
			            }  
			            
			            if (file.size > maxSize) {  
			              $.weui.alert({text: '图片太大，不允许上传'});  
			              continue;     
			            }  
			            
			            if (i >= maxCount || $(".weui_uploader_file").length >= maxCount) {  
			              $.weui.alert({text: '最多只能上传' + maxCount + '张图片'});  
			              break;  
			            }  

			            filearr.push(file);//添加到要提交的图片数组
			            reader.onload = function (e) {  
			              var img = new Image();  
			              img.onload = function () { 
			              			/*if(!testImages()){
			              					return false;
			              			}

				          				filearr.push(file);*/

			                    // 不要超出最大宽度  
			                    var w = Math.min(maxWidth, img.width);  
			                    // 高度按比例计算  
			                    var h = img.height * (w / img.width);  
			                    var canvas = document.createElement('canvas');  
			                    var ctx = canvas.getContext('2d');  
			                    // 设置 canvas 的宽度和高度  
			                    canvas.width = w;  
			                    canvas.height = h;  
			                    ctx.drawImage(img, 0, 0, w, h);  
			                    var base64 = canvas.toDataURL('image/png');  
			                    
			                    // 插入到预览区  
			                    var $preview = $('<li class="weui_uploader_file weui_uploader_status" style="background-image:url(' + base64 + ')"><div class="weui_uploader_status_content">0%</div></li>');  
			                    $('.weui_uploader_files').append($preview);  
			                    var num = $('.weui_uploader_file').length;  
			                    $('.js_counter').text(num + '/' + maxCount);  
			                    
			                    // 然后假装在上传，可以post base64格式，也可以构造blob对象上传，也可以用微信JSSDK上传  
			                    
			                    var progress = 0;  
			                    function uploading() {  
			                      $preview.find('.weui_uploader_status_content').text(++progress + '%');  
			                      if (progress < 100) {  
			                        setTimeout(uploading, 30);  
			                      }  
			                      else {  
	                            // 如果是失败，塞一个失败图标  
	                            //$preview.find('.weui_uploader_status_content').html('<i class="weui_icon_warn"></i>');  
	                            $preview.removeClass('weui_uploader_status').find('.weui_uploader_status_content').remove();  
	                          }  
			                    }  
	                        setTimeout(uploading, 30);  
	                  };  
	                    
	                  img.src = e.target.result;  
	                };  
	                reader.readAsDataURL(file);  
	              }  
	          });  
				  	
				  	// 图片删除功能
				  	$(".weui_uploader_files").on('click',".weui_uploader_file",function(){
				  		$(".img_del").attr("style",$(this).attr("style"));
				  		$(".img_del_box .del").attr("data-index",$(this).index());
				  		$(".img_del_box").show();
				  		$("body").css("overflow-y","hiden");
				  	})
				  	$(".img_del_box").on('click',".close",function(){
				  		$(".img_del_box").hide();
				  		$("body").css("overflow-y","auto");
				  	})
				  	$(".img_del_box").on('click',".del",function(){
				  		if(!confirm("确定删除？")){
				  			$(".img_del_box").hide();
				  			$("body").css("overflow-y","auto");
				  			return false;
				  		}
				  		$(".weui_uploader_file").eq($(this).attr("data-index")).remove();
				  		filearr.splice($(this).attr("data-index"),1); //在要提交的图片数组中删除
				  		$(".img_del_box").hide();
				  		$("body").css("overflow-y","auto");
				  	})

				  	$(".put_on").on("click",function(){
					  	sumitImageFile();
					  })

						function sumitImageFile(){
						    var form=$("#up_form")[0];
						    var formData = new FormData(form);   //这里连带form里的其他参数也一起提交了,如果不需要提交其他参数可以直接FormData无参数的构造函数

						    if($('#up_form input[name="title"]').val()==""){
						    	alert("标题不能为空！");
						    	return false;
						    }
						    if($('#up_form input[name="user_name"]').val()==""){
						    	alert("昵称不能为空！");
						    	return false;
						    }
						    if($('#up_form input[name="user_phone"]').val()==""){
						    	alert("电话不能为空！");
						    	return false;
						    }
						    var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;  
						    if (!myreg.test($('#up_form input[name="user_phone"]').val())) {  
						      alert('手机号格式错误！');
						      return false;  
						    } 
						    if($('#up_form input[name="code"]').val()==""){
						    	alert("验证码不能为空！");
						    	return false;
						    }

						    //添加提交的图片photo[]
						    if(filearr.length>0){
				    			for(var i =0;i<maxCount;i++){
				             formData.append("photo[]", filearr[i]);    
				          };
						    }

						    //ajax 提交form
						    $.ajax({
						        url : form.action,
						        type : "POST",
						        data : formData,
						        processData : false,         // 告诉jQuery不要去处理发送的数据
						        contentType : false,        // 告诉jQuery不要去设置Content-Type请求头
						        success:function(data){
						        	if(data.status==0){
						        		alert(data.info);
						        		return false;
						        	}
						        	location.href="/jtjk/index.php?m=Fengzi&c=IndexFengzi&a=index";
						        },
						        xhr:function(){            //在jquery函数中直接使用ajax的XMLHttpRequest对象
						            var xhr = new XMLHttpRequest();
						            xhr.upload.addEventListener("progress", function(evt){
						                if (evt.lengthComputable) {
						                    var percentComplete = Math.round(evt.loaded * 100 / evt.total);  
						                    console.log("正在提交."+percentComplete.toString() + '%');        //在控制台打印上传进度
						                }
						            }, false);
						            
						            return xhr;
						        },
						        error:function(data){
						        	alert("作品上传失败！");
						        }
						        
						    });
						}

				  });  
				//# sourceURL=pen.js  
				</script>

				<input type="button" class="put_on" value="提 交">
			</form>

			<div class="explain">
				<h4>说明：</h4>
				1.修改作品只有一次<br />
				2.上传新作品和修改作品都需要审核<br />
			</div>

		</div>
		<!-- 内容     End-->
		

	</body>
</html>

<script src="http://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
<script>
  var send_code=function(){
		if($('#up_form input[name="user_phone"]').val()==""){
			alert('手机号不能为空！');
			return false;  
		}
		var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;  
    if (!myreg.test($('#up_form input[name="user_phone"]').val())) {  
      alert('手机号格式错误！');
      return false;  
    } 
		$.ajax({
        url : "index.php?m=Index&c=Index&a=send_code",
        type : "POST",
        data : "phone="+$('#up_form input[name="user_phone"]').val(),
        success:function(data){
        	var time=60;
        	var timerId=setInterval(function(){
        		time--;
        		if(time==0){
        			$("#get_codes_m").html("获取验证码");
        			$("#get_codes_m").on("click",send_code);
        			clearInterval(timerId);
        		}
        		$("#get_codes_m").html("重新发送("+time+"s)")
        		$("#get_codes_m").unbind("click",send_code);
        	},1000)
        },
        error:function(data){
        	alert("error！");
        }
        
    });
	};
	$("#get_codes_m").on('click',send_code);
</script>
<script type="text/javascript" src="/template_m/Index/Common/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="/template_m/Index/Common/js/jquery.newsticker.js" ></script>

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
</script>