<?php
require_once(MODULES_ROOT."organisations/class/Organisations.class.php");

class servicesController extends AppController  {

	function __construct() {
		if (self::$request->hasValue('categories')) {
			$this->category();
		} else {
			parent::__construct();
		}
	}

	
	function index() {
		
		if (SITE_THEME == 'default') {
			$organisation_class = new Organisations(self::$request, self::$db);
			
			$municipal_districts = $organisation_class->getMunicipalDistricts();
			$category_id = self::$request->getValue('service_categories');
			$recipient =  self::$model->getOneRecipient($category_id);
		
			$only_el = isset($_GET['only_el']) ? true : false;
			$municipal_district_choice = isset($_GET['municipal_district']) ? $_GET['municipal_district']  : $_SESSION['municipal_district'];
		
			$menu_categories = self::$model->getMenuCategories($category_id);
			//echo $municipal_district_choice;
			$subservices = self::$model->getSubservicesByCatagoryId($category_id, $only_el, $municipal_district_choice);
		
		if ($subservices) {
			foreach ($subservices as $subservice) {
				$services_id_list[] = $subservice['service_id'];
			}
		}
				
		if (count($services_id_list) > 0) {
			$services_id_arr = '(';
			foreach ($services_id_list as $id) {
				$services_id_arr .= $id.',';
			}

			$services_id_arr = substr($services_id_arr, 0, strlen($services_id_arr) - 1);
			$services_id_arr .= ')';
		}
		
		if(!isset($service_paginator))
			$service_paginator = new Paginator(self::$request, self::$db,  "service",  20);
			$service_paginator->setStyle(SITE_THEME);
			$service_paginator->setOrder(false);
		
			$all_services_count = self::$model->getCountServices();
			$municipal_filtered = false;
		
			if ($services_id_arr != '') {
					
				if (isset($_GET['municipal_district'])) {
		
					if ($_GET['municipal_district'] != 0) {
						$municipal_filtered = true;
						$_SESSION['municipal_district'] = $_GET['municipal_district'];
						$municipal_district = $_GET['municipal_district'];
						$sql_add = ' AND md.id = '.$_GET['municipal_district'];
					} else {
						$sql_add = ' ';
					}
		
				} else {
					if(isset($_SESSION['municipal_district'])) {
						$sql_add = ' AND md.id = '.$_SESSION['municipal_district'];
					} else {
						$sql_add = ' AND md.id = 1';
						$municipal_district = null;
					}
				}
					
					
		
				$service_count = self::$db->selectCell('SELECT COUNT(s.id)
						FROM service s
						LEFT JOIN company c
						ON s.company_id = c.id
						LEFT JOIN municipal_districts md
						ON c.municipal_district = md.id
						WHERE s.id IN '.$services_id_arr.' '.$sql_add);
					
				//$service_count = $service_paginator->getCountGlobal('WHERE id IN '.$services_id_arr);
		
				$paginator = $service_paginator->getPaginator(self::$request, "/services", $service_count);
					
				$services = $service_paginator->getListSql($paginator['index'], 'SELECT s.id, s.s_name, s.company_id, md.name AS municipal_district_name, md.id AS municipal_district_id
						FROM service s
						LEFT JOIN company c
						ON s.company_id = c.id
						LEFT JOIN municipal_districts md
						ON c.municipal_district = md.id
						WHERE s.id IN '.$services_id_arr.' '.$sql_add, 's_name');
					
				// для вывода количества найденых услуг в подкатегории из общего числа услуг
				//$service_categories_count = self::$db->selectCell('SELECT count(id) FROM service WHERE id IN '.$services_id_arr.' '.$sql_add);
					
					
					
				$services_count = count($services);
					
				for ($i = 0; $i < count($services); $i++) {
					foreach ($subservices as $subservice) {
						if ($services[$i]['id'] == $subservice['service_id']) {
							$services[$i]['subservices'][] = $subservice;
						}
					}
				}
			}

		
			self::$view->setVars(array('service_count' => $service_count, 
										'all_services_count' => $all_services_count,
										'category_id' => $category_id,
										'municipal_districts' => $municipal_districts,
										'paginator' => $paginator,
										'services' => $services,
										'recipient' => $recipient,
										'menu_categories' => $menu_categories
								));
		
		} else {
			$services_paginator = new Paginator(self::$request, self::$db,  "service",  25);
			$services_paginator->setStyle(SITE_THEME);
			$services_count = 0;
			
			$subservice_digital_form = self::$request->hasValue('subservice_digital_form') ? self::$request->getValue('subservice_digital_form'):-1;
			$recipient = isset($_GET['recipient']) ? $_GET['recipient'] : NULL;
			$service_type = self::$request->hasValue('type_service_id') ? self::$request->getValue('type_service_id') : NULL;
			$category = isset($_GET['category']) ? $_GET['category'] : NULL;
			$subservice_digital_forms = self::$model->getSubserviceDigitalForms();
			$recipients = self::$model->getRecipients();
			
			//строим фильтр для выборки
			$service_filter_text='';
			$subservice_filtered = false;
			$subservice_filter_text='';
			$first_entry = true;
			if (!($subservice_digital_form == -1 || !isset($subservice_digital_form))){
				if ($first_entry) {
					$first_entry = false;
				} else {
					$subservice_filter_text.= ' and ';
				}
				
				if($subservice_digital_form!=-1) {
					if($subservice_digital_form!=2) {
						$subservice_filter_text.= 's_digital_form = '.$subservice_digital_form;
					} else {
						$subservice_filter_text.= 's_digital_form in ("1","2")';
					}
				}
				$subservice_filtered = true;
			}
			
			if (!($recipient == 1 || !isset($recipient))) {
				if ($first_entry) {
					$first_entry = false;
				} else {
					$subservice_filter_text.= ' and ';
				}
				
				$subservice_filter_text.= 'recipient_id in (1, '.$recipient.' )';
				$subservice_filtered = true;
			}
			
			if (isset($category)) {
				if ($first_entry) {
					$first_entry = false;
				} else {
					$subservice_filter_text.= ' and ';
				}
				
				$subservice_filter_text.= 'id in (select subservice_id from subservice_life_situations where life_situation_id = '.$category.' )';
				$subservice_filtered = true;
			}
				
			$first_entry = true;
			if (isset($service_type)) {
				if ($first_entry) {
					$service_filter_text.= 'where ';
					$first_entry = false;
				} else {
					$service_filter_text.= ' and ';
				}
				
				$service_filter_text.= 'type_serviсe_id = '.$service_type;
			}
			
			if ($subservice_filtered) {
				if ($first_entry) {
					$service_filter_text.= 'where ';
					$first_entry = false;
				} else {
					$service_filter_text.= ' and ';
				}
				
				$service_filter_text.= 'id in (select service_id from subservice where '.$subservice_filter_text.' )';
			}
				
			//собственно уже отфильтрованные еслуги и выводим
			$services_paginator->setOrder(false);
			$service_count = $services_paginator->getCountGlobal($service_filter_text);
			$paginator = $services_paginator->getPaginator($request, "/service", $service_count);
			$services = $services_paginator->getListGlobal($paginator['index'], 's_name', $service_filter_text);
			if ($services) {
			
				$i = 0;
				foreach ($services as $service_entry) {
					$services[$i]['company'] = self::$model->getCompany($service_entry['company_id']);
					if (!$subservice_filtered){
						$services[$i]['subservices_list'] = self::$model->getSubservices($service_entry['id']);
					}else{
						$services[$i]['subservices_list'] = self::$model->getSubservices($service_entry['id'],'and '.$subservice_filter_text);
					}
			
					$services[$i]['registry_entry'] = self::$db->selectRow('select * from reglaments where service_registry_number = ?', $service_entry['registry_number']);
					$i++;
				}
			}

			self::$view->setVars(array('subservice_digital_forms' => $subservice_digital_forms,
										'subservice_digital_form' => $subservice_digital_form,
										'recipients' => $recipients,
										'recipient' => $recipient,
										'services' => $services
								));
		}
		
		self::$view->render('index');
	}
	
	
	function view() {
		$service_id = isset($_GET['service_id']) ? $_GET['service_id'] : NULL;
		$service = self::$model->getService($service_id);
		if (isset($service_id)){	
			if ($service){
				$registry_entry = self::$db->selectRow('SELECT * FROM reglaments WHERE service_registry_number = ?', $service['registry_number']);
				$service['reglament'] = $registry_entry;
		
				$subservices = self::$model->getSubservices($service['id']);
				
				if ($subservices){
					$service['subservices'] = $subservices;
				}
			}		
			
			foreach ($service['subservices'] as $subservice) {
				$recipients[] = $subservice['name'];
			}
	
			$participants = self::$model->getParticipants($service['registry_number']);
			$service['participants'] = $participants;
			
			$data = '';
			$recipients = array_unique($recipients);
			if (in_array('Все', $recipients)) {
				$data = 'Все';
			} else {
				foreach ($recipients as $recipient) {
					$data .= $recipient.', ';
				}
	
				$data = trim($data);
				$data = substr($data, 0, strlen($data) - 1);
			}
			
			$recipients = $data;
			
			self::$view->setVars(array('service' => $service,
										'recipients' => $recipients,
								));
			self::$view->render('view');
		}
	}

	
	function subservice() {
		$subservice_id = isset($_GET['subservice_id']) ? $_GET['subservice_id'] : NULL;
		$subservice = self::$model->getSubservice($subservice_id);
		
		$registry_entry = self::$db->selectRow('select * from reglaments where service_registry_number = ?', $subservice['service_registry_number']);
		$subservice['reglament'] = $registry_entry;
		
		$requestsArr = self::$model->getRequests($subservice['registry_number']);			
		$responsesArr = self::$model->getResponses($subservice['registry_number']);
		$requests = '';
		$responses = '';
		
		if($requests != '') {
			foreach ($requestsArr as $req) {
				$requests .= $req['title'].', ';					
			}
		}
		
		if($responses != '') {
			foreach ($responsesArr as $res) {
				$responses .= $res['title'].', ';
			}
		}
		
		$subservice['requests'] = substr($requests, 0, strlen($requests) - 2);
		$subservice['responses'] = substr($responses, 0, strlen($responses) - 2);
		
		$recipient =  self::$model->getOneRecipient($subservice['service_categories_id']);
		$menu_categories = self::$model->getMenuCategories($subservice['service_categories_id']);
	
		self::$view->setVars(array('subservice' => $subservice,
									'recipient' => $recipient,
									'menu_categories' => $menu_categories
							));
		self::$view->render('subservice');
	}
	
	
	function category() {
		$life_situations =self::$model->getLifeSutuationsWithCount();

		self::$view->setVars('life_situations', $life_situations);
		self::$view->render('category');
	}
}


