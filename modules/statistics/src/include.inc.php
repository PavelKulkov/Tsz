<?php
require_once($modules_root."statistics/class/Statistics.class.php");
$text = "";
$output_params = "";
$fileName = $moduleHome->getTemp().'/stats_'.SITE_THEME.'.html';
if(!is_file($fileName)){
	$db->changeDB("regportal_services");
	$statistics_class = new Statistics($request, $db);
	//Количество государственных услуг
	$i =$statistics_class->getGosServicesCount();
	$output_params['gos_count'] = $i[0]['count(id)'];
	//Количество муниципальных услуг
	$i =$statistics_class->getMunServicesCount();
	$output_params['mun_count'] = $i[0]['count(id)'];
	//Общее количество услуг
	$output_params['service_count'] = $output_params['mun_count'] + $output_params['gos_count'];
	//Услуг в электронном виде
	$i = $statistics_class->getDigitalServicesCount();
	$output_params['digital_count'] = $i[0]['count(id)'];
	//Количество подуслуг в электронном виде
	$i = $statistics_class->getDigitalSubservicesCount();
	$output_params['digital_s_count'] = $i[0]['count(id)'];
	//Количество описаний организаций
	$i = $statistics_class->getCompanyCount();
	$output_params['company_count'] = $i[0]['count(id)'];
	//Количество документов
	$dir = opendir(ModuleHome::getDocumentRoot().'/files/reglaments');
	
	
	$count = 0;
	while($file = readdir($dir)){
		if($file == '.' || $file == '..' || is_dir(ModuleHome::getDocumentRoot().'/files/reglaments'. $file)){
			continue;
		}
		$count++;
	}
	
	$output_params['doc_count'] = $count;
	//Количество функций
	$output_params['function_count'] = 0;
	//Количество муниципальных функций
	$output_params['f_mun_count'] = 0;
	//Количество государственных функций
	$output_params['f_gos_count'] = 0;
	//Количество федеральных функций
	$output_params['f_fed_count'] = 0;
	//Количество федеральных услуг
	$output_params['fed_count'] = 0;
	
	// если действовать через контроллер View
	// $text = $view->render($output_params);
	
	// по старинке
	include ($modules_root.'statistics/view/view_'.SITE_THEME.'.php');
	$db->revertDB();
	$handle = fopen($fileName, "w");
	fwrite($handle,$text);
	fclose($handle);
}else{
  	$handle = fopen($fileName, "r");
  	$text = fread($handle, filesize($fileName));
  	fclose($handle);  	
  }
$module['text'] = $text;
?>