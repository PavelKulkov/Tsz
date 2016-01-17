<?php
require_once("../class/Questions.class.php");
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
	if(!isset($questions)) $questions = new Questions($request, $db);
	
	$question = $questions->getQuestion($_POST['idQuestion']);

	
	
	$db->disconnect();
	echo(json_encode($question));
?>