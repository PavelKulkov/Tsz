<?php

class mostRecentlyUsedController extends AppController  {
	const MOST_RECENTLY_USED_SUBSERVICES_COUNT = 7;
	
	function __construct() {
		parent::__construct();
	}
	
	
	function index() {
		$fileName = self::$moduleHome->getTemp()."/mostRecentlyUsedService.html";
		if(!is_file($fileName)){
			
			$services =  self::$model->showServices();
									
			$file = serialize($services);
			file_put_contents($fileName, $file);
		} else {
			
			$file = file_get_contents($fileName);
			$services = unserialize($file);
		}
		
		if (!empty($services)) {
			self::$db->changeDB("regportal_services");
				
			$i = 0;
			$service_registry_parts = array();
			$subservices = array();
			foreach ($services as $service) {
				$service_registry_parts['registry_number'][$i] = $service['registry_number'];
					
				$i++;
			}
				
			$registry_entry = self::$db->select('SELECT * FROM `reglaments` WHERE service_registry_number  IN (%s) ', $service_registry_parts['registry_number']);
				
			for ($i = 0; $i < count($services); $i++) {
				foreach ($registry_entry as $registry) {
					if ($services[$i]['registry_number'] == $registry['service_registry_number']) {
						$services[$i]['reglament']= $registry;
					}
				}
				foreach ($services[$i]['subservice'] as $sub) {
					$subservices[] = $sub;
				}
			}
				
			self::$db->revertDB();
		}
		
		
		self::$view->setVars(array('services' => $services,
									'subservices' => $subservices	
							));
		self::$view->render('index');
	}
}

