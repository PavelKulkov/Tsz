<?php
require_once($modules_root."general/class/Paginator.class.php");

$limit = 15;
if(!isset($paginatorObj)) $paginatorObj = new Paginator($request, $db, "forms", $limit, $authHome->isAdminMode());
$count = $paginatorObj->getCountGlobal("");
$paginatorObj->setStyle(SITE_THEME);
$paginatorObj->setOrder(false);
$paginator = $paginatorObj->getPaginator($request, "forms", $count);



$form_list = $paginatorObj->getListGlobal($paginator['index'], "name", "");	

if (!empty($form_list)) {

	$text .= '<form action="#" id="form_operation" method = "POST">';
	foreach ($form_list as $form) {
		$text .= '<input type="checkbox" name="check_value[]" class="checkbox" value="'.$form['id'].'" />&nbsp  &nbsp '.$form['name'].'<br />';

	}
	$text .= '</form>';
	$text .= '<script type="text/javascript">
	$(document).ready(function(){
		$("#link_edit").click(function(){
			$("form#form_operation").attr("action" ,"/modules/auth/forms?operation=edit");
		    $("form#form_operation").submit();
		    
		});
		
		
		$("#link_delete").click(function(){
			$("form#form_operation").attr("action" ,"/modules/auth/forms?operation=delete");
			$("form#form_operation").submit();
		});
	});
	
	</script>';
	
	
	$text .= $paginator['text'];
}

	