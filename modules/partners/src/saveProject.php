<?php
	/*TODO ≈сли при редактировании не указывают документ,то старый стираетс€.“о же самое и в документах*/
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
	if(!isset($partneryAndProject)) $partneryAndProject = new PartneryAndProject($request, $db);
	
	if($_POST['idProject']){
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/LogosProjects/";
		$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object']['name']);
		$image = "/LogosProjects/".$_FILES['uploaded_file_edit_object']['name'];
	
		move_uploaded_file($_FILES['uploaded_file_edit_object']['tmp_name'], $uploadfile);
	
		$newProject = array('id'=>$_POST['idProject'],'image'=>$image,'title'=>$_POST['titleProject'],'text'=>$_POST['textProject'],'site'=>$_POST['siteProject']);

		$partneryAndProject -> saveProject($newProject);
	}else{
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/LogosProjects/";
		$uploadfile = $uploaddir . basename($_FILES['uploaded_file_add_object']['name']);
		$image = "/LogosProjects/".$_FILES['uploaded_file_add_object']['name'];
	
		move_uploaded_file($_FILES['uploaded_file_add_object']['tmp_name'], $uploadfile);
	
		$newProject = array('image'=>$image,'title'=>$_POST['titleProject'],'text'=>$_POST['textProject'],'site'=>$_POST['siteProject']);

		$partneryAndProject -> saveProject($newProject);
	}
	
	
	$db->disconnect();
	header("Location:/partners");
?>