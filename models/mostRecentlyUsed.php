<?php
	
class mostRecentlyUsed {
	
		private $db;
		private $request;
		private $lng_prefix;
		
		function __construct($request = NULL, $db) 	{
			$this->db = $db;
			$this->lng_prefix = $GLOBALS["lng_prefix"];
			$this->request 	= $request;
		}
		
				
		function showServices() {
			$this->db->changeDB('regportal_share');
			$sql = 'SELECT COUNT(r.`id_subservice`) AS count_subservice, serv.`s_short_name`, serv.`s_reglament_name`, serv.`id` AS service_id, serv.`s_name` AS service_name, serv.`registry_number`
					FROM regportal_share.`request` r
					LEFT JOIN regportal_services.`subservice` sub
					ON r.`id_subservice` = sub.`id`
					LEFT JOIN regportal_services.`service` serv
					ON sub.`service_id` = serv.`id`
					GROUP BY serv.`id`
					ORDER BY count_subservice DESC
					LIMIT '.MOST_RECENTLY_USED_LIMIT;
			
			$services = $this->db->select($sql);
			
			$subservices_id_list = array();
			foreach ($services as $item) {
				$subservices_id_list[] = $item['service_id'];	
			}

			
			
			$this->db->changeDB('regportal_services');
			$subservices = $this->db->select("SELECT id, service_id, s_digital_form, s_short_name, s_name AS subservice_name FROM `subservice` WHERE service_id IN (%s)", $subservices_id_list);
						
			for ($i=0; $i < count($services); $i++) {
				foreach ($subservices as $sub) {
					if ($services[$i]['service_id'] == $sub['service_id']) {
						$services[$i]['subservice'][] = $sub;
					} 
				}
				
			}
			
			$this->db->changeDB('regportal_cms');
			return $services;
			
		}
		
	}