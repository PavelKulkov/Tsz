<script>     	
	$(document).ready(function(){
		
    	$('#id_template').change(function () {
			var id_template = $(this).val();
			if (id_template == '') {
				$('#sub_menu').html('<option>Нет</option>');
				$('#sub_menu').attr('disabled', true);
			
				return(false);
			}
    
			$('#sub_menu').attr('disabled', true);
	    	$('#sub_menu').html('<option>загрузка...</option>');
	    	$('#id_module').empty().append('<option selected="selected" value="">Выберите модуль</option>');   					
			$.post(
				'/scripts/ajax.php?module_name=leftMenu&operation=asModuleList',
				{id_template: id_template},
				function (result) {
					if (result == 'error') {
						alert('error');
						return(false);
					} else {
						var options = '';
						$menu = result.menu;
						for(i=0;i<$menu.length;i++){
							var option = $('#id_module  option[value="'+ $menu[i]['id_location'] + '"]');
							if(option.length==0){
								$("#id_module").append('<option value="' + $menu[i]['id_location'] + '">'+ $menu[i]['id_location'] + '</option>');	
							}					
     					}     
    				}
        		},
        		'json'       	
    		);   					
    	}); 
    	
    	
    	$('#id_module').change(function () {
			var id_location = $(this).val();   					
			$.post(
				'/scripts/ajax.php?module_name=leftMenu&operation=getMenuItemsByLocation',
				{id_location: id_location},
				function (result) {
					if (result == 'error') {
						alert('error');
						return(false);
					} else {
						$('#sub_menu').empty().append('<option selected="selected" value="">Выберите модуль</option>');   
						$('#sub_menu').attr('disabled', false);
				    	$('#sub_menu').html('<option value="">Отсутствует</option>');
				    		
						var options = '';
						items = result.items;
						for(i=0;i<items.length;i++){
							$("#sub_menu").append('<option value="' + items[i]['id'] + '">'+ items[i]['name'] + '</option>');						
     					}     
    				}
        		},
        		'json'       	
    		);   					
    	});  
    	
    	
    	$('#save_menu').click(function(){
	    	var template_id = $('#id_template').val()
    		if (template_id == '') {
	   			alert('Выберите шаблон!');
    			return false;
    		}
    		if ($('#id_module').val() == ''){
		   		alert('Введите название модуля!');
    			return false;
	    	}	    	
    		if ($('#name_menu').val() == ''){
		   		alert('Введите название!');
    			return false;
	    	}
   			else if ($('#module_url').val() == ''){
				alert('Введите url!');
 				return false;
		    }
    		else if ($('#weight').val() == ''){
    			alert('Введите Вес!');
    			return false;
    		}   				
    	});	
    });					
    	
</script>