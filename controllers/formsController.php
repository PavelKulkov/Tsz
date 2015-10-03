<?php

require(CONTROLLERS_ROOT."forms/class/Attachment.class.php");
require(CONTROLLERS_ROOT."forms/class/SmevException.class.php");
require(CONTROLLERS_ROOT."../core/class/url/ServiceURL.class.php");
require(CONTROLLERS_ROOT."forms/class/SmevClient.class.php");

class formsController extends AppController  {
	
	private static $smevClient = null;
	public static $forms = null;
	
	function __construct() {
		parent::__construct();
				
	}

	function index() {
		global $smevService;
		global $siuRecipient;
		
		
		
		$digital_form = 2;
		$subservice_id = (isset($_GET['subservice_id']) ? $_GET['subservice_id']: (isset($_GET['id_subservice'])? $_GET['id_subservice']: null) );
		$admin = self::$authHome->isAdminMode();
		if ($admin) {
			self::$view->render('index');
		} else {
			if($subservice_id == null){
			  echo 'Не проставлен идентификатор услуги';	
			  return;  	
			}
			
			
			
			$subservice = NULL;
			self::$log->info("FORMS", $subservice_id);
			if (isset($subservice_id)){
				
				self::$db->changeDB("regportal_services");
				$subservice = self::$db->selectRow('SELECT * FROM subservice WHERE id = ?', $subservice_id);		
				if (empty($subservice['id'])){
					echo 'Услуги с id '.$subservice_id.' не найдено';	
					return;
				}
				$digital_form = $subservice['s_digital_form'];
				
			}
			if ($digital_form == 0){
				echo  'Услуга "'.$subservice['s_name'].'" не оказывается в электронном виде';
				return;
			}
			
		
			 
			if (self::$authHome->checkSession() != 1 && $digital_form != 1){
		      include ModuleHome::getDocumentRoot()."/auth/auth.php";
			}else{
			    //if(isset($_SESSION) && $_SESSION['type']=="0"){
				  //$text = 'услуга не может быть оказанна данному типу пользователя';
				  //$module['text']= $text;	
				  //return;
			    //}	
		
				$is_view = (count($_POST) == 0 ) ? true :  false;
				if ($is_view){
				//пользователь первый раз видит форму и должен ее заполнить
				
					if(isset($subservice['form_id'])){
				    	$form = self::$db->selectRow('SELECT id, name, content_'.SITE_THEME.' FROM forms WHERE id = ?', $subservice['form_id']);
				      
				      	$categories_recipient = self::$db->selectRow('SELECT * FROM service_categories WHERE id = ? ', $subservice['service_categories_id']);
				      	$menu_categories = self::$db->select('SELECT *, '.$subservice['service_categories_id'].' AS category_id FROM service_categories WHERE recipient_id = ? ', $categories_recipient['recipient_id']);
				      	
				      	$recipient = self::$db->selectCell('SELECT eng_socr FROM recipient WHERE id = ? ', $categories_recipient['recipient_id']);
				      
					  	
					  	self::$view->setVars(array('form' => $form,
					  								'categories_recipient' => $categories_recipient,
					  								'menu_categories' => $menu_categories,
					  								'recipient' => $recipient
					  						));
					  	self::$view->render('index');
				    }else{
					  include (CONTROLLERS_ROOT."forms/src/fill.php");
					  
					}
				} else {
					$attachment = new Attachment();
					$attachment->setMaxPacketSize($smevMaxPacketSize);
					$attachmentZip = NULL; 
					try{
					  $attachment->generateAttachment();
					}catch(SmevException $e){
					  echo $e->getMessage();
					  self::$log->warning("GenerateRequestError", $e->getMessage());
					  self::$db->revertDB();
					  return false;	
					}
					$date = new DateTime();
					$nowTimeWithFormat  = $date->format('Y-m-d');
					$nowTimeWithFormat .= "T".$date->format('H:i:s.')."228Z";
					$idRequest = self::$model->saveRequestData($subservice_id,$date);
					
					$query = "";
					
					
					ob_start();
					$regNumber = $subservice['registry_number'];
					$responseSmevValidation = true;
					unset($url);

					$requestForm = CONTROLLERS_ROOT.'forms/requests/query'.$regNumber.'.php';
					
					include($requestForm);
					$attachment->delete();
					unset($attachment);
					$query = ob_get_clean();
					
					//echo $query;			
					//$result = include(CONTROLLERS_ROOT."forms/test/callExt.php");
					self::$forms = new Forms(null, self::$db);
					formsController::callExt($query, $date, $idRequest, $subservice_url_id, $subservice_id, $soapAction, $responseSmevValidation);
					//echo $smevResult;	
					
					
					
					$answer = CONTROLLERS_ROOT.'forms/response/answer'.$regNumber.'.php';
					
					if(file_exists($answer)){
					  	include($answer);
					}else{
					  if($result && isset($_SESSION) && isset($_SESSION['login'])){
			            echo "<script type=\"text/javascript\">"."setTimeout(function () { window.location = '/account'; }, 3000);  </script>";
			          }
					}
					
					self::$smevClient->deleteTempFiles();
					
				}
			}
			
			
			self::$db->revertDB();
			
		}
	}
	
	
	static function callExt($query, $date, $idRequest = null, $subservice_url_id = null, $subservice_id = null, $soapAction, $responseSmevValidation) {
		self::$smevClient = new SmevClient(self::$db, self::$forms);
		global $smevService;
		global $siuRecipient;
		
		$serviceURL = new ServiceURL(self::$db);
		if (isset($subservice_url_id)) {
			$url = $serviceURL->getUrlById($subservice_url_id);
		} else {
			$url = $serviceURL->getUrlBySubserviceAndAction($subservice_id, $soapAction);
		}
		
		
		if (empty($url)) {
			throw new Exception("Невозможно отправить данные, адрес отправки URL недоступен.");
		}
		
		if (strlen($query) == 0) {
			throw new Exception("Запрос не сформирован.");
		}
		

		if(!isset($responseSmevValidation)) $responseSmevValidation = true;
		if(!isset($sign))$sign = true;
		$port = $smevService[1];
		$address = $smevService[0];
		
		$smevResult = "";
		$account_ref = '<br/><a class="btn btn-success" href="/account">В личный кабинет<i class="icon-chevron-right icon-white"></i></a>';
		
		try{
			self::$smevClient->open($address, $port);
			self::$smevClient->setValidatingSmevFormat($responseSmevValidation);
			self::$smevClient->setSoapAction($soapAction);
			self::$smevClient->saveQuery($query,$idRequest,$date);
			self::$smevClient->setReadTimeOut(1200);
			$resPath = self::$smevClient->remoteRun($url,$sign);
			$smevResult = 'Заявка успешно принята'.$account_ref;
			
		}catch(SmevException $e){
			if($e->isWarning()){
				self::$log->warning("FormDataError,".$subservice_id, $e->getMessage());
			}else{
				self::$log->error("ConnectionError,".$address.",".$subservice_id, $e->getMessage());
			}
			$smevResult = $e->getMessage();
			$smevResult .= $account_ref;
			self::$smevClient->close();
			return false;
		}
		self::$smevClient->close();
		
		
		
		unset($serviceURL);
		echo (self::$forms) ? $smevResult : ''; 

		return $resPath;
	}
	
	
	
	
}

