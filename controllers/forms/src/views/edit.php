<?php 
$form = $forms->edit();
$text = '<form id="update" action="/modules/auth/forms?operation=save" method="POST">';
$text .='Наименование: <br /><input type="text" name="name" id="name" value="'.$form['name'].'" style="width: 250px;" /><br />';
$text .= '<input type="hidden" name="id_form" value="'.$form['id'].'" />';
$text .= '<textarea id="content">'.$form['content'].'</textarea>';
$text .= '<input type="submit" value="Сохранить" id="submit_update" />
			</form>';

	$text .= "<script src=\"/elrte/js/jquery-1.6.1.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
			  <script src=\"/elrte/js/jquery-ui-1.8.13.custom.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
			  <link rel=\"stylesheet\" href=\"/elrte/css/smoothness/jquery-ui-1.8.13.custom.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
			  <!-- elRTE -->
			  	<script src=\"/elrte/js/elrte.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
				<link rel=\"stylesheet\" href=\"/elrte/css/elrte.min.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\">
			  <!-- elRTE translation messages -->
			  <script src=\"/elrte/js/i18n/elrte.ru.js\" type=\"text/javascript\" charset=\"utf-8\"></script>";
	
	$text .= "<script type=\"text/javascript\" charset=\"utf-8\">
				elRTE.prototype.options.panels.web2pyPanel = [
	       			'justifyleft', 'justifyright',
    	  			'justifycenter', 'justifyfull', 'insertorderedlist', 'insertunorderedlist',
      				'link', 'unlink', 'anchor','pagebreak', 'nbsp', 'horizontalrule', 'blockquote', 'div', 'stopfloat', 'css', 'nbsp','pagebreak'
  				];
  				elRTE.prototype.options.toolbars.web2pyToolbar = ['style', 'format', 'colors','web2pyPanel', 'tables', 'undoredo',  'indent', 'lists', 'direction'];
  				var opts = {
      				toolbar  : 'web2pyToolbar',
      				resizable : false
      				/* ...snip... */
 				}
 				var rte = jQuery('#content').elrte(opts);
 				
 				
 				$(document).ready(function(){	
 					$('#submit_update').click(function(){
    					if ($('#name').val() == ''){
		   					alert('Введите название формы!');
   							return false;
    					}	    	
		    		});
    			});  	 				
			</script>";
	