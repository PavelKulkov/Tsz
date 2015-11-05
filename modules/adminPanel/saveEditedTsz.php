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
	
	$tsz = array('id'=>$_POST['idTsz'],'logo','title'=>$_POST['titleTsz'],'address'=>$_POST['addressTsz'],'id_template'=>1,
				'phoneNumber'=>$_POST['phoneNumberTsz'],'E-mail'=>$_POST['e-mailTsz'],'fax'=>$_POST['faxTsz'],'President'=>$_POST['PresidentTsz']);
	$registry -> save($tsz);
	$db->disconnect();
	header("Location:/registry?id_tsz=".$_POST['idTsz']."");
?>