<?php 
$text = '<form id="add" action="/modules/auth/forms?operation=save" method="POST">';
$text .='Наименование: <br /><input type="text" id="name" name="name" style="width: 250px;" /><br />';
$text .= '<textarea id="content" name="content"></textarea>';
$text .= '<input type="submit" value="Сохранить" id="save_form" />
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
					$('#save_form').click(function(){
	    				if ($('#name').val() == ''){
			   				alert('Введите название формы!');
    						return false;
	    				}	    	
    				});
    			});
			  </script>";