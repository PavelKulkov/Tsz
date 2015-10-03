<?php
require_once($modules_root."mostRecentlyUsed/class/mostRecentlyUsed.class.php");
if(!isset($mostRecentlyUsed)) $mostRecentlyUsed = new mostRecentlyUsed($request, $db);

define('MOST_RECENTLY_USED_SUBSERVICES_COUNT', 7);

$fileName = $moduleHome->getTemp()."/mostRecentlyUsedService.html";
if(!is_file($fileName)){
	$services =  $mostRecentlyUsed->showServices();
	$file = serialize($services);
	file_put_contents($fileName, $file);
} else {
	$file = file_get_contents($fileName);
	$services = unserialize($file);
}


if (!empty($services)) {
	$db->changeDB("regportal_services");

	$i = 0;
	$service_registry_parts = array();
	$subservices = array();
	foreach ($services as $service) {
		$service_registry_parts['registry_number'][$i] = $service['registry_number'];
		
		$i++;
	}
	
	$registry_entry = $db->select('SELECT * FROM `reglaments` WHERE service_registry_number  IN (%s) ', $service_registry_parts['registry_number']);
	
	for ($i = 0; $i < count($services); $i++) {			
		foreach ($registry_entry as $registry) {
			if ($services[$i]['registry_number'] == $registry['service_registry_number']) {
				$services[$i]['reglament']= $registry;
			}
		}
		foreach ($services[$i]['subservice'] as $sub) {
			$subservices[] = $sub;
			$subservices['test'] = 1;
		}
	}
	
	$db->revertDB();
}

include ($modules_root.'mostRecentlyUsed/view/view_ind_'.SITE_THEME.'.php');


$module['text'] = $text;