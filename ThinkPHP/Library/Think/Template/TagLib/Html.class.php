<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Think\Template\TagLib;
use Think\Template\TagLib;
/**
 * Html标签库驱动
 */
class Html extends TagLib{
    // 标签定义
    protected $tags   =  array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'editor'    => array('attr'=>'id,name,style,width,height,type,upload_type,upload_path_son','close'=>1),
        'select'    => array('attr'=>'name,options,values,output,multiple,id,size,first,change,selected,dblclick','close'=>0),
        'selecthtml'=> array('attr'=>'name,options,values,output,multiple,id,size,first,change,selected,dblclick','close'=>0),
        'select_multiple'=> array('attr'=>'name,options,values,output,multiple,id,size,first,change,selected,dblclick','close'=>0),
        'checkbox_son_multiple'=> array('attr'=>'name,options,values,output,multiple,id,size,first,change,selected,dblclick','close'=>0),
        'grid'      => array('attr'=>'id,pk,style,action,actionlist,show,datasource','close'=>0),
        'list'      => array('attr'=>'id,pk,style,action,actionlist,show,datasource,checkbox','close'=>0),
        'imagebtn'  => array('attr'=>'id,name,value,type,style,click','close'=>0),
        'checkbox'  => array('attr'=>'name,checkboxes,checked,separator','close'=>0),
        'radio'     => array('attr'=>'name,radios,checked,separator,checked_value','close'=>0),
        'imgUpload' => array('attr'=>'id,name,value,style,upload_type,upload_path_son','close'=>0),
        'imgMultiUpload'=> array('attr'=>'id,name,value,style,upload_type,upload_path_son,input_text','close'=>0),
        'fileUpload'=> array('attr'=>'id,name,value,style,upload_type,upload_path_son,input_text','close'=>0),
        'fileMultiUpload'=> array('attr'=>'id,name,value,style,upload_type,upload_path_son,input_text','close'=>0)
        );

    /**
     * editor标签解析 插入可视化编辑器
     * 格式： <html:editor id="editor" name="remark" type="FCKeditor" style="" >{$vo.remark}</html:editor>
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _editor($tag,$content) {
        $id			=	!empty($tag['id'])?$tag['id']: '_editor';
        $name   	=	$tag['name'];
        $style   	    =	!empty($tag['style'])?$tag['style']:'';
        $width		=	!empty($tag['width'])?$tag['width']: '100%';
        $height     =	!empty($tag['height'])?$tag['height'] :'320px';
     //   $content    =   $tag['content'];
        $type       =   $tag['type'] ;
        $upload_type     	=	$tag['upload_type'];
        $upload_path_son   	=	$tag['upload_path_son'];
        switch(strtoupper($type)) {
            case 'FCKEDITOR':
                $parseStr   =	'<!-- 编辑器调用开始 --><script type="text/javascript" src="__ROOT__/Public/Js/FCKeditor/fckeditor.js"></script><textarea id="'.$id.'" name="'.$name.'">'.$content.'</textarea><script type="text/javascript"> var oFCKeditor = new FCKeditor( "'.$id.'","'.$width.'","'.$height.'" ) ; oFCKeditor.BasePath = "__ROOT__/Public/Js/FCKeditor/" ; oFCKeditor.ReplaceTextarea() ;function resetEditor(){setContents("'.$id.'",document.getElementById("'.$id.'").value)}; function saveEditor(){document.getElementById("'.$id.'").value = getContents("'.$id.'");} function InsertHTML(html){ var oEditor = FCKeditorAPI.GetInstance("'.$id.'") ;if (oEditor.EditMode == FCK_EDITMODE_WYSIWYG ){oEditor.InsertHtml(html) ;}else	alert( "FCK必须处于WYSIWYG模式!" ) ;}</script> <!-- 编辑器调用结束 -->';
                break;
            case 'FCKMINI':
                $parseStr   =	'<!-- 编辑器调用开始 --><script type="text/javascript" src="__ROOT__/Public/Js/FCKMini/fckeditor.js"></script><textarea id="'.$id.'" name="'.$name.'">'.$content.'</textarea><script type="text/javascript"> var oFCKeditor = new FCKeditor( "'.$id.'","'.$width.'","'.$height.'" ) ; oFCKeditor.BasePath = "__ROOT__/Public/Js/FCKMini/" ; oFCKeditor.ReplaceTextarea() ;function resetEditor(){setContents("'.$id.'",document.getElementById("'.$id.'").value)}; function saveEditor(){document.getElementById("'.$id.'").value = getContents("'.$id.'");} function InsertHTML(html){ var oEditor = FCKeditorAPI.GetInstance("'.$id.'") ;if (oEditor.EditMode == FCK_EDITMODE_WYSIWYG ){oEditor.InsertHtml(html) ;}else	alert( "FCK必须处于WYSIWYG模式!" ) ;}</script> <!-- 编辑器调用结束 -->';
                break;
            case 'EWEBEDITOR':
                $parseStr	=	"<!-- 编辑器调用开始 --><script type='text/javascript' src='__ROOT__/Public/Js/eWebEditor/js/edit.js'></script><input type='hidden'  id='{$id}' name='{$name}'  value='{$conent}'><iframe src='__ROOT__/Public/Js/eWebEditor/ewebeditor.htm?id={$name}' frameborder=0 scrolling=no width='{$width}' height='{$height}'></iframe><script type='text/javascript'>function saveEditor(){document.getElementById('{$id}').value = getHTML();} </script><!-- 编辑器调用结束 -->";
                break;
            case 'NETEASE':
                $parseStr   =	'<!-- 编辑器调用开始 --><textarea id="'.$id.'" name="'.$name.'" style="display:none">'.$content.'</textarea><iframe ID="Editor" name="Editor" src="__ROOT__/Public/Js/HtmlEditor/index.html?ID='.$name.'" frameBorder="0" marginHeight="0" marginWidth="0" scrolling="No" style="height:'.$height.';width:'.$width.'"></iframe><!-- 编辑器调用结束 -->';
                break;
            case 'UBB':
                $parseStr	=	'<script type="text/javascript" src="__ROOT__/Public/Js/UbbEditor.js"></script><div style="padding:1px;width:'.$width.';border:1px solid silver;float:left;"><script LANGUAGE="JavaScript"> showTool(); </script></div><div><TEXTAREA id="UBBEditor" name="'.$name.'"  style="clear:both;float:none;width:'.$width.';height:'.$height.'" >'.$content.'</TEXTAREA></div><div style="padding:1px;width:'.$width.';border:1px solid silver;float:left;"><script LANGUAGE="JavaScript">showEmot();  </script></div>';
                break;
            case 'KINDEDITOR':
                $parseStr   =  '<link rel="stylesheet" href="__ROOT__/public/kindeditor/Xcsite/themes/default/default.css" /><script charset="utf-8" src="__ROOT__/public/kindeditor/Xcsite/kindeditor-min.js"></script><script charset="utf-8" src="__ROOT__/public/kindeditor/Xcsite/lang/zh_CN.js"></script><script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create(\'textarea[name="'.$name.'"]\', {
					allowFileManager : true,
					extraFileUploadParams: {
                        ALLOWID : \''.session_id().'\'
                    },
				});
			});
		</script><textarea id="'.$id.'" style="'.$style.'" name="'.$name.'" >'.$content.'</textarea>';
                break;
			 case 'KINDEDITOR_M':
                $parseStr   =  '<link rel="stylesheet" href="__ROOT__/public/kindeditor/Member/themes/default/default.css" /><script charset="utf-8" src="__ROOT__/public/kindeditor/Member/kindeditor-min.js"></script><script charset="utf-8" src="__ROOT__/public/kindeditor/Member/lang/zh_CN.js"></script><script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create(\'textarea[name="'.$name.'"]\', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					extraFileUploadParams: {
                        ALLOWID : \''.session_id().'\'
                    },
					afterBlur:function(){this.sync();},
					items : [
						\'fontname\', \'fontsize\', \'|\', \'forecolor\', \'hilitecolor\', \'bold\', \'italic\', \'underline\',
						\'removeformat\', \'|\', \'justifyleft\', \'justifycenter\', \'justifyright\', \'insertorderedlist\',
						\'insertunorderedlist\', \'|\',\'image\', \'multiimage\', \'link\',\'fullscreen\']
				});
				
					
			});
		</script><textarea id="'.$id.'" style="'.$style.'" name="'.$name.'" >'.$content.'</textarea>';
                break;	
				
				 case 'UMEDITOR_QUESTION':
                $parseStr   =  '
				<link href="__ROOT__/public/umeditor_question/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
                <script type="text/javascript" src="__ROOT__/public/umeditor_question/third-party/jquery.min.js"></script>
                <script type="text/javascript" charset="utf-8" src="__ROOT__/public/umeditor_question/umeditor.config.js"></script>
                <script type="text/javascript" charset="utf-8" src="__ROOT__/public/umeditor_question/umeditor.min.js"></script>
                <script type="text/javascript" src="__ROOT__/public/umeditor_question/lang/zh-cn/zh-cn.js"></script>
				<textarea id="'.$id.'" style="'.$style.'" name="'.$name.'" >'.$content.'</textarea>
				  <script>	
			       var um = UM.getEditor("'.$id.'");
				   um.ready(function(){
					   um.setContent("213sda");
				   });
		          </script>
				  ';
                break;
				
				
				case 'UEDITOR_BEGIN':
				$parseStr   =  '
				<script type="text/javascript" charset="utf-8" src="__ROOT__/public/ueditor/ueditor.config.js"></script>
                <script type="text/javascript" charset="utf-8" src="__ROOT__/public/ueditor/ueditor.all.min.js"> </script>
				<script type="text/javascript" charset="utf-8" src="__ROOT__/public/ueditor/lang/zh-cn/zh-cn.js"></script>
				 ';
                break;
				
				
				 case 'UEDITOR':
                $parseStr   =  '
				<script  id="'.$id.'" type="text/plain" style="'.$style.'" name="'.$name.'" >'.$content.'</script>
				  <script type="text/javascript">
			       var ue_'.$id.' = UE.getEditor("'.$id.'");
		          </script>
				  ';
                break;
				
				
				
				
            default :
                $parseStr  =  '<textarea id="'.$id.'" style="'.$style.'" name="'.$name.'" >'.$content.'</textarea>';
        }
		
		
		
		
		
		
		
		
		

        return $parseStr;
    }

    /**
     * imageBtn标签解析
     * 格式： <html:imageBtn type="" value="" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _imageBtn($tag) {
        $name       = $tag['name'];                //名称
        $value      = $tag['value'];                //文字
        $id         = isset($tag['id'])?$tag['id']:'';                //ID
        $style      = isset($tag['style'])?$tag['style']:'';                //样式名
        $click      = isset($tag['click'])?$tag['click']:'';                //点击
        $type       = empty($tag['type'])?'button':$tag['type'];                //按钮类型

        if(!empty($name)) {
            $parseStr   = '<div class="'.$style.'" ><input type="'.$type.'" id="'.$id.'" name="'.$name.'" value="'.$value.'" onclick="'.$click.'" class="'.$name.' imgButton"></div>';
        }else {
        	$parseStr   = '<div class="'.$style.'" ><input type="'.$type.'" id="'.$id.'"  name="'.$name.'" value="'.$value.'" onclick="'.$click.'" class="button"></div>';
        }

        return $parseStr;
    }

    /**
     * imageLink标签解析
     * 格式： <html:imageLink type="" value="" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _imgLink($tag) {
        $name       = $tag['name'];                //名称
        $alt        = $tag['alt'];                //文字
        $id         = $tag['id'];                //ID
        $style      = $tag['style'];                //样式名
        $click      = $tag['click'];                //点击
        $type       = $tag['type'];                //点击
        if(empty($type)) {
            $type = 'button';
        }
       	$parseStr   = '<span class="'.$style.'" ><input title="'.$alt.'" type="'.$type.'" id="'.$id.'"  name="'.$name.'" onmouseover="this.style.filter=\'alpha(opacity=100)\'" onmouseout="this.style.filter=\'alpha(opacity=80)\'" onclick="'.$click.'" align="absmiddle" class="'.$name.' imgLink"></span>';

        return $parseStr;
    }

    /**
     * select标签解析
     * 格式： <html:select options="name" selected="value" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _select($tag) {
        $name       = $tag['name'];
        $options    = $tag['options'];
        $values     = $tag['values'];
        $output     = $tag['output'];
        $multiple   = $tag['multiple'];
        $id         = $tag['id'];
        $size       = $tag['size'];
        $first      = $tag['first'];
        $selected   = $tag['selected'];
        $style      = $tag['style'];
        $stylecss   = $tag['stylecss'];
        $ondblclick = $tag['dblclick'];
		$onchange	= $tag['change'];
       
        if(!empty($multiple)) {
            $parseStr = '<select id="'.$id.'" style="'.$stylecss.'" name="'.$name.'" ondblclick="'.$ondblclick.'" onchange="'.$onchange.'" multiple="multiple" class="'.$style.'" size="'.$size.'" >';
        }else {
        	$parseStr = '<select id="'.$id.'" style="'.$stylecss.'" name="'.$name.'" onchange="'.$onchange.'" ondblclick="'.$ondblclick.'" class="'.$style.'" >';
        }
        if(!empty($first)) {
            $parseStr .= '<option value="" >'.$first.'</option>';
        }
        if(!empty($options)) {
            $parseStr   .= '<?php  foreach($'.$options.' as $key=>$val) { ?>';
            if(!empty($selected)) {
                $parseStr   .= '<?php if($'.$selected.'!=="" && ($'.$selected.' == $key || in_array($key,$'.$selected.'))) { ?>';
                $parseStr   .= '<option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option>';
                $parseStr   .= '<?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option>';
                $parseStr   .= '<?php } ?>';
            }else {
                $parseStr   .= '<option value="<?php echo $key ?>"><?php echo $val ?></option>';
            }
            $parseStr   .= '<?php } ?>';
        }else if(!empty($values)) {
            $parseStr   .= '<?php  for($i=0;$i<count($'.$values.');$i++) { ?>';
            if(!empty($selected)) {
                $parseStr   .= '<?php if(isset($'.$selected.') && ((is_string($'.$selected.') && $'.$selected.' == $'.$values.'[$i]) || (is_array($'.$selected.') && in_array($'.$values.'[$i],$'.$selected.')))) { ?>';
                $parseStr   .= '<option selected="selected" value="<?php echo $'.$values.'[$i] ?>"><?php echo $'.$output.'[$i] ?></option>';
                $parseStr   .= '<?php }else { ?><option value="<?php echo $'.$values.'[$i] ?>"><?php echo $'.$output.'[$i] ?></option>';
                $parseStr   .= '<?php } ?>';
            }else {
                $parseStr   .= '<option value="<?php echo $'.$values.'[$i] ?>"><?php echo $'.$output.'[$i] ?></option>';
            }
            $parseStr   .= '<?php } ?>';
        }
        $parseStr   .= '</select>';
        return $parseStr;
    }
	
	
	 /**
     * select标签解析
     * 格式： <html:selecthtml options="name" selected="value" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _selecthtml($tag) {
        $name       = $tag['name'];
        $options    = $tag['options'];
        $values     = $tag['values'];
        $output     = $tag['output'];
        $multiple   = $tag['multiple'];
        $id         = $tag['id'];
        $size       = $tag['size'];
        $first      = $tag['first'];
        $selected   = $tag['selected'];
        $style      = $tag['style'];
        $ondblclick = $tag['dblclick'];
		$onchange	= $tag['change'];
        $parseStr ='
		<?php
		$selected="";
		$selected_value=""; 
		?>
		<div class="btn-group dropdown">';	
		
		$parseStr.='<ul class="dropdown-menu" aria-labelledby="dd">';
        if(!empty($options)) {
			if(!empty($first)){
			    $parseStr   .='<?php 
				$new_options=array();
			    $new_options[0]=\''.$first.'\';
				foreach($'.$options.' as $key=>$val){
					$new_options[$key]=$val;
				}
				?>';
			 }else{
			    $parseStr   .='<?php 
				$new_options=array();
				$new_options=$'.$options.';
				?>';
			}
            $parseStr   .= '<?php
								$i=0;
								foreach($new_options as $key=>$val){ 
						   ?>';
			$parseStr   .= '<li><a href="javascript:void(0);" onClick="'.$onchange.'" data-val="<?php echo $key ?>"><?php echo $val ?></a></li>';
		    if(!empty($selected)) {
                $parseStr .= '<?php
								 if(($'.$selected.' == $key || in_array($key,$'.$selected.'))) {
					               $selected=$key;
								   $selected_value=$val; 
				}
					            ?>';
            }else{
			    $parseStr .= '<?php if($i==0){
					               $selected=$key;
								   $selected_value=$val; 
				                  }
					            ?>';	
			}
            $parseStr   .= '<?php $i++;} ?>';
        }else if(!empty($values)) {
            $parseStr   .= '<?php  for($i=0;$i<count($'.$values.');$i++) { ?>';
			$parseStr   .= '<li><a href="javascript:void(0);" onClick="'.$onchange.'" data-val="<?php echo $'.$values.'[$i] ?>"><?php echo $'.$output.'[$i] ?></a></li>';
			
            if(!empty($selected)) {
                $parseStr   .= '<?php if(isset($'.$selected.') && ((is_string($'.$selected.') && $'.$selected.' == $'.$values.'[$i]) || (is_array($'.$selected.') && in_array($'.$values.'[$i],$'.$selected.')))) {
					               $selected=$key;
								   $selected_value=$val;
				                }
					 ?>';
            }else {
				$parseStr .= '<?php
					               $selected=$'.$values.'[0];
								   $selected_value=$'.$output.'[0];
					            ?>';
            }
            $parseStr   .= '<?php } ?>';
        }
		 $parseStr.= '</ul>';
		 
		
		
		$selected='';
		$selected_value='';
        if(!empty($multiple)) {
            $parseStr .= '<button id="'.$id.'" name="'.$name.'" class="btn  btn-default dropdown-toggle" data-toggle="dropdown" ondblclick="'.$ondblclick.'" onchange="'.$onchange.'" multiple="multiple" size="'.$size.'" type="reset" value="<?php echo $selected; ?>"><?php echo $selected_value; ?>&nbsp;<span class="caret"></span></button>';
        }else {
        	$parseStr .= '<button id="'.$id.'" name="'.$name.'" class="btn  btn-default dropdown-toggle" data-toggle="dropdown"  onchange="'.$onchange.'" ondblclick="'.$ondblclick.'" value="<?php echo $selected; ?>" type="reset"><?php echo $selected_value; ?>&nbsp;<span class="caret"></span></button>';
        }
		
		 $parseStr   .= '</div>';
		
        return $parseStr;
    }
	
	
	
	
	 /**
     * select标签解析
     * 格式： <html:select_multiple options="name" selected="value" />
     * @access public
     * @param array $tag 多选标签属性
     * @return string|void
     */
    public function _select_multiple($tag) {
        $name       = $tag['name'];
        $options    = $tag['options'];
        $values     = $tag['values'];
        $output     = $tag['output'];
        $multiple   = $tag['multiple'];
        $id         = $tag['id'];
        $size       = $tag['size'];
        $first      = $tag['first'];
        $selected   = $tag['selected'];
        $style      = $tag['style'];
        $ondblclick = $tag['dblclick'];
		$onchange	= $tag['change'];
        if($selected==""){$s_values="array();";}else{$s_values="$".$selected;}
		$parseStr ='
		<link href="__TMPL__Common/css/select_transfer.css" type="text/css" media="screen" rel="stylesheet" />
		<div class="add_tags_input"></div>
                     <script type="text/javascript">         
                                   //添加标签
								   function add_tags(){
									   var input_html="";
									   $(\'#id_Label\').find(\'option\').each(function(index, element) {
                                           input_html += " <input type=\'hidden\' name=\'tags[]\' value=\'"+$(this).val()+"\' />";
                                       });
									   $(\'.add_tags_input\').html(input_html);
								   }
								   function check_form(){
									   add_tags();
									   return true;
 	                               }
                    </script>';
				
	    
		$parseStr.='<?php 
				$new_options=array();
				$new_options=$'.$options.';
				$new_values='.$s_values.';
				 
				 $none_list=array();
				 $select_list=array();
				 foreach($new_options as $key=>$no){
					  if(is_array($new_values) and in_array($key,$new_values)){
						  $select_list[$key]=$no;  
					  }else{
						  $none_list[$key]=$no;  
					  }
			     }
				  
				  
				?>
		 ';
			
					
		$parseStr.='<div class="selector select-transfer">
                              <div class="selector-available">
                                <p class="title">可用项 标签</p>
                                <div class="input-group input-group-sm selector-filter">
                                   <span class="input-group-addon"><i class="icon-search"></i></span>
                                   <input class="form-control" type="text" id="id_Label_input">
                                </div>
                                <select multiple="multiple" id="id_Label_form">
                                   <?php foreach($none_list as $key=>$no){ ?>
                                    <option value="<?php echo $key; ?>"><?php echo $no;?></option>
                                   <?php } ?>
                                </select><a class="btn btn-default selector-chooseall" title="点击一次性选择全部">选择全部</a></div><ul class="selector-chooser"><li><a class="btn btn-default btn-sm selector-add" title="选择"><i class="icon-plus">+</i></a></li><li><a class="btn btn-default btn-sm selector-remove" title="删除"><i class="icon-minus">-</i></a></li></ul><div class="selector-chosen"><p class="title">已选项 标签</p>
								<select multiple="multiple"  class="" id="id_Label">
                                   <?php foreach($select_list as $key=>$no){ ?>
                                    <option value="<?php echo $key; ?>"><?php echo $no;?></option>
                                   <?php } ?>
								</select>
								<a class="btn btn-default selector-clearall" title="点击一次性删除全部">删除全部</a></div></div>
								';

        return $parseStr;
    }
	
	
	
	
	 /**
     * select标签解析
     * 格式： <html:checkbox_son_multiple options="name" selected="value" />
     * @access public
     * @param array $tag 多选标签属性
     * @return string|void
     */
    public function _checkbox_son_multiple($tag){
        $name       = $tag['name'];
        $options    = $tag['options'];
        $values     = $tag['values'];
        $output     = $tag['output'];
        $multiple   = $tag['multiple'];
        $id         = $tag['id'];
        $size       = $tag['size'];
        $first      = $tag['first'];
        $selected   = $tag['selected'];
        $style      = $tag['style'];
        $ondblclick = $tag['dblclick'];
		$onchange	= $tag['change'];
		$son_type	= $tag['son_type'];
        if($selected==""){$s_values="array();";}else{$s_values="$".$selected;}
		if($son_type==1){
			$son_input_name=$name.'_son[]';
			$son_input_type='checkbox';
			$son_input_value='{$sl.value}_{$sls.value}';
		}else{
			$son_input_name=$name.'_{$sl.value}';
			$son_input_type='radio';
			$son_input_value='{$sls.value}';
		}
		
		
		
		
		
		$parseStr ='
		   <div style=" width:100%; border:#cccccc solid 1px; padding:10px; height:200px">
                               <li style="width:25%; float:left; list-style:none; border-right:#cccccc solid 1px; height:180px; overflow:auto;"  id="left_li_f_'.$name.'">
									<?php foreach($'.$options.' as $key=>$sl){ 
									   $value_input="";
									   if($'.$selected.'[$sl[\'value\']]!=""){
										   $value_input="checked";
									   }
									?>
                                      <div><label onclick="turn_son_show_'.$name.'();"><input name="'.$name.'[]" type="checkbox" value="{$sl.value}" <?php echo $value_input;?>/>&nbsp;{$sl.name}</label></div>
									  
                                    <?php } ?>
                               </li>
                               <li style="width:75%; float:left; list-style:none; height:180px; overflow:auto;" id="right_li_s_'.$name.'">
                                    <?php foreach($'.$options.' as $key=>$sl){ ?>
                                      <div id="div_{$sl.value}">
                                        <span style="margin-left:10px;">{$sl.name}:</span>
                                        <?php foreach($sl["son"] as $sls){
											
											
									   $value_input="";
									   if(is_array($'.$selected.'[$sl[\'value\']]) and in_array($sls[\'value\'],$'.$selected.'[$sl[\'value\']])){
										   $value_input="checked";
									   }
											
											
											 ?>
										   
                                           <label style=" margin-left:10px;"><input name="'.$son_input_name.'" type="'.$son_input_type.'" value="'.$son_input_value.'" <?php echo $value_input;?>/>&nbsp;{$sls.name}</label>
                                        <?php } ?>
                                      </div>
                                    <?php } ?>
                               </li>
                             </div>
							  <script type="text/javascript">
							  function turn_son_show_'.$name.'(){
								  $(\'#left_li_f_'.$name.'\').find(\'input[type=checkbox]\').each(function(index,element){
									  if($(this).prop(\'checked\')==true){
										 //checked_array.push(index); 
										 $(\'#right_li_s_'.$name.' div\').eq(index).show();
									  }else{
										 $(\'#right_li_s_'.$name.' div\').eq(index).find(\'input\').prop(\'checked\',false);
										 
										 $(\'#right_li_s_'.$name.' div\').eq(index).hide();
									  } 
                                  });
							  }
							  jQuery(document).ready(function(){turn_son_show_'.$name.'();});
                            </script>
		';

        return $parseStr;
    }
	
	
	
	

    /**
     * checkbox标签解析
     * 格式： <html:checkbox checkboxes="" checked="" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _checkbox($tag) {
        $name       = $tag['name'];
        $checkboxes = $tag['checkboxes'];
        $checked    = $tag['checked'];
        $separator  = $tag['separator'];
        $checkboxes = $this->tpl->get($checkboxes);
        $checked    = $this->tpl->get($checked)?$this->tpl->get($checked):$checked;
		
        foreach($checkboxes as $key=>$val) {
			$parseStr .='<?php
			   $now_checked="";
			?>';
			if($checked!=""){
			$parseStr .='<?php 
			    if(is_array($'.$checked.') and in_array("'.$key.'",$'.$checked.')){
				    $now_checked=\' checked="checked"\';
				}
			 ?>';
			}
			$parseStr .= '<label class="checkbox-inline"><input type="checkbox" <?php echo $now_checked;?> name="'.$name.'[]" value="'.$key.'">'.$val.$separator."</label>";
        }
        return $parseStr;
    }

    /**
     * radio标签解析
     * 格式： <html:radio radios="name" checked="value" />
     * @access public
     * @param array $tag 标签属性
     * @return string|void
     */
    public function _radio($tag) {
        $name       = $tag['name'];
        $radios     = $tag['radios'];
        $checked    = $tag['checked'];
        $separator  = $tag['separator'];
        $radios     = $this->tpl->get($radios);
        $checked    = $this->tpl->get($checked)?$this->tpl->get($checked):$checked;
        $parseStr   = '';
		
        $checked_value  = $tag['checked_value'];
        foreach($radios as $key=>$val) {
            if($checked == $key ) {
                $parseStr .= '<label><input type="radio" checked="checked" name="'.$name.'" value="'.$key.'">'.$val.$separator."</label>&nbsp;&nbsp;";
            }else {
                $parseStr .= '<label><input type="radio" name="'.$name.'" value="'.$key.'">'.$val.$separator."</label>&nbsp;&nbsp;";
            }

        }
        return $parseStr;
    }


    /**
     * list标签解析
     * 格式： <html:grid datasource="" show="vo" />
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function _grid($tag) {
        $id         = $tag['id'];                       //表格ID
        $datasource = $tag['datasource'];               //列表显示的数据源VoList名称
        $pk         = empty($tag['pk'])?'id':$tag['pk'];//主键名，默认为id
        $style      = $tag['style'];                    //样式名
        $name       = !empty($tag['name'])?$tag['name']:'vo';                 //Vo对象名
        $action     = !empty($tag['action'])?$tag['action']:false;                   //是否显示功能操作
        $key         =  !empty($tag['key'])?true:false;
        if(isset($tag['actionlist'])) {
            $actionlist = explode(',',trim($tag['actionlist']));    //指定功能列表
        }

        if(substr($tag['show'],0,1)=='$') {
            $show   = $this->tpl->get(substr($tag['show'],1));
        }else {
            $show   = $tag['show'];
        }
        $show       = explode(',',$show);                //列表显示字段列表

        //计算表格的列数
        $colNum     = count($show);
        if(!empty($action))     $colNum++;
        if(!empty($key))  $colNum++;

        //显示开始
		$parseStr	= "<!-- Think 系统列表组件开始 -->\n";
        $parseStr  .= '<table id="'.$id.'" class="'.$style.'" cellpadding=0 cellspacing=0 >';
        $parseStr  .= '<tr><td height="5" colspan="'.$colNum.'" class="topTd" ></td></tr>';
        $parseStr  .= '<tr class="row" >';
        //列表需要显示的字段
        $fields = array();
        foreach($show as $val) {
        	$fields[] = explode(':',$val);
        }

        if(!empty($key)) {
            $parseStr .= '<th width="12">No</th>';
        }
        foreach($fields as $field) {//显示指定的字段
            $property = explode('|',$field[0]);
            $showname = explode('|',$field[1]);
            if(isset($showname[1])) {
                $parseStr .= '<th width="'.$showname[1].'">';
            }else {
                $parseStr .= '<th>';
            }
            $parseStr .= $showname[0].'</th>';
        }
        if(!empty($action)) {//如果指定显示操作功能列
            $parseStr .= '<th >操作</th>';
        }
        $parseStr .= '</tr>';
        $parseStr .= '<volist name="'.$datasource.'" id="'.$name.'" ><tr class="row" >';	//支持鼠标移动单元行颜色变化 具体方法在js中定义

        if(!empty($key)) {
            $parseStr .= '<td>{$i}</td>';
        }
        foreach($fields as $field) {
            //显示定义的列表字段
            $parseStr   .=  '<td>';
            if(!empty($field[2])) {
                // 支持列表字段链接功能 具体方法由JS函数实现
                $href = explode('|',$field[2]);
                if(count($href)>1) {
                    //指定链接传的字段值
                    // 支持多个字段传递
                    $array = explode('^',$href[1]);
                    if(count($array)>1) {
                        foreach ($array as $a){
                            $temp[] =  '\'{$'.$name.'.'.$a.'|addslashes}\'';
                        }
                        $parseStr .= '<a href="javascript:'.$href[0].'('.implode(',',$temp).')">';
                    }else{
                        $parseStr .= '<a href="javascript:'.$href[0].'(\'{$'.$name.'.'.$href[1].'|addslashes}\')">';
                    }
                }else {
                    //如果没有指定默认传编号值
                    $parseStr .= '<a href="javascript:'.$field[2].'(\'{$'.$name.'.'.$pk.'|addslashes}\')">';
                }
            }
            if(strpos($field[0],'^')) {
                $property = explode('^',$field[0]);
                foreach ($property as $p){
                    $unit = explode('|',$p);
                    if(count($unit)>1) {
                        $parseStr .= '{$'.$name.'.'.$unit[0].'|'.$unit[1].'} ';
                    }else {
                        $parseStr .= '{$'.$name.'.'.$p.'} ';
                    }
                }
            }else{
                $property = explode('|',$field[0]);
                if(count($property)>1) {
                    $parseStr .= '{$'.$name.'.'.$property[0].'|'.$property[1].'}';
                }else {
                    $parseStr .= '{$'.$name.'.'.$field[0].'}';
                }
            }
            if(!empty($field[2])) {
                $parseStr .= '</a>';
            }
            $parseStr .= '</td>';

        }
        if(!empty($action)) {//显示功能操作
            if(!empty($actionlist[0])) {//显示指定的功能项
                $parseStr .= '<td>';
                foreach($actionlist as $val) {
					if(strpos($val,':')) {
						$a = explode(':',$val);
						if(count($a)>2) {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$a[2].'}\')">'.$a[1].'</a>&nbsp;';
						}else {
							$parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$pk.'}\')">'.$a[1].'</a>&nbsp;';
						}
					}else{
						$array	=	explode('|',$val);
						if(count($array)>2) {
							$parseStr	.= ' <a href="javascript:'.$array[1].'(\'{$'.$name.'.'.$array[0].'}\')">'.$array[2].'</a>&nbsp;';
						}else{
							$parseStr .= ' {$'.$name.'.'.$val.'}&nbsp;';
						}
					}
                }
                $parseStr .= '</td>';
            }
        }
        $parseStr	.= '</tr></volist><tr><td height="5" colspan="'.$colNum.'" class="bottomTd"></td></tr></table>';
        $parseStr	.= "\n<!-- Think 系统列表组件结束 -->\n";
        return $parseStr;
    }

    /**
     * list标签解析
     * 格式： <html:list datasource="" show="" />
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function _list($tag) {
        $id         = $tag['id'];                       //表格ID
        $datasource = $tag['datasource'];               //列表显示的数据源VoList名称
        $pk         = empty($tag['pk'])?'id':$tag['pk'];//主键名，默认为id
        $style      = $tag['style'];                    //样式名
        $name       = !empty($tag['name'])?$tag['name']:'vo';                 //Vo对象名
        $title      = !empty($tag['title'])?$tag['title']:'';                 //表title
        $pagelist   = !empty($tag['pagelist'])?$tag['pagelist']:'';                 //表title
        $action     = $tag['action']=='true'?true:false;                   //是否显示功能操作
        $key         =  !empty($tag['key'])?true:false;
        $sort      = $tag['sort']=='false'?false:true;
        $checkbox   = $tag['checkbox'];                 //是否显示Checkbox
        if(isset($tag['actionlist'])) {
            if(substr($tag['actionlist'],0,1)=='$') {
                $actionlist   = $this->tpl->get(substr($tag['actionlist'],1));
            }else {
                $actionlist   = $tag['actionlist'];
            }
            $actionlist = explode(',',trim($actionlist));    //指定功能列表
        }

        if(substr($tag['show'],0,1)=='$') {
            $show   = $this->tpl->get(substr($tag['show'],1));
        }else {
            $show   = $tag['show'];
        }
        $show       = explode(',',$show);                //列表显示字段列表

        //计算表格的列数
        $colNum     = count($show);
        if(!empty($checkbox))   $colNum++;
        if(!empty($action))     $colNum++;
        if(!empty($key))  $colNum++;
        //显示开始
		$parseStr	= "<!-- Think 系统列表组件开始 -->\n";
        $parseStr  .= '<table id="'.$id.'" class="'.$style.'  table-hover" cellpadding=0 cellspacing=0 >';
		
		
        $parseStr  .= '<thead>';
		$parseStr_head  .= '<tr>';
        //列表需要显示的字段
        $fields = array();
        foreach($show as $val) {
        	$fields[] = explode(':',$val);
        }
        if(!empty($checkbox) && 'true'==strtolower($checkbox)) {//如果指定需要显示checkbox列
            $parseStr_head .='<th width="8"><input type="checkbox" id="check" onclick="CheckAll(\''.$id.'\')"></th>';
        }
        if(!empty($key)) {
            $parseStr_head .= '<th width="12">No</th>';
        }
        foreach($fields as $field) {//显示指定的字段
            $property = explode('|',$field[0]);
            $showname = explode('|',$field[1]);
            if(isset($showname[1])) {
                $parseStr_head .= '<th width="'.$showname[1].'" data-field="'.$property[0].'">';
            }else {
                $parseStr_head .= '<th data-field="'.$property[0].'">';
            }
            $showname[2] = isset($showname[2])?$showname[2]:$showname[0];
            if($sort) {
                $parseStr_head .= '<a href="javascript:sortBy(\''.$property[0].'\',\'{$sort}\',\''.ACTION_NAME.'\')" title="按照'.$showname[2].'{$sortType} ">'.$showname[0].'<eq name="order" value="'.$property[0].'" ><img src="__PUBLIC__/images/{$sortImg}.gif" width="12" height="17" border="0" align="absmiddle"></eq></a></th>';
            }else{
                $parseStr_head .= $showname[0].'</th>';
            }

        }
        if(!empty($action)) {//如果指定显示操作功能列
            $parseStr_head .= '<th >操作</th>';
        }

        $parseStr_head .= '</tr>';
		
		$parseStr=$parseStr.$parseStr_head;
		
		$parseStr  .= '</thead>';
		
		
		
        $parseStr .= '<volist name="'.$datasource.'" id="'.$name.'" ><tr ';	//支持鼠标移动单元行颜色变化 具体方法在js中定义
        if(!empty($checkbox)) {
        //    $parseStr .= 'onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ';
        }
        $parseStr .= '>';
        if(!empty($checkbox) && 'true'==strtolower($checkbox)) {//如果指定需要显示checkbox列
            $parseStr .= '<td><input data-id="{$'.$name.'.'.$pk.'}" class="J_check key" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" type="checkbox" class="key"	value="{$'.$name.'.'.$pk.'}"></td>';
        }
        if(!empty($key)) {
            $parseStr .= '<td>{$i}</td>';
        }
        foreach($fields as $field) {
            //显示定义的列表字段
            $parseStr   .=  '<td>';
            if(!empty($field[2])) {
                // 支持列表字段链接功能 具体方法由JS函数实现
                $href = explode('|',$field[2]);
                if(count($href)>1) {
                    //指定链接传的字段值
                    // 支持多个字段传递
                    $array = explode('^',$href[1]);
                    if(count($array)>1) {
                        foreach ($array as $a){
                            $temp[] =  '\'{$'.$name.'.'.$a.'|addslashes}\'';
                        }
                        $parseStr .= '<a href="javascript:'.$href[0].'('.implode(',',$temp).')">';
                    }else{
                        $parseStr .= '<a href="javascript:'.$href[0].'(\'{$'.$name.'.'.$href[1].'|addslashes}\')">';
                    }
                }else {
                    //如果没有指定默认传编号值
                    $parseStr .= '<a href="javascript:'.$field[2].'(\'{$'.$name.'.'.$pk.'|addslashes}\')">';
                }
            }
            if(strpos($field[0],'^')) {
                $property = explode('^',$field[0]);
                foreach ($property as $p){
                    $unit = explode('|',$p);
                    if(count($unit)>1) {
                        $parseStr .= '{$'.$name.'.'.$unit[0].'|'.$unit[1].'} ';
                    }else {
                        $parseStr .= '{$'.$name.'.'.$p.'} ';
                    }
                }
            }else{
                $property = explode('|',$field[0]);
			    ///echo '{$'.$name.'.'.$property[0].'|'.$property[1].'}'."<br />";
                if(count($property)>1) {
					
					 $property[1] = str_replace('--',',',$property[1]);
                    $parseStr .= '{$'.$name.'.'.$property[0].'|'.$property[1].'}';
                }else {
                    $parseStr .= '{$'.$name.'.'.$field[0].'}';
                }
            }
            if(!empty($field[2])) {
                $parseStr .= '</a>';
            }
            $parseStr .= '</td>';

        }
        if(!empty($action)) {//显示功能操作
            if(!empty($actionlist[0])) {//显示指定的功能项
                $parseStr .= '<td>';
                foreach($actionlist as $val) {
                    if(strpos($val,':')) {
                    
						$a = explode(':',$val);
						if(strpos($a[1],"修改")!==false){$act_competence="edit";}
						if(strpos($a[1],"删除")!==false){$act_competence="delete";}
						if(strpos($a[1],"查看")!==false){$act_competence="view";}
						
						$a[1]=str_replace('修改','<i class=\'fa fa-edit\'></i>',$a[1]);
						$a[1]=str_replace('删除','<i class=\'fa fa-times\'></i>',$a[1]);
						$a[1]=str_replace('查看','<i class=\'fa fa-eye\'></i>',$a[1]);
					
					    
						if(count($a)==3) {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$a[2].'}\');">{:check_action_competence("'.$a[1].'",$'.$name.'["is_system"],"'.$act_competence.'")}</a>&nbsp;';
                        }
						
						else if(count($a)==4){
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$a[2].'}\',\''.$a[3].'\')">{:check_action_competence("'.$a[1].'",$'.$name.'["is_system"],"'.$act_competence.'")}</a>&nbsp;';
					    }else if(count($a)>4){
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$a[2].'}\',\''.$a[3].'\',\''.$a[4].'\')">{:check_action_competence("'.$a[1].'",$'.$name.'["is_system"],"'.$act_competence.'")}</a>&nbsp;';
					    }else {
                            $parseStr .= '<a href="javascript:'.$a[0].'(\'{$'.$name.'.'.$pk.'}\');" onclick="">{:check_action_competence("'.$a[1].'",$'.$name.'["is_system"],"'.$act_competence.'")}</a>&nbsp;';
                        }
                    }else{
                        $array	=	explode('|',$val);
                        if(count($array)>2) {
                            $parseStr	.= ' <a href="javascript:'.$array[1].'(\'{$'.$name.'.'.$array[0].'}\')">'.$array[2].'</a>&nbsp;';
                        }else{
							$val = str_replace('--',',',$val);
                            $parseStr .= ' {$'.$name.'.'.$val.'}&nbsp;';
                        }
                    }
                }
                $parseStr .= '</td>';
            }
        }
        $parseStr	.= '</tr></volist>';
		$parseStr=$parseStr."<tfoot>".$parseStr_head."</tfoot>";
        $parseStr	.= '</table>';
        $parseStr	.= "\n<!-- Think 系统列表组件结束 -->\n";
        //echo $parseStr;exit();
		return $parseStr;
    }
	
	
	
	/**
     +----------------------------------------------------------
     * imgUpload标签解析
     * 格式： <html:imgUpload name='name' value='value' width='width' height='height' />
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */

    public function _imgUpload($tag)
    {
        $name       = $tag['name'];
        $id 		= $tag['id'];
        $value	    = $tag['value'];
		$style      = $tag['style'];  
		//$upload_type      = $tag['upload_type']; 
        $upload_type      = !empty($tag['upload_type'])?$tag['upload_type']:'other';
		$upload_path_son  = $tag['upload_path_son']; 
		
		$parseStr='
<script>
      //实例化编辑器
	  var up_image_input="";
      var o_ueditorupload_'.$id.' = UE.getEditor("j_ueditorupload_'.$id.'",
      {
        autoHeightEnabled:false
      });
      o_ueditorupload_'.$id.'.ready(function ()
      {
	 
	   o_ueditorupload_'.$id.'.hide();//隐藏编辑器
	   o_ueditorupload_'.$id.'.execCommand("serverparam",{
         "upload_type": \''.$upload_type.'\',
         "upload_path_son": \''.$upload_path_son.'\'
      });
	
	//监听图片上传
	o_ueditorupload_'.$id.'.addListener("beforeInsertImage", function (t,arg)
	{
          //alert("这是图片地址："+arg[0].src);
		  document.getElementById(up_image_input).value=arg[0].src;
	});
	
      });
      
      //弹出图片上传的对话框
      function upImage(input_name)
      {
	    up_image_input = input_name;
        var myImage = o_ueditorupload_'.$id.'.getDialog("insertimage");
        myImage.open();
      }
    </script>
	<script type="text/plain" id="j_ueditorupload_'.$id.'" style="height:5px;display:none;" ></script>
	<input type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" style="'.$style.'" /><button type="button" onClick="upImage(\''.$id.'\')">上传图片</button>
		';
        return $parseStr;
    }
	
	
	
	
	
	
		/**
     +----------------------------------------------------------
     * imgMultiUpload标签解析
     * 格式： <html:imgMultiUpload name='name' value='value' width='width' height='height' />
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */

    public function _imgMultiUpload($tag)
    {
        $name       = $tag['name'];
        $id 		= $tag['id'];
        $value	    = $tag['value'];
		$style      = $tag['style'];  
        $upload_type      = !empty($tag['upload_type'])?$tag['upload_type']:'other';
		$upload_path_son  = $tag['upload_path_son']; 
		$input_text = $tag['input_text']; 
		$rand=rand(0000,9999);
        if($value==""){$s_values="array();";}else{$s_values='$'.$value;}
		
		if($input_text==""){$input_text="图片列表";}
		
		$value_list='';
		if($value!=""){
		   $value_list='<?php
 if(is_array('.$s_values.')){
	 $p=1;
     foreach('.$s_values.' as $p=>$sv){
		echo "<li id=\"image".$p."\"><input title=\"双击查看\" type=\"text\" name=\"'.$name.'_url[]\" value=\"".$sv["url"]."\" style=\"width:310px;\" ondblclick=\"image_priview(this.value);\" class=\"input\"> <input type=\"text\" name=\"'.$name.'_name[]\" placeholder=\"文件名\" value=\"".$sv["name"]."\" style=\"width:160px;\" class=\"input\" onfocus=\"if(this.value == this.defaultValue) this.value = \'\'\" onblur=\"if(this.value.replace(\' \',\'\') == \'\') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div(\'image".$p."\')\"  onclick=\"$(this).parent().remove();\">移除</a> </li>";
		$p++; 
	 }
 }
?>';	
		}
		
		
		$parseStr='
	
	<script>
      //实例化编辑器
	  var up_image_input="";
      var o_ueditorupload_'.$rand.' = UE.getEditor("j_ueditorupload_'.$rand.'",
      {
        autoHeightEnabled:false
      });
      o_ueditorupload_'.$rand.'.ready(function ()
      {
	 
	   o_ueditorupload_'.$rand.'.hide();//隐藏编辑器
	   o_ueditorupload_'.$rand.'.execCommand("serverparam",{
         "upload_type": \''.$upload_type.'\',
         "upload_path_son": \''.$upload_path_son.'\'
      });
	
	//监听图片上传
	o_ueditorupload_'.$rand.'.addListener("beforeInsertImage", function (t,arg)
	{
          //alert("这是图片地址："+arg[0].src);
		 //document.getElementById(up_image_input).value=arg[0].src;
		  
		  var arg_html=$("#j_file_'.$rand.'").html();
		  for(var i=0;i<arg.length;i++){
			  var url_hz=arg[i].src.split(".");
			  var p=i+1;
			  
			  arg_html+="<li id=\"image"+p+"\"><input title=\"双击查看\" type=\"text\" name=\"'.$name.'_url[]\" value=\""+arg[i].src+"\" style=\"width:310px;\" ondblclick=\"image_priview(this.value);\" class=\"input\"> <input type=\"text\" name=\"'.$name.'_name[]\" placeholder=\"文件名\" value=\"\" style=\"width:160px;\" class=\"input\" onfocus=\"if(this.value == this.defaultValue) this.value = \'\'\" onblur=\"if(this.value.replace(\' \',\'\') == \'\') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div(\'image"+p+"\')\"  onclick=\"$(this).parent().remove();\">移除</a> </li>";
			  
			  
			  //arg_html+="<div class=\"fileMultiDiv_div\"><li class=\"fileMultiDiv_filename\"><a href=\""+arg[i].src+"\" target=\"_blank\">"+p+"."+url_hz[1]+"文件</a></li><li class=\"fileMultiDiv_input\"><input type=\"hidden\" name=\"upload_file_url[]\" value=\""+arg[i].url+"\" /><input type=\"text\" name=\"upload_file_name[]\" id=\"textfield\" placeholder=\"文件名\" /></li><li class=\"fileMultiDiv_del\" onclick=\"$(this).parent().remove();\">删除</li></div>";
		  }
		  $("#j_file_'.$rand.'").html(arg_html);
	   });
	
      });
      
      //弹出图片上传的对话框
      function upImage_'.$rand.'(input_name)
      {
	    up_image_input = input_name;
        var myImage = o_ueditorupload_'.$rand.'.getDialog("insertimage");
        myImage.open();
      }
    </script>
<script type="text/plain" id="j_ueditorupload_'.$rand.'" style="height:5px;display:none;" ></script>
<legend>'.$input_text.'</legend>
<ul id="j_file_'.$rand.'"  class="picList unstyled">
'.$value_list.'
</ul>
<button type="button" onClick="upImage_'.$rand.'(\''.$rand.'\')">上传图片</button>
';
        return $parseStr;
    }
	
	
	
	
	
	
	
		/**
     +----------------------------------------------------------
     * fileUpload标签解析
     * 格式： <html:fileUpload name='name' value='value' width='width' height='height' />
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */

    public function _fileUpload($tag)
    {
        $name       = $tag['name'];
        $id 		= $tag['id'];
        $value	    = $tag['value'];
		$style      = $tag['style'];  
        $upload_type      = !empty($tag['upload_type'])?$tag['upload_type']:'other';
		$upload_path_son  = $tag['upload_path_son']; 
		$input_text = $tag['input_text']; 
		
		if($input_text==""){$input_text="上传附件";}
		
		$parseStr='
<script>
      //实例化编辑器
	  var up_file_input="";
      var o_ueditorupload_'.$id.' = UE.getEditor("j_ueditorupload_'.$id.'",
      {
        autoHeightEnabled:false
      });
      o_ueditorupload_'.$id.'.ready(function ()
      {
	
	o_ueditorupload_'.$id.'.hide();//隐藏编辑器
	 o_ueditorupload_'.$id.'.execCommand("serverparam", {
         "upload_type": \''.$upload_type.'\',
         "upload_path_son": \''.$upload_path_son.'\'
    });
	
	//监听文件上传
	o_ueditorupload_'.$id.'.addListener("afterUpfile", function (t,arg)
	{
		  document.getElementById(up_file_input).value=arg[0].url;
	});
	
      });
      
      //弹出文件上传的对话框
      function upFiles(input_name)
      {
	    up_file_input = input_name;
        var myFiles = o_ueditorupload_'.$id.'.getDialog("attachment");
        myFiles.open();
      }
    </script>
	<script type="text/plain" id="j_ueditorupload_'.$id.'" style="height:5px;display:none;" ></script>
	<input type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" style="'.$style.'" /><button type="button" onClick="upFiles(\''.$id.'\')">'.$input_text.'</button>
		';
        return $parseStr;
    }
	
	
	
	
		/**
     +----------------------------------------------------------
     * fileUpload标签解析
     * 格式： <html:fileMultiUpload name='name' value='value' width='width' height='height' />
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */

    public function _fileMultiUpload($tag)
    {
        $name       = $tag['name'];
        $id 		= $tag['id'];
        $value	    = $tag['value'];
		$style      = $tag['style'];  
        $upload_type      = !empty($tag['upload_type'])?$tag['upload_type']:'other';
		$upload_path_son  = $tag['upload_path_son']; 
		$input_text = $tag['input_text']; 
        if($value==""){$s_values="array();";}else{$s_values='$'.$value;}
		
		if($input_text==""){$input_text="上传附件";}
		
		
		$value_list='';
		if($value!=""){
		   $value_list='<?php
 if(is_array('.$s_values.')){
	 $p=1;
     foreach('.$s_values.' as $sv){
	    echo "<div class=\"fileMultiDiv_div\"><li class=\"fileMultiDiv_filename\"><a href=\"".$sv["file_url"]."\" target=\"_blank\">".$p.".".substr(strrchr($sv["file_url"], \'.\'), 1)."文件</a></li><li class=\"fileMultiDiv_input\"><input type=\"hidden\" name=\"upload_file_url[]\" value=\"".$sv["file_url"]."\" /><input type=\"text\" name=\"upload_file_name[]\" id=\"textfield\" placeholder=\"文件名\" /></li><li class=\"fileMultiDiv_del\" onclick=\"$(this).parent().remove();\">删除</li></div>";	
		
		$p++; 
	 }
 }
?>';	
		}
		
		
		$parseStr='
<script>
      //实例化编辑器
	  var up_file_input="";
      var o_ueditorupload_'.$id.' = UE.getEditor("j_ueditorupload_'.$id.'",
      {
        autoHeightEnabled:false
      });
      o_ueditorupload_'.$id.'.ready(function ()
      {
	
	o_ueditorupload_'.$id.'.hide();//隐藏编辑器
	 o_ueditorupload_'.$id.'.execCommand("serverparam", {
         "upload_type": \''.$upload_type.'\',
         "upload_path_son": \''.$upload_path_son.'\'
    });
	
	//监听文件上传
	o_ueditorupload_'.$id.'.addListener("afterUpfile", function (t,arg)
	{
		  console.log(arg);
		  //document.getElementById(up_file_input).value=arg[0].url;
		  var arg_html=$("#j_file_'.$id.'").html();
		  for(var i=0;i<arg.length;i++){
			  var url_hz=arg[i].url.split(".");
			  var p=i+1;
			  arg_html+="<div class=\"fileMultiDiv_div\"><li class=\"fileMultiDiv_filename\"><a href=\""+arg[i].url+"\" target=\"_blank\">"+p+"."+url_hz[1]+"文件</a></li><li class=\"fileMultiDiv_input\"><input type=\"hidden\" name=\"upload_file_url[]\" value=\""+arg[i].url+"\" /><input type=\"text\" name=\"upload_file_name[]\" id=\"textfield\" placeholder=\"文件名\" /></li><li class=\"fileMultiDiv_del\" onclick=\"$(this).parent().remove();\">删除</li></div>";
		  }
		  $("#j_file_'.$id.'").html(arg_html);
	 });
	
      });
      
      //弹出文件上传的对话框
      function upFiles_'.$id.'(input_name)
      {
	    up_file_input = input_name;
        var myFiles = o_ueditorupload_'.$id.'.getDialog("attachment");
        myFiles.open();
      }
    </script>
<script type="text/plain" id="j_ueditorupload_'.$id.'" style="height:5px;display:none;" ></script>
<button type="button" onClick="upFiles_'.$id.'(\''.$id.'\')">'.$input_text.'</button>
<div id="j_file_'.$id.'" class="fileMultiDiv">
'.$value_list.'
</div>
		';
        return $parseStr;
    }
	
}