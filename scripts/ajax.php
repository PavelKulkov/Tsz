<?php

require_once("../config.inc.php");
require_once("../config_system.inc.php");

include "../persist.php";
$request = new HttpRequest();
$response = new HttpResponse();

$authHome = new AuthHome(null);
$authHome->initGuestConnection($guestUser);

$modules_root = "../".$modules_root;
$template_dir = "../".$template_dir;
$db = $authHome->getCurrentDBConnection();
$moduleHome = new ModuleHome($modules_root,$db);
$domenHome = new DomenHome($request,$db);
$templateHome = new TemplateHome($db);
$log = new Logger($db);

//file_put_contents("/tmp/ref.dat",$_SERVER["HTTP_REFERER"]);

if ($request->hasValue('module_name')) {
	$module_name = $request->getValue('module_name');
	switch ($module_name) {
		case "leftMenu" : 
			$modules = $moduleHome->getModuleInCacheByName($module_name);
			$leftHome = new Menu($request,$db);
			if ($request->hasValue('operation')) {
				$controller_method = $request->getValue('operation');
				switch ($controller_method) {
					case "getMenuByTpl" : {
						$id_template = $_POST['id_template'];
			 			$text = $leftHome->$controller_method($id_template, $templateHome->getList());
						break;
					}
					case "asModuleList" : {
						$id_template = $_POST['id_template'];
						$text = $leftHome->$controller_method($id_template);
						break;
					}
					case "getMenuItemsByLocation" : {
						$id_location = $_POST['id_location'];
						$text = $leftHome->$controller_method($id_location);
						break;
					}
				};
			};
		 	
		 	if(isset($module['text'])) echo $module['text'];
		 	$module['text'] = $text;
			break;
		case "news" : 
			echo 'news';
			break;
		case "search" : 
			$modules = $moduleHome->getModuleInCacheByName($module_name);
			include_once($modules_root."search/class/Search.class.php");
			$search = new Search($request,$db);
			if ($request->hasValue('operation')) {
				$controller_method = $request->getValue('operation');
				switch ($controller_method) {
					case "getLocalData" : 
			 			$text = $search->$controller_method();
						break;
				};
			};
		break;
		case "pages" : 
			$modules = $moduleHome->getModuleInCacheByName($module_name);
			include_once($modules_root."pages/class/Pages.class.php");
			$pages = new Pages($request,$db);
			if ($request->hasValue('operation')) {
				$controller_method = $request->getValue('operation');
				switch ($controller_method) {
					case "serviceCategories" : 
						$db->changeDB("regportal_services");
			 			$text = $pages->$controller_method();
			 			$db->revertDB();
						break;
					case "metaDescription" :
						$db->changeDB("regportal_services");
						$text = $pages->$controller_method();
						$db->revertDB();
						break;
				};
			};
		break;
		case "templates" : {
			$list = $templateHome->getList();
		    $result = array('templates'=>$list);
		    echo json_encode($result);
			break;
		}
		case "webservice":{
		  unset($requestForm);
		  unset($list);
		  if(!isset($_SERVER['HTTP_REFERER'])){
             die('no source');
          }else{
            if(!strpos($_SERVER['HTTP_REFERER'],'/forms') &&
               !strpos($_SERVER['HTTP_REFERER'],'index.php')){
             		die('unknown source - '.$_SERVER['HTTP_REFERER']);
            }
          }
		  
		  switch ($_GET['name']) {
					case "listKindergarden" : {
			 			$requestForm = $modules_root.'forms/requests/web/kindergarden/listKinderGarden.php';
			                        include $modules_root."forms/src/web/kindergarden/dictionary.php";
						break;
					}
					case "listBenefits" : {
			 			$requestForm = $modules_root.'forms/requests/web/kindergarden/listBenefits.php';
			                        include $modules_root."forms/src/web/kindergarden/dictionary.php";					  
						break;						
					} 
					case "listNeedsAndConditions" :{
			 			$requestForm = $modules_root.'forms/requests/web/kindergarden/listNeedsAndConditions.php';
			                        include $modules_root."forms/src/web/kindergarden/dictionary.php";					  
						break;					
 
					}
					case "listKindergardens" :{
			 			$requestForm = $modules_root.'forms/requests/web/kindergarden/listKinderGardens.php';
			            include $modules_root."forms/src/web/kindergarden/kinderGardenCard.php";					  
						break;					
 
					}

					case "streetsKladr" :{
			 			include $modules_root."forms/src/web/kladr/streets.php";				  
						break;
					}
					
					case "getZagses" :{
			 			$requestForm = $modules_root.'forms/requests/web/zags/getZagses.php';
			            include $modules_root."forms/src/web/zags/getZagsesParse.php";					  
						break;
					}

					case "getMinMaxDaysZB" :{
			 			$requestForm = $modules_root.'forms/requests/web/zags/getMinMaxDaysZB.php';
			            include $modules_root."forms/src/web/zags/getMinMaxDaysZBParse.php";					  
						break;
					}
					case "getDaysZB" :{
			 			$requestForm = $modules_root.'forms/requests/web/zags/getDaysZB.php';
			            include $modules_root."forms/src/web/zags/getDaysZBParse.php";					  
						break;
					}
					case "getTimesZB" :{
			 			$requestForm = $modules_root.'forms/requests/web/zags/getTimesZB.php';
			            include $modules_root."forms/src/web/zags/getTimesZBParse.php";					  
						break;
					}
					case "getDaysQue" :{
						$requestForm = $modules_root.'forms/requests/web/zags/getDaysQue.php';
						include $modules_root."forms/src/web/zags/getDaysQueParse.php";
						break;
					}
					case "getTimesQue" :{
						$requestForm = $modules_root.'forms/requests/web/zags/getTimesQue.php';
						include $modules_root."forms/src/web/zags/getTimesQueParse.php";
						break;
					}
					case "getDaysQueOnSession" :{
						$requestForm = $modules_root.'forms/requests/web/zags/getDaysQueOnSession.php';
						include $modules_root."forms/src/web/zags/getDaysQueOnSessionParse.php";
						break;
					}
					case "getTimesQueOnSession" :{
						$requestForm = $modules_root.'forms/requests/web/zags/getTimesQueOnSession.php';
						include $modules_root."forms/src/web/zags/getTimesQueOnSessionParse.php";
						break;
					}
					case "getKladr" :{
			 			include $modules_root."forms/src/web/kladr/kladr.php";				  
						break;			
					}
					
					case "getAbuseData" :{
			 			include $modules_root."forms/src/web/abuse/abuse.php";				  
						break;			
					}
					
					case "getActiveServices" :{
			 			include $modules_root."forms/src/web/popularServices/popularServices.php";				  
						break;			
					}

					
					//справочники
					case "getDictionary" :{
						$requestForm = $modules_root."forms/src/web/dictionary/getDictionary.php";
						include $modules_root."forms/src/web/dictionary/getDictionaryParse.php";
						break;
					}
		  			case "getListRegions" : {
			 			$requestForm = $modules_root.'forms/src/web/doctors/requests/getListRegions.php';
			            include $modules_root."forms/src/web/doctors/responses/getListRegionsParse.php";
						break;
					}
		  			case "getListHospitals" : {
		  				$ocatoCode = $_GET['ocatoCode'];
			 			$requestForm = $modules_root.'forms/src/web/doctors/requests/getListHospitals.php';
			            include $modules_root."forms/src/web/doctors/responses/getListHospitalsParse.php";
						break;
					}
					case "getHospitalInfo" : {
						$hospital_id = $_GET['hospital_id'];
						$requestForm = $modules_root.'forms/src/web/doctors/requests/getHospitalInfo.php';
						include $modules_root."forms/src/web/doctors/responses/getHospitalInfoParse.php";
						break;
					}
					case "getSpecialtiesDirection" : {
						$subdivision_id = $_GET['subdivision_id'];
						$requestForm = $modules_root.'forms/src/web/doctors/requests/getSpecialtiesDirection.php';
						include $modules_root."forms/src/web/doctors/responses/getSpecialtiesDirectionParse.php";
						break;
					}
					case "getSpecialists" : {
						$hospitalId = $_GET['hospitalId'];
						$specialty = $_GET['specialty'];
						$requestForm = $modules_root.'forms/src/web/doctors/requests/getSpecialists.php';
						include $modules_root."forms/src/web/doctors/responses/getSpecialistsParse.php";
						break;
					}
					case "getTime" : {
						$hospitalId = $_GET['hospitalId'];
						$doctorId = $_GET['doctorId'];
						$startDate = $_GET['startDate'];
						$endtDate = $_GET['endDate'];
						
						$requestForm = $modules_root.'forms/src/web/doctors/requests/getTime.php';
						include $modules_root."forms/src/web/doctors/responses/getTimeParse.php";
						break;
					}
		  			case "getEnqueue" : {
		  				$doctorId = $_GET['doctorId'];
						$hospitalId = $_GET['hospitalId'];
						$sex = $_GET['sex'];
						$timeslot = $_GET['timeslot'];
						$firstName = $_GET['firstName'];
						$lastName = $_GET['lastName'];
						$patronymic = $_GET['patronymic'];
						$birthday = explode('-', $_GET['birthday']);
						$birthday = $birthday[2].'-'.$birthday[1].'-'.$birthday[0];
						
						$document = isset($_GET['document']) ? $_GET['document'] : false;
						$type= isset($_GET['type']) ? $_GET['type'] : false;
						if($type === false) {
							$series = isset($_GET['series']) ? $_GET['series'] : false;
						}
						
						$number = $_GET['number'];
						$hospitalIdSub = $_GET['hospitalIdSub'];
						
						$requestForm = $modules_root.'forms/src/web/doctors/requests/getEnqueue.php';
						include $modules_root."forms/src/web/doctors/responses/getEnqueueParse.php";
						break;
					}
					case "pacientRecorded" : {
						if (isset($_SESSION['login'])) {
							$date = new DateTime();
							include $modules_root."forms/class/Forms.class.php";
							$formsClass = new Forms($request, $db);
							$idRequest = $formsClass->saveRequestData($_GET['subservice_id'], $date);
							$data = md5(time());
							$id_out = $_GET['ticketId'].'&lpu='.$_GET['lpu'];
							$formsClass->saveResponse($data, $idRequest, 7, $id_out, $date, 'Вы успешно записаны на прием к врачу!', 'doctor');
						}
						break;
					}
					case "doctorRecordCancel" : {
							$ticket_id = $_GET['ticketId'];
							$hospital_id = $_GET['lpuId'];
							
							$requestForm = $modules_root.'forms/cancels/cancel_5800000010000026201.php';
							include $modules_root."forms/src/web/doctors/responses/doctorRecordCancelParse.php";
							break;
						
					}
					
					case "doctorSendNotice" : {
							include $modules_root."forms/src/web/doctors/sendNotice.php";
							break;
					}
					
					
					case "recordCanceled" : {
						$date = new DateTime();
						include $modules_root."forms/class/Forms.class.php";
						$formsClass = new Forms($request, $db);
						$idRequest = $_GET['idRequest'];
						$data = md5(time());
						$id_out = 0;
						$formsClass->saveResponse($data, $idRequest, 13, 0, $date, '<b style="color: red;">Запись отменена!</b>', 'doctor');
					}
					case "authorize" : {
						include("../auth/authorize.php");
						break;
					}
					case "uecAuthorize" : {
						include $modules_root.'forms/src/web/authorize/response/uecParse.php';
						break;
					}
					case "siuParse" : {
						$idRequest = $_GET['idRequest'];
						$requestForm = $modules_root.'account/socialParse/siuRequest.php';
						include $modules_root.'account/socialParse/siuParse.php';
						break;
					}
					case "payments" : {
						include $modules_root.'payments/src/index.inc.php';
						break;
					}
					case "drafts" : {
						include $modules_root.'drafts/src/index.inc.php';
						break;
					}
		  };
		  
		  if (isset($list)) {
		  $result = array('data'=>$list);
		   echo json_encode($result);
		  break;
		  }
		  
		  echo($data);
		  
		}
	};
}				

$db->disconnect();