/*
$text='';

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
				self::$model->save();
				$text = '<script type="text/javascript">
							window.location = "/modules/auth/forms"
						</script>';
				$module['text'] = $text;
				break;
			case "delete":
				self::$model->delete();
				$text = '<script type="text/javascript">
							window.location = "/modules/auth/forms"
						</script>';
				$module['text'] = $text;
				break;
		}
	$module['text']= $text;
	
} else {

	if(!isset($_GET['subservice_id'])){
	  $text = 'не проставлен идентификатор услуги';
	  $module['text']= $text;	
	  return;  	
	}
	
	$subservice_id = $_GET['subservice_id'];
	
	$subservice = NULL;
	$log->info("FORMS", $subservice_id);
	if (isset($subservice_id)){
		$db->changeDB("regportal_services");
		$subservice = $db->selectRow('SELECT * FROM subservice WHERE id = ?',$subservice_id);		
		if (!$subservice){
			$text = 'услуги с id '.$subservice_id.' не найдено';	
			$module['text']= $text;
			return;
		}
		$digital_form = $subservice['s_digital_form'];
		
	}
	if ($digital_form == 0){
		$text = 'услуга "'.$subservice['s_name'].'" не оказывается в электронном виде';
		$module['text']= $text;
		return;
	}
	

	 
	if ($authHome->checkSession()!=1 && $digital_form!=1){
      include ModuleHome::getDocumentRoot()."/auth/auth.php";
	}else{
	
	    //if(isset($_SESSION) && $_SESSION['type']=="0"){
		  //$text = 'услуга не может быть оказанна данному типу пользователя';
		  //$module['text']= $text;	
		  //return;
	    //}	

		$is_view = (count($_POST)==0 ) ? true :  false;
		if ($is_view){
		//пользователь первый раз видит форму и должен ее заполнить
		
			if(isset($subservice['form_id'])){
		    	$form = $db->selectRow('SELECT id, name, content_'.SITE_THEME.' FROM forms WHERE id = ?',$subservice['form_id']);
		      
		      	$categories_recipient = $db->selectRow('SELECT * FROM service_categories WHERE id = ? ', $subservice['service_categories_id']);
		      	$menu_categories = $db->select('SELECT *, '.$subservice['service_categories_id'].' AS category_id FROM service_categories WHERE recipient_id = ? ', $categories_recipient['recipient_id']);
		      	
		      	$recipient = $db->selectCell('SELECT eng_socr FROM recipient WHERE id = ? ', $categories_recipient['recipient_id']);
		      
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
			$idRequest = self::$model->saveRequestData($subservice_id,$date);
			
			$query = "";
			ob_start();
			$regNumber = $subservice['registry_number'];
			$responseSmevValidation = true;
			unset($url);
			$requestForm = $modules_root.'forms/requests/query'.$regNumber.'.php';
			
			include($requestForm);
			$attachment->delete();
			unset($attachment);
			$query = ob_get_clean();
			//echo $query;			
			$result = include($modules_root."forms/test/callExt.php");
			
			echo $smevResult;	
			
			
			
			$answer = $modules_root.'forms/response/answer'.$regNumber.'.php';
			
			if(file_exists($answer)){
			  	include($answer);
			}else{
			  if($result && isset($_SESSION) && isset($_SESSION['login'])){
	            echo "<script type=\"text/javascript\">"."setTimeout(function () { window.location = '/account'; }, 3000);  </script>";
	          }
			}
			$smevClient->deleteTempFiles();
		}
	}
	$module['text']= $text;
	$db->revertDB();

}
*/
