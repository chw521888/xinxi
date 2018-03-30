<?php

//table展示分类name
function show_category_name($id){
	$data = M('Category')->where(array('id'=>$id))->find();
	return $data['name'];
	}