<?php
	require_once($modules_root."services/class/Services.class.php");
	if(!isset($services))$services = new Services($request, $db);
	$listOfServices = $services->getListOfServices();
	include ($modules_root.'services/view/services.php');
?>
