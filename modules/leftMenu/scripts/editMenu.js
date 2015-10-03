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
				
			$.post(
				'/scripts/ajax.php?module_name=leftMenu&operation=getMenuByTpl',
				{id_template: id_template},
				function (result) {
					if (result == 'error') {
						alert('error');
						return(false);
					} else {
						var options = '';
						$(result.menu).each(function() {
							options += '<option value=\"' + $(this).attr('id') + '\">' + $(this).attr('name') + '</option>';
   	   					});
                
						$('#sub_menu').html('<option value=\"0\">Нет</option>'+options);
       					$('#sub_menu').attr('disabled', false);        
            		}
    			},
        		'json'       	
    		);   					
    	}); 
    	
    	$('#submit_update').click(function(){
    		var template_id = $('#id_template').val()
    		if (template_id == '') {
    			alert('Выберите шаблон!');
    			return false;
    		}
    		if (template_id == '') {
    			alert('Выберите шаблон!');
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