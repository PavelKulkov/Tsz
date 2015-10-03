<?php 
	require_once($modules_root."search/class/Search.class.php");
	require_once($modules_root."general/class/Paginator.class.php");
	require_once($modules_root."organisations/class/Organisations.class.php");
	include($modules_root."search/scripts/onCreate.js");
	
	$organisation_class = new Organisations($request, $db);
	$municipal_districts = $organisation_class->getMunicipalDistricts();
	if ( (stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox')) ||  stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0')) {
		include($modules_root."search/scripts/indexedDb.js");
	} else  {
		include($modules_root."search/scripts/webSql.js");	
	}
	
	
	$admin = $authHome->isAdminMode();
	$db->changeDB("regportal_cms");
	
	if(!isset($search))	$search = new Search($request, $db);
	
	//initialize params ans delete all crap from $search_string
	$search_string = '';
	$output_params = '';
	$showFull='block';
	define(All_SEARCH_RESULT_COUNT, 10);
	
	if ($request->hasValue('search_string')) {
		$search_string = $search->prepareSearchString($request->getValue('search_string'));
		$log->info('search_string', $search_string);
	}
	
	$output_params['is_news'] = ($request->hasValue('is_news')) ? true : false;
	$output_params['is_organisation'] = $request->hasValue('is_organisation') ? true : false;
	$output_params['is_service'] = $request->hasValue('is_service') ? true : false;
	
	$output_params['news_count'] = 0;
	$output_params['organisation_count'] = 0;
	$output_params['service_count'] = 0;
	$output_params['municipal_districts'] = $municipal_districts;
	if($request->hasValue("districts")){
	  if($request->getValue("districts")!=""){
	    $output_params['municipal_district'] = $request->getValue("districts");
		$search->setDistrict($output_params['municipal_district']);
	  }
	}
	
	
	$news_paginator = null;
	$organisation_paginator = null;
	$service_paginator = null;

	if ($output_params['is_news'] && $output_params['is_organisation'] && $output_params['is_service'] && SITE_THEME == 'default'){
		if(!isset($test)) $test = new Paginator($request, $db,  "news");
			$test->setStyle(SITE_THEME);	
			$test->setOrder(false);
			$query = "SELECT  regportal_services.`service`.id AS id, s_name AS title, 'services' AS `table`\r\n";
			if(isset($output_params['municipal_district'])){
			  $query .= "FROM  regportal_services.`service` INNER JOIN regportal_services.`company` ON(regportal_services.`service`.company_id=regportal_services.`company`.id) ";
			}else{
			  $query .= "FROM  regportal_services.`service` ";
			}
			$query.="\r\n".$search->createFilter("service")."\r\n".
                 "  UNION 
                 SELECT  id AS id, c_name AS title, 'organisations' AS `table` 
				 FROM regportal_services.`company` ". $search->createFilter("company")."\r\n".
                 "  UNION
                 SELECT  id AS id, title AS title, 'news' AS `table` 
				 FROM regportal_cms.`news` ".$search->createFilter("news");
			$output_params['search_list'] = $test->getListSql(0,$query, '`table`');
			//$paginator = $test->getPaginator($request, "/search", count($output_params['search_list']));
			//print_r($output_params['search_list']);
			if ($output_params['search_list']) {
				foreach ($output_params['search_list'] as $counts) {
					if ($counts['table'] == 'news') {
						$output_params['news_count']++;
						$i++;	
					}
					if ($counts['table'] == 'services') {
						$output_params['service_count']++;	
					}
					if ($counts['table'] == 'organisations') {
						$output_params['organisation_count']++;	
					}
				}	
			}
			
	} else if ($output_params['is_news'] || $output_params['is_organisation'] || $output_params['is_service']){	
		$table = "";
		if ($output_params['is_news']){
		    $table = "news";
			if(!isset($news_paginator)) $news_paginator = new Paginator($request, $db, $table  ,  20);
			$news_paginator->setStyle(SITE_THEME);	
			$output_params['news_count'] = $news_paginator->getCountGlobal($search->createFilter($table));
		}
	
		if ($output_params['is_service']){
			$db->changeDB("regportal_services");
			$table = "service";
			$service_paginator = new Paginator($request, $db, $table,  20);
			if(isset($output_params['municipal_district'])){
			  $service_paginator->setJoinTable("INNER JOIN company ON (service.company_id = company.id)");
			}
			$service_paginator->setStyle(SITE_THEME);	
			$output_params['service_count'] = $service_paginator->getCountGlobal($search->createFilter($table));
		}
		
		if ($output_params['is_organisation']){
			$db->changeDB("regportal_services");
			$table = "company";
			$organisation_paginator = new Paginator($request, $db,  $table,  20);		
			$organisation_paginator->setStyle(SITE_THEME);	
			$output_params['organisation_count'] = $organisation_paginator->getCountGlobal($search->createFilter($table));
		}

		
		if ($output_params['is_news']){
			//Use Paginator to search in news
			$db->changeDB("regportal_cms");

			if ($output_params['news_count'] != 0) {
				$paginator = $news_paginator->getPaginator($request, "/search", $output_params['news_count']);
				$news_paginator->setOrder(true);
				$output_params['news_list'] = $news_paginator->getListGlobal($paginator['index'], 'date', "WHERE MATCH (title, annotation) AGAINST ('".$search_string."')");
			}
		}
				
		
		if ($output_params['is_service']) {
			//Use Paginator to search in servises
			$db->changeDB("regportal_services");
			if ($output_params['service_count'] != 0) {
				$company = array ('id', 'c_name');
				$type = array ('id', 'name');
				$paginator = $service_paginator->getPaginator($request, "/search", $output_params['service_count']);
				$item = array('id','s_name','s_short_name','company_id', 's_reglament_name', 's_reglament_source', 'type_serviсe_id');	
				$service_paginator->setOrder(false);
				$output_params['service_list'] = $service_paginator->getListGlobal($paginator['index'], 's_name', $search->createFilter('service'));
				
				if ($output_params['service_list']) {
					$i = 0;
					$service_data_parts = array();
					foreach ($output_params['service_list'] as $entry) {
						$service_data_parts['company_id'][$i] = $entry['company_id'];
						$service_data_parts['type_serviсe_id'][$i] = $entry['type_serviсe_id'];
						$i++;
					}

					$company_item = $db->select("select `id`, `c_name` from `company` where `id` IN (%s) LIMIT ".count($service_data_parts['company_id']), $service_data_parts['company_id']);
					$type_item = $db->select("select * from `type_service` where `id` IN (%s) LIMIT ".count($service_data_parts['type_serviсe_id']), $service_data_parts['type_serviсe_id']);

					for ($i=0; $i < count($output_params['service_list']); $i++) {
						foreach ($company_item as $company) {
							if ($output_params['service_list'][$i]['company_id'] == $company['id']) {
								$output_params['service_list'][$i]['company_item'] = $company;
							} 
						}
						foreach ($type_item as $type) {
							if ($output_params['service_list'][$i]['type_serviсe_id'] == $type['id']) {
								$output_params['service_list'][$i]['type_item'] = $type;
							} 
						}
					}
				}
			} 
		}
	
		
		if ($output_params['is_organisation']){
			$db->changeDB("regportal_services");
			if ($output_params['organisation_count'] != 0){
				$paginator = $organisation_paginator->getPaginator($request, "/search", $output_params['organisation_count']);
				$organisation_paginator->setOrder(false);
				$output_params['organisation_list'] = $organisation_paginator->getListGlobal($paginator['index'], 'c_name', $search->createFilter('company'));
				
				if ($output_params['organisation_list']) {
					$i = 0;
					$type = array ('id', 'name');
					$service_data_parts = array();
					foreach ($output_params['organisation_list'] as $entry) {
						$service_data_parts['company_type_id'][$i] = $entry['company_type_id'];
						$i++;
					}
					
					$type_item = $db->select("select * from `type_company` where `id` IN (%s) ",$service_data_parts['company_type_id']);
					
					for ($i=0; $i < count($output_params['organisation_list']); $i++) {
						foreach ($type_item as $type) {
							if ($output_params['organisation_list'][$i]['company_type_id'] == $type['id']) {
								$output_params['organisation_list'][$i]['type_item'] = $type;
							} 
						}
					}
				} 
			}
		}
	} 
	
	include ($modules_root.'search/view/view_ind_'.SITE_THEME.'.php');
	
	//$handle = fopen("C:\\res.html", "w");
	//fwrite($handle, $text);
	//fclose($handle);
	$module['text'] = $text;
	