<?php
	define('APP_ROOT_PATH', dirname(__FILE__).'/../');
	require_once(APP_ROOT_PATH."config.inc.php");
	require_once(APP_ROOT_PATH."config_system.inc.php");
	require_once(APP_ROOT_PATH."/scripts/mail.php");
	$modules_root = APP_ROOT_PATH.$modules_root;
	$template_dir = APP_ROOT_PATH.$template_dir;
	
	// номера subservice_id  услуг, которые не попадают в СИУ и будут отфильтрованы в запросе
	$filter_services = '1350, 51, 1310, 1249, 1289, 1335, 401, 1827, 3405, 69, 72, 71';
	
	if (!isset($argv)){
		die('Run in shell mode and get login and password params');
	}
	if (!isset($argv[1])){
		die('missing login param');
	}
	if (!isset($argv[2])){
		die('missing password');
	}
	if (!isset($argv[3])){
		die('missing phone');
	}	
	if (!isset($argv[4])){
		$tm = "3 HOUR";
	}else 
		$tm = $argv[4];

	$_SERVER['REQUEST_URI']="/";
	
	DBRegInfo::initParams($guestUser[0],
	$argv[1],
	$argv[2],
	"regportal_share");
		
	$db = new DB();
	$regInfo = DBRegInfo::getInstance();
	$db->connect($regInfo);
	$date = new DateTime();	

	$log = new Logger($db);
	
	$query = "SELECT id, (DATE_SUB(NOW(),INTERVAL ".$tm.")) as dt FROM regportal_share.request WHERE `time` >= DATE_SUB(NOW(),INTERVAL ".$tm.") AND id_subservice NOT IN (".$filter_services.") ";
	$requests = $db->select($query);
	if (count($requests) == 0){
		$sms_text = "За последние ".$tm." запросов не было";
		echo $sms_text."\r\n";
		return;
	}else{ 
		$sms_text = "Количество запросов с ".$requests[0]["dt"]." = ".count($requests).".";
		$sms_text .= " Номер первого = ".$requests[0]["id"];
		
		
		
		try {
		
	    $smtpClient = new SMTPClient();
	    $smtpClient->setServer('mail.oep-penza.ru', 25, false);
	    $smtpClient->setSender("portal", 
	    			    "portal@oep-penza.ru",
	                            "5gElMSL");
	    $smtpClient->setMail("alexey.oep@gmail.com,crja72@gmail.com,r.bakhitov@oep-penza.ru",
	                         "запросы",
	                          $sms_text,"text/plain","UTF8");
	    $smtpClient->sendMail();
		
		} catch (Exception $e) {
			echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
		}
		
		
		$phone = $argv[3];
		$requestForm = $modules_root."forms/src/web/authorize/requests/sms.php";
		ob_start();
		include($requestForm);
		$query = ob_get_clean();
		try {	
				$responseSmevValidation = false;
				include($modules_root."forms/test/callExt.php");
				$data = file_get_contents($smevClient->getAnswerFile());
				$data = str_replace("oep:","",$data);
				$handle = fopen($smevClient->getAnswerFile(),"w");
				fwrite($handle,$data);
				fclose($handle);
				$xml = simplexml_load_file($smevClient->getAnswerFile());
				$status_code = $xml->xpath("//status_code");
				if (isset($status_code)&&count($status_code) > 0){
					$status_code = $status_code[0];
					$meta = "SMSResponse, report";
					$log->info($meta, "code=".$status_code);
				}else{
					die("Не верный ответ от сервиса. Обратитесь в службу поддержки!");
				}
				
				echo "OK. ".$sms_text."\r\n";
		} catch (Exception $e) {
			echo $e->getTraceAsString();
		}
	}
		
	

?>