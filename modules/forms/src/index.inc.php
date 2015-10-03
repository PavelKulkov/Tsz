<?php
require_once($modules_root."forms/class/Forms.class.php");
include($modules_root."forms/scripts/printDocument.js");
if(!isset($forms)) $forms = new Forms($request, $db);
$text='';
$digital_form=2;
$subservice_id = NULL;
$admin = $authHome->isAdminMode();
if ($admin) {

	$db->changeDB("regportal_services");
	
	$text = '';
	$text .= '<a href="/modules/auth/forms?operation=new" ><img src="/templates/images/icon-32-new.png" /></a> &nbsp &nbsp
			  <a href="#" id="link_edit"><img src="/templates/images/icon-32-edit.png" /></a> &nbsp &nbsp
			  <a href="#" id="link_delete" ><img src="/templates/images/icon-32-trash.png" /></a> &nbsp &nbsp <br /><br />';
		
	$operation = NULL;
		if($request->hasValue('operation')){
			$operation = $request->getValue('operation');
		}else{
			$operation = "show";
		}
		
		switch ($operation) {
			case "show" :
				include($modules_root."forms/src/views/show.php");
				break;
			case "new" :
				include($modules_root."forms/src/views/new.php");
				break;				
			case "edit":
				include($modules_root."forms/src/views/edit.php");
				break;
			case "save":
				$forms->save();
				$text = '<script type="text/javascript">
							window.location = "/modules/auth/forms"
						</script>';
				$module['text'] = $text;
				break;
			case "delete":
				$forms->delete();
				$text = '<script type="text/javascript">
							window.location = "/modules/auth/forms"
						</script>';
				$module['text'] = $text;
				break;
		}
	$module['text']= $text;
	
} else {

	if(!isset($_GET['subservice_id'])){
	  $text = 'Не проставлен идентификатор услуги';
	  $module['text']= $text;	
	  return;  	
	}
	
	$subservice_id = $_GET['subservice_id'];

	$subservice = NULL;
	$log->info("FORMS", $subservice_id);
	if (isset($subservice_id)){
		$db->changeDB("regportal_services");
		$subservice = $db->selectRow('SELECT * FROM subservice WHERE id = ?',$subservice_id);		
		if (empty($subservice['id'])){
			$text = 'Услуги с id '.$subservice_id.' не найдено';	
			$module['text']= $text;
			return;
		}
		$digital_form = $subservice['s_digital_form'];
		
	}
	if ($digital_form == 0){
		$text = 'Услуга "'.$subservice['s_name'].'" не оказывается в электронном виде';
		$module['text']= $text;
		return;
	}
	

	 
	if ($authHome->checkSession()!=1 && $digital_form!=1){
      include ModuleHome::getDocumentRoot()."/auth/auth.php";
	}else{
	    if(isset($_SESSION)){
// 	    	if ($_SESSION['type']=="0") {
// 	    		$text = 'услуга не может быть оказанна данному типу пользователя';
// 	    		$module['text']= $text;
// 	    		return;
// 	    	}
	    	if ($_SESSION['type']=="3" && $digital_form != 3 && $digital_form != 1) {
	    		$text = 'Эта услуга не может быть оказана данному типу пользователя. Для получения доступа ко всем электронным услугам - 
	    				необходимо авторизироваться через ЕСИА или цифровую подпись.';
	    		$module['text']= $text;
	    		return;
	    	}
	    }	

		$is_view = (count($_POST)==0 ) ? true :  false;
		if ($is_view){
		//пользователь первый раз видит форму и должен ее заполнить
			if(isset($subservice['form_id'])){
				$contentType = SITE_THEME;
// 		    	$form = $db->selectRow('SELECT id, name, content_'.$contentType.' FROM forms WHERE id =  ',$subservice['form_id']);
				
				$form_type_arr = '';
				$form_type_arr .= ($digital_form != 3) ? ', 2' : '';
				
				
				
			
				
				$query = 'SELECT f.id, f.generated, f.`name`, f.content_'.$contentType.', sub.s_digital_form
							FROM forms f
							LEFT JOIN subservice sub
							ON f.id = sub.form_id
							WHERE f.id = ? AND sub.id = ? AND sub.s_digital_form IN (1, 3'.$form_type_arr.')';
							
	
				/*
				$query = 'SELECT f.id, f.`name`, f.generate, f.content_'.$contentType.', sub.s_digital_form
							FROM forms_generate f
							LEFT JOIN subservice sub
							ON f.id = sub.form_id
							WHERE f.id = ? AND sub.id = ? AND sub.s_digital_form IN (1, 3'.$form_type_arr.')';

				*/	
				
				$form = $db->selectRow($query, $subservice['form_id'], $subservice['id']);
				
		      	$categories_recipient = $db->selectRow('SELECT * FROM service_categories WHERE id = ? ', $subservice['service_categories_id']);
		      	$menu_categories = $db->select('SELECT *, '.$subservice['service_categories_id'].' AS category_id FROM service_categories WHERE recipient_id = ? ', $categories_recipient['recipient_id']);
		      	
		      	$recipient = $db->selectCell('SELECT eng_socr FROM recipient WHERE id = ? ', $categories_recipient['recipient_id']);
		      	
		      	if ($form['generated'] == 1 || $form['generated'] == 3) {
		      		$is_form_generate = true;
		      		include ($modules_root."/generate/class/create.class.php");
		      	} 
		      	
				include ($modules_root.'forms/view/form_'.SITE_THEME.'.php');
		      			      
		    }else{
			  include ($modules_root."forms/src/fill.php");
			}
		}else{
		    require_once($modules_root."forms/class/Attachment.class.php");
			require_once($modules_root."forms/class/SmevException.class.php");
			$attachment = new Attachment();
			$attachment->setMaxPacketSize($smevMaxPacketSize);
			$attachmentZip = NULL; 
			try{
			  $attachment->generateAttachment();
			}catch(SmevException $e){
			  echo $e->getMessage();
			  $log->warning("GenerateRequestError", $e->getMessage());
			  $db->revertDB();
			  return false;	
			}
			
			$date = new DateTime();
			$nowTimeWithFormat  = $date->format('Y-m-d');
			$nowTimeWithFormat .= "T".$date->format('H:i:s.')."228Z";
			if (isset($_GET["request_id"])&& ($_GET["request_id"] != "")){
				$idRequest = $_GET["request_id"];
			}else{
				$idRequest = $forms->saveRequestData($subservice_id,$date);
			}
			
			$query = "";
			ob_start();
			$regNumber = $subservice['registry_number'];
			
			$responseSmevValidation = true;
			unset($url);
			
			$requestForm = $modules_root.'forms/requests/query'.$regNumber.'.php';
			
			$is_form_generate = $db->selectCell('SELECT `generated` FROM `forms` WHERE id = ?', $subservice['form_id']);
			if ($is_form_generate == 1 || $is_form_generate == 3) {
				if(!file_exists($requestForm)){					
					$requestForm = $modules_root.'generate/src/xml.php';
				}
			}elseif($is_form_generate == 2){
				$requestForm = $modules_root.'forms/requests/queryESRN.php';
			}
				
			include($requestForm);
			$attachment->delete();
			unset($attachment);
			$query = ob_get_clean();

			$result = include($modules_root."forms/test/callExt.php");
			
			echo $smevResult;	
			
			//echo '<br />'.$query;
			$answer = $modules_root.'forms/response/answer'.$regNumber.'.php';
			if(!file_exists($answer) && $is_form_generate == 2){
					$answer = $modules_root.'forms/response/answerESRN.php';
			}
			
			if(file_exists($answer)){
			  	include($answer);
			}else{
			  if($result && isset($_SESSION) && isset($_SESSION['login'])){
				include($modules_root."forms/response/answerSiuIdRequest.php");
// 	            echo "<script type=\"text/javascript\">"."setTimeout(function () { window.location = '/account'; }, 3000);  </script>";
	          }
			}
			$smevClient->deleteTempFiles();
		}
	}
	$module['text']= $text;
	$db->revertDB();

}
?>
