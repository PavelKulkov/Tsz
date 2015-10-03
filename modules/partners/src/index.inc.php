<?php
	require_once($modules_root."partners/class/Partners.class.php");
	if(!isset($$partneryAndProject))$partneryAndProject = new PartneryAndProject($request, $db);
	$listOfPartneryAndProject = $partneryAndProject->getListOfPartners();
	include ($modules_root.'partners/view/partners.php');
?>