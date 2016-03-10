<?php
	require_once($modules_root."site/class/Site.class.php");
	if(!isset($site)) $site = new Site($request, $db);
				
	include ($modules_root.'site/view/site.php');	
?>