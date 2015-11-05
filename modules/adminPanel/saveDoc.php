<?php
	require_once("../documentation/class/Documentation.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
	
	$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/Docs/";
	$uploadfile = $uploaddir . basename($_FILES['doc']['name']);

	
	move_uploaded_file($_FILES['doc']['tmp_name'], $uploadfile);
	
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
	
	$newDoc = array('title'=>$_POST['title'],'date'=>date("Y-m-d H:i:s"),'name'=>$_FILES['doc']['name']);
	$documentation ->save($newDoc);
	
	$db->disconnect();
	header("Location:/documentation");
?>