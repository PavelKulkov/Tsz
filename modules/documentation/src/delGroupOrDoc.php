<?php
	echo 22;
	exit;
	require_once("../class/Documentation.class.php");
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
	if($_POST['IdForDel']){
		$tmp = explode($_POST['IdForDel']);
		echo $tmp[0];
		exit;
	}else{
		echo 22;
		exit;
	}
	
	
	if(!isset($documentation)) $documentation = new Documentation($request, $db);
	
	if($_POST['IdDocForDel']){
		$documentation ->deleteDoc($_POST['IdDocForDel']);
	}
	else{
		$documentation ->deleteGroup($_POST['IdGroupForDel']);
	}
	
	$db->disconnect();
	header("Location:/documentation");
?>