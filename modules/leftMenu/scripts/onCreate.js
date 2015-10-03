<script>
$(document).ready(function(){

	$('#id_template').change(function () {
		var id_template = $(this).val();    	
		$.post(
			'/scripts/ajax.php?module_name=leftMenu&operation=getMenuByTpl',
			{id_template: id_template},
			function (result) {
				if (result == 'error') {
					alert('error');
					return(false);
				} else {
					var content = document.getElementById('menu_content'); 
					if(content!=null)content.innerHTML = '<form action="#" id="form_operation" method = "POST"><table  class="table table-bordered"><tr><td><input type="checkbox" onclick="toggleChecked(this.checked)" /></td><td>Название</td><td>Описание</td><td>Подменю</td><td>Вес</td><td>url</td><td>Шаблон</td></tr></table></form>';
					$('#id_module').empty().append('<option selected="selected" value="">Выберите модуль</option>');
					var sub_menu;
 					$(result.menu).each(function() {
	 					if ($(this).attr('sub_menu') == null) {
 							sub_menu= 'Нет';
 						} else {
	 						sub_menu= $(this).attr('sub_menu');
 						}
						$('table.table-bordered').append('<tr id="' + $(this).attr('id_location') + '"><td style="width:10px;"><input type="checkbox" name="check_value[]" class="checkbox" value="'+$(this).attr('id')+'" /></td></td><td>'+$(this).attr('name')+'</td><td>'+$(this).attr('descr')+
						'</td><td>'+sub_menu+'</td><td>'+$(this).attr('weight')+'</td><td>'+$(this).attr('url')+
						'</td><td>'+$(this).attr('template')+'</td></tr>');
						var option = $('#id_module  option[value="'+ $(this).attr('id_location') + '"]');
						if(option.length==0){
							$("#id_module").append('<option value="' + $(this).attr('id_location') + '">'+ $(this).attr('id_location') + '</option>');	
						}
            		});
    			}
        	},
        	'json'       	
    	);   					
	}); 
	
	
	$('#id_module').change(function () {
		var id_module = $(this).val(); 
		if(id_module!=""){
			$('table.table-bordered').find('tr').hide();
			$('table.table-bordered').find('tr[id="' + id_module + '"]').show();
		}else{
			$('table.table-bordered').find('tr').show();
		}
	});

	$('#link_delete').click(function(){
		$('form#form_operation').attr('action' ,'/modules/auth/leftMenu?operation=delete');
		$('form#form_operation').submit();
	});
    			
	$('#link_edit').click(function(){
		$('form#form_operation').attr('action' ,'/modules/auth/leftMenu?operation=edit');
	    $('form#form_operation').submit();
	});
});

function toggleChecked(status) {
	$(".checkbox").each( function() {
		$(this).attr("checked",status);
	})
}

</script>