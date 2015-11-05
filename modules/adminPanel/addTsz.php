<?php
	require_once("../registry/class/Registry.class.php");
	require_once("../../config.inc.php");
	require_once("../../config_system.inc.php");
	
	$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/logos/";
	$uploadfile = $uploaddir . basename($_FILES['logo']['name']);

	
	move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile);
	
	
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
	$items = array('logo'=>$_FILES['logo']['name'],'title'=>$_POST['title'],'address'=>$_POST['address'],'id_template'=>1,'phoneNumber' => $_POST['phoneNumber'],'E-mail'=>$_POST['e-mail'],'fax'=>$_POST['fax'],'President'=>$_POST['president']);
	
	$registry -> save($items);
	$db->disconnect();
	header("Location:/registry	");
?>