<?php
	require_once($modules_root."organisations/class/Organisations.class.php");
	require_once($modules_root."general/class/Paginator.class.php");
		
	$organisation_class = new Organisations($request, $db);
	
	if(isset($_GET['id_organisation'])){
		$organisation_id = $_GET['id_organisation'];	
	}
	
	
	
	$text = '';
	$output_params = '';
	$service_data_parts = array();
	
	$admin = $authHome->isAdminMode();
	$db->changeDB("regportal_services");

	//one organisation
	if (isset($organisation_id)){
		
		$output_params['organisation'] = $organisation_class->getCompany($organisation_id);
		
		$type_item = $organisation_class->getCompanyType($output_params['organisation']['company_type_id']);
		$output_params['organisation']['type_item'] = $type_item;
		
		$output_params['parent_entry_id'] = $output_params['organisation']['parent_id'];
		
		if (isset($output_params['parent_entry_id'])){
			$output_params['parent_entry'] =  $organisation_class->getCompany($output_params['parent_entry_id']);
		}
		$active_tab_created = false;
		//Tabs
		$output_params['service_count'] = 0;
		$output_params['child_organisations_count'] = 0;
		$output_params['service_paginator'] = null;
		$child_organisations_paginator = null;

		if(!isset($output_params['service_paginator'])) $output_params['service_paginator'] = new Paginator($request, $db,  "service");
		$output_params['service_count'] = $output_params['service_paginator']->getCountGlobal("WHERE company_id=".$output_params['organisation']['id']);
		
		if(!isset($child_organisations_paginator)) 
		$child_organisations_paginator = new Paginator($request, $db,  "company");
		$child_organisations_paginator->setStyle(SITE_THEME);
		
		$output_params['child_organisations_count'] = $child_organisations_paginator->getCountGlobal("WHERE parent_id=".$output_params['organisation']['id']);
		
		//tabs content
		if ($output_params['service_count'] != 0){

			if(isset($output_params['service_paginator'])){
				$paginator = $output_params['service_paginator']->getPaginator($request, "/organisations", $output_params['service_count']);
				$output_params['service_list'] = $output_params['service_paginator']->getListGlobal($paginator['index'], 'id',"WHERE company_id=".$output_params['organisation']['id']);

				$i = 0;
				foreach ($output_params['service_list'] as $entry) {
					$service_data_parts['id'][$i] = $entry['id'];
					$i++;
				}
				
				$output_params['subservices_list'] = $organisation_class->getSubservices($service_data_parts);
				for ($i=0; $i < count($output_params['service_list']); $i++) {
					foreach ($output_params['subservices_list'] as $subservice) {
						if ($output_params['service_list'][$i]['id'] == $subservice['service_id']) {
							$output_params['service_list'][$i]['subservices'][] = $subservice;
						} 
					}
				}
			}
		}
		
		if ($output_params['child_organisations_count'] != 0){
			$paginator = $child_organisations_paginator->getPaginator($request, "/organisations", $output_params['service_count']);
			$output_params['organisation_list'] = $child_organisations_paginator->getListGlobal($paginator['index'], 'id',"WHERE parent_id=".$output_params['organisation']['id']);

			$i = 0;
			$service_data_parts = '';
			foreach ($output_params['organisation_list'] as $entry) {
				$service_data_parts['company_type_id'][$i] = $entry['company_type_id'];
				$i++;
			}
			
			
			$type_item = $db->select("SELECT * FROM `type_company` WHERE `id` IN (%s) LIMIT ".count($service_data_parts['company_type_id']), $service_data_parts['company_type_id']);
			for ($i=0; $i < count($output_params['organisation_list']); $i++) {
				foreach ($type_item as $type) {
					if ($output_params['organisation_list'][$i]['company_type_id'] == $type['id']) {
						$output_params['organisation_list'][$i]['type_item'] = $type;
					} 
				}
			}
		}

	} else { //many organisations
		$output_params['municipal_districts'] = $organisation_class->getMunicipalDistricts();
		
		
		if(isset($_GET['municipal_district'])){
			//echo 11111111;
			//$_POST['municipal_district'] = $_GET['municipal_district'];
		}
		
		
		// для поиска организации по начальной букве
		if(isset($_POST['letter']) || (isset($_GET['letter']) && $_GET['letter'] != '') ) {
			$letter = isset($_POST['letter']) ? $_POST['letter'] : ( (isset($_GET['letter']) && $_GET['letter'] != '') ? $_GET['letter'] : '');
			
			$organisation_paginator = new Paginator($request, $db,  "company",  20);
			$organisation_paginator->setStyle(SITE_THEME);
			$organisation_paginator->setOrder(false);
			
			$organisation_count = $organisation_paginator->getCountGlobal('WHERE letter="'.strtoupper($letter).'"');
			$paginator = $organisation_paginator->getPaginator($request, "/organisations?letter=$letter", $organisation_count);
			$output_params['list'] = $organisation_paginator->getListGlobal($paginator['index'], 'c_name',' WHERE letter="'.strtoupper($letter).'"', 'c_name');
		}  else {
			// дефолтный список организаций
			$output_params['municipal_district'] = isset($_POST['municipal_district'])?$_POST['municipal_district']:NULL;
			$output_params['municipal_districts'] = $organisation_class->getMunicipalDistricts();
			$output_params['municipal_filtered'] = isset($output_params['municipal_district'])?true:false;
			$organisation_paginator = new Paginator($request, $db,  "company",  20);
			$organisation_paginator->setStyle(SITE_THEME);
			
			if (isset($output_params['municipal_districts'])){
				$organisation_paginator->setOrder(false);
				
				if ($output_params['municipal_filtered']){
					$organisation_count = $organisation_paginator->getCountGlobal('where id='.$output_params['municipal_district']);
					$paginator = $organisation_paginator->getPaginator($request, "/organisations", $organisation_count);
					$output_params['list'] = $organisation_paginator->getListGlobal($paginator['index'], 'c_name','where municipal_district='.$output_params['municipal_district'].' or company_type_id = 1');
				} else {
					$organisation_count = $organisation_paginator->getCountGlobal();
					$paginator = $organisation_paginator->getPaginator($request, "/organisations", $organisation_count);
					$output_params['list'] = $organisation_paginator->getListGlobal($paginator['index'], 'c_name');
				}
			}
		}
			
		
		
		// Составление списка предоставляемых услуг для каждой организации
		$organisations_services = $organisation_class->getOrganizationsServices();	
		
		if ($output_params['list']) {
			
			$service_data_parts = array();
			for ($i = 0; $i < count($output_params['list']); $i++) {
				$service_data_parts['company_type_id'][$i] = $output_params['list'][$i]['company_type_id'];
			}

			$type_item = $db->select("select * from `type_company` where `id` IN (%s) LIMIT ".count($service_data_parts['company_type_id']), $service_data_parts['company_type_id']);
			
			
			for ($i = 0; $i < count($output_params['list']); $i++) {
				
				foreach ($organisations_services as $service) {
					if ($output_params['list'][$i]['id'] == $service['company_id']) {
						$output_params['list'][$i]['service'][] = $service;
					}
				}
				
				foreach ($type_item as $type) {
					if ($output_params['list'][$i]['company_type_id'] == $type['id']) {
						$output_params['list'][$i]['type_item'] = $type;
					} 
				}
			}
		}
	}
	
		
	include ($modules_root.'organisations/view/view_ind_'.SITE_THEME.'.php');
	
	$db->revertDB();
	$module['text'] = $text;