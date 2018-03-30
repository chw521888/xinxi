$(window).scroll(function() {
	var body_height=$(this).scrollTop();
	if(body_height>52){
	$('.section_header h2').addClass('fixed');
	}else{
	$('.section_header h2').removeClass('fixed');
	}
});


$(document).ready(function(){
	
	//选择男女
	$('.sex li').click(function(){
		$('.sex li').eq($(this).index()).addClass('active').siblings().removeClass('active');
		$('.question-container').hide();
		$('.question-container').eq($(this).index()).show();
	})
	
	
	$('.question .question-options ul li').click(function(){
		
		var number=$(this).index();//当前元素序号。
		$(this).addClass('active').siblings().removeClass('active');
		
		
		$(this).parents().parent().addClass('h_active');
		
		var input_value=$(this).parent().siblings('input').val();//input的值，用于下面判断是否是修改。
		$(this).parent().siblings('input').val(number+1);//向input 插入答案序号
		
		if(input_value==""){
			$(this).parents().parent().next('.question').removeClass('disabled').addClass('active');//展开下一个
			var scroll_location=$(this).parents().parent().next('.question');//下一个元素
			//var mt=Number($(scroll_location).attr('data-top'));//获取偏移量
			$("html,body").animate({scrollTop:$(scroll_location).offset().top+-50+'px'},500);//滚动到下一个
		}
		
	});
	
});



    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('s_datagram_bx'));

    // 指定图表的配置项和数据
   option = {
	    series : [
	        {
	            name: '访问来源',
	            type: 'pie',
	            radius: '55%',
	            data:[
	         
	                {value:200, name:'阴虚质'},
	                {value:200, name:'痰湿质'},
	                {value:340, name:'湿热质'},
	                {value:310, name:'气虚质'},
	                {value:400, name:'阳虚质'}
	            ]
	        }
	    ]
	};
	
	 // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
    
$(document).ready(function(){
	$(".s_feature").click(function(){
		var avt=$(this).attr('class');

		if(avt=="s_feature"){
			$(".s_feature .s_de_con").slideUp();
			$(".s_feature").removeClass('active');
		}
		
		$(this).find('.s_de_con').slideToggle();
		$(this).toggleClass('active');

	});
});
