 $('#circle').bind('change',function(){
            var circle_name=$(this).val();
            $.post("{$Think.const.URL}Test/get_game",{'circle_name':circle_name},function(data){
                
                if(data.state==1){
                    var game=eval("("+data.info+")");
                    $("#game").children().remove();
                    $.each(game,function(k,v){
                      var option = document.createElement("option");
                      option.innerHTML=v;
                      $("#game").append(option);
                      // $("#game").innerHTML="<option>"+v+"</option>";
                    });
                     
                }else{
                     alert(data.info);
                }
            },'json');
          });