<?php
require_once($modules_root."meta/class/Meta.class.php");


$db->changeDB("regportal_services");
if(!isset($meta))	$meta = new Meta($request, $db);


$text = '<meta charset="utf-8">';


$url = $request->getValue('url');

$description = '';
switch ($url) {
	case 'services' :
		$service_id = $request->hasValue('service_id') ? $request->getValue('service_id') : NULL; 
		
		if (!empty($_GET['subservice_id'])) {
			$title = $meta->getTitleSubservice();
		} else {
			$title = $meta->getTitleService($service_id);
		}
		
		$text .= '<title>'.$title['s_short_name'].'</title>';
	break;

	case 'forms' :
		$title = $meta->getTitleForm();
		$text .= '<title>'.$title['name'].'</title>';
	break;

	case 'news' :

	if (!empty($_GET['id_news'])) {
		
		$title = $meta->getTitleNews();
		$text .= '<title>'.$title['title'].'</title>';
	}
	
	break;
	
	
	
	case 'organisations' :

	if (!empty($_GET['id_organisation'])) {
		
		$title = $meta->getTitleCompany();
		$text .= '<title>'.$title['c_name'].'</title>';
	}
	
	break;
	
	
	
	case '';		
		$metaDescription = $meta->getAllMeta();
		foreach ($metaDescription as $meta) {
			$description .= $meta['s_name'].', ';	
		}
}


if (empty($title)) {
	$text .= '<title>Региональный портал государственных и муниципальных услуг Пензенской области</title>';
}

echo $text;

$db->revertDB();