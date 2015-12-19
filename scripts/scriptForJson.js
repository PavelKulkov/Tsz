    //Получение данный о тсж из бд    
	function getJson(url){
        mas = [];
        i = 0;
        $(function() {
            $.ajax({
                dataType: 'json',
		        url: url,
                success: function(jsondata){	 	 
                    $.each(jsondata, function(key, val) {   
			            mas[i] = val,
						
			            i++
                    });  
                }
            });
        });
        return mas;
    }
    registeredHome = [];
    registeredHome = getJson('/modules/registry/view/json.php?action=registeredHome');