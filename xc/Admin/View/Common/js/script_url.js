
//返回
function go_back() {
    history.back();
}


function showIframeModal(url,title){
	location.href =url;
}

//排序
function sortBy(field, sortType, module_name, action_name) {
    location.href = CURRENT_URL + "&_sort=" + sortType + "&_order=" + field + "&";
}

//添加跳转
function go_index() {
    location.href = ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&" + VAR_ACTION + "=index";
}

//添加跳转
function add(title, action) {
    //location.href = ;
    var a = 'add';
    if (action) {
        a = action;
    }
    showIframeModal(ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&" + VAR_ACTION + "=" + a, title);
}


//编辑跳转
function edit(id, action) {
    //location.href = 
	   var a = 'edit';
    if (action) {
        a = action;
    }
	
    showIframeModal(ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_ACTION + "="+a+"&id=" + id, '编辑');
}


//跳转页面编辑
function dk_edit(id, action) {
    //location.href = 
	   var a = 'edit';
    if (action) {
        a = action;
    }

    showIframeModal(ROOT + "?m=Archives&c=Arctype&a=edit&url=0&id=" + id, '编辑');
}




//编辑跳转
function category_edit(id, action,category_table,have_value) {
    //location.href = 
	   var a = 'category_edit';
    if (action) {
        a = action;
    }
    showIframeModal(ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_ACTION + "="+a+"&category_id=" + id +'&category_table='+category_table+'&have_value='+have_value, '编辑');
}





//查看详细
function view_url(id,action) {
	   var a = 'view';
	   if (action) {
        a = action;
       }
      showIframeModal(ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_ACTION + "="+a+"&id=" + id, '查看');
}




//弹出工作分类列表
function category_index(title,category_index,have_value) {
	var expand_category_index='';
	if(category_index){expand_category_index='&category_table='+category_index;}
	//if(category_index){have_value=1;}else{have_value=0;}
    showIframeModal(ROOT + "?" + VAR_MODULE + "=" + MODULE_NAME + "&" + VAR_CONTROLLER + "=" + CONTROLLER_NAME + "&"  + VAR_ACTION + "=category_index&_order=sort&_sort=asc"+expand_category_index+'&have_value='+have_value, title);
}




//排序
function turm_listRows(listRows) {
    location.href = CURRENT_URL + "&listRows=" + listRows;
}
