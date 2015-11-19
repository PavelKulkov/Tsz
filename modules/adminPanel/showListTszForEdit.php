<?php
	require_once("../registry/class/Registry.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
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
	if(!isset($registry)) $registry = new Registry($request, $db);
	
	$listTsz = $registry -> getList();
	
	$text = "";
	foreach ($listTsz as $Tsz) {
		$text .= '<a href="showTszForEdit.php?idTsz='.$Tsz['id'].'">'.$Tsz['title'].'<br>';
	}
	
	echo($text);
	$db->disconnect();
	
?>