<?php
	
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
	if(!isset($documentation)) $documentation = new Documentation($request, $db);
	
	
	
	if(isset($_POST['idGroup'])){
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/Docs/LogoForGroups/";
		$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object_group']['name']);

	
		move_uploaded_file($_FILES['uploaded_file_edit_object_group']['tmp_name'], $uploadfile);
	
	
	
		$newGroup = array('id'=>$_POST['idGroup'],'groupOfDoc'=>$_POST['titleGroup'],'image'=>$_FILES['uploaded_file_edit_object_group']['name']);
	
		
		$documentation ->saveGroup($newGroup);
	}else{
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/Docs/LogoForGroups/";
		$uploadfile = $uploaddir . basename($_FILES['uploaded_file_add_object_group']['name']);

	
		move_uploaded_file($_FILES['uploaded_file_add_object_group']['tmp_name'], $uploadfile);
	
	
	
		$newGroup = array('groupOfDoc'=>$_POST['title'],'image'=>$_FILES['uploaded_file_add_object_group']['name']);
	
		//echo(var_dump($newGroup));
		$documentation ->saveGroup($newGroup);
	
	}
	$db->disconnect();
	header("Location:/documentation");
?>