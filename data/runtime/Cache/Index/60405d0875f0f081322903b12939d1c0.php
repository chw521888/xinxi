<?php if (!defined('THINK_PATH')) exit();?>
<div class="wrap">
  <div id="error_tips">
    <h2>操作成功！</h2>
    <div class="error_cont">
      <ul>
        <li>跳转页面...</li>
      </ul>
      <div class="error_return"><a href="javascript:close_app();" class="btn">关闭</a></div>
    </div>
  </div>
</div>
<script src="/jtjk/statics/js/common.js"></script>
<script>
href = document.referrer;
var close_timeout=setTimeout(function(){
	location.href = href;
},1000);

function close_app(){
	clearTimeout(close_timeout);
	parent.close_current_app();
}
</script>