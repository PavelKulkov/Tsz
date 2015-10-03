<?php

	$admin = $authHome->isAdminMode();
	if ($request->hasValue('action')) {		//выполняем операции
		$action = $request->getValue('action');
		$operation = $request->getValue('operation');		
		if ($action == "about") {
	
		};	
	} else {
	  /*TODO: Основная идея - подключать на вывод необходимый контент в зависимости от action Ниже пример выводится на экран значение $module['text']
	   * можно сливать модули в один Пример $currentModule['text'] = $module['text']."bufferModuleText";
	   * $module = $currentModule; 
	   * */
	  
	  $module = $moduleHome->getModuleForTemplateByName($template['id'], 'mostRecentlyUsed');
	  include_once $modules_root.'mostRecentlyUsed/src/index.inc.php';
	  $currentModule['text'] = "<br/>".$module['text'];
		
	  $module = $moduleHome->getModuleInCacheByName('map');
	  include_once $modules_root.'map/src/index.inc.php';
	  $currentModule['text'] .= $module['text'];
	  
	  $module = $moduleHome->getModuleInCacheByName('banners');
	  include_once $modules_root.'banners/src/index.inc.php';
	  $currentModule['text'] .= "<br/>".$module['text']; 	 
	  
	  $module = $currentModule; 
	}
