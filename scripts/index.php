<?php
$lng = 'ru';
$item = $domenHome->getDomenBy('link', $request->domen, $lng);

if ($item == false){
 die( "Не найден домен ".$request->domen);
 
}
//TODO: Проработать ветку админа
$fields['lang'] = "ru"; 
$fields['is_admin'] = 0;




// @TO DO переключение между стилями... подглючивает  при поиске м.б. писать в SESSION ?
$fields['style']="default";

if (isset($_COOKIE['theme'])) {
	$fields['style']= $_COOKIE['theme'];
} else {
	$authHome->setCookieTheme('default');	
	$fields['style']="default";
}


if (isset($_POST['theme_value']) && $_POST['theme_value'] != '') {
	$authHome->setCookieTheme($_POST['theme_value']);	
	$fields['style']= $_POST['theme_value'];
	
	//echo '<script type="text/javascript">
	//window.location = "'.$_POST['url_path'].'"
	//</script>';
} 


if($authHome->isAdminMode()){
	$fields['is_admin'] = 1;
	$fields['style']="light";
}


$modules = array();
$skip = array('.', '..');

##########################
# выборка всех модулей, для корреткного отображения темплейта index или остальных страниц
# begin

$files = scandir($modules_root);
foreach($files as $file) {
	if (file_exists($modules_root.$file.'/class/')) {
		if(!in_array($file, $skip)) {
			$subfiles = scandir($modules_root.$file.'/class/');
			foreach ($subfiles as $sub) {
				if(!in_array($sub, $skip)) {
					$name_module_parts = explode('.class.php', $sub);
					$modules[] = strtolower($name_module_parts[0]);
				}
			}
		}
	}
}
	

$url = isset($_GET['url']) ? $_GET['url'] : null;
$url = explode('/', $url);
$url = array_shift($url);

if (!empty($url) && in_array($url, $modules) && $fields['style'] =="default") {
	$type = 'pages';
} else {
	$type = 'index';
}


#
# отображение нужного темплейта
# end
#########################

$fields['type'] = $type;
$template = $templateHome->getByFields('domain_id',$item['id'],$fields);



define('SITE_THEME', $template['style']);
$templ = fopen($template_dir.$template['name'].'.tpl', "r");
if(!$templ) {
  echo "Error open file: ".$template_dir."/".$template['name'].'.tpl';
  exit;
}
$moduleHome->getModulesByTemplate($template['id']);

while (!feof($templ)) {
	$buffer = fgets($templ, 4096);//Получаем поочерёдно каждую строку из файла
	$pos = 0;
	$area = NULL;
	$prev = 0;
	$outHTML = "";
	unset($currentModule);
	$path = "";
	//Если находит {#content} или {#area}
	while(ModuleHome::hasModuleMatch($buffer, $area, $pos)){
		$beforeInclude = microtime(true);
		$prev = $pos;
		$pos = $area[0][1] + strlen($area[0][0]);
		$outHTML = substr($buffer,$prev,$area[0][1] - $prev);//Вырезает из строки #area или #content 
		echo $outHTML;
		
		/*
		 * @TO DO в строках где $area[0][0]=='{#content}'.... подключение контроллера и моделей, для новой идеологии
		$files = scandir($controllers_root);
		foreach($files as $file) {
			if (file_exists($controllers_root.$file)) {
				if(!in_array($file, $skip)) {
					if (file_exists($controllers_root.$file.'/include.inc.php')) {
						require 'controllers/'.$file.'/include.inc.php';										
					}
					if (file_exists($controllers_root.$file.'/index.inc.php')) {
						require 'controllers/'.$file.'/index.inc.php';
					}
					
				}
			}	
		}
		
		*/
		
		if($area[0][0]=='{#content}'){
		  $currentModule = $moduleHome->findActiveModule($request,$def_module);
		  $log->info("ActiveModule,".$_SERVER['REMOTE_ADDR'], $currentModule['name']);
		  $path = "index.inc.php";
		}else{
		  $currentModule = $moduleHome->getModuleInCacheByArea($area[0][0]);//Получение модели по #area14
		  $path = "include.inc.php"; 
		}
		if($currentModule!=false){
			$module = $currentModule;
			$path = $moduleHome->generateModulePath($module).$path;
			if($moduleHome->isModuleExist($path)){
				$res = include_once($path);
				if(isset($module['text'])){
					$data = $module['text'];
					echo $module['text'];
					if($res==1)$moduleHome->updateCacheModuleText($module);
				}
				if(isset($saveIncludeTime) && $saveIncludeTime!==false){
				  $log->info("Include,".$_SERVER['REMOTE_ADDR'].",".$module['name'], "time=".(microtime(true) - $beforeInclude));
				}
				
				
			}			
		}
		
	
		
		unset($currentModule);
		unset($module);
		
		
	};
	$outHTML = substr($buffer,$pos);
	echo $outHTML;
}


fclose($templ);
?>