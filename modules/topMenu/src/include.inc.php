<?php
	if(!isset($topMenu)) $topMenu = new Menu($request,$db);
	$list = $topMenu->getMenu(0,$currentModule["id_location"]);

	$fromStart = 0;
	$topMenuList = array();
	$i = 0;
	$j = 0;
	foreach ($list as  $entry) {
		$area = null;
		$entryURL = $entry['url'];

		if(ModuleHome::hasModuleMatch($entryURL, $area, $fromStart)){
			$module = $moduleHome->getModuleInCacheByArea($area[0][0]);
			$path = $moduleHome->generateModulePath($module)."include.inc.php";		
			ob_start(); 			
			include_once($path);
			$module['text'] = ob_get_contents(); 
			ob_end_clean();			
			if(isset($module['text'])){
				$topMenuList['link'][$j] = $module['text'];
			  	$j++;
			}
		} else {
			$topMenuList['menu_part'][$i]['url'] = $entryURL;
			$topMenuList['menu_part'][$i]['name'] = $entry['name'];
			$i++;
		}
	}	
		
	include ($modules_root.'topMenu/view/view_inc_'.SITE_THEME.'.php');
	$text_tmp = "";
	if ($authHome->checkSession() == 1 && ($_SESSION["type"] == 4)){	//авторизация через уэк	 || $_SESSION["type"] == 3
		$text_tmp = '<object name="auth" codetype="application/java" codebase="/auth/" classid="java:com.oep.sign.AuthTerminal.class" archive="authTerminal.jar" style="position: absolute;" width="0" height="0">
	   			  </object>';
		$text_tmp .= '<script type="text/javascript">
					function waituntilend() {
		   				if (typeof auth.isActive != "undefined" && auth.isActive()) {
							if (auth.isCardPresent()){
								setTimeout(waituntilend, 1000);
							}else{
								window.location.href = "/auth/logout.php";
							}
	 	   				}else {
		       					setTimeout(waituntilend, 1000);
		   				}
					}
					$(document).ready(function()
					{
						try{
							if (navigator.javaEnabled()){					
								waituntilend();
							}
						}catch(e){
							//TODO
						}
					});
    			</script>';
	}

	$text = $text_tmp.$text; 
	//$text .= "<div style='display:none;'>".$authHome->checkSession()."|".$_SESSION["type"]."</div>";
	$currentModule['text'] = $text;
	$module = &$currentModule;
