<?php 
class searchController extends AppController  {

	CONST All_SEARCH_RESULT_COUNT = 10;
	
	function __construct() {
		parent::__construct();
	}

	function index() {
		
		$admin = self::$authHome->isAdminMode();
		self::$db->changeDB("regportal_cms");
		
			
		//initialize params ans delete all crap from $search_string
		$search_string = '';
		$showFull='block';
		
		
		if (self::$request->hasValue('search_string')) {
			$search_string = isset($_POST['search_string']) ? $_POST['search_string'] : $_GET['search_string'];
			$search_string = self::$model->prepareSearchString($search_string);
			self::$log->info('search_string', $search_string);
		}
		
		$is_news = (isset($_GET['news_flag']) && !empty($_GET['news_flag'])) ? true : false;
		$is_service = (isset($_GET['service_flag']) && !empty($_GET['service_flag'])) ? true : false;
		$is_organisation = (isset($_GET['organisation_flag']) && !empty($_GET['organisation_flag'])) ? true : false;

		$news_count = 0;
		$organisation_count = 0;
		$service_count = 0;
		
		$news_paginator = null;
		$organisation_paginator = null;
		$service_paginator = null;
	
		if ($is_news && $is_organisation && $is_service && SITE_THEME == 'default'){

			if(!isset($test)) $test = new Paginator(self::$request, self::$db,  "news");
				$test->setStyle(SITE_THEME);	
				$test->setOrder(false);
				
				$search_list = $test->getListSql(0,
					"SELECT  id AS id, s_name AS title, 'services' AS `table` FROM regportal_services.`service` WHERE MATCH (s_name, s_short_name) AGAINST ('".$search_string."') 
	UNION 
	SELECT  id AS id, c_name AS title, 'organisations' AS `table` FROM regportal_services.`company` WHERE MATCH (c_name) AGAINST ('".$search_string."') 
	UNION
	SELECT  id AS id, title AS title, 'news' AS `table` FROM regportal_cms.`news` WHERE MATCH (title, annotation) AGAINST ('".$search_string."') ", '`table`'
				);
				//$paginator = $test->getPaginator(self::$request, "/search", count($output_params['search_list']));
				//print_r($output_params['search_list']);
				if ($search_list) {
					foreach ($search_list as $counts) {
						if ($counts['table'] == 'news') {
							$news_count++;
							$i++;	
						}
						if ($counts['table'] == 'services') {
							$service_count++;	
						}
						if ($counts['table'] == 'organisations') {
							$organisation_count++;	
						}
					}	
				}
				
		} else if ($is_news || $is_organisation || $is_service){	
			
			if ($is_news){
				if(!isset($news_paginator)) $news_paginator = new Paginator(self::$request, self::$db,  "news",  20);
				$news_paginator->setStyle(SITE_THEME);	
				$news_count = $news_paginator->getCountGlobal("WHERE MATCH (`title`,`annotation`) AGAINST ('".$search_string."')");
			}
		
			if ($is_service){
				self::$db->changeDB("regportal_services");
				$service_paginator = new Paginator(self::$request, self::$db,  "service",  20);
				$service_paginator->setStyle(SITE_THEME);	
				$service_count = $service_paginator->getCountGlobal("WHERE MATCH (s_name, s_short_name) AGAINST ('".$search_string."')");
			}
			
			if ($is_organisation){
				self::$db->changeDB("regportal_services");
				$organisation_paginator = new Paginator(self::$request, self::$db,  "company",  20);		
				$organisation_paginator->setStyle(SITE_THEME);	
				$organisation_count = $organisation_paginator->getCountGlobal("WHERE MATCH (c_name) AGAINST ('".$search_string."')");
			}
	
			
			if ($is_news){
				//Use Paginator to search in news
				self::$db->changeDB("regportal_cms");
	
				if ($news_count != 0) {
					$paginator = $news_paginator->getPaginator(self::$request, "/search", $news_count);
					$news_paginator->setOrder(true);
					$news_list = $news_paginator->getListGlobal($paginator['index'], 'date', "WHERE MATCH (title, annotation) AGAINST ('".$search_string."')");
				}
			}
					
			
			if ($is_service) {
				//Use Paginator to search in servises
				self::$db->changeDB("regportal_services");
				if ($service_count != 0) {
					$company = array ('id', 'c_name');
					$type = array ('id', 'name');
					$paginator = $service_paginator->getPaginator(self::$request, "/search", $service_count);
					$item = array('id','s_name','s_short_name','company_id', 's_reglament_name', 's_reglament_source', 'type_serviсe_id');		
					$service_paginator->setOrder(false);
					$service_list = $service_paginator->getListGlobal($paginator['index'], 's_name', "WHERE MATCH (s_name, s_short_name) AGAINST ('".$search_string."')");
					
					if ($service_list) {
						$i = 0;
						$service_data_parts = array();
						foreach ($service_list as $entry) {
							$service_data_parts['company_id'][$i] = $entry['company_id'];
							$service_data_parts['type_serviсe_id'][$i] = $entry['type_serviсe_id'];
							$i++;
						}
	
						$company_item = self::$db->select("select `id`, `c_name` from `company` where `id` IN (%s) LIMIT ".count($service_data_parts['company_id']), $service_data_parts['company_id']);
						$type_item = self::$db->select("select * from `type_service` where `id` IN (%s) LIMIT ".count($service_data_parts['type_serviсe_id']), $service_data_parts['type_serviсe_id']);
	
						for ($i=0; $i < count($service_list); $i++) {
							foreach ($company_item as $company) {
								if ($service_list[$i]['company_id'] == $company['id']) {
									$service_list[$i]['company_item'] = $company;
								} 
							}
							foreach ($type_item as $type) {
								if ($service_list[$i]['type_serviсe_id'] == $type['id']) {
									$service_list[$i]['type_item'] = $type;
								} 
							}
						}
					}
				} 
			}
		
			
			if ($is_organisation){
				self::$db->changeDB("regportal_services");
				if ($organisation_count != 0){
					$paginator = $organisation_paginator->getPaginator(self::$request, "/search", $organisation_count);
					$organisation_paginator->setOrder(false);
					$organisation_list = $organisation_paginator->getListGlobal($paginator['index'], 'c_name', "WHERE MATCH (c_name) AGAINST ('".$search_string."')");
					
					if ($organisation_list) {
						$i = 0;
						$type = array ('id', 'name');
						$service_data_parts = array();
						foreach ($organisation_list as $entry) {
							$service_data_parts['company_type_id'][$i] = $entry['company_type_id'];
							$i++;
						}
						
						$type_item = self::$db->select("select * from `type_company` where `id` IN (%s) ",$service_data_parts['company_type_id']);
						
						for ($i=0; $i < count($organisation_list); $i++) {
							foreach ($type_item as $type) {
								if ($organisation_list[$i]['company_type_id'] == $type['id']) {
									$organisation_list[$i]['type_item'] = $type;
								} 
							}
						}
					} 
				}
			}
		}

		self::$view->setVars(array('is_news' => $is_news,
									'is_organisation' => $is_organisation,
									'is_service' => $is_service, 
									'news_count' => $news_count,
									'organisation_count' => $organisation_count,
									'service_count' => $service_count,
									'search_list' => $search_list,
									'news_list' => $news_list,
									'service_list' => $service_list,
									'organisation_list' => $organisation_list,
									'paginator' => $paginator,
									'admin' => $admin 
							));
		
		self::$view->render('index');
	}
}

	
	
	
	
	