<?php 

class topMenuController extends AppController  {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		
		$list = self::$menu->getMenu(0,self::$currentModule["id_location"]);
		$fromStart = 0;
		$topMenuList = array();
		$i = 0;
		$j = 0;
		foreach ($list as  $entry) {
			$area = null;
			$entryURL = $entry['url'];
			
			if(ModuleHome::hasModuleMatch($entryURL, $area, $fromStart)){
				
				$module = self::$moduleHome->getModuleInCacheByArea($area[0][0]);
				//$path = self::$moduleHome->generateModulePath($module)."include.inc.php";
				include MODELS_ROOT.$module['name'].'.php';
				self::$model = new $module['name'](null, self::$db);
				
					
				$controller_name = $module['name'].'Controller';
				include CONTROLLERS_ROOT.$controller_name.'.php';
				
				$controller = new $controller_name();
				
				self::$view->init('include', $module['name']);
				$topMenuList['link'][$j] = $controller->index();

				$j++;
				
				//include_once($path);
				
				if(isset(self::$module['link'])){
					$topMenuList['link'][$j] = self::$module['link'];
				  	
				}
				
				
				
			} else {
				
				
				$topMenuList['menu_part'][$i]['url'] = $entryURL;
				$topMenuList['menu_part'][$i]['name'] = $entry['name'];
				$i++;
			}
		}
		
		self::$view->init('include', 'topMenu');
		self::$view->setVars('topMenuList', $topMenuList);
		self::$view->render('index');
	}
}