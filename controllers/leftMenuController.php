<?php

class leftMenuController extends AppController  {

	function __construct() {
		parent::__construct();
	}

	function index() {
		if(!isset($leftHome))	$leftHome = new Menu(self::$request, self::$db);
		$list = $leftHome->getMenu(0, self::$module['id_location']);
		
		$i = 0;
		foreach ($list as  $entry) {	
			$active = false;
			$url = $entry['url'];
			if ($url[0] != "/") {
			    $url = "/".$url;
			}
			$path =  $_SERVER['REQUEST_URI'];
			$ps = strpos($path,'?');
			if($ps!==false){
			  $path = substr($path,0,$ps);
			  
			}
			if (strcmp($path, $url) == 0)   {
				$active = true; //"class=\"active\"";
			}
			
				
			$hidden = "hidden=\"hidden\"";   
			if (self::$request->hasValue('p_id')){ 
				if (self::$request->getValue('p_id') == $entry['id'])	$hidden = "";
			}
			
			$entry['$hidden'] = $hidden;
			$entry['$active'] = $active;
				
			if (isset($entry['submenu'])&& is_array($entry['submenu'])) {
				
				$j = 0;
				foreach ($entry['submenu'] as  $subEntry) {
					$active = false;
					$url = $subEntry['url'];
					if (strcmp($path, $url) == 0){
					  $active = true;	//"class=\"active\"";
					}
					$url = $subEntry['url'];
					$ch = '?';
					if(strpos($url,'?')!=false){
					  $ch = '&';
					}
					$subEntry['$active'] = $active;
					$entry['submenu'][$j++] = $subEntry; 
				}
			} else {
				
				$area = null;
				$entryURL = $entry['url'];
				$hasModuleMatchEntry = ModuleHome::hasModuleMatch($entryURL, $area, $fromStart); 
				if($hasModuleMatchEntry){
					$module = self::$moduleHome->getModuleInCacheByArea($area[0][0]);
					$path = "include.inc.php";
					$path = self::$moduleHome->generateModulePath($module).$path;
					$item = $text;
					include($path);
				}
			}
			$list[$i++] = $entry;
		}
		
		self::$view->setVars(array('list' => $list,
									'ch' => $ch,
									'$entry[\'$hidden\']' => $entry['$hidden'],
									'$entry[\'$active\']' => $entry['$active'],
									'$subEntry[\'$active\']' => $subEntry['$active'],
									'admin' => $admin
					));
		self::$view->render('index');
	}
	
}

