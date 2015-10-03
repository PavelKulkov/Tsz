<?php
	if(!isset($leftHome))	$leftHome = new Menu($request,$db);
	$list = $leftHome->getMenu(0,$currentModule["id_location"]);	
	$admin = $authHome->isAdminMode();

	$text = "<script>
			    function mainLIclick(el) {
					console.log(el);
				    $('ul.nav-pills.child').attr(\"hidden\", \"hidden\")
				    $('ul.nav-pills.child li').removeClass('active');
				    var str = 'ul.nav-pills.child.children' + el.id;
				    $(str).removeAttr(\"hidden\");
				}
				
			</script>";
	$fromStart = 0;
	$text.= "<ul class=\"nav nav-pills nav-stacked\">";
	foreach ($list as  $entry) {	
		$active = "";
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
			$active = "class=\"active\"";
		}
		
			
		$hidden = "hidden=\"hidden\"";   
		if ($request->hasValue('p_id')){ 
			if ($request->getValue('p_id') == $entry['id'])	$hidden = "";
		}
			
		if (isset($entry['submenu'])&& is_array($entry['submenu'])) {
			
			$text.="<li onclick=\"mainLIclick(this)\" id =".$entry['id']."><a data-toggle=\"tab\" href=\"/#\"". $entry['url']."&id=".$entry['id']."\">".$entry['name']."</a></li>";
			$text.="<ul ".$hidden." class=\"nav-pills nav-stacked child children".$entry['id']."\">";
			foreach ($entry['submenu'] as  $subEntry) {
				$active = "";
				$url = $subEntry['url'];
				if (strcmp($path, $url) == 0){
				  $active = "class=\"active\"";
				}
				$url = $subEntry['url'];
				$ch = '?';
				if(strpos($url,'?')!=false){
				  $ch = '&';
				}
				
				$text.="<li ".$active." style=\"line-height: 24px;\"><a href=\"". $subEntry['url'].$ch."id=".$subEntry['id']."&p_id=".$subEntry['id_parent']."\">";
				$text.="<span style=\"padding:0px 0px;\">".$subEntry['name']."</span></a></li>";
			}
			$text.="</ul>";
		}
		else {
			
			$area = null;
			$entryURL = $entry['url'];
			if(ModuleHome::hasModuleMatch($entryURL, $area, $fromStart)){
				
				$module = $moduleHome->getModuleInCacheByArea($area[0][0]);
				$path = "include.inc.php";
				$path = $moduleHome->generateModulePath($module).$path;
				$item = $text;
				include($path);
				
				if(isset($module['text'])){
				  $item.="<li>".$module['text']."</li>";
				  $text = $item;
				  
				}
			}else{
			  $text.="<li ".$active." id =".$entry['id']."><a href=\"".$entry['url']."\">".$entry['name']."</a></li>";
			}
			
		}
	}
	$text.="</ul>";

	
	$currentModule['text'] = $text;
	$module = &$currentModule;
