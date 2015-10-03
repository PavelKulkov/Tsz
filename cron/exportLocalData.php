<?php

	define('APP_ROOT_PATH', dirname(__FILE__).'/../');
	require_once("c:/WebServers/home/dev-1.oep-penza/www/config.inc.php");
	require_once("c:/WebServers/home/dev-1.oep-penza/www/config_system.inc.php");
	
	$request = new HttpRequest();
$response = new HttpResponse();

$connectTime = microtime(true);
$authHome = new AuthHome(NULL);
$authHome->initGuestConnection($guestUser);
$db = $authHome->getCurrentDBConnection();
$log = new Logger($db);
$dumper = new Dumper($db);
if($dumper->checkClientOnCaptcha()){
	header('Refresh: 3; URL=/captcha.php');
	exit();
}


$moduleHome = new ModuleHome($modules_root,$db);
$domenHome = new DomenHome($request,$db);



$log->info("Disconnect,".$_SERVER['REMOTE_ADDR'], (microtime(true) - $connectTime));
/*	 
	if (!isset($argv)){
		die('Run in shell mode and get login and password params');
	}
	if (!isset($argv[1])){
		die('missing login param');
	}
	 
	$_SERVER['REQUEST_URI']="/";
	
	DBRegInfo::initParams($guestUser[0],
			$argv[1],
			$argv[2],
			"regportal_services");

	*/	
  	$db = new DB();
  	$regInfo = DBRegInfo::getInstance();
  	$db->connect($regInfo);
	$db->changeDB(regportal_services);
  	$organizations = $db->select("SELECT c.id, c.c_name, c.c_head, c.c_web_site, c.c_contacts, t.name FROM company c LEFT JOIN type_company t ON c.company_type_id = t.id");
  	$organization = array();
  	$i = 0;

  	foreach ($organizations as $item) {
  		$organization[$i]['type'] = 'organisation';
  		$organization[$i]['key_words'] = $item['c_name'].$item['c_head'];
  		$organization[$i]['meta'] = '<a href="organisations?id_organisation='.$item['id'].'">'.$item['c_name'].'</a><br />Руководитель: '.$item['c_head'].'<br /><a href="http://'.$item['c_web_site'].'" target="_blank">Официальный сайт</a><br />Контактная информация: '.$item['c_contacts'];
  		$organization[$i]['description'] = $item['name'];
  		$organization[$i]['url'] = 'organisations?id_organisation='.$item['id'];
  		$i++;	
  	}
  	  	
  	$services = $db->select("SELECT s.`id`, s.s_name,  ts.`name` AS service_name
							FROM service s 
							LEFT JOIN type_service ts ON s.`type_serviсe_id` = ts.`id` ");
  	
  	$subservices = $db->select("SELECT subservice.`id` AS subservice_id, subservice.s_name AS subservice_name, service_id FROM subservice");
  	
  	for ($i=0; $i < count($services); $i++) {
  		foreach ($subservices as $sub) {
  			if ($services[$i]['id'] == $sub['service_id']) {
  				
  				$services[$i]['subservice'][] = $sub;
  			}
  		}
  			
  	}
  	
  	$service = array();
  	$i = 0;

  	foreach ($services as $item) {
  		$service[$i]['type'] = 'service';
  		$service[$i]['description'] = $item['s_name'].'('.$item['service_name'].')';
  		if (isset($item['subservice']) && is_array($item['subservice'])) {
  			$service[$i]['key_words'] = $item['s_name'];
  			$service[$i]['meta'][] = $item['s_name'];
  			$service[$i]['url'][] = 'services?service_id='.$item['id'];
  			
  			foreach ($item['subservice'] as  $sub) {
		  		$service[$i]['key_words'] .= ' '.$sub['subservice_name'].' ';
		  		$service[$i]['meta'][] = $sub['subservice_name'];
		  		$service[$i]['url'][] = 'services?subservice_id='.$sub['subservice_id'];
  			}
  		} else {
  			$service[$i]['key_words'] = $item['s_name'];
  			$service[$i]['meta'] = $item['s_name'];
  			$service[$i]['url'] = 'services?service_id='.$item['id'];
  		}
  		$i++;
  	}
	//var_dump($service);
	$local_data = $organization;
	foreach ($service as $data) {
		array_push($local_data, $data);
	}
	
	
	for ($i = 0; $i < count($local_data); $i++) {
		if ( count($local_data[$i]['meta']) > 1 ) {
			$str = implode('<split>', $local_data[$i]['meta']);
			unset($local_data[$i]['meta']);
			$local_data[$i]['meta'] = $str;
		}
	
	}

	//file_put_contents('C:/local_search', json_encode($local_data));
	echo json_encode($local_data);	
	
	
	
	
	