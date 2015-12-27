<?php
	require_once("../class/Documentation.class.php");
	require_once("../../../config.inc.php");
	require_once("../../../config_system.inc.php");
	if(!isset($_POST['idDoc'])){
		echo("error");
		exit;
		
	}
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
	if(!isset($documentation)) $documentation = new Documentation($request, $db);
	
	$doc = $documentation->getDoc($_POST['idDoc']);
	$db->disconnect();
	echo(json_encode($doc));
	
	
	

?>