<?php

	$admin = $authHome->isAdminMode();
	if ($request->hasValue('action')) {		//выполняем операции
		$action = $request->getValue('action');
		$operation = $request->getValue('operation');	
	} else {  
	  $module = $moduleHome->getModuleForTemplateByName($template['id'], 'mostRecentlyUsed');
	  include_once $modules_root.'mostRecentlyUsed/src/index.inc.php';
	  $currentModule['text'] = "<br/>".$module['text'];

	  
	  //$module = $moduleHome->getModuleForTemplateByName($template['id'], 'news');
	  include_once $modules_root.'news/src/index.inc.php';
	  $currentModule['text'] .= "<br/>".$module['text'];
	  /*
	  $module = $moduleHome->getModuleInCacheByName('banners');
	  include_once $modules_root.'banners/src/index.inc.php';
	  $currentModule['text'] .= "<br/>".$module['text']; 	 
	  */
	  $module = $currentModule; 
	}
