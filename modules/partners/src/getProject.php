<?php
	require_once("../class/Partners.class.php");
	require_once("../../../config.inc.php");
	require_once("../../../config_system.inc.php");
	
	$db = new DB();
	DBRegInfo::initParams($guestUser[0],
	  			              $guestUser[1],
	  			              $guestUser[2],
	  			              $guestUser[3]);	  	
	  	  
	  $regInfo = DBRegInfo::getInstance();
	try{
	  	$db->connect($regInfo);
	  }catch(Exception $e){
	  	 die("DB Connection error");
	  }
	if(!isset($PartneryAndProject)) $PartneryAndProject = new PartneryAndProject($request, $db);
	
	$Project = $PartneryAndProject->getProject($_POST['idProject']);
	$db->disconnect();
	echo(json_encode($Project));
	
	
	

?>