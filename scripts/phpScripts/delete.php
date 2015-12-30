<?php
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
	  
	if($_POST['IdForDel']){
		$tmp = explode('-',$_POST['IdForDel']);
		$sql = "SELECT * FROM `".$tmp[0]."` WHERE `id`= ?";
		$item = $db ->selectRow($sql,$tmp[1]);
		if($item['image']){
			@unlink($_SERVER['DOCUMENT_ROOT']."/files".$item['image']);
		}	
		$sql = "DELETE FROM `".$tmp[0]."` WHERE `id`= ?";
		$db -> delete($sql,$tmp[1]);
		
		}

	
	$db->disconnect();
	header("Location:/");
?>