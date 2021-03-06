<?php
	require_once("../class/Registry.class.php");
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
    if(!isset($registry)) $registry = new Registry($request, $db);
	    if(isset($_POST['idTsz'])){
            $uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/Registry/";
		
		/*if(!empty($_FILES['uploaded_file_edit_object']['name'])){
				$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object']['name']);
				$path = $_FILES['uploaded_file_edit_object']['name'];
				move_uploaded_file($_FILES['uploaded_file_edit_object']['tmp_name'], $uploadfile);
			}
			else{
				$uploadfile = $uploaddir ."default/default.png";
				$path = "default/default.png";
			}
		*/
            if(!empty($_FILES['uploaded_file_edit_object_group']['name'])){
			    $uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object_group']['name']);
			    $path = $_FILES['uploaded_file_edit_object_group']['name'];
			    move_uploaded_file($_FILES['uploaded_file_edit_object_group']['tmp_name'], $uploadfile);
			
			    $oldReg = $registry->getReg($_POST['idTsz']);
				if($oldReg['logo'] != "default/default.png"){
					@unlink($_SERVER['DOCUMENT_ROOT']."/files/Registry/".$oldReg['logo']);
				}
		       
		    }
		    else{
			    $oldReg = $registry->getReg($_POST['idTsz']);
			    $path = $oldReg['logo'];
		    }
		/*$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object']['name']);
		$path = "/Registry/".$_FILES['uploaded_file_edit_object']['name'];
	
		move_uploaded_file($_FILES['uploaded_file_edit_object']['tmp_name'], $uploadfile);
		*/
		/*$oldReg = $registry->getReg($_POST['idTsz']);
		@unlink($_SERVER['DOCUMENT_ROOT']."/files/Registry/".$oldReg['logo']);
		*/
		
		/*$info = pathinfo($uploadfile);
		
		@rename($uploaddir.basename($_FILES['uploaded_file_edit_object']['name']),$uploaddir.md5(basename($_FILES['uploaded_file_edit_object']['name'],'.'.$info['extension'])).'.'.$info['extension']);
		$path = md5(basename($path,'.'.$info['extension'])).'.'.$info['extension'];
	     */
		    $editCoords = explode(",",$_POST['editCoordsTsz'] );
		   // if(!empty($_POST['addressTsz'])){
		        $editCoords = explode(",",$_POST['editCoordsTsz'] );
		    //}
	        //else{
	           // $editCoords = array(-1, -1);
		  //  }
		
		    $newReg = array('id'=>$_POST['idTsz'],'breadth'=>$editCoords[0],'longitude'=>$editCoords[1],'logo'=>$path,'title'=>$_POST['titleTsz'],'town'=>$_POST['townTsz'],'street'=>$_POST['streetTsz'], 'house'=>$_POST['houseTsz'],'id_template'=>1,'phoneNumber'=>$_POST['phoneNumberTsz'],'e_mail'=>$_POST['e_mailTsz'],'fax'=>$_POST['faxTsz'], 'surnamePresident'=>$_POST['surnamePresident'],'namePresident'=>$_POST['namePresident'], 'patronymicPresident'=>$_POST['patronymicPresident'], 'site'=>$_POST['siteTsz'], 'area'=>1, 'man'=>"ПИК", 'groupsArea'=>$_POST['area']);
		
		    $registry ->saveReg($newReg);
			
		}
		else{
		    $uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/Registry/";
			if(!empty($_FILES['uploaded_file_edit_object']['name'])){
				$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object']['name']);
				$path = $_FILES['uploaded_file_edit_object']['name'];
				move_uploaded_file($_FILES['uploaded_file_edit_object']['tmp_name'], $uploadfile);
			}
			else{
				$path = "default/default.png";
			}
		   /*$uploadfile = $uploaddir . basename($_FILES['uploaded_file_edit_object']['name']);
		   $path = "/Registry/".$_FILES['uploaded_file_edit_object']['name'];
	
		    move_uploaded_file($_FILES['uploaded_file_edit_object']['tmp_name'], $uploadfile);
		
		   $info = pathinfo($uploadfile);
		
		   @rename($uploaddir.basename($_FILES['uploaded_file_edit_object']['name']),$uploaddir.md5(basename($_FILES['uploaded_file_edit_object']['name'],'.'.$info['extension'])).'.'.$info['extension']);
		    $path = md5(basename($path,'.'.$info['extension'])).'.'.$info['extension'];
	        */
			//if(empty($_POST['addressTsz']) == false && count(explode(",",$_POST['addCoordsTsz'])) == 2 ){
				$addCoords = explode(",",$_POST['addCoordsTsz'] );
			//}
			//else{
			//	$addCoords = array(-1, -1);
			//}

		    $newReg = array('breadth'=>$addCoords[0],'longitude'=>$addCoords[1],'logo'=>$path,'title'=>$_POST['titleTsz'],'town'=>$_POST['townTsz'],'street'=>$_POST['streetTsz'], 'house'=>$_POST['houseTsz'],'id_template'=>1,'phoneNumber'=>$_POST['phoneNumberTsz'],'e_mail'=>$_POST['e_mailTsz'],'fax'=>$_POST['faxTsz'], 'surnamePresident'=>$_POST['surnamePresident'],'namePresident'=>$_POST['namePresident'], 'patronymicPresident'=>$_POST['patronymicPresident'], 'site'=>$_POST['siteTsz'], 'area'=>1, 'man'=>"-", 'groupsArea'=>$_POST['area']);
		
		    $registry ->saveReg($newReg);
		}
	
	$db->disconnect();
	header("Location:/registry");
?>