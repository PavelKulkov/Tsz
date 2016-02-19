<?php
	/*TODO Если при редактировании не указывают документ,то старый стирается.То же самое и в документах*/
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
	
	if($_POST['idPartner']){
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/LogosPartners/";
		
		if(!empty($_FILES['uploaded_file_edit_object']['name'])){
			$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object']['name']);
		    $image = "/LogosPartners/".$_FILES['uploaded_file_edit_object']['name'];
	
			move_uploaded_file($_FILES['uploaded_file_edit_object']['tmp_name'], $uploadfile);
			
			$oldPartner = $partneryAndProject->getPartner($_POST['idPartner']);
			$flagName = $partneryAndProject->matchesImg($oldPartner['image'], "partners");
		    if($oldPartner['image'] != "/LogosPartners/default/default.png" && !$flagName){
				@unlink($_SERVER['DOCUMENT_ROOT']."/files".$oldPartner['image']);
			}
		}
		else{
			$oldPartner = $partneryAndProject->getPartner($_POST['idPartner']);
		    $image = $oldPartner['image'];
	    }
			
		$newPartner = array('id'=>$_POST['idPartner'],'image'=>$image,'title'=>$_POST['titleEditPartner'],'text'=>'','site'=>$_POST['sitePartner']);

		$partneryAndProject -> savePartner($newPartner);
		
	}else{
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/LogosPartners/";
		
		if(!empty($_FILES['uploaded_file_add_object']['name'])){
			$uploadfile = $uploaddir . basename($_FILES['uploaded_file_add_object']['name']);
	        $image = "/LogosPartners/".$_FILES['uploaded_file_add_object']['name'];
			move_uploaded_file($_FILES['uploaded_file_add_object']['tmp_name'], $uploadfile);
		}
		else{
			$image = "/LogosPartners/default/default.png";
		}
	
		$newPartner = array('image'=>$image,'title'=>$_POST['titlePartner'],'text'=>'','site'=>$_POST['sitePartner']);

		$partneryAndProject -> savePartner($newPartner);
	}
		
	$db->disconnect();
	header("Location:/partners");
?>