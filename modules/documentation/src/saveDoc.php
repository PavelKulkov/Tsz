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
	
	if(isset($_POST['idDoc'])){
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/Docs/";
		$uploadfile = $uploaddir . basename($_FILES['"uploaded_file_edit_object']['name']);

	
		move_uploaded_file($_FILES['"uploaded_file_edit_object']['tmp_name'], $uploadfile);
	
		$newDoc = array('id'=>$_POST['idDoc'],'title'=>$_POST['titleDoc'],'date'=>date("Y-m-d H:i:s"),'Name'=>$_FILES['uploaded_file_edit_object']['name']);
		//echo var_dump($newDoc);
		$documentation ->saveDoc($newDoc);
	}else{
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/Docs/";
		$uploadfile = $uploaddir . basename($_FILES['uploaded_file_add_object']['name']);

	
		move_uploaded_file($_FILES['uploaded_file_add_object']['tmp_name'], $uploadfile);
	
		$newDoc = array('title'=>$_POST['title'],'date'=>date("Y-m-d H:i:s"),'groupOfDocs'=>$_POST['idGroup'],'Name'=>$_FILES['uploaded_file_add_object']['name']);
		$documentation ->saveDoc($newDoc);
	}
	
	$db->disconnect();
	header("Location:/documentation");
?>