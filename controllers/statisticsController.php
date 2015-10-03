<?php

class statisticsController extends AppController  {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$fileName = self::$moduleHome->getTemp().'/stats_'.SITE_THEME.'.html';
		if(!is_file($fileName)){
			self::$db->changeDB("regportal_services");
			//Количество государственных услуг
			$gos_count = self::$model->getGosServicesCount();			
			//Количество муниципальных услуг
			$mun_count = self::$model->getMunServicesCount();
			//Общее количество услуг
			$service_count = $mun_count + $gos_count;
			//Услуг в электронном виде
			$digital_count = self::$model->getDigitalServicesCount();
			//Количество подуслуг в электронном виде
			$digital_s_count = self::$model->getDigitalSubservicesCount();
			//Количество описаний организаций
			$company_count = self::$model->getCompanyCount();

			//Количество документов
			$dir = opendir(ModuleHome::getDocumentRoot().'/files/reglaments');
			
			
			$count = 0;
			while($file = readdir($dir)){
				if($file == '.' || $file == '..' || is_dir(ModuleHome::getDocumentRoot().'/files/reglaments'. $file)){
					continue;
				}
				$count++;
			}
			
			$doc_count = $count;
			//Количество федеральных услуг
			$fed_count = 0;
			
			self::$view->setVars(array('gos_count' => $gos_count,
										'mun_count' => $mun_count,
										'service_count' => $service_count,
										'digital_count' => $digital_count,
										'digital_s_count' => $digital_s_count,
										'company_count' => $company_count,
										'doc_count' => $doc_count,
										'fed_count' => $fed_count
								));
			$text = self::$view->render('index');

			self::$db->revertDB();
			$handle = fopen($fileName, "w");
			fwrite($handle, $text);
			fclose($handle);
		} else {
		  	$handle = fopen($fileName, "r");
		  	$text = fread($handle, filesize($fileName));
		  	fclose($handle);  
		  	echo $text;	
		}	
	}

}