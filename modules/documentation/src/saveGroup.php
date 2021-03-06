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
		
		
		
		if(!empty($_FILES['uploaded_file_edit_object_group']['name'])){
			$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object_group']['name']);
		    $image = "/Docs/LogoForGroups/".$_FILES['uploaded_file_edit_object_group']['name'];
	
			move_uploaded_file($_FILES['uploaded_file_edit_object_group']['tmp_name'], $uploadfile);
			
			$oldGroup = $documentation->getGroup($_POST['idGroup']);	
		
			$flagName = $documentation->matchesImg($oldGroup['image'], "documentation");
		    if($oldGroup['image'] != "/Docs/LogoForGroups/default/default.png" && !$flagName){
				@unlink($_SERVER['DOCUMENT_ROOT']."/files".$oldGroup['image']);
			}
		}
		else{
			$oldGroup = $documentation->getGroup($_POST['idGroup']);	
		    $image = $oldGroup['image'];
	    }
	
		/*$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object_group']['name']);
		$image = "/Docs/LogoForGroups/".$_FILES['uploaded_file_edit_object_group']['name'];
	
		move_uploaded_file($_FILES['uploaded_file_edit_object_group']['tmp_name'], $uploadfile);
		
		$oldGroup = $documentation->getGroup($_POST['idGroup']);
		@unlink($_SERVER['DOCUMENT_ROOT']."/files".$oldGroup['image']);
	*/
		
		$newGroup = array('id'=>$_POST['idGroup'],'groupOfDoc'=>$_POST['titleGroup'],'image'=>$image);
	
		
		$documentation ->saveGroup($newGroup);
	}else{
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/Docs/LogoForGroups/";
		
		if(!empty($_FILES['uploaded_file_add_object_group']['name'])){
			$uploadfile = $uploaddir . basename($_FILES['uploaded_file_add_object_group']['name']);
		    $image = "/Docs/LogoForGroups/".$_FILES['uploaded_file_add_object_group']['name'];
			move_uploaded_file($_FILES['uploaded_file_add_object_group']['tmp_name'], $uploadfile);
		}
		else{
			$image = "/Docs/LogoForGroups/default/default.png";
		}
		/*$uploadfile = $uploaddir . basename($_FILES['uploaded_file_add_object_group']['name']);
		$image = "/Docs/LogoForGroups/".$_FILES['uploaded_file_add_object_group']['name'];
		
		move_uploaded_file($_FILES['uploaded_file_add_object_group']['tmp_name'], $uploadfile);
	
	*/
	
		$newGroup = array('groupOfDoc'=>$_POST['titleAddGroup'],'image'=>$image);
	
		
		$documentation ->saveGroup($newGroup);
	
	}
	$db->disconnect();
	header("Location:/documentation");
?>