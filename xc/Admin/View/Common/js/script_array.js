
function in_array(search,array){
    for(var i in array){
        if(array[i]==search){
            return true;
        }
    }
    return false;
}


function array_remove(temp,obj){ 
   var del_i='none';
   for(i=0;i<obj.length;i++){
     if(temp==obj[i]){
		del_i=i; 
	 }
   }
   if(del_i=='none'){
	   return obj;
	 }else{
	   obj.splice(del_i,1);
	   return obj;
   }
} 


//alert(obj)
function printObject(obj){ 
//obj = {"cid":"C0","ctext":"区县"}; 
var temp = ""; 
for(var i in obj){//用javascript的for/in循环遍历对象的属性 
temp += i+":"+obj[i]+"\n"; 
} 
alert(temp);//结果：cid:C0 \n ctext:区县 
} 

