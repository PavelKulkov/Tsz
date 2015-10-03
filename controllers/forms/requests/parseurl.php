<?php
require_once("../../../config.inc.php");
require_once("../../../config_system.inc.php");

/*
AppController::getInstance($guestUser);
*/


$request = new HttpRequest(); 				// в main пересоздал
$response = new HttpResponse(); 			// в main пересоздал

$connectTime = microtime(true);				 // main construct
$authHome = new AuthHome(NULL); 			// в main пересоздал
$authHome->initGuestConnection($guestUser); // в main пересоздал
$db = $authHome->getCurrentDBConnection(); 	// в main пересоздал
$log = new Logger($db);						// в main пересоздал
$dumper = new Dumper($db);					// в main пересоздал


/*if($dumper->checkClientOnCaptcha()){
	header('Refresh: 3; URL=/captcha.php');
	exit();
}*/

$dumper->dumpClientConnection();			// в main пересоздал

$moduleHome = new ModuleHome($modules_root,$db);	// в main пересоздал
$domenHome = new DomenHome($request,$db);			// в main пересоздал
$templateHome = new TemplateHome($db);				// в main пересоздал





$skip = array('.', '..');

$requests = array();
$files = scandir('./');
$i = 0;

foreach($files as $file) {
	if(!in_array($file, $skip) && strpos($file, 'query') !== false ) {
		//echo $file.'<br />';
		unset($url);
		unset($soapAction);
		
		ob_start();
		include $scan_dir.$file;
		ob_get_clean();
		
		$data = array();
		if (isset($url)) {
			$data['registry_number'] = substr($file, 5, strlen($file) - 9 );	
			$data['soapAction'] = $soapAction;
			
			$data['test_url'] = $url;
			if ( strpos($url, '8886') !== false) {
				$prod_url = str_replace("8886", "8889", $url);
				$data['prod_url'] = $prod_url;
			} else {
				$data['prod_url'] = '';
			}

			$requests[]= $data;
			
		} else {
			$content = file_get_contents($file);
			
			if ( ($str_start = strpos($content, 'require')) !== false) {
				$i++;
				
				$str_end = strpos($content, ';', $str_start);
				//echo $str_start.' - '.$str_end.'<br />';
				$str = substr($content, $str_start, $str_end - $str_start + 1);
				$str = str_replace("\"", "'", $str);
				
				echo $str.'<br />';
				ob_start();
				eval($str.';');
				ob_get_clean();
				
				$data['registry_number'] = substr($file, 5, strlen($file) - 9 );
				$data['soapAction'] = $soapAction;
				$data['test_url'] = $url;
				
				if ( strpos($url, '8886') !== false) {
					$prod_url = str_replace("8886", "8889", $url);
					$data['prod_url'] = $prod_url;
				} else {
					$data['prod_url'] = '';
				}
				
				$requests[]= $data;
			} else {
				echo $file.'<br />';
			}
		}
	}
	
	
}


$db->changeDB('regportal_services');
$i = 0;
foreach($requests as $request) {
	$sql = "SELECT id FROM `subservice` WHERE `registry_number` = ?";
	$subservice_id = $db->selectCell($sql, $request['registry_number']);
	$request['subservice_id'] = $subservice_id;
	$requests[$i]['subservice_id'] = $subservice_id; 
	
	$sql = "INSERT INTO `service_url` (`subservice_id`,`test_url`, `prod_url`, `soapAction`) VALUES ( ?, ?, ?, ? )";
	
	$db->insert($sql, $request['subservice_id'], $request['test_url'], $request['prod_url'], $request['soapAction']);
	$i++;
}



$db->revertDB();
//print_r($requests);
//echo count($requests);
