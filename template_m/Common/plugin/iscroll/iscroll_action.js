
var myScroll;
function loaded () {
	myScroll = new IScroll('#wrapper', {
	    click:true, //调用判断函数
        scrollbars: false,//有滚动条
        mouseWheel: true,//允许滑轮滚动
        fadeScrollbars: false//滚动时显示滚动条，默认影藏，并且是淡出淡入效果
    });
}
document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
$(document).ready(function(e) {
	 var wrapper_div;
	  var top_height=$('.top-menu').outerHeight();
	  var foot_height=$('.footer').outerHeight();
	  
	  
      var c_height = $(window).height();
	  
	  wrapper_div=parseInt(parseInt(c_height)-parseInt(top_height)-parseInt(foot_height));
	  
	  
	  
	 $('#wrapper_div').css("height",wrapper_div+'px');
	 setTimeout(function(){loaded();},500); 
	 $('img').load(function(){
	     myScroll.refresh();
	 });

});




