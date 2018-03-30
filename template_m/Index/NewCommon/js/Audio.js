$(document).ready(function(){
	var weixinAudioObj = $('.weixinAudio').weixinAudio();
	
	// 添加单一播放的逻辑
	$('.weixinAudio').each(function(index, ele){
		$(ele).on("click", function(event){
			var $this = $(this);
			var currentIndex = index;
			// 遍历所有对象，找到非当前点击，执行pause()方法;
	    $.each(weixinAudioObj,function(i, el) {
	      if(i != 'weixinAudio'+currentIndex){
	        el.pause();
	      }
	    });
		});
	});
})