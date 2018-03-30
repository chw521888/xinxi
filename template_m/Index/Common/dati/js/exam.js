
	var app = angular.module('exam', []);

	app.factory('question_data', function($http,$q,$timeout) {
    return {

        //获取答题数据
        getData: function(url) {
            //var url = 'question.json';
            return $http.get(url);    
        },
        //保存答题结果
        save_data:function(field_1,field_2,field_3,field_4){
            var url="index.php?m=Index&c=Dati&a=insert";
            var promise = $http({
                method:'POST',
                 url:url,
                 data:"file1="+field_1+"&file2="+field_2+"&file3="+field_3+"&file4="+field_4+"&type=1",
                 headers: {'Content-Type':'application/x-www-form-urlencoded'}  
            });
            promise.then(function(resp){}, function(resp){})
        },

        select_sex_question:function(data_list,sex){
            for(dl in data_list){
                //console.log(typeof(data_list[dl]['question_'+sex]));
                if(typeof(data_list[dl]['question_'+sex])!="undefined"){
                    data_list[dl]['question']=data_list[dl]['question_'+sex];
                }
            }
            return data_list;
        },

        select_sex_question_category:function(data_list,sex){
            for(dl in data_list){
                //console.log(typeof(data_list[dl]['question_'+sex]));
                if(typeof(data_list['content_1_'+sex])!="undefined"){
                    data_list['content_1']=data_list['content_1_'+sex];
                }
            }
            return data_list;
        },


        //答题处理
        select_answer:function(data_list,answer_data){
        	for(var dl in data_list){
        		for(var dla in data_list[dl]['answer']){
        			if(dla==answer_data[dl]){
        				data_list[dl]['answer'][dla]['s_class']="active";
        			}else{
        				data_list[dl]['answer'][dla]['s_class']="";
        			}
        		}
        	}
        	return data_list;
        },

        //提交测试
        calculate_score:function(data_list,answer_data){
            var return_answer_category_score={};
            var answer_category_score=[];
            var now_answer_category_score =0;
            var answer_dl                 =0;
            for(var dl in data_list){
                    if(typeof(answer_category_score[data_list[dl]['question_category']])!="NaN" && typeof(answer_category_score[data_list[dl]['question_category']])!="undefined"){
                        now_answer_category_score=answer_category_score[data_list[dl]['question_category']];
                    }else{
                        now_answer_category_score =0;
                    }

                    if(typeof(answer_data[dl])!="NaN" && typeof(answer_data[dl])!="undefined"){
                        answer_dl=answer_data[dl];
                        //console.log(answer_dl);
                        now_answer_category_score=parseInt(now_answer_category_score)+parseInt(data_list[dl]['answer'][answer_dl]['score']);    
                    }else{
                        answer_dl=0;
                    }
                    
                    answer_category_score[data_list[dl]['question_category']]=now_answer_category_score;
            }
            
            return_answer_category_score['main']=answer_category_score[1];
            return_answer_category_score['other']=[];
            //console.log(return_answer_category_score);
            answer_category_score.splice(0,1,-1);
            answer_category_score.splice(1,1,-1);
            for(var i=0;i<8;i++){
                var new_array=[];
                var mix_value=0;
                var mix_key  =0;
                for(var racsd in answer_category_score){
                    if(answer_category_score[racsd]>=mix_value){
                        mix_value =answer_category_score[racsd];
                        mix_key   =racsd;
                    }
                }
                var new_array=[mix_key,mix_value];
                return_answer_category_score['other'].push(new_array);
                answer_category_score.splice(mix_key,1,-1);
            }


            //if(return_answer_category_score['main'])


            return return_answer_category_score;
        },



        show_res:function(answer_category_score,question_category_data){
            var health_category_data={'main':[],'other':[]};
            var health_data=[];
            if(answer_category_score['main']<8 && answer_category_score['other'][0][1]==0){alert('请仔细读题并重新作答');location.reload();return false;}

            //定义其他体质标准分
            var standard_other_score=1;
            if(answer_category_score['main']>16){standard_other_score=6;}
            
            //如果其他体质最大的不大于标准分为平和
            if(answer_category_score['other'][0][1]<standard_other_score){
                health_category_data['main'].push([1,question_category_data[1]['name'],question_category_data[1]['content_1'],question_category_data[1]['content_2'],question_category_data[1]['content_3'],question_category_data[1]['content_4'],question_category_data[1]['content_5']]);
                health_data.push({'value':answer_category_score['main'],'name':question_category_data[1]['name']});
            }else{
                //先获取最高分及位置
                var highest_postion=answer_category_score['other'][0][0];
                var highest_score=answer_category_score['other'][0][1];
                health_category_data['main'].push([highest_postion,question_category_data[highest_postion]['name']]);
                health_data.push({'value':highest_score,'name':question_category_data[highest_postion]['name']});
                var num=1;
                for(acs in answer_category_score['other']){
                    if(acs>0){
                        var for_postion=answer_category_score['other'][acs][0];
                        var for_score=answer_category_score['other'][acs][1];
                        var for_health_category_data=[for_postion,question_category_data[for_postion]['name'],question_category_data[for_postion]['content_1'],question_category_data[for_postion]['content_2'],question_category_data[for_postion]['content_3'],question_category_data[for_postion]['content_4'],question_category_data[for_postion]['content_5']];
    
                        if(for_score>standard_other_score){
                            if(for_score>=highest_score){
                                health_category_data['main'].push(for_health_category_data);
                            }else{
                                health_category_data['other'].push(for_health_category_data);
                            }
                            health_data.push({'value':for_score,'name':question_category_data[for_postion]['name']});
                            num++;
                        }
                        if(num>3){break;}
                    }
                }
            }
            var return_data={'health_category_data':health_category_data,'health_data':health_data};
            //console.log(health_data);
            return   return_data; 
        },

        

        view_res:function(exam_res_data){
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('s_datagram_bx'));
            // 指定图表的配置项和数据
            option = {series : [{name: '访问来源',type: 'pie',radius: '55%',data:exam_res_data.health_data}]};
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
            $timeout(function(){
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
        },
        show_question_category:function(question_category_data,health_category_data){
            var category_id =health_category_data["health_category_data"]["main"][0][0];
            var jing_question_category={};
            var delay       = $q.defer();  
            //var promise     = delay.promise;

            //var promise = this.get_question_category_data();
             this.getData('template_m/Index/Common/question_category.json').then(function(resp) {
                for(var key in resp.data) {
                    if (resp.data[key].value == category_id) {
                        delay.resolve(resp.data[key]);
                    }
                }

            });
            return delay.promise;
        }

    }
	});


	
	








	app.controller('myCtrl', function($scope,question_data,$timeout){
        

        if(history_show_res==true){
            $scope.begin_exam=false;
            $scope.exam_res_data=history_exam_res_data;
            question_data.view_res(history_exam_res_data);

            var promise=question_data.show_question_category($scope.question_category_data,history_exam_res_data);
            promise.then(function(data) {  
               $scope.jing_question_category = data;
               $scope.jing_question_category = question_data.select_sex_question_category($scope.jing_question_category,history_answer_data[0]); 
            });
            return false;
        }

        $scope.begin_exam=true;
	    //加载题目列表
	    question_data.getData('template_m/Index/Common/question.json').then(function(resp) {
        	$scope.data=resp.data;
    	});
        //加载题目分类
        question_data.getData('template_m/Index/Common/question_category.json').then(function(resp) {
            $scope.question_category_data=resp.data;
        });

        


	    //设置空答案数组
	    $scope.answer_data=[];

	    $scope.answer_click=function(q_index,index){

            if(q_index==0){
               $scope.data=question_data.select_sex_question($scope.data,index);
            }

        	$scope.answer_data[q_index]=index;
        	$scope.data=question_data.select_answer($scope.data,$scope.answer_data);
        	var answer_data_length=$scope.answer_data.length;
        	//console.log();

        	if(jQuery('.question').eq(answer_data_length).length>0){
        		$('body,html').animate({scrollTop:(jQuery('.question').eq(answer_data_length).offset().top-50)},500);
        	}
        };




        //点击提交开始计算分数
        $scope.calculate_score=function(){
             //console.log($scope.data.length+'|'+$scope.answer_data.length);
             //if($scope.answer_data.length<$scope.data.length){alert('请先答题完再提交!');return false;}

             $scope.answer_category_score=question_data.calculate_score($scope.data,$scope.answer_data);
             $scope.begin_exam=false;

           
            ///console.log($scope.answer_category_score);
            ///根据结果判断数据及体质
            ///$scope.answer_category_score={'main':22,'other':[[2,24],[8,24],[6,18],[4,18],[3,17],[5,8],[7,6],[9,2]]};
            $scope.exam_res_data=question_data.show_res($scope.answer_category_score, $scope.question_category_data);
            console.log($scope.exam_res_data);
            question_data.view_res($scope.exam_res_data);


            question_data.save_data(JSON.stringify($scope.answer_data),JSON.stringify($scope.answer_category_score),JSON.stringify($scope.exam_res_data.health_category_data),JSON.stringify($scope.exam_res_data));
            $('body,html').animate({scrollTop:(0)},500);

            var promise=question_data.show_question_category($scope.question_category_data,$scope.exam_res_data);
            promise.then(function(data) { 
               $scope.jing_question_category = data;
               $scope.jing_question_category = question_data.select_sex_question_category($scope.jing_question_category,$scope.answer_data[0]);   
            });
        }

        //返回按钮定义
        $scope.back_exam=function(){
             $scope.begin_exam=true;
        }

        
        
	});
	
	