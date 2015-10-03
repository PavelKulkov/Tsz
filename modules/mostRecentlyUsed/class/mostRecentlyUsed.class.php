<?php
	class mostRecentlyUsed {
		private $db_instance;
		private $request;
		public $sql;
		private $lng_prefix;
		public $count;
		public $items_news = array('id','content');
	
		
		function __construct($request=NULL,$db) 	{
			$this->db_instance = $db;
			$this->lng_prefix = $GLOBALS["lng_prefix"];
			$this->request 	= $request;
		}
		
				
		function showServices() {
			$this->db_instance->changeDB('regportal_share');
			$sql = 'SELECT COUNT(r.`id_subservice`) AS count_subservice, serv.`s_short_name`, serv.`s_reglament_name`, serv.`id` AS service_id, serv.`s_name` AS service_name, serv.`registry_number`
					FROM regportal_share.`request` r
					LEFT JOIN regportal_services.`subservice` sub
					ON r.`id_subservice` = sub.`id`
					LEFT JOIN regportal_services.`service` serv
					ON sub.`service_id` = serv.`id`
					WHERE sub.s_digital_form != 0
					GROUP BY serv.`id`
					ORDER BY count_subservice DESC
					LIMIT '.MOST_RECENTLY_USED_LIMIT;
			
			$services = $this->db_instance->select($sql);
			
			$subservices_id_list = array();
			foreach ($services as $item) {
				$subservices_id_list[] = $item['service_id'];	
			}

			
			
			$this->db_instance->changeDB('regportal_services');
			$subservices = $this->db_instance->select("SELECT sub.id, sub.service_id, sub.s_digital_form, sub.s_short_name, sub.s_name AS subservice_name, s.s_name AS service_s_name, s.id AS service_service_id 
														FROM `subservice` sub 
														LEFT JOIN service s
														ON sub.service_id = s.id
														WHERE service_id IN (%s)", $subservices_id_list);
						
			for ($i=0; $i < count($services); $i++) {
				foreach ($subservices as $sub) {
					if ($services[$i]['service_id'] == $sub['service_id']) {
						$services[$i]['subservice'][] = $sub;
					} 
				}
				
			}
			
			$this->db_instance->changeDB('regportal_cms');
			return $services;
			
		}
		
	}